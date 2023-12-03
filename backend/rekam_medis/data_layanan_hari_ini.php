<?php
session_start();
require_once( '../config.php' );
$datas = [];
try {
    // Set Now Date
    $day_now = date("l");
    $spesialis = isset($_GET['spesialis']) ? $_GET['spesialis'] : null ;
    $sql = "SELECT * FROM `layanan` WHERE `spesialis_id` is null";
    if($spesialis){
        $sql = "SELECT * FROM `layanan` WHERE `spesialis_id`='$spesialis'";
    }
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