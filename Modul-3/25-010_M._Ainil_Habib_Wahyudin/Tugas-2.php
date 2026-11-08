<?php 
$fruits = array("Avocado", "Blueberry", "Cherry");
$arraylength = count($fruits);

for($x=0;$x < $arraylength;$x++){
	echo $fruits[$x];
	echo "<br>";
}

echo "<br>";
//2.1
for($i=0;$i<5;$i++){
	array_push($fruits, "Buah Tambahan " . ($i+1));
}

echo "Panjang array saat ini: " . count($fruits) . "<br><br>";
for($x=0;$x <count($fruits);$x++){
	echo $fruits[$x];
	echo "<br>";
}
//skrip 5 sampe 8 perlu diubah bagian variabel arraylength agar semua data yang ada di array tampil, jika tidak hanya akan menampilkan hasil sebelum ditambahkan.


echo "<br>";
//2.2
$vegies = array("carrot", "Brocoli", "Spinach");
$arraylength = count($vegies);

for($x=0;$x < $arraylength;$x++){
	echo $vegies[$x];
	echo "<br>";
}
//memodifikasi skrip yang sudah ada. mengganti nama variabel fruits menjadi vegies agar kode berjalan dengan sesuai dan tidak terpengaruh skrip sebelumnya.
?>