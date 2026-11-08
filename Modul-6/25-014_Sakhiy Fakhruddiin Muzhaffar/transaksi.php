<?php
include "koneksi.php";

$query = "SELECT * FROM transaksi";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Master Transaksi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Daftar Transaksi</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['waktu_transaksi'] . "</td>";
            echo "<td>" . $row['keterangan'] . "</td>";
            echo "<td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>";
            echo "<td><a href='detil.php?id=" . $row['id'] . "'>PILIH / ISI DETAIL</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <form method="get" action="detil.php">
        Masukkan ID Transaksi : <input type="text" name="id">
        <button type="submit">CARI & ISI DETAIL</button>
    </form>

    <br>
    <a href="barang.php">Kelola Data Barang</a>
</body>
</html>
