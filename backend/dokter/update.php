<?php 
require_once('../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare("UPDATE `data_dokter` SET `nama`=?,`alamat`=?,`no_telp`=?,`jenis_kelamin`=?,`username`=?,`password`=? WHERE `id`=?");
$stmt->bind_param('ssisssi',$_POST['nama'],$_POST['alamat'],$_POST['no_telp'],$_POST['jenis_kelamin'],$_POST['username'],$_POST['password'],$id);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{

    echo json_encode(['status'=>'failed','error'=>$mysqli->error]);

}
?>