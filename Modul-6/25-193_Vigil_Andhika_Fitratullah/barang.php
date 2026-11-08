<?php
require "koneksi.php";

$result = mysqli_query($conn, "SELECT barang.*, supplier.nama AS nama_supplier FROM barang
JOIN supplier ON supplier.id = barang.supplier_id");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Barang</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Data Barang</h1>
  <p><a href="transaksi.php">Lihat Data Transaksi</a></p>

  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th><th>Kode</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['kode_barang']; ?></td>
        <td><?php echo $row['nama_barang']; ?></td>
        <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
        <td><?php echo $row['stok']; ?></td>
        <td><?php echo $row['nama_supplier']; ?></td>
        <td>
          <a href="barang_hapus.php?id=<?php echo $row['id']; ?>"
             onclick="return confirm('Yakin hapus barang ini?')">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>
