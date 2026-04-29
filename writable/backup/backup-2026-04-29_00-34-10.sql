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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alat`
--

LOCK TABLES `alat` WRITE;
/*!40000 ALTER TABLE `alat` DISABLE KEYS */;
INSERT INTO `alat` VALUES (33,'sapu lidi','y7i',0,'1776217295_4cfe9969799d23b0e957.jpg',1),(36,'sapu','rt',9,'1776654101_3d03f0539b392aa903c6.jpg',1),(38,'pengki','masih baru',900,'1776654087_dd4d5876ade0d62b3c24.jpg',1),(40,'Laptop','Masih mulus',15,'1776451570_58d36618a5810ef7c191.jpg',2),(41,'Monitor','merek hp',0,'1776790993_90f3e7e12192a970257b.png',13),(42,'Laptop','merk lenovo',0,'1776957669_ee69c65e8536a33ac01b.jpeg',2),(44,'Laptop','alus',0,'1777374312_b69b0d8feea38b5d85e4.png',2);
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
-- Table structure for table `detail_peminjaman`
--

DROP TABLE IF EXISTS `detail_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjam` int(11) DEFAULT NULL,
  `id_alat` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_peminjam` (`id_peminjam`),
  KEY `id_alat` (`id_alat`),
  CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `peminjaman` (`id_peminjam`),
  CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjaman`
--

LOCK TABLES `detail_peminjaman` WRITE;
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifikasi`
--

LOCK TABLES `notifikasi` WRITE;
/*!40000 ALTER TABLE `notifikasi` DISABLE KEYS */;
INSERT INTO `notifikasi` VALUES (1,NULL,'Permintaan peminjaman baru: pengki oleh user, jumlah: 10. Menunggu approval.','2026-04-28 09:13:12','dibaca'),(2,NULL,'Permintaan peminjaman baru: sapu oleh user, jumlah: 5. Menunggu approval.','2026-04-28 09:13:12','dibaca'),(3,2,'Peminjaman alat pengki telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-28 09:13:37','dibaca'),(4,2,'Peminjaman alat sapu telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-28 09:13:43','dibaca'),(5,NULL,'Alat dikembalikan: Laptop oleh user, jumlah: 10','2026-04-28 09:16:47','dibaca'),(6,NULL,'Alat dikembalikan: pengki oleh user, jumlah: 10','2026-04-28 09:27:43','dibaca'),(7,6,'Permintaan peminjaman: Laptop oleh user, jumlah: 10','2026-04-28 09:33:29','dibaca'),(8,NULL,'Alat dikembalikan: sapu oleh user, jumlah: 5','2026-04-28 09:33:46','dibaca'),(9,2,'Peminjaman alat Laptop telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-28 09:33:58','dibaca'),(10,NULL,'Alat dikembalikan: Laptop oleh user, jumlah: 10','2026-04-28 09:36:23','dibaca'),(11,6,'Permintaan peminjaman: pengki oleh user, jumlah: 1','2026-04-28 09:49:13','dibaca'),(12,2,'Peminjaman alat pengki telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-28 09:52:46','dibaca'),(13,NULL,'Alat dikembalikan: pengki oleh user, jumlah: 1','2026-04-28 10:05:09','dibaca'),(14,NULL,'Permintaan peminjaman baru: sapu oleh user, jumlah: 1. Menunggu approval.','2026-04-28 10:55:21','dibaca'),(15,2,'Peminjaman alat sapu telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-28 10:55:42','dibaca'),(16,NULL,'Permintaan peminjaman baru: Laptop oleh usro, jumlah: 1. Menunggu approval.','2026-04-28 11:17:31','belum_dibaca'),(17,2,'Peminjaman alat Laptop telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-28 11:17:51','belum_dibaca'),(18,NULL,'Permintaan peminjaman baru: Laptop oleh ujan, jumlah: 9. Menunggu approval.','2026-04-28 11:19:10','belum_dibaca'),(19,11,'Peminjaman alat Laptop telah disetujui. Silakan ambil alat di tempat yang ditentukan.','2026-04-28 11:19:57','belum_dibaca');
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
  `status` enum('ditunda','disetujui','ditolak','dipinjam','dikembalikan','menunggu_pengembalian') DEFAULT 'ditunda',
  `denda` int(11) DEFAULT 0,
  PRIMARY KEY (`id_peminjam`),
  KEY `peminjaman_ibfk_1` (`id_user`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (43,7,33,'fauzan',7,'2026-04-20','2026-04-23','',50000),(60,2,40,'user',10,'2026-04-28','2026-05-01','dikembalikan',0),(61,2,38,'user',10,'2026-04-28','2026-05-01','dikembalikan',0),(62,2,36,'user',5,'2026-04-28','2026-05-01','dikembalikan',0),(63,2,40,'user',10,'2026-04-28','2026-05-01','dikembalikan',0),(64,2,38,'user',1,'2026-04-28','2026-05-01','dikembalikan',0),(65,2,36,'user',1,'2026-04-28','2026-05-01','disetujui',0),(66,2,44,'usro',1,'2026-04-28','2026-05-01','disetujui',0),(67,11,44,'ujan',9,'2026-04-28','2026-05-01','disetujui',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','admin','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','1775093371_d8d64708445a90577d1e.jpg','admin@gmail.com','082155566645'),(2,'user','user','user','$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S','1775878386_a4b7c7efead014e5f375.png','user123@gmail.com','2147483647'),(3,'usro','usro','admin','$2y$10$IDSFvWRC7wLxyEivwRCLFeTg3IAcWOC5CB7FsOh5yU4eHAokvlDpG','1776314986_1776314986_37b11d0613c4fcc50c15.jpg','sundara@gmail.com','2147483647'),(6,'sundara','soendara','petugas','$2y$10$HGRxRjfevJjjvyZIPcxGpOOiIm4Oa99sY3uzBFefIuYTIGf85MvO2','1776309833_9c0bc57adc99781a1f00.png','sundara219@gmail.com','082185232587'),(7,'fauzan','hafidz_sundara','user','$2y$10$B/AhX5DR00jKneGlC3tQgeWsa80/ayDC7BOG5fmjVDobD8xrI1Qlm','1776446038_ea961da4db80e602aff4.png','lol@gmail.com','2147483647'),(9,'hafidz','hafidz','user','$2y$10$soQt7ZiceTqHeXb6hnR0OOQ1rv8N3Qe3gFjViFN/zZUtwBW9SZCv6','1776956329_4e2b189411c0dea539f7.png','hafidz19@gmail.com','08214589632'),(11,'ujan','ujan','user','$2y$10$byBcB9jVYHyaa8ZP4AySi.Ao//3v01IFAuIp5OFPfhIm6zQo4xNXS','1777277824_c940126b169869fca547.jpg','ujan@gmail.com','0821546598873221');
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

-- Dump completed on 2026-04-29  7:34:10
