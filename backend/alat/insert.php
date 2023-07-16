<?php 
require_once('../config.php');
$stmt = $mysqli->prepare("INSERT INTO `alat`(`nama`, `jenis`, `kategori`) VALUES (?,?,?)");
$stmt->bind_param('sss',$_POST['nama'],$_POST['jenis'],$_POST['kategori']);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{
    echo json_encode(['status'=>'failed']);
}
?>