<?php
require_once( '../config.php' );
try {
    $jumlah = str_replace( '.', '', $_POST[ 'jumlah' ] );
    $keterangan = $_POST['keterangan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $jenis_transaksi = $_POST['jenis_transaksi'];
    $jumlah_yang_dieksekusi = 0;
    if(isset($_POST['dengan_nota'])){
        $id_nota = $_POST['daftar_nota'];
        $stmt = $mysqli->prepare( 'INSERT INTO `catatan_keuangan`(`tanggal_masuk`, `keterangan`, `jumlah`, `jenis_transaksi`, `nota_id`) VALUES (?,?,?,?,?)' );
        $stmt->bind_param( 'ssdsi', $tanggal_masuk,$keterangan,$jumlah,$jenis_transaksi,$id_nota);
        $stmt->execute();
        $jumlah_yang_dieksekusi = $stmt->affected_rows;
    }
    else{
        $stmt = $mysqli->prepare( 'INSERT INTO `catatan_keuangan`(`tanggal_masuk`, `keterangan`, `jumlah`, `jenis_transaksi`) VALUES (?,?,?,?)' );
        $stmt->bind_param( 'ssds', $tanggal_masuk,$keterangan,$jumlah,$jenis_transaksi);
        $stmt->execute();
        $jumlah_yang_dieksekusi = $stmt->affected_rows;
    }
    if ( $jumlah_yang_dieksekusi > 0 ) {
        echo json_encode( [ 'status'=>'success' ] );
    } else {
        echo json_encode( [ 'status'=>'failed', 'msg'=>$mysqli->error ] );
    }
} catch ( \Throwable $e ) {
    echo json_encode( [ 'status'=>'failed', 'msg'=>$e->getMessage() ] );
}
?>