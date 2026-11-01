<?php
include 'koneksi.php';
$id = (int)$_GET['id'];

$ok = mysqli_query($conn, "DELETE FROM supplier WHERE id=$id");
if (!$ok) {
    echo "<script>alert('Supplier tidak bisa dihapus karena masih dipakai oleh data barang.');
          window.location='supplier.php';</script>";
    exit;
}
header("Location: supplier.php");
exit;