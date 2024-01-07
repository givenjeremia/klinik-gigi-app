<?php
require_once('../../backend/config.php');
$id_nota = $_GET['id_nota'];
$sql_nota = "SELECT n.*,rm.keluhan as Keluhan, rm.tindakan as Tindakan, rm.biaya_tindakan as BiayaTindakan, rm.diagnosa as Diagnosa, dk.nama AS NamaKaryawan, dp.nama as NamaPasien
FROM nota n INNER JOIN rekam_medis rm ON n.rekam_medis_id = rm.id
INNER JOIN data_karyawan dk ON dk.id = n.data_karyawan_id
INNER JOIN reservasi_kllinik rk ON rk.id = rm.reservasi_kllinik_id
INNER JOIN data_pasien dp ON dp.id = rk.data_pasien_id_pasien
WHERE n.id=?";
$stmt_nota = $mysqli->prepare($sql_nota);
$stmt_nota->bind_param('i',$id_nota);
$stmt_nota->execute();
$result_nota = $stmt_nota->get_result();
$data_nota = $result_nota->fetch_assoc();
$id_rekam_medis = $data_nota['rekam_medis_id'];

$sql_obat = "SELECT rs.*, d_o.nama as NamaObat
FROM resep_obat rs 
INNER JOIN data_obat d_o ON rs.data_obat_id = d_o.id
WHERE rs.status_kesediaan=1 AND rs.rekam_medis_id =? AND rs.status_bayar=1";
$stmt_obat = $mysqli->prepare($sql_obat);
$stmt_obat->bind_param('i',$id_rekam_medis);
$stmt_obat->execute();
$result_obat = $stmt_obat->get_result();

$sql_alat = "SELECT rma.*, a.nama as NamaAlat
FROM rekam_medis_has_alat rma
INNER JOIN alat a ON a.id = rma.alat_id
WHERE rma.rekam_medis_id =?";
$stmt_alat = $mysqli->prepare($sql_alat);
$stmt_alat->bind_param('i',$id_rekam_medis);
$stmt_alat->execute();
$result_alat = $stmt_alat->get_result();

$sql_tindakan = "SELECT t.*, l.nama as NamaTindakan, l.harga as HargaTindakan 
FROM `tindakan` t INNER JOIN `layanan` l ON l.id = t.layanan_id
WHERE t.rekam_medis_id =?";
$stmt_tindakan = $mysqli->prepare($sql_tindakan);
$stmt_tindakan->bind_param('i',$id_rekam_medis);
$stmt_tindakan->execute();
$result_tindakan = $stmt_tindakan->get_result();

// $sql_layanan = "SELECT l.nama AS NamaLayanan
// FROM rekam_medis_has_layanan rml
// INNER JOIN layanan l ON l.id = rml.layanan_id
// WHERE rml.rekam_medis_id =?";
// $stmt_layanan = $mysqli->prepare($sql_layanan);
// $stmt_layanan->bind_param('i',$id_rekam_medis);
// $stmt_layanan->execute();
// $result_layanan = $stmt_layanan->get_result();
// $data_layanan = $result_layanan->fetch_assoc();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Nota</title>
    <style>
        table {
            max-width: 100%;
            max-height: 100%;
        }

        body {
            padding: 5px;
            position: relative;
            width: 100%;
            height: 100%;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table .kop:before {
            content: ': ';
        }

        .left {
            text-align: left;
        }

        table #caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table.border {
            width: 100%;
            border-collapse: collapse
        }

        table.border tbody th,
        table.border tbody td {
            border: thin solid #000;
            padding: 2px
        }

        .ttd td,
        .ttd th {
            padding-bottom: 4em;
        }
        @media print{@page {size: landscape}}
    </style>
</head>

<body>

    <div id='printable' class='container'>
        <table border='0' cellpadding='0' cellspacing='0' width='485' class='border' style='overflow-x:auto;'>
            <thead>
                <tr>
                    <td colspan='6' width='485' id='caption'>KLINIK GIGI</td>
                </tr>
                <tr>
                    <td colspan='2'>Nama Pasien : </td>
                    <td class='left kop'><?= $data_nota['NamaPasien'] ?></td>
                    <td></td>
                    <td>Tanggal : </td>
                    <td class='left kop'><?= date('d F y', strtotime($data_nota['tanggal'])) ?></td>
                </tr>
                <tr>
                    <td colspan='2'>No Nota : </td>
                    <td class='left kop'><?= $id_nota ?></td>
                    <td></td>
                    <td>Pembuat Nota : </td>
                    <td class='left kop'><?= $data_nota['NamaKaryawan'] ?></td>
                </tr>
                <tr>
                    <td colspan='2'>Keluhan : </td>
                    <td class='left kop'><?= $data_nota['Keluhan'] ?></td>
                    <td></td>
                    <td>Diagnosa : </td>
                    <td class='left kop'><?= $data_nota['Diagnosa'] ?></td>
                </tr>
                <tr>
                    <!-- <td colspan='2'>Layanan : </td>
                    <td class='left kop'><?= $data_layanan['NamaLayanan'] ?></td> -->
                    <td></td>
                    <td>Jenis Pembayaran : </td>
                    <td class='left kop'><?= $data_nota['jenis_pembayaran'] ?></td>
                </tr>
            
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>No</th>
                    <th>TINDAKAN</th>
                    <th>JUMLAH</th>
                    <th>TOTAL</th>
                    <th colspan='2'>KETERANGAN</th>
                </tr>
                <tr>
                <?php 
                    $counter = 1;
                    while($row = $result_tindakan->fetch_assoc() ) :?>
                    <tr>
                        <td align='right'><?=  $counter ?></td>
                        <td><?=  $row['NamaTindakan'] ?></td>
                        <td align='right'><?=  $row['jumlah'] ?></td>
                        <td>Rp. <?= number_format($row['HargaTindakan']) ?></td>
                        <td colspan='2'><?=  $row['catatan'] ?></td>
                    </tr>
                    <?php $counter = $counter + 1; ?>
                    <?php endwhile; ?>
                </tr>
                <tr>
                    <th>No</th>
                    <th>OBAT</th>
                    <th>JUMLAH</th>
                    <th>TOTAL</th>
                    <th colspan='2'>KETERANGAN</th>
                </tr>
                <?php 
                $counter = 1;
                while($row = $result_obat->fetch_assoc() ) :?>
                <tr>
                    <td align='right'><?=  $counter ?></td>
                    <td><?=  $row['NamaObat'] ?></td>
                    <td align='right'><?=  $row['jumlah_pemakaian'] ?></td>
                    <td>Rp. <?= number_format($row['harga']) ?></td>
                    <td colspan='2'><?=  $row['keterangan'] ?></td>
                </tr>
                <?php $counter = $counter + 1; ?>
                <?php endwhile; ?>
                <tr>
                    <th>No</th>
                    <th>ALAT</th>
                    <th>JUMLAH</th>
                    <th>TOTAL</th>
                    <th colspan='2'>KETERANGAN</th>
                </tr>
                <?php 
                $counter = 1;
                while($row = $result_alat->fetch_assoc() ) :?>
                <tr>
                    <td align='right'><?=  $counter ?></td>
                    <td><?=  $row['NamaAlat'] ?></td>
                    <td align='right'><?=  $row['jumlah_pemakaian'] ?></td>
                    <td>Rp. <?= number_format($row['harga']) ?></td>
                    <td colspan='2'><?=  $row['keterangan'] ?></td>
                </tr>
                <?php $counter = $counter + 1; ?>
                <?php endwhile; ?>
                <tr>
                    <th colspan='3'>BIAYA ADMIN</th>
                    <td>Rp. <?= number_format(10000) ?></td>
                    <td colspan='2'></td>
                </tr>
                <tr>
                    <th colspan='3'> TOTAL</th>
                    <td>Rp. <?= number_format($data_nota['total_pembayaran']) ?></td>
                    <td colspan='2'></td>
                </tr>
            </tbody>

        </table>
    </div>

    <script>
        window.print();
        window.onfocus = function() {
            window.close();
        }
    </script>

</body>

</html>