<?php
include 'koneksi.php';
$id = (int)($_GET['id'] ?? 0);
$pesan = '';


$st = mysqli_prepare($db, "SELECT t.*, p.nama FROM transaksi t JOIN pelanggan p ON p.id=t.pelanggan_id WHERE t.id=?");
mysqli_stmt_bind_param($st, 'i', $id);
mysqli_stmt_execute($st);
$trx = mysqli_fetch_assoc(mysqli_stmt_get_result($st));
if (!$trx) die('Transaksi tidak ditemukan');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = (int)$_POST['barang_id'];
    $qty = (int)$_POST['qty'];


    $c = mysqli_prepare($db, "SELECT COUNT(*) FROM transaksi_detail WHERE transaksi_id=? AND barang_id=?");
    mysqli_stmt_bind_param($c, 'ii', $id, $barang_id);
    mysqli_stmt_execute($c);
    $sudah = mysqli_fetch_row(mysqli_stmt_get_result($c))[0];

    if ($qty < 1) {
        $pesan = 'Qty minimal 1.';
    } elseif ($sudah) {
        $pesan = 'Barang sudah ada di transaksi ini.';
    } else {
        mysqli_begin_transaction($db);
        try {

            $ins = mysqli_prepare($db, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                                        SELECT ?, id, harga, ? FROM barang WHERE id=?");
            mysqli_stmt_bind_param($ins, 'iii', $id, $qty, $barang_id);
            mysqli_stmt_execute($ins);

            $up = mysqli_prepare($db, "UPDATE transaksi SET total =
                (SELECT COALESCE(SUM(harga*qty),0) FROM transaksi_detail WHERE transaksi_id=?)
                WHERE id=?");
            mysqli_stmt_bind_param($up, 'ii', $id, $id);
            mysqli_stmt_execute($up);

            mysqli_commit($db);
            header("Location: detail.php?id=$id");
            exit;
        } catch (Throwable $e) {
            mysqli_rollback($db);
            $pesan = 'Gagal menyimpan: ' . $e->getMessage();
        }
    }
}


$st = mysqli_prepare($db, "SELECT d.*, b.nama_barang FROM transaksi_detail d JOIN barang b ON b.id=d.barang_id WHERE d.transaksi_id=?");
mysqli_stmt_bind_param($st, 'i', $id);
mysqli_stmt_execute($st);
$detail = mysqli_stmt_get_result($st);


$st = mysqli_prepare($db, "SELECT id, nama_barang, harga FROM barang
                           WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id=?)
                           ORDER BY nama_barang");
mysqli_stmt_bind_param($st, 'i', $id);
mysqli_stmt_execute($st);
$pilihan = mysqli_stmt_get_result($st);
?>
<h2>Transaksi #<?= $trx['id'] ?></h2>
<p>Tanggal: <?= $trx['waktu_transaksi'] ?> | Pelanggan: <?= htmlspecialchars($trx['nama']) ?><br>
Keterangan: <?= htmlspecialchars($trx['keterangan']) ?><br>
<b>Total: Rp <?= number_format($trx['total'], 0, ',', '.') ?></b></p>

<table border="1" cellpadding="6">
<tr><th>Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
<?php while ($d = mysqli_fetch_assoc($detail)): ?>
<tr>
  <td><?= htmlspecialchars($d['nama_barang']) ?></td>
  <td align="right"><?= number_format($d['harga'], 0, ',', '.') ?></td>
  <td><?= $d['qty'] ?></td>
  <td align="right"><?= number_format($d['harga'] * $d['qty'], 0, ',', '.') ?></td>
</tr>
<?php endwhile; ?>
</table>

<h3>Tambah Detail</h3>
<?php if ($pesan) echo "<p style='color:red'>" . htmlspecialchars($pesan) . "</p>"; ?>
<?php if (mysqli_num_rows($pilihan) === 0): ?>
  <p>Semua barang sudah dimasukkan ke transaksi ini.</p>
<?php else: ?>
<form method="post">
  <select name="barang_id" required>
    <option value="">-- pilih barang --</option>
    <?php while ($b = mysqli_fetch_assoc($pilihan)): ?>
      <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['nama_barang']) ?> (Rp <?= number_format($b['harga'], 0, ',', '.') ?>)</option>
    <?php endwhile; ?>
  </select>
  <input type="number" name="qty" min="1" value="1" required>
  <button type="submit">Simpan</button>
</form>
<?php endif; ?>
<p><a href="transaksi.php">Kembali</a></p>