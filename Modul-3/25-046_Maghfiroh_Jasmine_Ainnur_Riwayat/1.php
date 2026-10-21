<?php
//1.1
$fruits = ["Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew"];

echo 'fruits = ( "' . implode('", "', $fruits) . '" )<br>';
echo "Nilai dengan indeks tertinggi: " . end($fruits) . "<br><br>";

//1.2
unset($fruits[1]);
$fruits = array_values($fruits);

echo "Data Blueberry dihapus.<br>";
echo 'fruits = ( "' . implode('", "', $fruits) . '" )<br>';
echo "Nilai dengan indeks tertinggi: " . end($fruits);
?>