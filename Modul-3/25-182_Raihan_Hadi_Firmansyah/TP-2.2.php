<?php
$vegies = array("Carrot", "Broccoli", "Spinach");
$arrlength = count($vegies);

for ($x = 0; $x < $arrlength; $x++) {
    echo $vegies[$x];
    echo "<br>";
}

// Cukup memodifikasi skrip yang sudah ada dengan mengganti nama array menjadi $vegies dan menyesuaikan isi datanya. Tidak perlu membuat struktur perulangan baru karena array terindeks tetap menggunakan indeks numerik yang dimulai dari 0, sehingga perulangan for yang sudah ada dapat digunakan untuk menampilkan seluruh data.

?>