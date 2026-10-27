<?php
$arr1 = ["A"];
echo 'Array awal: ("A") <br>';
array_push($arr1, "B");
echo "Hasil array_push: ";
foreach ($arr1 as $val) echo $val . " ";
echo "<br><br>";

$arr_a = ["A", "B"];
$arr_b = ["C"];
echo 'Array awal: ("A", "B") digabung dengan ("C") <br>';
$gabung = array_merge($arr_a, $arr_b);
echo "Hasil array_merge: ";
foreach ($gabung as $val) echo $val . " ";
echo "<br><br>";

$arr2 = ["x" => 1, "y" => 2];
echo 'Array awal: ("x" => 1, "y" => 2) <br>';
$values = array_values($arr2);
echo "Hasil array_values: ";
foreach ($values as $val) echo $val . " ";
echo "<br><br>";

$arr3 = ["A", "B", "C"];
echo 'Mencari "B" pada array: ("A", "B", "C") <br>';
$search = array_search("B", $arr3);
echo "Hasil array_search: " . $search . "<br><br>"; 

$arr4 = [0, 1, false, 2, "", 3, "array"];
echo 'Array awal: (0, 1, false, 2, "", 3, "array") <br>';
$filter = array_filter($arr4);
echo "Hasil array_filter: ";
foreach ($filter as $val) echo $val . " ";
echo "<br><br>";

$arr5 = [3, 1, 2];
echo 'Array awal: (3, 1, 2) <br>';

$arr_sort = $arr5;
sort($arr_sort);
echo "Hasil sort: ";
foreach ($arr_sort as $val) echo $val . " ";
echo "<br>";

$arr_rsort = $arr5;
rsort($arr_rsort);
echo "Hasil rsort: ";
foreach ($arr_rsort as $val) echo $val . " ";
echo "<br><br>";

$arr_assoc = ["Peter" => 35, "Ben" => 37, "Joe" => 43];
echo 'Array awal: ("Peter"=>35, "Ben"=>37, "Joe"=>43) <br>';

$asort_arr = $arr_assoc;
asort($asort_arr);
echo "Hasil asort: ";
foreach ($asort_arr as $key => $val) echo "$key=> $val, ";
echo "<br>";

$ksort_arr = $arr_assoc;
ksort($ksort_arr);
echo "Hasil ksort: ";
foreach ($ksort_arr as $key => $val) echo "$key=> $val, ";
echo "<br>";

$arsort_arr = $arr_assoc;
arsort($arsort_arr);
echo "Hasil arsort: ";
foreach ($arsort_arr as $key => $val) echo "$key=> $val, ";
echo "<br>";

$krsort_arr = $arr_assoc;
krsort($krsort_arr);
echo "Hasil krsort: ";
foreach ($krsort_arr as $key => $val) echo "$key=> $val, ";
echo "<br>";

?>