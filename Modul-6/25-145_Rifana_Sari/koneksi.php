<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "penjualan";

try {
    $koneksi = mysqli_connect(
        $servername,
        $username,
        $password,
        $database
    );

    if (!$koneksi) {
        throw new mysqli_sql_exception(mysqli_connect_error());
    }

} catch (mysqli_sql_exception $e) {
    die("Koneksi Gagal: " . $e->getMessage());
}
?>