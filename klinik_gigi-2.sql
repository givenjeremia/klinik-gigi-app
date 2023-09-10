-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 10, 2023 at 11:42 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik_gigi`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `kategori` varchar(45) DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama`, `jenis`, `kategori`, `harga`) VALUES
(12, 'Stestokop', 'Medis', 'Medis', 100000),
(13, 'Plester', 'Medis', 'Ringan', 20000),
(15, 'Fredrin', 'Sambo ', '5 Tahun', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_keuangan`
--

CREATE TABLE `catatan_keuangan` (
  `id` int(11) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `keterangan` longtext,
  `jumlah` double DEFAULT NULL,
  `jenis_transaksi` varchar(45) DEFAULT NULL,
  `nota_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catatan_keuangan`
--

INSERT INTO `catatan_keuangan` (`id`, `tanggal_masuk`, `keterangan`, `jumlah`, `jenis_transaksi`, `nota_id`) VALUES
(4, '2023-09-06', 'dasda', 400000, 'kredit', NULL),
(5, '2023-09-08', 'Hahaha', 900000, 'debit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_dokter`
--

CREATE TABLE `data_dokter` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) DEFAULT NULL,
  `alamat` longtext,
  `no_telp` int(15) DEFAULT NULL,
  `jenis_kelamin` enum('P','L') DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_dokter`
--

INSERT INTO `data_dokter` (`id`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `user_id`) VALUES
(2, 'Given Jeremia', 'Jl. Mojo Kidubl Blok B/3', 812312, 'L', 10);

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `no_telp` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_karyawan`
--

INSERT INTO `data_karyawan` (`id`, `nama`, `alamat`, `no_telp`, `user_id`) VALUES
(18, 'Ria', 'Jl. KK', 1231231, 14),
(19, 'Admin', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_obat`
--

CREATE TABLE `data_obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `kategori` varchar(45) DEFAULT NULL,
  `tgl_exp` date DEFAULT NULL,
  `stok` varchar(45) DEFAULT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_obat`
--

INSERT INTO `data_obat` (`id`, `nama`, `kategori`, `tgl_exp`, `stok`, `jenis`, `harga`) VALUES
(14, 'Parasetamol', 'Pusing', '2023-08-18', '15', 'Obat', 300000),
(15, 'Antibiotik', 'Pusing', '2023-08-18', '10', 'Obat', 300000),
(16, NULL, NULL, NULL, NULL, NULL, 0),
(17, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_pasien`
--

CREATE TABLE `data_pasien` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `usia` varchar(45) DEFAULT NULL,
  `tempat_tanggal_lahir` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `no_telp` int(11) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `jenis_kelamin` enum('Perempuan','laki-laki') DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_pasien`
--

INSERT INTO `data_pasien` (`id`, `nama`, `usia`, `tempat_tanggal_lahir`, `alamat`, `no_telp`, `tanggal_daftar`, `jenis_kelamin`, `user_id`) VALUES
(1, 'Susana A', '20', 'Surabaya, 21 Desember 2001', 'Jl. Mojo Kid', 812313, '2023-08-01', 'laki-laki', 18),
(2, 'Farhan', '19', 'Surabaya, 21 January 2021', 'Jl. Tebet', 83123131, NULL, 'laki-laki', 20);

-- --------------------------------------------------------

--
-- Table structure for table `data_perawat`
--

CREATE TABLE `data_perawat` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `no_telp` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_perawat`
--

INSERT INTO `data_perawat` (`id`, `nama`, `alamat`, `no_telp`, `user_id`) VALUES
(2, 'Pablo', 'Jl. Pablo 21 SBY', 8813121, 19);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` int(11) NOT NULL,
  `jam` time DEFAULT NULL,
  `hari` varchar(45) DEFAULT NULL,
  `kuota_pasien` varchar(45) DEFAULT NULL,
  `data_dokter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `jam`, `hari`, `kuota_pasien`, `data_dokter_id`) VALUES
(1, '21:00:00', 'Friday', '10', 2),
(2, '16:52:00', 'Saturday', '10', 2),
(3, '13:00:00', 'Monday', '10', 2),
(4, '20:00:00', 'Monday', '5', 2),
(5, '10:00:00', 'Tuesday', '10', 2),
(6, '11:00:00', 'Wednesday', '5', 2),
(7, '19:00:00', 'Thursday', '5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `hari_dokter` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama`, `jenis`, `harga`, `hari_dokter`) VALUES
(1, 'Cabut', 'Gigi', 200000, 'Friday'),
(2, 'Besih', 'Hallo', 2000000, 'Monday'),
(3, 'Karang', 'm', 10000, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id` int(11) NOT NULL,
  `total_pembayaran` double DEFAULT NULL,
  `jenis_pembayaran` varchar(45) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `data_karyawan_id` int(11) DEFAULT NULL,
  `rekam_medis_id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id`, `total_pembayaran`, `jenis_pembayaran`, `tanggal`, `data_karyawan_id`, `rekam_medis_id`, `status`) VALUES
(1, 900000, 'lunas', '2023-09-08', 19, 22, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `keluhan` longtext,
  `diagnosa` longtext,
  `tindakan` longtext,
  `gambar` varchar(225) DEFAULT NULL,
  `total_tarif` double DEFAULT NULL,
  `tanggal_pemeriksaan` date DEFAULT NULL,
  `reservasi_kllinik_id` int(11) DEFAULT NULL,
  `jadwal_dokter_id` int(11) DEFAULT NULL,
  `data_perawat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `keluhan`, `diagnosa`, `tindakan`, `gambar`, `total_tarif`, `tanggal_pemeriksaan`, `reservasi_kllinik_id`, `jadwal_dokter_id`, `data_perawat_id`) VALUES
(14, 'Keluhan --', 'Diagnosa --', 'TIndakan --', NULL, 1220000, '2023-08-25', 2, 2, NULL),
(15, 'Kelihan 26', 'Diagnosa --', 'Tindakan --', NULL, 1310000, '2023-08-26', 5, 2, NULL),
(16, '1231', '1231', '121', NULL, 10000, '2023-08-18', 2, 2, NULL),
(17, '1231', '1231', '121', NULL, 3630000, '2023-08-18', 2, 2, NULL),
(18, '1', '1231', '31231', NULL, 3630000, '2023-08-15', 5, 2, NULL),
(19, '1', '2', '3', NULL, 1230000, '2023-08-27', 2, 2, NULL),
(22, 'Keluhan 1--', 'Diagnosa 1--', 'Tindakan 1--', NULL, 900000, '2023-09-08', 11, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis_has_alat`
--

CREATE TABLE `rekam_medis_has_alat` (
  `rekam_medis_id` int(11) NOT NULL,
  `alat_id` int(11) NOT NULL,
  `jumlah_pemakaian` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rekam_medis_has_alat`
--

INSERT INTO `rekam_medis_has_alat` (`rekam_medis_id`, `alat_id`, `jumlah_pemakaian`, `harga`, `keterangan`) VALUES
(14, 12, 2, 100000, 'Ket Stes'),
(14, 13, 4, 20000, 'Ket Stes'),
(15, 12, 1231, 100000, '121'),
(17, 13, 1, 20000, '2'),
(18, 13, 1231, 20000, '2'),
(19, 13, 1, 20000, '2'),
(22, 12, 10, 100000, '20');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis_has_layanan`
--

CREATE TABLE `rekam_medis_has_layanan` (
  `rekam_medis_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rekam_medis_has_layanan`
--

INSERT INTO `rekam_medis_has_layanan` (`rekam_medis_id`, `layanan_id`) VALUES
(14, 1),
(22, 1),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `rekam_medis_id` int(11) NOT NULL,
  `data_obat_id` int(11) NOT NULL,
  `jumlah_pemakaian` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` longtext,
  `aturan_pakai` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`rekam_medis_id`, `data_obat_id`, `jumlah_pemakaian`, `harga`, `keterangan`, `aturan_pakai`) VALUES
(14, 14, 1, 300000, 'Ket Para', 'AP Para'),
(14, 15, 2, 600000, 'Ket Anti', 'AP Anti'),
(15, 14, 3, 900000, '1', '2'),
(15, 15, 1, 300000, '12', '22'),
(17, 14, 12, 3600000, '21', '1'),
(18, 14, 12, 3600000, '1231', '1231'),
(19, 15, 4, 1200000, '4', '4'),
(22, 14, 2, 600000, 'Haha', '1231');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi_kllinik`
--

CREATE TABLE `reservasi_kllinik` (
  `id` int(11) NOT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `tanggal_input_reservasi` datetime DEFAULT NULL,
  `tanggal_reservasi` date DEFAULT NULL,
  `jam_reservasi` time DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `jadwal_dokter_id` int(11) DEFAULT NULL,
  `data_karyawan_id` int(11) DEFAULT NULL,
  `data_pasien_id_pasien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservasi_kllinik`
--

INSERT INTO `reservasi_kllinik` (`id`, `no_antrian`, `tanggal_input_reservasi`, `tanggal_reservasi`, `jam_reservasi`, `status`, `jadwal_dokter_id`, `data_karyawan_id`, `data_pasien_id_pasien`) VALUES
(2, 1, '2023-08-24 14:31:50', '2023-08-26', '16:52:00', 'approved', 2, NULL, 1),
(5, 2, '2023-08-23 13:19:06', '2023-08-23', '21:00:00', 'approved', 2, NULL, 1),
(10, 1, '2023-09-08 07:39:46', '2023-09-11', '13:00:00', 'approved', 3, NULL, 2),
(11, 1, '2023-09-08 09:09:16', '2023-09-08', '21:00:00', 'approved', 1, NULL, 2),
(12, 1, '2023-09-08 09:09:36', '2023-09-09', '16:52:00', 'approved', 2, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `role` enum('karyawan','dokter','perawat','pasien','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(10, 'givenjeremia', '12345678', 'dokter'),
(14, 'ria', '12345678', 'karyawan'),
(18, 'susana', '12345678', 'pasien'),
(19, 'pablo', '12345678', 'perawat'),
(20, 'farhan', '12345678', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_data_keuangan_nota1_idx` (`nota_id`);

--
-- Indexes for table `data_dokter`
--
ALTER TABLE `data_dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_obat`
--
ALTER TABLE `data_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_perawat`
--
ALTER TABLE `data_perawat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwal_dokter_data_dokter1_idx` (`data_dokter_id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nota_data_karyawan1_idx` (`data_karyawan_id`),
  ADD KEY `fk_nota_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rekam_medis_reservasi_kllinik1_idx` (`reservasi_kllinik_id`),
  ADD KEY `fk_rekam_medis_jadwal_dokter1_idx` (`jadwal_dokter_id`),
  ADD KEY `fk_rekam_medis_data_perawat1_idx` (`data_perawat_id`);

--
-- Indexes for table `rekam_medis_has_alat`
--
ALTER TABLE `rekam_medis_has_alat`
  ADD PRIMARY KEY (`rekam_medis_id`,`alat_id`),
  ADD KEY `fk_rekam_medis_has_alat_alat1_idx` (`alat_id`),
  ADD KEY `fk_rekam_medis_has_alat_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indexes for table `rekam_medis_has_layanan`
--
ALTER TABLE `rekam_medis_has_layanan`
  ADD PRIMARY KEY (`rekam_medis_id`,`layanan_id`),
  ADD KEY `fk_rekam_medis_has_layanan_layanan1_idx` (`layanan_id`),
  ADD KEY `fk_rekam_medis_has_layanan_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`rekam_medis_id`,`data_obat_id`),
  ADD KEY `fk_rekam_medis_has_data_obat_data_obat1_idx` (`data_obat_id`),
  ADD KEY `fk_rekam_medis_has_data_obat_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indexes for table `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservasi_kllinik_jadwal_dokter1_idx` (`jadwal_dokter_id`),
  ADD KEY `fk_reservasi_kllinik_data_karyawan1_idx` (`data_karyawan_id`),
  ADD KEY `fk_reservasi_kllinik_data_pasien1_idx` (`data_pasien_id_pasien`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_dokter`
--
ALTER TABLE `data_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `data_obat`
--
ALTER TABLE `data_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_perawat`
--
ALTER TABLE `data_perawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  ADD CONSTRAINT `fk_data_keuangan_nota1` FOREIGN KEY (`nota_id`) REFERENCES `nota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `fk_jadwal_dokter_data_dokter1` FOREIGN KEY (`data_dokter_id`) REFERENCES `data_dokter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_data_karyawan1` FOREIGN KEY (`data_karyawan_id`) REFERENCES `data_karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `fk_rekam_medis_data_perawat1` FOREIGN KEY (`data_perawat_id`) REFERENCES `data_perawat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_jadwal_dokter1` FOREIGN KEY (`jadwal_dokter_id`) REFERENCES `jadwal_dokter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_reservasi_kllinik1` FOREIGN KEY (`reservasi_kllinik_id`) REFERENCES `reservasi_kllinik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rekam_medis_has_alat`
--
ALTER TABLE `rekam_medis_has_alat`
  ADD CONSTRAINT `fk_rekam_medis_has_alat_alat1` FOREIGN KEY (`alat_id`) REFERENCES `alat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_has_alat_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rekam_medis_has_layanan`
--
ALTER TABLE `rekam_medis_has_layanan`
  ADD CONSTRAINT `fk_rekam_medis_has_layanan_layanan1` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_has_layanan_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `fk_rekam_medis_has_data_obat_data_obat1` FOREIGN KEY (`data_obat_id`) REFERENCES `data_obat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_has_data_obat_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  ADD CONSTRAINT `fk_reservasi_kllinik_data_karyawan1` FOREIGN KEY (`data_karyawan_id`) REFERENCES `data_karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservasi_kllinik_data_pasien1` FOREIGN KEY (`data_pasien_id_pasien`) REFERENCES `data_pasien` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservasi_kllinik_jadwal_dokter1` FOREIGN KEY (`jadwal_dokter_id`) REFERENCES `jadwal_dokter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
