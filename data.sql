/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `kerupuk_abadi_asikin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kerupuk_abadi_asikin`;

CREATE TABLE IF NOT EXISTS `biaya_operasional` (
  `id_bo` int NOT NULL AUTO_INCREMENT,
  `tanggal_bo` date NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`id_bo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `data_pekerja` (
  `id_pekerja` int NOT NULL AUTO_INCREMENT,
  `nama_pekerja` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `mulai_kerja` varchar(50) NOT NULL,
  `berakhir_kerja` varchar(50) NOT NULL,
  `bagian` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pekerja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `kategori_akun` (
  `id_akun` int NOT NULL AUTO_INCREMENT,
  `nama_akun` varchar(50) NOT NULL,
  PRIMARY KEY (`id_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `kerupuk_matang` (
  `id_mtg` int NOT NULL AUTO_INCREMENT,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal` date NOT NULL,
  `no_invoice` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bm_qty` int NOT NULL DEFAULT '0',
  `bm_harga` int NOT NULL DEFAULT '0',
  `bm_total` int NOT NULL DEFAULT '0',
  `bk_qty` int NOT NULL DEFAULT '0',
  `bk_harga` int NOT NULL DEFAULT '0',
  `bk_total` int NOT NULL DEFAULT '0',
  `saldo_qty` int NOT NULL DEFAULT '0',
  `saldo_harga` int NOT NULL DEFAULT '0',
  `saldo_total` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mtg`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `kerupuk_mentah` (
  `id_mth` int NOT NULL AUTO_INCREMENT,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal` date NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `bm_qty` int NOT NULL DEFAULT '0',
  `bm_harga` int NOT NULL DEFAULT '0',
  `bm_total` int NOT NULL DEFAULT '0',
  `bk_qty` int NOT NULL DEFAULT '0',
  `bk_harga` int NOT NULL DEFAULT '0',
  `bk_total` int NOT NULL DEFAULT '0',
  `saldo_qty` int NOT NULL DEFAULT '0',
  `saldo_harga` int NOT NULL DEFAULT '0',
  `saldo_total` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mth`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `log_activity` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `message` text,
  `is_read` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_pj` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenis_produk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kuantitas` int DEFAULT NULL,
  `harga_kg` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL,
  `diskon` int DEFAULT NULL,
  `harga_total` int DEFAULT NULL,
  PRIMARY KEY (`id_pj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
