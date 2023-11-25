<?php 
require_once('../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare('SELECT rm.*, rk.data_pasien_id_pasien as IdPasien FROM `rekam_medis` rm INNER JOIN `reservasi_kllinik` rk ON rm.reservasi_kllinik_id = rk.id WHERE rk.status_kehadiran = "hadir" AND rk.data_pasien_id_pasien=?');
$stmt->bind_param('i',$id);
$stmt->execute();
$datas = [];
$result = $stmt->get_result();
if (1 > 0) {
    while($row = $result->fetch_assoc() ) {
        array_push($datas,[
            'status'=> 'success',
            'data'=>$row
        ]);
    }
  } else {
    array_push($datas,[
        'status'=> 'gagal',
    ]);
  }
echo json_encode($datas);
?>