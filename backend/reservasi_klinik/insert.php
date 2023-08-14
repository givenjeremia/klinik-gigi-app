<?php 
require_once('../config.php');
$hari_list = [
    'Sunday'=> 'Minggu',
    'Monday' => 'Senin',
    'Tuesday'=> 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];
session_start();

// die();
try {
    // Cek Date
    $jadwal = $_POST['jadwal'];
    $hari = $_POST['hari'];
    $tanggal = $_POST['tanggal'];
    $hari_by_tanggal = $day_now = date("l",strtotime($tanggal));
    if ($hari_list[$hari_by_tanggal] == $hari) {
        // Get Data Pasien By Auth 
        $id_pasien = 0;
        if($_SESSION['auth']['role'] == 'pasien'){
            $id_user = $_SESSION['auth']['id'];
            $stmt_pasien = $mysqli->prepare('SELECT * FROM `data_pasien` WHERE `user_id` =?');
            $stmt_pasien->bind_param('i',$id_user);
            $stmt_pasien->execute();
            $result_pasien = $stmt_pasien->get_result();
            $data_pasien = $result_pasien->fetch_assoc();
            $id_pasien = $data_pasien['id'];
        }
        else{
            $id_pasien = $_POST['pasien'];
        }
        
        // Get No Antrian
        $now_date_with_time = date('Y-m-d H:i:s');
        $stmt_antrian = $mysqli->prepare('SELECT MAX(`no_antrian`)+1 as NoAntrian FROM `reservasi_kllinik` WHERE `tanggal_reservasi`=?');
        $stmt_antrian->bind_param('s',$now_date);
        $stmt_antrian->execute();
        $result_antrian = $stmt_antrian->get_result();
        $data_antrian = $result_antrian->fetch_assoc();
        $no_antrian = 1;
        if ($data_antrian['NoAntrian']!= null) {
            $no_antrian = $data_antrian['NoAntrian'];
        }
        // Data Jdwal
        $stmt_jadwal = $mysqli->prepare('SELECT * FROM `jadwal_dokter` WHERE `id` =?');
        $stmt_jadwal->bind_param('i',$jadwal);
        $stmt_jadwal->execute();
        $result_jadwal = $stmt_jadwal->get_result();
        $data_jadwal = $result_jadwal->fetch_assoc();
        // Add Reservasi
        $status = 'pending';
        $stmt = $mysqli->prepare("INSERT INTO `reservasi_kllinik`(`no_antrian`, `tanggal_input_reservasi`, `tanggal_reservasi`, `jam_reservasi`, `status`, `jadwal_dokter_id`,`data_pasien_id_pasien`) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param('issssii', $no_antrian,$now_date_with_time,$tanggal, $data_jadwal['jam'],$status,$jadwal,$id_pasien);
        $stmt->execute();
        $jumlah_yang_dieksekusi = $stmt->affected_rows;
        if ($jumlah_yang_dieksekusi > 0) {
            echo json_encode(['status' => 'success','msg'=>'Berhasil Tambah Reservasi']);
        } else {
            echo json_encode(['status' => 'failed','msg' => 'Gagal Tambah Reservasi']);
        }
        $stmt->close();
    }
    else{
        echo json_encode(['status' => 'failed','msg' => 'Harap Masukan Tanggal Sesuai Hari']);
    }


    
} catch (\Throwable $th) {
    //throw $th;
    echo json_encode(['status' => 'failed','msg' => $th->getMessage()]);
}


?>