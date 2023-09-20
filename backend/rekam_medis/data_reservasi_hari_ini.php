<?php
session_start();
require_once('../config.php');
$datas = [];
try {
    if ($_SESSION['auth']['role'] == 'dokter') {
        # code...
        // Get ID Auth Dokter
        $id = $_SESSION['auth']['id'];
        $stmt_dokter = $mysqli->prepare('SELECT * FROM `data_dokter` WHERE `user_id` =?');
        $stmt_dokter->bind_param('i', $id);
        $stmt_dokter->execute();
        $result_dokter = $stmt_dokter->get_result();
        $data_dokter = $result_dokter->fetch_assoc();
        $id_dokter = $data_dokter['id'];
        // Set Now Date
        $formattedDate = date('Y-m-d');
        $sql = "SELECT rk.id as IdReservasi, rk.status_kehadiran as StatusKehadiran ,rk.no_antrian as NoAntrian,jd.id as IdJadwalDokter, rk.jam_reservasi AS Jam, rk.tanggal_reservasi as Tanggal, dp.nama as NamaPasien, dp.id As IdPasien, jd.id as IdJadwal
    FROM `reservasi_kllinik` rk INNER JOIN `data_pasien` dp ON rk.data_pasien_id_pasien = dp.id
    INNER JOIN `jadwal_dokter` as jd ON jd.id = rk.jadwal_dokter_id
    WHERE rk.status = 'approved' AND `tanggal_reservasi` = '$formattedDate' AND jd.data_dokter_id = $id_dokter";
    } else {
        $formattedDate = date('Y-m-d');
        $sql = "SELECT rk.id as IdReservasi, rk.status_kehadiran as StatusKehadiran, jd.id as IdJadwalDokter , rk.no_antrian as NoAntrian, rk.jam_reservasi AS Jam, rk.tanggal_reservasi as Tanggal, dp.nama as NamaPasien, dp.id As IdPasien, jd.id as IdJadwal
        FROM `reservasi_kllinik` rk INNER JOIN `data_pasien` dp ON rk.data_pasien_id_pasien = dp.id
        INNER JOIN `jadwal_dokter` as jd ON jd.id = rk.jadwal_dokter_id
        WHERE rk.status = 'approved' AND `tanggal_reservasi` = '$formattedDate'";
    }
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
