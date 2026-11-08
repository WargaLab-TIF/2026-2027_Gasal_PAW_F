<?php
    $hostserver = "localhost";
    $username = "root";
    $password = "";
    $db = "penjualan";

    $conn = mysqli_connect($hostserver, $username, $password, $db);
    
    if(!$conn){
        die("koneksi gagal!".mysqli_connect_error());
    }
?>