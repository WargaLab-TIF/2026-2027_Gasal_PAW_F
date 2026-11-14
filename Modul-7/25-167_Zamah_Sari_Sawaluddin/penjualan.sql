-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2026 at 09:13 AM
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
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `supplier_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Buku Tulis', 5000, 100, 1),
(2, 'BRG002', 'Pulpen', 3000, 150, 2),
(3, 'BRG003', 'Pensil 2B', 2500, 120, 3),
(4, 'BRG004', 'Penghapus', 2000, 80, 4),
(5, 'BRG005', 'Penggaris', 4000, 90, 5),
(6, 'BRG006', 'Spidol', 7000, 60, 6),
(7, 'BRG007', 'Buku Gambar', 8000, 75, 7),
(8, 'BRG008', 'Map Plastik', 3500, 100, 8),
(9, 'BRG009', 'Correction Tape', 6000, 50, 9),
(10, 'BRG010', 'Pensil Warna', 15000, 40, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Zyura', 'L', '081234567801', 'Jakarta'),
('PLG002', 'Nai', 'P', '081234567802', 'Pamekasan'),
('PLG003', 'Reyza', 'L', '081234567803', 'Bandung'),
('PLG004', 'Reyna', 'P', '081234567804', 'Probolinggo'),
('PLG005', 'Gilang', 'L', '081234567805', 'Sumenep'),
('PLG006', 'Christina', 'P', '081234567806', 'Palu'),
('PLG007', 'Brim', 'L', '081234567807', 'Bangkalan'),
('PLG008', 'Putri', 'P', '081234567808', 'Sampang'),
('PLG009', 'Dimas', 'L', '081234567809', 'Solo'),
('PLG010', 'Rina', 'P', '081234567810', 'Medan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 10:15:00', 25000, 'TUNAI', 1),
(2, '2026-10-02 11:20:00', 35000, 'TRANSFER', 2),
(3, '2026-10-03 13:10:00', 18000, 'TUNAI', 3),
(4, '2026-10-04 09:30:00', 45000, 'EDC', 4),
(5, '2026-10-05 14:25:00', 30000, 'TRANSFER', 5),
(6, '2026-10-06 15:40:00', 27000, 'TUNAI', 6),
(7, '2026-10-07 10:45:00', 22000, 'EDC', 7),
(8, '2026-10-08 12:15:00', 40000, 'TRANSFER', 8),
(9, '2026-10-09 16:20:00', 15000, 'TUNAI', 9),
(10, '2026-10-10 11:35:00', 55000, 'EDC', 10);

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
(1, 'PT. Maju Bersama', '08123456', 'Surabaya'),
(2, 'PT. Senang Sekali', '081515563', 'Bangkalan'),
(3, 'PT. Segar Segar', '0845454663', 'Surabaya'),
(4, 'CV Cahaya Abadi', '08123444', 'Pamekasan'),
(5, 'PT Sembilan Naga', '087812341234', 'Sumenep'),
(6, 'UD Sinar Kembang', '089612345678', 'Pamekasan'),
(7, 'CV Bintang Utara Mulia', '081355667788', 'Bangkalan'),
(8, 'PT Lion Air', '082233445566', 'Sampang'),
(9, 'UD Lancar Jaya', '085633221100', 'Sumenep'),
(10, 'CV Sentosa Jaya', '087755443322', 'Pamekasan'),
(12, 'CV Bintang Timur Mulia', '08821231231', 'Cakung');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text,
  `total` int NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01', 'Pembelian alat tulis', 25000, 'PLG001'),
(2, '2026-10-02', 'Pembelian perlengkapan sekolah', 35000, 'PLG002'),
(3, '2026-10-03', 'Pembelian buku dan pulpen', 18000, 'PLG003'),
(4, '2026-10-04', 'Pembelian perlengkapan kantor', 45000, 'PLG004'),
(5, '2026-10-05', 'Pembelian alat gambar', 30000, 'PLG005'),
(6, '2026-10-06', 'Pembelian alat tulis sekolah', 27000, 'PLG006'),
(7, '2026-10-07', 'Pembelian buku dan penggaris', 22000, 'PLG007'),
(8, '2026-10-08', 'Pembelian perlengkapan belajar', 40000, 'PLG008'),
(9, '2026-10-09', 'Pembelian alat tulis', 15000, 'PLG009'),
(10, '2026-10-10', 'Pembelian perlengkapan sekolah', 55000, 'PLG010');

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
(1, 1, 5000, 5),
(2, 6, 7000, 5),
(3, 9, 6000, 3),
(4, 10, 15000, 3),
(5, 10, 15000, 2),
(6, 2, 3000, 2),
(6, 6, 7000, 3),
(7, 2, 3000, 2),
(7, 7, 8000, 2),
(8, 7, 8000, 5),
(9, 2, 3000, 5),
(10, 1, 5000, 2),
(10, 10, 15000, 3);

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
(1, 'admin01', 'admin123', 'Andi', 'Bangkalan', '081234567821', 1),
(2, 'kasir01', 'kasir123', 'Ririn', 'Bangkalan', '081234567822', 2),
(3, 'kasir02', 'kasir456', 'Doni', 'Pamekasan', '081234567823', 2),
(4, 'admin02', 'admin456', 'Rahma', 'Pamekasan', '081234567824', 1),
(5, 'kasir03', 'kasir789', 'Budi', 'Sumenep', '081234567825', 2),
(6, 'kasir04', 'kasir321', 'Dewi', 'Sumenep', '081234567826', 2),
(7, 'admin03', 'admin789', 'Fajar', 'Bangkalan', '081234567827', 1),
(8, 'kasir05', 'kasir654', 'Aisyah', 'Pamekasan', '081234567828', 2),
(9, 'kasir06', 'kasir987', 'Rizky', 'Sampang', '081234567829', 2),
(10, 'admin04', 'admin321', 'Maya', 'Sampang', '081234567830', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
