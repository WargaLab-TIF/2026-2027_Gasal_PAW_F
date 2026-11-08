<?php
include 'koneksi.php';

$transaksi_id = (int)($_GET['id'] ?? 0);
$qMaster = mysqli_query($conn, "SELECT t.*, p.nama AS pelanggan
                                FROM transaksi t
                                JOIN pelanggan p ON p.id = t.pelanggan_id
                                WHERE t.id = $transaksi_id");
$master = mysqli_fetch_assoc($qMaster);
if (!$master) {
    header('Location: transaksi.php');
    exit;
}
$pesan = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = (int)($_POST['barang_id'] ?? 0);
    $qty       = (int)($_POST['qty'] ?? 0);

    if ($barang_id <= 0 || $qty <= 0) {
        $pesan = 'Barang dan qty wajib diisi dengan benar.';
    } else {
        $qBarang = mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang_id");
        $b = mysqli_fetch_assoc($qBarang);
        $qCek = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM transaksi_detail
                                     WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id");
        $sudahAda = (int)mysqli_fetch_assoc($qCek)['jml'];

        if (!$b) {
            $pesan = 'Barang tidak ditemukan.';
        } elseif ($sudahAda > 0) {
            $pesan = 'Barang tersebut sudah ada pada transaksi ini.';
        } else {
            $harga = (int)$b['harga'];
            mysqli_begin_transaction($conn);

            $ok1 = mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                                        VALUES ($transaksi_id, $barang_id, $harga, $qty)");
            $ok2 = mysqli_query($conn, "UPDATE transaksi
                                        SET total = (SELECT COALESCE(SUM(harga * qty), 0)
                                                     FROM transaksi_detail
                                                     WHERE transaksi_id = $transaksi_id)
                                        WHERE id = $transaksi_id");
            if ($ok1 && $ok2) {
                mysqli_commit($conn);
                header("Location: transaksi_detail.php?id=$transaksi_id&sukses=1");
                exit;
            } else {
                mysqli_rollback($conn);
                $pesan = 'Gagal menyimpan detail: ' . mysqli_error($conn);
            }
        }
    }
}

if (isset($_GET['sukses'])) {
    $pesan = 'Detail transaksi berhasil disimpan, total diperbarui.';
}

$qMaster = mysqli_query($conn, "SELECT t.*, p.nama AS pelanggan
                                FROM transaksi t
                                JOIN pelanggan p ON p.id = t.pelanggan_id
                                WHERE t.id = $transaksi_id");
$master = mysqli_fetch_assoc($qMaster);

$details = mysqli_query($conn, "SELECT d.*, b.kode_barang, b.nama_barang
                                FROM transaksi_detail d
                                JOIN barang b ON b.id = d.barang_id
                                WHERE d.transaksi_id = $transaksi_id
                                ORDER BY b.nama_barang");

$pilihan = mysqli_query($conn, "SELECT id, kode_barang, nama_barang, harga
                                FROM barang
                                WHERE id NOT IN (SELECT barang_id FROM transaksi_detail
                                                 WHERE transaksi_id = $transaksi_id)
                                ORDER BY nama_barang");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Detail Transaksi #<?= $transaksi_id ?></title>
</head>
<body>
  <a href="barang.php">Data Barang</a> |
  <a href="transaksi.php">Data Transaksi</a>
  <h3>Detail Transaksi #<?= (int)$master['id'] ?></h3>
  <?php if ($pesan != ''): ?>
    <p><b><?= htmlspecialchars($pesan) ?></b></p>
  <?php endif; ?>
  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>Tanggal</th>
      <th>Pelanggan</th>
      <th>Keterangan</th>
      <th>Total</th>
    </tr>
    <tr>
      <td><?= htmlspecialchars($master['waktu_transaksi']) ?></td>
      <td><?= htmlspecialchars($master['pelanggan']) ?></td>
      <td><?= htmlspecialchars($master['keterangan']) ?></td>
      <td align="right">Rp <?= number_format($master['total'], 0, ',', '.') ?></td>
    </tr>
  </table>
  <h4>Tambah Detail Barang</h4>
  <?php if (mysqli_num_rows($pilihan) === 0): ?>
    <p>Semua barang sudah dimasukkan ke transaksi ini.</p>
  <?php else: ?>
  <form method="post">
    <table border="1" cellpadding="5" cellspacing="0">
      <tr>
        <td>Barang</td>
        <td>
          <select name="barang_id" id="barang_id" required>
            <option value="" data-harga="">-- Pilih Barang --</option>
            <?php while ($b = mysqli_fetch_assoc($pilihan)): ?>
              <option value="<?= (int)$b['id'] ?>" data-harga="<?= (int)$b['harga'] ?>">
                <?= htmlspecialchars($b['kode_barang'] . ' - ' . $b['nama_barang']) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Harga</td>
        <td><input type="text" id="harga" readonly></td>
      </tr>
      <tr>
        <td>Qty</td>
        <td><input type="number" name="qty" min="1" value="1" required></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" value="Simpan"></td>
      </tr>
    </table>
  </form>
  <?php endif; ?>
  <h4>Daftar Detail</h4>
  <table border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Kode</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Qty</th>
      <th>Subtotal</th>
    </tr>
    <?php $no = 1; $grand = 0; while ($d = mysqli_fetch_assoc($details)):
          $sub = $d['harga'] * $d['qty']; $grand += $sub; ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($d['kode_barang']) ?></td>
      <td><?= htmlspecialchars($d['nama_barang']) ?></td>
      <td align="right"><?= number_format($d['harga'], 0, ',', '.') ?></td>
      <td align="right"><?= (int)$d['qty'] ?></td>
      <td align="right"><?= number_format($sub, 0, ',', '.') ?></td>
    </tr>
    <?php endwhile; ?>
    <tr>
      <th colspan="5" align="right">Total</th>
      <th align="right"><?= number_format($grand, 0, ',', '.') ?></th>
    </tr>
  </table>
  <p><a href="transaksi.php">&laquo; Kembali</a></p>
  <script>
  var sel = document.getElementById('barang_id');
  if (sel) {
    sel.addEventListener('change', function () {
      var h = this.options[this.selectedIndex].getAttribute('data-harga');
      document.getElementById('harga').value = h ? Number(h).toLocaleString('id-ID') : '';
    });
  }
  </script>
</body>
</html>
