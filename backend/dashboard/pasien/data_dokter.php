<?php 
require_once('../../config.php');
$day_now = date("l");
$sql = "SELECT dd.id as id_dokter, dd.nama as nama_dokter, jd.id as id_jadwal , jd.jam as jam, jd.hari as hari, jd.kuota_pasien as kuota FROM `data_dokter` dd INNER JOIN `jadwal_dokter` jd ON dd.id = jd.data_dokter_id WHERE jd.hari = '$day_now'";
$result = $mysqli->query($sql);
$datas = [];
if ($result->num_rows > 0) {
    $tamps = [];
    while($row = $result->fetch_assoc()) {

       array_push($tamps,$row);
    }
    array_push($datas,[
      'status'=> 'oke',
      'data'=>$tamps
  ]);
  } else {
    array_push($datas,[
        'status'=> 'gagal',
    ]);
  }
echo json_encode($datas);



?> 