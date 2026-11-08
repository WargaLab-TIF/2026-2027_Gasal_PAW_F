<?php
require "koneksi.php";

$master = mysqli_query($conn, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan FROM transaksi
JOIN pelanggan ON pelanggan.id = transaksi.pelanggan_id");

$transaksi = null;
if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];
  $q = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = $id");
  $transaksi = mysqli_fetch_assoc($q);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Transaksi (Master - Detail)</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Data Transaksi (Master)</h1>
  <p><a href="barang.php">Lihat Data Barang</a></p>

  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th><th>Total</th><th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($master)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['waktu_transaksi']; ?></td>
        <td><?php echo $row['nama_pelanggan']; ?></td>
        <td><?php echo $row['keterangan']; ?></td>
        <td>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
        <td><a href="transaksi.php?id=<?php echo $row['id']; ?>">Lihat Detail</a></td>
      </tr>
    <?php } ?>
  </table>

  <?php if ($transaksi) { ?>
    <?php
    $id = $transaksi['id'];
    $detail = mysqli_query($conn, "SELECT barang.kode_barang, barang.nama_barang, transaksi_detail.harga, transaksi_detail.qty
    FROM transaksi_detail JOIN barang ON barang.id = transaksi_detail.barang_id
    WHERE transaksi_detail.transaksi_id = $id");

    $pilihan = mysqli_query($conn, "SELECT * FROM barang WHERE id NOT IN (SELECT barang_id FROM transaksi_detail WHERE transaksi_id = $id)");
    ?>

    <h2>Detail Transaksi #<?php echo $id; ?></h2>
    <p>Tanggal: <?php echo $transaksi['waktu_transaksi']; ?> | Keterangan: <?php echo $transaksi['keterangan']; ?></p>

    <table border="1" cellpadding="5">
      <tr>
        <th>No</th><th>Kode</th><th>Nama Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th>
      </tr>
      <?php $no = 1; while ($d = mysqli_fetch_assoc($detail)) { ?>
        <?php $subtotal = $d['harga'] * $d['qty']; ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $d['kode_barang']; ?></td>
          <td><?php echo $d['nama_barang']; ?></td>
          <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
          <td><?php echo $d['qty']; ?></td>
          <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
        </tr>
        <?php $no++; ?>
      <?php } ?>
      <tr>
        <td colspan="5" align="right"><b>Total</b></td>
        <td><b>Rp <?php echo number_format($transaksi['total'], 0, ',', '.'); ?></b></td>
      </tr>
    </table>

    <h3>Tambah Detail Transaksi</h3>
    <?php if (mysqli_num_rows($pilihan) == 0) { ?>
      <p>Semua barang sudah dimasukkan ke transaksi ini.</p>
    <?php } else { ?>
      <form method="POST" action="transaksi_detail_tambah.php">
        <input type="hidden" name="transaksi_id" value="<?php echo $id; ?>">

        Barang:
        <select name="barang_id" required>
          <option value="">-- pilih barang --</option>
          <?php while ($b = mysqli_fetch_assoc($pilihan)) { ?>
            <option value="<?php echo $b['id']; ?>">
              <?php echo $b['kode_barang'] . " - " . $b['nama_barang']; ?>
            </option>
          <?php } ?>
        </select>

        Qty: <input type="number" name="qty" min="1" value="1" required>
        <button type="submit">Simpan</button>
      </form>
    <?php } ?>

  <?php } elseif (isset($_GET['id'])) { ?>
    <p>Transaksi tidak ditemukan.</p>
  <?php } ?>
</body>
</html>
