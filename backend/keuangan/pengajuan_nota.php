<?php
require_once( '../config.php' );
session_start();
try {
    $sql = "SELECT n.id as IdNota, n.status as StatusNota, rm.id as IdRekamMedis, dp.id as IdPasien, dp.nama as NamaPasien, rm.tanggal_pemeriksaan as TanggalPemeriksaan, rm.total_tarif as TotalTarif
FROM `nota` n INNER JOIN `rekam_medis` rm ON n.rekam_medis_id = rm.id
INNER JOIN `reservasi_kllinik` rk ON rm.reservasi_kllinik_id = rk.id
INNER JOIN `data_pasien` dp ON dp.id = rk.data_pasien_id_pasien
WHERE n.status = 'pending'";
    $result = $mysqli->query( $sql );
    $datas = [];
    if ( $result->num_rows > 0 ) {
        $tamps = [];
        while( $row = $result->fetch_assoc() ) {
            array_push( $tamps, $row );
        }
        array_push( $datas, [
            'status'=> 'oke',
            'data'=>$tamps
        ] );
    } else {
        array_push( $datas, [
            'status'=> 'gagal',
        ] );
    }
    echo json_encode( $datas );

} catch ( \Throwable $th ) {
    //throw $th;
    array_push($datas,[
        'status'=> 'gagal',
        'error'=>$th->getMessage()
    ]);
}
