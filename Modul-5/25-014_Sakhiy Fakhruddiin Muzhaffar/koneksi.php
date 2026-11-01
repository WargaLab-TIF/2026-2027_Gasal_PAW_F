<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "penjualan_paw_modul5";
$port = 3308; 

$koneksi = mysqli_connect($host, $user, $pass, $db, $port);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>