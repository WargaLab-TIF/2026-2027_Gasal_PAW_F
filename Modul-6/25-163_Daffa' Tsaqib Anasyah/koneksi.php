<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "penjualan";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil";
?>