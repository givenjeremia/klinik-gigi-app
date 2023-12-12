<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT nomor_gigi FROM new_odontogram GROUP BY nomor_gigi;');
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