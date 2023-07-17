<?php 
require_once('../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare("UPDATE `alat` SET `nama`=?,`jenis`=?,`kategori`=? WHERE `id`=?");
$stmt->bind_param('sssi',$_POST['nama'],$_POST['jenis'],$_POST['kategori'],$id);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{
    echo json_encode(['status'=>'failed','error'=>$mysqli->error]);
}
?>