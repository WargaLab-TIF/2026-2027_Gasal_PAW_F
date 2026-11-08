<?php 
$awal=["A"];
echo "Array awal: ";
print_r($awal);
array_push($awal,"B");
echo "<br>"."Hasil array_push: ";
print_r($awal);
echo "<br>";

echo "<br>"."Array awal: ";
print_r($awal);
echo " digabung dengan ";
$dengan=["C"];
print_r($dengan);
$gabungan=array_merge($awal,$dengan);
echo "<br>"."Hasil array_merge: ";
print_r($gabungan);
echo "<br>";

$awal2=["x"=>1,"y"=>2];
echo "<br>"."Array awal: ";
print_r($awal2);
$values=array_values($awal2);
echo "<br>"."Hasil array_values: ";
print_r($values);
echo "<br>";

echo "<br>"."Mencari B pada array ";
print_r($gabungan);
$search=array_search("B", $gabungan);
echo "<br>"."Hasil array_search: ".$search;
echo "<br>";

$awal3=[0,1,false,2,"",3,"array"];
echo "<br>"."Array awal: ";
print_r($awal3);
echo "<br>"."Hasil array_filter: ";
$hasil=array_filter($awal3,function($nilai){
	return $nilai!=0 && $nilai!=false && $nilai!="";
});
print_r($hasil);
echo "<br>";

$awal4=[3,1,2];
echo "<br>"."Array awal: ";
print_r($awal4);
echo "<br>"."Hasil sort: ";
sort($awal4);
print_r($awal4);
echo "<br>"."Hasil rsort: ";
rsort($awal4);
print_r($awal4);
echo "<br>";

$awal5=["Peter"=>35,"Ben"=>37,"Joe"=>43];
echo "<br>"."Array awal :";
print_r($awal5);
asort($awal5);
echo "<br>"."Hasil asort: ";
print_r($awal5);
ksort($awal5);
echo "<br>"."Hasil ksort: ";
print_r($awal5);
arsort($awal5);
echo "<br>"."Hasil arsort: ";
print_r($awal5);
krsort($awal5);
echo "<br>"."Hasil krsort: ";
print_r($awal5);
?>