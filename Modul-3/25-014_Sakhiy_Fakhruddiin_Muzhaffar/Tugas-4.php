<?php
$height = [
	"andy" => "176",
	"barry" => "165",
	"charlie" => "170",
    "david" => "180",
    "ethan" => "172",
    "frank" => "168",
    "george" => "175",
    "harry" => "182",
];

$weight = [
    "andy" => "70",
    "barry" => "65",
    "charlie" => "75",
];

var_dump($weight);
echo "<br>";

$keys = array_keys($weight); 
$jumlah_data = count($weight);
for ($i = 0; $i < $jumlah_data; $i++) {
    $nama = $keys[$i];
    $berat = $weight[$nama];
    echo $nama . " is " . $berat . " kg.<br>";
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
    <?php var_dump($height);?>
	<?php foreach ($height as $key => $value):?>
		<p> <?=$key?> is <?=$value?> cm tall. </p>
	<?php endforeach;?>
</body>
</html>
