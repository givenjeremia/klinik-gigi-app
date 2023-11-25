<?php
require_once( '../config.php' );
try {
    $id = $_POST[ 'id' ];
    $stmt = $mysqli->prepare( 'UPDATE `spesialis` SET `nama`=? WHERE `id`=?' );
    $stmt->bind_param( 'si', $_POST[ 'nama' ], $id );
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
?>