<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan2");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

function e($teks) {
    return htmlspecialchars((string) $teks);
}
?>