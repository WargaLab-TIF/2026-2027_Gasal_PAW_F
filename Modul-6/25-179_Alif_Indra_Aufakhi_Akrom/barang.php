
<?php
session_start();
require_once "koneksi.php";

function e($data) {
    return htmlspecialchars((string)$data, ENT_QUOTES, 'UTF-8');
}

$pesan = $_SESSION['pesan'] ?? '';
unset($_SESSION['pesan']);

// TAMBAH BARANG
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $kode = trim($_POST['kode_barang']);
    $nama = trim($_POST['nama_barang']);
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $supplier_id = (int)$_POST['supplier_id'];

    if ($kode === '' || $nama === '' || $harga < 0 || $stok < 0 || $supplier_id <= 0) {
        $_SESSION['pesan'] = "Data barang tidak valid!";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssiii", $kode, $nama, $harga, $stok, $supplier_id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['pesan'] = "Barang berhasil ditambahkan!";
        } else {
            $_SESSION['pesan'] = "Gagal menambahkan barang. Periksa kode barang!";
        }

        mysqli_stmt_close($stmt);
    }

    header("Location: barang.php");
    exit;
}

// HAPUS BARANG
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hapus'])) {
    $id = (int)$_POST['id'];

    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);

    if ($data['jumlah'] > 0) {
        $_SESSION['pesan'] = "Barang tidak bisa dihapus karena sudah digunakan dalam transaksi!";
    } else {
        $stmt = mysqli_prepare($conn, "DELETE FROM barang WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['pesan'] = "Barang berhasil dihapus!";
        } else {
            $_SESSION['pesan'] = "Gagal menghapus barang!";
        }

        mysqli_stmt_close($stmt);
    }

    header("Location: barang.php");
    exit;
}

// AMBIL DATA SUPPLIER DAN BARANG
$supplier = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama ASC");

$result = mysqli_query($conn, "
    SELECT barang.*, supplier.nama AS nama_supplier
    FROM barang
    LEFT JOIN supplier ON barang.supplier_id = supplier.id
    ORDER BY barang.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Pengelolaan Data Barang</h1>
        <p>Aplikasi Pengelolaan Master Detail Data</p>
    </header>

    <nav>
        <a href="barang.php" class="active">Data Barang</a>
        <a href="transaksi.php">Data Transaksi</a>
    </nav>

    <main>
        <?php if ($pesan !== ''): ?>
            <div class="pesan"><?= e($pesan) ?></div>
        <?php endif; ?>

        <section class="form-section">
            <h2>Tambah Barang</h2>

            <?php if (mysqli_num_rows($supplier) > 0): ?>
                <form method="POST" action="barang.php">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" name="kode_barang" placeholder="Contoh: BRG011" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" placeholder="Masukkan nama barang" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" min="0" placeholder="Masukkan harga" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" min="0" placeholder="Masukkan stok" required>
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id" required>
                            <option value="">Pilih Supplier</option>
                            <?php while ($s = mysqli_fetch_assoc($supplier)): ?>
                                <option value="<?= e($s['id']) ?>"><?= e($s['nama']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="tambah">Tambah Barang</button>
                </form>
            <?php else: ?>
                <p>Belum ada data supplier. Tambahkan supplier terlebih dahulu.</p>
            <?php endif; ?>
        </section>

        <section class="table-section">
            <h2>Daftar Barang</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th><th>Kode Barang</th><th>Nama Barang</th>
                            <th>Harga</th><th>Stok</th><th>Supplier</th><th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= e($row['kode_barang']) ?></td>
                                    <td><?= e($row['nama_barang']) ?></td>
                                    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td><?= e($row['stok']) ?></td>
                                    <td><?= e($row['nama_supplier']) ?></td>
                                    <td>
                                        <form method="POST" action="barang.php" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                            <input type="hidden" name="id" value="<?= e($row['id']) ?>">
                                            <button type="submit" name="hapus" class="btn-hapus">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="7">Belum ada data barang.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>
