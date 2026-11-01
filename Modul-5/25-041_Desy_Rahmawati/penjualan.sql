-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 01, 2026 at 01:33 PM
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
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(15) DEFAULT NULL,
  `nama_barang` varchar(120) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'ATK001', 'Buku Tulis 38 Lembar', 5000, 100, 1),
(2, 'ATK002', 'Pulpen Gel Hitam', 3000, 150, 2),
(3, 'ATK003', 'Pensil Mekanik 2B', 2500, 120, 3),
(4, 'ATK004', 'Penghapus Karet', 2000, 90, 4),
(5, 'ATK005', 'Penggaris Besi 30 cm', 4000, 80, 5),
(6, 'ATK006', 'Spidol Whiteboard', 8500, 60, 6),
(7, 'ATK007', 'Buku Gambar A4', 12000, 50, 7),
(8, 'ATK008', 'Map Folder Plastik', 3500, 110, 8),
(9, 'ATK009', 'Kertas HVS A4 1 Rim', 55000, 40, 9),
(10, 'ATK010', 'Stapler Mini', 15000, 35, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(25) NOT NULL,
  `nama` varchar(120) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Eren Yeager', 'L', '082100000001', 'Jl. Pahlawan No. 21, Surabaya'),
('PLG002', 'Mikasa Ackerman', 'P', '082100000002', 'Jl. Diponegoro No. 22, Sidoarjo'),
('PLG003', 'Levi Ackerman', 'L', '082100000003', 'Jl. Kartini No. 23, Gresik'),
('PLG004', 'Nobara Kugisaki', 'P', '082100000004', 'Jl. Veteran No. 24, Malang'),
('PLG005', 'Satoru Gojo', 'L', '082100000005', 'Jl. Ahmad Yani No. 25, Jakarta'),
('PLG006', 'Anya Forger', 'P', '082100000006', 'Jl. Sudirman No. 26, Mojokerto'),
('PLG007', 'Loid Forger', 'L', '082100000007', 'Jl. Merdeka No. 27, Kediri'),
('PLG008', 'Yor Forger', 'P', '082100000008', 'Jl. Pemuda No. 28, Bandung'),
('PLG009', 'Zenitsu Agatsuma', 'L', '082100000009', 'Jl. Gatot Subroto No. 29, Lamongan'),
('PLG010', 'Shinobu Kocho', 'P', '082100000010', 'Jl. Thamrin No. 30, Pasuruan');

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

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-01-05 09:00:00', 10000, 'TUNAI', 1),
(2, '2025-01-06 10:15:00', 15000, 'TRANSFER', 2),
(3, '2025-01-07 11:30:00', 12500, 'EDC', 3),
(4, '2025-01-08 13:00:00', 10000, 'TUNAI', 4),
(5, '2025-01-09 14:20:00', 20000, 'TRANSFER', 5),
(6, '2025-01-10 09:45:00', 17000, 'EDC', 6),
(7, '2025-01-11 10:30:00', 24000, 'TUNAI', 7),
(8, '2025-01-12 12:15:00', 10500, 'TRANSFER', 8),
(9, '2025-01-13 15:00:00', 110000, 'EDC', 9),
(10, '2025-01-14 16:30:00', 30000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(120) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'CV. Pena Kreatif', '081311100001', 'Surabaya'),
(2, 'PT. Kertas Nusantara', '081311100002', 'Sidoarjo'),
(3, 'UD. Alat Tulis Mandiri', '081311100003', 'Gresik'),
(4, 'CV. Cahaya Ilmu', '081311100004', 'Malang'),
(5, 'PT. Mitra Perkantoran', '081311100005', 'Jakarta'),
(6, 'UD. Sumber ATK', '081311100006', 'Mojokerto'),
(7, 'CV. Bintang Edukasi', '081311100007', 'Kediri'),
(8, 'PT. Sentosa Stationery', '081311100008', 'Bandung'),
(9, 'UD. Karya Pelajar', '081311100009', 'Lamongan'),
(10, 'CV. Global Stationery', '081311100010', 'Pasuruan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text,
  `total` int DEFAULT NULL,
  `pelanggan_id` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-01-05', 'Pembelian buku tulis', 10000, 'PLG001'),
(2, '2025-01-06', 'Pembelian pulpen gel', 15000, 'PLG002'),
(3, '2025-01-07', 'Pembelian pensil mekanik', 12500, 'PLG003'),
(4, '2025-01-08', 'Pembelian penghapus', 10000, 'PLG004'),
(5, '2025-01-09', 'Pembelian penggaris besi', 20000, 'PLG005'),
(6, '2025-01-10', 'Pembelian spidol whiteboard', 17000, 'PLG006'),
(7, '2025-01-11', 'Pembelian buku gambar', 24000, 'PLG007'),
(8, '2025-01-12', 'Pembelian map folder', 10500, 'PLG008'),
(9, '2025-01-13', 'Pembelian kertas HVS', 110000, 'PLG009'),
(10, '2025-01-14', 'Pembelian stapler mini', 30000, 'PLG010');

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

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000, 2),
(2, 2, 3000, 5),
(3, 3, 2500, 5),
(4, 4, 2000, 5),
(5, 5, 4000, 5),
(6, 6, 8500, 2),
(7, 7, 12000, 2),
(8, 8, 3500, 3),
(9, 9, 55000, 2),
(10, 10, 15000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `nama` varchar(80) DEFAULT NULL,
  `alamat` varchar(180) DEFAULT NULL,
  `hp` varchar(25) DEFAULT NULL,
  `level` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin01', 'admin001', 'Naruto Uzumaki', 'Jl. Konoha No. 11, Surabaya', '081234500001', 1),
(2, 'kasir01', 'kasir001', 'Hinata Hyuga', 'Jl. Mawar No. 12, Sidoarjo', '081234500002', 2),
(3, 'kasir02', 'kasir002', 'Sasuke Uchiha', 'Jl. Kenanga No. 13, Gresik', '081234500003', 2),
(4, 'gudang01', 'gudang001', 'Sakura Haruno', 'Jl. Anggrek No. 14, Malang', '081234500004', 3),
(5, 'manager01', 'manager001', 'Kakashi Hatake', 'Jl. Dahlia No. 15, Jakarta', '081234500005', 1),
(6, 'kasir03', 'kasir003', 'Monkey D. Luffy', 'Jl. Cempaka No. 16, Mojokerto', '081234500006', 2),
(7, 'gudang02', 'gudang002', 'Nami', 'Jl. Flamboyan No. 17, Kediri', '081234500007', 3),
(8, 'kasir04', 'kasir004', 'Roronoa Zoro', 'Jl. Teratai No. 18, Bandung', '081234500008', 2),
(9, 'gudang03', 'gudang003', 'Tanjiro Kamado', 'Jl. Kamboja No. 19, Lamongan', '081234500009', 3),
(10, 'manager02', 'manager002', 'Nezuko Kamado', 'Jl. Bougenville No. 20, Pasuruan', '081234500010', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
