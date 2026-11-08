<?php
// array_push
$arr1 = array("A");
array_push($arr1, "B");
echo "Hasil array_push: " . implode(" ", $arr1) . "<br>";

// array_merge
$arr2_1 = array("A", "B");
$arr2_2 = array("C");
$result_merge = array_merge($arr2_1, $arr2_2);
echo "Hasil array_merge: " . implode(" ", $result_merge) . "<br>";

// array_values
$arr3 = array("x" => 1, "y" => 2);
echo "Hasil array_values: " . implode(" ", array_values($arr3)) . "<br>";

// array_search
$arr4 = array("A", "B", "C");
echo "Hasil array_search 'B': " . array_search("B", $arr4) . "<br>";

// array_filter
$arr5 = array(0, 1, false, 2, "", 3, "array");
echo "Hasil array_filter: " . implode(" ", array_filter($arr5)) . "<br>";

// sorting terindeks
$arr6 = array(3, 1, 2);
$s1 = $arr6; sort($s1);
$s2 = $arr6; rsort($s2);
echo "Hasil sort: " . implode(" ", $s1) . " | Hasil rsort: " . implode(" ", $s2) . "<br>";

// sorting asosiatif
$arr7 = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
$as = $arr7; asort($as);
$ks = $arr7; ksort($ks);
echo "Hasil asort: "; foreach($as as $k=>$v) { echo "$k=>$v "; } echo "<br>";
echo "Hasil ksort: "; foreach($ks as $k=>$v) { echo "$k=>$v "; }
?>