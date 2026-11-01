<?php
include 'koneksi.php';
$sql = "CREATE TABLE 'user' (
          id_user TINYINT(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          username VARCHAR(30) NOT NULL,
          password VARCHAR(35) NOT NULL,
          nama VARCHAR(50) NOT NULL,
          alamat VARCHAR(150) NOT NULL,
          hp VARCHAR(20) NOT NULL,
          level TINYINT(1) NOT NULL
        )";
if (mysqli_query($koneksi, $sql)) {
    echo "Tabel berhasil dibuat di phpMyAdmin";
} else {
    echo "Gagal membuat tabel: " . mysqli_error($koneksi);
}
?>