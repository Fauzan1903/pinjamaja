-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2026 at 06:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjamaja`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `persediaan` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `deskripsi`, `persediaan`, `foto`, `id_kategori`) VALUES
(33, 'sapu lidi', 'y7i', 21, '1776217295_4cfe9969799d23b0e957.jpg', 1),
(34, 'pistol', 'tyiygi', 8, '1776446742_27749f73f9e38fb9c50b.jpg', NULL),
(35, 'pistol', 'rrr', 4, '1776446801_a9b68b64f7631c8ef5d1.jpg', NULL),
(36, 'sapu', 'rt', 46, NULL, NULL),
(38, 'pengki', 'e', 975, NULL, NULL),
(39, 'ak-47', 'baik', 0, '1776217280_67205a36295a3513ae72.jpg', NULL),
(40, 'Laptop', 'Masih mulus', 15, '1776451570_58d36618a5810ef7c191.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `denda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Kebersihan'),
(2, 'Elektronik'),
(3, 'Alat Masak'),
(10, 'Olahraga'),
(11, 'Alat Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-04-16-031522', 'App\\Database\\Migrations\\CreateNotifikasiTable', 'default', 'App', 1776309376, 1),
(2, '2026-04-16-041639', 'App\\Database\\Migrations\\AddIdUserToNotifikasiTable', 'default', 'App', 1776313035, 2),
(3, '2026-04-16-042508', 'App\\Database\\Migrations\\AddNoHpToUsersTable', 'default', 'App', 1776313539, 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum_dibaca','dibaca') NOT NULL DEFAULT 'belum_dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `pesan`, `tanggal`, `status`) VALUES
(9, NULL, 'Alat dikembalikan: sapu oleh user, jumlah: 45', '2026-04-16 04:12:44', 'dibaca'),
(10, NULL, 'Permintaan peminjaman baru: pistol oleh user, jumlah: 4. Menunggu approval.', '2026-04-17 16:24:51', 'dibaca'),
(11, 2, 'Maaf, peminjaman alat pistol ditolak.', '2026-04-17 16:25:29', 'dibaca'),
(12, NULL, 'User baru mendaftar: fauzan (hafidz_sundara) dengan role user', '2026-04-17 17:13:58', 'dibaca'),
(13, NULL, 'Permintaan peminjaman baru: pistol oleh fauzan, jumlah: 4. Menunggu approval.', '2026-04-17 17:14:34', 'dibaca'),
(14, 7, 'Peminjaman alat pistol telah disetujui. Silakan ambil alat di tempat yang ditentukan.', '2026-04-17 17:15:07', 'dibaca'),
(15, NULL, 'Alat dikembalikan: pistol oleh fauzan, jumlah: 4', '2026-04-17 17:32:49', 'dibaca'),
(16, NULL, 'Permintaan peminjaman baru: pistol oleh fauzan, jumlah: 8. Menunggu approval.', '2026-04-18 02:05:22', 'dibaca'),
(17, 7, 'Peminjaman alat pistol telah disetujui. Silakan ambil alat di tempat yang ditentukan.', '2026-04-18 02:05:41', 'dibaca'),
(18, NULL, 'Alat dikembalikan: pistol oleh fauzan, jumlah: 8 (Denda: Rp 25.000)', '2026-04-18 02:07:04', 'belum_dibaca'),
(19, 7, '⚠️ Pemberitahuan Denda: Anda terkena denda sebesar Rp 25.000 karena terlambat mengembalikan alat \'pistol\'. Silakan hubungi admin untuk pembayaran.', '2026-04-18 02:07:04', 'belum_dibaca'),
(20, NULL, 'Permintaan peminjaman baru: ak-47 oleh user, jumlah: 15. Menunggu approval.', '2026-04-18 15:16:36', 'dibaca'),
(21, 2, 'Peminjaman alat ak-47 telah disetujui. Silakan ambil alat di tempat yang ditentukan.', '2026-04-18 15:17:05', 'dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjam` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_alat` int(11) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `data_peminjam` date NOT NULL,
  `data_dikembalikan` date NOT NULL,
  `status` enum('ditunda','disetujui','ditolak','dipinjam','dikembalikan') DEFAULT 'ditunda',
  `denda` int(11) DEFAULT 11
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjam`, `id_user`, `id_alat`, `nama_peminjam`, `jumlah`, `data_peminjam`, `data_dikembalikan`, `status`, `denda`) VALUES
(30, 2, 36, 'user', 45, '2026-04-11', '2026-04-18', 'dikembalikan', 11),
(31, 2, 35, 'user', 11, '2026-04-16', '2026-04-23', 'dipinjam', 11),
(34, 2, 34, 'user', 6, '2026-04-10', '2026-04-13', 'dipinjam', 11),
(35, 6, 38, 'sundara', 35, '2026-04-16', '2026-04-23', 'dipinjam', 11),
(36, 2, 34, 'user', 4, '2026-04-17', '2026-04-20', 'ditolak', 11),
(37, 7, 35, 'fauzan', 4, '2026-04-17', '2026-04-20', 'dikembalikan', 0),
(38, NULL, 0, 'user', 6, '2026-04-10', '2026-04-13', 'disetujui', 11),
(39, 7, 34, 'fauzan', 8, '2026-04-10', '2026-04-13', 'dikembalikan', 25000),
(40, 2, 39, 'user', 15, '2026-04-18', '2026-04-21', 'disetujui', 11);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` enum('admin','user','petugas') NOT NULL DEFAULT 'user',
  `password` varchar(100) NOT NULL,
  `foto` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` int(33) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `role`, `password`, `foto`, `email`, `no_hp`) VALUES
(1, 'admin', 'admin', 'petugas', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', '1775093371_d8d64708445a90577d1e.jpg', '', 0),
(2, 'user1', 'user1', 'user', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', '1775878386_a4b7c7efead014e5f375.png', 'mahadalmamun33@gmail.com', 2147483647),
(3, 'usro', 'usro', 'admin', '$2y$10$IDSFvWRC7wLxyEivwRCLFeTg3IAcWOC5CB7FsOh5yU4eHAokvlDpG', '1776314986_1776314986_37b11d0613c4fcc50c15.jpg', 'sundara1903@gmail.com', 2147483647),
(6, 'sundara', 'soendara', 'petugas', '$2y$10$HGRxRjfevJjjvyZIPcxGpOOiIm4Oa99sY3uzBFefIuYTIGf85MvO2', '1776309833_9c0bc57adc99781a1f00.png', '', 0),
(7, 'fauzan', 'hafidz_sundara', 'user', '$2y$10$B/AhX5DR00jKneGlC3tQgeWsa80/ayDC7BOG5fmjVDobD8xrI1Qlm', '1776446038_ea961da4db80e602aff4.png', '', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjam`),
  ADD KEY `peminjaman_ibfk_1` (`id_user`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
