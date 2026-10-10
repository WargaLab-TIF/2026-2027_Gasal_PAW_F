<?php
// Soal 6.1 

function fmt($v) {
    if (is_bool($v)) {
        return $v ? "true" : "false";
    }
    if (is_string($v)) {
        return "\"" . $v . "\"";
    }
    return $v;
}

function teksArray($arr) {
    $hasil = array();
    foreach ($arr as $k => $v) {
        if (is_string($k)) {
            $hasil[] = "\"" . $k . "\" =&gt; " . fmt($v);
        } else {
            $hasil[] = fmt($v);
        }
    }
    return "(" . implode(", ", $hasil) . ")";
}

$a = array("A");
echo "Array awal: " . teksArray($a) . "<br>";
array_push($a, "B");
echo "Hasil array_push: " . implode(" ", $a) . "<br><br>";

$b1 = array("A", "B");
$b2 = array("C");
echo "Array awal: " . teksArray($b1) . " digabung dengan " . teksArray($b2) . "<br>";
$gabung = array_merge($b1, $b2);
echo "Hasil array_merge: " . implode(" ", $gabung) . "<br><br>";

$c = array("x" => 1, "y" => 2);
echo "Array awal: " . teksArray($c) . "<br>";
$nilai = array_values($c);
echo "Hasil array_values: " . implode(" ", $nilai) . "<br><br>";

$d = array("A", "B", "C");
echo "Mencari \"B\" pada array: " . teksArray($d) . "<br>";
$cari = array_search("B", $d);
echo "Hasil array_search: " . $cari . "<br><br>";

$e = array(0, 1, false, 2, "", 3, "array");
echo "Array awal: " . teksArray($e) . "<br>";
$filter = array_filter($e);
echo "Hasil array_filter: " . implode(" ", $filter) . "<br><br>";

$f = array(3, 1, 2);
echo "Array awal: " . teksArray($f) . "<br>";
$asc = $f;
sort($asc);
echo "Hasil sort: " . implode(" ", $asc) . "<br>";
$desc = $f;
rsort($desc);
echo "Hasil rsort: " . implode(" ", $desc) . "<br><br>";

$age = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo "Array awal: " . teksArray($age) . "<br>";

$s = $age;
asort($s);
echo "Hasil asort: ";
foreach ($s as $k => $v) {
    echo $k . "=&gt; " . $v . ", ";
}
echo "<br>";

$s = $age;
ksort($s);
echo "Hasil ksort: ";
foreach ($s as $k => $v) {
    echo $k . "=&gt; " . $v . ", ";
}
echo "<br>";

$s = $age;
arsort($s);
echo "Hasil arsort: ";
foreach ($s as $k => $v) {
    echo $k . "=&gt; " . $v . ", ";
}
echo "<br>";

$s = $age;
krsort($s);
echo "Hasil krsort: ";
foreach ($s as $k => $v) {
    echo $k . "=&gt; " . $v . ", ";
}
echo "<br>";
?>
