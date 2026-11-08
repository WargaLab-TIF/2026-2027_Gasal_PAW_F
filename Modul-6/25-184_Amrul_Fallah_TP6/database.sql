
DROP DATABASE IF EXISTS penjualan;
CREATE DATABASE penjualan CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE penjualan;

CREATE TABLE supplier (
  id     INT          NOT NULL AUTO_INCREMENT,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12)  DEFAULT NULL,
  alamat TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE barang (
  id          INT          NOT NULL AUTO_INCREMENT,
  kode_barang VARCHAR(10)  NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT          NOT NULL DEFAULT 0,
  stok        INT          NOT NULL DEFAULT 0,
  supplier_id INT          NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_kode_barang (kode_barang),
  KEY idx_barang_supplier (supplier_id),
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id)
    REFERENCES supplier (id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pelanggan (
  id            VARCHAR(20)  NOT NULL,
  nama          VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12)  DEFAULT NULL,
  alamat        TEXT,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id              INT         NOT NULL AUTO_INCREMENT,
  waktu_transaksi DATE        NOT NULL,
  keterangan      TEXT,
  total           INT         NOT NULL DEFAULT 0,
  pelanggan_id    VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  KEY idx_transaksi_pelanggan (pelanggan_id),
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan (id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT NOT NULL,
  barang_id    INT NOT NULL,
  harga        INT NOT NULL,
  qty          INT NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  KEY idx_detail_barang (barang_id),
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id)
    REFERENCES barang (id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id           INT      NOT NULL AUTO_INCREMENT,
  waktu_bayar  DATETIME NOT NULL,
  total        INT      NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT      NOT NULL,
  PRIMARY KEY (id),
  KEY idx_bayar_transaksi (transaksi_id),
  CONSTRAINT fk_bayar_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi (id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE user (
  id_user  TINYINT     NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(35) NOT NULL,
  nama     VARCHAR(50) NOT NULL,
  alamat   VARCHAR(150) DEFAULT NULL,
  hp       VARCHAR(20)  DEFAULT NULL,
  level    TINYINT(1)  NOT NULL DEFAULT 2,
  PRIMARY KEY (id_user),
  UNIQUE KEY uk_username (username)
) ENGINE=InnoDB;

INSERT INTO supplier (id, nama, telp, alamat) VALUES
(1, 'PT Sumber Makmur', '0211234567', 'Jl. Merdeka No. 10, Jakarta'),
(2, 'CV Jaya Abadi', '0227654321', 'Jl. Asia Afrika No. 5, Bandung'),
(3, 'PT Nusantara Snack', '0318765432', 'Jl. Tunjungan No. 21, Surabaya'),
(4, 'UD Berkah Tani', '0274112233', 'Jl. Malioboro No. 8, Yogyakarta'),
(5, 'PT Global Stationery', '0248899001', 'Jl. Pemuda No. 17, Semarang');

INSERT INTO barang (id, kode_barang, nama_barang, harga, stok, supplier_id) VALUES
(1, 'BRG001', 'Beras Premium 5kg', 68000, 50, 1),
(2, 'BRG002', 'Minyak Goreng 2L', 38000, 80, 1),
(3, 'BRG003', 'Gula Pasir 1kg', 16500, 100, 4),
(4, 'BRG004', 'Telur Ayam 1kg', 29000, 60, 4),
(5, 'BRG005', 'Mie Instan Goreng', 3500, 300, 3),
(6, 'BRG006', 'Keripik Singkong', 12000, 75, 3),
(7, 'BRG007', 'Buku Tulis 38 Lembar', 5500, 200, 5),
(8, 'BRG008', 'Pulpen Gel Hitam', 4500, 250, 5),
(9, 'BRG009', 'Sabun Mandi Cair 450ml', 22000, 40, 2),
(10, 'BRG010', 'Detergen Bubuk 800g', 19000, 55, 2);

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Andi Pratama', 'L', '081234560001', 'Jl. Melati No. 3, Malang'),
('PLG002', 'Siti Rahayu', 'P', '081234560002', 'Jl. Mawar No. 12, Malang'),
('PLG003', 'Budi Santoso', 'L', '081234560003', 'Jl. Kenanga No. 7, Batu'),
('PLG004', 'Dewi Lestari', 'P', '081234560004', 'Jl. Anggrek No. 21, Malang'),
('PLG005', 'Rizky Ramadhan', 'L', '081234560005', 'Jl. Cempaka No. 9, Malang'),
('PLG006', 'Nur Aini', 'P', '081234560006', 'Jl. Dahlia No. 15, Batu');

-- password = MD5('<username>123')
INSERT INTO user (id_user, username, password, nama, alamat, hp, level) VALUES
(1, 'admin', MD5('admin123'), 'Administrator', 'Jl. Veteran No. 1, Malang', '081300000001', 1),
(2, 'kasir1', MD5('kasir1123'), 'Rina Kasir', 'Jl. Veteran No. 2, Malang', '081300000002', 2),
(3, 'kasir2', MD5('kasir2123'), 'Doni Kasir', 'Jl. Veteran No. 3, Malang', '081300000003', 2),
(4, 'gudang1', MD5('gudang1123'), 'Eko Gudang', 'Jl. Veteran No. 4, Malang', '081300000004', 3),
(5, 'owner', MD5('owner123'), 'Pemilik Toko', 'Jl. Veteran No. 5, Malang', '081300000005', 1);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1, '2026-10-01', 'Belanja bulanan', 177000, 'PLG001'),
(2, '2026-10-03', 'Pembelian harian', 59000, 'PLG002'),
(3, '2026-10-05', 'Perlengkapan sekolah', 60000, 'PLG003'),
(4, '2026-10-07', 'Belanja dapur', 112500, 'PLG004'),
(5, '2026-10-10', 'Stok warung', 282500, 'PLG005'),
(6, '2026-10-12', 'Belanja mingguan', 97000, 'PLG001'),
(7, '2026-10-15', 'Alat tulis kantor', 120000, 'PLG006'),
(8, '2026-10-18', 'Belanja bulanan', 191500, 'PLG002'),
(9, '2026-10-22', 'Pembelian harian', 69000, 'PLG003'),
(10, '2026-10-25', 'Belanja dapur', 231000, 'PLG004');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 68000, 1),
(1, 2, 38000, 2),
(1, 3, 16500, 2),
(2, 5, 3500, 10),
(2, 6, 12000, 2),
(3, 7, 5500, 6),
(3, 8, 4500, 6),
(4, 2, 38000, 1),
(4, 4, 29000, 2),
(4, 3, 16500, 1),
(5, 5, 3500, 40),
(5, 6, 12000, 5),
(5, 3, 16500, 5),
(6, 4, 29000, 1),
(6, 1, 68000, 1),
(7, 7, 5500, 12),
(7, 8, 4500, 12),
(8, 1, 68000, 2),
(8, 2, 38000, 1),
(8, 5, 3500, 5),
(9, 6, 12000, 3),
(9, 3, 16500, 2),
(10, 4, 29000, 3),
(10, 2, 38000, 2),
(10, 1, 68000, 1);

INSERT INTO pembayaran (id, waktu_bayar, total, metode, transaksi_id) VALUES
(1, '2026-10-01 11:07:00', 177000, 'TRANSFER', 1),
(2, '2026-10-03 12:14:00', 59000, 'EDC', 2),
(3, '2026-10-05 13:21:00', 60000, 'TUNAI', 3),
(4, '2026-10-07 14:28:00', 112500, 'TRANSFER', 4),
(5, '2026-10-10 15:35:00', 282500, 'EDC', 5),
(6, '2026-10-12 16:42:00', 97000, 'TUNAI', 6),
(7, '2026-10-15 17:49:00', 120000, 'TRANSFER', 7),
(8, '2026-10-18 18:56:00', 191500, 'EDC', 8),
(9, '2026-10-22 19:03:00', 69000, 'TUNAI', 9),
(10, '2026-10-25 10:10:00', 231000, 'TRANSFER', 10);
