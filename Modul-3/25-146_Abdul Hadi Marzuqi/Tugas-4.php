<?php
// Jawaban 4.1
echo "<b>Jawaban 4.1</b>";
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
echo "<br>";
foreach ($height as $tb => $value){
    echo $tb." is ".$value." cm ". " tall"."<br>";
    }
    
echo "<br>";
echo "<br>";
    
// Jawaban 4.2
echo "<b>Jawaban 4.2</b>";
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
for ($i = 0; $i < count($weight); $i++){
    $key = array_keys($weight)[$i];
    $value = $weight[$key];
    echo $key." is ".$value." kg. "."<br>";
}
?>