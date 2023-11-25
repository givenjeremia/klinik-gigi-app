<?php
require_once( '../config.php' );
try {
    $stmt = $mysqli->prepare( 'INSERT INTO `spesialis` (`nama`) VALUES (?)' );
    $stmt->bind_param( 's', $_POST[ 'nama' ]);
    $stmt->execute();
    $jumlah_yang_dieksekusi = $stmt->affected_rows;
    if ( $jumlah_yang_dieksekusi > 0 ) {
        echo json_encode( [ 'status'=>'success', 'nama'=>$_POST[ 'nama' ] ] );
    } else {
        echo json_encode( [ 'status'=>'failed', 'msg'=>$mysqli->error ] );
    }
} catch ( \Throwable $e ) {
    echo json_encode( [ 'status'=>'failed', 'msg'=>$e->getMessage() ] );
}
?>