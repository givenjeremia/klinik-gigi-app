<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT jd.id as idJadwal,dd.id as idDokter, dd.nama as namaDokter, jd.jam , jd.hari, jd.kuota_pasien FROM `jadwal_dokter` jd INNER JOIN `data_dokter` dd ON jd.data_dokter_id = dd.id');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =[
            'id'=> $row['idJadwal'],
            'id_dokter'=> $row['idDokter'],
            'nama_dokter'=> $row['namaDokter'],
            'jam'=> $row['jam'],
            'hari'=> $row['hari'],
            'kuota_pasien'=> $row['kuota_pasien'],
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