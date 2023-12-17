<?php 
require_once('../config.php');
$result = $mysqli->query('SELECT dp.nama as NamaPasien,o.*, ko.nama as Kondisi, coalesce(ot.nama, "Tidak Ada") as Tindakan FROM `new_odontogram` o 
INNER JOIN `kondisi_odontogram` ko ON ko.id = o.kondisi_odontogram_id
LEFT JOIN `odontogram_tindakan` ot ON ot.id = o.tindakan_odontogram_id
INNER JOIN `rekam_medis` rm ON rm.id = o.rekam_medis_id
INNER JOIN `reservasi_kllinik` rk ON rk.id = rm.reservasi_kllinik_id
INNER JOIN `data_pasien` dp ON dp.id = rk.data_pasien_id_pasien');
$datas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($datas,[
            'status'=> 'oke',
            'data'=> $row
        ]);
    }
  } else {
    array_push($datas,[
        'status'=> 'gagal',
    ]);
  }
echo json_encode($datas);
?>