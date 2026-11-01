<?php
include 'koneksi.php';

$daftar_tabel = array(
    'pelanggan',
    'transaksi',
    'transaksi_detail',
    'barang',
    'supplier',
    'user',
    'pembayaran'
);

$tabel = isset($_GET['tabel']) ? $_GET['tabel'] : '';

if (!in_array($tabel, $daftar_tabel)) {
    die("Tabel tidak ditemukan.");
}

$query = "SHOW COLUMNS FROM `$tabel`";
$result = mysqli_query($conn, $query);

$kolom = array();

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['Extra'] != 'auto_increment') {
        $kolom[] = $row['Field'];
    }
}

if (isset($_POST['simpan'])) {
    $nama_kolom = array();
    $nilai = array();

    foreach ($kolom as $field) {
        $nama_kolom[] = "`$field`";
        $nilai[] = "'" . mysqli_real_escape_string($conn, $_POST[$field]) . "'";
    }

    $query = "INSERT INTO `$tabel` (" . implode(", ", $nama_kolom) .
             ") VALUES (" . implode(", ", $nilai) . ")";

    if (mysqli_query($conn, $query)) {
        header("Location: TP-3.php?tabel=" . urlencode($tabel));
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #555;
        }
        h2 {
            color: #568da5;
            font-weight: normal;
        }
        .form {
            width: 450px;
            margin: 40px auto;
        }
        .baris {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        label {
            width: 120px;
            text-align: right;
            margin-right: 15px;
        }
        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 220px;
        }
        button, .batal {
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        button {
            background: #75ad43;
        }
        .batal {
            background: #c82333;
        }
    </style>
</head>
<body>
<h2>Tambah Data Master <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $tabel))); ?> Baru</h2>
<hr>

<div class="form">
    <form method="POST">
        <?php
        foreach ($kolom as $field) {
            echo '<div class="baris">';
            echo '<label>' . htmlspecialchars($field) . '</label>';
            echo '<input type="text" name="' . htmlspecialchars($field) . '" placeholder="' . htmlspecialchars($field) . '" required>';
            echo '</div>';
        }
        ?>

        <div style="margin-left: 135px;">
            <button type="submit" name="simpan">Simpan</button>
            <a href="TP-3.php?tabel=<?php echo urlencode($tabel); ?>" class="batal">Batal</a>
        </div>
    </form>
</div>
</body>
</html>