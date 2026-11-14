
DROP DATABASE IF EXISTS Modul_7;
CREATE DATABASE Modul_7;
USE Modul_7;

CREATE TABLE supplier (
  id     INT NOT NULL AUTO_INCREMENT,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12),
  alamat TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE barang (
  id          INT NOT NULL AUTO_INCREMENT,
  kode_barang VARCHAR(10) NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT NOT NULL,
  stok        INT NOT NULL,
  supplier_id INT NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_kode_barang (kode_barang),
  FOREIGN KEY (supplier_id) REFERENCES supplier (id)
) ENGINE=InnoDB;

CREATE TABLE pelanggan (
  id            VARCHAR(20) NOT NULL,
  nama          VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12),
  alamat        TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id              INT NOT NULL AUTO_INCREMENT,
  waktu_transaksi DATE NOT NULL,
  keterangan      TEXT,
  total           INT NOT NULL,
  pelanggan_id    VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan (id)
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT NOT NULL,
  barang_id    INT NOT NULL,
  harga        INT NOT NULL,
  qty          INT NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi (id),
  FOREIGN KEY (barang_id) REFERENCES barang (id)
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id           INT NOT NULL AUTO_INCREMENT,
  waktu_bayar  DATETIME NOT NULL,
  total        INT NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi (id)
) ENGINE=InnoDB;

CREATE TABLE `user` (
  id_user  TINYINT NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(35) NOT NULL,
  nama     VARCHAR(50),
  alamat   VARCHAR(150),
  hp       VARCHAR(20),
  level    TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (id_user),
  UNIQUE KEY uk_username (username)
) ENGINE=InnoDB;

-- ---------------- DATA CONTOH ----------------
INSERT INTO supplier (nama, telp, alamat) VALUES
('CV Sumber Makmur', '031555010', 'Jl. Raya Bangkalan No. 10');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id)
VALUES
('BRG001', 'Minyak Goreng 1 L', 13000, 100, 1),
('BRG002', 'Gula Pasir 1 Kg', 16000, 80, 1),
('BRG003', 'Tepung Terigu 1 Kg', 11000, 60, 1);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('P001', 'Ahmad Fauzi',   'L', '081234500001', 'Bangkalan'),
('P002', 'Siti Aminah',   'P', '081234500002', 'Bangkalan'),
('P003', 'Budi Santoso',  'L', '081234500003', 'Sampang'),
('P004', 'Dewi Lestari',  'P', '081234500004', 'Pamekasan'),
('P005', 'Rina Marlina',  'P', '081234500005', 'Bangkalan'),
('P006', 'Joko Susilo',   'L', '081234500006', 'Sumenep'),
('P007', 'Lina Wati',     'P', '081234500007', 'Bangkalan'),
('P008', 'Hendra Gunawan', 'L', '081234500008', 'Sampang'),
('P009', 'Maya Sari',     'P', '081234500009', 'Pamekasan'),
('P010', 'Eko Prasetyo',  'L', '081234500010', 'Sumenep');

INSERT INTO transaksi
(id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-01-02', 'Pembelian barang', 26000, 'P001'),
(2, '2026-01-15', 'Pembelian barang', 38000, 'P002'),
(3, '2026-01-15', 'Pembelian barang', 13000, 'P003'),
(4, '2026-02-10', 'Pembelian barang', 48000, 'P004'),
(5, '2026-02-25', 'Pembelian barang', 44000, 'P001'),
(6, '2026-03-12', 'Pembelian barang', 55000, 'P005'),
(7, '2026-04-08', 'Pembelian barang', 26000, 'P006'),
(8, '2026-05-20', 'Pembelian barang', 43000, 'P007'),
(9, '2026-06-05', 'Pembelian barang', 52000, 'P002'),
(10,'2026-06-18', 'Pembelian barang', 33000, 'P008'),
(11,'2026-07-22', 'Pembelian barang', 24000, 'P009'),
(12,'2026-08-14', 'Pembelian barang', 80000, 'P010'),
(13,'2026-09-09', 'Pembelian barang', 39000, 'P003'),
(14,'2026-10-03', 'Pembelian barang', 58000, 'P004'),
(15,'2026-11-10', 'Pembelian barang', 38000, 'P005');

INSERT INTO transaksi_detail
(transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 13000, 2), (2, 2, 16000, 1), (2, 3, 11000, 2),
(3, 1, 13000, 1), (4, 2, 16000, 3), (5, 3, 11000, 4),
(6, 1, 13000, 3), (6, 2, 16000, 1), (7, 1, 13000, 2),
(8, 2, 16000, 2), (8, 3, 11000, 1), (9, 1, 13000, 4),
(10, 3, 11000, 3), (11, 1, 13000, 1), (11, 3, 11000, 1),
(12, 2, 16000, 5), (13, 1, 13000, 3), (14, 2, 16000, 2),
(14, 1, 13000, 2), (15, 3, 11000, 2), (15, 2, 16000, 1);

INSERT INTO `user` (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator', 'Bangkalan',
 '081200000000', 1);
