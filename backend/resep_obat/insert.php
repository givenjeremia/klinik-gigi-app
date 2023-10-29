<?php
require_once( '../config.php' );
session_start();
$mysqli->begin_transaction();
try {
    if ( isset( $_POST[ 'rekam_medis' ] ) && isset( $_POST[ 'obat' ] ) )  {
        $id_rekam_medis = $_POST[ 'rekam_medis' ];
        // Insert Resep
        $obat = $_POST[ 'obat' ];
        $status = 1;
        foreach ( $obat as $key => $value ) {

            $sql_resep = 'INSERT INTO `resep_obat`(`rekam_medis_id`, `data_obat_id`, `jumlah_pemakaian`, `harga`, `keterangan`, `aturan_pakai`,`status`) VALUES (?,?,?,?,?,?,?)';
            $stmt_resep = $mysqli->prepare( $sql_resep );
            $stmt_resep->bind_param( 'iiidssi',  $id_rekam_medis, $value[ 'id_obat' ],  $value[ 'jumlah' ], $value[ 'total_harga' ], $value[ 'keterangan' ], $value[ 'aturan_pakai' ], $status);
            $stmt_resep->execute();
        }

        $mysqli->commit();
        echo json_encode( [ 'status' => 'success', 'msg' => 'Berhasil Tambah Resep Obat' ] );
    } else {
        echo json_encode( [ 'status' => 'failed', 'msg' => 'Harap Periksa Inputan'] );
    }
} catch ( \Throwable $th ) {
    $mysqli->rollback();
    echo json_encode( [ 'status' => 'failed', 'msg' => 'Gagal Tambah Resep Obat', 'error' => $th->getMessage() ] );
}
