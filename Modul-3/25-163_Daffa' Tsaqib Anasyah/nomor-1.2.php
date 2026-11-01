<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

$hapus = $fruits[1]; // Menyimpan data yang dihapus
unset($fruits[1]);
$fruits = array_values($fruits); // Merapikan indeks

echo "Data " . $hapus . " dihapus.<br>";
echo "fruits = (\"" . implode('", "', $fruits) . "\")<br>";

$highest_index = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$highest_index];
?>