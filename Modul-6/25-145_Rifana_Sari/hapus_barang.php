
<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: barang.php");
    exit;
}

$id = (int) $_GET['id'];

if ($id <= 0) {
    header("Location: barang.php");
    exit;
}

$query_cek = "
    SELECT barang_id
    FROM transaksi_detail
    WHERE barang_id = ?
";

$stmt_cek = mysqli_prepare($koneksi, $query_cek);
mysqli_stmt_bind_param($stmt_cek, "i", $id);
mysqli_stmt_execute($stmt_cek);

$result_cek = mysqli_stmt_get_result($stmt_cek);

if (mysqli_num_rows($result_cek) > 0) {

    echo "<script>
        alert('Barang tidak dapat dihapus karena sudah digunakan dalam transaksi.');
        window.location='barang.php';
    </script>";

    exit;

} else {
    $query_hapus = "DELETE FROM barang WHERE id = ?";

    $stmt_hapus = mysqli_prepare($koneksi, $query_hapus);
    mysqli_stmt_bind_param($stmt_hapus, "i", $id);

    if (mysqli_stmt_execute($stmt_hapus)) {

        echo "<script>
            alert('Barang berhasil dihapus.');
            window.location='barang.php';
        </script>";

    } else {

        echo "<script>
            alert('Barang gagal dihapus.');
            window.location='barang.php';
        </script>";
    }

}
?>
