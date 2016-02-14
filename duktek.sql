-- MySQL dump 10.13  Distrib 5.6.21, for Win32 (x86)
--
-- Host: localhost    Database: duktek
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alat`
--
CREATE DATABASE IF NOT EXISTS `AIPA`;

USE `AIPA`;

DROP TABLE IF EXISTS `alat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alat` (
  `id_alat` varchar(6) NOT NULL,
  `nama_alat` varchar(50) NOT NULL,
  `status` enum('normal','rusak') DEFAULT 'normal',
  `lokasi` varchar(20) NOT NULL,
  PRIMARY KEY (`id_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alat`
--

LOCK TABLES `alat` WRITE;
/*!40000 ALTER TABLE `alat` DISABLE KEYS */;
INSERT INTO `alat` (`id_alat`,`nama_alat`,`status`,`lokasi`) VALUES ('MIC001','Microphone','normal','Rak XXX');
/*!40000 ALTER TABLE `alat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id_user` int(11) NOT NULL,
  `id_alat` varchar(6) NOT NULL,
  `tanggal_rencana_peminjaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_rencana_pengembalian` datetime NOT NULL,
  PRIMARY KEY (`id_user`,`id_alat`,`tanggal_rencana_peminjaman`),
  KEY `id_alat` (`id_alat`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perbaikan`
--

DROP TABLE IF EXISTS `perbaikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perbaikan` (
  `nama_institusi` varchar(50) NOT NULL,
  `id_alat` varchar(6) NOT NULL,
  `tanggal_mulai_perbaikan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_selesai_perbaikan` datetime DEFAULT NULL,
  `estimasi_selesai_perbaikan` datetime NOT NULL,
  PRIMARY KEY (`nama_institusi`,`id_alat`,`tanggal_mulai_perbaikan`),
  KEY `id_alat` (`id_alat`),
  CONSTRAINT `perbaikan_ibfk_1` FOREIGN KEY (`nama_institusi`) REFERENCES `teknisi` (`nama_institusi`),
  CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perbaikan`
--

LOCK TABLES `perbaikan` WRITE;
/*!40000 ALTER TABLE `perbaikan` DISABLE KEYS */;
/*!40000 ALTER TABLE `perbaikan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_user` int(11) NOT NULL,
  `id_alat` varchar(6) NOT NULL,
  `tanggal_peminjaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `tanggal_rencana_pengembalian` datetime NOT NULL,
  PRIMARY KEY (`id_user`,`id_alat`,`tanggal_peminjaman`),
  KEY `id_alat` (`id_alat`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teknisi`
--

DROP TABLE IF EXISTS `teknisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teknisi` (
  `nama_institusi` varchar(50) NOT NULL,
  `nomor_telepon` int(15) NOT NULL,
  PRIMARY KEY (`nama_institusi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teknisi`
--

LOCK TABLES `teknisi` WRITE;
/*!40000 ALTER TABLE `teknisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `teknisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) NOT NULL,
  `kategori_civitas` enum('mahasiswa','dosen','institusi') DEFAULT 'institusi',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`,`nama_user`,`kategori_civitas`) VALUES (1,'Vanya Deasy Safrina','mahasiswa');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-01 14:52:38
