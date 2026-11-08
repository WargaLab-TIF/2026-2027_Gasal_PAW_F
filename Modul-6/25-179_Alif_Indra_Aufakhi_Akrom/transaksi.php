
<?php
session_start();
require_once "koneksi.php";

function e($data) {
    return htmlspecialchars((string)$data, ENT_QUOTES, 'UTF-8');
}

$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']);
$id_transaksi = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// TAMBAH TRANSAKSI
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_transaksi'])) {
    $tanggal = $_POST['waktu_transaksi'];
    $keterangan = trim($_POST['keterangan']);
    $pelanggan_id = $_POST['pelanggan_id'];

    $stmt = mysqli_prepare($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, 0, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $tanggal, $keterangan, $pelanggan_id);

    if (mysqli_stmt_execute($stmt)) {
        $id_baru = mysqli_insert_id($conn);
        $_SESSION['pesan'] = "Transaksi berhasil dibuat!";
        mysqli_stmt_close($stmt);
        header("Location: transaksi.php?id=" . $id_baru);
        exit;
    }

    $_SESSION['pesan'] = "Gagal membuat transaksi!";
    mysqli_stmt_close($stmt);
    header("Location: transaksi.php");
    exit;
}

// TAMBAH DETAIL TRANSAKSI
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_detail'])) {
    $transaksi_id = (int)$_POST['transaksi_id'];
    $barang_id = (int)$_POST['barang_id'];
    $qty = (int)$_POST['qty'];

    if ($transaksi_id <= 0 || $barang_id <= 0 || $qty <= 0) {
        $_SESSION['pesan'] = "Data detail transaksi tidak valid!";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id FROM transaksi WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $transaksi_id);
        mysqli_stmt_execute($stmt);
        $cek = mysqli_stmt_get_result($stmt);
        $transaksi_ada = mysqli_num_rows($cek) > 0;
        mysqli_stmt_close($stmt);

        $stmt = mysqli_prepare($conn, "SELECT harga FROM barang WHERE id = ? AND NOT EXISTS (SELECT 1 FROM transaksi_detail WHERE transaksi_id = ? AND barang_id = ?)");
        mysqli_stmt_bind_param($stmt, "iii", $barang_id, $transaksi_id, $barang_id);
        mysqli_stmt_execute($stmt);
        $barang = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);

        if (!$transaksi_ada) {
            $_SESSION['pesan'] = "Transaksi tidak ditemukan!";
        } elseif (!$barang) {
            $_SESSION['pesan'] = "Barang tidak tersedia atau sudah digunakan dalam transaksi ini!";
        } else {
            $harga = (int)$barang['harga'];
            mysqli_begin_transaction($conn);

            try {
                $stmt = mysqli_prepare($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES (?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "iiii", $transaksi_id, $barang_id, $harga, $qty);

                if (!mysqli_stmt_execute($stmt)) throw new Exception("Gagal menambahkan detail barang!");
                mysqli_stmt_close($stmt);

                $stmt = mysqli_prepare($conn, "UPDATE transaksi SET total = (SELECT COALESCE(SUM(harga * qty), 0) FROM transaksi_detail WHERE transaksi_id = ?) WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "ii", $transaksi_id, $transaksi_id);

                if (!mysqli_stmt_execute($stmt)) throw new Exception("Gagal memperbarui total transaksi!");
                mysqli_stmt_close($stmt);

                mysqli_commit($conn);
                $_SESSION['pesan'] = "Detail transaksi berhasil ditambahkan dan total diperbarui!";
            } catch (Throwable $error) {
                mysqli_rollback($conn);
                $_SESSION['pesan'] = $error->getMessage();
            }
        }
    }

    header("Location: transaksi.php?id=" . $transaksi_id);
    exit;
}

// AMBIL DATA
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama ASC");

$result_transaksi = mysqli_query($conn, "
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY transaksi.id DESC
");

$transaksi_terpilih = null;
$result_detail = null;
$barang_tersedia = null;

if ($id_transaksi > 0) {
    $stmt = mysqli_prepare($conn, "SELECT transaksi.*, pelanggan.nama AS nama_pelanggan FROM transaksi LEFT JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id WHERE transaksi.id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
    mysqli_stmt_execute($stmt);
    $transaksi_terpilih = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);

    if ($transaksi_terpilih) {
        $stmt = mysqli_prepare($conn, "SELECT transaksi_detail.*, barang.kode_barang, barang.nama_barang FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id WHERE transaksi_detail.transaksi_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
        mysqli_stmt_execute($stmt);
        $result_detail = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        $stmt = mysqli_prepare($conn, "SELECT * FROM barang WHERE NOT EXISTS (SELECT 1 FROM transaksi_detail WHERE transaksi_detail.barang_id = barang.id AND transaksi_detail.transaksi_id = ?) ORDER BY nama_barang ASC");
        mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
        mysqli_stmt_execute($stmt);
        $barang_tersedia = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Pengelolaan Data Transaksi</h1>
        <p>Aplikasi Pengelolaan Master Detail Data</p>
    </header>

    <nav>
        <a href="barang.php">Data Barang</a>
        <a href="transaksi.php" class="active">Data Transaksi</a>
    </nav>

    <main>
        <?php if ($pesan !== ''): ?>
            <div class="pesan"><?= e($pesan) ?></div>
        <?php endif; ?>

        <section class="form-section">
            <h2>Buat Transaksi Baru</h2>
            <?php if (mysqli_num_rows($pelanggan) > 0): ?>
                <form method="POST" action="transaksi.php">
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="date" name="waktu_transaksi" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="pelanggan_id" required>
                            <option value="">Pilih Pelanggan</option>
                            <?php while ($p = mysqli_fetch_assoc($pelanggan)): ?>
                                <option value="<?= e($p['id']) ?>"><?= e($p['nama']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" placeholder="Keterangan transaksi"></textarea>
                    </div>
                    <button type="submit" name="tambah_transaksi">Buat Transaksi</button>
                </form>
            <?php else: ?>
                <p>Belum ada data pelanggan.</p>
            <?php endif; ?>
        </section>

        <section class="table-section">
            <h2>Daftar Transaksi</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th><th>ID Transaksi</th><th>Tanggal</th>
                            <th>Pelanggan</th><th>Total</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result_transaksi) > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($t = mysqli_fetch_assoc($result_transaksi)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= e($t['id']) ?></td>
                                    <td><?= e($t['waktu_transaksi']) ?></td>
                                    <td><?= e($t['nama_pelanggan']) ?></td>
                                    <td>Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                                    <td><a class="btn-detail" href="transaksi.php?id=<?= e($t['id']) ?>">Kelola Detail</a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6">Belum ada transaksi.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <?php if ($id_transaksi > 0): ?>
            <?php if ($transaksi_terpilih): ?>
                <section class="form-section">
                    <h2>Detail Transaksi #<?= e($transaksi_terpilih['id']) ?></h2>
                    <p><strong>Pelanggan:</strong> <?= e($transaksi_terpilih['nama_pelanggan']) ?></p>
                    <p><strong>Tanggal:</strong> <?= e($transaksi_terpilih['waktu_transaksi']) ?></p>
                    <p><strong>Keterangan:</strong> <?= e($transaksi_terpilih['keterangan']) ?></p>

                    <h3>Tambah Barang ke Transaksi</h3>
                    <?php if (mysqli_num_rows($barang_tersedia) > 0): ?>
                        <form method="POST" action="transaksi.php?id=<?= $id_transaksi ?>">
                            <input type="hidden" name="transaksi_id" value="<?= $id_transaksi ?>">
                            <div class="form-group">
                                <label>Pilih Barang</label>
                                <select name="barang_id" required>
                                    <option value="">Pilih Barang</option>
                                    <?php while ($b = mysqli_fetch_assoc($barang_tersedia)): ?>
                                        <option value="<?= e($b['id']) ?>">
                                            <?= e($b['kode_barang']) ?> - <?= e($b['nama_barang']) ?> (Rp <?= number_format($b['harga'], 0, ',', '.') ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="number" name="qty" min="1" value="1" required>
                            </div>
                            <button type="submit" name="tambah_detail">Tambahkan Barang</button>
                        </form>
                    <?php else: ?>
                        <p>Semua barang sudah digunakan dalam transaksi ini atau belum ada barang tersedia.</p>
                    <?php endif; ?>
                </section>

                <section class="table-section">
                    <h2>Daftar Detail Barang</h2>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th><th>Kode Barang</th><th>Nama Barang</th>
                                    <th>Harga</th><th>Qty</th><th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($result_detail) > 0): ?>
                                    <?php $no = 1; ?>
                                    <?php while ($d = mysqli_fetch_assoc($result_detail)): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= e($d['kode_barang']) ?></td>
                                            <td><?= e($d['nama_barang']) ?></td>
                                            <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                                            <td><?= e($d['qty']) ?></td>
                                            <td>Rp <?= number_format($d['harga'] * $d['qty'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="6">Belum ada detail barang.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <h3>Total Transaksi: Rp <?= number_format($transaksi_terpilih['total'], 0, ',', '.') ?></h3>
                </section>
            <?php else: ?>
                <div class="pesan">Transaksi dengan ID tersebut tidak ditemukan.</div>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</div>
</body>
</html>
