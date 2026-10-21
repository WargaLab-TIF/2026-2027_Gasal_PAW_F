<?php
// 4.1
$height = array(
    "Andy" => 176,
    "Barry" => 165,
    "Charlie" => 170
);

$height["Darren"] = 180;
$height["Ethan"] = 175;
$height["Farah"] = 168;
$height["Grace"] = 172;
$height["Harry"] = 178;

echo 'height = ("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170", "David"=>"180", "Ethan"=>"172", "Frank"=>"168", "George"=>"175", "Harry"=>"182")';
echo "<br><br>";

foreach ($height as $nama => $tinggi) {
    echo $nama . " is " . $tinggi . " cm tall.<br>";
}
echo "<br><br>";


// 4.2
$weight = array("Andy" => "70", "Barry" => "65", "Charlie" => "75");

echo 'weight = ("Andy"=>"70", "Barry"=>"65", "Charlie"=>"75")<br><br>';

$keys = array_keys($weight);

for ($i = 0; $i < 3; $i++) {
    $nama = $keys[$i];
    $berat = $weight[$nama];
    
    echo $nama . " is " . $berat . " kg.<br>";
}
?>