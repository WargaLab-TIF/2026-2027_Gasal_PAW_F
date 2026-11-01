<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

echo "weight = ";
print_r($weight);
echo "<br>";

$values = array_values($weight);
echo "Data kedua: " . $values[1]; // Indeks 1 merepresentasikan data kedua
?>