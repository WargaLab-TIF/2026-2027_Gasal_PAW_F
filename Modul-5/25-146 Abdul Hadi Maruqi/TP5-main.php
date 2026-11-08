<?php require_once __DIR__ .'/TP5-koneksi.php'; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <div class="header">
        <h2>Data Master Supplier</h2>
        <a href="TP5-tambah.php" class="btn btn-hijau">Tambah Data</a>
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
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM supplier");
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="TP5-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-oranye">Edit</a>
                <a href="TP5-hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-merah"
                   onclick="return confirm('Anda yakin akan menghapus supplier ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>