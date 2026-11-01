<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
$keys = array_keys($weight);
$weightLength = count($weight);

for($i = 0; $i < $weightLength; $i++) {
    $nama = $keys[$i];
    echo $nama . " is " . $weight[$nama] . " kg.<br>";
}
?>