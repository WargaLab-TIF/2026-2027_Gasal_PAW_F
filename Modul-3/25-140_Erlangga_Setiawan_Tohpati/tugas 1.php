<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");
echo "fruits = ( ";
$lastIndex = count($fruits) - 1;
foreach ($fruits as $index => $fruit) {
    echo '"' . $fruit . '"';
    if ($index < $lastIndex) {
        echo ", ";
    }
}
echo ")<br>";
$highestIndexValue = $fruits[$lastIndex];
echo "Nilai dengan indeks tertinggi: " . $highestIndexValue;
?>
