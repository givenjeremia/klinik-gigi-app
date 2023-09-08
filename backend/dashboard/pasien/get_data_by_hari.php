<?php
require_once('../../config.php');
session_start();

try {
    $day_select = $_POST['hari'];
    $id_user = $_SESSION['auth']['id'];
    $stmt_pasien = $mysqli->prepare('SELECT * FROM `data_pasien` WHERE `user_id` =?');
    $stmt_pasien->bind_param('i', $id_user);
    $stmt_pasien->execute();
    $result_pasien = $stmt_pasien->get_result();
    $data_pasien = $result_pasien->fetch_assoc();
    $id_pasien = $data_pasien['id'];
    // $sql = "SELECT dd.id as id_dokter, dd.nama as nama_dokter, jd.id as id_jadwal , jd.jam as jam, jd.hari as hari, jd.kuota_pasien as kuota FROM `data_dokter` dd INNER JOIN `jadwal_dokter` jd ON dd.id = jd.data_dokter_id WHERE jd.hari = '$day_select'";
    $sql = "SELECT jd.id AS id_jadwal, dd.id AS id_dokter, dd.nama AS nama_dokter, jd.jam AS jam, jd.hari AS hari, jd.kuota_pasien AS kuota 
        FROM `data_dokter` dd INNER JOIN `jadwal_dokter` jd ON dd.id = jd.data_dokter_id
        WHERE NOT EXISTS (
        SELECT $id_pasien FROM `reservasi_kllinik` rk WHERE rk.jadwal_dokter_id = jd.id AND rk.data_pasien_id_pasien = $id_pasien OR rk.status = 'rejected'
        ) AND jd.hari = '$day_select'";
    $result = $mysqli->query($sql);
    $datas = [];
    if ($result->num_rows > 0) {
        $tamps = [];
        while ($row = $result->fetch_assoc()) {

            array_push($tamps, $row);
        }
        array_push($datas, [
            'status' => 'oke',
            'data' => $tamps,
            'hari_select' => $day_select
        ]);
    } else {
        array_push($datas, [
            'status' => 'gagal',
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
