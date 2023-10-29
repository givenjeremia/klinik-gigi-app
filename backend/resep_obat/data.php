<?php 
require_once('../config.php');
session_start();

$role = $_SESSION[ 'auth' ][ 'role' ];

$sql = '';
if($role == 'pasien'){
  $id_user = $_SESSION[ 'auth' ][ 'id' ];
  $stmt_pasien = $mysqli->prepare( 'SELECT * FROM `data_pasien` WHERE `user_id` =?' );
  $stmt_pasien->bind_param( 'i', $id_user );
  $stmt_pasien->execute();
  $result_pasien = $stmt_pasien->get_result();
  $data_pasien = $result_pasien->fetch_assoc();
  $id_pasien = $data_pasien[ 'id' ];
  $sql = "SELECT rm.*,dp.nama as NamaPasien, group_concat(DISTINCT o.nama ORDER BY o.nama DESC SEPARATOR ', ') as Obat, SUM(ro.harga) as TotalHargaObat
  FROM `rekam_medis` rm
  INNER JOIN `resep_obat` ro ON rm.id = ro.rekam_medis_id
  INNER JOIN `data_obat` o ON ro.data_obat_id = o.id
  INNER JOIN `reservasi_kllinik` rk ON rk.id = rm.reservasi_kllinik_id
  INNER JOIN `data_pasien` dp ON dp.id = rk.data_pasien_id_pasien
  WHERE ro.status = 1 and dp.id = $id_pasien
  GROUP BY rm.id";
}
else{
  $sql = "SELECT rm.*,dp.nama as NamaPasien, group_concat(DISTINCT o.nama ORDER BY o.nama DESC SEPARATOR ', ') as Obat, SUM(ro.harga) as TotalHargaObat
  FROM `rekam_medis` rm
  INNER JOIN `resep_obat` ro ON rm.id = ro.rekam_medis_id
  INNER JOIN `data_obat` o ON ro.data_obat_id = o.id
  INNER JOIN `reservasi_kllinik` rk ON rk.id = rm.reservasi_kllinik_id
  INNER JOIN `data_pasien` dp ON dp.id = rk.data_pasien_id_pasien
  WHERE ro.status = 1
  GROUP BY rm.id";
}

$result = $mysqli->query($sql);
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($datas,[
            'status'=> 'oke',
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