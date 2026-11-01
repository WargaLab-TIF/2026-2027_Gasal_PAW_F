<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM supplier WHERE id = '$id'");

if ($query) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='index.php';</script>";
}
?>