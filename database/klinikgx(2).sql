-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 30, 2024 at 04:47 AM
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
-- Database: `klinikgx`
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
(15, 'Fredrin', 'Sambo ', '5 Tahun', 500000),
(16, 'brecket', 'medis', 'langsung pakai', 100000),
(17, 'kapas', 'medis', 'penggunaan langsung', 15000),
(18, 'dental scalling', 'medis', 'penggunaan langsung', 20000),
(19, 'karet behel', 'alat bawa pulang', 'pemakaian luar', 5000),
(20, 'O-ring', 'karet', 'kawat gigi', 10000),
(21, 'separator', 'behel', 'pemakaian gigi', 20000);

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
  `user_id` int(11) NOT NULL,
  `spesialis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_dokter`
--

INSERT INTO `data_dokter` (`id`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `user_id`, `spesialis_id`) VALUES
(2, 'Adity 2', 'Jl. Mojo Kidubl Blok B/54', 812312, 'L', 10, 0),
(3, 'Rizky Hermawan', 'Jl. Simupatupang', 2147483647, 'L', 21, 1),
(4, 'Mawar', 'Jl. Mawar Melati', 2147483647, 'P', 22, 3),
(5, 'Anisa', 'jl.Rahmat Basuki', 2147483647, 'P', 27, NULL),
(6, 'tes', 'mawar', 1231231, 'L', 30, NULL),
(7, '2', '2', 2, 'L', 31, 2),
(9, 'Hawa', 'jl.bunga', 896645323, 'P', 34, 3);

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_karyawan`
--

INSERT INTO `data_karyawan` (`id`, `nama`, `alamat`, `no_telp`, `user_id`) VALUES
(18, 'Ria', 'Jl. KK', '1231231', 14),
(19, 'Admin', NULL, NULL, 1),
(20, '123', '1e1', '81231', 47),
(21, '12', 'dq', '8123', 49),
(22, 'd', 'd', '081923', 51);

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
(14, 'Parasetamol', 'Pusing', '2023-08-18', '0', 'Obat', 300000),
(15, 'Antibiotik', 'Pusing', '2023-08-18', '8', 'Obat', 300000),
(16, NULL, NULL, NULL, NULL, NULL, 0),
(17, NULL, NULL, NULL, NULL, NULL, 0),
(18, 'intraoseuss', 'anastesi', '2024-07-18', '198', 'suntik', 50000),
(19, 'intraligmen', 'anastesi', '2024-07-18', '0', 'suntik', 50000),
(20, 'benzokain', 'anastesi', '2024-07-18', '50', 'Gel', 50000),
(21, 'ibu profein', 'konsumsi', '2025-01-01', '200', 'tablet', 15000);

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
  `no_telp` varchar(225) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `jenis_kelamin` enum('Perempuan','laki-laki') DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_pasien`
--

INSERT INTO `data_pasien` (`id`, `nama`, `usia`, `tempat_tanggal_lahir`, `alamat`, `no_telp`, `tanggal_daftar`, `jenis_kelamin`, `user_id`) VALUES
(1, 'Susana A', '20', 'Surabaya, 21 Desember 2001', 'Jl. Mojo Kid', '812313', '2023-08-01', 'laki-laki', 18),
(2, 'Farhan', '19', 'Surabaya, 21 January 2021', 'Jl. Tebet', '83123131', NULL, 'laki-laki', 20),
(3, 'Gita', '22', 'Surabaya, 09 Desember 2000', 'Jl.kenjeran dukuh setro no 8A', '2147483647', '2023-10-16', 'Perempuan', 23),
(4, 'Leila', '21', 'Surabaya, 27 November 2001', 'Jl.Penjernihan no.8A', '2147483647', '2023-10-09', 'Perempuan', 24),
(5, 'Ryan', '7', 'Jakarta, 05 Mei 2008', 'Jakarta Selatan', '2147483647', '2023-10-18', 'laki-laki', 25),
(6, 'Rhadit', '18', 'Purwakarta, 14 Sepetember 2005', 'Jl.Mokondo', '2147483647', '2023-10-02', 'laki-laki', 28),
(7, 'jaehyun', '26', 'Jakarta, 14 Februari 1997', 'Jl.Pegangsaan Timur', '814029766', NULL, 'laki-laki', 29),
(8, 'new', '12', '2231231', 'dqwdqw', '812313121', '2024-01-20', 'Perempuan', 35),
(9, '1', '2', '3', '4', '812356371', '2024-01-20', 'laki-laki', 39),
(10, '123', '1', 'd', 'd', '812345', '2024-01-17', 'laki-laki', 41),
(11, '1', '2', '3', '4', '81235637179', '2024-01-10', 'laki-laki', 42),
(12, '1', '2', '3', '4', '08123451', '2024-01-17', 'laki-laki', 43),
(13, '1', '2', '3', '4', '0812314', '2024-01-24', 'laki-laki', 44);

-- --------------------------------------------------------

--
-- Table structure for table `data_perawat`
--

CREATE TABLE `data_perawat` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_perawat`
--

INSERT INTO `data_perawat` (`id`, `nama`, `alamat`, `no_telp`, `user_id`) VALUES
(2, 'Pablo', 'Jl. Pablo 21 SBY', '8813121', 19),
(3, 'Melati', 'Jl. Anggrek', '855372379', 26),
(4, '1', '2', '081231231', 45),
(5, '3', '3', '09121', 46);

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
(1, '21:00:00', 'Saturday', '23', 2),
(2, '16:52:00', 'Saturday', '8', 2),
(3, '13:00:00', 'Monday', '3', 2),
(4, '20:00:00', 'Monday', '0', 2),
(5, '10:00:00', 'Tuesday', '1', 2),
(6, '11:00:00', 'Wednesday', '5', 2),
(7, '19:00:00', 'Thursday', '4', 2),
(8, '08:00:00', 'Monday', '20', 3),
(9, '08:00:00', 'Wednesday', '19', 3),
(10, '08:00:00', 'Friday', '10', 3),
(11, '12:00:00', 'Saturday', '13', 3),
(12, '08:00:00', 'Tuesday', '19', 4),
(13, '08:00:00', 'Thursday', '20', 4),
(14, '13:00:00', 'Friday', '15', 4),
(15, '15:00:00', 'Saturday', '20', 4),
(16, '10:00:00', 'Tuesday', '11', 5),
(17, '10:00:00', 'Friday', '15', 5),
(18, '15:00:00', 'Sunday', '9', 5);

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `waktu` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id`, `nama`, `waktu`) VALUES
(1, 'Tidur Edit', 31),
(2, 'Makan', 40);

-- --------------------------------------------------------

--
-- Table structure for table `keluhan_reservasi`
--

CREATE TABLE `keluhan_reservasi` (
  `id` int(11) NOT NULL,
  `keluhan_id` int(11) NOT NULL,
  `reservasi_id` int(11) NOT NULL,
  `waktu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keluhan_reservasi`
--

INSERT INTO `keluhan_reservasi` (`id`, `keluhan_id`, `reservasi_id`, `waktu`) VALUES
(1, 1, 55, NULL),
(2, 2, 55, NULL),
(3, 1, 56, NULL),
(4, 1, 57, NULL),
(5, 1, 58, NULL),
(6, 1, 59, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_odontogram`
--

CREATE TABLE `kondisi_odontogram` (
  `id` int(11) NOT NULL,
  `key_data` varchar(225) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `format` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kondisi_odontogram`
--

INSERT INTO `kondisi_odontogram` (`id`, `key_data`, `nama`, `format`) VALUES
(1, '1', 'Sisa Akar', 'sts'),
(2, '2', 'Gigi Hilang', 'sts'),
(3, '3', 'Jembatan', 'sts'),
(4, '4', 'Gigi Tiruan Lepas', 'sts'),
(5, '1', 'Tambalan Logam', 'fill'),
(6, '2', 'Tambalan Non Logam', 'fill'),
(7, '3', 'Mahkota Logam (FMC)', 'fill'),
(8, '4', 'Mahkota Non Logam', 'fill'),
(9, '1', 'Belum Erupsi (UNE)', 'exts'),
(10, '2', 'Erupsi Sebagian (PRE)', 'exts'),
(11, '3', 'Anomali Bentuk (ANO)', 'exts'),
(12, '5', 'Karies (CAR)', 'fill'),
(13, '5', 'Non Vital (NVT)', 'exts');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `hari_dokter` varchar(60) DEFAULT NULL,
  `spesialis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama`, `jenis`, `harga`, `hari_dokter`, `spesialis_id`) VALUES
(1, 'Cabut', 'Gigi', 200000, 'Friday', NULL),
(2, 'Besih', 'Hallo', 2000000, 'Monday', 1),
(3, 'Karang', 'm', 10000, 'Sunday', 2),
(4, 'Operasi', 'Gigi', 900000, 'Sunday', NULL),
(5, 'B', 'b', 10000, 'Tuesday', 1),
(6, 'dqw', '1231', 1231231, 'Monday', NULL),
(7, 'qdwqw', '12312', 1231, 'Monday', 1),
(8, 'test', '2', 2000000, NULL, 3),
(9, 'Hallo', '123', 200000, NULL, NULL),
(10, '1', '2', 3, NULL, 0),
(11, '2', '2', 222, NULL, NULL),
(12, '3', '3', 3, NULL, NULL),
(13, '1', '2', 3, NULL, NULL),
(14, '5', '5', 5, NULL, NULL),
(15, '5', '5', 5, NULL, NULL),
(16, 'c', 'c', 12, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `new_odontogram`
--

CREATE TABLE `new_odontogram` (
  `id` int(11) NOT NULL,
  `nomor_gigi` int(11) NOT NULL,
  `posisi` varchar(225) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `rekam_medis_id` int(11) NOT NULL,
  `kondisi_odontogram_id` int(11) NOT NULL,
  `tindakan_odontogram_id` int(11) NOT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `new_odontogram`
--

INSERT INTO `new_odontogram` (`id`, `nomor_gigi`, `posisi`, `tanggal`, `rekam_medis_id`, `kondisi_odontogram_id`, `tindakan_odontogram_id`, `keterangan`) VALUES
(1, 21, 'bottom', '2023-12-17', 26, 1, 3, NULL),
(2, 21, 'top', '2024-03-23', 31, 1, 3, NULL),
(3, 24, 'center', '2024-03-23', 31, 2, 0, 'dqwdqw');

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `id` int(11) NOT NULL,
  `total_pembayaran` double DEFAULT NULL,
  `sub_pembayaran` double DEFAULT NULL,
  `jenis_pembayaran` varchar(45) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `data_karyawan_id` int(11) DEFAULT NULL,
  `rekam_medis_id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nota`
--

INSERT INTO `nota` (`id`, `total_pembayaran`, `sub_pembayaran`, `jenis_pembayaran`, `tanggal`, `data_karyawan_id`, `rekam_medis_id`, `status`) VALUES
(22, 610000, 600000, 'lunas', '2023-12-16', 19, 26, 'approved'),
(23, 1610000, 1600000, 'lunas', '2024-01-16', 19, 27, 'approved'),
(24, 13710000, 13700000, 'lunas', '2024-03-23', 19, 28, 'approved'),
(25, NULL, NULL, NULL, NULL, NULL, 29, 'pending'),
(26, NULL, NULL, NULL, NULL, NULL, 30, 'pending'),
(27, NULL, NULL, NULL, NULL, NULL, 31, 'pending'),
(28, NULL, NULL, NULL, NULL, NULL, 32, 'pending'),
(29, 810000, 800000, 'lunas', '2024-03-02', 19, 33, 'approved'),
(30, 820000, 810000, 'lunas', '2024-03-23', 19, 34, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `odontogram`
--

CREATE TABLE `odontogram` (
  `id` int(11) NOT NULL,
  `nomor_gigi` varchar(11) NOT NULL,
  `posisi` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(225) NOT NULL,
  `color` varchar(225) NOT NULL,
  `rekam_medis_id` int(11) NOT NULL,
  `data_pasien_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `odontogram_tindakan`
--

CREATE TABLE `odontogram_tindakan` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `odontogram_tindakan`
--

INSERT INTO `odontogram_tindakan` (`id`, `nama`, `type`) VALUES
(1, 'Amalgam', 'Tambalan'),
(2, 'GIC/Silika', 'Tambalan'),
(3, 'Composite', 'Tambalan'),
(4, 'Fissure Sealant (FIS)', 'Tambalan'),
(5, 'Inlay', 'Tambalan'),
(6, 'Hitam', 'Arsiran'),
(7, 'Merah', 'Arsiran'),
(8, 'Hijau M', 'Arsiran'),
(9, 'Mbiru', 'Arsiran'),
(10, 'Kuning', 'Arsiran'),
(11, 'Ya', 'Garis Tebal'),
(12, 'Tidak', 'Garis Tebal');

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
  `biaya_tindakan` double DEFAULT NULL,
  `reservasi_kllinik_id` int(11) DEFAULT NULL,
  `jadwal_dokter_id` int(11) DEFAULT NULL,
  `data_perawat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `keluhan`, `diagnosa`, `tindakan`, `gambar`, `total_tarif`, `tanggal_pemeriksaan`, `biaya_tindakan`, `reservasi_kllinik_id`, `jadwal_dokter_id`, `data_perawat_id`) VALUES
(26, 'Testing 2', 'Testing 3\r\n', NULL, '2023-09-25 09.30.53.jpg', 600000, '2023-12-12', NULL, 36, 5, NULL),
(27, 'dqw', '1', NULL, NULL, 1600000, '2024-01-16', NULL, 44, 5, NULL),
(28, '1', '2', NULL, NULL, 1200000, '2024-01-16', NULL, 45, 16, NULL),
(29, '1', '2', NULL, NULL, 600000, '2024-01-16', NULL, 46, 16, NULL),
(30, 'Kel', 'Diag', NULL, NULL, 1200000, '2024-01-20', NULL, 47, 11, NULL),
(31, 'K1', 'D1', NULL, NULL, 2100000, '2024-01-20', NULL, 47, 11, NULL),
(32, '1', '2', NULL, NULL, 1100000, '2024-01-23', NULL, 51, 16, NULL),
(33, 'Sakit Hati', 'Makanan', NULL, NULL, 700000, '2024-03-02', NULL, 54, 11, NULL),
(34, 'dqwdqw', 'dqwdqw', NULL, NULL, 800000, '2024-03-23', NULL, 58, 1, NULL);

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
(26, 12, 1, 100000, 'ket-'),
(27, 15, 1, 500000, '2'),
(28, 12, 1, 100000, '2'),
(29, 12, 1, 100000, '2'),
(30, 12, 1, 100000, 'Hallo'),
(31, 12, 2, 200000, '1'),
(32, 12, 1, 100000, '-'),
(33, 12, 2, 200000, '1'),
(34, 12, 1, 100000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id` int(11) NOT NULL,
  `rekam_medis_id` int(11) NOT NULL,
  `data_obat_id` int(11) NOT NULL,
  `jumlah_pemakaian` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` longtext,
  `aturan_pakai` longtext,
  `status` bigint(5) NOT NULL,
  `status_kesediaan` tinyint(4) NOT NULL DEFAULT '0',
  `status_bayar` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`id`, `rekam_medis_id`, `data_obat_id`, `jumlah_pemakaian`, `harga`, `keterangan`, `aturan_pakai`, `status`, `status_kesediaan`, `status_bayar`) VALUES
(1, 26, 14, 1, 300000, '1', '1', 0, 1, 1),
(2, 26, 15, 2, 600000, '1', '1', 1, 1, 1),
(3, 27, 14, 3, 900000, '1', '23', 0, 1, 1),
(4, 28, 15, 3, 900000, '1', '2', 0, 1, 1),
(5, 29, 14, 1, 300000, '1', '121', 0, 1, 1),
(6, 30, 14, 3, 900000, '2', '1', 0, 1, 1),
(7, 31, 14, 2, 600000, 'ket', 'ap', 0, 1, 1),
(8, 28, 14, 2, 600000, '1', '1', 1, 1, 0),
(9, 32, 14, 2, 600000, '1', '2', 0, 1, 1),
(10, 32, 14, 2, 600000, '1', '1', 1, 1, 0),
(11, 0, 15, 1, 300000, '1', '1', 1, 1, 0),
(12, 32, 15, 1, 300000, '1', '12', 1, 1, 0),
(13, 32, 14, 2, 600000, '1', 'dqw', 1, 1, 0),
(14, 32, 15, 2, 600000, '2', '1', 1, 1, 0),
(15, 33, 14, 1, 300000, '1', '1', 0, 1, 1),
(16, 33, 18, 2, 100000, '1', '1', 1, 1, 1),
(17, 33, 19, 1, 50000, '1', '1', 1, 1, 0),
(18, 28, 20, 250, 12500000, '1', '1', 1, 1, 1),
(19, 34, 14, 1, 300000, '1', '1', 0, 1, 1);

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
  `keluhan_baru` text,
  `status` varchar(45) DEFAULT NULL,
  `jadwal_dokter_id` int(11) DEFAULT NULL,
  `data_karyawan_id` int(11) DEFAULT NULL,
  `data_pasien_id_pasien` int(11) DEFAULT NULL,
  `status_kehadiran` enum('pending','tidak hadir','hadir') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservasi_kllinik`
--

INSERT INTO `reservasi_kllinik` (`id`, `no_antrian`, `tanggal_input_reservasi`, `tanggal_reservasi`, `jam_reservasi`, `keluhan_baru`, `status`, `jadwal_dokter_id`, `data_karyawan_id`, `data_pasien_id_pasien`, `status_kehadiran`) VALUES
(36, 1, '2023-12-12 11:41:13', '2023-12-12', '10:00:00', NULL, 'approved', 5, NULL, 2, 'hadir'),
(37, 1, '2023-12-12 11:54:21', '2023-12-12', '08:00:00', NULL, 'approved', 12, NULL, 3, 'hadir'),
(38, 1, '2023-12-12 12:02:23', '2023-12-12', '10:00:00', NULL, 'approved', 16, NULL, 5, 'hadir'),
(39, 2, '2023-12-12 13:36:46', '2023-12-12', '10:30:00', NULL, 'approved', 5, NULL, 5, 'hadir'),
(40, 1, '2023-12-16 15:09:33', '2023-12-16', '16:52:00', NULL, 'approved', 2, NULL, 2, 'hadir'),
(41, 2, '2023-12-16 15:40:43', '2023-12-16', '17:22:00', NULL, 'approved', 2, NULL, 1, 'hadir'),
(42, 1, '2023-12-17 08:53:10', '2023-12-17', '15:00:00', NULL, 'approved', 18, NULL, 2, 'pending'),
(43, 1, '2024-01-07 13:08:10', '2024-01-08', '13:00:00', NULL, 'approved', 3, NULL, 1, 'pending'),
(44, 1, '2024-01-16 02:48:53', '2024-01-16', '10:00:00', NULL, 'approved', 5, NULL, 1, 'hadir'),
(45, 1, '2024-01-16 03:39:16', '2024-01-16', '10:00:00', NULL, 'approved', 16, NULL, 2, 'hadir'),
(46, 2, '2024-01-16 04:21:47', '2024-01-16', '10:30:00', NULL, 'approved', 16, NULL, 3, 'hadir'),
(47, 1, '2024-01-20 06:39:13', '2024-01-20', '12:00:00', NULL, 'approved', 11, NULL, 4, 'hadir'),
(49, 1, '2024-01-22 12:58:40', '2024-01-22', '13:00:00', NULL, 'approved', 3, NULL, 2, 'pending'),
(50, 1, '2024-01-22 14:18:11', '2024-01-29', '13:00:00', NULL, 'approved', 3, NULL, 2, 'pending'),
(51, 1, '2024-01-23 03:37:25', '2024-01-23', '10:00:00', NULL, 'approved', 16, NULL, 5, 'hadir'),
(54, 1, '2024-03-02 05:12:11', '2024-03-02', '12:00:00', NULL, 'approved', 11, NULL, 1, 'hadir'),
(55, 1, '2024-03-12 04:12:29', '2024-03-12', '10:00:00', NULL, 'approved', 5, NULL, 2, 'hadir'),
(56, 1, '2024-03-23 17:15:53', '2024-03-24', '15:00:00', NULL, 'approved', 18, NULL, 2, 'pending'),
(57, 2, '2024-03-23 17:17:14', '2024-03-24', '15:30:00', NULL, 'approved', 18, NULL, 3, 'pending'),
(58, 1, '2024-03-23 17:18:22', '2024-03-23', '21:00:00', NULL, 'approved', 1, NULL, 4, 'hadir'),
(59, 1, '2024-03-30 04:21:45', '2024-03-30', '21:00:00', 'Di dalam hatiku', 'approved', 1, NULL, 2, 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `spesialis`
--

CREATE TABLE `spesialis` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spesialis`
--

INSERT INTO `spesialis` (`id`, `nama`) VALUES
(1, 'otodidak 2'),
(2, 'divisi 2'),
(3, 'otopedi'),
(4, 'bedah mulut'),
(5, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `rekam_medis_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL,
  `jumlah` varchar(225) NOT NULL,
  `catatan` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`rekam_medis_id`, `layanan_id`, `jumlah`, `catatan`) VALUES
(26, 1, '1', '-'),
(27, 1, '1', '2'),
(28, 1, '1', '1'),
(29, 1, '2', '2ket'),
(30, 1, '2', 'Cabut Graham'),
(31, 1, '2', '-'),
(31, 4, '1', '-'),
(32, 1, '2', '-'),
(33, 1, '1', '2'),
(34, 1, '2', '3');

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
(10, 'adit', '123', 'dokter'),
(14, 'ria', '12345678', 'karyawan'),
(18, 'susana', '12345678', 'pasien'),
(19, 'pablo', '12345678', 'perawat'),
(20, 'farhan', '12345678', 'pasien'),
(21, 'rizky', '123', 'dokter'),
(22, 'mawar', '123', 'dokter'),
(23, 'gita', '123', 'pasien'),
(24, 'leila', '123', 'pasien'),
(25, 'ryan', '123', 'pasien'),
(26, 'melati', '123', 'perawat'),
(27, 'anisa', '123', 'dokter'),
(28, 'rhadit', '123', 'pasien'),
(29, 'jaehyun', '123', 'pasien'),
(30, '1', '2', 'dokter'),
(31, '2', '2', 'dokter'),
(32, 'jeremia', '1', 'dokter'),
(34, 'hawa', '123', 'dokter'),
(35, 'h', 'h', 'pasien'),
(39, '2d', '2', 'pasien'),
(41, 'hd', 'f', 'pasien'),
(42, '1dd', 'd', 'pasien'),
(43, 'jj', 'j', 'pasien'),
(44, '1dda', 'ddd', 'pasien'),
(45, 'k', 'k', 'perawat'),
(46, 'l', 'l', 'perawat'),
(47, 'o', 'o', 'karyawan'),
(49, 'p', 'p', 'karyawan'),
(51, 'k1231', 'k', 'karyawan'),
(52, 'tes1', '123', 'dokter');

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
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluhan_reservasi`
--
ALTER TABLE `keluhan_reservasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kondisi_odontogram`
--
ALTER TABLE `kondisi_odontogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_odontogram`
--
ALTER TABLE `new_odontogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nota_data_karyawan1_idx` (`data_karyawan_id`),
  ADD KEY `fk_nota_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indexes for table `odontogram`
--
ALTER TABLE `odontogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `odontogram_tindakan`
--
ALTER TABLE `odontogram_tindakan`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservasi_kllinik_jadwal_dokter1_idx` (`jadwal_dokter_id`),
  ADD KEY `fk_reservasi_kllinik_data_karyawan1_idx` (`data_karyawan_id`),
  ADD KEY `fk_reservasi_kllinik_data_pasien1_idx` (`data_pasien_id_pasien`);

--
-- Indexes for table `spesialis`
--
ALTER TABLE `spesialis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`rekam_medis_id`,`layanan_id`),
  ADD KEY `fk_rekam_medis_has_layanan_layanan1_idx` (`layanan_id`),
  ADD KEY `fk_rekam_medis_has_layanan_rekam_medis1_idx` (`rekam_medis_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_dokter`
--
ALTER TABLE `data_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_obat`
--
ALTER TABLE `data_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `data_perawat`
--
ALTER TABLE `data_perawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keluhan_reservasi`
--
ALTER TABLE `keluhan_reservasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kondisi_odontogram`
--
ALTER TABLE `kondisi_odontogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `new_odontogram`
--
ALTER TABLE `new_odontogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `odontogram`
--
ALTER TABLE `odontogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `odontogram_tindakan`
--
ALTER TABLE `odontogram_tindakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `spesialis`
--
ALTER TABLE `spesialis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

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
-- Constraints for table `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  ADD CONSTRAINT `fk_reservasi_kllinik_data_karyawan1` FOREIGN KEY (`data_karyawan_id`) REFERENCES `data_karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservasi_kllinik_data_pasien1` FOREIGN KEY (`data_pasien_id_pasien`) REFERENCES `data_pasien` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservasi_kllinik_jadwal_dokter1` FOREIGN KEY (`jadwal_dokter_id`) REFERENCES `jadwal_dokter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD CONSTRAINT `fk_rekam_medis_has_layanan_layanan1` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_has_layanan_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
