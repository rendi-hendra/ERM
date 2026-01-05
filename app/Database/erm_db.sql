-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for erm_new
CREATE DATABASE IF NOT EXISTS `erm_new` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `erm_new`;

-- Dumping structure for table erm_new.asuransi
CREATE TABLE IF NOT EXISTS `asuransi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_asuransi` varchar(255) NOT NULL,
  `no_kontak` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime DEFAULT (now()),
  `updated_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.asuransi: ~3 rows (approximately)
INSERT INTO `asuransi` (`id`, `nama_asuransi`, `no_kontak`, `alamat`, `created_at`, `updated_at`) VALUES
	(1, 'BPJS Kesehatan', 'BPJS01', 'Jl. Jend. Gatot Subroto Kav. 38, Jakarta', '2025-11-05 15:44:28', '2025-11-05 15:44:28'),
	(2, 'Prudential Life Assurance', 'PRU02', 'Jl. Jend. Sudirman No.25, Jakarta Selatan', '2025-11-05 23:16:30', '2025-11-05 23:16:30'),
	(3, 'Allianz Indonesia', 'ALZ03', 'Jl. HR Rasuna Said Blok X2 No.5, Kuningan, Jakarta Selatan', '2025-11-05 23:16:30', '2025-11-05 17:38:25');

-- Dumping structure for table erm_new.asuransi_pasien
CREATE TABLE IF NOT EXISTS `asuransi_pasien` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pasien_id` int unsigned NOT NULL,
  `asuransi_id` int unsigned NOT NULL,
  `hak_kelas` int NOT NULL DEFAULT '0',
  `no_kartu` varchar(255) NOT NULL,
  `aktif` tinyint NOT NULL,
  `created_at` datetime DEFAULT (now()),
  `updated_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `asuransi_id` (`asuransi_id`),
  CONSTRAINT `asuransi_pasien_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`),
  CONSTRAINT `asuransi_pasien_ibfk_2` FOREIGN KEY (`asuransi_id`) REFERENCES `asuransi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.asuransi_pasien: ~4 rows (approximately)
INSERT INTO `asuransi_pasien` (`id`, `pasien_id`, `asuransi_id`, `hak_kelas`, `no_kartu`, `aktif`, `created_at`, `updated_at`) VALUES
	(13, 5, 1, 3, '000000000001', 1, '2025-11-06 18:36:27', '2025-11-06 18:36:27'),
	(14, 8, 3, 1, '11111111', 1, '2025-11-06 18:37:32', '2025-11-06 18:37:32'),
	(15, 2, 1, 2, 'BPJS-0001', 1, '2025-12-24 03:36:00', '2025-12-24 03:36:00'),
	(16, 3, 2, 1, 'ASR-0002', 1, '2025-12-24 03:36:00', '2025-12-24 03:36:00');

-- Dumping structure for table erm_new.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `sip` varchar(255) DEFAULT NULL,
  `jenis` enum('dokter','perawat','admin') NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT (now()),
  `updated_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.employee: ~5 rows (approximately)
INSERT INTO `employee` (`id`, `nama`, `sip`, `jenis`, `no_hp`, `created_at`, `updated_at`) VALUES
	(1, 'dr. Andi Pratama', 'SIP-001-2024', 'dokter', '081234567890', '2025-12-24 01:55:51', '2025-12-24 01:55:51'),
	(2, 'dr. Siti Aminah', 'SIP-002-2024', 'dokter', '081234567891', '2025-12-24 01:55:51', '2025-12-24 01:55:51'),
	(3, 'Budi Santoso', 'SIP-003-2024', 'perawat', '081234567892', '2025-12-24 01:55:51', '2025-12-24 01:55:51'),
	(4, 'Rina Wulandari', 'SIP-004-2024', 'admin', '081234567893', '2025-12-24 01:55:51', '2025-12-24 01:55:51'),
	(5, 'Rendi', 'SIP-005-2025', 'admin', '081234567894', '2026-01-04 21:58:58', '2026-01-04 21:58:58');

-- Dumping structure for table erm_new.emp_on_unit
CREATE TABLE IF NOT EXISTS `emp_on_unit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `emp_id` bigint unsigned NOT NULL,
  `unit_id` bigint unsigned NOT NULL,
  `created_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`),
  KEY `unit_id` (`unit_id`),
  CONSTRAINT `emp_on_unit_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`id`),
  CONSTRAINT `emp_on_unit_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.emp_on_unit: ~0 rows (approximately)

-- Dumping structure for table erm_new.kunjungan
CREATE TABLE IF NOT EXISTS `kunjungan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pasien_id` int unsigned NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `keluhan` text NOT NULL,
  `dpjp` bigint unsigned NOT NULL,
  `metode_pembayaran` enum('umum','bpjs','asuransi') NOT NULL,
  `asuransi_pasien_id` int unsigned DEFAULT NULL,
  `unit_id` bigint unsigned NOT NULL,
  `created_at` datetime DEFAULT (now()),
  `updated_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `dpjp` (`dpjp`),
  KEY `unit_id` (`unit_id`),
  KEY `asuransi_pasien_id` (`asuransi_pasien_id`),
  CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`),
  CONSTRAINT `kunjungan_ibfk_2` FOREIGN KEY (`dpjp`) REFERENCES `employee` (`id`),
  CONSTRAINT `kunjungan_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`),
  CONSTRAINT `kunjungan_ibfk_4` FOREIGN KEY (`asuransi_pasien_id`) REFERENCES `asuransi_pasien` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.kunjungan: ~2 rows (approximately)
INSERT INTO `kunjungan` (`id`, `pasien_id`, `tanggal_kunjungan`, `keluhan`, `dpjp`, `metode_pembayaran`, `asuransi_pasien_id`, `unit_id`, `created_at`, `updated_at`) VALUES
	(27, 5, '2025-11-14', 'Demam', 1, 'asuransi', 13, 1, '2025-11-12 16:46:44', '2025-11-12 16:46:44'),
	(28, 8, '2025-11-15', 'Flu', 2, 'asuransi', 14, 3, '2025-11-13 14:09:17', '2025-11-13 14:09:17');

-- Dumping structure for table erm_new.obat
CREATE TABLE IF NOT EXISTS `obat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga_jual` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.obat: ~1 rows (approximately)
INSERT INTO `obat` (`id`, `nama`, `harga_jual`) VALUES
	(1, 'Paracetamol', 5000);

-- Dumping structure for table erm_new.pasien
CREATE TABLE IF NOT EXISTS `pasien` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `provinsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kabupaten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kecamatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `desa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT (now()),
  `updated_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.pasien: ~19 rows (approximately)
INSERT INTO `pasien` (`id`, `nik`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_hp`, `provinsi`, `kabupaten`, `kecamatan`, `desa`, `created_at`, `updated_at`) VALUES
	(1, '3274010203040506', 'Siti Ambar', '1992-04-15', 'P', 'Jl. Jambangan No.12, Surabaya', '081234567890', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(2, '3274019901012345', 'Budi Santoso', '1985-09-30', 'L', 'Perum Griya Jambangan, Surabaya', '085712345678', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(3, '3274020102030405', 'Rina Lestari', '1998-07-07', 'P', 'Komplek Jambangan Indah, Surabaya', '082233445566', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(4, '3274030203040507', 'Andi Wijaya', '2000-12-20', 'L', 'Gg. Melati, Jambangan, Surabaya', '081398765432', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(5, '3274040304050608', 'Dewi Kusuma', '1995-02-11', 'P', 'Perumahan Mutiara Jambangan, Surabaya', '085299988877', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2026-01-05 20:15:31'),
	(6, '3274050405060709', 'Ricky Pratama', '1988-06-25', 'L', 'Jl. Kenanga 5, Jambangan, Surabaya', '082112233445', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(7, '3274060506070801', 'Nina Putri', '1993-03-03', 'P', 'Blok B2, Jambangan, Surabaya', '085611122233', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(8, '3274070607080902', 'Agus Hariono', '1979-10-10', 'L', 'Perum. Jambangan Permai, Surabaya', '081377788899', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(9, '3274080708090103', 'Maya Sari', '2002-01-18', 'P', 'Jl. Mawar, Jambangan, Surabaya', '085788899900', NULL, NULL, NULL, NULL, '2025-11-05 03:51:05', '2025-11-05 03:51:05'),
	(10, '3274090809100204', 'Doni Saputra', '1990-05-22', 'L', 'Jl. Anggrek No.14, Jambangan, Surabaya', '081245678901', NULL, NULL, NULL, NULL, '2025-11-05 03:51:48', '2025-11-05 17:38:34'),
	(11, '3274100910110305', 'Lestari Wulan', '1987-11-12', 'P', 'Perum Taman Jambangan, Surabaya', '085312345678', NULL, NULL, NULL, NULL, '2025-11-05 03:51:48', '2025-11-05 03:51:48'),
	(12, '3274111011120406', 'Rizky Kurniawan', '1999-08-09', 'L', 'Jl. Kertomenanggal, Surabaya', '082144556677', NULL, NULL, NULL, NULL, '2025-11-05 03:51:48', '2025-11-05 03:51:48'),
	(13, '3274121112130507', 'Melani Ayu', '2001-03-28', 'P', 'Jl. Pulo Wonokromo, Surabaya', '081355566677', NULL, NULL, NULL, NULL, '2025-11-05 03:51:48', '2025-11-05 03:51:48'),
	(14, '3274131213140608', 'Anton Prabowo', '1983-07-16', 'L', 'Jl. Ahmad Yani, Jambangan, Surabaya', '085766655544', NULL, NULL, NULL, NULL, '2025-11-05 03:51:48', '2025-11-05 03:51:48'),
	(15, '3274141314150709', 'Rina Marlina', '1995-09-05', 'P', 'Jl. Gunung Sari No.27, Surabaya', '081245991122', NULL, NULL, NULL, NULL, '2025-11-05 03:52:44', '2025-11-05 03:52:44'),
	(16, '3274151415160810', 'Yoga Prasetyo', '1992-12-14', 'L', 'Jl. Ketintang Selatan No.10, Surabaya', '082233445566', NULL, NULL, NULL, NULL, '2025-11-05 03:52:44', '2025-11-05 03:52:44'),
	(17, '3274161516170911', 'Nadia Rahma', '2000-06-20', 'P', 'Jl. Karah Indah No.8, Jambangan, Surabaya', '085233441177', NULL, NULL, NULL, NULL, '2025-11-05 03:52:44', '2025-11-05 03:52:44'),
	(18, '3274171617181012', 'Andi Wijaya', '1988-03-03', 'L', 'Jl. Pagesangan Timur No.5, Surabaya', '081345556699', NULL, NULL, NULL, NULL, '2025-11-05 03:52:44', '2025-11-05 03:52:44'),
	(19, '1230938982471234', 'rendi', '2025-11-04', 'L', 'Surabaya', '0815783239421', NULL, NULL, NULL, NULL, '2025-11-14 02:36:47', '2025-11-14 02:36:47');

-- Dumping structure for table erm_new.pemeriksaan_kunjungan
CREATE TABLE IF NOT EXISTS `pemeriksaan_kunjungan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kunjungan_id` bigint unsigned NOT NULL,
  `periksa_id` bigint unsigned NOT NULL,
  `hasil_periksa` bigint NOT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `kunjungan_id` (`kunjungan_id`),
  KEY `periksa_id` (`periksa_id`),
  CONSTRAINT `pemeriksaan_kunjungan_ibfk_1` FOREIGN KEY (`kunjungan_id`) REFERENCES `kunjungan` (`id`),
  CONSTRAINT `pemeriksaan_kunjungan_ibfk_2` FOREIGN KEY (`periksa_id`) REFERENCES `periksa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.pemeriksaan_kunjungan: ~0 rows (approximately)

-- Dumping structure for table erm_new.periksa
CREATE TABLE IF NOT EXISTS `periksa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `batas_atas` bigint NOT NULL,
  `batas_bawah` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.periksa: ~0 rows (approximately)

-- Dumping structure for table erm_new.resep_detail
CREATE TABLE IF NOT EXISTS `resep_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `resep_header_id` bigint unsigned NOT NULL,
  `obat_id` bigint unsigned NOT NULL,
  `qty` bigint NOT NULL,
  `harga_jual` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resep_header_id` (`resep_header_id`),
  KEY `obat_id` (`obat_id`),
  CONSTRAINT `resep_detail_ibfk_1` FOREIGN KEY (`resep_header_id`) REFERENCES `resep_header` (`id`),
  CONSTRAINT `resep_detail_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.resep_detail: ~0 rows (approximately)

-- Dumping structure for table erm_new.resep_header
CREATE TABLE IF NOT EXISTS `resep_header` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nomer` bigint NOT NULL,
  `tanggal` date NOT NULL,
  `kunjungan_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kunjungan_id` (`kunjungan_id`),
  CONSTRAINT `resep_header_ibfk_1` FOREIGN KEY (`kunjungan_id`) REFERENCES `kunjungan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.resep_header: ~0 rows (approximately)

-- Dumping structure for table erm_new.rm_soap
CREATE TABLE IF NOT EXISTS `rm_soap` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kunjungan_id` bigint unsigned NOT NULL,
  `subjective` text,
  `objective` text,
  `assesment` text,
  `plan` text,
  `id_employee` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kunjungan_id` (`kunjungan_id`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `rm_soap_ibfk_1` FOREIGN KEY (`kunjungan_id`) REFERENCES `kunjungan` (`id`),
  CONSTRAINT `rm_soap_ibfk_2` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.rm_soap: ~0 rows (approximately)

-- Dumping structure for table erm_new.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT (now()),
  `updated_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.unit: ~3 rows (approximately)
INSERT INTO `unit` (`id`, `nama_unit`, `kategori`, `created_at`, `updated_at`) VALUES
	(1, 'Poli Umum', 'Rawat Jalan', '2025-12-24 02:07:43', '2025-12-24 02:07:43'),
	(2, 'Poli Gigi', 'Rawat Jalan', '2025-12-24 02:07:43', '2025-12-24 02:07:43'),
	(3, 'IGD', 'Gawat Darurat', '2025-12-24 02:07:43', '2025-12-24 02:07:43');

-- Dumping structure for table erm_new.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_employee` bigint unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT (now()),
  `updated_at` datetime DEFAULT (now()),
  PRIMARY KEY (`id`),
  KEY `id_employee` (`id_employee`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table erm_new.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `id_employee`, `username`, `password`, `created_at`, `updated_at`) VALUES
	(2, 5, 'rendi', '$2y$10$SfLkUnh/b9pEEbE.QP4VceJ3bLXwxqdch0TwghQ/9s0hQ1dznGApu', '2026-01-04 22:22:52', '2026-01-04 22:22:52');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
