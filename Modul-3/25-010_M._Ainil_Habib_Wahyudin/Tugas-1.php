<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

//1.1
array_push($fruits, "Durian");
array_push($fruits, "Elderbery");
array_push($fruits, "Fig");
array_push($fruits, "Grape");
array_push($fruits, "Honeydew");

echo '$fruits = (';
for($i=0;$i<count($fruits);$i++){

	echo '"' . $fruits[$i] . '"' ;

	if($i == count($fruits) - 1){
		echo ") <br> Nilai dengan Indeks tertinggi: " . $fruits[$i];
	}else{
		echo ", ";
	}
}

echo "<br><br>";

//1.2
$hapus = "Blueberry";
unset($fruits[array_search($hapus, $fruits)]);
echo "Data " . $hapus . " Dihapus <br>";
$fruits = array_values($fruits);

echo '$fruits = (';
for($i=0;$i<count($fruits);$i++){
	if($i != 0){
		echo ", ";
	}
	echo '"' . $fruits[$i] . '"' ;

	if($i == count($fruits) - 1){
	echo ") <br> Nilai dengan Indeks tertinggi: " . $fruits[$i];
	}
}


?>