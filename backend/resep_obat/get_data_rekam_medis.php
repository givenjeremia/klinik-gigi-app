<?php
session_start();
require_once('../config.php');
$datas = [];
try {
    $sql = "SELECT rm.*, dp.nama as NamaPasien
    FROM `rekam_medis` rm
    INNER JOIN `reservasi_kllinik` rk ON rk.id = rm.reservasi_kllinik_id
    INNER JOIN `data_pasien` dp ON dp.id = rk.data_pasien_id_pasien
    ORDER BY rm.tanggal_pemeriksaan DESC,rm.id DESC";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = [
                $row
            ];
            array_push($datas, [
                'status' => 'oke',
                'data' => $row
            ]);
        }
    } else {
        array_push($datas, [
            'status' => 'gagal',
            'sql' => $sql
        ]);
    }
} catch (\Throwable $th) {
    //throw $th;
    array_push($datas, [
        'status' => 'gagal',
        'error' => $th->getMessage()
    ]);
}
echo json_encode($datas);
