<?php
// Jawaban 1.1
echo "<b>Jawaban 1.1</b>";
echo "<br>";
$fruits = ["Avocado","Blueberry","Cherry"];
array_push($fruits,"Durian","Elderberry","Fig","Grape","Honeydew");
echo "fruit = ( ";
$i = 0;
foreach($fruits as $fruit    => $value){
    echo '"'.$value.'"';  
    $i++;
    if ($i < count($fruits)){
        echo ", ";
    }
}
echo ")";
echo "<br>";
$indek_tertinggi = count($fruits)-1;
echo "Nilai dengan indeks tertinggi: " . $fruits [$indek_tertinggi];
echo "<br>";
echo "<br>";

// Jawaban 1.2
echo "<b>Jawaban 1.2</b>";
echo "<br>";
$fruits = ["Avocado","Blueberry","Cherry"];
array_push($fruits,"Durian","Elderberry","Fig","Grape","Honeydew");
unset($fruits[1]);
echo "Data Blueberry dihapus";
echo "<br>";
$i = 0;
echo "fruit = ( ";
foreach($fruits as $fruit    => $value){
        echo '"'.$value.'"'.","." ";     
}
echo ")";
echo "<br>";
$indek_tertinggi = count($fruits);
echo "Nilai dengan indeks tertinggi: " . $fruits [$indek_tertinggi];
?>