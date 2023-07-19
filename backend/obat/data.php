<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT * FROM `data_obat`');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =[
            'id'=> $row['id'],
            'nama'=> $row['nama'],
            'kategori'=> $row['kategori'],
            'tgl_exp'=> $row['tgl_exp'],
            'stok'=> $row['stok'],
            'jenis'=> $row['jenis'],
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