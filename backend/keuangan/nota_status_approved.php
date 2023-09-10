<?php
require_once( '../config.php' );
session_start();
$datas = [];
try {
    $sql = "SELECT n.id as IdNota, n.total_pembayaran as TotalPembayaran, n.jenis_pembayaran as JenisPembayaran, n.tanggal as TanggalNota , n.status as StatusNota, n.rekam_medis_id as IdRekamMedis, dp.id as IdPasien, dp.nama as NamaPasien
FROM `nota` n INNER JOIN `rekam_medis` rm ON n.rekam_medis_id = rm.id
INNER JOIN `reservasi_kllinik` rk ON rm.reservasi_kllinik_id = rk.id
INNER JOIN `data_pasien` dp ON dp.id = rk.data_pasien_id_pasien WHERE n.status = 'approved'";
    $result = $mysqli->query( $sql );

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


} catch ( \Throwable $th ) {
    //throw $th;
    array_push($datas,[
        'status'=> 'gagal',
        'error'=>$th->getMessage()
    ]);
}
echo json_encode( $datas );
