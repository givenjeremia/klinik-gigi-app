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
        $sql = "SELECT rk.id as IdReservasi,group_concat(DISTINCT k.nama ORDER BY k.nama DESC SEPARATOR ', ') as Treatment, rk.keluhan_baru as Keluhan, dd.nama as NamaDokter,dd.spesialis_id as spesialis_id, coalesce(s.nama, 'Umum') as spesialis_nama , rk.status_kehadiran as StatusKehadiran, jd.id as IdJadwalDokter , rk.no_antrian as NoAntrian, rk.jam_reservasi AS Jam, rk.tanggal_reservasi as Tanggal, dp.nama as NamaPasien, dp.id As IdPasien, jd.id as IdJadwal
        FROM `reservasi_kllinik` rk INNER JOIN `data_pasien` dp ON rk.data_pasien_id_pasien = dp.id
        INNER JOIN `jadwal_dokter` as jd ON jd.id = rk.jadwal_dokter_id
        INNER JOIN `data_dokter` as dd ON dd.id = jd.data_dokter_id
        LEFT JOIN `spesialis` s ON s.id = dd.spesialis_id
        LEFT JOIN `keluhan_reservasi` kr ON kr.reservasi_id = rk.id 
        LEFT JOIN `keluhan` k ON k.id = kr.keluhan_id
        WHERE rk.status = 'approved' AND rk.status_kehadiran = 'hadir' AND `tanggal_reservasi` = '$formattedDate' AND jd.data_dokter_id = $id_dokter
        GROUP BY rk.id";
    } else {
        $formattedDate = date('Y-m-d');
        $sql = "SELECT rk.id as IdReservasi,group_concat(DISTINCT k.nama ORDER BY k.nama DESC SEPARATOR ', ') as Treatment, rk.keluhan_baru as Keluhan, dd.nama as NamaDokter,dd.spesialis_id as spesialis_id, coalesce(s.nama, 'Umum') as spesialis_nama , rk.status_kehadiran as StatusKehadiran, jd.id as IdJadwalDokter , rk.no_antrian as NoAntrian, rk.jam_reservasi AS Jam, rk.tanggal_reservasi as Tanggal, dp.nama as NamaPasien, dp.id As IdPasien, jd.id as IdJadwal
        FROM `reservasi_kllinik` rk INNER JOIN `data_pasien` dp ON rk.data_pasien_id_pasien = dp.id
        INNER JOIN `jadwal_dokter` as jd ON jd.id = rk.jadwal_dokter_id
        INNER JOIN `data_dokter` as dd ON dd.id = jd.data_dokter_id
        LEFT JOIN `spesialis` s ON s.id = dd.spesialis_id
        LEFT JOIN `keluhan_reservasi` kr ON kr.reservasi_id = rk.id 
        LEFT JOIN `keluhan` k ON k.id = kr.keluhan_id
        WHERE rk.status = 'approved' AND `tanggal_reservasi` = '$formattedDate'
        GROUP BY rk.id";
    }
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql2= 'SELECT * FROM `rekam_medis` WHERE `reservasi_kllinik_id`='.$row['IdReservasi'];
            $result2 = $mysqli->query($sql2);
            $data = [];
            if ($result2->num_rows > 0) {
            }
            else{
                array_push($datas, [
                    'status' => 'oke',
                    'data' => $row
                ]);
               
            }
            
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
