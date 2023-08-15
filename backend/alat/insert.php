<?php
require_once( '../config.php' );
try {
    $harga = str_replace(".","",$_POST[ 'harga' ]);
    $stmt = $mysqli->prepare( 'INSERT INTO `alat`(`nama`, `jenis`, `kategori`,`harga`) VALUES (?,?,?,?)' );
    $stmt->bind_param( 'sssd', $_POST[ 'nama' ], $_POST[ 'jenis' ], $_POST[ 'kategori' ],$harga );
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
