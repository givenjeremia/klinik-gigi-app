<?php
require_once( '../config.php' );
session_start();
try {
    $currentDate = date('Y-m-d');
    $sql = "SELECT rk.id as IdReservasi, rk.no_antrian as NoAntrian, rk.jadwal_dokter_id  as IdJadwalDokter, dd.nama AS NamaDokter, dp.nama AS NamaPasien,dp.no_telp as NoTelp, rk.jam_reservasi AS Jam, rk.tanggal_reservasi AS Tanggal, rk.status as Status
    FROM `reservasi_kllinik` rk INNER JOIN `data_pasien` dp ON rk.data_pasien_id_pasien = dp.id
    INNER JOIN `jadwal_dokter` jd ON jd.id = rk.jadwal_dokter_id
    INNER JOIN `data_dokter` dd ON jd.data_dokter_id = dd.id WHERE rk.tanggal_reservasi < '$currentDate' AND rk.status = 'approved'";

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
