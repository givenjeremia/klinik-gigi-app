<?php 
require_once('../../config.php');
$id = $_POST['id'];
$stmt = $mysqli->prepare('SELECT * FROM `jadwal_dokter` WHERE `id` =?');
$stmt->bind_param('i',$id);
$stmt->execute();
$datas = [];
$result = $stmt->get_result();
if ($result->num_rows > 0) {
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