<?php 
require_once('../config.php');
session_start();

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
        $jenis_pembayaran = $_POST['jenis_pembayaran'];
        $sub_pembayaran = $_POST['total-harga'] - 10000;
        $total_pembayaran = $sub_pembayaran + 10000;
        $tanggal = $_POST['tanggal'];
        $stmt = $mysqli->prepare('UPDATE `nota` SET `total_pembayaran`=?,`sub_pembayaran`=?,`jenis_pembayaran`=?,`tanggal`=?,`data_karyawan_id`=?,`status`=? WHERE `id`=?');
        $stmt->bind_param('ddssisi',$total_pembayaran,$sub_pembayaran,$jenis_pembayaran,$tanggal,$id_karyawan,$status,$id);
        $stmt->execute();
        $eksekusi = $stmt->affected_rows;
        if ($eksekusi > 0) {
            // Update Status Bayar Obat
            if(isset($_POST['bayarObat'])){
                $status = 1;
                foreach ($_POST['bayarObat'] as $key => $value) {
                    $stmt2 = $mysqli->prepare('UPDATE `resep_obat` SET `status_bayar`=? WHERE `rekam_medis_id`=? AND `data_obat_id` =?');
                    $stmt2->bind_param('iii',$status,$id,$value);
                    $stmt2->execute();
                    $eksekusi2 = $stmt2->affected_rows;
                }
            }
            echo json_encode(['status' => 'success']);
        } else {
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
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'failed']);
        }
    }
 
} catch (\Throwable $th) {
    echo json_encode(['status' => 'failed','error' => $th->getMessage()]);
}
?>