<?php 
// Untuk Memanggil Database Connetion
require_once('../config.php');
// Merupakan Syntax Query
$result = $mysqli->query('SELECT dd.*, s.nama as spesialis_nama FROM `data_dokter` dd LEFT JOIN `spesialis` s ON s.id = dd.spesialis_id');
// Menyiapkan Array Kosong Untung Menampung Response
$datas = [];
// Cek Apakah Ada Isinya Jika Tidak Dia Gagal
if ($result->num_rows > 0) {
    // Lakukan Pengulangan untuk Mendampatkan Data
    while($row = $result->fetch_assoc()) {
        // Data Ditampung pada array tampung bernama data
        // Dimana terdapat pengecekan jika jenis kelamin dari database adalah L maka dia Laki Laki
        // Dimana Terdapat Pengejakan Spesialis Jika User Mempunyai Spesialis Maka Tulis Nama Spesialis nya jika tidak punya berarti umum
        $data =[
            'id'=> $row['id'],
            'nama'=> $row['nama'],
            'alamat'=> $row['alamat'],
            'no_telp'=> $row['no_telp'],
            'jenis_kelamin'=> $row['jenis_kelamin'] == 'L' ? 'Laki - Laki' : 'Perempuan',
            'spesialis' =>  $row['spesialis_nama'] ? $row['spesialis_nama'] : 'Umum',
        ];
        // Push array tampung data array response yaitu datas dengan status oke
        array_push($datas,[
            'status'=> 'oke',
            'data'=>$data
        ]);
    }
  } else {
    // Push response pada datas dengan status gagal
    array_push($datas,[
        'status'=> 'gagal',
    ]);
  }
//   Jika sudah echo dan buat array menjadi json 
echo json_encode($datas);
?>