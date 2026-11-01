<?php
function br(){
	echo "<br>";
}

function cetak($array){
foreach ($array as $value) {
	if($value == reset($array)){
		echo'("'.$value.'", ';
	}elseif ($value == end($array)) {
		echo'"'.$value.'")';
	}else{
		echo'"'.$value.'", ';
	}
}
}

$fruits = array("Avocado","Blueberry","Cherry");
echo "fruits = ";
cetak($fruits);

br();br();
array_push($fruits,"Durian","Elderberry","Fig","Grape","Honeydew");
echo "fruits = ";
cetak($fruits);
br();
echo "Nilai dengan indeks tertinggi: ".end($fruits);
br();br();

echo "Data Blueberry dihapus";
br();
unset($fruits[1]);
echo "fruits = ";
cetak($fruits);br();
echo "Nilai dengan indeks tertinggi: ".end($fruits);
 ?>