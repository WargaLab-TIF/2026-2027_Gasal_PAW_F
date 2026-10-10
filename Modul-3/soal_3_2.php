<?php
// Soal 3.2 
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

$items = array();
foreach ($weight as $key => $value) {
    $items[] = "\"" . $key . "\"=&gt;\"" . $value . "\"";
}
echo "weight = (" . implode(", ", $items) . ")<br>";

$nilai = array_values($weight);
echo "Data kedua: " . $nilai[1];
?>
