-- ============================================================
-- Tugas Praktikum Modul 5 : DATABASE
-- Database : penjualan
-- Import lewat phpMyAdmin (tab Import) atau: mysql -u root < database.sql
-- ============================================================

DROP DATABASE IF EXISTS penjualan;
CREATE DATABASE penjualan CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE penjualan;

-- ------------------------------------------------------------
-- 1. SKEMA TABEL
-- ------------------------------------------------------------

CREATE TABLE supplier (
  id     INT(11)      NOT NULL AUTO_INCREMENT,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12)  NOT NULL,
  alamat TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE barang (
  id          INT(11)      NOT NULL AUTO_INCREMENT,
  kode_barang VARCHAR(10)  NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT(11)      NOT NULL,
  stok        INT(11)      NOT NULL,
  supplier_id INT(11)      NOT NULL,
  PRIMARY KEY (id),
  KEY fk_barang_supplier (supplier_id),
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id) REFERENCES supplier (id)
) ENGINE=InnoDB;

-- id pelanggan bertipe varchar(20) sesuai diagram skema (diisi manual, mis. P001)
CREATE TABLE pelanggan (
  id            VARCHAR(20)  NOT NULL,
  nama          VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12)  NOT NULL,
  alamat        TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id               INT(11)     NOT NULL AUTO_INCREMENT,
  waktu_transaksi  DATE        NOT NULL,
  keterangan       TEXT        NOT NULL,
  total            INT(11)     NOT NULL,
  pelanggan_id     VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  KEY fk_transaksi_pelanggan (pelanggan_id),
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id) REFERENCES pelanggan (id)
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT(11) NOT NULL,
  barang_id    INT(11) NOT NULL,
  harga        INT(11) NOT NULL,
  qty          INT(11) NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  KEY fk_detail_barang (barang_id),
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi (id),
  CONSTRAINT fk_detail_barang    FOREIGN KEY (barang_id)    REFERENCES barang (id)
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id           INT(11)  NOT NULL AUTO_INCREMENT,
  waktu_bayar  DATETIME NOT NULL,
  total        INT(11)  NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT(11)  NOT NULL,
  PRIMARY KEY (id),
  KEY fk_pembayaran_transaksi (transaksi_id),
  CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi (id)
) ENGINE=InnoDB;

-- password varchar(35) cukup untuk hash MD5 (32 karakter)
CREATE TABLE user (
  id_user  TINYINT(4)   NOT NULL AUTO_INCREMENT,
  username VARCHAR(30)  NOT NULL,
  password VARCHAR(35)  NOT NULL,
  nama     VARCHAR(50)  NOT NULL,
  alamat   VARCHAR(150) NOT NULL,
  hp       VARCHAR(15)  NOT NULL,
  level    TINYINT(1)   NOT NULL,
  PRIMARY KEY (id_user)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- 2. DATA MASTER (minimal 10 data per tabel)
-- ------------------------------------------------------------

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT. Maju Bersama',      '08123456',    'Surabaya'),
('PT. Senang Sekali',     '081515563',   'Bangkalan'),
('PT. Segar Segar',       '0845454663',  'Surabaya'),
('CV. Sumber Rejeki',     '081234567890','Sidoarjo'),
('PT. Indo Pangan',       '082111222333','Gresik'),
('CV. Mitra Niaga',       '085233344455','Malang'),
('PT. Bersih Sejahtera',  '081322233344','Surabaya'),
('CV. Cahaya Abadi',      '087755566677','Mojokerto'),
('PT. Karya Utama',       '081999888777','Pasuruan'),
('CV. Tani Makmur',       '085611122233','Jombang');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras Premium 5kg',  68000,  50, 1),
('BRG002', 'Minyak Goreng 2L',   38000,  40, 2),
('BRG003', 'Gula Pasir 1kg',     17500,  80, 1),
('BRG004', 'Telur Ayam 1kg',     29000,  60, 3),
('BRG005', 'Kopi Bubuk 200g',    22000,  35, 4),
('BRG006', 'Teh Celup 25s',       9500, 100, 4),
('BRG007', 'Susu UHT 1L',        18500,  70, 5),
('BRG008', 'Mie Instan',          3500, 200, 6),
('BRG009', 'Sabun Mandi',         4500,  90, 7),
('BRG010', 'Deterjen 800g',      21000,  45, 8);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P001', 'Budi Santoso',    'L', '081200000001', 'Jl. Mawar No. 1, Surabaya'),
('P002', 'Siti Aminah',     'P', '081200000002', 'Jl. Melati No. 5, Sidoarjo'),
('P003', 'Agus Prasetyo',   'L', '081200000003', 'Jl. Kenanga No. 8, Gresik'),
('P004', 'Dewi Lestari',    'P', '081200000004', 'Jl. Anggrek No. 12, Surabaya'),
('P005', 'Rudi Hartono',    'L', '081200000005', 'Jl. Dahlia No. 3, Malang'),
('P006', 'Ani Wulandari',   'P', '081200000006', 'Jl. Kamboja No. 7, Surabaya'),
('P007', 'Joko Widodo',     'L', '081200000007', 'Jl. Flamboyan No. 9, Mojokerto'),
('P008', 'Rina Kartika',    'P', '081200000008', 'Jl. Cempaka No. 2, Bangkalan'),
('P009', 'Eko Nugroho',     'L', '081200000009', 'Jl. Teratai No. 15, Pasuruan'),
('P010', 'Maya Sari',       'P', '081200000010', 'Jl. Seruni No. 4, Jombang');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin',   MD5('admin123'),  'Administrator',   'Surabaya',  '081300000001', 1),
('kasir1',  MD5('kasir123'),  'Dina Kasir',      'Surabaya',  '081300000002', 2),
('kasir2',  MD5('kasir123'),  'Fajar Kasir',     'Sidoarjo',  '081300000003', 2),
('gudang1', MD5('gudang123'), 'Hendra Gudang',   'Gresik',    '081300000004', 3),
('gudang2', MD5('gudang123'), 'Intan Gudang',    'Surabaya',  '081300000005', 3),
('owner',   MD5('owner123'),  'Pak Owner',       'Surabaya',  '081300000006', 1),
('kasir3',  MD5('kasir123'),  'Lukman Kasir',    'Malang',    '081300000007', 2),
('kasir4',  MD5('kasir123'),  'Mira Kasir',      'Mojokerto', '081300000008', 2),
('spv1',    MD5('spv123'),    'Nando Supervisor','Surabaya',  '081300000009', 4),
('spv2',    MD5('spv123'),    'Olivia Supervisor','Pasuruan', '081300000010', 4);

-- ------------------------------------------------------------
-- 3. DATA TRANSAKSI
-- ------------------------------------------------------------

INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Belanja bulanan',           103000, 'P001'),
('2026-10-03', 'Pembelian kebutuhan dapur',  73000, 'P002'),
('2026-10-05', 'Belanja harian',             48000, 'P003'),
('2026-10-07', 'Stok warung',                99500, 'P004'),
('2026-10-09', 'Kebutuhan mandi dan cuci',   39000, 'P005'),
('2026-10-12', 'Beras untuk keluarga',      136000, 'P006'),
('2026-10-15', 'Belanja mingguan',           75500, 'P007'),
('2026-10-18', 'Mie instan untuk acara',     70000, 'P008'),
('2026-10-22', 'Belanja dapur',              85500, 'P009'),
('2026-10-27', 'Belanja susu dan kopi',      80000, 'P010');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1,  1, 68000,  1),
(1,  3, 17500,  2),
(2,  2, 38000,  1),
(2,  8,  3500, 10),
(3,  4, 29000,  1),
(3,  6,  9500,  2),
(4,  5, 22000,  2),
(4,  7, 18500,  3),
(5,  9,  4500,  4),
(5, 10, 21000,  1),
(6,  1, 68000,  2),
(7,  3, 17500,  1),
(7,  4, 29000,  2),
(8,  8,  3500, 20),
(9,  2, 38000,  2),
(9,  6,  9500,  1),
(10, 7, 18500,  2),
(10, 5, 22000,  1),
(10,10, 21000,  1);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:15:00', 103000, 'TUNAI',    1),
('2026-10-03 11:30:00',  73000, 'TRANSFER', 2),
('2026-10-05 09:45:00',  48000, 'TUNAI',    3),
('2026-10-07 14:20:00',  99500, 'EDC',      4),
('2026-10-09 16:05:00',  39000, 'TUNAI',    5),
('2026-10-12 13:10:00', 136000, 'TRANSFER', 6),
('2026-10-15 15:40:00',  75500, 'EDC',      7),
('2026-10-18 10:00:00',  70000, 'TUNAI',    8),
('2026-10-22 12:25:00',  85500, 'TRANSFER', 9),
('2026-10-27 17:00:00',  80000, 'EDC',     10);
