<?php
require_once( '../config.php' );
try {
    $harga = str_replace( '.', '', $_POST[ 'harga' ] );
    $stmt = $mysqli->prepare( 'INSERT INTO `data_obat`(`nama`, `kategori`, `tgl_exp`, `stok`, `jenis`, `harga`) VALUES (?,?,?,?,?,?)' );
    $stmt->bind_param( 'sssssd', $_POST[ 'nama' ], $_POST[ 'kategori' ], $_POST[ 'tgl_exp' ], $_POST[ 'stok' ], $_POST[ 'jenis' ], $harga );
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