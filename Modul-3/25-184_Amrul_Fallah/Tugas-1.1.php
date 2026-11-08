<?php

$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Durian";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

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
