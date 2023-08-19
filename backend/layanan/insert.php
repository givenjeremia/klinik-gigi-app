<?php
require_once( '../config.php' );
try {
    $harga = str_replace( '.', '', $_POST[ 'harga' ] );
    $stmt = $mysqli->prepare( 'INSERT INTO `layanan`(`nama`, `jenis`, `harga`, `hari_dokter`) VALUES (?,?,?,?)' );
    $stmt->bind_param( 'ssds', $_POST[ 'nama' ], $_POST[ 'jenis' ], $harga, $_POST[ 'hari_dokter' ] );
    $stmt->execute();
    $jumlah_yang_dieksekusi = $stmt->affected_rows;
    if ( $jumlah_yang_dieksekusi > 0 ) {
        echo json_encode( [ 'status'=>'success', 'nama'=>$_POST[ 'nama' ] ] );
    } else {
        echo json_encode( [ 'status'=>'failed' ] );
    }
} catch ( \Throwable $e ) {
    echo json_encode( [ 'status'=>'failed', 'error'=>$e->getMessage() ] );
}
