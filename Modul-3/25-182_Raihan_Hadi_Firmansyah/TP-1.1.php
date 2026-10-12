<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo 'fruits = ( "' . implode('", "', $fruits) . '")';
echo "<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[array_key_last($fruits)];
?>
