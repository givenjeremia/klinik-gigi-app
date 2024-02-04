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
            $kesediaan = 1;
            // Cek  Stok Obat Jika null 
            $stmt_obat = $mysqli->prepare('SELECT * FROM `data_obat` WHERE `id`=?');
            $stmt_obat->bind_param('i',$value[ 'id_obat' ]);
            $stmt_obat->execute();
            $result_obat = $stmt_obat->get_result()->fetch_assoc();
            if ($result_obat['stok'] > 0) {
                $sql_resep = 'INSERT INTO `resep_obat`(`rekam_medis_id`, `data_obat_id`, `jumlah_pemakaian`, `harga`, `keterangan`, `aturan_pakai`,`status`,`status_kesediaan`) VALUES (?,?,?,?,?,?,?,?)';
                $stmt_resep = $mysqli->prepare( $sql_resep );
                $stmt_resep->bind_param( 'iiidssis',  $id_rekam_medis, $value[ 'id_obat' ],  $value[ 'jumlah' ], $value[ 'total_harga' ], $value[ 'keterangan' ], $value[ 'aturan_pakai' ], $status, $kesediaan);
                $stmt_resep->execute();
                // Update Stok
                $stok_now = $result_obat['stok'];
                $stok_sisa = $stok_now - $value[ 'jumlah' ];
                $stmt_obat = $mysqli->prepare('UPDATE `data_obat` SET `stok`=? WHERE `id`=?');
                $stmt_obat->bind_param('si',$stok_sisa,$value[ 'id_obat' ]);
                $stmt_obat->execute();

            }
            else{
                $mysqli->rollback();
                echo json_encode( [ 'status' => 'failed', 'msg' => 'Gagal Tambah Resep Obat, Salah satu obat stok habis' ] );
            }
            
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
