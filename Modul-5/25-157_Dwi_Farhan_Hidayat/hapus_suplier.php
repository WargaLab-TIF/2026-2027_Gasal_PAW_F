<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "DELETE FROM supplier WHERE id = '$id'";
if (mysqli_query($koneksi, $query)) {
    header("Location: suplier.php");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>