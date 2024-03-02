<?php
session_start();
require_once('../config.php');
$datas = [];
try {
    $rekam_medis = $_GET['rekam_medis'];
    $sql = "SELECT o.nama as NamaObat, o.stok as stokObat,ro.* FROM `resep_obat` ro INNER JOIN `data_obat` o ON o.id = ro.data_obat_id 
            WHERE ro.status_kesediaan =1 AND ro.rekam_medis_id = ".$rekam_medis;
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
