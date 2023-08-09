<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT * FROM `data_pasien`');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =[
            'id'=> $row['id'],
            'nama'=> $row['nama'],
            'usia'=> $row['usia'],
            'tempat_tanggal_lahir'=> $row['tempat_tanggal_lahir'],
            'alamat'=> $row['alamat'],
            'no_telp'=> $row['no_telp'],
            'tanggal_daftar' => $row['tanggal_daftar'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'user_id' => $row['user_id'],
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