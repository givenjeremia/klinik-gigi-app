<?php
session_start();
require_once('../config.php');
$datas = [];
try {
    $rekam_medis = $_GET['rekam_medis'];
    $sql1 = "SELECT rk.data_pasien_id_pasien as IdPasien
    FROM `rekam_medis` rm inner JOIN reservasi_kllinik rk ON rm.reservasi_kllinik_id = rk.id
    WHERE rm.id = ".$rekam_medis;
    $result = $mysqli->query($sql1);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $idPasien = $data['IdPasien'];
        $sql2 = "SELECT count(n.id) as Total
        FROM nota n INNER JOIN rekam_medis rm  ON rm.id = n.rekam_medis_id
        INNER JOIN reservasi_kllinik rk ON rk.id = rm.reservasi_kllinik_id
        WHERE n.status = 'approved' AND rk.data_pasien_id_pasien = ".$idPasien;
        $result2 = $mysqli->query($sql2);
        if ($result->num_rows > 0) {
            $data2 = $result2->fetch_assoc();
            $total = $data2['Total'];
            array_push($datas, [
                'status' => 'success',
                'data' => $total
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
