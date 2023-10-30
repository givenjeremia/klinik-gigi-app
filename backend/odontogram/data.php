<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT * FROM `odontogram` o INNER JOIN `rekam_medis`rm ON rm.id = o.rekam_medis_id INNER JOIN `data_pasien` dp ON dp.id = o.data_pasien_id');
$datas = [];
if ($result->num_rows > 0) {
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