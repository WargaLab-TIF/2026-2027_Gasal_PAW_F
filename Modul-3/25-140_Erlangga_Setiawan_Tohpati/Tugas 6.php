<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
echo "weight = ( ";
foreach ($weight as $key => $value) {
    echo '"' . $key . '"=>"' . $value . '"';
    if ($key !== array_key_last($weight)) {
        echo ", ";
    }
}
echo ")<br>";
$values = array_values($weight);
echo "Data kedua: " . $values[1];
?>