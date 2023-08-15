<?php
require_once( '../config.php' );
try {
    $id = $_POST[ 'id' ];
    $harga = str_replace( '.', '', $_POST[ 'harga' ] );
    $stmt = $mysqli->prepare( 'UPDATE `data_obat` SET `nama`=?,`kategori`=?,`tgl_exp`=?,`stok`=?,`jenis`=?,`harga`=? WHERE `id`=?' );
    $stmt->bind_param( 'sssssdi', $_POST[ 'nama' ], $_POST[ 'kategori' ], $_POST[ 'tgl_exp' ], $_POST[ 'stok' ], $_POST[ 'jenis' ], $harga, $id );
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