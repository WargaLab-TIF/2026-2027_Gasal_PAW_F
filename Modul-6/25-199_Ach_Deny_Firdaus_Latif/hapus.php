<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    $cek_relasi = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id = '$id_barang'");

    if (mysqli_num_rows($cek_relasi) > 0) {
        echo "<script>
                alert('Gagal Menghapus! Barang tidak boleh dihapus karena masih digunakan pada data transaksi.');
                window.location = 'daftar_barang.php';
              </script>";
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id = '$id_barang'");
        if ($hapus) {
            echo "<script>
                    alert('Data barang telah berhasil dihapus!');
                    window.location = 'daftar_barang.php';
                  </script>";
        } else {
            echo "Terjadi error internal saat menghapus data.";
        }
    }
}
?>
