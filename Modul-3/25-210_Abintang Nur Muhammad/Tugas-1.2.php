<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

unset($fruits[1]);
$fruits = array_values($fruits);

echo "Data Blueberry dihapus.<br>";
echo 'fruits = ( "' . implode('", "', $fruits) . '" )<br>';
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];
?>