-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Nov 2026 pada 13.49
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `modul6_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int NOT NULL,
  `supplier_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Laptop ROG', 12000000.00, 100, 1),
(2, 'BRG002', 'Mouse Logitech', 150000.00, 30, 2),
(3, 'BRG003', 'Keyboard Mechanical', 450000.00, 20, 3),
(4, 'BRG004', 'Monitor LG', 1800000.00, 15, 4),
(5, 'BRG005', 'Flashdisk Sandisk', 85000.00, 50, 5),
(6, 'BRG006', 'Harddisk Eksternal', 950000.00, 12, 6),
(7, 'BRG007', 'Headset Gaming', 350000.00, 25, 7),
(8, 'BRG008', 'Webcam Logitech', 500000.00, 18, 8),
(9, 'BRG009', 'Printer Epson', 2200000.00, 8, 9),
(10, 'BRG010', 'Speaker Bluetooth', 275000.00, 22, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Andi Saputra', 'L', '081234567801', 'Surabaya'),
('PLG002', 'Budi Santoso', 'L', '081234567802', 'Bangkalan'),
('PLG003', 'Citra Lestari', 'P', '081234567803', 'Sampang'),
('PLG004', 'Dewi Anggraini', 'P', '081234567804', 'Pamekasan'),
('PLG005', 'Eko Prasetyo', 'L', '081234567805', 'Sumenep'),
('PLG006', 'Fitri Amelia', 'P', '081234567806', 'Surabaya'),
('PLG007', 'Gilang Ramadhan', 'L', '081234567807', 'Gresik'),
('PLG008', 'Hana Putri', 'P', '081234567808', 'Lamongan'),
('PLG009', 'Irfan Maulana', 'L', '081234567809', 'Sidoarjo'),
('PLG010', 'Jihan Safitri', 'P', '081234567810', 'Madura');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `metode` varchar(20) NOT NULL,
  `transaksi_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-11-01 10:00:00', 7500000.00, 'Tunai', 1),
(2, '2026-11-02 11:00:00', 300000.00, 'Transfer', 2),
(3, '2026-11-03 12:00:00', 450000.00, 'Tunai', 3),
(4, '2026-11-04 13:00:00', 1800000.00, 'Transfer', 4),
(5, '2026-11-05 14:00:00', 170000.00, 'Tunai', 5),
(6, '2026-11-06 09:00:00', 950000.00, 'Transfer', 6),
(7, '2026-11-07 10:30:00', 700000.00, 'Tunai', 7),
(8, '2026-11-08 11:30:00', 500000.00, 'Transfer', 8),
(9, '2026-11-08 12:30:00', 2200000.00, 'Tunai', 9),
(10, '2026-11-08 13:30:00', 550000.00, 'Transfer', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Makmur', '081311111111', 'Surabaya'),
(2, 'CV Berkah Jaya', '081322222222', 'Bangkalan'),
(3, 'PT Mitra Sejahtera', '081333333333', 'Sidoarjo'),
(4, 'CV Indo Supply', '081344444444', 'Gresik'),
(5, 'PT Cahaya Abadi', '081355555555', 'Malang'),
(6, 'CV Sinar Baru', '081366666666', 'Mojokerto'),
(7, 'PT Global Niaga', '081377777777', 'Lamongan'),
(8, 'CV Makmur Sentosa', '081388888888', 'Pamekasan'),
(9, 'PT Karya Mandiri', '081399999999', 'Jombang'),
(10, 'CV Sukses Bersama', '081300000000', 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text,
  `total` decimal(12,2) DEFAULT '0.00',
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

  INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
  (1, '2026-11-01', 'Pembelian Laptop ROG', 12000000.00, 'PLG001'),
  (2, '2026-11-02', 'Pembelian Mouse Logitech', 300000.00, 'PLG002'),
  (3, '2026-11-03', 'Pembelian Keyboard Mechanical', 450000.00, 'PLG003'),
  (4, '2026-11-04', 'Pembelian Monitor LG', 1800000.00, 'PLG004'),
  (5, '2026-11-05', 'Pembelian Flashdisk Sandisk', 170000.00, 'PLG005'),
  (6, '2026-11-06', 'Pembelian Harddisk Eksternal', 950000.00, 'PLG006'),
  (7, '2026-11-07', 'Pembelian Headset Gaming', 700000.00, 'PLG007'),
  (8, '2026-11-08', 'Pembelian Webcam Logitech', 500000.00, 'PLG008'),
  (9, '2026-11-08', 'Pembelian Printer Epson', 2200000.00, 'PLG009'),
  (10, '2026-11-08', 'Pembelian Mouse Logitech', 150000.00, 'PLG010');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int NOT NULL,
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(2, 2, 2, 150000.00, 2),
(3, 3, 3, 450000.00, 1),
(4, 4, 4, 1800000.00, 1),
(5, 5, 5, 85000.00, 2),
(7, 7, 7, 350000.00, 2),
(8, 8, 8, 500000.00, 1),
(9, 9, 9, 2200000.00, 1),
(13, 10, 2, 150000.00, 1),
(15, 1, 1, 12000000.00, 1),
(23, 6, 6, 950000.00, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text,
  `hp` varchar(15) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'andi01', '123456', 'Andi Saputra', 'Surabaya', '081211111111', '1'),
(2, 'budi02', '123456', 'Budi Santoso', 'Bangkalan', '081222222222', '2'),
(3, 'citra03', '123456', 'Citra Lestari', 'Sampang', '081233333333', '3'),
(4, 'dewi04', '123456', 'Dewi Anggraini', 'Pamekasan', '081244444444', '4'),
(5, 'eko05', '123456', 'Eko Prasetyo', 'Sumenep', '081255555555', '5'),
(6, 'fitri06', '123456', 'Fitri Amelia', 'Surabaya', '081266666666', '6'),
(7, 'gilang07', '123456', 'Gilang Ramadhan', 'Gresik', '081277777777', '7'),
(8, 'hana08', '123456', 'Hana Putri', 'Lamongan', '081288888888', '8'),
(9, 'irfan09', '123456', 'Irfan Maulana', 'Sidoarjo', '081299999999', '9'),
(10, 'jihan10', '123456', 'Jihan Safitri', 'Madura', '081200000000', '10');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_id` (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
