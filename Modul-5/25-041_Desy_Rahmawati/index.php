<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #fff;
    color: #333;
    margin: 30px;
}

.container {
    width: 800px;
    margin: 0 auto;
}

h2 {
    color: #337ab7;
    font-size: 24px;
    font-weight: normal;
    margin-bottom: 20px;
}

.header {
    display: flex;
    justify-content: flex-end;
    padding-bottom: 15px;
    margin-bottom: 10px;
}

/* Tombol */
.btn {
    display: inline-block;
    padding: 8px 15px;
    font-size: 14px;
    color: #fff;
    text-decoration: none;
    border-radius: 3px;
    border: 1px solid transparent;
    cursor: pointer;
}

.btn-tambah {
    background-color: #5cb85c;
    border-color: #4cae4c;
}

.btn-edit {
    background-color: #f0ad4e;
    border-color: #eea236;
}

.btn-hapus {
    background-color: #d9534f;
    border-color: #d43f3a;
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #d9edf7;
    color: #333;
    font-weight: bold;
}

/* Helper Class */
.text-center {
    text-align: center;
}

.tindakan {
    text-align: right;
    white-space: nowrap;
}
</style>
</head>
<body>

<div class="container">
    <h2>Data Master Supplier</h2>
    
    <div class="header">
        <a href="tambah.php" class="btn btn-tambah">Tambah Data</a>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th width="20%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM supplier");
            while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= htmlspecialchars($data['nama']); ?></td>
                <td><?= htmlspecialchars($data['telp']); ?></td>
                <td><?= htmlspecialchars($data['alamat']); ?></td>
                <td class="tindakan">
                    <a href="update.php?id=<?= $data['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $data['id']; ?>" class="btn btn-hapus" onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>