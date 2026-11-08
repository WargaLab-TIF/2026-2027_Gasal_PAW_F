<?php

$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

unset($fruits[1]);
echo "Data Blueberry dihapus.<br>";

echo "fruits = ( ";
$i = 0;
foreach ($fruits as $buah) {
    if ($i > 0) {
        echo ", ";
    }
    echo '"'.$buah.'"';
    $i++;
}
echo " )<br>";

echo "Nilai dengan indeks tertinggi: " . $fruits[array_key_last($fruits)];

?>
