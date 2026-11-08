
<?php
include 'koneksi.php';

$id = $_GET['id'];

$cek = mysqli_query($koneksi, "
    SELECT * FROM transaksi_detail
    WHERE id_barang = '$id'
");

if (mysqli_num_rows($cek) > 0) {

    echo "<script>
        alert('Barang tidak dapat dihapus karena sudah digunakan dalam transaksi!');
        window.location='barang.php';
    </script>";

} else {

    $hapus = mysqli_query($koneksi, "
        DELETE FROM barang
        WHERE id_barang = '$id'
    ");

    if ($hapus) {
        echo "<script>
            alert('Data barang berhasil dihapus!');
            window.location='barang.php';
        </script>";
    } else {
        echo "<script>
            alert('Data barang gagal dihapus!');
            window.location='barang.php';
        </script>";
    }
}
?>
