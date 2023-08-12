<?php 
require_once('../../config.php');
session_start();
try {
    // Get Pasien ID By User ID
    $id_user = $_SESSION['auth']['id'];
    $stmt_pasien = $mysqli->prepare('SELECT * FROM `data_pasien` WHERE `user_id` =?');
    $stmt_pasien->bind_param('i',$id_user);
    $stmt_pasien->execute();
    $result_pasien = $stmt_pasien->get_result();
    $data_pasien = $result_pasien->fetch_assoc();
    // Get Nomer Andrian By Now
    $now_date = date('Y-m-d');
    $now_date_with_timme = date('Y-m-d H:i:s');
    $stmt_antrian = $mysqli->prepare('SELECT MAX(`no_antrian`)+1 as NoAntrian FROM `reservasi_kllinik` WHERE `tanggal_reservasi`=?');
    $stmt_antrian->bind_param('s',$now_date);
    $stmt_antrian->execute();
    $result_antrian = $stmt_antrian->get_result();
    $data_antrian = $result_antrian->fetch_assoc();
    $no_antrian = 1;
    if ($data_antrian['NoAntrian']!= null) {
        $no_antrian = $data_antrian['NoAntrian'];
    }
    // Get Data Jadwal
    $id_jadwal = $_POST['jadwal_dokter'];
    $stmt_jadwal = $mysqli->prepare('SELECT * FROM `jadwal_dokter` WHERE `id` =?');
    $stmt_jadwal->bind_param('i',$id_jadwal);
    $stmt_jadwal->execute();
    $result_jadwal = $stmt_jadwal->get_result();
    $data_jadwal = $result_jadwal->fetch_assoc();
    // Insert Data Reservasi
    
    $status = 'pending';
    $stmt_reservasi = $mysqli->prepare("INSERT INTO `reservasi_kllinik`(`no_antrian`, `tanggal_input_reservasi`, `tanggal_reservasi`, `jam_reservasi`, `status`, `jadwal_dokter_id`,`data_pasien_id_pasien`) VALUES (?,?,?,?,?,?,?)");
    $stmt_reservasi->bind_param('issssii', $no_antrian,$now_date_with_timme,$now_date, $data_jadwal['jam'],$status,$id_jadwal,$data_pasien['id']);
    $stmt_reservasi->execute();
    $eksekusi = $stmt_reservasi->affected_rows;
    if ($eksekusi > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'failed']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => 'failed','error'=>$th->getMessage()]);
}
?>