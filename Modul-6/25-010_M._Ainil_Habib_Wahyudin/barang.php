<?php
include 'koneksi.php';
$pesan = '';

if (isset($_POST['hapus'])) {
    $id = (int)$_POST['hapus'];

    // cek apakah barang sudah dipakai di transaksi_detail
    $c = mysqli_prepare($db, "SELECT COUNT(*) FROM transaksi_detail WHERE barang_id=?");
    mysqli_stmt_bind_param($c, 'i', $id);
    mysqli_stmt_execute($c);
    $dipakai = mysqli_fetch_row(mysqli_stmt_get_result($c))[0];

    if ($dipakai > 0) {
        $pesan = "Barang tidak bisa dihapus karena masih digunakan pada $dipakai transaksi.";
    } else {
        $d = mysqli_prepare($db, "DELETE FROM barang WHERE id=?");
        mysqli_stmt_bind_param($d, 'i', $id);
        mysqli_stmt_execute($d);
        $pesan = 'Barang berhasil dihapus.';
    }
}
$r = mysqli_query($db, "SELECT * FROM barang ORDER BY id");
?>
<h2>Data Barang</h2>
<?php if ($pesan): ?><script>alert(<?= json_encode($pesan) ?>);</script><p><b><?= htmlspecialchars($pesan) ?></b></p><?php endif; ?>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Nama</th><th>Harga</th><th>Aksi</th></tr>
<?php while ($b = mysqli_fetch_assoc($r)): ?>
<tr>
  <td><?= $b['id'] ?></td>
  <td><?= htmlspecialchars($b['nama_barang']) ?></td>
  <td align="right"><?= number_format($b['harga'], 0, ',', '.') ?></td>
  <td>
    <form method="post" onsubmit="return confirm('Hapus barang ini?')">
      <button name="hapus" value="<?= $b['id'] ?>">Hapus</button>
    </form>
  </td>
</tr>
<?php endwhile; ?>
</table>
<p><a href="transaksi.php">Transaksi</a></p>