<?php
require_once( '../config.php' );
session_start();
try {
    $sql = "SELECT * FROM `catatan_keuangan`";
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

} catch ( \Throwable $th ) {
    //throw $th;
    array_push($datas,[
        'status'=> 'gagal',
        'error'=>$th->getMessage()
    ]);
}
