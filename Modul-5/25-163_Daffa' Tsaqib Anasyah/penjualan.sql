-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2026 at 07:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Laptop ASUS ROG', 15000000, 10, 1),
(2, 'BRG002', 'Mouse Wireless Logitech', 250000, 50, 2),
(3, 'BRG003', 'Keyboard Mechanical', 750000, 25, 3),
(4, 'BRG004', 'Monitor LG 24 Inch', 2100000, 15, 4),
(5, 'BRG005', 'Headset Gaming Razer', 600000, 30, 5),
(6, 'BRG006', 'Printer Epson L3210', 2500000, 12, 6),
(7, 'BRG007', 'Flashdisk Sandisk 64GB', 120000, 100, 7),
(8, 'BRG008', 'External HDD 1TB', 900000, 20, 8),
(9, 'BRG009', 'SSD NVMe 512GB', 850000, 40, 9),
(10, 'BRG010', 'Router TP-Link WiFi', 350000, 35, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Budi Santoso', 'L', '081111222333', 'Jl. Kenanga No. 1, Jakarta'),
(2, 'Siti Aminah', 'P', '082222333444', 'Jl. Mawar No. 5, Bandung'),
(3, 'Joko Widodo', 'L', '083333444555', 'Jl. Melati No. 10, Solo'),
(4, 'Dewi Lestari', 'P', '084444555666', 'Jl. Kenari No. 8, Surabaya'),
(5, 'Ahmad Yani', 'L', '085555666777', 'Jl. Pahlawan No. 2, Semarang'),
(6, 'Rina Marlina', 'P', '086666777888', 'Jl. Anggrek No. 12, Yogyakarta'),
(7, 'Eko Prasetyo', 'L', '087777888999', 'Jl. Cendrawasih No. 20, Malang'),
(8, 'Sri Wahyuni', 'P', '088888999000', 'Jl. Rajawali No. 14, Medan'),
(9, 'Doni Setiawan', 'L', '089999000111', 'Jl. Garuda No. 9, Bali'),
(10, 'Putri Anisa', 'P', '081234098765', 'Jl. Delima No. 22, Palembang');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('Tunai','transfer','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 10:30:00', 15250000, 'transfer', 1),
(2, '2026-10-02 11:00:00', 750000, 'Tunai', 2),
(3, '2026-10-03 14:15:00', 2100000, 'EDC', 3),
(4, '2026-10-04 09:45:00', 600000, 'Tunai', 4),
(5, '2026-10-05 15:20:00', 2500000, 'transfer', 5),
(6, '2026-10-06 13:10:00', 120000, 'Tunai', 6),
(7, '2026-10-07 16:00:00', 900000, 'transfer', 7),
(8, '2026-10-08 10:05:00', 850000, 'EDC', 8),
(9, '2026-10-09 12:50:00', 350000, 'Tunai', 9),
(10, '2026-10-10 17:30:00', 1000000, 'transfer', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sinar Jaya', '081234567890', 'Jl. Merdeka No. 10, Jakarta'),
(2, 'CV Maju Bersama', '082345678901', 'Jl. Sudirman No. 45, Bandung'),
(3, 'Toko Berkah Abadi', '083456789012', 'Jl. Ahmad Yani No. 12, Surabaya'),
(4, 'UD Sumber Rezeki', '084567890123', 'Jl. Gajah Mada No. 88, Semarang'),
(5, 'PT Global Tekindo', '085678901234', 'Jl. Pemuda No. 5, Yogyakarta'),
(6, 'CV Mitra Niaga', '086789012345', 'Jl. Asia Afrika No. 20, Bandung'),
(7, 'Toko Jaya Mandiri', '087890123456', 'Jl. Diponegoro No. 15, Denpasar'),
(8, 'UD Makmur Sentosa', '088901234567', 'Jl. Imam Bonjol No. 77, Medan'),
(9, 'PT Nusantara Trade', '089012345678', 'Jl. Hayam Wuruk No. 33, Jakarta'),
(10, 'CV Sejahtera Abadi', '081122334455', 'Jl. Malioboro No. 50, Yogyakarta');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01', 'Pembelian Laptop dan Mouse', 15250000, 1),
(2, '2026-10-02', 'Pembelian Keyboard', 750000, 2),
(3, '2026-10-03', 'Pembelian Monitor', 2100000, 3),
(4, '2026-10-04', 'Pembelian Headset', 600000, 4),
(5, '2026-10-05', 'Pembelian Printer', 2500000, 5),
(6, '2026-10-06', 'Pembelian Flashdisk', 120000, 6),
(7, '2026-10-07', 'Pembelian HDD Eksternal', 900000, 7),
(8, '2026-10-08', 'Pembelian SSD', 850000, 8),
(9, '2026-10-09', 'Pembelian Router', 350000, 9),
(10, '2026-10-10', 'Pembelian Mouse dan Keyboard', 1000000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 15000000, 1),
(1, 2, 250000, 1),
(2, 3, 750000, 1),
(3, 4, 2100000, 1),
(4, 5, 600000, 1),
(5, 6, 2500000, 1),
(6, 7, 120000, 1),
(7, 8, 900000, 1),
(8, 9, 850000, 1),
(9, 10, 350000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin1', '202cb962ac59075b964b07152d234b70', 'Administrator Utama', 'Jl. Utama No. 1', '081234567891', 1),
(2, 'kasir1', '202cb962ac59075b964b07152d234b70', 'Siti Kasir', 'Jl. Kasir No. 2', '081234567892', 2),
(3, 'kasir2', '202cb962ac59075b964b07152d234b70', 'Budi Kasir', 'Jl. Kasir No. 3', '081234567893', 2),
(4, 'gudang1', '202cb962ac59075b964b07152d234b70', 'Joko Gudang', 'Jl. Gudang No. 4', '081234567894', 3),
(5, 'manager', '202cb962ac59075b964b07152d234b70', 'Rahmat Manager', 'Jl. Kantor No. 5', '081234567895', 1),
(6, 'staff1', '202cb962ac59075b964b07152d234b70', 'Ani Staff', 'Jl. Staff No. 6', '081234567896', 3),
(7, 'staff2', '202cb962ac59075b964b07152d234b70', 'Doni Staff', 'Jl. Staff No. 7', '081234567897', 3),
(8, 'supervisor', '202cb962ac59075b964b07152d234b70', 'Hendra SPV', 'Jl. Supervisor No. 8', '081234567898', 2),
(9, 'operator', '202cb962ac59075b964b07152d234b70', 'Dewi Operator', 'Jl. Operator No. 9', '081234567899', 3),
(10, 'owner', '202cb962ac59075b964b07152d234b70', 'Bambang Owner', 'Jl. Elite No. 10', '081234567800', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
