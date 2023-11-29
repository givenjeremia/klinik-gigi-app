<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT dd.*, s.nama as spesialis_nama FROM `data_dokter` dd LEFT JOIN `spesialis` s ON s.id = dd.spesialis_id');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =[
            'id'=> $row['id'],
            'nama'=> $row['nama'],
            'alamat'=> $row['alamat'],
            'no_telp'=> $row['no_telp'],
            'jenis_kelamin'=> $row['jenis_kelamin'] == 'L' ? 'Laki - Laki' : 'Perempuan',
            'spesialis' =>  $row['spesialis_nama'] ? $row['spesialis_nama'] : 'Umum',
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