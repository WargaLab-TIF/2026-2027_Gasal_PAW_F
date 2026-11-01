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

$array_1 = ["A"];
echo 'Array awal: ("'.$array_1[0].'")';
br();
array_push($array_1,"B");
echo 'Hasil array_push: ';
foreach ($array_1 as $value) {
	echo $value." ";
}
br();br();


$gabung = ["C"];
echo 'Array awal: ("'.$array_1[0].'", "'.$array_1[1].'") gabung dengan ("'.$gabung[0].'")';
br();
$gabungan = array_merge($array_1,$gabung);
echo 'Hasil array_merge: ';
foreach ($gabungan as $value) {
	echo $value." ";
}
br();br();

$array_2 = ["x"=>1,"y"=>2];
echo"Array awal: ";
cetak($array_2);
br();
$baru = array_values($array_2);
echo "Hasil array_values: ";
foreach ($baru as $value) {
	echo $value." ";
}
br();br();

echo 'Mencari "B" pada array: ("A","B","C")';
br();
echo "Hasil array_search: ".array_search("B",$gabungan);
br();br();

$array_3 = [0,1,false,2,"","array"];
echo 'Array awal: (0,1,false,2,"","array")';br();
$filter =array_filter($array_3,function($isi){
	return is_numeric($isi)||is_string($isi);
});
echo "Hasil array_filter: ";
foreach ($filter as $value) {
	echo $value." ";
}
br();br();

$array_4 = [3,1,2];
echo "Array awal: (3, 1, 2)";
br();
echo "Hasil sort: ";
sort($array_4);
foreach ($array_4 as $value) {
	echo $value." ";
}
br();
echo "Hasil rsort: ";
rsort($array_4);
foreach ($array_4 as $value) {
	echo $value." ";
}
br();
br();br();


$array_5 = [
	"Peter"=>35, "Ben"=>37, "Joe"=>43
];
echo "Array awal: ";
cetak($array_5);
br();

echo "Hasil asort: ";
asort($array_5);
foreach ($array_5 as $key => $value) {
	echo $key."=> ".$value.", ";
}
br();

echo "Hasil ksort: ";
ksort($array_5);
foreach ($array_5 as $key => $value) {
	echo $key."=> ".$value.", ";
}
br();

echo "Hasil arsort: ";
arsort($array_5);
foreach ($array_5 as $key => $value) {
	echo $key."=> ".$value.", ";
}
br();

echo "Hasil krsort: ";
krsort($array_5);
foreach ($array_5 as $key => $value) {
	echo $key."=> ".$value.", ";
}
br();
 ?>