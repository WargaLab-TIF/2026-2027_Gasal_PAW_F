<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 40px;
            color: #333;
        }
        h3.title {
            color: #7f8c8d;
            font-weight: normal;
            margin-bottom: 5px;
        }
        .btn-tambah {
            background-color: #2ecc71;
            color: white;
            padding: 6px 14px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            float: right;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .btn-tambah:hover {
            background-color: #27ae60;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            clear: both;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #bdc3c7;
            padding: 10px 12px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #ecf0f1;
            color: #2c3e50;
        }
        .btn-edit {
            background-color: #f39c12;
            color: white;
            padding: 4px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 13px;
        }
        .btn-edit:hover {
            background-color: #d68910;
        }
        .btn-hapus {
            background-color: #e74c3c;
            color: white;
            padding: 4px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 13px;
        }
        .btn-hapus:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <h3 class="title">Data Master Supplier</h3>
    
    <!-- Tombol Tambah Data -->
    <a href="tambah_supplier.php" class="btn-tambah">+ Tambah Data</a>

    <table>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 25%;">Nama</th>
            <th style="width: 20%;">Telp</th>
            <th style="width: 35%;">Alamat</th>
            <th style="width: 15%; text-align: center;">Tindakan</th>
        </tr>
        <?php
        $no = 1;
        $result = mysqli_query($koneksi, "SELECT * FROM supplier");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['telp'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td style='text-align: center;'>
                    <a href='edit_supplier.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a> 
                    <a href='hapus_supplier.php?id=" . $row['id'] . "' class='btn-hapus' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>