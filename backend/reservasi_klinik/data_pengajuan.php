<?php
require_once( '../config.php' );
session_start();
try {
    $sql = "SELECT rk.id AS IdReservasi, rk.jadwal_dokter_id as IdJadwal , jd.kuota_pasien as KuotaPasien ,dd.nama AS NamaDokter, dp.nama AS NamaPasien, rk.jam_reservasi AS Jam, rk.tanggal_reservasi AS Tanggal, rk.status as Status
    FROM `reservasi_kllinik` rk INNER JOIN `data_pasien` dp ON rk.data_pasien_id_pasien = dp.id
    INNER JOIN `jadwal_dokter` jd ON jd.id = rk.jadwal_dokter_id
    INNER JOIN `data_dokter` dd ON jd.data_dokter_id = dd.id
    WHERE rk.status = 'pending'";
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
