<?php
// Soal 4.2 
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

$items = array();
foreach ($weight as $key => $value) {
    $items[] = "\"" . $key . "\"=&gt;\"" . $value . "\"";
}
echo "weight = (" . implode(", ", $items) . ")<br><br>";

$names = array_keys($weight);
$jumlah = count($names);

for ($i = 0; $i < $jumlah; $i++) {
    $nama = $names[$i];
    echo $nama . " is " . $weight[$nama] . " kg.<br>";
}
?>
