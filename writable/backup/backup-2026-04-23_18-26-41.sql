-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pinjamaja
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alat`
--

DROP TABLE IF EXISTS `alat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `persediaan` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_alat`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alat`
--

LOCK TABLES `alat` WRITE;
/*!40000 ALTER TABLE `alat` DISABLE KEYS */;
INSERT INTO `alat` VALUES (33,'sapu lidi','y7i',14,'1776217295_4cfe9969799d23b0e957.jpg',1),(34,'pistol','tyiygi',14,'1776446742_27749f73f9e38fb9c50b.jpg',10),(35,'pistol','rrr',15,'1776446801_a9b68b64f7631c8ef5d1.jpg',10),(36,'sapu','rt',46,'1776654101_3d03f0539b392aa903c6.jpg',1),(38,'pengki','e',975,'1776654087_dd4d5876ade0d62b3c24.jpg',1),(39,'ak-47','baik',4,'1776217280_67205a36295a3513ae72.jpg',10),(40,'Laptop','Masih mulus',15,'1776451570_58d36618a5810ef7c191.jpg',2),(41,'Monitor','merek hp',10,'1776790993_90f3e7e12192a970257b.png',13),(42,'Laptop','merk lenovo',10,'1776957669_ee69c65e8536a33ac01b.jpeg',2);
/*!40000 ALTER TABLE `alat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `denda`
--

DROP TABLE IF EXISTS `denda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL AUTO_INCREMENT,
  `id_alat` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `denda` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_denda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `denda`
--

LOCK TABLES `denda` WRITE;
/*!40000 ALTER TABLE `denda` DISABLE KEYS */;
/*!40000 ALTER TABLE `denda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'Kebersihan'),(2,'Elektronik'),(3,'Alat Masak'),(10,'Olahraga'),(11,'Alat Sekolah'),(12,'Alat Labotorium'),(13,'Alat Lab Komputer');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026-04-16-031522','App\\Database\\Migrations\\CreateNotifikasiTable','default','App',1776309376,1),(2,'2026-04-16-041639','App\\Database\\Migrations\\AddIdUserToNotifikasiTable','default','App',1776313035,2),(3,'2026-04-16-042508','App\\Database\\Migrations\\AddNoHpToUsersTable','default','App',1776313539,3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifikasi`
--

DROP TABLE IF EXISTS `notifikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('belum_dibaca','dibaca') NOT NULL DEFAULT 'belum_dibaca',
  PRIMARY KEY (`id_notifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (11,2,'Maaf, peminjaman alat pistol ditolak.','2026-04-17 16:25:29','dibaca'),(12,NULL,'User baru mendaftar: fauzan (hafidz_sundara) dengan role user','2026-04-17 17:13:58','dibaca'),(13,NULL,'Permintaan peminjaman baru: pistol oleh fauzan, jumlah: 4. Menunggu approval.','2026-04-17 17:14:34','dibaca'),(14,7,'Peminjaman alat pistol telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-17 17:15:07','dibaca'),(19,7,'⚠️ Pemberitahuan Denda: Anda terkena denda sebesar Rp 25.000 karena terlambat mengembalikan alat \'pistol\'. Silakan hubungi admin untuk pembayaran.','2026-04-18 02:07:04','dibaca'),(24,2,' Pemberitahuan Denda: Anda terkena denda sebesar Rp 35.000 karena terlambat mengembalikan alat \'pistol\'. Silakan hubungi admin untuk pembayaran.','2026-04-20 06:58:08','dibaca'),(25,NULL,'Permintaan peminjaman baru: pistol oleh fauzan, jumlah: 4. Menunggu approval.','2026-04-20 15:23:50','dibaca'),(26,NULL,'Permintaan peminjaman baru: sapu lidi oleh fauzan, jumlah: 7. Menunggu approval.','2026-04-20 15:23:59','dibaca'),(27,NULL,'Permintaan peminjaman baru: Laptop oleh user1, jumlah: 12. Menunggu approval.','2026-04-20 15:24:25','dibaca'),(28,2,'Peminjaman alat Laptop telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-20 15:24:43','dibaca'),(29,7,'Peminjaman alat pistol telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-20 15:24:46','dibaca'),(30,7,'Peminjaman alat sapu lidi telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-20 15:24:49','dibaca'),(31,NULL,'Permintaan peminjaman baru: pengki oleh user, jumlah: 10. Menunggu approval.','2026-04-21 15:14:29','dibaca'),(32,2,'Peminjaman alat pengki telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-21 15:14:45','dibaca'),(33,NULL,'Permintaan peminjaman baru: sapu oleh user, jumlah: 11. Menunggu approval.','2026-04-21 15:45:37','dibaca'),(34,2,'Peminjaman alat sapu telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-21 15:45:53','dibaca'),(36,NULL,'User baru mendaftar: hafidz (hafidz) dengan role user','2026-04-23 14:58:49','dibaca'),(37,NULL,'Alat dikembalikan: Laptop oleh user1, jumlah: 12','2026-04-23 14:59:45','dibaca'),(38,NULL,'Alat dikembalikan: pistol oleh user, jumlah: 11','2026-04-23 15:00:02','dibaca'),(39,NULL,'Alat dikembalikan: pistol oleh fauzan, jumlah: 4','2026-04-23 15:02:11','dibaca'),(40,NULL,'User baru mendaftar: lol (lol) dengan role user','2026-04-23 15:04:10','dibaca'),(41,NULL,'Alat dikembalikan: pengki oleh user, jumlah: 10','2026-04-23 15:19:58','dibaca'),(42,NULL,'Alat dikembalikan: sapu oleh user, jumlah: 11','2026-04-23 16:58:29','belum_dibaca');
/*!40000 ALTER TABLE `notifikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_peminjam` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_alat` int(11) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `data_peminjam` date NOT NULL,
  `data_dikembalikan` date NOT NULL,
  `status` enum('ditunda','disetujui','ditolak','dipinjam','dikembalikan') DEFAULT 'ditunda',
  `denda` int(11) DEFAULT 0,
  PRIMARY KEY (`id_peminjam`),
  KEY `peminjaman_ibfk_1` (`id_user`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (35,6,38,'sundara',35,'2026-04-16','2026-04-23','dipinjam',11),(43,7,33,'fauzan',7,'2026-04-20','2026-04-23','disetujui',11);
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjam` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `id_denda` int(11) NOT NULL,
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` enum('admin','user','petugas') NOT NULL DEFAULT 'user',
  `password` varchar(100) NOT NULL,
  `foto` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(33) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','petugas','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','1775093371_d8d64708445a90577d1e.jpg','admin@gmail.com','082155566645'),(2,'user','user','user','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','1775878386_a4b7c7efead014e5f375.png','mahadalmamun33@gmail.com','2147483647'),(3,'usro','usro','admin','$2y$10$IDSFvWRC7wLxyEivwRCLFeTg3IAcWOC5CB7FsOh5yU4eHAokvlDpG','1776314986_1776314986_37b11d0613c4fcc50c15.jpg','sundara1903@gmail.com','2147483647'),(6,'sundara','soendara','petugas','$2y$10$HGRxRjfevJjjvyZIPcxGpOOiIm4Oa99sY3uzBFefIuYTIGf85MvO2','1776309833_9c0bc57adc99781a1f00.png','sundara219@gmail.com','082185232587'),(7,'fauzan','hafidz_sundara','user','$2y$10$B/AhX5DR00jKneGlC3tQgeWsa80/ayDC7BOG5fmjVDobD8xrI1Qlm','1776446038_ea961da4db80e602aff4.png','lol@gmail.com','2147483647'),(8,'budi','bud1','petugas','$2y$10$crr18bF2QjAdLXQOOxqzHeMkq8kKuEEe2ru4No0yOhPnQX2eJIAs6','1776795508_9cec3d29ef4f08c78172.jpg','bud1@gmail.com','082147856985'),(9,'hafidz','hafidz','user','$2y$10$soQt7ZiceTqHeXb6hnR0OOQ1rv8N3Qe3gFjViFN/zZUtwBW9SZCv6','1776956329_4e2b189411c0dea539f7.png','hafidz19@gmail.com','08214589632');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-24  1:26:42
