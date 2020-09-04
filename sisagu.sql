-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2020 pada 18.24
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `admin`
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
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `password`, `foto`, `nama_admin`, `created_at`) VALUES
(1, 'fauzi190198@gmail.com', '123456', 'f74b1f6b4c38c0784c22a244ae5211d8.jpg', 'Fauzi', '2020-06-15 02:59:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
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
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `merek`, `harga`, `harga_perbox`, `stok`, `stok_perbox`, `diskon`, `diskon_perbox`, `minimal_kuantitas_diskon`, `minimal_kuantitas_diskon_perbox`, `foto`, `created_at`) VALUES
(2, 'Tas', 'gucci', 300000, 600000, 180, 16, 10000, 5000, 5, 3, 'fe390655d9710d87ecf83207e4d3c924.jpg', '2020-09-03 13:12:21'),
(3, 'Bahan', 'LG', 40000, 150000, 200, 50, 20000, 10000, 50, 10, '2f5b1b913b2f3a286062c24d838717fa.jpg', '2020-09-03 10:54:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_transaksi`
--

CREATE TABLE `item_transaksi` (
  `id_item_transaksi` int(11) NOT NULL,
  `id_transaksi_sales` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `kuantitas_perbox` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `subdiskon` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `item_transaksi`
--

INSERT INTO `item_transaksi` (`id_item_transaksi`, `id_transaksi_sales`, `id_barang`, `kuantitas`, `kuantitas_perbox`, `subtotal`, `subdiskon`, `created_at`) VALUES
(8, 9, 2, 2, 0, 600000, 0, '2020-06-14 18:37:50'),
(9, 10, 2, 5, 0, 1500000, 10000, '2020-06-15 04:17:12'),
(10, 11, 2, 3, 0, 900000, 0, '2020-06-25 10:45:55'),
(11, 12, 2, 3, 0, 900000, 0, '2020-06-26 10:48:22'),
(12, 13, 3, 10, 0, 300000, 6000, '2020-07-04 09:02:37'),
(13, 14, 3, 2, 0, 60000, 0, '2020-07-04 09:05:05'),
(14, 15, 3, 5, 0, 150000, 0, '2020-07-10 16:31:42'),
(15, 16, 2, 1, 0, 300000, 0, '2020-07-22 11:06:18'),
(16, 17, 2, 1, 0, 300000, 0, '2020-07-22 11:13:19'),
(17, 18, 2, 20, 4, 21600000, 45000, '2020-09-03 13:12:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi_sales` int(11) NOT NULL,
  `jumlah_pembayaran` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
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
(15, 18, 18000000, '2020-09-03 13:12:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
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
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id_sales`, `nik`, `email`, `password`, `foto`, `nama_sales`, `created_at`) VALUES
(1, 3030, 'jovan@gmail.com', '123456', 'dbb111e624dfc0c066d5f43d3fc7d735.jpg', 'Jovan', '2020-06-15 02:52:32'),
(3, 200, 'eren@gmail.com', '123456', 'c02da80f039219c3f28db3f646b26d86.jpeg', 'eren', '2020-06-15 01:56:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `kode_toko` varchar(6) NOT NULL,
  `nama_toko` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `kode_toko`, `nama_toko`, `alamat`, `created_at`) VALUES
(1, '645333', 'Dadang', 'Subang', '2020-07-04 06:10:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_admin`
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
-- Struktur dari tabel `transaksi_sales`
--

CREATE TABLE `transaksi_sales` (
  `id_transaksi_sales` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `total` int(225) NOT NULL,
  `diskon` int(225) NOT NULL,
  `is_lunas` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_sales`
--

INSERT INTO `transaksi_sales` (`id_transaksi_sales`, `id_sales`, `id_toko`, `total`, `diskon`, `is_lunas`, `created_at`) VALUES
(10, 1, 1, 1500000, 10000, 0, '2020-07-04 07:02:58'),
(11, 1, 1, 900000, 0, 0, '2020-07-04 07:03:00'),
(12, 1, 1, 900000, 0, 0, '2020-07-04 07:03:03'),
(13, 1, 1, 300000, 6000, 0, '2020-07-04 09:02:37'),
(14, 1, 1, 60000, 0, 1, '2020-07-16 05:24:59'),
(15, 1, 1, 150000, 0, 0, '2020-07-10 16:31:42'),
(16, 1, 1, 300000, 0, 0, '2020-07-22 11:06:18'),
(17, 1, 1, 300000, 0, 0, '2020-07-22 11:13:19'),
(18, 1, 1, 21600000, 45000, 0, '2020-09-03 13:12:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD PRIMARY KEY (`id_item_transaksi`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `transaksi_admin`
--
ALTER TABLE `transaksi_admin`
  ADD PRIMARY KEY (`id_transaksi_admin`);

--
-- Indeks untuk tabel `transaksi_sales`
--
ALTER TABLE `transaksi_sales`
  ADD PRIMARY KEY (`id_transaksi_sales`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `item_transaksi`
--
ALTER TABLE `item_transaksi`
  MODIFY `id_item_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_admin`
--
ALTER TABLE `transaksi_admin`
  MODIFY `id_transaksi_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_sales`
--
ALTER TABLE `transaksi_sales`
  MODIFY `id_transaksi_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
