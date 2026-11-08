<?php  ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($judul ?? 'Penjualan') ?> - Aplikasi Penjualan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="nav">
  <strong>Aplikasi Penjualan</strong>
  <a href="index.php">Beranda</a>
  <a href="transaksi.php">Transaksi (Master-Detil)</a>
  <a href="barang.php">Barang</a>
</nav>
<main class="wrap">
<?php tampil_flash(); ?>
