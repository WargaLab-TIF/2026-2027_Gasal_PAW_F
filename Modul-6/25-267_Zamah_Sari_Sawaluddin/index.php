<?php
include "koneksi.php";
include "pengaturan.php";

$tabel = "dashboard";
if (isset($_GET["tabel"])) {
    $tabel = $_GET["tabel"];
}

if ($tabel != "dashboard" && !isset($daftar_tabel[$tabel])) {
    $tabel = "dashboard";
}

$pesan = "";
if (isset($_GET["pesan"])) {
    if ($_GET["pesan"] == "tambah") {
        $pesan = "Data berhasil ditambahkan.";
    } else if ($_GET["pesan"] == "edit") {
        $pesan = "Data berhasil diubah.";
    } else if ($_GET["pesan"] == "hapus") {
        $pesan = "Data berhasil dihapus.";
    } else if ($_GET["pesan"] == "gagal") {
        $pesan = "Data tidak dapat dihapus karena masih digunakan oleh data lain.";
    } else if ($_GET["pesan"] == "barang_dipakai") {
        $pesan = "Barang tidak dapat dihapus karena sudah digunakan pada detail transaksi.";
    }
}

$aksi_ditampilkan = ($tabel != "transaksi_detail");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">PENJUALAN<small>DATABASE MANAGEMENT</small></div>
        <div class="menu-title">Menu Utama</div>
        <a class="menu-link <?php if ($tabel == 'dashboard') echo 'active'; ?>" href="index.php">⌂ &nbsp; Dashboard</a>
        <div class="menu-title">Data Master</div>
        <?php
        foreach ($daftar_tabel as $nama_tabel => $isi_tabel) {
            if ($isi_tabel["kelompok"] == "Data Master") {
                ?>
                <a class="menu-link <?php if ($tabel == $nama_tabel) echo 'active'; ?>" href="index.php?tabel=<?php echo $nama_tabel; ?>">▤ &nbsp; <?php echo $isi_tabel["judul"]; ?></a>
                <?php
            }
        }
        ?>
        <div class="menu-title">Data Transaksi</div>
        <?php
        foreach ($daftar_tabel as $nama_tabel => $isi_tabel) {
            if ($isi_tabel["kelompok"] == "Data Transaksi") {
                ?>
                <a class="menu-link <?php if ($tabel == $nama_tabel) echo 'active'; ?>" href="index.php?tabel=<?php echo $nama_tabel; ?>">▤ &nbsp; <?php echo $isi_tabel["judul"]; ?></a>
                <?php
            }
        }
        ?>
    </aside>

    <main class="main">
        <?php if ($tabel == "dashboard") { ?>
            <div class="topline">
                <div>
                    <h1>Dashboard</h1>
                    <p class="muted">Selamat datang di aplikasi pengelolaan data penjualan.</p>
                </div>
                <div class="small">Database: penjualan</div>
            </div>

            <div class="cards">
                <?php
                foreach ($daftar_tabel as $nama_tabel => $isi_tabel) {
                    $hasil_jumlah = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM `$nama_tabel`");
                    $data_jumlah = mysqli_fetch_assoc($hasil_jumlah);
                    ?>
                    <a class="card" href="index.php?tabel=<?php echo $nama_tabel; ?>">
                        <span class="label"><?php echo $isi_tabel["judul"]; ?></span>
                        <span class="number"><?php echo $data_jumlah["jumlah"]; ?></span>
                    </a>
                    <?php
                }
                ?>
            </div>

            <div class="panel">
                <h2>Informasi Aplikasi</h2>
                <p class="muted">Aplikasi ini digunakan untuk mengelola data pelanggan, supplier, barang, user, transaksi, detail transaksi, dan pembayaran.</p>
                <p class="muted">Pilih salah satu menu di sebelah kiri untuk melihat dan mengelola data.</p>
            </div>
        <?php } else { ?>
            <div class="topline">
                <div>
                    <h1><?php echo $daftar_tabel[$tabel]["judul"]; ?></h1>
                    <p class="muted">Menampilkan data dari tabel <?php echo $tabel; ?>.</p>
                </div>
                <?php if ($aksi_ditampilkan) { ?>
                    <a class="btn btn-blue" href="tambah.php?tabel=<?php echo $tabel; ?>">+ Tambah Data</a>
                <?php } ?>
            </div>

            <?php if ($pesan != "") { ?>
                <div class="alert"><?php echo $pesan; ?></div>
            <?php } ?>

            <div class="panel">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($daftar_tabel[$tabel]["kolom"] as $kolom) { ?>
                                    <th><?php echo $kolom; ?></th>
                                <?php } ?>
                                <?php if ($aksi_ditampilkan) { ?>
                                    <th>Aksi</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $hasil = mysqli_query($koneksi, "SELECT * FROM `$tabel`");
                            if (mysqli_num_rows($hasil) > 0) {
                                while ($data = mysqli_fetch_assoc($hasil)) {
                                    ?>
                                    <tr>
                                        <?php foreach ($daftar_tabel[$tabel]["kolom"] as $kolom) { ?>
                                            <td><?php echo htmlspecialchars($data[$kolom] ?? ""); ?></td>
                                        <?php } ?>

                                        <?php if ($aksi_ditampilkan) { ?>
                                            <td>
                                                <div class="actions">
                                                    <?php if ($tabel == "transaksi") { ?>
                                                        <a class="btn btn-blue" href="transaksi_detail.php?transaksi_id=<?php echo $data["id"]; ?>">Detail</a>
                                                    <?php } ?>
                                                    <a class="btn btn-light" href="edit.php?tabel=<?php echo $tabel; ?><?php foreach ($daftar_tabel[$tabel]["primary"] as $kunci) { ?>&<?php echo $kunci; ?>=<?php echo urlencode($data[$kunci]); ?><?php } ?>">Edit</a>
                                                    <form action="hapus.php" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                        <input type="hidden" name="tabel" value="<?php echo $tabel; ?>">
                                                        <?php foreach ($daftar_tabel[$tabel]["primary"] as $kunci) { ?>
                                                            <input type="hidden" name="<?php echo $kunci; ?>" value="<?php echo htmlspecialchars($data[$kunci]); ?>">
                                                        <?php } ?>
                                                        <button type="submit" class="btn btn-red">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="empty" colspan="<?php echo count($daftar_tabel[$tabel]["kolom"]) + ($aksi_ditampilkan ? 1 : 0); ?>">Belum ada data.</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </main>
</div>
</body>
</html>