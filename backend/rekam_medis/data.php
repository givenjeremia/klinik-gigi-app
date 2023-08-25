<?php 
require_once('../config.php');
$sql = "SELECT rk.*, dp.*,
group_concat(DISTINCT a.nama ORDER BY a.nama DESC SEPARATOR ', ') as Alat, 
group_concat(DISTINCT l.nama ORDER BY a.nama DESC SEPARATOR ', ') as Layanan,
group_concat(DISTINCT o.nama ORDER BY a.nama DESC SEPARATOR ', ') as Obat
FROM `rekam_medis` rk
INNER JOIN `rekam_medis_has_alat` rmha ON rk.id = rmha.rekam_medis_id
INNER JOIN `alat` a ON a.id = rmha.alat_id
INNER JOIN `rekam_medis_has_layanan` rmhl ON rmhl.rekam_medis_id = rk.id
INNER JOIN `layanan` l ON l.id = rmhl.layanan_id
INNER JOIN `resep_obat` ro ON ro.rekam_medis_id = rk.id
INNER JOIN `data_obat` o ON o.id = ro.data_obat_id
INNER JOIN `reservasi_kllinik` rklinik ON rklinik.id = rk.reservasi_kllinik_id
INNER JOIN `data_pasien` dp ON dp.id = rklinik.data_pasien_id_pasien
GROUP BY rk.id";
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