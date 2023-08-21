<?php
require_once('../config.php');
session_start(); 
$mysqli->begin_transaction();
try {
    // Insert Rekam Medis
    $sql = "INSERT INTO `rekam_medis`(`keluhan`, `diagnosa`, `tindakan`, `total_tarif`, `tanggal_pemeriksaan`, `reservasi_kllinik_id`, `jadwal_dokter_id`) VALUES (?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssdsii', $no_antrian,$now_date_with_time,$tanggal, $data_jadwal['jam'],$status,$jadwal,$id_pasien);
    $stmt->execute();
    // Insert Data Rekam Alat

    // Insert Data Rekam Layanan

    // Insert Resep
    

    $mysqli->commit();
} catch (\Throwable $th) {
    $mysqli->rollback();
    echo json_encode(['status' => 'failed','msg' => $th->getMessage()]);
}
?>