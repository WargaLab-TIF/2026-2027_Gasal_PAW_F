<?php
//2.1
echo "2.1 <br>";
$fruits = ["avocado", "blueberry", "cherry"];
for ($i = 1; $i <= 5; $i++) {
    $fruits[] = "Buah tambahan $i";
}

echo "Panjang array saat ini : " . count($fruits) . "<br><br>";

$arrlength = count($fruits);
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x] . "<br>";
}
/*Kode di atas digunakan untuk menambahkan lima data baru ke dalam 
array $fruits yang awalnya berisi tiga data buah. Setelah penambahan,
jumlah data menjadi 8. Perulangan for pada baris #5–#8 tidak perlu 
diubah karena menggunakan count($fruits) untuk menghitung jumlah data dalam array,
sehingga seluruh data dapat ditampilkan. */

echo "<br>";

//2.2
echo "2.2 <br>";
$sayur = ["Carrot", "Broccoli", "Spinach"];
$arrlength = count($sayur);
for ($x = 0; $x < $arrlength; $x++) {
    echo $sayur[$x] . "<br>";
}
/*Pada soal 2.2, saya menggunakan variabel $sayur yang berisi tiga 
data sayuran, yaitu Carrot, Broccoli, dan Spinach. Perulangan for 
digunakan untuk menampilkan seluruh data sayuran yang ada di dalam array.*/
?>