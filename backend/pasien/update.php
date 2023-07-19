<?php 
require_once('../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare("UPDATE `data_pasien` SET `nama`=?,`usia`=?,`tempat_tanggal_lahir`=?,`alamat`=?,`no_telp`=?,`tanggal_daftar`=?,`jenis_kelamin`=?,`username`=?,`password`=? WHERE `id`=?");
$stmt->bind_param('ssssissssi',$_POST['nama'],$_POST['usia'],$_POST['tempat_tanggal_lahir'],$_POST['alamat'],$_POST['no_telp'],$_POST['tanggal_daftar'],$_POST['jenis_kelamin'],$_POST['username'],$_POST['password'],$id);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{

    echo json_encode(['status'=>'failed','error'=>$mysqli->error]);

}
?>