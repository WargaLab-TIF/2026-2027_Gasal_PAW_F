<?php
include "koneksi.php";

$query = "SELECT * FROM barang";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Master Barang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Data Master Barang</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['kode_barang'] . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
            echo "<td>" . $row['stok'] . "</td>";
            echo "<td><a href='hapus_barang.php?id=" . $row['id'] . "' onclick=\"return confirm('Yakin ingin menghapus barang ini?');\">HAPUS</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <a href="transaksi.php">Ke Halaman Transaksi</a>
</body>
</html>
