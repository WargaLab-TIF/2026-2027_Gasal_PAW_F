<?php

function tampil($arr) {
    foreach ($arr as $nilai) {
        echo $nilai . " ";
    }
}

function tampilAssoc($arr) {
    $i = 0;
    foreach ($arr as $kunci => $nilai) {
        if ($i > 0) {
            echo ", ";
        }
        echo $kunci . "=>" . $nilai;
        $i++;
    }
}

function genap($n) {
    return $n % 2 == 0;
}

$a = array("A");
echo "Array awal: ";
tampil($a);
array_push($a, "B", "D");
echo "<br>Hasil array_push: ";
tampil($a);
echo "<br><br>";

$b = array("A", "B");
$c = array("C");
echo "Array awal: (\"A\", \"B\") digabung dengan (\"C\")<br>";
$gabung = array_merge($b, $c);
echo "Hasil array_merge: ";
tampil($gabung);
echo "<br><br>";

$d = array("x" => 1, "y" => 2);
echo "Array awal: (\"x\" => 1, \"y\" => 2)<br>";
$nilaiSaja = array_values($d);
echo "Hasil array_values: ";
tampil($nilaiSaja);
echo "<br><br>";

$e = array("A", "B", "C");
echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>";
echo "Hasil array_search: " . array_search("B", $e);
echo "<br><br>";

$f = array(0, 1, false, 2, "", 3, "array");
echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";
$hasilFilter = array_filter($f);
echo "Hasil array_filter (tanpa callback, buang nilai kosong/false): ";
tampil($hasilFilter);
echo "<br>";

$g = array(1, 2, 3, 4, 5, 6);
echo "Array awal: (1, 2, 3, 4, 5, 6)<br>";
$hasilGenap = array_filter($g, "genap");
echo "Hasil array_filter (callback genap): ";
tampil($hasilGenap);
echo "<br><br>";

$h = array(3, 1, 2);
echo "Array awal: (3, 1, 2)<br>";
sort($h);
echo "Hasil sort (naik): ";
tampil($h);
echo "<br>";
rsort($h);
echo "Hasil rsort (turun): ";
tampil($h);
echo "<br><br>";

$umur = array("Peter" => 35, "Ben" => 37, "Joe" => 43);
echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";

$k = $umur;
asort($k);
echo "Hasil asort (urut nilai naik): ";
tampilAssoc($k);
echo "<br>";

$k = $umur;
arsort($k);
echo "Hasil arsort (urut nilai turun): ";
tampilAssoc($k);
echo "<br>";

$k = $umur;
ksort($k);
echo "Hasil ksort (urut kunci naik): ";
tampilAssoc($k);
echo "<br>";

$k = $umur;
krsort($k);
echo "Hasil krsort (urut kunci turun): ";
tampilAssoc($k);
echo "<br>";

?>
