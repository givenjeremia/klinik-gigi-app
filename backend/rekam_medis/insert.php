<?php
require_once( '../config.php' );
session_start();
$mysqli->begin_transaction();
try {
    if ( isset( $_POST[ 'keluhan' ] )  && isset( $_POST[ 'diagnosa' ]  ) && isset( $_POST[ 'total_biaya' ] ) && isset( $_POST[ 'reservasi' ] ) && isset( $_POST[ 'jadwal_dokter_id' ] ) )  {
        $tanggal_pemeriksaan = date('Y-m-d');
        // $biaya_tindakan = str_replace('.','',$_POST[ 'biaya_tindakan' ]);
        // Insert Rekam Medis
        $sql_rekam_medis = 'INSERT INTO `rekam_medis`(`keluhan`, `diagnosa`, `total_tarif`, `tanggal_pemeriksaan`, `reservasi_kllinik_id`, `jadwal_dokter_id`) VALUES (?,?,?,?,?,?)';
        $stmt_rekam_medis = $mysqli->prepare( $sql_rekam_medis );
        $stmt_rekam_medis->bind_param( 'ssdsii', $_POST[ 'keluhan' ], $_POST[ 'diagnosa' ], $_POST[ 'total_biaya' ], $tanggal_pemeriksaan, $_POST[ 'reservasi' ], $_POST[ 'jadwal_dokter_id' ] );
        $stmt_rekam_medis->execute();
        $new_id_rekam_medis = $mysqli->insert_id;
        // Insert Data Rekam Alat
        if(isset($_POST[ 'alat' ])){
            $alat = $_POST[ 'alat' ];
            foreach ( $alat as $key => $value ) {
                $sql_alat = 'INSERT INTO `rekam_medis_has_alat`(`rekam_medis_id`, `alat_id`, `jumlah_pemakaian`, `harga`, `keterangan`) VALUES (?,?,?,?,?)';
                $stmt_alat = $mysqli->prepare( $sql_alat );
                $stmt_alat->bind_param( 'iiids', $new_id_rekam_medis, $value[ 'id_alat' ], $value[ 'pemakaian' ], $value[ 'harga_alat' ], $value[ 'keterangan' ] );
                $stmt_alat->execute();
            }
        }

        // Insert Lampiran Jika Ada
        if(isset($_FILES["lampiran"])) {
            $targetDirectory = "../../assets/uploads/rekam_medis/".$new_id_rekam_medis.'/'; // Create a directory to store uploaded files
            $targetFile = $targetDirectory . basename($_FILES["lampiran"]["name"]);
            if (!file_exists($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);
            }
            chmod($targetDirectory, 0777);
            move_uploaded_file($_FILES["lampiran"]["tmp_name"], $targetFile);
        }

        // Insert Data Rekam Layanan
        // $sql_layanan = 'INSERT INTO `rekam_medis_has_layanan`(`rekam_medis_id`, `layanan_id`) VALUES (?,?)';
        // $stmt_layanan = $mysqli->prepare( $sql_layanan );
        // $stmt_layanan->bind_param( 'ii', $new_id_rekam_medis, $_POST[ 'layanan' ] );
        // $stmt_layanan->execute();
        // Insert Data Tindakan
        if (isset($_POST[ 'tindakan' ])) {
            $tindakan = $_POST[ 'tindakan' ];
            foreach ( $tindakan as $key => $value ) {
                $sql_tindakan = 'INSERT INTO `tindakan`(`rekam_medis_id`, `layanan_id`, `jumlah`, `catatan`) VALUES (?,?,?,?)';
                $stmt_tindakan = $mysqli->prepare( $sql_tindakan );
                $stmt_tindakan->bind_param( 'iiss', $new_id_rekam_medis, $value[ 'id_layanan' ],  $value[ 'jumlah' ], $value[ 'keterangan_tindakan' ]);
                $stmt_tindakan->execute();
            }
        }
        // Insert Resep
        if (isset($_POST[ 'obat' ])) {
            $obat = $_POST[ 'obat' ];
            $status_kesediaan = 1;
            $status = 0;
            foreach ( $obat as $key => $value ) {
                $sql_resep = 'INSERT INTO `resep_obat`(`rekam_medis_id`, `data_obat_id`, `jumlah_pemakaian`, `harga`, `keterangan`, `aturan_pakai`,`status_kesediaan`,`status`) VALUES (?,?,?,?,?,?,?,?)';
                $stmt_resep = $mysqli->prepare( $sql_resep );
                $stmt_resep->bind_param( 'iiidssii', $new_id_rekam_medis, $value[ 'id_obat' ],  $value[ 'jumlah' ], $value[ 'total_harga' ], $value[ 'keterangan' ], $value[ 'aturan_pakai' ],$status_kesediaan,$status);
                $stmt_resep->execute();
            }
        }
        // Add Nota
        $sql_nota = 'INSERT INTO `nota`(`rekam_medis_id`) VALUES (?)';
        $stmt_nota = $mysqli->prepare( $sql_nota );
        $stmt_nota->bind_param( 'i', $new_id_rekam_medis);
        $stmt_nota->execute();
        $mysqli->commit();
        echo json_encode( [ 
            'status' => 'success', 
            'msg' => 'Berhasil Tambah Rekam Medis',
            'data'=>$new_id_rekam_medis,
            'tanggal' => date('d F y',strtotime($tanggal_pemeriksaan)),
        ] );
    } else {
        echo json_encode( [ 'status' => 'failed', 'msg' => 'Harap Periksa Inputan'] );
    }
} catch ( \Throwable $th ) {
    $mysqli->rollback();
    echo json_encode( [ 'status' => 'failed', 'msg' => 'Gagal Tambah Rekam Medis', 'error' => $th->getMessage() ] );
}
