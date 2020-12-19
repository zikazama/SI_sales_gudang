-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 03:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisagu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`, `foto`, `nama_admin`, `created_at`) VALUES
(1, 'fauzi190198@gmail.com', '123456', 'f74b1f6b4c38c0784c22a244ae5211d8.jpg', 'Fauzi', '2020-06-15 02:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `akses_toko`
--

CREATE TABLE `akses_toko` (
  `id_akses_toko` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akses_toko`
--

INSERT INTO `akses_toko` (`id_akses_toko`, `id_toko`, `id_sales`, `created_at`) VALUES
(2, 1, 1, '2020-12-19 14:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `harga_perbox` int(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_perbox` int(11) NOT NULL,
  `diskon` int(225) NOT NULL,
  `diskon_perbox` int(255) NOT NULL,
  `minimal_kuantitas_diskon` int(11) NOT NULL,
  `minimal_kuantitas_diskon_perbox` int(11) NOT NULL,
  `isi_pcs_perbox` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `merek`, `harga`, `harga_perbox`, `stok`, `stok_perbox`, `diskon`, `diskon_perbox`, `minimal_kuantitas_diskon`, `minimal_kuantitas_diskon_perbox`, `isi_pcs_perbox`, `foto`, `created_at`) VALUES
(2, 'Tas', 'gucci', 300000, 600000, 92, 1, 10000, 5000, 5, 3, 0, 'fe390655d9710d87ecf83207e4d3c924.jpg', '2020-12-19 04:09:34'),
(3, 'Bahan', 'LG', 40000, 150000, 174, 48, 20000, 10000, 50, 10, 0, '2f5b1b913b2f3a286062c24d838717fa.jpg', '2020-12-19 04:09:34'),
(4, 'Ayam Goreng', 'geprek', 15000, 50000, 10, 15, 2000, 3000, 5, 5, 10, '3479a78a9bbc3f47aa57091affab097e.jpg', '2020-11-06 12:31:58'),
(5, 'Cumi', 'Mantap', 20000, 70000, 2, 14, 1000, 2000, 5, 5, 0, 'de98593bf1a324c4406077308d43bb3a.jpg', '2020-12-18 17:31:48'),
(6, 'Lele', 'Pecel', 10000, 50000, 5, 20, 5000, 3000, 5, 5, 0, '01d24f080df6a12e0d16dada29b346e7.jpg', '2020-11-02 06:14:18'),
(7, 'Vape', 'bagus', 100000, 500000, 4, 14, 50000, 100000, 5, 5, 0, '2d688a4a13230596fba407b793f1a91f.jpg', '2020-11-02 06:14:18'),
(8, 'BBQ', 'top', 30000, 200000, 23, 20, 500, 0, 10, 10, 0, 'eadbdcc64304f899e0a75f0cef9156ee.jpg', '2020-11-02 06:14:19'),
(9, 'sate', 'padang', 20000, 30000, 30, 12, 500, 2000, 5, 10, 0, '2eda22fc3f72d95868c1acd95287fe73.jpg', '2020-11-02 06:14:19'),
(10, 'chicken', 'ss', 21000, 50000, 41, 20, 1000, 2000, 5, 10, 0, '454f097fc32f4fbb53a0203681bf1d56.jpg', '2020-11-02 06:14:19'),
(11, 'jasuke', 'top', 5000, 20000, 40, 20, 500, 1000, 5, 15, 0, 'd9b97b2ea06b82bc8b8b68db7f8b85a9.jpg', '2020-11-02 06:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id_driver` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `nama_driver` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id_driver`, `nik`, `email`, `password`, `foto`, `nama_driver`, `created_at`) VALUES
(1, 19, 'zi@gmail.com', '010101', '4229831bdacdcc7dd2e9197dc20bd12e.jpg', 'Zi', '2020-12-15 13:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `item_transaksi`
--

CREATE TABLE `item_transaksi` (
  `id_item_transaksi` int(11) NOT NULL,
  `id_transaksi_sales` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `kuantitas_perbox` int(11) NOT NULL,
  `harga_fix_pcs` int(11) NOT NULL,
  `harga_fix_box` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `subdiskon` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_transaksi`
--

INSERT INTO `item_transaksi` (`id_item_transaksi`, `id_transaksi_sales`, `id_barang`, `kuantitas`, `kuantitas_perbox`, `harga_fix_pcs`, `harga_fix_box`, `subtotal`, `subdiskon`, `created_at`) VALUES
(8, 9, 2, 2, 0, 0, 0, 600000, 0, '2020-06-14 18:37:50'),
(9, 10, 2, 5, 0, 0, 0, 1500000, 10000, '2020-06-15 04:17:12'),
(10, 11, 2, 3, 0, 0, 0, 900000, 0, '2020-06-25 10:45:55'),
(11, 12, 2, 3, 0, 0, 0, 900000, 0, '2020-06-26 10:48:22'),
(12, 13, 3, 10, 0, 0, 0, 300000, 6000, '2020-07-04 09:02:37'),
(13, 14, 3, 2, 0, 0, 0, 60000, 0, '2020-07-04 09:05:05'),
(14, 15, 3, 5, 0, 0, 0, 150000, 0, '2020-07-10 16:31:42'),
(15, 16, 2, 1, 0, 0, 0, 300000, 0, '2020-07-22 11:06:18'),
(16, 17, 2, 1, 0, 0, 0, 300000, 0, '2020-07-22 11:13:19'),
(17, 18, 2, 20, 4, 0, 0, 21600000, 45000, '2020-09-03 13:12:21'),
(18, 19, 2, 20, 10, 0, 0, 12000000, 250000, '2020-10-13 01:59:09'),
(19, 20, 2, 15, 0, 0, 0, 4500000, 150000, '2020-10-13 02:12:20'),
(20, 21, 2, 15, 0, 0, 0, 4500000, 150000, '2020-10-13 02:12:48'),
(21, 22, 2, 10, 5, 0, 0, 6000000, 125000, '2020-10-13 02:31:06'),
(22, 23, 2, 5, 0, 0, 0, 1500000, 50000, '2020-10-13 02:33:40'),
(23, 23, 3, 5, 0, 0, 0, 200000, 0, '2020-10-13 02:33:40'),
(24, 24, 2, 5, 0, 0, 0, 1500000, 50000, '2020-10-26 06:12:50'),
(25, 24, 3, 2, 0, 0, 0, 80000, 0, '2020-10-26 06:12:50'),
(26, 24, 4, 3, 0, 0, 0, 45000, 0, '2020-10-26 06:12:50'),
(27, 24, 5, 4, 0, 0, 0, 80000, 0, '2020-10-26 06:12:50'),
(28, 24, 6, 5, 0, 0, 0, 50000, 25000, '2020-10-26 06:12:51'),
(29, 25, 2, 1, 0, 0, 0, 300000, 0, '2020-10-26 06:14:18'),
(30, 25, 3, 2, 0, 0, 0, 80000, 0, '2020-10-26 06:14:19'),
(31, 25, 4, 3, 0, 0, 0, 45000, 0, '2020-10-26 06:14:19'),
(32, 25, 5, 4, 0, 0, 0, 80000, 0, '2020-10-26 06:14:19'),
(33, 25, 6, 5, 0, 0, 0, 50000, 25000, '2020-10-26 06:14:19'),
(34, 25, 7, 6, 0, 0, 0, 600000, 300000, '2020-10-26 06:14:19'),
(35, 26, 2, 1, 0, 0, 0, 300000, 0, '2020-10-26 18:55:10'),
(36, 27, 2, 1, 0, 0, 0, 300000, 0, '2020-11-02 06:14:18'),
(37, 27, 3, 0, 2, 0, 0, 300000, 0, '2020-11-02 06:14:18'),
(38, 27, 4, 3, 0, 0, 0, 45000, 0, '2020-11-02 06:14:18'),
(39, 27, 5, 0, 4, 0, 0, 280000, 0, '2020-11-02 06:14:18'),
(40, 27, 6, 5, 0, 0, 0, 50000, 25000, '2020-11-02 06:14:18'),
(41, 27, 7, 0, 6, 0, 0, 3000000, 600000, '2020-11-02 06:14:18'),
(42, 27, 8, 7, 0, 0, 0, 210000, 0, '2020-11-02 06:14:18'),
(43, 27, 9, 0, 8, 0, 0, 240000, 0, '2020-11-02 06:14:19'),
(44, 27, 10, 9, 0, 0, 0, 189000, 9000, '2020-11-02 06:14:19'),
(45, 27, 11, 10, 0, 0, 0, 50000, 5000, '2020-11-02 06:14:19'),
(46, 28, 2, 2, 0, 0, 0, 500000, 0, '2020-11-02 08:01:51'),
(47, 29, 3, 2, 0, 0, 0, 60000, 0, '2020-11-02 08:05:01'),
(48, 30, 3, 2, 0, 0, 0, 40000, 0, '2020-11-02 08:06:54'),
(49, 31, 2, 2, 0, 0, 0, 400000, 0, '2020-11-02 08:14:33'),
(51, 33, 3, 2, 0, 10000, 150000, 20000, 0, '2020-11-03 05:51:19'),
(52, 34, 2, 2, 0, 300000, 600000, 600000, 0, '2020-12-13 15:38:23'),
(53, 35, 2, 3, 0, 300000, 600000, 900000, 0, '2020-12-15 14:31:41'),
(61, 36, 3, 1, 0, 40000, 150000, 40000, 0, '2020-12-19 04:09:34'),
(62, 36, 2, 3, 0, 300000, 600000, 900000, 0, '2020-12-19 04:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi_sales` int(11) NOT NULL,
  `jumlah_pembayaran` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi_sales`, `jumlah_pembayaran`, `created_at`) VALUES
(1, 12, 800000, '2020-06-26 12:10:56'),
(3, 13, 0, '2020-07-04 09:02:37'),
(4, 14, 0, '2020-07-04 09:05:05'),
(5, 15, 0, '2020-07-10 16:31:42'),
(6, 15, 150000, '2020-07-16 05:03:43'),
(7, 15, 150000, '2020-07-16 05:07:19'),
(12, 14, 60000, '2020-07-16 05:24:59'),
(13, 16, 0, '2020-07-22 11:06:19'),
(14, 17, 100000, '2020-07-22 11:13:19'),
(15, 18, 18000000, '2020-09-03 13:12:21'),
(16, 19, 5000000, '2020-10-13 01:59:10'),
(17, 20, 2000000, '2020-10-13 02:12:20'),
(18, 21, 2000000, '2020-10-13 02:12:48'),
(19, 21, 2350000, '2020-10-13 02:18:45'),
(20, 22, 200000, '2020-10-13 02:31:06'),
(21, 23, 1000000, '2020-10-13 02:33:40'),
(22, 24, 500000, '2020-10-26 06:12:51'),
(23, 25, 300000, '2020-10-26 06:14:19'),
(28, 25, 100000, '2020-10-26 18:46:16'),
(29, 25, 430000, '2020-10-26 18:48:24'),
(30, 26, 300000, '2020-10-26 18:55:10'),
(31, 27, 2000000, '2020-11-02 06:14:19'),
(32, 28, 0, '2020-11-02 08:01:52'),
(33, 29, 0, '2020-11-02 08:05:01'),
(34, 30, 0, '2020-11-02 08:06:54'),
(35, 31, 0, '2020-11-02 08:14:33'),
(36, 32, 0, '2020-11-03 05:36:23'),
(37, 33, 0, '2020-11-03 05:51:20'),
(38, 34, 300000, '2020-12-13 15:38:23'),
(39, 35, 200000, '2020-12-15 14:31:41'),
(40, 36, 20000, '2020-12-15 14:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `rkab`
--

CREATE TABLE `rkab` (
  `id_rkab` int(11) NOT NULL,
  `id_transaksi_sales` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rkab_item`
--

CREATE TABLE `rkab_item` (
  `id_rkab_item` int(11) NOT NULL,
  `id_rkab` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL,
  `nik` int(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `nama_sales` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sales`, `nik`, `email`, `password`, `foto`, `nama_sales`, `created_at`) VALUES
(1, 3030, 'jovan@gmail.com', '123456', 'dbb111e624dfc0c066d5f43d3fc7d735.jpg', 'Jovan', '2020-06-15 02:52:32'),
(3, 200, 'eren@gmail.com', '123456', 'c02da80f039219c3f28db3f646b26d86.jpeg', 'eren', '2020-06-15 01:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `kode_toko` varchar(6) NOT NULL,
  `nama_toko` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `kode_toko`, `nama_toko`, `alamat`, `latitude`, `longitude`, `created_at`) VALUES
(1, '645333', 'Dadang', 'Subang', -6.9337088, 107.60683519999999, '2020-12-19 14:51:38'),
(2, '32442', 'Gio', 'ogi', 0, 0, '2020-10-09 01:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_admin`
--

CREATE TABLE `transaksi_admin` (
  `id_transaksi_admin` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `transaksi` enum('create','update','delete') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sales`
--

CREATE TABLE `transaksi_sales` (
  `id_transaksi_sales` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `total` int(225) NOT NULL,
  `diskon` int(225) NOT NULL,
  `is_lunas` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('diterima','pending','ditolak') NOT NULL DEFAULT 'diterima',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_sales`
--

INSERT INTO `transaksi_sales` (`id_transaksi_sales`, `id_sales`, `id_toko`, `total`, `diskon`, `is_lunas`, `status`, `created_at`) VALUES
(10, 1, 1, 1500000, 10000, 0, 'diterima', '2020-07-04 07:02:58'),
(11, 1, 1, 900000, 0, 0, 'diterima', '2020-07-04 07:03:00'),
(12, 1, 1, 900000, 0, 0, 'diterima', '2020-07-04 07:03:03'),
(13, 1, 1, 300000, 6000, 0, 'diterima', '2020-07-04 09:02:37'),
(14, 1, 1, 60000, 0, 1, 'diterima', '2020-07-16 05:24:59'),
(15, 1, 1, 150000, 0, 0, 'diterima', '2020-07-10 16:31:42'),
(16, 1, 1, 300000, 0, 0, 'diterima', '2020-07-22 11:06:18'),
(17, 1, 1, 300000, 0, 0, 'diterima', '2020-07-22 11:13:19'),
(18, 1, 1, 21600000, 45000, 0, 'diterima', '2020-09-03 13:12:21'),
(19, 1, 1, 27000000, 250000, 0, 'diterima', '2020-10-13 01:59:09'),
(20, 1, 2, 4350000, 150000, 0, 'diterima', '2020-10-13 02:12:20'),
(21, 1, 2, 4350000, 150000, 1, 'diterima', '2020-10-13 02:18:45'),
(22, 1, 1, 5875000, 125000, 0, 'diterima', '2020-10-13 02:31:06'),
(23, 1, 2, 1650000, 50000, 0, 'diterima', '2020-10-13 02:33:40'),
(24, 1, 1, 1680000, 75000, 0, 'diterima', '2020-10-26 06:12:50'),
(25, 1, 1, 830000, 325000, 1, 'diterima', '2020-10-26 18:48:24'),
(26, 1, 2, 300000, 0, 1, 'diterima', '2020-10-26 18:55:10'),
(27, 1, 1, 4025000, 639000, 0, 'diterima', '2020-11-02 06:14:18'),
(28, 1, 1, 500000, 0, 0, 'diterima', '2020-11-02 08:01:51'),
(29, 1, 2, 60000, 0, 0, 'diterima', '2020-11-02 08:05:01'),
(30, 1, 2, 40000, 0, 0, 'diterima', '2020-11-02 08:06:54'),
(31, 1, 1, 400000, 0, 0, 'diterima', '2020-11-03 01:42:19'),
(32, 1, 1, 200000, 0, 0, 'diterima', '2020-11-03 05:48:07'),
(33, 1, 2, 20000, 0, 0, 'ditolak', '2020-11-03 06:08:26'),
(34, 1, 1, 600000, 0, 0, 'diterima', '2020-12-13 15:38:23'),
(35, 1, 1, 900000, 0, 0, 'diterima', '2020-12-15 14:31:40'),
(36, 1, 1, 940000, 0, 0, 'pending', '2020-12-19 04:09:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `akses_toko`
--
ALTER TABLE `akses_toko`
  ADD PRIMARY KEY (`id_akses_toko`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id_driver`);

--
-- Indexes for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD PRIMARY KEY (`id_item_transaksi`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `rkab`
--
ALTER TABLE `rkab`
  ADD PRIMARY KEY (`id_rkab`);

--
-- Indexes for table `rkab_item`
--
ALTER TABLE `rkab_item`
  ADD PRIMARY KEY (`id_rkab_item`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `transaksi_admin`
--
ALTER TABLE `transaksi_admin`
  ADD PRIMARY KEY (`id_transaksi_admin`);

--
-- Indexes for table `transaksi_sales`
--
ALTER TABLE `transaksi_sales`
  ADD PRIMARY KEY (`id_transaksi_sales`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akses_toko`
--
ALTER TABLE `akses_toko`
  MODIFY `id_akses_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id_driver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  MODIFY `id_item_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rkab`
--
ALTER TABLE `rkab`
  MODIFY `id_rkab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rkab_item`
--
ALTER TABLE `rkab_item`
  MODIFY `id_rkab_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_admin`
--
ALTER TABLE `transaksi_admin`
  MODIFY `id_transaksi_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_sales`
--
ALTER TABLE `transaksi_sales`
  MODIFY `id_transaksi_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
