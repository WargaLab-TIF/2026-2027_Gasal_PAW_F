<?php
$weight = array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

$data = array();

foreach ($weight as $nama => $berat) {
    $data[] = '"' . $nama . '"=>"' . $berat . '"';
}

echo "weight = (" . implode(", ", $data) . ")";
echo "<br>";
echo "<br>";

$nama = array_keys($weight);

for ($i = 0; $i < count($weight); $i++) {
    echo $nama[$i] . " is " . $weight[$nama[$i]] . " kg.";
    echo "<br>";
}
?>