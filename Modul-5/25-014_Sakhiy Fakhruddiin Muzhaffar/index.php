<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
    <!-- Menghubungkan ke file CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Master Supplier</h2>
    
    <a href="tambah.php" class="btn btn-hijau">Tambah Data</a>
    
    <table class="tabel-data">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM supplier");
        
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-oranye">Edit</a>
                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-merah" onclick="return confirm('Anda yakin akan menghapus supplier ini?');">Hapus</a>
            </td>
        </tr>
        <?php 
            $no++; 
        } 
        ?>
    </table>
</body>
</html>