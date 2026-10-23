<?php
// 1.1
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo "fruits = ( ". '"';
echo implode('", "', $fruits) . '")';
echo "<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];
echo "<br>";

// 1.2
$dihapus=$fruits[1];
unset($fruits[1]);
echo "<br>Data $dihapus dihapus<br>";
$x=array_values($fruits);
echo "fruits = ( ". '"';
echo implode('", "', $fruits) . '")';
echo "<br>";
echo "Nilai dengan indeks tertinggi: " . $x[count($x) - 1];
?>