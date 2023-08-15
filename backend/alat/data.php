<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT * FROM `alat`');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =[
            'id'=> $row['id'],
            'nama'=> $row['nama'],
            'jenis'=> $row['jenis'],
            'kategori'=> $row['kategori'],
            'harga'=> $row['harga'],
        ];
        array_push($datas,[
            'status'=> 'oke',
            'data'=>$data
        ]);
    }
  } else {
    array_push($datas,[
        'status'=> 'gagal',
    ]);
  }
echo json_encode($datas);
?>