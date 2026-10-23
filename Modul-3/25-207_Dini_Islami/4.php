<?php
// 4.1
$height = array(
    "Andy" => "176",
    "Barry" => "165",
    "Charlie" => "170"
);

$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";

print_r($height);
echo '<br>';
foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall<br>";
}
echo '<br>';

// 4.2
$weight = array(
    "Andy" => "60",
    "Barry" => "55",
    "Charlie" => "65"
);
print_r($weight);
echo '<br>';
$nama = array_keys($weight);
$arrlength = count($weight);
for ($x = 0; $x < $arrlength; $x++) {
    echo $nama[$x] . " is " . $weight[$nama[$x]] . " kg<br>";
}
?>