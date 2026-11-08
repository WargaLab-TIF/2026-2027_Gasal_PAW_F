<?php
// Jawaban 6.1
echo "<b>Jawaban 6.1</b>";
echo "<br>";

// 1. array_push()
$buah = array("A");
echo "Array awal: ";
print_r($buah);

array_push($buah, "B");
echo "<br>Hasil array_push: ";
print_r($buah);

echo "<br><br>";

// 2. array_merge()
$array1 = array("A", "B");
$array2 = array("C");

echo 'Array awal: ';
print_r($array1);

$gabung = array_merge($array1, $array2);
echo "<br>Hasil array_merge: ";
print_r($gabung);

echo "<br><br>";

// 3. array_values()
$data = array("x" => 1, "y" => 2);

echo "Array awal: ";
print_r($data);

$nilai = array_values($data);
echo "<br>Hasil array_values: ";
print_r($nilai);

echo "<br><br>";

// 4. array_search()
$huruf = array("A", "B", "C");

echo 'Mencari "B" pada array: ';
print_r($huruf);

$cari = array_search("B", $huruf);
echo "<br>Hasil array_search: " . $cari;

echo "<br><br>";

// 5. array_filter()
$angka = array(0, 1, false, 2, "", 3, "array");

echo "Array awal: ";
print_r($angka);

$filter = array_filter($angka);
echo "<br>Hasil array_filter: ";
print_r($filter);

echo "<br><br>";

// 6. Sorting array berindeks
$angka = array(3, 1, 2);

echo "Array awal: ";
print_r($angka);

$sort = $angka;
sort($sort);
echo "<br>Hasil sort: ";
print_r($sort);

$rsort = $angka;
rsort($rsort);
echo "<br>Hasil rsort: ";
print_r($rsort);

echo "<br><br>";

// 7. Sorting array asosiatif
$nilai = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

echo "Array awal: ";
print_r($nilai);

// asort: urut berdasarkan nilai, terkecil ke terbesar
$asort = $nilai;
asort($asort);
echo "<br>Hasil asort: ";
print_r($asort);

// arsort: urut berdasarkan nilai, terbesar ke terkecil
$arsort = $nilai;
arsort($arsort);
echo "<br>Hasil arsort: ";
print_r($arsort);

// ksort: urut berdasarkan key, A-Z
$ksort = $nilai;
ksort($ksort);
echo "<br>Hasil ksort: ";
print_r($ksort);

// krsort: urut berdasarkan key, Z-A
$krsort = $nilai;
krsort($krsort);
echo "<br>Hasil krsort: ";
print_r($krsort);
?>