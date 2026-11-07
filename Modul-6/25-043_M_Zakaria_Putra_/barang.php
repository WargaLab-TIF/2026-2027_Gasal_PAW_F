<?php
include 'koneksi.php';

$pesan = "";
$tipe  = "";

if (isset($_POST['hapus'])) {
    $id = (int) $_POST['id'];

    $cek = mysqli_prepare($koneksi,
        "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = ?");
    mysqli_stmt_bind_param($cek, "i", $id);
    mysqli_stmt_execute($cek);
    $hasil = mysqli_fetch_assoc(mysqli_stmt_get_result($cek));

    if ($hasil['jumlah'] > 0) {
        $pesan = "Barang tidak dapat dihapus karena masih digunakan pada "
               . $hasil['jumlah'] . " transaksi.";
        $tipe = "gagal";
    } else {
        $del = mysqli_prepare($koneksi, "DELETE FROM barang WHERE id = ?");
        mysqli_stmt_bind_param($del, "i", $id);
        mysqli_stmt_execute($del);
        $pesan = "Barang berhasil dihapus.";
        $tipe = "sukses";
    }
}

$barang = mysqli_query($koneksi,
    "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS supplier
     FROM barang b
     LEFT JOIN supplier s ON b.supplier_id = s.id
     ORDER BY b.id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Data Barang</h1>
    <p><a href="index.php">&laquo; Ke halaman transaksi</a></p>

    <?php if ($pesan != "") { ?>
        <p class="<?= $tipe ?>"><?= e($pesan) ?></p>
    <?php } ?>

    <table>
        <tr>
            <th>ID</th><th>Kode</th><th>Nama Barang</th>
            <th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th>
        </tr>
        <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
        <tr>
            <td><?= e($b['id']) ?></td>
            <td><?= e($b['kode_barang']) ?></td>
            <td><?= e($b['nama_barang']) ?></td>
            <td class="kanan"><?= number_format($b['harga'], 0, ',', '.') ?></td>
            <td class="kanan"><?= e($b['stok']) ?></td>
            <td><?= e($b['supplier']) ?></td>
            <td>
                <form method="post" onsubmit="return confirm('Yakin hapus barang ini?')">
                    <input type="hidden" name="id" value="<?= e($b['id']) ?>">
                    <button type="submit" name="hapus">Hapus</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>