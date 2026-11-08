<?php
require_once __DIR__.'/TP6-koneksi.php';

$pesan = '';
$jenis = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus_id'])) {
    $hapus_id = (int)$_POST['hapus_id'];
    $stmt = mysqli_prepare($conn,
      "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $hapus_id);
    mysqli_stmt_execute($stmt);
    $jumlah = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['jumlah'];

    if ($jumlah > 0) {
    
        $pesan = "Barang tidak bisa dihapus karena masih digunakan pada $jumlah transaksi.";
        $jenis = 'error';
    } else {
     
        $stmt = mysqli_prepare($conn, "DELETE FROM barang WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $hapus_id);
        mysqli_stmt_execute($stmt);
        $pesan = "Barang berhasil dihapus.";
        $jenis = 'sukses';
    }
}

$data = mysqli_query($conn,
  "SELECT b.*, s.nama AS supplier
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
  <p><a href="transaksi.php">Ke Transaksi</a></p>

  <?php if ($pesan) { ?>
    <div class="<?= $jenis ?>"><?= e($pesan) ?></div>
  <?php } ?>

  <table>
    <tr>
      <th>ID</th><th>Kode</th><th>Nama</th><th>Harga</th>
      <th>Stok</th><th>Supplier</th><th>Aksi</th>
    </tr>
    <?php while ($r = mysqli_fetch_assoc($data)) { ?>
    <tr>
      <td><?= e($r['id']) ?></td>
      <td><?= e($r['kode_barang']) ?></td>
      <td><?= e($r['nama_barang']) ?></td>
      <td><?= number_format($r['harga'], 0, ',', '.') ?></td>
      <td><?= e($r['stok']) ?></td>
      <td><?= e($r['supplier']) ?></td>
      <td>
        <form method="post" onsubmit="return confirm('Yakin hapus barang ini?')">
          <input type="hidden" name="hapus_id" value="<?= $r['id'] ?>">
          <button type="submit">Hapus</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>