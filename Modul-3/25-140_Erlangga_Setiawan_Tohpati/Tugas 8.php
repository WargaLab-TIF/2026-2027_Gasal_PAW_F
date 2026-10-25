<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75");
echo "weight = ( ";
foreach ($weight as $key => $value) {
    echo '"' . $key . '"=>"' . $value . '"';
    if ($key !== array_key_last($weight)) {
        echo ", ";
    }
}
echo ")<br><br>";
$keys = array_keys($weight);
$values = array_values($weight);
$arrlength = count($weight);
for ($i = 0; $i < $arrlength; $i++) {
    echo $keys[$i] . " is " . $values[$i] . " kg.<br>";
}
?>