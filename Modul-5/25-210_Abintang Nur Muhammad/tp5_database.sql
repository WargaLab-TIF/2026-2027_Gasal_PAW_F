-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2026 pada 23.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp5_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
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
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'B001', 'Beras 5kg', 65000, 50, 1),
(2, 'B002', 'Minyak 2L', 28000, 40, 2),
(3, 'B003', 'Gula 1kg', 14500, 60, 3),
(4, 'B004', 'Terigu 1kg', 12000, 30, 4),
(5, 'B005', 'Telur 1kg', 26000, 25, 5),
(6, 'B006', 'Kecap', 18000, 45, 6),
(7, 'B007', 'Saus', 11000, 35, 7),
(8, 'B008', 'Kopi', 15000, 80, 8),
(9, 'B009', 'Teh', 8000, 100, 9),
(10, 'B010', 'Susu', 12500, 55, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('P001', 'Pelanggan 1', 'L', '081111111101', 'Bangkalan'),
('P002', 'Pelanggan 2', 'P', '081111111102', 'Surabaya'),
('P003', 'Pelanggan 3', 'L', '081111111103', 'Malang'),
('P004', 'Pelanggan 4', 'P', '081111111104', 'Gresik'),
('P005', 'Pelanggan 5', 'L', '081111111105', 'Sidoarjo'),
('P006', 'Pelanggan 6', 'P', '081111111106', 'Mojokerto'),
('P007', 'Pelanggan 7', 'L', '081111111107', 'Lamongan'),
('P008', 'Pelanggan 8', 'P', '081111111108', 'Kediri'),
('P009', 'Pelanggan 9', 'L', '081111111109', 'Jombang'),
('P010', 'Pelanggan 10', 'L', '081111111110', 'Pasuruan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') NOT NULL,
  `transaksi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-10-01 10:00:00', 50000, 'TUNAI', 1),
(2, '2026-10-02 11:00:00', 75000, 'TRANSFER', 2),
(3, '2026-10-03 09:00:00', 30000, 'TUNAI', 3),
(4, '2026-10-04 14:00:00', 120000, 'EDC', 4),
(5, '2026-10-05 15:00:00', 45000, 'TUNAI', 5),
(6, '2026-10-06 08:00:00', 90000, 'TRANSFER', 6),
(7, '2026-10-07 13:00:00', 60000, 'TUNAI', 7),
(8, '2026-10-08 16:00:00', 25000, 'EDC', 8),
(9, '2026-10-09 10:30:00', 150000, 'TRANSFER', 9),
(10, '2026-10-10 12:00:00', 35000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT. Surabaya', '081234567891', 'Surabaya'),
(2, 'PT. Bangkalan', '081234567892', 'Bangkalan'),
(3, 'PT. Sidoarjo', '081234567893', 'Sidoarjo'),
(4, 'PT. Gresik', '081234567894', 'Gresik'),
(5, 'PT. Malang', '081234567895', 'Malang'),
(6, 'PT. Mojokerto', '081234567896', 'Mojokerto'),
(7, 'PT. Lamongan', '081234567897', 'Lamongan'),
(8, 'PT. Kediri', '081234567898', 'Kediri'),
(9, 'PT. Jombang', '081234567899', 'Jombang'),
(10, 'PT. Pasuruan', '081234567890', 'Pasuruan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `pelanggan_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01', 'Tunai', 50000, 'P001'),
(2, '2026-10-02', 'Lunas', 75000, 'P002'),
(3, '2026-10-03', 'Rutin', 30000, 'P003'),
(4, '2026-10-04', 'Bulanan', 120000, 'P004'),
(5, '2026-10-05', 'Harian', 45000, 'P005'),
(6, '2026-10-06', 'Mingguan', 90000, 'P006'),
(7, '2026-10-07', 'Belanja', 60000, 'P007'),
(8, '2026-10-08', 'Tambahan', 25000, 'P008'),
(9, '2026-10-09', 'Grosir', 150000, 'P009'),
(10, '2026-10-10', 'eceran', 35000, 'P010');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 65000, 1),
(2, 2, 28000, 2),
(3, 3, 14500, 1),
(4, 4, 12000, 1),
(5, 5, 26000, 1),
(6, 6, 18000, 2),
(7, 7, 11000, 1),
(8, 8, 15000, 1),
(9, 9, 8000, 3),
(10, 10, 12500, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin1', 'admin123', 'Admin Satu', 'Bangkalan', '08111', 1),
(2, 'kasir1', 'kasir123', 'Kasir Satu', 'Surabaya', '08222', 2),
(3, 'kasir2', 'kasir123', 'Kasir Dua', 'Malang', '08333', 2),
(4, 'owner', 'owner123', 'Pemilik Toko', 'Jakarta', '08444', 1),
(5, 'staff1', 'staff123', 'Staff Gudang', 'Gresik', '08555', 3),
(6, 'staff2', 'staff123', 'Staff Toko', 'Lamongan', '08666', 3),
(7, 'op1', 'op123', 'Operator', 'Tuban', '08777', 2),
(8, 'spv1', 'spv123', 'Supervisor', 'Sidoarjo', '08888', 1),
(9, 'guest', 'guest123', 'Tamu', 'Madura', '08999', 3),
(10, 'root', 'root123', 'Super Admin', 'Surabaya', '08000', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
