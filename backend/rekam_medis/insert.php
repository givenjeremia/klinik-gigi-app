<?php
require_once( '../config.php' );
session_start();
$mysqli->begin_transaction();
try {
    if ( isset( $_POST[ 'keluhan' ] ) && isset( $_POST[ 'diagnosa' ] ) && isset( $_POST[ 'tindakan' ] ) && isset( $_POST[ 'total_biaya' ] ) && isset( $_POST[ 'tanggal_pemeriksaan' ] ) && isset( $_POST[ 'reservasi' ] ) && isset( $_POST[ 'jadwal_dokter_id' ] ) && isset( $_POST[ 'layanan' ] ) ) {
        // Insert Rekam Medis
        $sql_rekam_medis = 'INSERT INTO `rekam_medis`(`keluhan`, `diagnosa`, `tindakan`, `total_tarif`, `tanggal_pemeriksaan`, `reservasi_kllinik_id`, `jadwal_dokter_id`) VALUES (?,?,?,?,?,?,?)';
        $stmt_rekam_medis = $mysqli->prepare( $sql_rekam_medis );
        $stmt_rekam_medis->bind_param( 'sssdsii', $_POST[ 'keluhan' ], $_POST[ 'diagnosa' ], $_POST[ 'tindakan' ], $_POST[ 'total_biaya' ], $_POST[ 'tanggal_pemeriksaan' ], $_POST[ 'reservasi' ], $_POST[ 'jadwal_dokter_id' ] );
        $stmt_rekam_medis->execute();
        $new_id_rekam_medis = $mysqli->insert_id;
        // Insert Data Rekam Alat
        $alat = $_POST[ 'alat' ];
        foreach ( $alat as $key => $value ) {
            $sql_alat = 'INSERT INTO `rekam_medis_has_alat`(`rekam_medis_id`, `alat_id`, `jumlah_pemakaian`, `harga`, `keterangan`) VALUES (?,?,?,?,?)';
            $stmt_alat = $mysqli->prepare( $sql_alat );
            $stmt_alat->bind_param( 'iiids', $new_id_rekam_medis, $value[ 'id_alat' ], $value[ 'pemakaian' ], $value[ 'harga_alat' ], $value[ 'keterangan' ] );
            $stmt_alat->execute();
        }
        // Insert Data Rekam Layanan
        $sql_layanan = 'INSERT INTO `rekam_medis_has_layanan`(`rekam_medis_id`, `layanan_id`) VALUES (?,?)';
        $stmt_layanan = $mysqli->prepare( $sql_layanan );
        $stmt_layanan->bind_param( 'ii', $new_id_rekam_medis, $_POST[ 'layanan' ] );
        $stmt_layanan->execute();
        // Insert Resep
        $obat = $_POST[ 'obat' ];
        foreach ( $obat as $key => $value ) {
            $sql_resep = 'INSERT INTO `resep_obat`(`rekam_medis_id`, `data_obat_id`, `jumlah_pemakaian`, `harga`, `keterangan`, `aturan_pakai`) VALUES (?,?,?,?,?,?)';
            $stmt_resep = $mysqli->prepare( $sql_resep );
            $stmt_resep->bind_param( 'iiidss', $new_id_rekam_medis, $value[ 'id_obat' ],  $value[ 'jumlah' ], $value[ 'total_harga' ], $value[ 'keterangan' ], $value[ 'aturan_pakai' ] );
            $stmt_resep->execute();
        }
        $mysqli->commit();
        echo json_encode( [ 'status' => 'success', 'msg' => 'Berhasil Tambah Rekam Medis' ] );
    } else {
        echo json_encode( [ 'status' => 'failed', 'msg' => 'Harap Periksa Inputan'] );
    }
} catch ( \Throwable $th ) {
    $mysqli->rollback();
    echo json_encode( [ 'status' => 'failed', 'msg' => 'Gagal Tambah Rekam Medis', 'error' => $th->getMessage() ] );
}
