<?php
require "koneksi.php";

$hasil = mysqli_query($koneksi, "select id, nama, telp, alamat from supplier");
$baris = mysqli_fetch_assoc($hasil);
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px 30px;
            background: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-weight: 400;
            font-size: 24px;
            color: #337ab7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th {
            background: #d9edf7;
            text-align: left;
            padding: 12px 10px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }

        tr:hover td {
            background: #f9f9f9;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            font-size: 13px;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            border: 1px solid transparent;
        }

        .btn-tambah { background: #5cb85c; border-color: #4cae4c; }
        .btn-edit   { background: #f0801a; border-color: #d96d0b; }
        .btn-hapus  { background: #d9262c; border-color: #b81c21; }

        .btn:hover { opacity: 0.85; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Data Master Supplier</h2>
        <a href="supplier_tambah.php" class="btn btn-tambah">Tambah Data</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        while ($baris) {
            echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $baris['nama'] . "</td>";
                echo "<td>" . $baris['telp'] . "</td>";
                echo "<td>" . $baris['alamat'] . "</td>";
                echo "<td>";
                    echo "<a href='supplier_edit.php?id=" . $baris['id'] . "' class='btn btn-edit'>Edit</a> ";
                    echo "<a href='supplier_hapus.php?id=" . $baris['id'] . "' class='btn btn-hapus'
                     onclick=\"return confirm('Anda yakin akan menghapus supplier ini?')\">Hapus</a>";
                echo "</td>";
            echo "</tr>";
            $no++;
            $baris = mysqli_fetch_assoc($hasil);
        }
        ?>
    </table>

</body>
</html>