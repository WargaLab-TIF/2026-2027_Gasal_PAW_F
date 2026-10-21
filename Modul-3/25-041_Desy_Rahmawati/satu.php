<?php
//1.1
echo "1.1 <br>";
$fruits=array("Avocado","Blueberry","Chery");

array_push($fruits,"Durian","Elderberry","Fig","Grape","Honeydew");

//impolode guna menggabungkan nilai array jadi1 teks
echo 'fruits = ( "'. implode('", "', $fruits). '" )<br>';
echo 'Nilai dengan indeks tertinggi: '.  end($fruits);

echo "<br>"."<br>";

echo "1.2 <br>";
unset($fruits[1]);
echo 'Data Blueberry dihapus.<br>';
echo 'fruits = ( "'. implode('", "', $fruits). '" )<br>';
echo 'Nilai dengan indeks tertinggi: '.  end($fruits);
?>

