<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT * FROM `new_odontogram` o INNER JOIN `action_odontogram` ao ON o.action_odontogram_id = ao.id;');
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