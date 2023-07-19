<?php 
require_once('../config.php');
$stmt = $mysqli->prepare("INSERT INTO `data_obat`(`nama`, `kategori`, `tgl_exp`, `stok`, `jenis`) VALUES (?,?,?,?,?)");
$stmt->bind_param('sssss',$_POST['nama'],$_POST['kategori'],$_POST['tgl_exp'],$_POST['stok'],$_POST['jenis']);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{
    echo json_encode(['status'=>'failed','msg'=>$mysqli->error]);
}
?>