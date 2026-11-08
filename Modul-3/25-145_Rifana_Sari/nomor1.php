<?php 
$fruits=["Avocado","Blueberry","Cherry"];
array_push($fruits, "Durian");
array_push($fruits, "Eldeberry");
array_push($fruits, "Fig");
array_push($fruits, "Grape");
array_push($fruits, "Honeydew");

// 1.1
echo "fruits = ";
print_r($fruits);
echo "<br>"."Nilai dengan indeks tertinggi: ".$fruits[count($fruits)-1];
echo "<br>";
echo "<br>";

// 1.2
echo "Data Blueberry telah dihapus."."<br>";
$fruits=array_values($fruits);
echo "fruits = ";
print_r($fruits);
echo "<br>"."Nilai dengan indeks tertinggi: ".$fruits[count($fruits)-1];
?>