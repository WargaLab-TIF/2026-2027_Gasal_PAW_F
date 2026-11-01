<?php
$conn = mysqli_connect("localhost", "root", "", "toko_db");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>