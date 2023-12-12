<?php 
require_once('../config.php');
$id = $_GET['rekam_medis'];
// $result = $mysqli->query('SELECT * FROM `odontogram` o INNER JOIN `rekam_medis`rm ON rm.id = o.rekam_medis_id INNER JOIN `data_pasien` dp ON dp.id = o.data_pasien_id');
$stmt = $mysqli->prepare('SELECT * FROM `new_odontogram` o INNER JOIN `kondisi_odontogram` ao ON o.kondisi_odontogram_id = ao.id WHERE o.rekam_medis_id =?');
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