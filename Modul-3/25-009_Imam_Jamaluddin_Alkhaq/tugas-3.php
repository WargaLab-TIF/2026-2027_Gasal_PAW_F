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
br();
echo "Nilai dengan indeks tertinggi: ".end($height);
br();br();

unset($height['Barry']);
echo "height = ";
cetak($height);
br();
echo "Nilai dengan indeks tertinggi: ".end($height);
br();br();


$weight = array("Andy"=>"70","Barry"=>"65","Charlie"=>"75");
echo "weight = ";
cetak($weight);
br();
echo "Data kedua: ".$weight["Barry"];
 ?>