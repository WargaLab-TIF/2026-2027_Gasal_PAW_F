<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");

$keys = array_keys($weight);
$values = array_values($weight);
$length = count($weight);

print_r($weight);
echo "<br>";
for($i = 0; $i < $length; $i++) {
    echo $keys[$i] . " is " . $values[$i] . " kg.<br>";
}
?>