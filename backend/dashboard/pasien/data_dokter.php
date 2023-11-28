<?php
require_once( '../../config.php' );
session_start();
$day_now = date( 'l' );
// $id_user = $_SESSION[ 'auth' ][ 'id' ];
// $stmt_pasien = $mysqli->prepare( 'SELECT * FROM `data_pasien` WHERE `user_id` =?' );
// $stmt_pasien->bind_param( 'i', $id_user );
// $stmt_pasien->execute();
// $result_pasien = $stmt_pasien->get_result();
// $data_pasien = $result_pasien->fetch_assoc();
// $id_pasien = $data_pasien[ 'id' ];

$sql = "SELECT dd.id as id_dokter, dd.nama as nama_dokter,coalesce(s.nama, 'Umum') as spesialis_nama, jd.id as id_jadwal , jd.jam as jam, jd.hari as hari, jd.kuota_pasien as kuota FROM `data_dokter` dd INNER JOIN `jadwal_dokter` jd ON dd.id = jd.data_dokter_id LEFT JOIN `spesialis` s ON s.id = dd.spesialis_id WHERE jd.hari = '$day_now'";
$result = $mysqli->query( $sql );
$datas = [];
if ( $result->num_rows > 0 ) {
    $tamps = [];
    while( $row = $result->fetch_assoc() ) {
        array_push( $tamps, $row );
    }
    array_push( $datas, [
        'status'=> 'oke',
        'data'=>$tamps
    ] );
} else {
    array_push( $datas, [
        'status'=> 'gagal',
    ] );
}
echo json_encode( $datas );
