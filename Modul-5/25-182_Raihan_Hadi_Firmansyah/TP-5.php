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

$result = mysqli_query($conn, "SHOW COLUMNS FROM `$tabel`");
$kolom = array();
$primary_key = array();

while ($row = mysqli_fetch_assoc($result)) {
    $kolom[] = $row['Field'];

    if ($row['Key'] == 'PRI') {
        $primary_key[] = $row['Field'];
    }
}

$kondisi = array();

foreach ($primary_key as $field) {
    if (!isset($_GET[$field])) {
        die("Primary key tidak lengkap.");
    }

    $nilai_id = mysqli_real_escape_string($conn, $_GET[$field]);
    $kondisi[] = "`$field`='$nilai_id'";
}

$where = implode(" AND ", $kondisi);
$result = mysqli_query($conn, "SELECT * FROM `$tabel` WHERE $where");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan.");
}

if (isset($_POST['simpan'])) {
    $perubahan = array();
    foreach ($kolom as $field) {
        if (!in_array($field, $primary_key)) {
            $nilai = mysqli_real_escape_string($conn, $_POST[$field]);
            $perubahan[] = "`$field`='$nilai'";
        }
    }
    if (count($perubahan) > 0) {
        $query = "UPDATE `$tabel` SET " . implode(", ", $perubahan) .
                 " WHERE $where";
        if (mysqli_query($conn, $query)) {
            header("Location: TP-3.php?tabel=" . urlencode($tabel));
            exit;
        } else {
            echo "Gagal mengubah data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>
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
<h2>Edit Data <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $tabel))); ?></h2>
<hr>

<div class="form">
    <form method="POST">
        <?php
        foreach ($kolom as $field) {
            echo '<div class="baris">';
            echo '<label>' . htmlspecialchars($field) . '</label>';

            echo '<input type="text" name="' . htmlspecialchars($field) . '"';
            echo ' value="' . htmlspecialchars((string)$data[$field]) . '"';

            if (in_array($field, $primary_key)) {
                echo ' readonly';
            }

            echo ' required>';
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