CREATE DATABASE IF NOT EXISTS penjualan_paw_modul5;
USE penjualan_paw_modul5;
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Nov 01, 2026 at 02:07 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_paw_modul5`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(2, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(3, 'PT Segar Segar', '0845454663', 'Surabaya'),
(4, 'PT. Makmur Sentosa', '08122334455', 'Jakarta'),
(5, 'CV. Bintang Terang', '08199887766', 'Malang'),
(6, 'UD. Sumber Rejeki', '08561122334', 'Sidoarjo'),
(7, 'Toko Laris Manis', '08223344556', 'Bangkalan'),
(8, 'PT. Global Indo', '08134455667', 'Surabaya'),
(9, 'CV. Jaya Abadi', '08155667788', 'Gresik'),
(11, 'PT. Indah Jaya', '0982821', 'SIdoarjo');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text,
  `total` int DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` int DEFAULT NULL,
  `qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- DATA MASTER PELANGGAN (5 DATA)
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Andi Saputra', 'L', '081200000001', 'Surabaya'),
('PLG002', 'Budi Santoso', 'L', '081200000002', 'Sidoarjo'),
('PLG003', 'Citra Lestari', 'P', '081200000003', 'Gresik'),
('PLG004', 'Dewi Anggraini', 'P', '081200000004', 'Mojokerto'),
('PLG005', 'Eko Prasetyo', 'L', '081200000005', 'Surabaya');

-- DATA MASTER BARANG (10 DATA)
INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Mouse Wireless', 75000, 30, 1),
(2, 'BRG002', 'Keyboard USB', 95000, 25, 2),
(3, 'BRG003', 'Flashdisk 32GB', 65000, 40, 3),
(4, 'BRG004', 'Headset', 120000, 20, 4),
(5, 'BRG005', 'Kabel HDMI', 45000, 35, 5),
(6, 'BRG006', 'Mouse Pad', 25000, 50, 6),
(7, 'BRG007', 'Webcam', 180000, 15, 7),
(8, 'BRG008', 'Speaker Mini', 85000, 18, 8),
(9, 'BRG009', 'USB Hub', 55000, 22, 9),
(10, 'BRG010', 'Charger Laptop', 150000, 12, 11);

-- DATA MASTER USER (5 DATA)
INSERT INTO user (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'admin', 'admin123', 'Admin Toko', 'Surabaya', '081300000001', 1),
(2, 'kasir01', 'kasir123', 'Rina', 'Sidoarjo', '081300000002', 2),
(3, 'kasir02', 'kasir123', 'Doni', 'Gresik', '081300000003', 2),
(4, 'staff01', 'staff123', 'Maya', 'Surabaya', '081300000004', 3),
(5, 'staff02', 'staff123', 'Rudi', 'Malang', '081300000005', 3);

-- DATA TRANSAKSI (10 DATA)
INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-10-01', 'Pembelian perlengkapan komputer', 170000, 'PLG001'),
(2, '2026-10-02', 'Pembelian aksesoris komputer', 160000, 'PLG002'),
(3, '2026-10-03', 'Pembelian perangkat kantor', 90000, 'PLG003'),
(4, '2026-10-04', 'Pembelian perangkat audio', 205000, 'PLG004'),
(5, '2026-10-05', 'Pembelian perlengkapan laptop', 100000, 'PLG005'),
(6, '2026-10-06', 'Pembelian perangkat komputer', 140000, 'PLG001'),
(7, '2026-10-07', 'Pembelian perangkat tambahan', 235000, 'PLG002'),
(8, '2026-10-08', 'Pembelian aksesoris', 210000, 'PLG003'),
(9, '2026-10-09', 'Pembelian perangkat komputer', 130000, 'PLG004'),
(10, '2026-10-10', 'Pembelian perlengkapan', 205000, 'PLG005');

-- DATA TRANSAKSI DETAIL (2 BARANG UNTUK SETIAP TRANSAKSI)
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 75000, 1), (1, 2, 95000, 1),
(2, 3, 65000, 1), (2, 5, 45000, 1),
(3, 5, 45000, 2),
(4, 4, 120000, 1), (4, 6, 25000, 1), (4, 9, 55000, 1),
(5, 5, 45000, 1), (5, 6, 25000, 2),
(6, 1, 75000, 1), (6, 6, 25000, 1),
(7, 7, 180000, 1), (7, 6, 25000, 1), (7, 9, 55000, 1),
(8, 8, 85000, 1), (8, 4, 120000, 1),
(9, 2, 95000, 1), (9, 6, 25000, 1),
(10, 10, 150000, 1), (10, 5, 45000, 1);

-- PERBAIKI TOTAL BERDASARKAN DETAIL (AGAR DATA CONTOH KONSISTEN)
UPDATE transaksi t
SET total = (
    SELECT COALESCE(SUM(td.harga * td.qty), 0)
    FROM transaksi_detail td
    WHERE td.transaksi_id = t.id
);

-- DATA PEMBAYARAN (10 DATA)
INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1, '2026-10-01 10:00:00', 170000, 'TUNAI', 1),
(2, '2026-10-02 11:00:00', 110000, 'TRANSFER', 2),
(3, '2026-10-03 12:00:00', 90000, 'EDC', 3),
(4, '2026-10-04 13:00:00', 200000, 'TUNAI', 4),
(5, '2026-10-05 14:00:00', 95000, 'TRANSFER', 5),
(6, '2026-10-06 10:30:00', 100000, 'EDC', 6),
(7, '2026-10-07 11:30:00', 260000, 'TUNAI', 7),
(8, '2026-10-08 12:30:00', 205000, 'TRANSFER', 8),
(9, '2026-10-09 13:30:00', 120000, 'EDC', 9),
(10, '2026-10-10 14:30:00', 195000, 'TUNAI', 10);
