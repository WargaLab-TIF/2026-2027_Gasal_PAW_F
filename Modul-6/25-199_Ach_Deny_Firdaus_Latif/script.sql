CREATE DATABASE penjualan_db;
USE penjualan_db;

-- Tabel Supplier (Master)
CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12) NOT NULL,
    alamat TEXT
);

-- Tabel Barang (Master)
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE RESTRICT
);

-- Tabel Pelanggan (Master)
CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp VARCHAR(12) NOT NULL,
    alamat TEXT
);

-- Tabel Transaksi (Master Transaksi)
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT DEFAULT 0,
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT
);

-- Tabel Transaksi Detail (Detail Transaksi)
CREATE TABLE transaksi_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT,
    barang_id INT,
    harga INT NOT NULL,
    qty INT NOT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT
);

-- Tabel Pembayaran (Transaksi)
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE
);

-- Tabel User (Master) - Menggunakan backtick miring karena 'user' adalah reserved word
CREATE TABLE `user` (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL
);

-- =========================================================
-- INPUT DATA MASTER (MINIMAL 5 DATA) & TRANSAKSI (MINIMAL 10 DATA)
-- =========================================================

-- 5 Data Master Supplier
INSERT INTO supplier (nama, telp, alamat) VALUES 
('PT. Elektronik Nusantara', '081234567890', 'Surabaya'),
('CV. Prima Abadi', '085712345678', 'Sidoarjo'),
('UD. Berkah Mandiri', '081398765432', 'Gresik'),
('PT. Global Tech', '082155443322', 'Malang'),
('Distributor Mega', '089611223344', 'Jakarta');

-- 5 Data Master Barang
INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES 
('BRG001', 'Mouse Wireless', 120000, 50, 1),
('BRG002', 'Keyboard Gaming', 350000, 25, 1),
('BRG003', 'Monitor 24 Inch', 1500000, 10, 2),
('BRG004', 'Flashdisk 32GB', 75000, 100, 3),
('BRG005', 'Harddisk Ext 1TB', 850000, 15, 3);

-- 5 Data Master Pelanggan
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES 
('PLG001', 'Ahmad Dani', 'L', '0811223344', 'Jl. Pemuda No. 1'),
('PLG002', 'Siti Fatimah', 'P', '0855667788', 'Jl. Mawar No. 12'),
('PLG003', 'Budi Wijaya', 'L', '0819876543', 'Jl. Erlangga No. 5'),
('PLG004', 'Citra Dewi', 'P', '0822334455', 'Jl. Melati No. 8'),
('PLG005', 'Eko Prasetyo', 'L', '0877889900', 'Jl. Pahlawan No. 20');

-- 5 Data Master User
INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES 
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', 'Surabaya', '0811', 1),
('kasir1', 'c4ca4238a0b923820dcc509a6f75849b', 'Siti', 'Sidoarjo', '0812', 2),
('kasir2', 'c81e728d9d4c2f636f067f89cc14862c', 'Rian', 'Gresik', '0813', 2),
('manager', '1a82f03a7898970f0321f820ac35e0c4', 'Budi', 'Malang', '0814', 3),
('owner', '9ee152dec41f0ed2e6d9e51c8411d51c', 'Heri', 'Jakarta', '0815', 3);

-- 3 Data Transaksi (Master)
INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES 
(1, '2026-11-01', 'Transaksi Tunai', 0, 'PLG001'),
(2, '2026-11-02', 'Pengadaan Kantor', 0, 'PLG002'),
(3, '2026-11-03', 'Belanja Bulanan', 0, 'PLG003');

-- 10 Data Transaksi Detail (Tersebar di Transaksi Master)
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES 
(1, 1, 120000, 2),
(1, 2, 350000, 1),
(1, 4, 75000, 3),
(2, 3, 1500000, 1),
(2, 5, 850000, 2),
(3, 1, 120000, 1),
(3, 2, 350000, 2),
(3, 3, 1500000, 1),
(3, 4, 75000, 5),
(3, 5, 850000, 1);
