<?php 
require_once('../config.php');
// Add User Table
try {
    // Cek Date
    $stmt = $mysqli->prepare("INSERT INTO `reservasi_kllinik`(`no_antrian`, `tanggal_input_reservasi`, `tanggal_reservasi`, `jam_reservasi`, `status`, `jadwal_dokter_id`,`data_pasien_id_pasien`) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param('issssii', $no_antrian,$now_date_with_timme,$now_date, $data_jadwal['jam'],$status,$id_jadwal,$data_pasien['id']);
    $stmt->execute();
    $jumlah_yang_dieksekusi = $stmt->affected_rows;
    if ($jumlah_yang_dieksekusi > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'failed']);
    }

    $stmt->close();
} catch (\Throwable $th) {
    //throw $th;
    echo json_encode(['status' => 'failed','error' => $th->getMessage()]);
}


?>