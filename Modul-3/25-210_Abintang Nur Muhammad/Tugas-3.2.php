<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

$output_weight = array();
foreach ($weight as $nama => $berat) {
    $output_weight[] = '"' . $nama . '"=>"' . $berat . '"';
}
echo 'weight = (' . implode(', ', $output_weight) . ')<br>';
echo "Data kedua: " . $weight["Barry"];
?>