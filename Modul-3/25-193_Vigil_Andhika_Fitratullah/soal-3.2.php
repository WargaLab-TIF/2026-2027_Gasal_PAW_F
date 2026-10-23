<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
$pasangan = [];
foreach ($weight as $key => $value) {
    $pasangan[] = "\"$key\"=>\"$value\"";
}
echo "weight = (" . implode(", ", $pasangan) . ")<br>";
echo "Data kedua: ". $weight['Barry'];
?>