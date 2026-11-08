<?php
include('koneksi.php');

$pesan = "";

//hapus barang
if(isset($_POST['hapus'])){
    $idh = (int)$_POST['hapus'];

    $sqlh = mysqli_query($con,"select count(*) jumlah from transaksi_detail where barang_id = $idh");
    $hasilh = mysqli_fetch_assoc($sqlh);

    if($hasilh['jumlah'] > 0 ){
        $pesan = "Barang gak bisa di hapus karena masih digunakan dalam Transaksi!";
    }else{
        mysqli_query($con,"delete from barang where id = $idh");
        $pesan = '';
    }
}


//tampil barang
$sql = "select * from barang";
$hasil = mysqli_query($con,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>

        body{
            background-color: #f3f5f7;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($pesan != '') {?>
        <script>alert("<?= $pesan ?>");</script>
    <?php } ?>

    <button type="button" onclick="location.href='transaksi.php'">Kembali</button>

    <!-- tabel barang -->
    <div class="barang" style="background-color: #e3f0f5; color: #1f2933; border: 6px solid #2f7f8f; width: 700px; margin-top: 20px; padding: 8px 16px 20px 16px;">
        <h4 style="color: #2f7f8f; text-align: center;">Data barang</h4>
        <form method="post" action="">
        <table border="1px" cellpadding = 4 cellspacing=0 style="width: 100%;">
            <tr style="background-color: #2f7f8f; color: white;">
                <th>id</th>
                <th>kode barang</th>
                <th>nama barang</th>
                <th>harga</th>
                <th>stok</th>
                <th>id supplier</th>
                <th>Aksi</th>
            </tr>
            <?php
            while($baris = mysqli_fetch_assoc($hasil)){
                echo "<tr style='background-color: white; color: #1f2933;'>";

                echo "<td>";
                echo $baris['id'];
                echo "</td>";

                echo "<td>";
                echo $baris['kode_barang'];
                echo "</td>";

                echo "<td>";
                echo $baris['nama_barang'];
                echo "</td>";

                echo "<td>";
                echo $baris['harga'];
                echo "</td>";

                echo "<td>";
                echo $baris['stok'];
                echo "</td>";

                echo "<td>";
                echo $baris['supplier_id'];
                echo "</td>";

                echo "<td>";
                echo '<button type="submit" name="hapus" value="' . $baris['id'] . '">Hapus</button>';
                echo "</td>";

                echo "</tr>";
            }
            ?>
        </table>
        </form>
    </div>
</body>
</html>
