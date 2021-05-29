-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table walkwalk.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table walkwalk.bookhotel
CREATE TABLE IF NOT EXISTS `bookhotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PenginapanID` int(11) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `TotalHarga` int(11) NOT NULL DEFAULT '0',
  `Durasi` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.bookhotel: ~0 rows (approximately)
/*!40000 ALTER TABLE `bookhotel` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookhotel` ENABLE KEYS */;

-- Dumping structure for table walkwalk.kamar
CREATE TABLE IF NOT EXISTS `kamar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penginapan_id` int(11) NOT NULL,
  `no_kamar` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.kamar: ~0 rows (approximately)
/*!40000 ALTER TABLE `kamar` DISABLE KEYS */;
/*!40000 ALTER TABLE `kamar` ENABLE KEYS */;

-- Dumping structure for table walkwalk.membayar
CREATE TABLE IF NOT EXISTS `membayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.membayar: ~0 rows (approximately)
/*!40000 ALTER TABLE `membayar` DISABLE KEYS */;
/*!40000 ALTER TABLE `membayar` ENABLE KEYS */;

-- Dumping structure for table walkwalk.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `TiketID` int(11) NOT NULL DEFAULT '0',
  `TotalHarga` int(11) NOT NULL DEFAULT '0',
  `MetodePembayaran` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.pembayaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

-- Dumping structure for table walkwalk.penginapan
CREATE TABLE IF NOT EXISTS `penginapan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tempat` varchar(255) NOT NULL DEFAULT '0',
  `alamat` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.penginapan: ~0 rows (approximately)
/*!40000 ALTER TABLE `penginapan` DISABLE KEYS */;
/*!40000 ALTER TABLE `penginapan` ENABLE KEYS */;

-- Dumping structure for table walkwalk.tempat_wisata
CREATE TABLE IF NOT EXISTS `tempat_wisata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tempat` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.tempat_wisata: ~0 rows (approximately)
/*!40000 ALTER TABLE `tempat_wisata` DISABLE KEYS */;
/*!40000 ALTER TABLE `tempat_wisata` ENABLE KEYS */;

-- Dumping structure for table walkwalk.tiketwisata
CREATE TABLE IF NOT EXISTS `tiketwisata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL DEFAULT '0',
  `WisataID` int(11) NOT NULL DEFAULT '0',
  `TotalTiket` int(11) NOT NULL DEFAULT '0',
  `TotalHarga` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.tiketwisata: ~0 rows (approximately)
/*!40000 ALTER TABLE `tiketwisata` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiketwisata` ENABLE KEYS */;

-- Dumping structure for table walkwalk.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '0',
  `phone` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table walkwalk.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
