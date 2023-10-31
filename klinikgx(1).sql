-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 31 Okt 2023 pada 14.41
-- Versi server: 5.7.39
-- Versi PHP: 8.2.0

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
-- Struktur dari tabel `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `kategori` varchar(45) DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `alat`
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
-- Struktur dari tabel `catatan_keuangan`
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
-- Struktur dari tabel `data_dokter`
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
-- Dumping data untuk tabel `data_dokter`
--

INSERT INTO `data_dokter` (`id`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `user_id`) VALUES
(2, 'Adity', 'Jl. Mojo Kidubl Blok B/54', 812312, 'L', 10),
(3, 'Rizky Hermawan', 'Jl. Simupatupang', 2147483647, 'L', 21),
(4, 'Mawar', 'Jl. Mawar Melati', 2147483647, 'P', 22),
(5, 'Anisa', 'jl.Rahmat Basuki', 2147483647, 'P', 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `no_telp` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data_karyawan`
--

INSERT INTO `data_karyawan` (`id`, `nama`, `alamat`, `no_telp`, `user_id`) VALUES
(18, 'Ria', 'Jl. KK', 1231231, 14),
(19, 'Admin', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_obat`
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
-- Dumping data untuk tabel `data_obat`
--

INSERT INTO `data_obat` (`id`, `nama`, `kategori`, `tgl_exp`, `stok`, `jenis`, `harga`) VALUES
(14, 'Parasetamol', 'Pusing', '2023-08-18', '15', 'Obat', 300000),
(15, 'Antibiotik', 'Pusing', '2023-08-18', '10', 'Obat', 300000),
(16, NULL, NULL, NULL, NULL, NULL, 0),
(17, NULL, NULL, NULL, NULL, NULL, 0),
(18, 'intraoseuss', 'anastesi', '2024-07-18', '200', 'suntik', 50000),
(19, 'intraligmen', 'anastesi', '2024-07-18', '200', 'suntik', 50000),
(20, 'benzokain', 'anastesi', '2024-07-18', '200', 'Gel', 50000),
(21, 'ibu profein', 'konsumsi', '2025-01-01', '200', 'tablet', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pasien`
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
-- Dumping data untuk tabel `data_pasien`
--

INSERT INTO `data_pasien` (`id`, `nama`, `usia`, `tempat_tanggal_lahir`, `alamat`, `no_telp`, `tanggal_daftar`, `jenis_kelamin`, `user_id`) VALUES
(1, 'Susana A', '20', 'Surabaya, 21 Desember 2001', 'Jl. Mojo Kid', 812313, '2023-08-01', 'laki-laki', 18),
(2, 'Farhan', '19', 'Surabaya, 21 January 2021', 'Jl. Tebet', 83123131, NULL, 'laki-laki', 20),
(3, 'Gita', '22', 'Surabaya, 09 Desember 2000', 'Jl.kenjeran dukuh setro no 8A', 2147483647, '2023-10-16', 'Perempuan', 23),
(4, 'Leila', '21', 'Surabaya, 27 November 2001', 'Jl.Penjernihan no.8A', 2147483647, '2023-10-09', 'Perempuan', 24),
(5, 'Ryan', '15', 'Jakarta, 05 Mei 2008', 'Jakarta Selatan', 2147483647, '2023-10-18', 'laki-laki', 25),
(6, 'Rhadit', '18', 'Purwakarta, 14 Sepetember 2005', 'Jl.Mokondo', 2147483647, '2023-10-02', 'laki-laki', 28),
(7, 'jaehyun', '26', 'Jakarta, 14 Februari 1997', 'Jl.Pegangsaan Timur', 814029766, NULL, 'laki-laki', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_perawat`
--

CREATE TABLE `data_perawat` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `no_telp` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data_perawat`
--

INSERT INTO `data_perawat` (`id`, `nama`, `alamat`, `no_telp`, `user_id`) VALUES
(2, 'Pablo', 'Jl. Pablo 21 SBY', 8813121, 19),
(3, 'Melati', 'Jl. Anggrek', 855372379, 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id` int(11) NOT NULL,
  `jam` time DEFAULT NULL,
  `hari` varchar(45) DEFAULT NULL,
  `kuota_pasien` varchar(45) DEFAULT NULL,
  `data_dokter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id`, `jam`, `hari`, `kuota_pasien`, `data_dokter_id`) VALUES
(1, '21:00:00', 'Friday', '8', 2),
(2, '16:52:00', 'Saturday', '10', 2),
(3, '13:00:00', 'Monday', '7', 2),
(4, '20:00:00', 'Monday', '4', 2),
(5, '10:00:00', 'Tuesday', '6', 2),
(6, '11:00:00', 'Wednesday', '5', 2),
(7, '19:00:00', 'Thursday', '4', 2),
(8, '08:00:00', 'Monday', '20', 3),
(9, '08:00:00', 'Wednesday', '19', 3),
(10, '08:00:00', 'Friday', '10', 3),
(11, '12:00:00', 'Saturday', '15', 3),
(12, '08:00:00', 'Tuesday', '20', 4),
(13, '08:00:00', 'Thursday', '20', 4),
(14, '13:00:00', 'Friday', '15', 4),
(15, '15:00:00', 'Saturday', '20', 4),
(16, '10:00:00', 'Tuesday', '15', 5),
(17, '10:00:00', 'Friday', '15', 5),
(18, '15:00:00', 'Sunday', '14', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jenis` varchar(45) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `hari_dokter` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id`, `nama`, `jenis`, `harga`, `hari_dokter`) VALUES
(1, 'Cabut', 'Gigi', 200000, 'Friday'),
(2, 'Besih', 'Hallo', 2000000, 'Monday'),
(3, 'Karang', 'm', 10000, 'Saturday');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
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
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id`, `total_pembayaran`, `sub_pembayaran`, `jenis_pembayaran`, `tanggal`, `data_karyawan_id`, `rekam_medis_id`, `status`) VALUES
(1, 4010000, 4000000, 'lunas', '2023-09-24', 19, 1, 'approved'),
(2, 3080000, 3070000, 'lunas', '2023-10-02', 18, 2, 'approved'),
(3, 710000, 700000, 'lunas', '2023-10-23', 18, 3, 'approved'),
(4, 160000, 150000, 'lunas', '2023-10-23', 18, 4, 'approved'),
(5, 85000, 75000, 'lunas', '2023-10-23', 18, 5, 'approved'),
(6, 85000, 75000, 'lunas', '2023-10-23', 18, 6, 'approved'),
(7, 3050000, 3040000, 'lunas', '2023-10-26', 18, 7, 'approved'),
(8, NULL, NULL, NULL, NULL, NULL, 8, 'pending'),
(9, NULL, NULL, NULL, NULL, NULL, 9, 'pending'),
(10, 3050000, 3040000, 'lunas', '2023-10-26', 19, 10, 'approved'),
(11, NULL, NULL, NULL, NULL, NULL, 11, 'pending'),
(12, NULL, NULL, NULL, NULL, NULL, 12, 'pending'),
(13, 95000, 85000, 'lunas', '2023-10-29', 18, 13, 'approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `odontogram`
--

CREATE TABLE `odontogram` (
  `id` int(11) NOT NULL,
  `nomor_gigi` varchar(11) NOT NULL,
  `posisi` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `rekam_medis_id` int(11) NOT NULL,
  `data_pasien_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `odontogram`
--

INSERT INTO `odontogram` (`id`, `nomor_gigi`, `posisi`, `tanggal`, `rekam_medis_id`, `data_pasien_id`) VALUES
(1, 'NG 1', 'P 1', '2023-10-24', 13, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `keluhan` longtext,
  `diagnosa` longtext,
  `tindakan` longtext,
  `gambar` varchar(225) DEFAULT NULL,
  `total_tarif` double DEFAULT NULL,
  `tanggal_pemeriksaan` date DEFAULT NULL,
  `biaya_tindakan` double NOT NULL,
  `reservasi_kllinik_id` int(11) DEFAULT NULL,
  `jadwal_dokter_id` int(11) DEFAULT NULL,
  `data_perawat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `keluhan`, `diagnosa`, `tindakan`, `gambar`, `total_tarif`, `tanggal_pemeriksaan`, `biaya_tindakan`, `reservasi_kllinik_id`, `jadwal_dokter_id`, `data_perawat_id`) VALUES
(1, 'Tiba tiba Sakit', 'Sakit Mata', 'Operasi mata', NULL, 3300000, '2023-09-24', 2000000, 13, 5, NULL),
(2, 'sakit gigi', 'caries', 'tambal gigi', NULL, 3070000, '2023-10-02', 50000, 20, 4, NULL),
(3, 'sakit gigi pada gigi berlubang', 'caries pada M12', 'tambal gigi, pembersihan karang gigi', NULL, 700000, '2023-10-23', 150000, 25, 3, NULL),
(4, 'pemeriksaan rutin', 'o-ring kawat gigi kendor', 'ganti karet o-ring', NULL, 0, '2023-10-23', 50000, 26, 3, NULL),
(5, 'pemeriksaan rutin', 'o-ring sudah kendur', 'ganti o-ring', NULL, 75000, '2023-10-23', 50000, 26, 3, NULL),
(6, 'pemeriksaan rutin', 'o-ring sudah kendur', 'ganti o-ring', NULL, 75000, '2023-10-23', 50000, 26, 3, NULL),
(7, 'nyeri gigi', 'Gusi bengkak', 'suntik obat anti nyeri', NULL, 3040000, '2023-10-26', 25000, 30, 7, NULL),
(8, 'nyeri gigi', 'Gusi bengkak', 'suntik obat anti nyeri', NULL, 3040000, '2023-10-26', 25000, 30, 7, NULL),
(9, 'nyeri gigi', 'Gusi bengkak', 'suntik obat anti nyeri', NULL, 3040000, '2023-10-26', 25000, 30, 7, NULL),
(10, 'nyeri gigi', 'Gusi bengkak', 'suntik obat anti nyeri', NULL, 3040000, '2023-10-26', 25000, 30, 7, NULL),
(11, 'nyeri gigi', 'Gusi bengkak', 'suntik obat anti nyeri', NULL, 3040000, '2023-10-26', 25000, 30, 7, NULL),
(12, 'nyeri gigi', 'Gusi bengkak', 'suntik obat anti nyeri', NULL, 3055000, '2023-10-26', 25000, 30, 7, NULL),
(13, 'karang gigi', 'karang gigi', 'scalling', NULL, 85000, '2023-10-29', 50000, 31, 18, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis_has_alat`
--

CREATE TABLE `rekam_medis_has_alat` (
  `rekam_medis_id` int(11) NOT NULL,
  `alat_id` int(11) NOT NULL,
  `jumlah_pemakaian` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rekam_medis_has_alat`
--

INSERT INTO `rekam_medis_has_alat` (`rekam_medis_id`, `alat_id`, `jumlah_pemakaian`, `harga`, `keterangan`) VALUES
(1, 12, 1, 100000, '1'),
(2, 13, 2, 20000, 'langsung pakai'),
(3, 15, 1, 500000, 'pembersihan karang gigi '),
(4, 20, 16, 10000, 'atas bawah'),
(5, 17, 7, 15000, ''),
(5, 20, 16, 10000, ''),
(6, 17, 7, 15000, ''),
(6, 20, 16, 10000, ''),
(12, 17, 1, 15000, 'langsung pakai'),
(13, 18, 1, 20000, 'pembersihan karang gigi ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis_has_layanan`
--

CREATE TABLE `rekam_medis_has_layanan` (
  `rekam_medis_id` int(11) NOT NULL,
  `layanan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep_obat`
--

CREATE TABLE `resep_obat` (
  `rekam_medis_id` int(11) NOT NULL,
  `data_obat_id` int(11) NOT NULL,
  `jumlah_pemakaian` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` longtext,
  `aturan_pakai` longtext,
  `status` bigint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `resep_obat`
--

INSERT INTO `resep_obat` (`rekam_medis_id`, `data_obat_id`, `jumlah_pemakaian`, `harga`, `keterangan`, `aturan_pakai`, `status`) VALUES
(1, 14, 2, 600000, 'Obat Panas', '1. minum', 0),
(1, 15, 2, 600000, '-', '-', 0),
(2, 14, 10, 3000000, 'bawa pulang', '2 x 1', 0),
(3, 18, 1, 50000, 'suntik langsung', '5 ml', 0),
(4, 17, 0, 0, '', '', 0),
(7, 14, 10, 3000000, 'bawa pulang', '2 x 1', 0),
(7, 21, 1, 15000, 'suntik langsung', '2ml', 0),
(8, 14, 10, 3000000, 'bawa pulang', '2 x 1', 0),
(8, 21, 1, 15000, 'suntik langsung', '2ml', 0),
(9, 14, 10, 3000000, 'bawa pulang', '2 x 1', 0),
(9, 21, 1, 15000, 'suntik langsung', '2ml', 0),
(10, 14, 10, 3000000, 'bawa pulang', '2 x 1', 0),
(10, 21, 1, 15000, 'suntik langsung', '2ml', 0),
(11, 14, 10, 3000000, 'bawa pulang', '2 x 1', 0),
(11, 21, 1, 15000, 'suntik langsung', '2ml', 0),
(12, 14, 10, 3000000, 'bawa pulang', '2 x 1', 0),
(12, 21, 1, 15000, 'suntik langsung', '2ml', 0),
(13, 21, 1, 15000, 'suntik langsung', '5 ml', 0),
(13, 21, 10, 150000, 'tablet minum', '2 x 1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_kllinik`
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
  `data_pasien_id_pasien` int(11) DEFAULT NULL,
  `status_kehadiran` enum('pending','tidak hadir','hadir') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `reservasi_kllinik`
--

INSERT INTO `reservasi_kllinik` (`id`, `no_antrian`, `tanggal_input_reservasi`, `tanggal_reservasi`, `jam_reservasi`, `status`, `jadwal_dokter_id`, `data_karyawan_id`, `data_pasien_id_pasien`, `status_kehadiran`) VALUES
(13, 1, '2023-09-19 07:11:28', '2023-09-24', '10:00:00', 'approved', 5, NULL, 1, 'hadir'),
(14, 1, '2023-10-02 03:23:54', '2023-10-06', '21:00:00', 'approved', 1, NULL, 1, 'pending'),
(18, 2, '2023-10-02 03:52:02', '2023-10-06', '21:30:00', 'approved', 1, NULL, 2, 'pending'),
(19, 1, '2023-10-02 09:10:10', '2023-10-09', '13:00:00', 'pending', 3, NULL, 2, 'pending'),
(20, 1, '2023-10-02 09:18:32', '2023-10-02', '20:00:00', 'approved', 4, NULL, 2, 'hadir'),
(21, 1, '2023-10-23 07:04:56', '2023-10-27', '21:00:00', 'pending', 1, NULL, 5, 'pending'),
(22, 1, '2023-10-23 07:08:12', '2023-10-28', '15:00:00', 'pending', 15, NULL, 3, 'pending'),
(23, 2, '2023-10-23 07:08:28', '2023-10-28', '15:30:00', 'pending', 15, NULL, 2, 'pending'),
(24, 1, '2023-10-23 07:10:24', '2023-10-23', '20:00:00', 'pending', 4, NULL, 5, 'pending'),
(25, 1, '2023-10-23 07:10:44', '2023-10-23', '13:00:00', 'approved', 3, NULL, 2, 'hadir'),
(26, 2, '2023-10-23 07:11:00', '2023-10-23', '13:30:00', 'approved', 3, NULL, 3, 'hadir'),
(27, 3, '2023-10-23 07:11:21', '2023-10-23', '14:00:00', 'approved', 3, NULL, 4, 'pending'),
(28, 1, '2023-10-23 07:24:08', '2023-10-23', '08:00:00', 'pending', 8, NULL, 3, 'pending'),
(29, 1, '2023-10-25 15:01:43', '2023-10-25', '08:00:00', 'approved', 9, NULL, 3, 'hadir'),
(30, 1, '2023-10-26 06:56:12', '2023-10-26', '19:00:00', 'approved', 7, NULL, 7, 'pending'),
(31, 1, '2023-10-29 14:20:30', '2023-10-29', '15:00:00', 'approved', 18, NULL, 7, 'hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `role` enum('karyawan','dokter','perawat','pasien','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
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
(29, 'jaehyun', '123', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_data_keuangan_nota1_idx` (`nota_id`);

--
-- Indeks untuk tabel `data_dokter`
--
ALTER TABLE `data_dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_obat`
--
ALTER TABLE `data_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_perawat`
--
ALTER TABLE `data_perawat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwal_dokter_data_dokter1_idx` (`data_dokter_id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nota_data_karyawan1_idx` (`data_karyawan_id`),
  ADD KEY `fk_nota_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indeks untuk tabel `odontogram`
--
ALTER TABLE `odontogram`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_rekam_medis_odontogram_idx` (`rekam_medis_id`),
  ADD KEY `fk_data_pasien_odontogram_idx` (`data_pasien_id`);

--
-- Indeks untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rekam_medis_reservasi_kllinik1_idx` (`reservasi_kllinik_id`),
  ADD KEY `fk_rekam_medis_jadwal_dokter1_idx` (`jadwal_dokter_id`),
  ADD KEY `fk_rekam_medis_data_perawat1_idx` (`data_perawat_id`);

--
-- Indeks untuk tabel `rekam_medis_has_alat`
--
ALTER TABLE `rekam_medis_has_alat`
  ADD PRIMARY KEY (`rekam_medis_id`,`alat_id`),
  ADD KEY `fk_rekam_medis_has_alat_alat1_idx` (`alat_id`),
  ADD KEY `fk_rekam_medis_has_alat_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indeks untuk tabel `rekam_medis_has_layanan`
--
ALTER TABLE `rekam_medis_has_layanan`
  ADD PRIMARY KEY (`rekam_medis_id`,`layanan_id`),
  ADD KEY `fk_rekam_medis_has_layanan_layanan1_idx` (`layanan_id`),
  ADD KEY `fk_rekam_medis_has_layanan_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indeks untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD KEY `fk_rekam_medis_has_data_obat_data_obat1_idx` (`data_obat_id`),
  ADD KEY `fk_rekam_medis_has_data_obat_rekam_medis1_idx` (`rekam_medis_id`);

--
-- Indeks untuk tabel `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservasi_kllinik_jadwal_dokter1_idx` (`jadwal_dokter_id`),
  ADD KEY `fk_reservasi_kllinik_data_karyawan1_idx` (`data_karyawan_id`),
  ADD KEY `fk_reservasi_kllinik_data_pasien1_idx` (`data_pasien_id_pasien`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_dokter`
--
ALTER TABLE `data_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_obat`
--
ALTER TABLE `data_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_perawat`
--
ALTER TABLE `data_perawat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `odontogram`
--
ALTER TABLE `odontogram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `catatan_keuangan`
--
ALTER TABLE `catatan_keuangan`
  ADD CONSTRAINT `fk_data_keuangan_nota1` FOREIGN KEY (`nota_id`) REFERENCES `nota` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `fk_jadwal_dokter_data_dokter1` FOREIGN KEY (`data_dokter_id`) REFERENCES `data_dokter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_data_karyawan1` FOREIGN KEY (`data_karyawan_id`) REFERENCES `data_karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `odontogram`
--
ALTER TABLE `odontogram`
  ADD CONSTRAINT `fk_data_pasien_odontogram_idx` FOREIGN KEY (`data_pasien_id`) REFERENCES `data_pasien` (`id`),
  ADD CONSTRAINT `fk_rekam_medis_odontogram_idx` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`);

--
-- Ketidakleluasaan untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `fk_rekam_medis_data_perawat1` FOREIGN KEY (`data_perawat_id`) REFERENCES `data_perawat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_jadwal_dokter1` FOREIGN KEY (`jadwal_dokter_id`) REFERENCES `jadwal_dokter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_reservasi_kllinik1` FOREIGN KEY (`reservasi_kllinik_id`) REFERENCES `reservasi_kllinik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `rekam_medis_has_alat`
--
ALTER TABLE `rekam_medis_has_alat`
  ADD CONSTRAINT `fk_rekam_medis_has_alat_alat1` FOREIGN KEY (`alat_id`) REFERENCES `alat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_has_alat_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `rekam_medis_has_layanan`
--
ALTER TABLE `rekam_medis_has_layanan`
  ADD CONSTRAINT `fk_rekam_medis_has_layanan_layanan1` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_has_layanan_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `fk_rekam_medis_has_data_obat_data_obat1` FOREIGN KEY (`data_obat_id`) REFERENCES `data_obat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rekam_medis_has_data_obat_rekam_medis1` FOREIGN KEY (`rekam_medis_id`) REFERENCES `rekam_medis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `reservasi_kllinik`
--
ALTER TABLE `reservasi_kllinik`
  ADD CONSTRAINT `fk_reservasi_kllinik_data_karyawan1` FOREIGN KEY (`data_karyawan_id`) REFERENCES `data_karyawan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservasi_kllinik_data_pasien1` FOREIGN KEY (`data_pasien_id_pasien`) REFERENCES `data_pasien` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservasi_kllinik_jadwal_dokter1` FOREIGN KEY (`jadwal_dokter_id`) REFERENCES `jadwal_dokter` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
