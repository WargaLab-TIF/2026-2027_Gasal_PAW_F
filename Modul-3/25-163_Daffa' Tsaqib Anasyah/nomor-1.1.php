<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Menambahkan lima data baru
$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

echo "fruits = (\"" . implode('", "', $fruits) . "\")<br>";

// Menampilkan nilai dengan indeks tertinggi
$highest_index = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi: " . $fruits[$highest_index];
?>