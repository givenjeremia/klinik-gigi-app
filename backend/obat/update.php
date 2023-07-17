<?php 
require_once('../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare("UPDATE `data_karyawan` SET `nama`=?,`alamat`=?,`no_telp`=?,`username`=?,`password`=? WHERE `id`=?");
$stmt->bind_param('ssissi',$_POST['nama'],$_POST['alamat'],$_POST['no_telp'],$_POST['username'],$_POST['password'],$id);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{

    echo json_encode(['status'=>'failed','error'=>$mysqli->error]);

}
?>