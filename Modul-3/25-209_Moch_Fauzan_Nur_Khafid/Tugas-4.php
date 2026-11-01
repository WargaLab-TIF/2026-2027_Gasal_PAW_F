<?php
echo "4.1<br>";
$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");

$height['Harry']    = "165";
$height['Ron']      = "160";
$height['Draco']    = "169";
$height['Harmonie'] = "160";
$height['Malfoy']   = "170";

array_pop($height);
array_pop($height);

echo "Height = (";
$i = 0;
foreach($height as $key => $value){
    echo '"'. $key .'"' . '=>' .'"' .$value.'"'; 
    if($i < count($height)-1){
        echo ", ";
    }
    $i++;
}

echo ") <br><br>";

foreach($height as $key => $value){
    echo "$key is $value cm tall.";
}

echo "<br><br>4.2<br>";
$weight = ["Andy" => "70", "Barry" => "65", "Charlie" => "75"];
$nama = ["Andy", "Barry", "Charlie", "Hafiz", "Rahman"];

$weight['Hafiz'] = "90";
$weight['Rahman'] = "70";
echo "weight = (";
for ($i = 0; $i < count($nama); $i++) {
    echo '"' . $nama[$i] . '"=>"' . $weight[$nama[$i]] . '"';
    if ($i < count($nama) - 1) {
        echo ", ";
    }
}
echo ")<br><br>";

for ($i = 0; $i < count($nama); $i++) {
    echo $nama[$i] . " is " . $weight[$nama[$i]] . " kg.<br>";
}
?>