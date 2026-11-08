<?php
// transaksi.php - halaman MASTER-DETIL
//   Master : tabel transaksi
//   Detail : tabel transaksi_detail (barang yang dibeli pada transaksi terpilih)
// Tugas 2: dropdown barang tidak menampilkan barang yang sudah ada di detail
// Tugas 4: total transaksi otomatis dihitung ulang setiap detail berubah
require 'koneksi.php';

$aksi = $_POST['aksi'] ?? '';

// ---------- Tambah transaksi (master) ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $aksi === 'tambah_transaksi') {
    $tgl  = $_POST['waktu_transaksi'] ?? '';
    $ket  = trim($_POST['keterangan'] ?? '');
    $plg  = $_POST['pelanggan_id'] ?? '';
    $d    = DateTime::createFromFormat('Y-m-d', $tgl);
    if (!$d || $d->format('Y-m-d') !== $tgl || $plg === '') {
        set_flash('error', 'Tanggal dan pelanggan wajib diisi dengan benar.');
        header('Location: transaksi.php'); exit;
    }
    try {
        $stmt = $db->prepare('INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)');
        $stmt->bind_param('sss', $tgl, $ket, $plg);
        $stmt->execute();
        $baru = $db->insert_id;
        $stmt->close();
        set_flash('success', "Transaksi #$baru dibuat. Silakan isi detail barangnya.");
        header("Location: transaksi.php?id=$baru#detail"); exit;
    } catch (mysqli_sql_exception $ex) {
        set_flash('error', 'Gagal menyimpan transaksi (pelanggan tidak valid).');
        header('Location: transaksi.php'); exit;
    }
}

// ---------- Tambah detail ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $aksi === 'tambah_detail') {
    $tid = (int)($_POST['transaksi_id'] ?? 0);
    $bid = (int)($_POST['barang_id'] ?? 0);
    $qty = (int)($_POST['qty'] ?? 0);
    $kembali = "Location: transaksi.php?id=$tid#detail";

    if ($tid <= 0 || $bid <= 0 || $qty < 1) {
        set_flash('error', 'Pilih barang dan isi qty minimal 1.');
        header($kembali); exit;
    }

    // Validasi sisi server: barang yang sama tidak boleh diinput dua kali
    $stmt = $db->prepare('SELECT COUNT(*) FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?');
    $stmt->bind_param('ii', $tid, $bid);
    $stmt->execute();
    $sudah = (int)$stmt->get_result()->fetch_row()[0];
    $stmt->close();
    if ($sudah > 0) {
        set_flash('error', 'Barang tersebut sudah ada pada transaksi ini.');
        header($kembali); exit;
    }

    // Harga diambil dari tabel barang (bukan dari input pengguna)
    $stmt = $db->prepare('SELECT harga FROM barang WHERE id = ?');
    $stmt->bind_param('i', $bid);
    $stmt->execute();
    $brg = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if (!$brg) {
        set_flash('error', 'Barang tidak ditemukan.');
        header($kembali); exit;
    }
    $harga = (int)$brg['harga'];

    // Simpan detail + update total dalam satu transaksi database (atomik)
    try {
        $db->begin_transaction();
        $stmt = $db->prepare('INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('iiii', $tid, $bid, $harga, $qty);
        $stmt->execute();
        $stmt->close();

        $total = hitung_ulang_total($db, $tid);   // <- Tugas 4
        $db->commit();
        set_flash('success', 'Detail disimpan. Total transaksi sekarang ' . rupiah($total) . '.');
    } catch (mysqli_sql_exception $ex) {
        $db->rollback();
        set_flash('error', 'Gagal menyimpan detail transaksi.');
    }
    header($kembali); exit;
}

// ---------- Hapus detail ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $aksi === 'hapus_detail') {
    $tid = (int)($_POST['transaksi_id'] ?? 0);
    $bid = (int)($_POST['barang_id'] ?? 0);
    try {
        $db->begin_transaction();
        $stmt = $db->prepare('DELETE FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?');
        $stmt->bind_param('ii', $tid, $bid);
        $stmt->execute();
        $stmt->close();
        $total = hitung_ulang_total($db, $tid);
        $db->commit();
        set_flash('success', 'Detail dihapus. Total transaksi sekarang ' . rupiah($total) . '.');
    } catch (mysqli_sql_exception $ex) {
        $db->rollback();
        set_flash('error', 'Gagal menghapus detail.');
    }
    header("Location: transaksi.php?id=$tid#detail"); exit;
}

// ---------- Tampilan ----------
$judul = 'Transaksi';
$id = (int)($_GET['id'] ?? 0);

// Master: seluruh transaksi
$master = $db->query(
    'SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan,
            (SELECT COUNT(*) FROM transaksi_detail d WHERE d.transaksi_id = t.id) AS item
       FROM transaksi t
       JOIN pelanggan p ON p.id = t.pelanggan_id
   ORDER BY t.id DESC'
);
$pelanggan = $db->query('SELECT id, nama FROM pelanggan ORDER BY nama');

// Master terpilih + detailnya
$sel = null; $detail = null; $pilihan = null;
if ($id > 0) {
    $stmt = $db->prepare(
        'SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS pelanggan
           FROM transaksi t JOIN pelanggan p ON p.id = t.pelanggan_id
          WHERE t.id = ?'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $sel = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
if ($sel) {
    // Detail milik transaksi terpilih (relasi foreign key transaksi_id)
    $stmt = $db->prepare(
        'SELECT d.barang_id, b.kode_barang, b.nama_barang, d.harga, d.qty, (d.harga * d.qty) AS subtotal
           FROM transaksi_detail d JOIN barang b ON b.id = d.barang_id
          WHERE d.transaksi_id = ?
       ORDER BY b.nama_barang'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $detail = $stmt->get_result();
    $stmt->close();

    // Dropdown: HANYA barang yang BELUM ada di detail transaksi ini (Tugas 2)
    $stmt = $db->prepare(
        'SELECT b.id, b.kode_barang, b.nama_barang, b.harga
           FROM barang b
          WHERE NOT EXISTS (SELECT 1 FROM transaksi_detail d
                             WHERE d.transaksi_id = ? AND d.barang_id = b.id)
       ORDER BY b.nama_barang'
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $pilihan = $stmt->get_result();
    $stmt->close();
}
include 'header.php';
?>
<h1>Transaksi (Master-Detil)</h1>

<section>
  <h2>Master: Transaksi</h2>
  <table>
    <thead><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th>
      <th class="num">Item</th><th class="num">Total</th><th>Detail</th></tr></thead>
    <tbody>
    <?php while ($m = $master->fetch_assoc()): ?>
      <tr class="<?= $m['id'] == $id ? 'aktif' : '' ?>">
        <td><?= (int)$m['id'] ?></td>
        <td><?= e($m['waktu_transaksi']) ?></td>
        <td><?= e($m['pelanggan']) ?></td>
        <td><?= e($m['keterangan']) ?></td>
        <td class="num"><?= (int)$m['item'] ?></td>
        <td class="num"><?= rupiah($m['total']) ?></td>
        <td><a class="btn" href="transaksi.php?id=<?= (int)$m['id'] ?>#detail">Load</a></td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>

  <details class="box">
    <summary>+ Tambah transaksi baru</summary>
    <form method="post" class="row">
      <input type="hidden" name="aksi" value="tambah_transaksi">
      <label>Tanggal
        <input type="date" name="waktu_transaksi" value="<?= date('Y-m-d') ?>" required></label>
      <label>Pelanggan
        <select name="pelanggan_id" required>
          <option value="">-- pilih pelanggan --</option>
          <?php while ($p = $pelanggan->fetch_assoc()): ?>
            <option value="<?= e($p['id']) ?>"><?= e($p['id'] . ' - ' . $p['nama']) ?></option>
          <?php endwhile; ?>
        </select></label>
      <label class="grow">Keterangan
        <input type="text" name="keterangan" maxlength="200"></label>
      <button type="submit" class="btn primary">Simpan</button>
    </form>
  </details>
</section>

<section id="detail">
<?php if (!$sel): ?>
  <h2>Detail</h2>
  <p class="muted">Klik tombol <b>Load</b> pada salah satu transaksi di atas untuk menampilkan detailnya.</p>
<?php else: ?>
  <h2>Detail: Transaksi #<?= (int)$sel['id'] ?></h2>
  <dl class="info">
    <div><dt>Tanggal</dt><dd><?= e($sel['waktu_transaksi']) ?></dd></div>
    <div><dt>Pelanggan</dt><dd><?= e($sel['pelanggan']) ?></dd></div>
    <div><dt>Keterangan</dt><dd><?= e($sel['keterangan']) ?: '-' ?></dd></div>
    <div><dt>Total</dt><dd><b><?= rupiah($sel['total']) ?></b></dd></div>
  </dl>

  <table>
    <thead><tr><th>Kode</th><th>Barang</th><th class="num">Harga</th><th class="num">Qty</th>
      <th class="num">Subtotal</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php if ($detail->num_rows === 0): ?>
      <tr><td colspan="6" class="muted">Belum ada barang pada transaksi ini.</td></tr>
    <?php endif; ?>
    <?php while ($d = $detail->fetch_assoc()): ?>
      <tr>
        <td><?= e($d['kode_barang']) ?></td>
        <td><?= e($d['nama_barang']) ?></td>
        <td class="num"><?= rupiah($d['harga']) ?></td>
        <td class="num"><?= (int)$d['qty'] ?></td>
        <td class="num"><?= rupiah($d['subtotal']) ?></td>
        <td>
          <form method="post" onsubmit="return confirm('Hapus barang dari transaksi ini?');">
            <input type="hidden" name="aksi" value="hapus_detail">
            <input type="hidden" name="transaksi_id" value="<?= (int)$sel['id'] ?>">
            <input type="hidden" name="barang_id" value="<?= (int)$d['barang_id'] ?>">
            <button type="submit" class="btn danger">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
    <tfoot><tr><td colspan="4" class="num"><b>Total</b></td>
      <td class="num"><b><?= rupiah($sel['total']) ?></b></td><td></td></tr></tfoot>
  </table>

  <div class="box">
    <h3>Tambah barang ke transaksi ini</h3>
    <?php if ($pilihan->num_rows === 0): ?>
      <p class="muted">Semua barang sudah dimasukkan ke transaksi ini.</p>
    <?php else: ?>
    <form method="post" class="row">
      <input type="hidden" name="aksi" value="tambah_detail">
      <input type="hidden" name="transaksi_id" value="<?= (int)$sel['id'] ?>">
      <label class="grow">Barang
        <select name="barang_id" id="barang" required>
          <option value="" data-harga="0">-- pilih barang --</option>
          <?php while ($b = $pilihan->fetch_assoc()): ?>
            <option value="<?= (int)$b['id'] ?>" data-harga="<?= (int)$b['harga'] ?>">
              <?= e($b['kode_barang'] . ' - ' . $b['nama_barang'] . ' (' . rupiah($b['harga']) . ')') ?>
            </option>
          <?php endwhile; ?>
        </select></label>
      <label>Qty
        <input type="number" name="qty" id="qty" min="1" value="1" required></label>
      <label>Perkiraan subtotal
        <output id="subtotal">Rp 0</output></label>
      <button type="submit" class="btn primary">Simpan</button>
    </form>
    <script>
      // Hanya tampilan: perkiraan subtotal. Harga sebenarnya diambil server dari tabel barang.
      const sel = document.getElementById('barang'), qty = document.getElementById('qty'),
            out = document.getElementById('subtotal');
      function hitung() {
        const h = parseInt(sel.selectedOptions[0].dataset.harga || '0', 10);
        const q = parseInt(qty.value || '0', 10);
        out.textContent = 'Rp ' + (h * (q > 0 ? q : 0)).toLocaleString('id-ID');
      }
      sel.addEventListener('change', hitung); qty.addEventListener('input', hitung);
    </script>
    <?php endif; ?>
  </div>
<?php endif; ?>
</section>
<?php include 'footer.php'; ?>
