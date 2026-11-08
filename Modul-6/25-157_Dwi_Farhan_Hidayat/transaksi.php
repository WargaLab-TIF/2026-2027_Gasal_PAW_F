<?php
include 'koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal    = mysqli_real_escape_string($conn, $_POST['waktu_transaksi'] ?? date('Y-m-d'));
    $pelanggan  = mysqli_real_escape_string($conn, $_POST['pelanggan_id'] ?? '');
    $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan'] ?? ''));

    if ($pelanggan === '') {
        $error = 'Pelanggan wajib dipilih.';
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id)
                                       VALUES ('$tanggal', '$keterangan', 0, '$pelanggan')");
        if ($simpan) {
            header('Location: transaksi_detail.php?id=' . mysqli_insert_id($conn));
            exit;
        }
        $error = 'Gagal menyimpan transaksi: ' . mysqli_error($conn);
    }
}

$pelangganList = mysqli_query($conn, "SELECT id, nama FROM pelanggan ORDER BY nama");
$query = mysqli_query($conn, "SELECT t.*, p.nama AS pelanggan
                              FROM transaksi t
                              JOIN pelanggan p ON p.id = t.pelanggan_id
                              ORDER BY t.id ASC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Transaksi</title>
</head>
<body>
  <a href="barang.php">Data Barang</a>
  <h3>Data Transaksi (Master)</h3>
  <?php if ($error != ''): ?>
    <p><b><?= htmlspecialchars($error) ?></b></p>
  <?php endif; ?>

  <h4>Tambah Transaksi Baru</h4>
  <form method="post">
    <table border="1" cellpadding="5" cellspacing="0">
      <tr>
        <td>Tanggal</td>
        <td><input type="date" name="waktu_transaksi" value="<?= date('Y-m-d') ?>" required></td>
      </tr>
      <tr>
        <td>Pelanggan</td>
        <td>
          <select name="pelanggan_id" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while ($p = mysqli_fetch_assoc($pelangganList)): ?>
              <option value="<?= htmlspecialchars($p['id']) ?>"><?= htmlspecialchars($p['nama']) ?></option>
            <?php endwhile; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td><input type="text" name="keterangan"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="Simpan & Isi Detail"></td>
      </tr>
    </table>
  </form>

  <h4>Daftar Transaksi</h4>
  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Tanggal</th>
      <th>Pelanggan</th>
      <th>Keterangan</th>
      <th>Total</th>
      <th>Aksi</th>
    </tr>
    <?php while ($r = mysqli_fetch_assoc($query)): ?>
    <tr>
      <td><?= (int)$r['id'] ?></td>
      <td><?= htmlspecialchars($r['waktu_transaksi']) ?></td>
      <td><?= htmlspecialchars($r['pelanggan']) ?></td>
      <td><?= htmlspecialchars($r['keterangan']) ?></td>
      <td align="right"><?= number_format($r['total'], 0, ',', '.') ?></td>
      <td><a href="transaksi_detail.php?id=<?= (int)$r['id'] ?>">Detail</a></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
