<?php
// Jawabnan 3.1
echo "<b>Jawaban 3.1</b>";
echo "<br>";
$height = array("Andy"=>"176","Barry"=>"165","Charlie"=>"170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Harry"] = "182";
echo "Height = (";

$i = 0;
foreach ($height as $tb => $value){
     echo '"'.$tb.'"=>'.'"'.$value.'"';
     $i++;
     if ($i < count($height)){
        echo ", ";
        }
        }
        echo ")";
        echo "<br>";
        $indeks_terakhir = array_keys($height);
        $indeks_terakhir = $indeks_terakhir[count($indeks_terakhir)-1];
        echo "Nilai dengan indeks terakhir: " . $height [$indeks_terakhir];
        
        echo "<br>";
        echo "<br>";
        
echo "Height = (";
unset($height["Andy"]);
$i = 0;
foreach ($height as $tb => $value){
     echo '"'.$tb.'"=>'.'"'.$value.'"';
     $i++;
     if ($i < count($height)){
        echo ", ";
     }
}
echo ")";
echo "<br>";
$indeks_terakhir = array_keys($height);
$indeks_terakhir = $indeks_terakhir[count($indeks_terakhir)-1];
echo "Nilai dengan indeks terakhir setelah dihapus: " . $height [$indeks_terakhir];


echo "<br>";
echo "<br>";

// Jawaban 3.2
echo "<b>Jawaban 3.2</b>";
echo "<br>";   
$weight = array("Andy"=>"70","Barry"=>"65","Charlie"=>"75");
echo "Weight = (";
$i = 0;
foreach ($weight as $bb => $value){
     echo '"'.$bb.'"=>'.'"'.$value.'"';
     $i++;
     if ($i < count($weight)){
        echo ", ";
        }
        }
echo ")";
echo "<br>";
$indeks_terakhir = array_keys($weight);
$indeks_terakhir = $indeks_terakhir[count($indeks_terakhir)-2];
echo "Data kedua : " . $weight [$indeks_terakhir];        
?>