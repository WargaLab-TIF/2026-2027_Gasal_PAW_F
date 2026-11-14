<?php

$daftar_tabel = array(
    "pelanggan" => array(
        "judul" => "Data Pelanggan",
        "kelompok" => "Data Master",
        "primary" => array("id"),
        "kolom" => array("id", "nama", "jenis_kelamin", "telp", "alamat"),
        "field" => array(
            array("nama" => "id", "label" => "ID Pelanggan", "tipe" => "text"),
            array("nama" => "nama", "label" => "Nama", "tipe" => "text"),
            array("nama" => "jenis_kelamin", "label" => "Jenis Kelamin", "tipe" => "gender"),
            array("nama" => "telp", "label" => "Telepon", "tipe" => "text"),
            array("nama" => "alamat", "label" => "Alamat", "tipe" => "textarea")
        )
    ),
    "supplier" => array(
        "judul" => "Data Supplier",
        "kelompok" => "Data Master",
        "primary" => array("id"),
        "kolom" => array("id", "nama", "telp", "alamat"),
        "field" => array(
            array("nama" => "nama", "label" => "Nama Supplier", "tipe" => "text"),
            array("nama" => "telp", "label" => "Telepon", "tipe" => "text"),
            array("nama" => "alamat", "label" => "Alamat", "tipe" => "textarea")
        )
    ),
    "user" => array(
        "judul" => "Data User",
        "kelompok" => "Data Master",
        "primary" => array("id_user"),
        "kolom" => array("id_user", "username", "password", "nama", "alamat", "hp", "level"),
        "field" => array(
            array("nama" => "username", "label" => "Username", "tipe" => "text"),
            array("nama" => "password", "label" => "Password", "tipe" => "text"),
            array("nama" => "nama", "label" => "Nama", "tipe" => "text"),
            array("nama" => "alamat", "label" => "Alamat", "tipe" => "textarea"),
            array("nama" => "hp", "label" => "Nomor HP", "tipe" => "text"),
            array("nama" => "level", "label" => "Level", "tipe" => "number")
        )
    ),
    "barang" => array(
        "judul" => "Data Barang",
        "kelompok" => "Data Master",
        "primary" => array("id"),
        "kolom" => array("id", "kode_barang", "nama_barang", "harga", "stok", "supplier_id"),
        "field" => array(
            array("nama" => "kode_barang", "label" => "Kode Barang", "tipe" => "text"),
            array("nama" => "nama_barang", "label" => "Nama Barang", "tipe" => "text"),
            array("nama" => "harga", "label" => "Harga", "tipe" => "number"),
            array("nama" => "stok", "label" => "Stok", "tipe" => "number"),
            array("nama" => "supplier_id", "label" => "Supplier", "tipe" => "supplier")
        )
    ),
    "transaksi" => array(
        "judul" => "Data Transaksi",
        "kelompok" => "Data Transaksi",
        "primary" => array("id"),
        "kolom" => array("id", "waktu_transaksi", "keterangan", "total", "pelanggan_id"),
        "field" => array(
            array("nama" => "waktu_transaksi", "label" => "Waktu Transaksi", "tipe" => "date"),
            array("nama" => "keterangan", "label" => "Keterangan", "tipe" => "textarea"),
            array("nama" => "total", "label" => "Total", "tipe" => "number"),
            array("nama" => "pelanggan_id", "label" => "Pelanggan", "tipe" => "pelanggan")
        )
    ),
    "transaksi_detail" => array(
        "judul" => "Detail Transaksi",
        "kelompok" => "Data Transaksi",
        "primary" => array("transaksi_id", "barang_id"),
        "kolom" => array("transaksi_id", "barang_id", "harga", "qty"),
        "field" => array(
            array("nama" => "transaksi_id", "label" => "ID Transaksi", "tipe" => "transaksi"),
            array("nama" => "barang_id", "label" => "Barang", "tipe" => "barang"),
            array("nama" => "harga", "label" => "Harga", "tipe" => "number"),
            array("nama" => "qty", "label" => "Jumlah", "tipe" => "number")
        )
    ),
    "pembayaran" => array(
        "judul" => "Data Pembayaran",
        "kelompok" => "Data Transaksi",
        "primary" => array("id"),
        "kolom" => array("id", "waktu_bayar", "total", "metode", "transaksi_id"),
        "field" => array(
            array("nama" => "waktu_bayar", "label" => "Waktu Bayar", "tipe" => "datetime-local"),
            array("nama" => "total", "label" => "Total", "tipe" => "number"),
            array("nama" => "metode", "label" => "Metode Pembayaran", "tipe" => "metode"),
            array("nama" => "transaksi_id", "label" => "ID Transaksi", "tipe" => "transaksi")
        )
    )
);
?>
