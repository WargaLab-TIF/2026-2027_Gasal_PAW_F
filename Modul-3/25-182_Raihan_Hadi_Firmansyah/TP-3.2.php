<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
$data = array();

foreach ($weight as $nama => $berat) {
    $data[] = '"' . $nama . '"=>"' . $berat . '"';
}

echo "weight = (" . implode(", ", $data) . ")";
echo "<br>";

echo "Data kedua: " . $weight["Barry"];
?>