<?php
require_once( '../config.php' );
try {
    $id = $_POST[ 'id' ];
    $harga = str_replace( '.', '', $_POST[ 'harga' ] );
    $stmt = $mysqli->prepare( 'UPDATE `alat` SET `nama`=?,`jenis`=?,`kategori`=?,`harga`=? WHERE `id`=?' );
    $stmt->bind_param( 'sssdi', $_POST[ 'nama' ], $_POST[ 'jenis' ], $_POST[ 'kategori' ], $harga, $id );
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