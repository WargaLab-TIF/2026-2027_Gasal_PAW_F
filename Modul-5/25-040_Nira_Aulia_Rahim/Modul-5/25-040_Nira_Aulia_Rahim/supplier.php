<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px 20px 20px;
        }
        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .card-header {
            background-color: #2e7d32;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-header h4 {
            margin: 0;
            font-size: 15px;
        }
        .btn-tambah {
            background-color: #ffffff;
            color: #2e7d32;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 10px;
            transition: 0.2s;
        }
        .btn-tambah:hover {
            background-color: #e8f5e9;
        }
        .card-body {
            padding: 15px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 8px 12px;
            font-size: 8px;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f3f5;
        }
        .text-center {
            text-align: center;
        }
        .action-btns {
            display: flex;
            justify-content: center;
            gap: 6px;
        }
        .btn {
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 8px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-warning {
            background-color: #f0ad4e;
        }
        .btn-warning:hover {
            background-color: #ec971f;
        }
        .btn-danger {
            background-color: #d9534f;
        }
        .btn-danger:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card-header">
            <h4>Data Master Supplier</h4>
            <a href="tambahSupplier.php" class="btn-tambah">+ Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>Alamat</th>
                            <th style="width: 15%;" class="text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM supplier");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['telp']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="editSupplier.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="hapusSupplier.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>