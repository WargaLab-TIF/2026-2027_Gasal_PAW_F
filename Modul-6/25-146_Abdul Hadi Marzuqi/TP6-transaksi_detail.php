<?php
require_once __DIR__.'/TP6-koneksi.php';

$id = (int)($_GET['id'] ?? 0);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barang_id = (int)$_POST['barang_id'];
    $qty = max(1, (int)$_POST['qty']);

    
    $stmt = mysqli_prepare($conn, "SELECT harga FROM barang WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $barang_id);
    mysqli_stmt_execute($stmt);
    $barang = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if ($barang) {
        try {
          
            $stmt = mysqli_prepare($conn,
              "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
               VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "iiii", $id, $barang_id, $barang['harga'], $qty);
            mysqli_stmt_execute($stmt);

          
            $stmt = mysqli_prepare($conn,
              "SELECT COALESCE(SUM(harga * qty), 0) AS total
               FROM transaksi_detail WHERE transaksi_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $total = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['total'];

           
            $stmt = mysqli_prepare($conn, "UPDATE transaksi SET total = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "ii", $total, $id);
            mysqli_stmt_execute($stmt);
        } catch (mysqli_sql_exception $ex) {
            
        }
    }
    header("Location: transaksi_detail.php?id=$id");
    exit;
}

$stmt = mysqli_prepare($conn,
  "SELECT t.*, p.nama AS pelanggan
   FROM transaksi t
   LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
   WHERE t.id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$master = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$master) {
    die("Transaksi tidak ditemukan. <a href='transaksi.php'>Kembali</a>");
}


$stmt = mysqli_prepare($conn,
  "SELECT d.harga, d.qty, b.nama_barang
   FROM transaksi_detail d
   JOIN barang b ON d.barang_id = b.id
   WHERE d.transaksi_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$detail = mysqli_stmt_get_result($stmt);

$stmt = mysqli_prepare($conn,
  "SELECT id, nama_barang, harga FROM barang
   WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = ?)
   ORDER BY nama_barang");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$pilihan = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Detail Transaksi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <p><a href="transaksi.php">&lt; Kembali</a></p>

  <h2>Data Transaksi (Master)</h2>
  <div class="box">
    ID Transaksi : <?= e($master['id']) ?><br>
    Tanggal      : <?= e($master['waktu_transaksi']) ?><br>
    Pelanggan    : <?= e($master['pelanggan']) ?><br>
    Keterangan   : <?= e($master['keterangan']) ?><br>
    <strong>Total : Rp <?= number_format($master['total'], 0, ',', '.') ?></strong>
  </div>

  <h2>Barang dalam Transaksi (Detail)</h2>
  <table>
    <tr><th>No</th><th>Nama Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
    <?php $no = 1; while ($d = mysqli_fetch_assoc($detail)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= e($d['nama_barang']) ?></td>
      <td><?= number_format($d['harga'], 0, ',', '.') ?></td>
      <td><?= e($d['qty']) ?></td>
      <td><?= number_format($d['harga'] * $d['qty'], 0, ',', '.') ?></td>
    </tr>
    <?php } ?>
    <?php if ($no === 1) { ?>
    <tr><td colspan="5">Belum ada barang.</td></tr>
    <?php } ?>
  </table>

  <h2>Tambah Barang</h2>
  <?php if (mysqli_num_rows($pilihan) === 0) { ?>
    <p>Semua barang sudah dimasukkan ke transaksi ini.</p>
  <?php } else { ?>
  <form method="post">
    Barang:
    <select name="barang_id" required>
      <option value="">-- pilih barang --</option>
      <?php while ($b = mysqli_fetch_assoc($pilihan)) { ?>
        <option value="<?= $b['id'] ?>">
          <?= e($b['nama_barang']) ?> (Rp <?= number_format($b['harga'], 0, ',', '.') ?>)
        </option>
      <?php } ?>
    </select>
    Qty: <input type="number" name="qty" min="1" value="1" required>
    <button type="submit">Simpan</button>
  </form>
  <?php } ?>
</body>
</html>