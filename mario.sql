-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 06:53 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mario`
--

-- --------------------------------------------------------

--
-- Table structure for table `acrue`
--

CREATE TABLE `acrue` (
  `id` int(100) NOT NULL,
  `tahun` int(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attach`
--

CREATE TABLE `attach` (
  `id` int(100) NOT NULL,
  `nama_dokumen` text NOT NULL,
  `id_laporan_bulanan` int(100) NOT NULL,
  `id_jenis_laporan` int(100) NOT NULL,
  `id_wilayah_operasi` int(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_mea`
--

CREATE TABLE `detail_mea` (
  `id` int(100) NOT NULL,
  `id_mea` int(100) NOT NULL,
  `klausul` text NOT NULL,
  `temuan` text NOT NULL,
  `dokumentasi` text,
  `yes` varchar(100) DEFAULT NULL,
  `no` varchar(100) DEFAULT NULL,
  `rekomendasi_perbaikan` text NOT NULL,
  `pic` text NOT NULL,
  `duedate` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `tanggal_closing` date NOT NULL,
  `dokumentasi_closing` text,
  `tindak_lanjut` text NOT NULL,
  `notifikasi` varchar(3) NOT NULL,
  `penindak_lanjut` int(100) NOT NULL,
  `status_penindaklanjut` varchar(2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_laporan_bulanan`
--

CREATE TABLE `dokumen_laporan_bulanan` (
  `id` int(100) NOT NULL,
  `prihal` text NOT NULL,
  `id_laporan_bulanan` int(100) NOT NULL,
  `nama_dokumen_laporan` text NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_laporan` int(100) NOT NULL,
  `wilayah_operasi` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_laporan_pekerjaan`
--

CREATE TABLE `dokumen_laporan_pekerjaan` (
  `id` int(100) NOT NULL,
  `id_laporan_pekerjaan` int(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_dokumen` varchar(100) NOT NULL,
  `file` text NOT NULL,
  `harga` bigint(200) NOT NULL,
  `durasi` int(100) NOT NULL,
  `nama_folder` varchar(100) NOT NULL,
  `no_urut` int(10) NOT NULL,
  `persentasi_pembayaran` int(11) NOT NULL,
  `id_spk_dev` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_laporan_pekerjaan_pagu`
--

CREATE TABLE `dokumen_laporan_pekerjaan_pagu` (
  `id` int(100) NOT NULL,
  `id_laporan_pekerjaan` int(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_dokumen` varchar(100) NOT NULL,
  `file` text NOT NULL,
  `harga` bigint(200) NOT NULL,
  `durasi` int(100) NOT NULL,
  `nama_folder` varchar(100) NOT NULL,
  `no_urut` int(10) NOT NULL,
  `persentasi_pembayaran` int(11) NOT NULL,
  `id_spk_dev` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eproc`
--

CREATE TABLE `eproc` (
  `id` int(100) NOT NULL,
  `id_spk_dev` int(100) NOT NULL,
  `nomor_po` bigint(20) NOT NULL,
  `nomor_receipt` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `file_pembuatan_surat`
--

CREATE TABLE `file_pembuatan_surat` (
  `id` int(100) NOT NULL,
  `id_pembuatan_surat` int(100) NOT NULL,
  `perihal` text NOT NULL,
  `nama_file` text NOT NULL,
  `catatan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(100) NOT NULL,
  `id_pembuatan_surat` int(100) NOT NULL,
  `tanggal_menerima` date NOT NULL,
  `file` text NOT NULL,
  `penerima` int(100) NOT NULL,
  `ttd` text NOT NULL,
  `catatan` text NOT NULL,
  `status` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_laporan_bulanan`
--

CREATE TABLE `history_laporan_bulanan` (
  `id` int(100) NOT NULL,
  `jenis_laporan` int(100) NOT NULL,
  `id_dokumen_bulanan` int(100) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_users` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_anggaran`
--

CREATE TABLE `jenis_anggaran` (
  `id` int(100) NOT NULL,
  `jenis_anggaran` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laporan`
--

CREATE TABLE `jenis_laporan` (
  `id` int(100) NOT NULL,
  `id_laporan_bulanan` int(100) NOT NULL,
  `id_wilayah_operasi` int(100) NOT NULL,
  `jenis` text NOT NULL,
  `id_tujuan` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pekerjaan`
--

CREATE TABLE `jenis_pekerjaan` (
  `id` int(100) NOT NULL,
  `jenis_pekerjaan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan`
--

CREATE TABLE `laporan_bulanan` (
  `id` int(100) NOT NULL,
  `bulan` int(100) NOT NULL,
  `tahun` int(4) NOT NULL,
  `arsip` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_bulanan_revisi`
--

CREATE TABLE `laporan_bulanan_revisi` (
  `id` int(100) NOT NULL,
  `id_laporan_bulanan` int(100) NOT NULL,
  `id_dokumen_laporan_bulanan` int(100) NOT NULL,
  `user` int(100) NOT NULL,
  `nama_gambar` text NOT NULL,
  `halaman` int(100) NOT NULL,
  `input` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pekerjaan`
--

CREATE TABLE `laporan_pekerjaan` (
  `id` int(100) NOT NULL,
  `nama_pekerjaan` varchar(300) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `pic` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL,
  `wilayah_operasi` varchar(100) NOT NULL,
  `jenis_pekerjaan` varchar(100) NOT NULL,
  `tahun` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pekerjaan_pagu`
--

CREATE TABLE `laporan_pekerjaan_pagu` (
  `id` int(100) NOT NULL,
  `nama_pekerjaan` varchar(300) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `pic` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL,
  `wilayah_operasi` varchar(100) NOT NULL,
  `tahun` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mea`
--

CREATE TABLE `mea` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `expired` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `pj1` varchar(100) NOT NULL,
  `pj2` varchar(100) NOT NULL,
  `penyusun1` varchar(100) NOT NULL,
  `penyusun2` varchar(100) NOT NULL,
  `file_laporan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif_catatan_revisi`
--

CREATE TABLE `notif_catatan_revisi` (
  `id` int(100) NOT NULL,
  `id_jenis_laporan` int(100) NOT NULL,
  `id_dokumen_laporan` int(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif_pelaporan`
--

CREATE TABLE `notif_pelaporan` (
  `id` int(100) NOT NULL,
  `id_users` int(100) NOT NULL,
  `id_laporan_bulanan` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembuatan_surat`
--

CREATE TABLE `pembuatan_surat` (
  `id` int(100) NOT NULL,
  `nomor_surat` text NOT NULL,
  `sifat` text NOT NULL,
  `lampiran` text NOT NULL,
  `perihal` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tujuan` text NOT NULL,
  `alamat` text NOT NULL,
  `isi` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `jenis_dokumen` text NOT NULL,
  `id_laporan_pekerjaan` int(10) NOT NULL,
  `tanggal_rapat` date NOT NULL,
  `namapic` text NOT NULL,
  `catatan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembuatan_surat_isi`
--

CREATE TABLE `pembuatan_surat_isi` (
  `id` int(100) NOT NULL,
  `id_pembuatan_surat` int(100) NOT NULL,
  `prihal` text NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyusun_mea`
--

CREATE TABLE `penyusun_mea` (
  `id` int(100) NOT NULL,
  `id_mea` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `creaed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perencanaan`
--

CREATE TABLE `perencanaan` (
  `id` int(100) NOT NULL,
  `nama_pekerjaan` text NOT NULL,
  `bulan` int(100) NOT NULL,
  `sampai_bulan` int(100) NOT NULL,
  `tahun` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_surat`
--

CREATE TABLE `permintaan_surat` (
  `id` int(100) NOT NULL,
  `perihal_permintaan` text NOT NULL,
  `file` text,
  `catatan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pic_area`
--

CREATE TABLE `pic_area` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `perusahaan` varchar(100) NOT NULL,
  `jabatan` text NOT NULL,
  `alamat_kantor` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `popay`
--

CREATE TABLE `popay` (
  `id` int(100) NOT NULL,
  `nomor_pr` varchar(100) NOT NULL,
  `id_spk_dev` int(100) NOT NULL,
  `tanggal_input` date NOT NULL,
  `tanggal_paid` date NOT NULL,
  `rupiah` bigint(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `popay_pagu`
--

CREATE TABLE `popay_pagu` (
  `id` int(11) NOT NULL,
  `nomor_pr` varchar(100) NOT NULL,
  `id_spk_dev` int(100) NOT NULL,
  `tanggal_input` date NOT NULL,
  `tanggal_paid` date NOT NULL,
  `rupiah` bigint(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spk_dev`
--

CREATE TABLE `spk_dev` (
  `id` int(100) NOT NULL,
  `id_dokumen` int(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `persentasi` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jenis_anggaran` int(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spk_dev_pagu`
--

CREATE TABLE `spk_dev_pagu` (
  `id` int(100) NOT NULL,
  `id_dokumen` int(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `persentasi` int(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_surat`
--

CREATE TABLE `surat_surat` (
  `id` int(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `perihal` text NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `file` text NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hak_akses` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `hak_akses`, `gambar`, `penanggung_jawab`, `pt`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ario', 'ario', 'ariodw44@gmail.com', NULL, '$2y$10$mwZGudegyHIKioP4utNUT.cLHpDrOKvDoobj/KMMS/TF9WKijKrFO', 'admin', '(52503) IMG_0451 copy.JPG', '', 'PT PGN', 'fO1ok2c98MmxLcAxW61laMWc7KSJJGbEFIILNdxwHBUdZQDRHxFwn8BM7X03', '2019-03-29 00:47:55', '2020-12-02 21:45:55'),
(5, 'anang.susanto', 'Anang Susanto', 'Sony.Achmad@pgn.co.id', NULL, '$2y$10$M5T67lA8AqWRpQyJS/izpuqXuPbNIKvKqg9lbcy8JBxV6ZKQxOAj.', 'user', '(82785) pgnpgn.PNG', '', 'PT PGN', NULL, '2019-06-10 01:12:37', '2019-06-10 01:12:37'),
(6, 'mahar.prasetyo', 'Mahar Prasetyo', 'Mahar.Prasetyo@pgn.co.id', NULL, '$2y$10$akWTsooZz.WdKCzSG6yvZ.PLiEw18zu0EFWmxMAk2FAL0rwn6wWEy', 'user', '(80279) mahar.jpg', '', 'PT PGN', NULL, '2019-06-10 01:14:37', '2019-06-10 01:14:37'),
(7, 'sony.achmad', 'Sony Achmad', 'Sony.Achmad@pgn.co.id', NULL, '$2y$10$B1KAXjkEk2TaRexWkS.ENe766QvX9jm8FDFkSxWoBFM4r2vv3ETRa', 'user', '(56364) pgnpgn.PNG', 'WOJBB', 'PT PGN', NULL, '2019-07-25 20:27:54', '2019-07-25 20:27:54'),
(8, 'akrom.wibowo', 'Akrom Akhmadi Wibowo', 'Akrom.Wibowo@pgn.co.id', NULL, '$2y$10$BsVENslpP4u0n2ud2gO4Y.2HVnGPERzy3sKILl6ogbmARPAlzW/1m', 'user', '(66095) akrom.jpg', '', 'PT PGN', NULL, '2019-07-29 02:24:19', '2019-07-29 02:24:19'),
(9, 'haris.wicaksono', 'Haris Wicaksono', 'Haris.Wicaksono@pgn.co.id', NULL, '$2y$10$Cd9QvHJb44sHgasvcjPD4OdpV6kDtxep7i3poIYsWsnrjPEfhUX52', 'user', '(38782) pgnpgn.PNG', '', 'PT PGN', NULL, '2019-07-29 17:34:19', '2019-07-29 17:34:19'),
(10, 'citra.pranandar', 'Citra Pranandar', 'Citra.Pranandar@pgn.co.id', NULL, '$2y$10$aoZLJbsVtxGaLKqOqdlo0ukTYkuVPWI.ABfikR9Br879Bw1hO1H9a', 'Eproc', '(40677) pgnpgn.PNG', '', 'PT PGN', NULL, '2019-07-30 19:12:09', '2019-07-30 19:12:09'),
(11, 'farah.diba', 'Farah Diba', 'Secretary.GTM@pgn.co.id', NULL, '$2y$10$VPIlkq4zs.gmLfl8i.VqSORZtxFbYlfZMmrwXUbPpmO5D99LH6gs6', 'user', '(43042) pgnpgn.PNG', '', 'PT PGN', NULL, '2019-07-30 23:37:57', '2019-07-30 23:37:57'),
(12, 'agung.kurniansyah', 'Agung Rahmat Kurniansyah', 'Agung.Kurniansyah@pgn.co.id', NULL, '$2y$10$qRwalZg7os51jQOAhfigQuM6JLMu39xjTdTnxHlyHdQx76xz8hqhG', 'Koordinator', '(96952) pgnpgn.PNG', '', 'PT PGN', NULL, '2019-07-31 00:34:22', '2019-07-31 00:34:22'),
(13, 'emi.hermanto', 'Emi Heru Hermanto', 'emi.hermanto@pgn.co.id', NULL, '$2y$10$o3irWG5C33GxPRA20Ao1D.vNrLINfu7ZVtLumAJWtXhZmvuzRS.e.', 'user', '(73518) Jellyfish.jpg', '', 'PT PGN', NULL, '2019-10-01 19:39:00', '2019-10-01 19:39:00'),
(15, 'santoso.pratomo', 'Santoso Priyo Pratomo', 'santoso.pratomo@pgn.co.id', NULL, '$2y$10$xIjjjwYes8nN7lb.XplRUu5L2/x/KEhKBT64f/IwuPOWWs4/qJn0C', 'user', '(11134) pgnpgn.PNG', 'WOSS', 'PT PGN', NULL, '2019-10-14 21:27:38', '2019-10-14 21:27:38'),
(16, 'aditya.eka', 'Aditya Eka Wijaya', 'aditya.eka@pgn.co.id', NULL, '$2y$10$vPWChSblZiRvBPhS2QR84.ldSRJMexd4NhIqvU8Q/ZSFTgfy79ZVu', 'user', '(60583) Penguins.jpg', '', 'PT PGN', NULL, '2019-11-12 23:37:33', '2019-11-12 23:37:33'),
(17, 'faris.muhtadi', 'Faris Muhtadi', 'faris.muhtadi@pgn.co.id', NULL, '$2y$10$iz3So/5OwQwLYdvVQwgG2.nhb0EsFYGibZYQ7FAkL./X8QL95./52', 'user', '(20280) Penguins.jpg', '', 'PT PGN', NULL, '2019-11-15 01:01:51', '2019-11-15 01:01:51'),
(18, 'henki.rizulianta', 'Henki Rizulianta', 'henki.rizulianta@pgn.co.id', NULL, '$2y$10$NyqYWyPWtbVZtD7Gw/6xrO.vqciaRpAGGE3ZH3r4y4HPQpF7JqYPO', 'user', '(47624) ipc9.png', '', 'PT PGASOL', NULL, '2019-11-17 07:59:23', '2019-11-17 07:59:23'),
(19, 'hari.aribowo', 'Hari Satria Aribowo', 'hari.aribowo@pgn.co.id', NULL, '$2y$10$8.uVIWh6x5oWKMl6zWAozuS5Ni.8Ptiedp0Xv0PBGBXcriJyJEi.O', 'user', '(42352) Hydrangeas.jpg', '', '', NULL, '2019-11-26 20:16:43', '2019-11-26 20:16:43'),
(20, 'imron.rosyidi', 'Imron Rosyidi', 'imronadi25@gmail.com', NULL, '$2y$10$K9rYq94fmvmNwL8OabDwae/oDY.99K.wnQB2hGAyM3/046RCSobQK', 'user', '(31920) Screenshot_2019-12-13-11-24-57-125_com.whatsapp.jpg', '', '', NULL, '2019-12-12 21:26:23', '2019-12-12 21:26:23'),
(21, 'made.artama', 'I Made Yudi Artama', 'Made.Artama@pgn.co.id', NULL, '$2y$10$LDuKFl9wULYLYqfZSfTAse1YVECtfueGZThbi41xGM8nvxeVLl6Vm', 'user', '(14253) pp.jpg', '', '', NULL, '2019-12-12 23:38:29', '2019-12-12 23:38:29'),
(22, 'denita', 'denita', 'denita@pgn.co.id', NULL, '$2y$10$FvZQY2X/xIIIQPiUtIeKvO/Xz0OxExh5Kn.NUrbxPhk7Px9hoSKF.', 'user', '(79492) Hydrangeas.jpg', '', '', NULL, '2019-12-16 00:43:49', '2019-12-16 00:43:49'),
(23, 'sony.sungkawa', 'Sony Sungkawa', 'gtmmario@gmail.com', NULL, '$2y$10$pO1mBsiUdGc7jJ0m344Ixu6LqS3C.UWRhBZMS1I8aOtMoFnmV8fO6', 'user', '(13822) unnamed.jpg', '', '', NULL, '2019-12-22 19:14:06', '2020-05-03 17:46:58'),
(24, 'hari.satria', 'Hari Satria', 'hari.satria@pgn.co.id', NULL, '$2y$10$PBc.elqOJ2yRQliGrgTdouzHRMCEq2PUB9G9l8Kdouenh6lXkuOnO', 'user', '(45732) Tulips.jpg', '', '', NULL, '2020-01-29 21:11:39', '2020-01-29 21:11:39'),
(25, 'mira', 'Mira Fatmawati', 'mira.fatmawati@pgn.co.id', NULL, '$2y$10$ksa/n7xTq3L3p/VvUgR2kuMLmjG5qFoeMyicpQ11s8LSPmffyQip6', 'user', '(21958) Tulips.jpg', '', '', NULL, '2020-07-13 00:06:00', '2020-07-28 14:28:14'),
(27, 'dea', 'dea', 'dea@gmail.com', NULL, '$2y$10$Ij5Ws7xgjdzoksWI396DYu2prZItd2/L.mUs08.X9OVHpQazwoIFq', 'user', '(68890) (56364) pgnpgn.png', '', '', NULL, '2020-07-30 00:02:41', '2020-07-30 00:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_review_catatan_revisisi`
--

CREATE TABLE `user_review_catatan_revisisi` (
  `id` int(100) NOT NULL,
  `id_notif_catatan_review` int(100) NOT NULL,
  `user_review` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_id_mea`
--

CREATE TABLE `verifikasi_id_mea` (
  `id` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_mea` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_operasi`
--

CREATE TABLE `wilayah_operasi` (
  `id` int(100) NOT NULL,
  `id_laporan_bulanan` int(100) NOT NULL,
  `wilayah_operasi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_operasi_mea`
--

CREATE TABLE `wilayah_operasi_mea` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `wilayah` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acrue`
--
ALTER TABLE `acrue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attach`
--
ALTER TABLE `attach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_mea`
--
ALTER TABLE `detail_mea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen_laporan_bulanan`
--
ALTER TABLE `dokumen_laporan_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen_laporan_pekerjaan`
--
ALTER TABLE `dokumen_laporan_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen_laporan_pekerjaan_pagu`
--
ALTER TABLE `dokumen_laporan_pekerjaan_pagu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eproc`
--
ALTER TABLE `eproc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_pembuatan_surat`
--
ALTER TABLE `file_pembuatan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_laporan_bulanan`
--
ALTER TABLE `history_laporan_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_anggaran`
--
ALTER TABLE `jenis_anggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_bulanan_revisi`
--
ALTER TABLE `laporan_bulanan_revisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_pekerjaan`
--
ALTER TABLE `laporan_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_pekerjaan_pagu`
--
ALTER TABLE `laporan_pekerjaan_pagu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mea`
--
ALTER TABLE `mea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif_catatan_revisi`
--
ALTER TABLE `notif_catatan_revisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif_pelaporan`
--
ALTER TABLE `notif_pelaporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembuatan_surat`
--
ALTER TABLE `pembuatan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembuatan_surat_isi`
--
ALTER TABLE `pembuatan_surat_isi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyusun_mea`
--
ALTER TABLE `penyusun_mea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perencanaan`
--
ALTER TABLE `perencanaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaan_surat`
--
ALTER TABLE `permintaan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pic_area`
--
ALTER TABLE `pic_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popay`
--
ALTER TABLE `popay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popay_pagu`
--
ALTER TABLE `popay_pagu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spk_dev`
--
ALTER TABLE `spk_dev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spk_dev_pagu`
--
ALTER TABLE `spk_dev_pagu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_surat`
--
ALTER TABLE `surat_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_review_catatan_revisisi`
--
ALTER TABLE `user_review_catatan_revisisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifikasi_id_mea`
--
ALTER TABLE `verifikasi_id_mea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wilayah_operasi`
--
ALTER TABLE `wilayah_operasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wilayah_operasi_mea`
--
ALTER TABLE `wilayah_operasi_mea`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acrue`
--
ALTER TABLE `acrue`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attach`
--
ALTER TABLE `attach`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_mea`
--
ALTER TABLE `detail_mea`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_laporan_bulanan`
--
ALTER TABLE `dokumen_laporan_bulanan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_laporan_pekerjaan`
--
ALTER TABLE `dokumen_laporan_pekerjaan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_laporan_pekerjaan_pagu`
--
ALTER TABLE `dokumen_laporan_pekerjaan_pagu`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eproc`
--
ALTER TABLE `eproc`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_pembuatan_surat`
--
ALTER TABLE `file_pembuatan_surat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_laporan_bulanan`
--
ALTER TABLE `history_laporan_bulanan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_anggaran`
--
ALTER TABLE `jenis_anggaran`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_pekerjaan`
--
ALTER TABLE `jenis_pekerjaan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_bulanan`
--
ALTER TABLE `laporan_bulanan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_bulanan_revisi`
--
ALTER TABLE `laporan_bulanan_revisi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_pekerjaan`
--
ALTER TABLE `laporan_pekerjaan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_pekerjaan_pagu`
--
ALTER TABLE `laporan_pekerjaan_pagu`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mea`
--
ALTER TABLE `mea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notif_catatan_revisi`
--
ALTER TABLE `notif_catatan_revisi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notif_pelaporan`
--
ALTER TABLE `notif_pelaporan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembuatan_surat`
--
ALTER TABLE `pembuatan_surat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembuatan_surat_isi`
--
ALTER TABLE `pembuatan_surat_isi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyusun_mea`
--
ALTER TABLE `penyusun_mea`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perencanaan`
--
ALTER TABLE `perencanaan`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan_surat`
--
ALTER TABLE `permintaan_surat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pic_area`
--
ALTER TABLE `pic_area`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popay`
--
ALTER TABLE `popay`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popay_pagu`
--
ALTER TABLE `popay_pagu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spk_dev`
--
ALTER TABLE `spk_dev`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spk_dev_pagu`
--
ALTER TABLE `spk_dev_pagu`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_surat`
--
ALTER TABLE `surat_surat`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_review_catatan_revisisi`
--
ALTER TABLE `user_review_catatan_revisisi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verifikasi_id_mea`
--
ALTER TABLE `verifikasi_id_mea`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayah_operasi`
--
ALTER TABLE `wilayah_operasi`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayah_operasi_mea`
--
ALTER TABLE `wilayah_operasi_mea`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
