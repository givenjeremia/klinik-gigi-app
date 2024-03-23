<?php 
require_once('../config.php');
session_start();

$mysqli->begin_transaction();
try {
    $id = $_POST['id'];
    
    $status = $_POST['status'];
    // Data Karyawan By Auth
    $id_user = $_SESSION['auth']['id'];
    $stmt_karyawan = $mysqli->prepare('SELECT * FROM `data_karyawan` WHERE `user_id` =?');
    $stmt_karyawan->bind_param('i',$id_user);
    $stmt_karyawan->execute();
    $result_karyawan = $stmt_karyawan->get_result();
    $data_karyawan = $result_karyawan->fetch_assoc();
    $id_karyawan = $data_karyawan['id'];
  
   
    if($status == 'approved'){
        $rekam_medis_id = $_POST['rekam_medis_id'];
        // Update Status Bayar Obat
        $jenis_pembayaran = $_POST['jenis_pembayaran'];
        $sub_pembayaran = $_POST['total-harga'] - 10000;
        $total_pembayaran = $sub_pembayaran + 10000;
        $tanggal = $_POST['tanggal'];
        $stmt = $mysqli->prepare('UPDATE `nota` SET `total_pembayaran`=?,`sub_pembayaran`=?,`jenis_pembayaran`=?,`tanggal`=?,`data_karyawan_id`=?,`status`=? WHERE `id`=?');
        $stmt->bind_param('ddssisi',$total_pembayaran,$sub_pembayaran,$jenis_pembayaran,$tanggal,$id_karyawan,$status,$id);
        $stmt->execute();
        $eksekusi = $stmt->affected_rows;

       
        
        if ($eksekusi > 0) {
            if(isset($_POST['bayarObat'])){
                foreach ($_POST['bayarObat'] as  $id_obat) {
                    // Get Qty
                    $sql = "SELECT `jumlah_pemakaian` FROM `resep_obat` WHERE `rekam_medis_id`=? AND `data_obat_id`=?";
                    $stmtQty = $mysqli->prepare($sql);
                    $stmtQty->bind_param('ii',$rekam_medis_id,$id_obat);
                    $stmtQty->execute();
                    $resultQty = $stmtQty->get_result();
                    $resultQty = $resultQty->fetch_assoc();
                    // 
                    // Update Qty
                    $stmt2 = $mysqli->prepare('UPDATE `resep_obat` SET `status_bayar`=1 WHERE `rekam_medis_id`=? AND `data_obat_id` =?');
                    $stmt2->bind_param('ii',$rekam_medis_id,$id_obat);
                    $stmt2->execute();
                    $eksekusi2 = $stmt2->affected_rows;
                    // 
                    // Update Stok
                    $stmt_obat = $mysqli->prepare('SELECT * FROM `data_obat` WHERE `id`=?');
                    $stmt_obat->bind_param('i',$id_obat);
                    $stmt_obat->execute();
                    $result_obat = $stmt_obat->get_result()->fetch_assoc();
                    if ($result_obat['stok'] > 0) {
                        $stok_now = $result_obat['stok'];
                        $stok_sisa = $stok_now -  $resultQty[ 'jumlah_pemakaian' ];
                        $stmt_obat = $mysqli->prepare('UPDATE `data_obat` SET `stok`=? WHERE `id`=?');
                        $stmt_obat->bind_param('si',$stok_sisa,$id_obat);
                        $stmt_obat->execute();
                    }
                    else{
                        $mysqli->rollback();
                        echo json_encode( [ 'status' => 'failed', 'msg' => 'Gagal Tambah Resep Obat, Salah satu obat stok habis' ] );
                    }
                    //
                }
                $mysqli->commit();
                echo json_encode(['status' => 'success']);
            }
            else{
                $mysqli->commit();
                echo json_encode(['status' => 'success']);
            }
        } else {
            $mysqli->rollback();
            echo json_encode(['status' => 'failed']);
        }
    }
    else{
        $jenis_pembayaran = null;
        $total_pembayaran = null;
        $sub_pembayaran = null;
        $tanggal = null;
        $stmt = $mysqli->prepare('UPDATE `nota` SET `total_pembayaran`=?,`sub_pembayaran`=?,`jenis_pembayaran`=?,`tanggal`=?,`data_karyawan_id`=?,`status`=? WHERE `id`=?');
        $stmt->bind_param('ddssisi',$total_pembayaran,$jenis_pembayaran,$tanggal,$id_karyawan,$id);
        $stmt->execute();
        $eksekusi = $stmt->affected_rows;
        if ($eksekusi > 0) {
            $mysqli->commit();
            echo json_encode(['status' => 'success']);
        } else {
            $mysqli->rollback();
            echo json_encode(['status' => 'failed']);
        }
    }
 
} catch (\Throwable $th) {
    $mysqli->rollback();
    echo json_encode(['status' => 'failed','error' => $th->getMessage()]);
}
?>