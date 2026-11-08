<?php
try{
    $db = mysqli_connect("localhost","root","","penjualan_modul6");
    
}catch(mysqli_sql_exception $e){
    die('Connection failed: ' . $e->getMessage());
}

?>