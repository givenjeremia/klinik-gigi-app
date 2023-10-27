<?php
// memanggil library FPDF
require('../fpdf/fpdf.php');
require_once( '../config.php' );


$id_rekam_medis = $_GET['rekam_medis'];
$nama_pasien = $_GET['nama_pasien'];
// $nama_dokter = $_GET['nama_dokter'];

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(200, 10, 'KLINIK GIGI - RESEP OBAT', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->Cell(10, 15, 'Nama Pasien : '.$nama_pasien, 0, 0);
// $pdf->Cell(10, 8, '', 0, 1);
// $pdf->Cell(10, 15, 'Nama Dokter : '.$nama_dokter, 0, 0);

$pdf->Cell(10, 15, '', 0, 1);

$pdf->SetFont('Times', 'B', 9);

// Define the fixed and variable column widths.
$fixedColumnWidth = 10;
$variableColumnWidth = (195 - $fixedColumnWidth) / 5; // Divide the available space by the number of variable columns.

// Create headers for the table.
$pdf->Cell($fixedColumnWidth, 7, 'NO', 1, 0, 'C');
$pdf->Cell($variableColumnWidth, 7, 'NAMA OBAT', 1, 0, 'C');
$pdf->Cell($variableColumnWidth, 7, 'JUMLAH', 1, 0, 'C');
$pdf->Cell($variableColumnWidth, 7, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell($variableColumnWidth, 7, 'ATURAN PAKAI', 1, 0, 'C');
$pdf->Cell($variableColumnWidth, 7, 'HARGA', 1, 0, 'C');
$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Times', '', 10);

$no=1;
$data = mysqli_query($mysqli,"SELECT * FROM `resep_obat` ro INNER JOIN `data_obat` od ON ro.data_obat_id = od.id WHERE `rekam_medis_id` = $id_rekam_medis");
while ($d = $data->fetch_assoc()) {
    $pdf->Cell($fixedColumnWidth, 6, $no++, 1, 0, 'C');
    $pdf->Cell($variableColumnWidth, 6, $d['nama'], 1, 0);
    $pdf->Cell($variableColumnWidth, 6, $d['jumlah_pemakaian'], 1, 0);
    $pdf->Cell($variableColumnWidth, 6, $d['keterangan'], 1, 0);
    $pdf->Cell($variableColumnWidth, 6, $d['aturan_pakai'], 1, 0);
    $pdf->Cell($variableColumnWidth, 6, number_format($d['harga']), 1, 1); // '1' here means move to the next line.
}

$pdf->Output('D','Resep '.$nama_pasien.'.pdf');
 
?>