<?php
// Soal 1.2 
$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

unset($fruits[1]);
echo "Data Blueberry dihapus.<br>";

echo "fruits = ( \"" . implode("\", \"", $fruits) . "\" )<br>";

$indeksTertinggi = array_key_last($fruits);
echo "Nilai dengan indeks tertinggi: " . $fruits[$indeksTertinggi];
?>
