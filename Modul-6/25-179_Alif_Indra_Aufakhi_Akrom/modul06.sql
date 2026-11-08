--DATABASE
CREATE DATABASE IF NOT EXISTS modul06
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE modul06;

CREATE TABLE supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;

CREATE TABLE pelanggan (
    id VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L','P'),
    telp VARCHAR(12),
    alamat TEXT
) ENGINE=InnoDB;


CREATE TABLE `user` (
    id_user TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50),
    alamat VARCHAR(150),
    hp VARCHAR(12),
    level TINYINT
) ENGINE=InnoDB;

CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT NOT NULL,

    CONSTRAINT fk_barang_supplier
    FOREIGN KEY (supplier_id)
    REFERENCES supplier(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT NOT NULL DEFAULT 0,
    pelanggan_id VARCHAR(20) NOT NULL,

    CONSTRAINT fk_transaksi_pelanggan
    FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,

    PRIMARY KEY (transaksi_id, barang_id),

    CONSTRAINT fk_detail_transaksi
    FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

    CONSTRAINT fk_detail_barang
    FOREIGN KEY (barang_id)
    REFERENCES barang(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu_bayar DATETIME,
    total INT NOT NULL,
    metode ENUM('TUNAI','TRANSFER','EDC'),
    transaksi_id INT NOT NULL,

    CONSTRAINT fk_pembayaran_transaksi
    FOREIGN KEY (transaksi_id)
    REFERENCES transaksi(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB;

SHOW TABLES;

SHOW CREATE TABLE barang;
SHOW CREATE TABLE transaksi;
SHOW CREATE TABLE transaksi_detail;
SHOW CREATE TABLE pembayaran;

USE modul06;

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Teknologi', '081234567801', 'Surabaya'),
('CV Mitra Komputer', '081234567802', 'Sidoarjo'),
('PT Digital Nusantara', '081234567803', 'Malang'),
('CV Berkah Elektronik', '081234567804', 'Gresik'),
('PT Global Hardware', '081234567805', 'Mojokerto');

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Andi Saputra', 'L', '081234560001', 'Surabaya'),
('PLG002', 'Siti Rahma', 'P', '081234560002', 'Sidoarjo'),
('PLG003', 'Budi Santoso', 'L', '081234560003', 'Malang'),
('PLG004', 'Dewi Anggraini', 'P', '081234560004', 'Gresik'),
('PLG005', 'Rizky Pratama', 'L', '081234560005', 'Mojokerto');

INSERT INTO `user`
(username, password, nama, alamat, hp, level) VALUES
('admin', 'admin123', 'Administrator', 'Surabaya', '081111111111', 1),
('kasir01', 'kasir123', 'Rina Putri', 'Sidoarjo', '082222222222', 2),
('kasir02', 'kasir456', 'Doni Saputra', 'Malang', '083333333333', 2);

INSERT INTO barang
(kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Mouse Logitech', 15000, 50, 1),
('BRG002', 'Keyboard Mechanical', 25000, 30, 2),
('BRG003', 'Flashdisk 32GB', 45000, 40, 3),
('BRG004', 'Mousepad', 12000, 60, 4),
('BRG005', 'Kabel USB', 8000, 100, 5),
('BRG006', 'Headset Gaming', 75000, 20, 1),
('BRG007', 'Webcam HD', 18000, 25, 2),
('BRG008', 'Speaker Mini', 30000, 35, 3),
('BRG009', 'Cooling Pad', 55000, 15, 4),
('BRG010', 'Kabel HDMI', 20000, 45, 5);

INSERT INTO transaksi
(waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Pembelian perlengkapan komputer', 55000, 'PLG001'),
('2026-10-02', 'Pembelian flashdisk', 45000, 'PLG002'),
('2026-10-03', 'Pembelian aksesoris komputer', 32000, 'PLG003'),
('2026-10-04', 'Pembelian headset', 75000, 'PLG004'),
('2026-10-05', 'Pembelian perlengkapan gaming', 66000, 'PLG005'),
('2026-10-06', 'Pembelian cooling pad', 55000, 'PLG001'),
('2026-10-07', 'Pembelian kabel HDMI', 40000, 'PLG002'),
('2026-10-08', 'Pembelian beberapa aksesoris', 105000, 'PLG003'),
('2026-10-09', 'Pembelian keyboard', 50000, 'PLG004'),
('2026-10-10', 'Pembelian aksesoris komputer', 87000, 'PLG005');

INSERT INTO transaksi_detail
(transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 15000, 2),
(1, 2, 25000, 1),

(2, 3, 45000, 1),

(3, 4, 12000, 2),
(3, 5, 8000, 1),

(4, 6, 75000, 1),

(5, 7, 18000, 2),
(5, 8, 30000, 1),

(6, 9, 55000, 1),

(7, 10, 20000, 2),

(8, 1, 15000, 1),
(8, 3, 45000, 2),

(9, 2, 25000, 2),

(10, 4, 12000, 1),
(10, 6, 75000, 1);

INSERT INTO pembayaran
(waktu_bayar, total, metode, transaksi_id) VALUES
('2026-10-01 09:00:00', 55000, 'TUNAI', 1),
('2026-10-02 10:00:00', 45000, 'TRANSFER', 2),
('2026-10-03 11:00:00', 32000, 'TUNAI', 3),
('2026-10-04 12:00:00', 75000, 'EDC', 4),
('2026-10-05 13:00:00', 66000, 'TRANSFER', 5),
('2026-10-06 14:00:00', 55000, 'TUNAI', 6),
('2026-10-07 15:00:00', 40000, 'EDC', 7),
('2026-10-08 16:00:00', 105000, 'TRANSFER', 8),
('2026-10-09 17:00:00', 50000, 'TUNAI', 9),
('2026-10-10 18:00:00', 87000, 'TRANSFER', 10);
