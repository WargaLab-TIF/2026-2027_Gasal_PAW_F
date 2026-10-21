<?php
// 1.1
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo 'fruits = ( "' . $fruits[0] . '", "' . $fruits[1] . '", "' . $fruits[2] . '", "' . $fruits[3] . '", "' . $fruits[4] . '", "' . $fruits[5] . '", "' . $fruits[6] . '", "' . $fruits[7] . '")<br>';

echo "Nilai dengan indeks tertinggi: " . $fruits[7];
echo "<br><br>";

// 1.2
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

array_splice($fruits, 1, 1);

echo "Data Blueberry dihapus.<br>";

echo 'fruits = ( "' . $fruits[0] . '", "' . $fruits[1] . '", "' . $fruits[2] . '", "' . $fruits[3] . '", "' . $fruits[4] . '", "' . $fruits[5] . '", "' . $fruits[6] . '")<br>';

echo "Nilai dengan indeks tertinggi: " . $fruits[6];
?>