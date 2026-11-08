<?php  
// 4.1
$height=["Andy"=>"176","Barry"=>"165","Charlie"=>"170"];
$height["David"]="180";
$height["Ethan"]="172";
$height["Frank"]="168";
$height["George"]="175";
$height["Harry"]="182";

var_dump($height);
echo "<br>";
echo "<br>";
$keys=array_keys($height);
foreach ($height as $heigh => $value) {
	echo $heigh." is ".$value." cm tall."."<br>";
}
echo "<br>";
echo "<br>";

// 4.2
$weight=["Andy"=>"70","Barry"=>"65","Charlie"=>"75"];
var_dump($weight);
echo "<br>";
echo "<br>";
$keys=array_keys($weight);
for($i=0;$i<count($keys);$i++){
	echo $keys[$i]." is ".$weight[$keys[$i]]." kg"."<br>";
}
?>