<?php 
require_once('../config.php');
session_start();
$hari_list = [
    'Sunday'=> 'Minggu',
    'Monday' => 'Senin',
    'Tuesday'=> 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];
$result = $mysqli->query('SELECT * FROM `layanan`');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =[
            'id'=> $row['id'],
            'nama'=> $row['nama'],
            'jenis'=> $row['jenis'],
            'harga'=> $row['harga'],
            'hari_dokter'=> $hari_list[$row['hari_dokter']],
        ];
        array_push($datas,[
            'status'=> 'oke',
            'data'=>$data,
            'role' => $_SESSION['auth']['role']
        ]);
    }
  } else {
    array_push($datas,[
        'status'=> 'gagal',
    ]);
  }
echo json_encode($datas);
?>