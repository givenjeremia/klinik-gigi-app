<?php
require_once( '../config.php' );
try {
    $harga = str_replace( '.', '', $_POST[ 'harga' ] );
    // print_r($_POST[ 'spesialis' ]);

    if ( $_POST[ 'spesialis' ] == 0 ) {
        $stmt = $mysqli->prepare( 'INSERT INTO `layanan`(`nama`, `jenis`, `harga`,`spesialis_id`) VALUES (?,?,?)' );
        $stmt->bind_param( 'ssd', $_POST[ 'nama' ], $_POST[ 'jenis' ], $harga);
        $stmt->execute();
    }
    else{
        $stmt = $mysqli->prepare( 'INSERT INTO `layanan`(`nama`, `jenis`, `harga`,`spesialis_id`) VALUES (?,?,?,?)' );
        $stmt->bind_param( 'ssdi', $_POST[ 'nama' ], $_POST[ 'jenis' ], $harga,  $_POST[ 'spesialis' ] );
        $stmt->execute();
        
    }
    $jumlah_yang_dieksekusi = $stmt->affected_rows;
    if ( $jumlah_yang_dieksekusi > 0 ) {
        echo json_encode( [ 'status'=>'success', 'nama'=>$_POST[ 'nama' ] ] );
    } else {
        echo json_encode( [ 'status'=>'failed' ] );
    }
} catch ( \Throwable $e ) {
    echo json_encode( [ 'status'=>'failed', 'error'=>$e->getMessage() ] );
}
