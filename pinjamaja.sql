-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2026 pada 18.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `alat`
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
-- Dumping data untuk tabel `alat`
--

INSERT INTO `alat` (`id_alat`, `nama_alat`, `deskripsi`, `persediaan`, `foto`, `id_kategori`) VALUES
(33, 'sapu lidi', 'y7i', 14, '1776217295_4cfe9969799d23b0e957.jpg', 1),
(36, 'sapu', 'rt', 46, '1776654101_3d03f0539b392aa903c6.jpg', 1),
(38, 'pengki', 'e', 975, '1776654087_dd4d5876ade0d62b3c24.jpg', 1),
(40, 'Laptop', 'Masih mulus', 15, '1776451570_58d36618a5810ef7c191.jpg', 2),
(41, 'Monitor', 'merek hp', 5, '1776790993_90f3e7e12192a970257b.png', 13),
(42, 'Laptop', 'merk lenovo', 10, '1776957669_ee69c65e8536a33ac01b.jpeg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `denda` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Kebersihan'),
(2, 'Elektronik'),
(3, 'Alat Masak'),
(10, 'Olahraga'),
(11, 'Alat Sekolah'),
(12, 'Alat Labotorium'),
(13, 'Alat Lab Komputer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum_dibaca','dibaca') NOT NULL DEFAULT 'belum_dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `pesan`, `tanggal`, `status`) VALUES
(1, 2, 'Peminjaman alat Monitor telah disetujui. Silakan ambil alat di tempat yang ditentukan.', '2026-04-24 15:55:04', 'dibaca'),
(2, NULL, 'Permintaan peminjaman baru: pengki oleh user, jumlah: 75. Menunggu approval.', '2026-04-25 16:16:33', 'dibaca'),
(3, 2, 'Peminjaman alat pengki telah disetujui. Silakan ambil alat di tempat yang ditentukan.', '2026-04-25 16:18:04', 'dibaca'),
(4, NULL, 'Alat dikembalikan: pengki oleh user, jumlah: 75', '2026-04-25 16:18:23', 'dibaca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
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
  `denda` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjam`, `id_user`, `id_alat`, `nama_peminjam`, `jumlah`, `data_peminjam`, `data_dikembalikan`, `status`, `denda`) VALUES
(43, 7, 33, 'fauzan', 7, '2026-04-20', '2026-04-23', 'disetujui', 11),
(47, 2, 41, 'user', 5, '2026-04-23', '2026-04-26', 'disetujui', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` enum('admin','user','petugas') NOT NULL DEFAULT 'user',
  `password` varchar(100) NOT NULL,
  `foto` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(33) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `role`, `password`, `foto`, `email`, `no_hp`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', '1775093371_d8d64708445a90577d1e.jpg', 'admin@gmail.com', '082155566645'),
(2, 'user', 'user', 'user', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', '1775878386_a4b7c7efead014e5f375.png', 'user123@gmail.com', '2147483647'),
(3, 'usro', 'usro', 'admin', '$2y$10$IDSFvWRC7wLxyEivwRCLFeTg3IAcWOC5CB7FsOh5yU4eHAokvlDpG', '1776314986_1776314986_37b11d0613c4fcc50c15.jpg', 'sundara@gmail.com', '2147483647'),
(6, 'sundara', 'soendara', 'petugas', '$2y$10$HGRxRjfevJjjvyZIPcxGpOOiIm4Oa99sY3uzBFefIuYTIGf85MvO2', '1776309833_9c0bc57adc99781a1f00.png', 'sundara219@gmail.com', '082185232587'),
(7, 'fauzan', 'hafidz_sundara', 'user', '$2y$10$B/AhX5DR00jKneGlC3tQgeWsa80/ayDC7BOG5fmjVDobD8xrI1Qlm', '1776446038_ea961da4db80e602aff4.png', 'lol@gmail.com', '2147483647'),
(9, 'hafidz', 'hafidz', 'user', '$2y$10$soQt7ZiceTqHeXb6hnR0OOQ1rv8N3Qe3gFjViFN/zZUtwBW9SZCv6', '1776956329_4e2b189411c0dea539f7.png', 'hafidz19@gmail.com', '08214589632');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjam`),
  ADD KEY `peminjaman_ibfk_1` (`id_user`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
