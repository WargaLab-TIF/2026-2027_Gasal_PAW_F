DROP DATABASE IF EXISTS db_penjualan;
CREATE DATABASE db_penjualan;
USE db_penjualan;

-- Tabel Supplier
CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

-- Tabel Pelanggan
CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);

-- Tabel User
CREATE TABLE `user` (
    id_user TINYINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL
);

-- Tabel Barang
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL UNIQUE,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Tabel Transaksi
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT DEFAULT 0,
    pelanggan_id VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Tabel Transaksi Detail
CREATE TABLE transaksi_detail (
    transaksi_id INT,
    barang_id INT,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Tabel Pembayaran
CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- INPUT DATA MASTER
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Pangan', '081234567890', 'Jl. Industri No. 12, Surabaya'),
('CV Maju Jaya', '082198765432', 'Jl. Pahlawan No. 45, Malang'),
('UD Makmur Sentosa', '083812345678', 'Jl. Merdeka No. 8, Sidoarjo'),
('PT Distribusi Utama', '085711223344', 'Jl. Gajah Mada No. 99, Jombang'),
('CV Agro Sukses', '089699887766', 'Jl. Ahmad Yani No. 15, Pasuruan');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG-001', 'George Russel', 'L', '081122334455', 'Jl. Melati No. 3, Malang'),
('PLG-002', 'Kimi Antonelli', 'P', '082233445566', 'Jl. Mawar No. 10, Surabaya'),
('PLG-003', 'Oliver Bearman', 'L', '083344556677', 'Jl. Anggrek No. 25, Sidoarjo'),
('PLG-004', 'Oscar Piastri', 'P', '084455667788', 'Jl. Dahlia No. 7, Pasuruan'),
('PLG-005', 'Lewis Hamilton', 'L', '085566778899', 'Jl. Kenanga No. 12, Gresik');

INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator Utama', 'Jl. Basuki Rahmat No. 1', '081000111222', 1),
('kasir1', MD5('kasir123'), 'Frank Kasir', 'Jl. Sunandar No. 5', '081000111223', 2),
('kasir2', MD5('kasir123'), 'Axel Kasir', 'Jl. Pemuda No. 88', '081000111224', 2),
('gudang', MD5('gudang123'), 'Ariana Logistik', 'Jl. Diponegoro No. 14', '081000111225', 3),
('manager', MD5('manager123'), 'Rihana Manager', 'Jl. Veteran No. 2', '081000111226', 1);

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras Premium 5kg', 65000, 50, 1),
('BRG002', 'Minyak Goreng 2L', 34000, 40, 2),
('BRG003', 'Gula Pasir 1kg', 15000, 100, 3),
('BRG004', 'Teh Celup Pack', 8500, 75, 4),
('BRG005', 'Kopi Bubuk 200g', 18000, 60, 5),
('BRG006', 'Susu Kental Manis', 12000, 80, 1);

-- INPUT DATA TRANSAKSI & DETAIL (Minimal 10 Data Transaksi)
INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-11-01', 'Pembelian langsung', 164000, 'PLG-001'),
(2, '2026-11-01', 'Pembelian grosir', 197000, 'PLG-002'),
(3, '2026-11-02', 'Pembelian langsung', 33500, 'PLG-003'),
(4, '2026-11-02', 'Pesanan via whatsapp', 130000, 'PLG-004'),
(5, '2026-11-03', 'Pembelian langsung', 68000, 'PLG-005'),
(6, '2026-11-03', 'Pembelian langsung', 113000, 'PLG-001'),
(7, '2026-11-04', 'Pesanan via telfon', 45000, 'PLG-002'),
(8, '2026-11-04', 'Pembelian grosir', 162500, 'PLG-003'),
(9, '2026-11-05', 'Pembelian langsung', 98000, 'PLG-004'),
(10, '2026-11-05', 'Pembelian langsung', 130000, 'PLG-005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 65000, 2), (1, 2, 34000, 1),
(2, 2, 34000, 3), (2, 3, 15000, 5), (2, 4, 8500, 2),
(3, 4, 8500, 1), (3, 3, 15000, 1), (3, 6, 10000, 1),
(4, 1, 65000, 2),
(5, 2, 34000, 2),
(6, 1, 65000, 1), (6, 5, 18000, 1), (6, 3, 15000, 2),
(7, 3, 15000, 3),
(8, 1, 65000, 2), (8, 4, 8500, 3), (8, 6, 7000, 1),
(9, 5, 18000, 3), (9, 6, 11000, 4),
(10, 1, 65000, 2);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-11-01 10:15:00', 164000, 'TUNAI', 1),
('2026-11-01 14:20:00', 197000, 'TRANSFER', 2),
('2026-11-02 09:05:00', 33500, 'TUNAI', 3),
('2026-11-02 16:40:00', 130000, 'EDC', 4),
('2026-11-03 11:10:00', 68000, 'TUNAI', 5),
('2026-11-03 13:30:00', 113000, 'TRANSFER', 6),
('2026-11-04 15:00:00', 45000, 'TUNAI', 7),
('2026-11-04 17:15:00', 162500, 'EDC', 8),
('2026-11-05 10:00:00', 98000, 'TUNAI', 9),
('2026-11-05 12:45:00', 130000, 'TRANSFER', 10);
