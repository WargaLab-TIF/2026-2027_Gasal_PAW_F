<?php
$servername = "localhost";
$username = "root";
$password = "";
$database   = "penjualan";

$koneksi = mysqli_connect($servername, $username, $password, $database);
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>