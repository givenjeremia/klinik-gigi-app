<?php 
require_once('../config.php');
$id = $_GET['id'];
// $result = $mysqli->query('SELECT * FROM `odontogram` o INNER JOIN `rekam_medis`rm ON rm.id = o.rekam_medis_id INNER JOIN `data_pasien` dp ON dp.id = o.data_pasien_id');
$stmt = $mysqli->prepare('SELECT o.*,rm.*,dp.*,o.id as IdOdontogram FROM `odontogram` o INNER JOIN `rekam_medis`rm ON rm.id = o.rekam_medis_id INNER JOIN `data_pasien` dp ON dp.id = o.data_pasien_id WHERE rm.id=?');
$stmt->bind_param('i',$id);
$stmt->execute();
$datas = [];
$result = $stmt->get_result();
if ($stmt->affected_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($datas,[
            'status'=> 'oke',
            'data'=> $row
        ]);
    }
  } else {
    array_push($datas,[
        'status'=> 'gagal',
    ]);
  }
echo json_encode($datas);
?>