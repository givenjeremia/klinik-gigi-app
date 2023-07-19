<?php 
require_once('../../config.php');
$stmt = $mysqli->prepare("INSERT INTO `jadwal_dokter`( `jam`, `hari`, `kuota_pasien`, `data_dokter_id`) VALUES (?,?,?,?)");
$stmt->bind_param('sssi',$_POST['jam'],$_POST['hari'],$_POST['kuota_pasien'],$_POST['data_dokter']);
$stmt->execute();
$jumlah_yang_dieksekusi = $stmt->affected_rows;
if($jumlah_yang_dieksekusi > 0){
    echo json_encode(['status'=>'success']);
}
else{
    echo json_encode(['status'=>'failed']);
}
?>