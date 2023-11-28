<?php 
require_once('../config.php');
$id = $_POST['id'];
$id2 = $_POST['id_reservasi'];
$stmt = $mysqli->prepare('SELECT jd.id as JadwalID, rk.jam_reservasi AS Jam, rk.tanggal_reservasi as Tanggal, dd.* , coalesce(s.nama, "Umum") as spesialis_nama 
FROM `jadwal_dokter` jd INNER JOIN `data_dokter` dd ON jd.data_dokter_id = dd.id 
LEFT JOIN `spesialis` s ON s.id = dd.spesialis_id 
INNER JOIN `reservasi_kllinik` rk ON rk.jadwal_dokter_id = jd.id
WHERE jd.id=? AND rk.id=?');
$stmt->bind_param('ii',$id,$id2);
$stmt->execute();
$datas = [];
$result = $stmt->get_result();
if (1 > 0) {
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