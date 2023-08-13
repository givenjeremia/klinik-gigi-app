<?php
require_once( '../config.php' );
session_start();
$datas = [];
try {
    $sql = "SELECT jd.id as id_jadwal ,dd.id as id_dokter, dd.nama as nama_dokter, jd.id as id_jadwal , jd.jam as jam, jd.hari as hari, jd.kuota_pasien as kuota FROM `data_dokter` dd INNER JOIN `jadwal_dokter` jd ON dd.id = jd.data_dokter_id";
    $result = $mysqli->query( $sql );
    
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

} catch ( \Throwable $th ) {
    //throw $th;
    array_push($datas,[
        'status'=> 'gagal',
        'error'=>$th->getMessage()
    ]);
}
echo json_encode( $datas );
