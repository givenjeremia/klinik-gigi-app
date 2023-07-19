<?php 
require_once('../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare("UPDATE `data_obat` SET `nama`=?,`kategori`=?,`tgl_exp`=?,`stok`=?,`jenis`=? WHERE `id`=?");
$stmt->bind_param('sssssi',$_POST['nama'],$_POST['kategori'],$_POST['tgl_exp'],$_POST['stok'],$_POST['jenis'],$id);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success','nama'=>$_POST['nama']]);
}
else{

    echo json_encode(['status'=>'failed','error'=>$mysqli->error]);

}
?>