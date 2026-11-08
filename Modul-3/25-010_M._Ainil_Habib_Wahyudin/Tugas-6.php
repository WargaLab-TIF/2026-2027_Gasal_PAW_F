<?php 
function br(){
	echo "<br>";
}

function tampil($arr, $p){
	return implode($p, $arr);
}

function tampil1($arr, $p){
	$hasil = "";
	$i = 0;
	foreach ($arr as $key => $val) {
		if($i > 0){
			$hasil .= $p;
		}
		$hasil .= '"' . $key . '"' . "=>" . $val;

		$i++;
	}
	return $hasil;
}

//push
$arr = ["A"];
echo 'Array awal: ("' . tampil($arr, "") . '")';
br();
array_push($arr, "B");
echo "Hasil array_push: ";
echo tampil($arr, "");
br();
br();

//merge
echo 'Array awal: ("' . tampil($arr, ", ") . '")';
br();
$c = ["C"];
$arr = array_merge($arr, $c);
echo "Hasil array_merge: ";
echo tampil($arr, " ");
br();
br();

//values
$angka = ["x"=>"1", "y"=>"2"];
echo 'Array awal: (' . tampil1($angka, ", ") . ")";
$angka1 = array_values($angka);
br();
echo "Hasil array_values: " . tampil($angka1, " ");
br();
br();

//search
echo 'Mencari "B" pada array: (' . tampil($arr, ", ") . ")";
br();
$cari = array_search("B", $arr);
echo "Hasil array_search: " . $cari;
br();
br();

// //filter
$arr_f = [0, 1, "false", 2, "", 3, "array"];

echo 'Array awal: ';
echo tampil($arr_f, ", ");
br();

$filter = array_filter($arr_f, function($val) {
    return $val !== "false" && $val !== "" && $val !== 0;
});

echo "Hasil array_filter: ";
echo tampil($filter, ", ");
br();
br();

//sort
$arr_s = [3, 1, 2];
echo 'Array awal:(' . tampil($arr_s, ", ") . ")";
br();
sort($arr_s);
echo 'Hasil sort: ' . tampil($arr_s, " ") . "";
br();
rsort($arr_s);
echo 'Hasil sort: ' . tampil($arr_s, " ") . "";
br();
br();

//asort dan ksort
$arr_as = ["peter"=>35, "Ben"=>37,"Joe"=>43];
echo 'Array awal:(' . tampil1($arr_as, ", ") . ")";
br();
asort($arr_as);
echo 'Hasil asort: ' . tampil1($arr_as, ", ") . "";
br();
ksort($arr_as);
echo 'Hasil ksort: ' . tampil1($arr_as, ", ") . "";
br();
arsort($arr_as);
echo 'Hasil arsort: ' . tampil1($arr_as, ", ") . "";
br();
krsort($arr_as);
echo 'Hasil krsort: ' . tampil1($arr_as, ", ") . "";
 ?>