<?php 
// 3.1
$height=["Andy"=>"176","Barry"=>"165","Charlie"=>"170"];
echo "Andy is ".$height["Andy"]."cm tall."."<br>"."<br>";
$height["David"]="180";
$height["Ethan"]="172";
$height["Frank"]="168";
$height["George"]="175";
$height["Harry"]="182";

$panjang=count($height);
$keys=array_keys($height);
echo "height = ";
print_r($height);
echo "<br>";
echo "Nilai dengan indeks terakhir: ".$height[$keys[$panjang-1]]."<br>";

echo "<br>";
unset($height["Barry"]);
echo "height = ";
print_r($height);
echo "<br>";
echo "Nilai dengan indeks terkahir setelah dihapus: ".$height[$keys[$panjang-1]]."<br>";
echo "<br>";
echo "<br>";

// 3.2
$weight=["Andy"=>"70","Barry"=>"65","Charlie"=>"75"];
echo "weight = ";
print_r ($weight);
echo "<br>";
echo "Data kedua: ".$weight["Barry"];
?>