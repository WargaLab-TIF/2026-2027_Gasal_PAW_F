
<?php
include 'koneksi.php';

$query_transaksi = "
    SELECT transaksi.*, pelanggan.nama nama_pelanggan
    FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY transaksi.id ASC
";

$result_transaksi = mysqli_query($koneksi, $query_transaksi);

$id_transaksi = 0;
$result_detail = null;

if (isset($_GET['id'])) {
    $id_transaksi = (int) $_GET['id'];

    $query_detail = "
        SELECT transaksi_detail.*, barang.kode_barang,
               barang.nama_barang
        FROM transaksi_detail
        JOIN barang ON transaksi_detail.barang_id = barang.id
        WHERE transaksi_detail.transaksi_id = ?
    ";

    $stmt = mysqli_prepare($koneksi, $query_detail);
    mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
    mysqli_stmt_execute($stmt);
    $result_detail = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Data Transaksi</h2>

    <div class="tambah">
        <a href="barang.php">Data Barang</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Waktu Transaksi</th>
            <th>Keterangan</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $no = 1;

        while ($row = mysqli_fetch_assoc($result_transaksi)):
        ?>

        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['waktu_transaksi']) ?></td>
            <td><?= htmlspecialchars($row['keterangan']) ?></td>
            <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
            <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
            <td>
                <a class="edit"
                   href="transaksi.php?id=<?= $row['id'] ?>">
                   Lihat Detail
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

    <?php if ($id_transaksi > 0): ?>

        <h2>Detail Transaksi #<?= $id_transaksi ?></h2>

        <div class="tambah">
            <a href="tambah_detail.php?transaksi_id=<?= $id_transaksi ?>">
                Tambah Detail
            </a>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>

            <?php
            $no_detail = 1;
            $grand_total = 0;

            if ($result_detail && mysqli_num_rows($result_detail) > 0):
                while ($detail = mysqli_fetch_assoc($result_detail)):
                    $subtotal = $detail['harga'] * $detail['qty'];
                    $grand_total += $subtotal;
            ?>

            <tr>
                <td><?= $no_detail++ ?></td>
                <td><?= htmlspecialchars($detail['kode_barang']) ?></td>
                <td><?= htmlspecialchars($detail['nama_barang']) ?></td>
                <td>Rp <?= number_format($detail['harga'], 0, ',', '.') ?></td>
                <td><?= $detail['qty'] ?></td>
                <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>

            <?php
                endwhile;
            else:
            ?>

            <tr>
                <td colspan="6">Belum ada detail transaksi.</td>
            </tr>

            <?php endif; ?>

        </table>

        <p><strong>Total Detail: Rp <?= number_format($grand_total, 0, ',', '.') ?></strong></p>

    <?php endif; ?>

</div>

</body>
</html>
