<?php 
require_once('../../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare("UPDATE `jadwal_dokter` SET `jam`=?,`hari`=?,`kuota_pasien`=? WHERE `id`=?");
$stmt->bind_param('sssi',$_POST['jam'],$_POST['hari'],$_POST['kuota_pasien'],$id);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success']);
}
else{

    echo json_encode(['status'=>'failed','error'=>$mysqli->error]);

}
?>