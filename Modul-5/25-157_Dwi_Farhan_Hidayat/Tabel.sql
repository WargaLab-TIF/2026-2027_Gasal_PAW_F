CREATE TABLE pelanggan (
  id varchar(20) NOT NULL PRIMARY KEY,
  nama varchar(100) NOT NULL,
  jenis_kelamin ENUM('L', 'P') NOT NULL,
  telp varchar(12) NOT NULL,
  alamat text NOT NULL
);

CREATE TABLE supplier (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  telp VARCHAR(12) NOT NULL,
  alamat TEXT NOT NULL
);

CREATE TABLE barang (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  kode_barang VARCHAR(10) NOT NULL,
  nama_barang VARCHAR(100) NOT NULL,
  harga INT(11) NOT NULL,
  stok INT(11) NOT NULL,
  supplier_id INT(11) NOT NULL,
  FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE transaksi (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  waktu_transaksi DATE NOT NULL,
  keterangan TEXT NOT NULL,
  total INT(11) NOT NULL,
  pelanggan_id VARCHAR(20) NOT NULL,
  FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
  transaksi_id INT(11) NOT NULL,
  barang_id INT(11) NOT NULL,
  harga INT(11) NOT NULL,
  qty INT(11) NOT NULL,
  PRIMARY KEY (transaksi_id, barang_id),
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
  FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE pembayaran (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  waktu_bayar DATETIME NOT NULL,
  total INT(11) NOT NULL,
  metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
  transaksi_id INT(11) NOT NULL,
  FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);

CREATE TABLE user (
  id_user TINYINT(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(35) NOT NULL,
  nama VARCHAR(50) NOT NULL,
  alamat VARCHAR(150) NOT NULL,
  hp VARCHAR(20) NOT NULL,
  level TINYINT(1) NOT NULL
);






INSERT INTO supplier (nama, telp, alamat) VALUES 
('PT Maju Bersama', '08123456', 'Surabaya'),
('PT. Senang Sekali', '081515563', 'Bangkalan'),
('PT Segar Segar', '0845454663', 'Surabaya'),
('PT Jaya Abadi', '0811223344', 'Jakarta'),
('PT Berkah Selalu', '0822334455', 'Malang'),
('PT Suka Makmur', '0833445566', 'Sidoarjo'),
('PT Harapan Kita', '0844556677', 'Bandung'),
('PT Sumber Rejeki', '0855667788', 'Semarang'),
('PT Mitra Sejati', '0866778899', 'Yogyakarta'),
('PT Makmur Jaya', '0877889900', 'Denpasar');