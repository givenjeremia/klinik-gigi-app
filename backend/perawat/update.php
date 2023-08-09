<?php
require_once( '../config.php' );
try {
    $id = $_POST[ 'id' ];
    $stmt = $mysqli->prepare( 'UPDATE `data_perawat` SET `nama`=?,`alamat`=?,`no_telp`=? WHERE `id`=?' );
    $stmt->bind_param( 'ssii', $_POST[ 'nama' ], $_POST[ 'alamat' ], $_POST[ 'no_telp' ], $id );
    $stmt->execute();
    $jumlah_yang_dieksekusi = $stmt->affected_rows;
    if ( $jumlah_yang_dieksekusi > 0 ) {
        echo json_encode( [ 'status'=>'success', 'nama'=>$_POST[ 'nama' ] ] );
    } else {
        echo json_encode( [ 'status'=>'failed', 'error'=>$mysqli->error ] );
    }
} catch ( \Throwable $e ) {
    echo json_encode( [ 'status'=>'failed', 'error'=>$e->getMessage() ] );
}