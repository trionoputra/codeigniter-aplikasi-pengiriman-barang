-- MySQL dump 10.13  Distrib 5.5.50, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pengiriman
-- ------------------------------------------------------
-- Server version	5.5.50-0ubuntu0.14.04.1

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
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang` (
  `id_barang` varchar(7) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `del_no` varchar(15) NOT NULL,
  `id_kategori` varchar(5) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES ('BRG0001','BRAKE SHOE HONDA ASP','SATUAN 1','Box','KTG01'),('BRG0002','BRAKE SHOE KHARISMA','SATUAN 1','Box','KTG02'),('BRG0003','BRAKE SHOE SUPRA FED','SATUAN 1','Box','KTG01'),('BRG0004','BRAKE SHOE YAMAHA ASP','SATUAN 1','Box','KTG01'),('BRG0005','PAD SET HONDA BLADE - ASP','SATUAN 1','Box','KTG01'),('BRG0006','PAD SET HONDA SUPRA X 125 - AS','SATUAN 1','BOX','KTG01'),('BRG0007','PAD SET SUPRA FED','SATUAN 1','Box','KTG01'),('BRG0008','PAD SET SUPRA X 125 - ASP','SATUAN 1','Box','KTG01'),('BRG0009','PAD SET VIXION ASP','SATUAN 1','Box','KTG01'),('BRG0010','PAD SET JUPITER-MX ASP','SATUAN 1','Box','KTG01'),('BRG0011','PAD SET VEGA-ZR ASP','SATUAN 1','Box','KTG01'),('BRG0012','PAD SET MIO FED','SATUAN 1','Box','KTG01'),('BRG0013','PAD SET FZR FED','SATUAN 1','Box','KTG01'),('BRG0014','PAD SET JUPITER-MX FED','SATUAN 1','Box','KTG01'),('BRG0015','PAD SET VEGA-ZR FED','SATUAN 1','Box','KTG01'),('BRG0016','PAD SET TORNADO ASP','SATUAN 1','Box','KTG01'),('BRG0017','PAD SET TIGER F ASP','SATUAN 1','Box','KTG01'),('BRG0018','PAD SET THUNDER 125 ASP','SATUAN 1','Box','KTG01'),('BRG0019','PAD SET THUNDER 125 FED','SATUAN 1','Box','KTG01'),('BRG0020','PAD SET VARIO - ASP','SATUAN 1','Box','KTG01'),('BRG0021','PAD SET SPIN - ASP','SATUAN 1','Box','KTG01'),('BRG0022','PAD SET SPIN - FED','SATUAN 1','Box','KTG01'),('BRG0023','SPRING FRONT FORK KHARISMA ASP','SATUAN 2','Box','KTG02'),('BRG0024','SPRING FRONT FORK SUPRA ASP','SATUAN 2','Box','KTG02'),('BRG0025','BOTOL ULTRATEC 0.8L 2016 - RED','SATUAN 3','PALLET','KTG03'),('BRG0026','BOTOL SUPREME XX 50 0.8L 2016 ','SATUAN 3','PALLET','KTG03'),('BRG0027','BOTOL AHM OIL 0.8L MPX-1 10W-3','SATUAN 3','PALLET','KTG03'),('BRG0028','BOTOL MPX-1 0.8L','SATUAN 3','PALLET','KTG03'),('BRG0029','BOTOL SPX1 FEDERAL 0.8L','SATUAN 3','PALLET','KTG03'),('BRG0030','BOTOL SPX1 2014 REPSOL 1.0L','SATUAN 3','PALLET','KTG03'),('BRG0031','BOTOL SPX-1 1.2L 2016','SATUAN 3','PALLET','KTG03'),('BRG0032','BOTOL SUPREME XX 30 0.8L 2016-','SATUAN 3','PALLET','KTG03'),('BRG0033','BOTOL FEDERAL YMATIC 0.8L 2016','SATUAN 3','PALLET','KTG03'),('BRG0034','BOTOL AHM OIL 1.0L MPX-1 10W-3','SATUAN 3','PALLET','KTG03'),('BRG0035','BOTOL MPX1 AHM 2014 1.0L','SATUAN 3','PALLET','KTG03');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_pengiriman`
--

DROP TABLE IF EXISTS `detail_pengiriman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_pengiriman` (
  `id_detail` int(4) NOT NULL AUTO_INCREMENT,
  `id_pengiriman` varchar(14) NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `qty` int(4) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_pengiriman`
--

LOCK TABLES `detail_pengiriman` WRITE;
/*!40000 ALTER TABLE `detail_pengiriman` DISABLE KEYS */;
INSERT INTO `detail_pengiriman` VALUES (1,'KRM20160820001','BRG0001',1),(2,'KRM20160820001','BRG0002',3),(3,'KRM20161015001','BRG0006',1),(4,'KRM20161015001','BRG0035',1);
/*!40000 ALTER TABLE `detail_pengiriman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `keterangan` varchar(150) NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES ('KTG01','KATEGORI 1','KATEGORI 1'),('KTG02','KATEGORI 2','KATEGORI 2'),('KTG03','KATEGORI 3','KATEGORI 3');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kurir`
--

DROP TABLE IF EXISTS `kurir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kurir` (
  `id_kurir` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(150) NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id_kurir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kurir`
--

LOCK TABLES `kurir` WRITE;
/*!40000 ALTER TABLE `kurir` DISABLE KEYS */;
INSERT INTO `kurir` VALUES ('KRR01','EKO ','Laki-Laki','081385195955','TANGERANG','ee9cc68e583241dcb548e4217d8c8eb9'),('KRR02','ERIK','Laki-Laki','081284959589','TANGERANG','6faae43d506a230beedcdbff231b478e'),('KRR03','TRIBUDI','Laki-Laki','081219900381','TANGERANG','b4ae1f68447e3df8a1ce6c4dc3660c5b'),('KRR04','SUMANTA','Laki-Laki','081382630321','TANGERANG','af7ece06ca8c285657e6a8860e58c44f'),('KRR05','UDRI','Laki-Laki','081210426881','TANGERANG','a82ae164e11127090055c6c7fbb6a888'),('KRR06','SAEPUL','Laki-Laki','081314485383','TANGERANG','1cdb001697052dcdf055da6b82124bc3'),('KRR07','yanto','Laki-Laki','081284213311','Gandul, 16512','81dc9bdb52d04dc20036dbd8313ed055'),('KRR08','SUJONO','Laki-Laki','0812345678','Jonggol, West Java','81dc9bdb52d04dc20036dbd8313ed055');
/*!40000 ALTER TABLE `kurir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(7) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` VALUES ('CST0001','ASTRA OTOPART','021-4603550','jakarta'),('CST0002','Idemitsu Lube Indonesia','021-8911 4611','JL Permata Raya, Kawasan Industri KIIC, Lot BB/4A, Karawang, Jawa Barat,'),('CST0003','Federal Karyatama','021-4613583','Jl. Pulobuaran Raya, RW.9, Jatinegara, Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13910');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengiriman`
--

DROP TABLE IF EXISTS `pengiriman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengiriman` (
  `id_pengiriman` varchar(14) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pelanggan` varchar(7) NOT NULL,
  `id_kurir` varchar(5) NOT NULL,
  `no_kendaraan` varchar(8) NOT NULL,
  `no_po` varchar(15) NOT NULL,
  `keterangan` varchar(150)  NULL,
  `penerima` varchar(50)  NULL,
  `photo` varchar(200)  NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_pengiriman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengiriman`
--

LOCK TABLES `pengiriman` WRITE;
/*!40000 ALTER TABLE `pengiriman` DISABLE KEYS */;
INSERT INTO `pengiriman` VALUES ('KRM20160820001','2016-08-20','CST0001','KRR01','B021ZIG','8732984732984','','','',1),('KRM20161015001','2016-10-15','CST0003','KRR08','B03L','km1230jg','','','',1);
/*!40000 ALTER TABLE `pengiriman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` varchar(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('USR01','admin','1a1dc91c907325c69271ddf0c944bc72',1),('USR02','finance','1a1dc91c907325c69271ddf0c944bc72',2),('USR03','gudang','1a1dc91c907325c69271ddf0c944bc72',3);
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

-- Dump completed on 2016-11-30  9:31:17
