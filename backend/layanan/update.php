<?php
require_once( '../config.php' );
try {
    $id = $_POST[ 'id' ];
    $harga = str_replace( '.', '', $_POST[ 'harga' ] );
    $stmt = $mysqli->prepare( 'UPDATE `layanan` SET `nama`=?,`jenis`=?,`harga`=?,`hari_dokter`=? WHERE `id`=?' );
    $stmt->bind_param( 'ssdsi', $_POST[ 'nama' ], $_POST[ 'jenis' ], $harga, $_POST[ 'hari_dokter' ], $id );
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