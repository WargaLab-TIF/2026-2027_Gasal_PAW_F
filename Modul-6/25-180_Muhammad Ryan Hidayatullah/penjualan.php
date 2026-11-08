<?php

// ===== SOAL 1 : KONEKSI DATABASE & FUNGSI BANTU =====
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $koneksi = new mysqli("localhost", "root", "", "penjualan");
    $koneksi->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

session_start();

// escape output agar aman dari XSS
function e($teks) {
    return htmlspecialchars((string)$teks, ENT_QUOTES, 'UTF-8');
}

function rupiah($angka) {
    return "Rp " . number_format((int)$angka, 0, ',', '.');
}

// notifikasi sekali tampil (disimpan di session)
function set_flash($tipe, $pesan) {
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function tampilkan_flash() {
    if (isset($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        echo '<div class="alert ' . e($f['tipe']) . '">'
           . e($f['pesan']) . '</div>';
    }
}

// ===== SOAL 4 : FUNGSI HITUNG ULANG TOTAL TRANSAKSI =====
function hitung_ulang_total($koneksi, $transaksi_id) {
    // 1. jumlahkan harga x qty seluruh detail transaksi ini
    $q = $koneksi->prepare(
        "SELECT COALESCE(SUM(harga * qty), 0) AS total
         FROM transaksi_detail WHERE transaksi_id = ?");
    $q->bind_param("i", $transaksi_id);
    $q->execute();
    $total = (int)$q->get_result()->fetch_assoc()['total'];

    // 2. simpan hasilnya ke kolom total pada tabel transaksi
    $u = $koneksi->prepare(
        "UPDATE transaksi SET total = ? WHERE id = ?");
    $u->bind_param("ii", $total, $transaksi_id);
    $u->execute();
    return $total;
}

// ===== PROSES FORM (POST) : aksi dibedakan oleh field "aksi" =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi   = $_POST['aksi'] ?? '';
    $kembali = 'penjualan.php';

    try {
        // ---------- SOAL 2 : tambah transaksi (MASTER) ----------
        if ($aksi === 'tambah_transaksi') {
            $tanggal    = $_POST['waktu_transaksi'] ?? '';
            $pelanggan  = $_POST['pelanggan_id'] ?? '';
            $keterangan = trim($_POST['keterangan'] ?? '');
            if ($tanggal === '' || $pelanggan === '') {
                throw new Exception(
                    'Tanggal dan pelanggan wajib diisi.');
            }

            // total awal 0, diisi otomatis oleh SOAL 4
            $stmt = $koneksi->prepare(
                "INSERT INTO transaksi
                   (waktu_transaksi, keterangan, total, pelanggan_id)
                 VALUES (?, ?, 0, ?)");
            $stmt->bind_param("sss", $tanggal, $keterangan,
                              $pelanggan);
            $stmt->execute();

            set_flash('sukses',
                      'Transaksi dibuat. Isi detail barang.');
            $kembali = 'penjualan.php?page=detail&id='
                     . $koneksi->insert_id;

        // ---------- SOAL 2 + 4 : tambah detail transaksi ----------
        } elseif ($aksi === 'tambah_detail') {
            $tid       = (int)($_POST['transaksi_id'] ?? 0);
            $barang_id = (int)($_POST['barang_id'] ?? 0);
            $qty       = (int)($_POST['qty'] ?? 0);
            $kembali   = 'penjualan.php?page=detail&id=' . $tid;

            if ($barang_id <= 0 || $qty < 1) {
                throw new Exception(
                    'Barang dan qty (min. 1) wajib diisi.');
            }

            // [SOAL 2] ambil harga barang dari tabel barang
            $b = $koneksi->prepare(
                "SELECT harga FROM barang WHERE id = ?");
            $b->bind_param("i", $barang_id);
            $b->execute();
            $barang = $b->get_result()->fetch_assoc();
            if (!$barang) {
                throw new Exception('Barang tidak ditemukan.');
            }

            // [SOAL 2] cek di server: barang tidak boleh ganda
            $c = $koneksi->prepare(
                "SELECT COUNT(*) AS jml FROM transaksi_detail
                 WHERE transaksi_id = ? AND barang_id = ?");
            $c->bind_param("ii", $tid, $barang_id);
            $c->execute();
            if ($c->get_result()->fetch_assoc()['jml'] > 0) {
                throw new Exception(
                    'Barang sudah ada di transaksi ini.');
            }

            // [SOAL 4] simpan detail + hitung ulang total (1 DB trx)
            $koneksi->begin_transaction();
            $i = $koneksi->prepare(
                "INSERT INTO transaksi_detail
                   (transaksi_id, barang_id, harga, qty)
                 VALUES (?, ?, ?, ?)");
            $harga = (int)$barang['harga'];
            $i->bind_param("iiii", $tid, $barang_id, $harga, $qty);
            $i->execute();
            $total = hitung_ulang_total($koneksi, $tid);
            $koneksi->commit();

            set_flash('sukses', 'Detail disimpan. Total transaksi: '
                              . rupiah($total));

        // ------- SOAL 4 : hapus detail, total diperbarui -------
        } elseif ($aksi === 'hapus_detail') {
            $tid       = (int)($_POST['transaksi_id'] ?? 0);
            $barang_id = (int)($_POST['barang_id'] ?? 0);
            $kembali   = 'penjualan.php?page=detail&id=' . $tid;

            $koneksi->begin_transaction();
            $d = $koneksi->prepare(
                "DELETE FROM transaksi_detail
                 WHERE transaksi_id = ? AND barang_id = ?");
            $d->bind_param("ii", $tid, $barang_id);
            $d->execute();
            hitung_ulang_total($koneksi, $tid);
            $koneksi->commit();

            set_flash('sukses', 'Detail dihapus, total diperbarui.');

        // ---------- SOAL 3 : hapus barang + cek data terkait ------
        } elseif ($aksi === 'hapus_barang') {
            $barang_id = (int)($_POST['barang_id'] ?? 0);
            $kembali   = 'penjualan.php?page=barang';

            // [SOAL 3] 1. pastikan barang ada
            $s = $koneksi->prepare(
                "SELECT nama_barang FROM barang WHERE id = ?");
            $s->bind_param("i", $barang_id);
            $s->execute();
            $barang = $s->get_result()->fetch_assoc();
            if (!$barang) {
                throw new Exception('Data barang tidak ditemukan.');
            }

            // [SOAL 3] 2. cek apakah barang sudah dipakai di detail
            $cek = $koneksi->prepare(
                "SELECT COUNT(*) AS jml FROM transaksi_detail
                 WHERE barang_id = ?");
            $cek->bind_param("i", $barang_id);
            $cek->execute();
            $jml = (int)$cek->get_result()->fetch_assoc()['jml'];

            if ($jml > 0) {
                // [SOAL 3] 3a. sudah dipakai -> tidak boleh dihapus
                set_flash('error', 'Barang "' . $barang['nama_barang']
                    . '" tidak dapat dihapus karena masih digunakan '
                    . 'pada ' . $jml . ' transaksi.');
            } else {
                // [SOAL 3] 3b. belum dipakai -> boleh dihapus
                $del = $koneksi->prepare(
                    "DELETE FROM barang WHERE id = ?");
                $del->bind_param("i", $barang_id);
                $del->execute();
                set_flash('sukses', 'Barang "' . $barang['nama_barang']
                    . '" berhasil dihapus.');
            }
        }
    } catch (Throwable $ex) {
        try { $koneksi->rollback(); } catch (Throwable $x) {}
        if ($ex instanceof mysqli_sql_exception
            && $ex->getCode() == 1062) {
            set_flash('error', 'Barang sudah ada di transaksi ini.');
        } else {
            set_flash('error', $ex->getMessage());
        }
    }

    // Post/Redirect/Get: refresh tidak mengirim ulang form
    header('Location: ' . $kembali);
    exit;
}

// ===== AMBIL DATA UNTUK TAMPILAN (GET) =====
$page = $_GET['page'] ?? 'transaksi';
if (!in_array($page, ['transaksi', 'detail', 'barang'])) {
    $page = 'transaksi';
}
$id = (int)($_GET['id'] ?? 0);

if ($page === 'detail') {
    // [SOAL 2] data MASTER
    $stmt = $koneksi->prepare(
        "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total,
                p.nama AS nama_pelanggan
         FROM transaksi t
         JOIN pelanggan p ON p.id = t.pelanggan_id
         WHERE t.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $master = $stmt->get_result()->fetch_assoc();
    if (!$master) {
        set_flash('error', 'Transaksi tidak ditemukan.');
        header('Location: penjualan.php');
        exit;
    }

    // [SOAL 2] data DETAIL milik transaksi ini
    $q = $koneksi->prepare(
        "SELECT d.barang_id, b.kode_barang, b.nama_barang,
                d.harga, d.qty, (d.harga * d.qty) AS subtotal
         FROM transaksi_detail d
         JOIN barang b ON b.id = d.barang_id
         WHERE d.transaksi_id = ?
         ORDER BY b.nama_barang");
    $q->bind_param("i", $id);
    $q->execute();
    $detail = $q->get_result()->fetch_all(MYSQLI_ASSOC);

    // [SOAL 2] id barang yang sudah masuk detail -> di-disable
    $dipakai = array_map('intval', array_column($detail, 'barang_id'));

    // [SOAL 2] isi dropdown: semua barang dari tabel barang
    $daftar_barang = $koneksi->query(
        "SELECT id, kode_barang, nama_barang, harga
         FROM barang ORDER BY nama_barang"
    )->fetch_all(MYSQLI_ASSOC);
    $masih_ada = count($daftar_barang) > count($dipakai);

} elseif ($page === 'barang') {
    // [SOAL 3] daftar barang + jumlah transaksi yang memakainya
    $barang = $koneksi->query(
        "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok,
                s.nama AS nama_supplier,
                (SELECT COUNT(*) FROM transaksi_detail d
                 WHERE d.barang_id = b.id) AS jml_dipakai
         FROM barang b
         JOIN supplier s ON s.id = b.supplier_id
         ORDER BY b.kode_barang")->fetch_all(MYSQLI_ASSOC);

} else {
    // [SOAL 2] halaman MASTER: daftar transaksi + pilihan pelanggan
    $pelanggan = $koneksi->query(
        "SELECT id, nama FROM pelanggan ORDER BY nama"
    )->fetch_all(MYSQLI_ASSOC);

    $transaksi = $koneksi->query(
        "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total,
                p.nama AS nama_pelanggan
         FROM transaksi t
         JOIN pelanggan p ON p.id = t.pelanggan_id
         ORDER BY t.id DESC")->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Penjualan - TP Modul 6</title>
<style>
  body { font-family: Arial, sans-serif; margin: 0;
         background: #f4f6f8; }
  nav { background: #1f3a5f; padding: 12px 24px; }
  nav a { color: #fff; margin-right: 18px; text-decoration: none; }
  .container { max-width: 960px; margin: 24px auto; padding: 0 16px; }
  .card { background: #fff; padding: 16px 20px; margin-bottom: 20px;
          border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,.12); }
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #d0d7de; padding: 8px; text-align: left; }
  th { background: #eaeef2; }
  .kanan { text-align: right; }
  label { display: block; margin: 10px 0 4px; font-weight: bold; }
  input, select, textarea { padding: 7px; width: 100%;
                            box-sizing: border-box; }
  button, .btn { padding: 7px 14px; border: 0; border-radius: 4px;
                 background: #1f6feb; color: #fff; cursor: pointer;
                 text-decoration: none; display: inline-block; }
  .btn-merah { background: #cf222e; }
  .alert { padding: 10px 14px; border-radius: 4px;
           margin-bottom: 16px; }
  .alert.sukses { background: #dafbe1; border: 1px solid #4ac26b; }
  .alert.error  { background: #ffebe9; border: 1px solid #ff8182; }
</style>
</head>
<body>
<nav>
  <a href="penjualan.php?page=transaksi">Transaksi</a>
  <a href="penjualan.php?page=barang">Barang</a>
</nav>
<div class="container">
<?php tampilkan_flash(); ?>

<?php if ($page === 'barang'): ?>
<!-- ===== SOAL 3 : DAFTAR BARANG + TOMBOL HAPUS ===== -->
<div class="card">
  <h2>Daftar Barang</h2>
  <table>
    <tr>
      <th>Kode</th><th>Nama Barang</th><th class="kanan">Harga</th>
      <th class="kanan">Stok</th><th>Supplier</th>
      <th class="kanan">Dipakai di</th><th>Aksi</th>
    </tr>
    <?php foreach ($barang as $b): ?>
    <tr>
      <td><?= e($b['kode_barang']) ?></td>
      <td><?= e($b['nama_barang']) ?></td>
      <td class="kanan"><?= rupiah($b['harga']) ?></td>
      <td class="kanan"><?= e($b['stok']) ?></td>
      <td><?= e($b['nama_supplier']) ?></td>
      <td class="kanan"><?= e($b['jml_dipakai']) ?> transaksi</td>
      <td>
        <form method="post" action="penjualan.php" style="margin:0"
              onsubmit="return confirm('Yakin hapus barang ini?')">
          <input type="hidden" name="aksi" value="hapus_barang">
          <input type="hidden" name="barang_id"
                 value="<?= e($b['id']) ?>">
          <button class="btn-merah" type="submit">Hapus</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php elseif ($page === 'detail'): ?>
<!-- ===== SOAL 2 : HALAMAN MASTER-DETAIL ===== -->
<div class="card">
  <h2>Transaksi #<?= e($master['id']) ?> (Master)</h2>
  <table>
    <tr><th width="25%">Tanggal</th>
        <td><?= e($master['waktu_transaksi']) ?></td></tr>
    <tr><th>Pelanggan</th>
        <td><?= e($master['nama_pelanggan']) ?></td></tr>
    <tr><th>Keterangan</th>
        <td><?= e($master['keterangan']) ?></td></tr>
    <tr><th>Total</th>
        <td><b><?= rupiah($master['total']) ?></b></td></tr>
  </table>
  <p><a class="btn" href="penjualan.php?page=transaksi">
    &laquo; Kembali</a></p>
</div>

<div class="card">
  <h2>Detail Barang</h2>
  <table>
    <tr>
      <th>Kode</th><th>Nama Barang</th><th class="kanan">Harga</th>
      <th class="kanan">Qty</th><th class="kanan">Subtotal</th>
      <th>Aksi</th>
    </tr>
    <?php if (!$detail): ?>
      <tr><td colspan="6">Belum ada detail barang.</td></tr>
    <?php endif; ?>
    <?php foreach ($detail as $d): ?>
    <tr>
      <td><?= e($d['kode_barang']) ?></td>
      <td><?= e($d['nama_barang']) ?></td>
      <td class="kanan"><?= rupiah($d['harga']) ?></td>
      <td class="kanan"><?= e($d['qty']) ?></td>
      <td class="kanan"><?= rupiah($d['subtotal']) ?></td>
      <td>
        <form method="post" action="penjualan.php" style="margin:0"
              onsubmit="return confirm('Hapus barang ini?')">
          <input type="hidden" name="aksi" value="hapus_detail">
          <input type="hidden" name="transaksi_id"
                 value="<?= e($master['id']) ?>">
          <input type="hidden" name="barang_id"
                 value="<?= e($d['barang_id']) ?>">
          <button class="btn-merah" type="submit">Hapus</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <th colspan="4" class="kanan">TOTAL</th>
      <th class="kanan"><?= rupiah($master['total']) ?></th><th></th>
    </tr>
  </table>
</div>

<div class="card">
  <h2>Tambah Detail Barang</h2>
  <?php if (!$masih_ada): ?>
    <p>Semua barang sudah dimasukkan ke transaksi ini.</p>
  <?php else: ?>
  <form method="post" action="penjualan.php">
    <input type="hidden" name="aksi" value="tambah_detail">
    <input type="hidden" name="transaksi_id"
           value="<?= e($master['id']) ?>">

    <label for="barang_id">Barang</label>
    <select id="barang_id" name="barang_id" required>
      <option value="">-- Pilih Barang --</option>
      <?php foreach ($daftar_barang as $b): ?>
        <?php /* SOAL 2: barang yang sudah dipakai -> disabled */ ?>
        <?php $sudah = in_array((int)$b['id'], $dipakai, true); ?>
        <option value="<?= e($b['id']) ?>"
                data-harga="<?= e($b['harga']) ?>"
                <?= $sudah ? 'disabled' : '' ?>>
          <?= e($b['kode_barang'] . ' - ' . $b['nama_barang']) ?>
          <?= $sudah ? '(sudah dipilih)' : '' ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label for="harga">Harga Satuan</label>
    <input type="text" id="harga" readonly>

    <label for="qty">Qty</label>
    <input type="number" id="qty" name="qty" min="1"
           value="1" required>

    <p><button type="submit">Simpan Detail</button></p>
  </form>
  <script>
    // tampilkan harga barang yang dipilih
    var pilih = document.getElementById('barang_id');
    var harga = document.getElementById('harga');
    pilih.addEventListener('change', function () {
      var opt = pilih.options[pilih.selectedIndex];
      harga.value = opt.dataset.harga
        ? 'Rp ' + Number(opt.dataset.harga)
            .toLocaleString('id-ID') : '';
    });
  </script>
  <?php endif; ?>
</div>

<?php else: ?>
<!-- ===== SOAL 2 : HALAMAN MASTER (DAFTAR TRANSAKSI) ===== -->
<div class="card">
  <h2>Tambah Transaksi Baru</h2>
  <form method="post" action="penjualan.php">
    <input type="hidden" name="aksi" value="tambah_transaksi">

    <label for="waktu_transaksi">Tanggal</label>
    <input type="date" id="waktu_transaksi" name="waktu_transaksi"
           value="<?= date('Y-m-d') ?>" required>

    <label for="pelanggan_id">Pelanggan</label>
    <select id="pelanggan_id" name="pelanggan_id" required>
      <option value="">-- Pilih Pelanggan --</option>
      <?php foreach ($pelanggan as $p): ?>
        <option value="<?= e($p['id']) ?>">
          <?= e($p['id'] . ' - ' . $p['nama']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label for="keterangan">Keterangan</label>
    <textarea id="keterangan" name="keterangan" rows="2"></textarea>

    <p><button type="submit">Simpan &amp; Isi Detail</button></p>
  </form>
</div>

<div class="card">
  <h2>Daftar Transaksi</h2>
  <table>
    <tr>
      <th>ID</th><th>Tanggal</th><th>Pelanggan</th>
      <th>Keterangan</th><th class="kanan">Total</th><th>Aksi</th>
    </tr>
    <?php foreach ($transaksi as $t): ?>
    <tr>
      <td><?= e($t['id']) ?></td>
      <td><?= e($t['waktu_transaksi']) ?></td>
      <td><?= e($t['nama_pelanggan']) ?></td>
      <td><?= e($t['keterangan']) ?></td>
      <td class="kanan"><?= rupiah($t['total']) ?></td>
      <td>
        <a class="btn"
           href="penjualan.php?page=detail&amp;id=<?= e($t['id']) ?>">
          Detail</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php endif; ?>

</div>
</body>
</html>
