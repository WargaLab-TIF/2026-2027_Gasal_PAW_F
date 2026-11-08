<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'hapus') {
    $id = (int)($_POST['id'] ?? 0);

    // 1. Ambil nma brng
    $stmt = $db->prepare('SELECT nama_barang FROM barang WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        set_flash('error', 'Barang tidak ditemukan.');
    } else {
        // Cek brng udah dipake
        $stmt = $db->prepare('SELECT COUNT(*) FROM transaksi_detail WHERE barang_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $dipakai = (int)$stmt->get_result()->fetch_row()[0];
        $stmt->close();

        if ($dipakai > 0) {
            set_flash('error', "Barang \"{$row['nama_barang']}\" tidak dapat dihapus karena masih "
                . "digunakan pada $dipakai transaksi.");
        } else {
            try {
                $stmt = $db->prepare('DELETE FROM barang WHERE id = ?');
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $stmt->close();
                set_flash('success', "Barang \"{$row['nama_barang']}\" berhasil dihapus.");
            } catch (mysqli_sql_exception $ex) {
                set_flash('error', "Barang \"{$row['nama_barang']}\" gagal dihapus karena masih terkait data lain.");
            }
        }
    }
    header('Location: barang.php'); //cgah resubmit pas refresh
    exit;
}

$judul = 'Data Barang';
$res = $db->query(
    'SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS supplier,
            (SELECT COUNT(*) FROM transaksi_detail d WHERE d.barang_id = b.id) AS dipakai
       FROM barang b
       JOIN supplier s ON s.id = b.supplier_id
   ORDER BY b.id'
);
include 'header.php';
?>
<h1>Data Barang</h1>
<table>
  <thead>
    <tr><th>#</th><th>Kode</th><th>Nama Barang</th><th class="num">Harga</th><th class="num">Stok</th>
        <th>Supplier</th><th class="num">Dipakai di transaksi</th><th>Aksi</th></tr>
  </thead>
  <tbody>
  <?php while ($b = $res->fetch_assoc()): ?>
    <tr>
      <td><?= (int)$b['id'] ?></td>
      <td><?= e($b['kode_barang']) ?></td>
      <td><?= e($b['nama_barang']) ?></td>
      <td class="num"><?= rupiah($b['harga']) ?></td>
      <td class="num"><?= (int)$b['stok'] ?></td>
      <td><?= e($b['supplier']) ?></td>
      <td class="num"><?= (int)$b['dipakai'] ?></td>
      <td>
        <form method="post" onsubmit="return confirm('Hapus barang ini?');">
          <input type="hidden" name="aksi" value="hapus">
          <input type="hidden" name="id" value="<?= (int)$b['id'] ?>">
          <button type="submit" class="btn danger">Hapus</button>
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php include 'footer.php'; ?>
