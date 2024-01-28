<?php 
require_once('../config.php');
//GET ID
$id = $_POST['id'];
 // cek Apakah dia termasuk spesialis umum atau tidak 
 if ($_POST['spesialis'] == 'umum') {
     $stmt = $mysqli->prepare("UPDATE `data_dokter` SET `nama`=?,`alamat`=?,`no_telp`=?,`jenis_kelamin`=? WHERE `id`=?");
     $stmt->bind_param('ssssi', $_POST['nama'], $_POST['alamat'], $_POST['no_telp'], $_POST['jenis_kelamin'], $id);
     $stmt->execute();
 } else {
     $stmt = $mysqli->prepare("UPDATE `data_dokter` SET `nama`=?,`alamat`=?,`no_telp`=?,`jenis_kelamin`=? ,`spesialis_id`=? WHERE `id`=?");
     $stmt->bind_param('ssssii', $_POST['nama'], $_POST['alamat'], $_POST['no_telp'], $_POST['jenis_kelamin'], $_POST['spesialis'],$id);
     $stmt->execute();
 }
//  Cek Apakah Query Berhasil Dijalankan
$jumlah_yang_dieksekusi = $stmt->affected_rows;
// Jika Berhasil Kirim kan Status Success
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success']);
}
else{
    echo json_encode(['status'=>'failed','error'=>$mysqli->error]);

}
?>