<?php
session_start();
require_once( '../config.php' );
$datas = [];
try {
    // Set Now Date
    $day_now = date("l");
    $sql = "SELECT * FROM `layanan` WHERE `hari_dokter` = '$day_now'";
    $result = $mysqli->query( $sql );
    if ( $result->num_rows > 0 ) {
        while ( $row = $result->fetch_assoc() ) {
            $data =[
               $row
            ];
            array_push( $datas, [
                'status' => 'oke',
                'data' => $row
            ]);
        }
    } else {
        array_push( $datas, [
            'status' => 'gagal',
            'sql' => $sql
        ] );
    }
} catch ( \Throwable $th ) {
    //throw $th;
    array_push( $datas, [
        'status' => 'gagal',
        'error' => $th->getMessage()
    ] );
}
echo json_encode( $datas );