<?php 
require_once('../config.php');
$stmt = $mysqli->prepare("INSERT INTO `data_dokter`(`nama`, `alamat`, `no_telp`, `jenis_kelamin`, `username`, `password`) VALUES (?,?,?,?,?,?)");
$stmt->bind_param('ssisss',$_POST['nama'],$_POST['alamat'],$_POST['no_telp'],$_POST['jenis_kelamin'],$_POST['username'],$_POST['password']);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{
    echo json_encode(['status'=>'failed']);
}
?>