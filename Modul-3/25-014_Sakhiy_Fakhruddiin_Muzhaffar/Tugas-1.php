<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

var_dump($fruits);
echo "<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[7];

echo "<br><br>";

echo "Data " . $fruits[1] . " dihapus <br>";
unset($fruits[1]);

$fruits = array_values($fruits);
var_dump($fruits);
echo "<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[6];
?>