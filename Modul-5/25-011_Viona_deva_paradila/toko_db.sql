CREATE DATABASE IF NOT EXISTS toko_db;
USE toko_db;

CREATE TABLE pelanggan (
    id INT AUTO_INCREMENT NOT NULL,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE supplier (
    id INT AUTO_INCREMENT NOT NULL,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `user` (
    id_user INT AUTO_INCREMENT NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    hp VARCHAR(20) NOT NULL,
    level VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_user)
);

CREATE TABLE barang (
    id INT AUTO_INCREMENT NOT NULL,
    kode_barang VARCHAR(50) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    supplier_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (supplier_id) REFERENCES supplier(id)
);

CREATE TABLE transaksi (
    id INT AUTO_INCREMENT NOT NULL,
    waktu_transaksi DATETIME NOT NULL,
    keterangan TEXT,
    total INT NOT NULL,
    pelanggan_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id)
);

CREATE TABLE transaksi_detail (
    transaksi_id INT NOT NULL,
    barang_id INT NOT NULL,
    harga INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id),
    FOREIGN KEY (barang_id) REFERENCES barang(id)
);

CREATE TABLE pembayaran (
    id INT AUTO_INCREMENT NOT NULL,
    waktu_bayar DATETIME NOT NULL,
    total INT NOT NULL,
    metode ENUM('Tunai', 'transfer', 'EDC') NOT NULL,
    transaksi_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id)
);