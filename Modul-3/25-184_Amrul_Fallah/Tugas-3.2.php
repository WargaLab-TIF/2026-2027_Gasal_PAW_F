<?php

$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

echo "weight = ( ";
$i = 0;
foreach ($weight as $nama => $berat) {
    if ($i > 0) {
        echo ", ";
    }
    echo "\"$nama\"=>\"$berat\"";
    $i++;
}
echo " )<br>";

echo "Data kedua: " . $weight["Barry"];

?>
