CREATE DATABASE IF NOT EXISTS DB_PENJUALAN;
USE DB_PENJUALAN;

-- 1. Tabel user
CREATE TABLE IF NOT EXISTS `user` (
    id_user TINYINT(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(30),
    password VARCHAR(35),
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1)
);

-- 2. Tabel supplier
CREATE TABLE IF NOT EXISTS supplier (
    id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nama VARCHAR(100),
    telp VARCHAR(12),
    alamat TEXT
);

-- 3. Tabel barang
CREATE TABLE IF NOT EXISTS barang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    kode_barang VARCHAR(10),
    nama_barang VARCHAR(100),
    harga INT(11),
    stok INT(11),
    supplier_id INT(11),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- 4. Tabel pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    id VARCHAR(20) PRIMARY KEY NOT NULL,
    nama VARCHAR(100),
    jenis_kelamin ENUM('L', 'P'),
    telp VARCHAR(12),
    alamat TEXT
);

-- 5. Tabel transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    waktu_transaksi DATE,
    keterangan TEXT,
    total INT(11),
    pelanggan_id VARCHAR(20),  
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- 6. Tabel transaksi_detail
CREATE TABLE IF NOT EXISTS transaksi_detail (
    transaksi_id INT(11) NOT NULL,
    barang_id INT(11) NOT NULL,
    harga INT(11),
    qty INT(11),
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- 7. Tabel pembayaran
CREATE TABLE IF NOT EXISTS pembayaran (
    id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    waktu_bayar DATETIME,
    total INT(11),
    metode ENUM('TUNAI', 'TRANSFER', 'EDC'),
    transaksi_id INT(11),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- INSERT DATA DUMMY 

-- Data User 
INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES
('alex_wright', 'super123', 'Alexander Wright', 'Jl. Dipati Ukur No. 12', '081234567890', 1),
('sophia_m', 'op1234', 'Sophia Miller', 'Jl. Setiabudi No. 45', '082345678901', 2),
('liam_j', 'op5678', 'Liam Johnson', 'Jl. Cihampelas No. 88', '083456789012', 2),
('ben_smith', 'gudang99', 'Benjamin Smith', 'Jl. Buah Batu No. 10', '084567890123', 3),
('olivia_w', 'spv777', 'Olivia Williams', 'Jl. Riau No. 17', '085678901234', 1),
('lucas_b', 'stf111', 'Lucas Brown', 'Jl. Soekarno Hatta No. 5', '086789012345', 2),
('emma_d', 'stf222', 'Emma Davis', 'Jl. Dago No. 21', '087890123456', 2),
('james_w', 'stf333', 'James Wilson', 'Jl. Antapani No. 9', '088901234567', 3),
('charlotte_t', 'stf444', 'Charlotte Taylor', 'Jl. Arcamanik No. 14', '089012345678', 2),
('william_a', 'stf555', 'William Anderson', 'Jl. Kiaracondong No. 77', '081122334455', 3);

-- Data Supplier 
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Global Jaya Mandiri', '0217894561', 'Jakarta Selatan'),
('CV. Nusantara Pangan', '0316543210', 'Surabaya'),
('UD. Sinar Terang Abadi', '0229876543', 'Bandung'),
('PT. Makmur Sentosa', '0243210987', 'Semarang'),
('CV. Sumber Rezeki', '0341123456', 'Malang'),
('PT. Anugerah Bersama', '0274456789', 'Yogyakarta'),
('UD. Tani Sejahtera', '0331789123', 'Jember'),
('PT. Mega Distribusiindo', '0313334444', 'Sidoarjo'),
('CV. Karya Mandiri', '0351555666', 'Madiun'),
('PT. Pangan Lestari', '0218889999', 'Tangerang');

-- Data Barang 
INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG01', 'Kopi Bubuk Robusta 250g', 20000, 45, 1),
('BRG02', 'Teh Hitam Celup Kotak', 8000, 110, 2),
('BRG03', 'Susu UHT Cokelat 1L', 19000, 60, 3),
('BRG04', 'Biskuit Gandum Sehat', 12000, 85, 4),
('BRG05', 'Mie Sedaap Kari Spesial', 3000, 200, 5),
('BRG06', 'Sabun Mandi Batang Herbal', 5000, 150, 6),
('BRG07', 'Pasta Gigi Herbal 100g', 14000, 75, 7),
('BRG08', 'Detergen Cair 800ml', 24000, 55, 8),
('BRG09', 'Pembersih Piring Jeruk Nipis', 11000, 95, 9),
('BRG10', 'Minyak Goreng Pouch 1L', 17500, 80, 10);

-- Data Pelanggan 
INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P01', 'Jay Idzes', 'L', '085211223344', 'Jl. Garuda No. 12'),
('P02', 'Ragnar Oratmangoen', 'L', '085322334455', 'Jl. Rajawali No. 15'),
('P03', 'Thom Haye', 'L', '085433445566', 'Jl. Kenari No. 20'),
('P04', 'Maarten Paes', 'L', '085544556677', 'Jl. Kasuari No. 7'),
('P05', 'Calvin Verdonk', 'L', '085655667788', 'Jl. Cendrawasih No. 3'),
('P06', 'Rafael Struick', 'L', '085766778899', 'Jl. Merpati No. 9'),
('P07', 'Marselino Ferdinan', 'L', '085877889900', 'Jl. Elang No. 18'),
('P08', 'Rizky Ridho', 'L', '085988990011', 'Jl. Beo No. 25'),
('P09', 'Justin Hubner', 'L', '085199001122', 'Jl. Gelatik No. 30'),
('P10', 'Sandy Walsh', 'L', '085200112233', 'Jl. Pipit No. 50');

-- Data Transaksi 
INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2024-11-01', 'Belanja Kebutuhan Dapur', 40000, 'P01'),
('2024-11-02', 'Stok Warung Kelontong', 57000, 'P02'),
('2024-11-03', 'Pembelian Cemilan', 24000, 'P03'),
('2024-11-04', 'Belanja Mingguan Keluarga', 96000, 'P04'),
('2024-11-05', 'Keperluan Mandi & Cuci', 35000, 'P05'),
('2024-11-06', 'Belanja Harian', 38000, 'P06'),
('2024-11-07', 'Pembelian Grosir Kecil', 72000, 'P07'),
('2024-11-08', 'Belanja Bulanan', 120000, 'P08'),
('2024-11-09', 'Keperluan Kantor', 45000, 'P09'),
('2024-11-10', 'Belanja Akhir Pekan', 105000, 'P10');

-- Data Transaksi Detail 
INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 20000, 2),
(2, 3, 19000, 3),
(3, 4, 12000, 2),
(4, 8, 24000, 4),
(5, 6, 5000, 7),
(6, 2, 8000, 2),
(6, 5, 3000, 7),
(7, 10, 17500, 4),
(8, 7, 14000, 5),
(9, 9, 11000, 4);

-- Data Pembayaran 
INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2024-11-01 08:30:00', 40000, 'TUNAI', 1),
('2024-11-02 09:45:00', 57000, 'TRANSFER', 2),
('2024-11-03 10:15:00', 24000, 'EDC', 3),
('2024-11-04 11:20:00', 96000, 'TRANSFER', 4),
('2024-11-05 13:10:00', 35000, 'TUNAI', 5),
('2024-11-06 14:00:00', 38000, 'TUNAI', 6),
('2024-11-07 15:30:00', 72000, 'EDC', 7),
('2024-11-08 16:40:00', 120000, 'TRANSFER', 8),
('2024-11-09 17:00:00', 45000, 'TUNAI', 9),
('2024-11-10 19:15:00', 105000, 'EDC', 10);