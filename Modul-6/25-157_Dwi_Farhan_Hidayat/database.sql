CREATE TABLE supplier (
  id     INT AUTO_INCREMENT PRIMARY KEY,
  nama   VARCHAR(100) NOT NULL,
  telp   VARCHAR(12),
  alamat TEXT
) ENGINE=InnoDB;

CREATE TABLE barang (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10) NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga       INT NOT NULL,
  stok        INT NOT NULL DEFAULT 0,
  supplier_id INT NOT NULL,
  CONSTRAINT fk_barang_supplier FOREIGN KEY (supplier_id) REFERENCES supplier(id)
) ENGINE=InnoDB;

CREATE TABLE pelanggan (
  id            VARCHAR(20) PRIMARY KEY,
  nama          VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  telp          VARCHAR(12),
  alamat        TEXT
) ENGINE=InnoDB;

CREATE TABLE transaksi (
  id               INT AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi  DATE NOT NULL,
  keterangan       TEXT,
  total            INT NOT NULL DEFAULT 0,
  pelanggan_id     VARCHAR(20) NOT NULL,
  CONSTRAINT fk_transaksi_pelanggan FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
) ENGINE=InnoDB;

CREATE TABLE transaksi_detail (
  transaksi_id INT NOT NULL,
  barang_id    INT NOT NULL,
  harga        INT NOT NULL,
  qty          INT NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),   -- barang yang sama tidak bisa 2x dalam 1 transaksi
  CONSTRAINT fk_detail_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
  CONSTRAINT fk_detail_barang    FOREIGN KEY (barang_id)    REFERENCES barang(id)
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar  DATETIME NOT NULL,
  total        INT NOT NULL,
  metode       ENUM('TUNAI','TRANSFER','EDC') NOT NULL,
  transaksi_id INT NOT NULL,
  CONSTRAINT fk_bayar_transaksi FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
) ENGINE=InnoDB;

CREATE TABLE user (
  id_user  TINYINT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(35) NOT NULL,
  nama     VARCHAR(50),
  alamat   VARCHAR(150),
  hp       VARCHAR(12),
  level    TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO supplier (nama, telp, alamat) VALUES
('PT Sumber Makmur',  '081234567801', 'Jl. Veteran No. 10, Gresik'),
('CV Jaya Abadi',     '081234567802', 'Jl. Raya Driyorejo No. 25, Gresik'),
('UD Berkah Sentosa', '081234567803', 'Jl. Panglima Sudirman No. 8, Gresik'),
('PT Maju Bersama',   '081234567804', 'Jl. Kartini No. 15, Surabaya'),
('CV Cahaya Baru',    '081234567805', 'Jl. Ahmad Yani No. 40, Sidoarjo');

INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES
('BRG001', 'Beras Premium 5kg',  62000, 100, 1),
('BRG002', 'Minyak Goreng 2L',   38000,  80, 2),
('BRG003', 'Gula Pasir 1kg',     17000, 120, 3),
('BRG004', 'Telur Ayam 1kg',     29000,  60, 4),
('BRG005', 'Kopi Bubuk 200g',    21000,  90, 5),
('BRG006', 'Mie Instan 1 Dus',   95000,  50, 1),
('BRG007', 'Teh Celup 25 pcs',   12000,  70, 2);  -- belum dipakai transaksi (untuk uji hapus)

INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES
('PLG001', 'Budi Santoso',   'L', '082111222301', 'Jl. Mawar No. 1, Gresik'),
('PLG002', 'Siti Aminah',    'P', '082111222302', 'Jl. Melati No. 2, Gresik'),
('PLG003', 'Agus Prasetyo',  'L', '082111222303', 'Jl. Kenanga No. 3, Gresik'),
('PLG004', 'Dewi Lestari',   'P', '082111222304', 'Jl. Anggrek No. 4, Gresik'),
('PLG005', 'Rizky Ramadhan', 'L', '082111222305', 'Jl. Dahlia No. 5, Gresik');

INSERT INTO user (username, password, nama, alamat, hp, level) VALUES
('admin',  MD5('admin123'),  'Administrator', 'Gresik',   '085100000001', 1),
('kasir1', MD5('kasir123'),  'Kasir Satu',    'Gresik',   '085100000002', 2),
('kasir2', MD5('kasir123'),  'Kasir Dua',     'Surabaya', '085100000003', 2),
('gudang', MD5('gudang123'), 'Staf Gudang',   'Sidoarjo', '085100000004', 3),
('owner',  MD5('owner123'),  'Pemilik Toko',  'Gresik',   '085100000005', 1);

INSERT INTO transaksi (id, waktu_transaksi, keterangan, total, pelanggan_id) VALUES
(1,  '2026-11-01', 'Belanja bulanan',        175000, 'PLG001'),
(2,  '2026-11-01', 'Belanja harian',          80000, 'PLG002'),
(3,  '2026-11-02', 'Pesanan telur',           58000, 'PLG003'),
(4,  '2026-11-02', 'Stok warung',            157000, 'PLG004'),
(5,  '2026-11-03', 'Pesanan gula',            85000, 'PLG005'),
(6,  '2026-11-04', 'Belanja mingguan',       105000, 'PLG001'),
(7,  '2026-11-04', 'Pesanan kopi',            63000, 'PLG002'),
(8,  '2026-11-05', 'Stok toko',              281000, 'PLG003'),
(9,  '2026-11-06', 'Belanja dapur',           93000, 'PLG004'),
(10, '2026-11-07', 'Belanja akhir pekan',    149000, 'PLG005');

INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES
(1, 1, 62000, 2), (1, 3, 17000, 3),
(2, 2, 38000, 1), (2, 5, 21000, 2),
(3, 4, 29000, 2),
(4, 6, 95000, 1), (4, 1, 62000, 1),
(5, 3, 17000, 5),
(6, 2, 38000, 2), (6, 4, 29000, 1),
(7, 5, 21000, 3),
(8, 1, 62000, 3), (8, 6, 95000, 1),
(9, 2, 38000, 1), (9, 3, 17000, 2), (9, 5, 21000, 1),
(10, 4, 29000, 3), (10, 1, 62000, 1);

INSERT INTO pembayaran (waktu_bayar, total, metode, transaksi_id) VALUES
('2026-11-01 10:15:00', 175000, 'TUNAI',    1),
('2026-11-01 14:30:00',  80000, 'TRANSFER', 2),
('2026-11-02 09:45:00',  58000, 'TUNAI',    3),
('2026-11-02 16:20:00', 157000, 'EDC',      4),
('2026-11-03 11:00:00',  85000, 'TUNAI',    5),
('2026-11-04 08:50:00', 105000, 'TRANSFER', 6),
('2026-11-04 13:10:00',  63000, 'TUNAI',    7),
('2026-11-05 15:25:00', 281000, 'EDC',      8),
('2026-11-06 10:05:00',  93000, 'TRANSFER', 9),
('2026-11-07 17:40:00', 149000, 'TUNAI',   10);