<?php
$conn = mysqli_connect("localhost","root","","penjualan");
if (!$conn){
    die ("Koneksi Gagal : ".mysqli_connect_error());
}
?>