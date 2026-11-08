-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 08, 2026 at 10:18 AM
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
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'ATK001', 'Buku Tulis 38 Lembar', 5000, 100, 1),
(2, 'ATK002', 'Pulpen Gel Hitam', 3500, 150, 2),
(3, 'ATK003', 'Pensil 2B', 2500, 120, 3),
(4, 'ATK004', 'Penghapus Putih', 2000, 80, 4),
(5, 'ATK005', 'Spidol Boardmarker', 8500, 60, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('CUS001', 'Naruto Uzumaki', 'L', '081234510001', 'Jl. Kenanga No. 12, Surabaya'),
('CUS002', 'Hinata Hyuga', 'P', '081234510002', 'Jl. Mawar No. 8, Sidoarjo'),
('CUS003', 'Sasuke Uchiha', 'L', '081234510003', 'Jl. Anggrek No. 21, Gresik'),
('CUS004', 'Sakura Haruno', 'P', '081234510004', 'Jl. Cempaka No. 5, Malang'),
('CUS005', 'Shikamaru Nara', 'L', '081234510005', 'Jl. Teratai No. 14, Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-11-01 09:15:00', 10000, 'TUNAI', 1),
(2, '2026-11-02 10:20:00', 7000, 'TRANSFER', 2),
(3, '2026-11-03 11:30:00', 12500, 'EDC', 3),
(4, '2026-11-04 13:10:00', 17000, 'TUNAI', 4),
(5, '2026-11-05 14:25:00', 16000, 'TRANSFER', 5),
(6, '2026-11-06 09:45:00', 12500, 'TUNAI', 6),
(7, '2026-11-07 10:50:00', 26000, 'EDC', 7),
(8, '2026-11-08 12:15:00', 8500, 'TRANSFER', 8),
(9, '2026-11-09 13:40:00', 15000, 'TUNAI', 9),
(10, '2026-11-10 15:00:00', 12000, 'EDC', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'CV Karya Utama', '0317012345', 'Jl. Diponegoro No. 15, Surabaya'),
(2, 'PT Cipta Niaga', '0317023456', 'Jl. Ahmad Yani No. 28, Sidoarjo'),
(3, 'UD Sinar Terang', '0317034567', 'Jl. Panglima Sudirman No. 9, Gresik'),
(4, 'CV Mandiri Jaya', '0217045678', 'Jl. Melati No. 32, Jakarta'),
(5, 'PT Bintang Persada', '0341701234', 'Jl. Ijen No. 17, Malang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text,
  `total` int DEFAULT '0',
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-01', 'Pembelian perlengkapan sekolah', 10000, 'CUS001'),
(2, '2026-11-02', 'Pembelian alat tulis harian', 7000, 'CUS002'),
(3, '2026-11-03', 'Pembelian kebutuhan belajar', 12500, 'CUS003'),
(4, '2026-11-04', 'Pembelian perlengkapan kantor', 17000, 'CUS004'),
(5, '2026-11-05', 'Pembelian alat tulis lengkap', 16000, 'CUS005'),
(6, '2026-11-06', 'Pembelian buku dan pensil', 12500, 'CUS001'),
(7, '2026-11-07', 'Pembelian perlengkapan menulis', 26000, 'CUS002'),
(8, '2026-11-08', 'Pembelian alat tulis satuan', 8500, 'CUS003'),
(9, '2026-11-09', 'Pembelian perlengkapan kelas', 15000, 'CUS004'),
(10, '2026-11-10', 'Pembelian kebutuhan administrasi', 12000, 'CUS005');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` int NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000, 2),
(2, 2, 3500, 2),
(3, 1, 5000, 1),
(3, 3, 2500, 3),
(4, 5, 8500, 2),
(5, 2, 3500, 1),
(5, 4, 2000, 2),
(5, 5, 8500, 1),
(6, 1, 5000, 1),
(6, 3, 2500, 3),
(7, 2, 3500, 5),
(7, 5, 8500, 1),
(8, 5, 8500, 1),
(9, 1, 5000, 3),
(10, 2, 3500, 1),
(10, 5, 8500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'superadmin', 'f35364bc808b079853de5a1e343e7159', 'Fajar Nugraha', 'Surabaya', '081234520001', 1),
(2, 'kasir_andi', '03339dc0dff443f15c254baccde9bece', 'Andi Pratama', 'Sidoarjo', '081234520002', 2),
(3, 'kasir_sinta', 'ad388556cdd6816279c1cc334c925a09', 'Sinta Amelia', 'Gresik', '081234520003', 2),
(4, 'petugas_gudang', 'cbb7449d78314665f9e7c7dd0a18a68a', 'Rizky Firmansyah', 'Malang', '081234520004', 3),
(5, 'pemilik_toko', '5be057accb25758101fa5eadbbd79503', 'Agus Setiawan', 'Surabaya', '081234520005', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
