<?php
session_start();
require_once('../config.php');
$datas = [];
try {
    $rekam_medis = $_GET['rekam_medis'];
    $sql = "SELECT rma.*, a.nama as NamaAlat 
            FROM `rekam_medis_has_alat` rma INNER JOIN `alat` a ON a.id = rma.alat_id
            WHERE rma.rekam_medis_id =".$rekam_medis;
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
