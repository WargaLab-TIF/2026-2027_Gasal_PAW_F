<?php
include "koneksi.php";

// Cek apakah ID barang ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID barang tidak ditemukan. <a href='barang.php'>Kembali</a>";
    exit;
}

$id_barang = $_GET['id'];

// Cek apakah barang sudah dipakai di transaksi_detail
$cek = "SELECT * FROM transaksi_detail WHERE barang_id = '$id_barang'";
$hasil_cek = mysqli_query($koneksi, $cek);

if(mysqli_num_rows($hasil_cek) > 0){
    echo "<b>GAGAL MENGHAPUS!</b><br>";
    echo "Barang masih digunakan pada transaksi, sehingga tidak boleh dihapus.";
} else {
    mysqli_query($koneksi, "DELETE FROM barang WHERE id = '$id_barang'");
    echo "<b>SUKSES!</b> Barang berhasil dihapus.";
}

echo "<br><br><a href='barang.php'>Kembali ke Data Barang</a>";
?>
