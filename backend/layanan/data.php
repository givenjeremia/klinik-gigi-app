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
$result = $mysqli->query('SELECT l.*, s.nama as spesialis_nama FROM `layanan` l LEFT JOIN `spesialis` s ON s.id = l.spesialis_id');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =[
            'id'=> $row['id'],
            'nama'=> $row['nama'],
            'jenis'=> $row['jenis'],
            'harga'=> $row['harga'],
            'spesialis'=> $row['spesialis_nama'] ? $row['spesialis_nama'] : 'Umum',
            // 'hari_dokter'=> $hari_list[$row['hari_dokter']],
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