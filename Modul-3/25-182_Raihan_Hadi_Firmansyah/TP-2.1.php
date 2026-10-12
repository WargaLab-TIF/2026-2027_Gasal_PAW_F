<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$data = array("Durian", "Elderberry", "Fig", "Grape", "Honeydew");

for ($i = 0; $i < count($data); $i++) {
    $fruits[] = $data[$i];
}

$arrlength = count($fruits);
echo "Panjang array saat ini: " . $arrlength;
echo "<br>";
echo "<br>";

for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}

// Skrip perulangan for pada baris 5–8 pada soal tidak perlu diubah strukturnya karena batas perulangan menggunakan variabel $arrlength. Variabel tersebut berisi jumlah data setelah lima data baru ditambahkan, yaitu 8. Dengan demikian, perulangan dapat menampilkan seluruh data dalam array $fruits.

?>