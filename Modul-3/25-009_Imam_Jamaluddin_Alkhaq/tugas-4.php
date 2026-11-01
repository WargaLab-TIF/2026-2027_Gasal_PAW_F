<?php
function br(){
	echo "<br>";
}


function cetak($array){
foreach ($array as $key => $value) {
	if($value == reset($array)){
		echo'("'.$key.'"=>"'.$value.'", ';
	}elseif ($value == end($array)) {
		echo'"'.$key.'"=>"'.$value.'")';
	}else{
		echo'"'.$key.'"=>"'.$value.'", ';
	}
}
}

$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harrry"] = "182";

echo "height = ";
cetak($height);
br();br();

$key_height = array_keys($height);
for ($i=0; $i < count($height); $i++) {
	$key = $key_height[$i];
	echo $key." is ".$height[$key]. " cm tall.<br>";
}
br();br();


$weight = array("Andy"=>"70","Barry"=>"65","Charlie"=>"75");
echo "weight = ";
cetak($weight);
br();br();

$key_weight = array_keys($weight);
for ($i=0; $i < count($weight); $i++) {
	$key = $key_weight[$i];
	echo $key." is ".$weight[$key]. " kg.<br>";
}
 ?>