
<?php
require_once "koneksi.php";

$sql = "SELECT * FROM supplier";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>

    <style>
        table, td, th {
            border: 1px solid;
            padding: 10px;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>

    <h3>Data Master Supplier</h3>
    <a href="tambah.php">Tambah Data</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $no = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['telp']) . "</td>";
                echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                echo "<td>";
                echo "<a href='edit.php?id=" . $row['id'] . "'>edit</a> | ";
                echo "<a href='hapus.php?id=" . $row['id'] . "' onclick=\"return confirm('Anda yakin ingin menghapus supplier ini?')\">hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>

    </table>

</body>
</html>
