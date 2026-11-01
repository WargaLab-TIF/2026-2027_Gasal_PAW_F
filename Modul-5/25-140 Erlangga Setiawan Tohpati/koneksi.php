<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_modul5";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
