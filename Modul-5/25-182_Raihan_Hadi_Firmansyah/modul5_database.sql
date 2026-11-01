-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Nov 2026 pada 16.17
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
-- Basis data: `modul5_database`
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
(1, 'BRG001', 'Buku Tulis', 5000.00, 100, 1),
(2, 'BRG002', 'Pulpen', 3000.00, 150, 2),
(3, 'BRG003', 'Pensil', 2000.00, 120, 3),
(4, 'BRG004', 'Penghapus', 1500.00, 80, 4),
(5, 'BRG005', 'Penggaris', 4000.00, 60, 5),
(6, 'BRG006', 'Spidol', 7000.00, 50, 6),
(7, 'BRG007', 'Buku Gambar', 8000.00, 40, 7),
(8, 'BRG008', 'Map Plastik', 2500.00, 90, 8),
(9, 'BRG009', 'Stabilo', 6000.00, 70, 9),
(10, 'BRG010', 'Kertas HVS', 50000.00, 30, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Rizky', 'L', '081234567801', 'Sumenep'),
(2, 'putri', 'P', '081234567802', 'Surabaya'),
(3, 'Dimas', 'L', '081234567803', 'Sampang'),
(4, 'Nabila', 'P', '081234567804', 'Pamekasan'),
(5, 'Rafi', 'L', '081234567805', 'Bangkalan'),
(6, 'Aulia', 'P', '081234567806', 'Gresik'),
(7, 'Fikri', 'L', '081234567807', 'Lamongan'),
(8, 'Nadia', 'P', '081234567808', 'Sidoarjo'),
(9, 'Bagas', 'L', '081234567809', 'Mojokerto'),
(10, 'Syifa', 'P', '081234567810', 'Jombang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `waktu_bayar` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(12,2) NOT NULL,
  `metode` enum('Tunai','Transfer','EDC') NOT NULL,
  `transaksi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(11, '2026-10-01 09:10:00', 10000.00, 'Tunai', 1),
(12, '2026-10-02 10:10:00', 6000.00, 'Transfer', 2),
(13, '2026-10-03 11:10:00', 4000.00, 'Tunai', 3),
(14, '2026-10-04 12:10:00', 3000.00, 'Tunai', 4),
(15, '2026-10-05 13:10:00', 8000.00, 'Transfer', 5),
(16, '2026-10-06 14:10:00', 14000.00, 'Transfer', 6),
(17, '2026-10-07 15:10:00', 16000.00, 'Tunai', 7),
(18, '2026-10-08 16:10:00', 5000.00, 'Transfer', 8),
(19, '2026-10-09 17:10:00', 12000.00, 'Tunai', 9),
(20, '2026-10-10 18:10:00', 100000.00, 'Tunai', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'CV Sumber Jaya', '081111111101', 'Surabaya'),
(2, 'PT Maju Bersama', '081111111102', 'Bangkalan'),
(3, 'UD Berkah', '081111111103', 'Sampang'),
(4, 'CV Makmur', '081111111104', 'Pamekasan'),
(5, 'PT Sejahtera', '081111111105', 'Sumenep'),
(6, 'UD Sinar Abadi', '081111111106', 'Gresik'),
(7, 'CV Mitra Usaha', '081111111107', 'Lamongan'),
(8, 'PT Karya Mandiri', '081111111108', 'Sidoarjo'),
(9, 'UD Sumber Rezeki', '081111111109', 'Mojokerto'),
(10, 'CV Cahaya Baru', '081111111110', 'Jombang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `waktu_transaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `keterangan` text,
  `total` decimal(12,2) DEFAULT '0.00',
  `pelanggan_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-10-01 09:00:00', 'Pembelian buku', 10000.00, 1),
(2, '2026-10-02 10:00:00', 'Pembelian pulpen', 6000.00, 2),
(3, '2026-10-03 11:00:00', 'Pembelian pensil', 4000.00, 3),
(4, '2026-10-04 12:00:00', 'Pembelian penghapus', 3000.00, 4),
(5, '2026-10-05 13:00:00', 'Pembelian penggaris', 8000.00, 5),
(6, '2026-10-06 14:00:00', 'Pembelian spidol', 14000.00, 6),
(7, '2026-10-07 15:00:00', 'Pembelian buku gambar', 16000.00, 7),
(8, '2026-10-08 16:00:00', 'Pembelian map plastik', 5000.00, 8),
(9, '2026-10-09 17:00:00', 'Pembelian stabilo', 12000.00, 9),
(10, '2026-10-10 18:00:00', 'Pembelian kertas HVS', 100000.00, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int NOT NULL,
  `barang_id` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000.00, 2),
(2, 2, 3000.00, 2),
(3, 3, 2000.00, 2),
(4, 4, 1500.00, 2),
(5, 5, 4000.00, 2),
(6, 6, 7000.00, 2),
(7, 7, 8000.00, 2),
(8, 8, 2500.00, 2),
(9, 9, 6000.00, 2),
(10, 10, 50000.00, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `hp` varchar(20) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'andi', '12345', 'Andi Saputra', 'Bangkalan', '081234567801', '1'),
(2, 'budi', '12345', 'Budi Santoso', 'Surabaya', '081234567802', '2'),
(3, 'citra', '12345', 'Citra Lestari', 'Sampang', '081234567803', '2'),
(4, 'dedi', '12345', 'Dedi Pratama', 'Pamekasan', '081234567804', '1'),
(5, 'eka', '12345', 'Eka Putri', 'Sumenep', '081234567805', '2'),
(6, 'fajar', '12345', 'Fajar Hidayat', 'Bangkalan', '081234567806', '3'),
(7, 'gita', '12345', 'Gita Amelia', 'Surabaya', '081234567807', '2'),
(8, 'hendra', '12345', 'Hendra Wijaya', 'Kamal', '081234567808', '1'),
(9, 'indah', '12345', 'Indah Permata', 'Telang', '081234567809', '2'),
(10, 'joko', '12345', 'Joko Firmansyah', 'Bangkalan', '081234567810', '3');

--
-- Indeks untuk tabel yang dibuang
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
