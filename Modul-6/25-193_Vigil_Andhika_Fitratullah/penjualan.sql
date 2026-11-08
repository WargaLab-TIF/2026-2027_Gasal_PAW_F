DROP DATABASE IF EXISTS penjualan;
CREATE DATABASE penjualan CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE penjualan;

CREATE TABLE supplier (
  id     INT AUTO_INCREMENT PRIMARY KEY,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12),
  alamat TEXT
) ENGINE=InnoDB;

CREATE TABLE barang (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10)  NOT NULL UNIQUE,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT NOT NULL,
  stok        INT NOT NULL DEFAULT 0,
  supplier_id INT NOT NULL,
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id)
    REFERENCES supplier(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pelanggan (
  id            VARCHAR(20) PRIMARY KEY,
  nama          VARCHAR(50) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12),
  alamat        TEXT
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi DATE NOT NULL,
  keterangan      TEXT,
  total           INT NOT NULL DEFAULT 0,
  pelanggan_id    VARCHAR(20) NOT NULL,
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT NOT NULL,
  barang_id    INT NOT NULL,
  harga        INT NOT NULL,
  qty          INT NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id)
    REFERENCES barang(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar  DATETIME NOT NULL,
  total        INT NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT NOT NULL,
  CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `user` (
  id_user  TINYINT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL UNIQUE,
  password VARCHAR(35) NOT NULL,
  nama     VARCHAR(50),
  alamat   VARCHAR(150),
  hp       VARCHAR(20),
  level    TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT Sumber Makmur', '081234560001', 'Jl. Raya Surabaya No. 12, Surabaya'),
(2, 'CV Berkah Jaya',   '081234560002', 'Jl. Ahmad Yani No. 45, Bangkalan'),
(3, 'UD Maju Bersama',  '081234560003', 'Jl. Pahlawan No. 8, Sidoarjo'),
(4, 'PT Mitra Abadi',   '081234560004', 'Jl. Diponegoro No. 21, Malang'),
(5, 'CV Sinar Terang',  '081234560005', 'Jl. Gajah Mada No. 7, Gresik');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Budi Santoso', 'L', '085100000001', 'Jl. Merdeka No. 3, Bangkalan'),
('PLG002', 'Siti Aminah',  'P', '085100000002', 'Jl. Melati No. 15, Bangkalan'),
('PLG003', 'Andi Wijaya',  'L', '085100000003', 'Jl. Kenanga No. 9, Sampang'),
('PLG004', 'Dewi Lestari', 'P', '085100000004', 'Jl. Mawar No. 22, Pamekasan'),
('PLG005', 'Rudi Hartono', 'L', '085100000005', 'Jl. Anggrek No. 5, Sumenep');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1,  'BRG001', 'Beras 5 Kg',          65000, 100, 1),
(2,  'BRG002', 'Minyak Goreng 2 L',   38000,  80, 1),
(3,  'BRG003', 'Gula Pasir 1 Kg',     17000, 120, 2),
(4,  'BRG004', 'Tepung Terigu 1 Kg',  12000,  90, 2),
(5,  'BRG005', 'Kopi Bubuk 200 g',    22000,  60, 3),
(6,  'BRG006', 'Teh Celup 25 pcs',     9000, 150, 3),
(7,  'BRG007', 'Susu UHT 1 L',        18000,  70, 4),
(8,  'BRG008', 'Mie Instan 5 pcs',    14000, 200, 5),
(9,  'BRG009', 'Sabun Cair 450 ml',   21000,  55, 4),
(10, 'BRG010', 'Pasta Gigi 120 g',    11000,  95, 5);

INSERT INTO `user` (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'admin',   MD5('admin123'),  'Administrator', 'Jl. Raya Kamal No. 1, Bangkalan', '081200000001', 1),
(2, 'kasir1',  MD5('kasir123'),  'Rina Kasir',    'Jl. Kenari No. 4, Bangkalan',     '081200000002', 2),
(3, 'kasir2',  MD5('kasir123'),  'Doni Kasir',    'Jl. Cempaka No. 6, Bangkalan',    '081200000003', 2),
(4, 'gudang1', MD5('gudang123'), 'Eko Gudang',    'Jl. Dahlia No. 8, Bangkalan',     '081200000004', 3),
(5, 'owner',   MD5('owner123'),  'Pemilik Toko',  'Jl. Teratai No. 10, Bangkalan',   '081200000005', 1);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1,  '2026-10-01', 'Belanja bulanan',   0, 'PLG001'),
(2,  '2026-10-02', 'Pembelian harian',  0, 'PLG002'),
(3,  '2026-10-03', 'Stok warung',       0, 'PLG003'),
(4,  '2026-10-05', 'Belanja mingguan',  0, 'PLG004'),
(5,  '2026-10-06', 'Keperluan dapur',   0, 'PLG005'),
(6,  '2026-10-08', 'Belanja tambahan',  0, 'PLG001'),
(7,  '2026-10-10', 'Pembelian harian',  0, 'PLG002'),
(8,  '2026-10-12', 'Stok warung',       0, 'PLG003'),
(9,  '2026-10-15', 'Belanja bulanan',   0, 'PLG004'),
(10, '2026-10-18', 'Belanja mingguan',  0, 'PLG005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 65000, 1), (1, 2, 38000, 2), (1, 3, 17000, 3),
(2, 3, 17000, 2), (2, 6,  9000, 4),
(3, 1, 65000, 3), (3, 4, 12000, 5), (3, 2, 38000, 1),
(4, 5, 22000, 2), (4, 7, 18000, 3), (4, 6,  9000, 2),
(5, 2, 38000, 2), (5, 4, 12000, 2),
(6, 6,  9000, 5), (6, 7, 18000, 2),
(7, 1, 65000, 2), (7, 3, 17000, 4), (7, 5, 22000, 1),
(8, 4, 12000, 10), (8, 3, 17000, 6),
(9, 1, 65000, 1), (9, 5, 22000, 3), (9, 7, 18000, 1), (9, 2, 38000, 1),
(10, 6, 9000, 3), (10, 4, 12000, 3);

UPDATE transaksi t
SET t.total = (SELECT COALESCE(SUM(d.harga * d.qty), 0)
               FROM transaksi_detail d WHERE d.transaksi_id = t.id);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 10:15:00', 0, 'TUNAI',    1),
('2026-10-02 09:40:00', 0, 'TRANSFER', 2),
('2026-10-03 13:05:00', 0, 'TUNAI',    3),
('2026-10-05 11:20:00', 0, 'EDC',      4),
('2026-10-06 16:45:00', 0, 'TUNAI',    5),
('2026-10-08 08:30:00', 0, 'TRANSFER', 6),
('2026-10-10 14:10:00', 0, 'EDC',      7),
('2026-10-12 10:55:00', 0, 'TUNAI',    8),
('2026-10-15 15:25:00', 0, 'TRANSFER', 9),
('2026-10-18 12:00:00', 0, 'TUNAI',    10);

UPDATE pembayaran p JOIN transaksi t ON t.id = p.transaksi_id SET p.total = t.total;
