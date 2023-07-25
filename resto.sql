-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 09:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_stok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_menu`
--

CREATE TABLE `kategori_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Non-Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_menu`
--

INSERT INTO `kategori_menu` (`id`, `kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'Aktif', '2023-02-21 23:13:10', '2023-02-21 23:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `id_kategori` bigint(20) NOT NULL,
  `status` enum('Tersedia','Habis') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `kategori_halal` enum('Halal','Non-Halal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Halal',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `harga`, `id_kategori`, `status`, `kategori_halal`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Ayam', 10000, 1, 'Tersedia', 'Halal', '1677046419_ayam.jfif', '2023-02-21 23:13:39', '2023-02-21 23:13:39'),
(2, 'baso', 10000, 1, 'Tersedia', 'Halal', '1677486721_006-kamboja_jepang (1).jpg', '2023-02-27 01:32:01', '2023-02-27 01:32:01'),
(3, 'pasta', 10000, 1, 'Tersedia', 'Halal', '1677486764_graphic-design2.png', '2023-02-27 01:32:44', '2023-02-27 01:32:44'),
(4, 'seblak', 5000, 1, 'Tersedia', 'Halal', '1677486806_Contoh-Teks-Laporan-Hasil-Observasi-tentang-Alam.jpeg', '2023-02-27 01:33:26', '2023-02-27 01:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2023_01_29_065701_create_role_table', 1),
(3, '2023_01_29_070008_create_kategori_menu_table', 1),
(4, '2023_01_29_070327_create_menu_table', 1),
(5, '2023_01_29_070542_create_reservasi_table', 1),
(6, '2023_02_02_034030_create_resep_table', 1),
(7, '2023_02_02_034107_create_bahan_baku_table', 1),
(8, '2023_02_08_031101_create_nomor_meja_table', 1),
(9, '2023_02_17_031406_create_rekening_table', 1),
(10, '2023_02_20_003610_create_pemesanan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nomor_meja`
--

CREATE TABLE `nomor_meja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_meja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Kosong','Di-Booking','Di-Isi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Kosong',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nomor_meja`
--

INSERT INTO `nomor_meja` (`id`, `nomor_meja`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Di-Booking', '2023-02-21 23:13:02', '2023-02-21 23:13:02'),
(2, '2', 'Kosong', '2023-02-21 23:14:29', '2023-02-21 23:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `id_menu` bigint(20) NOT NULL,
  `id_reservasi` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `jumlah`, `subtotal`, `id_menu`, `id_reservasi`, `created_at`, `updated_at`) VALUES
(1, 50, 500000, 1, 1, '2023-02-21 23:18:56', '2023-02-21 23:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Non-Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id`, `bank`, `nama`, `no_rekening`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gopay', 'asep nugraha stiawan', '10293012301203', 'Aktif', '2023-02-21 23:14:03', '2023-02-21 23:14:03'),
(2, 'bjb', 'asep nugraha', '0234832084234023', 'Aktif', '2023-02-21 23:14:15', '2023-02-21 23:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_menu` bigint(20) NOT NULL,
  `id_bahan` bigint(20) NOT NULL,
  `takaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT concat(substr('ABCDEFGHIJKLMNOPQRSTUVWXYZ',floor(rand() * 26) + 1,1),lpad(floor(rand() * 1000) + 1,4,0)),
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_meja` int(11) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `jam_booking` time NOT NULL,
  `tanggal` date NOT NULL,
  `id_rekening` bigint(20) NOT NULL,
  `status` enum('Aktif','Non-Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`code`, `id`, `nomor_meja`, `id_customer`, `jam_booking`, `tanggal`, `id_rekening`, `status`, `created_at`, `updated_at`) VALUES
('T0223', 1, 1, 2, '13:15:00', '2023-02-22', 1, 'Aktif', '2023-02-21 23:18:56', '2023-02-21 23:18:56');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Non-Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Aktif', '2023-02-21 23:12:33', '2023-02-21 23:12:33'),
(2, 'pegawai', 'Aktif', '2023-02-21 23:12:33', '2023-02-21 23:12:33'),
(3, 'customer', 'Aktif', '2023-02-21 23:12:33', '2023-02-21 23:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jeniskelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` bigint(20) NOT NULL DEFAULT 3,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `tanggal_lahir`, `tempat_lahir`, `agama`, `telepon`, `alamat`, `jeniskelamin`, `password`, `id_role`, `created_at`, `updated_at`) VALUES
(1, 'admin123', 'Ujang', 'admin@gmail.com', '2000-09-18', 'Bandung', 'Islam', '08123456789', 'Jl. Coba-coba', 'Laki-laki', '$2y$10$sag3jTS6W4FvHVbgituvAOo01xryWeYZs9wtI7q.kFr2yPBOZIVCq', 1, '2023-02-21 23:12:34', '2023-02-21 23:12:34'),
(2, 'a', 'hanif', 'a@mail.com', '2023-02-22', 'Bandung', 'Islam', '089887886877', 'Jln.COba', 'Laki-laki', '$2y$10$F4FhZcfkt2n2CcaKHeHlduAZIC7/E8RqmCZHgM4k1O2QZyNphRDaG', 3, '2023-02-21 23:15:04', '2023-02-21 23:15:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_meja`
--
ALTER TABLE `nomor_meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_role_unique` (`role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nomor_meja`
--
ALTER TABLE `nomor_meja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
