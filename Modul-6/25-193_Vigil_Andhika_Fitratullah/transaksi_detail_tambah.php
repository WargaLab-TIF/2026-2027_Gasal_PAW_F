<?php
require "koneksi.php";

$transaksi_id = (int) ($_POST['transaksi_id'] ?? 0);
$barang_id    = (int) ($_POST['barang_id'] ?? 0);
$qty          = (int) ($_POST['qty'] ?? 0);

$q = mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang_id");
$barang = mysqli_fetch_assoc($q);

if ($qty < 1 || !$barang) {
  echo "<script>alert('Data tidak valid'); window.location='transaksi.php?id=$transaksi_id';</script>";
  exit;
}
$harga = $barang['harga'];

$cek = mysqli_query($conn, "SELECT * FROM transaksi_detail
WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id");
if (mysqli_num_rows($cek) > 0) {
  echo "<script>alert('Barang sudah ada di transaksi ini'); window.location='transaksi.php?id=$transaksi_id';</script>";
  exit;
}

mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
VALUES ($transaksi_id, $barang_id, $harga, $qty)");

$q = mysqli_query($conn, "SELECT SUM(harga * qty) AS total FROM transaksi_detail WHERE transaksi_id = $transaksi_id");
$row = mysqli_fetch_assoc($q);
$total = $row['total'];

mysqli_query($conn, "UPDATE transaksi SET total = $total WHERE id = $transaksi_id");
echo "<script>alert('Detail berhasil disimpan, total transaksi diperbarui'); window.location='transaksi.php?id=$transaksi_id';</script>";
