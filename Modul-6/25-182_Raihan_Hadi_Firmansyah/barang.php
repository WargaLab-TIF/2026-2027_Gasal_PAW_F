<?php
include 'koneksi.php';

$pesan = "";
$warna = "";

// Proses hapus barang
if (isset($_GET['hapus_id'])) {
    $id_barang = (int) $_GET['hapus_id'];

    // Mengecek barang pada transaksi_detail
    $q_cek = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transaksi_detail WHERE barang_id = '$id_barang'");
    $d_cek = mysqli_fetch_assoc($q_cek);

    if ($d_cek['jumlah'] > 0) {
        $pesan = "Gagal menghapus! Barang masih digunakan pada transaksi.";
        $warna = "merah";
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id = '$id_barang'");

        if ($hapus) {
            $pesan = "Data barang berhasil dihapus.";
            $warna = "hijau";
        } else {
            $pesan = "Data barang gagal dihapus.";
            $warna = "merah";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            padding: 15px 25px;
            color: #555;
            font-size: 13px;
        }

        h2 {
            color: #56849c;
            font-size: 18px;
            font-weight: normal;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        p {
            margin: 20px 0;
        }

        a {
            text-decoration: none;
        }

        .tombol-kembali {
            background-color: #7cb342;
            color: white;
            padding: 7px 12px;
            border-radius: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 9px 6px;
            text-align: left;
        }

        th {
            background-color: #d9edf7;
            color: #555;
        }

        .tombol-hapus {
            background-color: #d9534f;
            color: white;
            padding: 7px 12px;
            border-radius: 3px;
        }

        .merah {
            color: red;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .hijau {
            color: green;
            margin-bottom: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>Data Master Barang</h2>

    <p>
        <a href="transaksi.php" class="tombol-kembali">
            Kembali ke Master-Detail Transaksi
        </a>
    </p>

    <?php
    if ($pesan != "") {
        echo "<div class='$warna'>$pesan</div>";
    }
    ?>

    <table>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Tindakan</th>
        </tr>

        <?php
        $q_barang = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id ASC");

        $no = 1;

        while ($row = mysqli_fetch_assoc($q_barang)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . htmlspecialchars($row['kode_barang']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
            echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
            echo "<td>" . $row['stok'] . "</td>";
            echo "<td>
                    <a href='barang.php?hapus_id=" . $row['id'] . "'
                       class='tombol-hapus'
                       onclick=\"return confirm('Yakin ingin menghapus barang ini?')\">
                       Hapus
                    </a>
                  </td>";
            echo "</tr>";

            $no++;
        }
        ?>
    </table>
</body>
</html>