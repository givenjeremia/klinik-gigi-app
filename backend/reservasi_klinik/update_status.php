<?php 
require_once( '../config.php' );
try {
    $id = $_POST['id'];
    $id_jadwal = $_POST['IdJadwal'];
    $kouta_pasien = $_POST['kuotaPasien'];
    $sisa_kuota = $kouta_pasien - 1;
    // Update Sisa Kuota 
    $stmt = $mysqli->prepare('UPDATE `jadwal_dokter` SET `kuota_pasien`=? WHERE `id`=?');
    $stmt->bind_param('si',$sisa_kuota, $id_jadwal);
    $stmt->execute();
    // Get Data
    // Update Status Reservasi
    $status = $_POST['status'];
    $stmt = $mysqli->prepare('UPDATE `reservasi_kllinik` SET `status`=? WHERE `id`=?');
    $stmt->bind_param('si',$status,$id);
    $stmt->execute();
    $eksekusi = $stmt->affected_rows;
    if ($eksekusi > 0) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'failed']);
    }
} catch (\Throwable $th) {
    echo json_encode(['status' => 'failed','error' => $th->getMessage()]);
}

?>