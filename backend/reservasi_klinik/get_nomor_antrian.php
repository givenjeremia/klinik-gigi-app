<?php 
require_once('../config.php');
$tanggal_reservasi = $_POST['tanggal_reservasi'];
$id_jadwal_dokter = $_POST['id_jadwal_dokter'];
$stmt_antrian = $mysqli->prepare('SELECT MAX(`no_antrian`)+1 as NoAntrian FROM `reservasi_kllinik` WHERE `tanggal_reservasi`=? AND `jadwal_dokter_id`=?');
$stmt_antrian->bind_param('si',$tanggal_reservasi,$id_jadwal_dokter);
$stmt_antrian->execute();
$result_antrian = $stmt_antrian->get_result();
$data_antrian = $result_antrian->fetch_assoc();
$no_antrian = 1;
if ($data_antrian['NoAntrian']!= null) {
    $no_antrian = $data_antrian['NoAntrian'];
}
echo json_encode(['status' => 'success','no_antrian' => $no_antrian ,'tanggal'=>$tanggal_reservasi]);
?>