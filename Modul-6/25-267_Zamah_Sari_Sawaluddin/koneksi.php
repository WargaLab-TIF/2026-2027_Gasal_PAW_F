<?php
$host = 'localhost';
$dbname = 'penjualan';
$username = 'root';
$password = '';

$koneksi = mysqli_connect($host, $username, $password, $dbname);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
?>