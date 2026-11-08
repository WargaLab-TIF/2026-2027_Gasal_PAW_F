

-- ===== SOAL 1 : MEMBUAT DATABASE =====
CREATE DATABASE IF NOT EXISTS penjualan
  DEFAULT CHARACTER SET utf8mb4;
USE penjualan;

DROP TABLE IF EXISTS pembayaran;
DROP TABLE IF EXISTS transaksi_detail;
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS pelanggan;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS user;

-- ===== SOAL 1 : STRUKTUR TABEL & RELASI (FOREIGN KEY) =====
CREATE TABLE supplier (
  id     INT          NOT NULL AUTO_INCREMENT,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12)  NOT NULL,
  alamat TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE barang (
  id          INT          NOT NULL AUTO_INCREMENT,
  kode_barang VARCHAR(10)  NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT          NOT NULL,
  stok        INT          NOT NULL DEFAULT 0,
  supplier_id INT          NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_kode_barang (kode_barang),
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id)
    REFERENCES supplier (id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pelanggan (
  id            VARCHAR(20)  NOT NULL,
  nama          VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12)  NOT NULL,
  alamat        TEXT         NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE transaksi (
  id              INT         NOT NULL AUTO_INCREMENT,
  waktu_transaksi DATE        NOT NULL,
  keterangan      TEXT,
  total           INT         NOT NULL DEFAULT 0,
  pelanggan_id    VARCHAR(20) NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id)
    REFERENCES pelanggan (id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE transaksi_detail (
  transaksi_id INT NOT NULL,
  barang_id    INT NOT NULL,
  harga        INT NOT NULL,
  qty          INT NOT NULL,
  -- SOAL 2 : PK gabungan -> 1 barang hanya 1 baris per transaksi
  PRIMARY KEY (transaksi_id, barang_id),
  KEY idx_detail_barang (barang_id),
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi (id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  -- SOAL 3 : RESTRICT -> barang yang dipakai tidak bisa dihapus
  CONSTRAINT fk_detail_barang FOREIGN KEY (barang_id)
    REFERENCES barang (id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE pembayaran (
  id           INT      NOT NULL AUTO_INCREMENT,
  waktu_bayar  DATETIME NOT NULL,
  total        INT      NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT      NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT fk_pembayaran_transaksi FOREIGN KEY (transaksi_id)
    REFERENCES transaksi (id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE user (
  id_user  TINYINT     NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(35) NOT NULL,
  nama     VARCHAR(50) NOT NULL,
  alamat   VARCHAR(150) NOT NULL,
  hp       VARCHAR(20) NOT NULL,
  level    TINYINT(1)  NOT NULL,
  PRIMARY KEY (id_user),
  UNIQUE KEY uk_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ===== SOAL 1 : DATA MASTER (minimal 5 data) =====
INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Makmur', '031555101', 'Jl. Rungkut Industri 12, Surabaya'),
('CV Jaya Abadi',       '031555102', 'Jl. Tunjungan 45, Surabaya'),
('PT Mitra Sejahtera',  '031555103', 'Jl. Ahmad Yani 88, Sidoarjo'),
('UD Berkah Tani', '031555104', 'Jl. Raya Bangkalan 21, Bangkalan'),
('PT Nusantara Pangan', '031555105', 'Jl. Gubeng 7, Surabaya');

INSERT INTO barang
  (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras Premium 5 Kg',     68000,  50, 1),
('BRG002', 'Minyak Goreng 2 L',      38000,  80, 5),
('BRG003', 'Gula Pasir 1 Kg',        17000, 100, 5),
('BRG004', 'Telur Ayam 1 Kg',        30000,  60, 4),
('BRG005', 'Kopi Bubuk 200 g',       15000,  70, 2),
('BRG006', 'Teh Celup 25 pcs',        8000, 120, 2),
('BRG007', 'Mi Instan Goreng',        3500, 300, 3),
('BRG008', 'Sabun Mandi Cair 450 ml',22000,  40, 3);

INSERT INTO pelanggan
  (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001','Budi Santoso','L','081234567801','Jl. Mawar 1, Surabaya'),
('PLG002','Siti Aminah','P','081234567802','Jl. Melati 5, Sidoarjo'),
('PLG003','Ahmad Fauzi','L','081234567803','Jl. Kenanga 9, Bangkalan'),
('PLG004','Dewi Lestari','P','081234567804','Jl. Anggrek 3, Gresik'),
('PLG005','Rizky Pratama','L','081234567805','Jl. Dahlia 14, Sby');

INSERT INTO user
  (username, password, nama, alamat, hp, level) VALUES
('admin', MD5('admin123'), 'Administrator',
 'Jl. Raya Telang, Bangkalan', '081300000001', 1),
('kasir1', MD5('kasir123'), 'Kasir Satu',
 'Jl. Kamal No. 2, Bangkalan', '081300000002', 2),
('kasir2', MD5('kasir123'), 'Kasir Dua',
 'Jl. Arosbaya No. 3, Bangkalan', '081300000003', 2),
('gudang', MD5('gudang123'), 'Staf Gudang',
 'Jl. Burneh No. 4, Bangkalan', '081300000004', 3),
('owner', MD5('owner123'), 'Pemilik Toko',
 'Jl. Merdeka No. 5, Surabaya', '081300000005', 1);

-- ===== SOAL 1 : DATA TRANSAKSI (minimal 10 data) =====
-- total diisi 0 dulu, dihitung dari detail setelah detail diinput
INSERT INTO transaksi
  (waktu_transaksi, keterangan, total, pelanggan_id) VALUES
('2026-10-01', 'Belanja bulanan',    0, 'PLG001'),
('2026-10-03', 'Belanja dapur',      0, 'PLG002'),
('2026-10-05', 'Pembelian grosir',   0, 'PLG003'),
('2026-10-08', 'Belanja mingguan',   0, 'PLG004'),
('2026-10-12', 'Kebutuhan warung',   0, 'PLG005'),
('2026-10-15', 'Belanja tambahan',   0, 'PLG001'),
('2026-10-20', 'Pembelian rutin',    0, 'PLG002'),
('2026-10-25', 'Stok toko',          0, 'PLG003'),
('2026-11-02', 'Belanja akhir pekan',0, 'PLG004'),
('2026-11-05', 'Belanja bulanan',    0, 'PLG005');

INSERT INTO transaksi_detail
  (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 68000,  1), (1, 2, 38000,  2), (1, 3, 17000,  2),
(2, 2, 38000,  1), (2, 4, 30000,  2),
(3, 1, 68000,  5), (3, 3, 17000, 10), (3, 5, 15000,  6),
(4, 4, 30000,  1), (4, 5, 15000,  2), (4, 6,  8000,  3),
(5, 3, 17000,  4), (5, 6,  8000, 10),
(6, 2, 38000,  2), (6, 5, 15000,  1),
(7, 1, 68000,  2), (7, 4, 30000,  3), (7, 6,  8000,  2),
(8, 2, 38000,  6), (8, 3, 17000,  6),
(9, 5, 15000,  3), (9, 6,  8000,  5),
(10,1, 68000,  3), (10,2, 38000,  1), (10,4, 30000,  2);

-- ===== SOAL 4 : hitung total tiap transaksi dari detailnya =====
UPDATE transaksi t
SET t.total = (SELECT COALESCE(SUM(d.harga * d.qty), 0)
               FROM transaksi_detail d
               WHERE d.transaksi_id = t.id);

-- ===== SOAL 1 : DATA PEMBAYARAN (1 pembayaran per transaksi) =====
INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id)
SELECT CONCAT(t.waktu_transaksi, ' 10:30:00'), t.total,
       ELT(MOD(t.id, 3) + 1, 'TUNAI', 'TRANSFER', 'EDC'), t.id
FROM transaksi t;
