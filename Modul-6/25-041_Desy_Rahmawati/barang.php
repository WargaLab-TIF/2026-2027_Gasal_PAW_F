
<?php
include 'koneksi.php';

$query = "SELECT barang.*, supplier.nama AS nama_supplier
          FROM barang
          LEFT JOIN supplier ON barang.supplier_id = supplier.id
          ORDER BY barang.id ASC";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Data Master Barang</h2>
    <p>Daftar barang dan supplier</p>

    <div class="menu">
        <a href="index.php" class="btn btn-gray">Kembali</a>
    </div>

    <div class="section">

        <div class="section-title">Daftar Data Barang</div>

        <?php if (isset($_GET['status'])): ?>

            <?php if ($_GET['status'] == 'gagal_terpakai'): ?>
                <div class="alert alert-error">
                    Barang tidak dapat dihapus karena masih digunakan dalam transaksi.
                </div>

            <?php elseif ($_GET['status'] == 'sukses_hapus'): ?>
                <div class="alert alert-success">
                    Data barang berhasil dihapus.
                </div>

            <?php elseif ($_GET['status'] == 'gagal_error'): ?>
                <div class="alert alert-error">
                    Terjadi kesalahan saat menghapus barang.
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (mysqli_num_rows($result) > 0): ?>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <tr>
                            <td><?= $row['id']; ?></td>

                            <td><?= htmlspecialchars($row['kode_barang']); ?></td>

                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>

                            <td>
                                Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                            </td>

                            <td><?= $row['stok']; ?></td>

                            <td>
                                <?= htmlspecialchars($row['nama_supplier'] ?? '-'); ?>
                            </td>

                            <td>
                                <a href="hapus.php?id=<?= $row['id']; ?>"
                                   class="btn btn-red"
                                   onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="7" class="text-center">
                                Belum ada data barang.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>
