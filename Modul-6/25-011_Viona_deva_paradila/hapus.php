<?php
require_once("connect.php");

$id = ($_GET['id'] ?? -1);
$alert_message = "";

if ($id > -1) {
    $hasil = mysqli_query($conn, "SELECT COUNT(*) FROM transaksi_detail WHERE barang_id='$id'");
    $hasil = mysqli_fetch_row($hasil);
    if ($hasil[0] > 0) {
        echo "<script>alert('Barang tersebut masih digunakan pada transaksi dan tidak dapat dihapus!');</script>";
    } else {
        mysqli_query($conn, "DELETE FROM barang WHERE id ='$id'");
        // Redirect untuk membersihkan parameter GET setelah hapus sukses
        echo "<script>window.location.href='hapus.php';</script>";
        exit;
    }
}

$query = mysqli_query($conn, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus / Daftar Barang</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Material Symbols untuk ikon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light py-5">

    <div class="container" style="max-width: 800px;">
        
        <!-- Header & Tombol Kembali -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-bold text-dark m-0">HAPUS BARANG</h2>
        </div>

        <!-- Tabel Data Barang -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0" id="container-tabel">
                        <thead class="table-dark">
                            <tr>
                                <th class="transaksi" style="width: 10%;">NO</th>
                                <th class="transaksi" style="width: 65%;">NAMA BARANG</th>
                                <th class="transaksi text-center" style="width: 25%;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $has_data = false;
                            while ($row = mysqli_fetch_assoc($query)) {
                                $has_data = true;
                                $data = $row['id'];
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                    <td class="text-center">
                                        <a href='hapus.php?id=<?= $data; ?>' class="btn btn-danger btn-sm px-3 btn-hapus d-inline-flex align-items-center gap-1" onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                            <span class="material-symbols-outlined" style="font-size: 16px;">delete</span> HAPUS
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            if (!$has_data) {
                                echo '<tr><td colspan="3" class="text-center text-muted py-4">Belum ada data barang.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>