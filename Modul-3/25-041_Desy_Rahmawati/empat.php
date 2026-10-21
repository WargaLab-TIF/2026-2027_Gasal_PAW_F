<?php
echo "4.1 <br>";
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170",
    "David" => "180",
    "Ethan" => "172",
    "Frank" => "168",
    "George" => "175",
    "Harry" => "182"
);
$weight=array(
    "Andy" => "70",
    "Barry" => "65",
    "Charlie" => "75"
);

$data = [];
foreach ($height as $key => $value) {
    $data[] = '"' . $key . '"=>"' . $value . '"';
}

echo 'height = (' . implode(', ', $data) . ')<br>';
echo "<br>";
foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
};
echo "<br>"."<br>";
$data = [];
foreach ($weight as $key => $value) {
    $data[] = '"' . $key . '"=>"' . $value . '"';
}

echo "3.2 <br>";
echo 'weight = (' . implode(', ', $data) . ')<br>';
echo "<br>";
foreach ($weight as $nama => $berat) {
    echo $nama . " is " . $berat . " kg.<br>";
};

?>