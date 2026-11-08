<?php 
$students = [
	[
		"nama"=>"Alex",
		"nim"=>"220401",
		"mobile"=>"0812345678"
	],
	[
		"nama"=>"Bianca",
		"nim"=>"220402",
		"mobile"=>"0812345687"
	],
	[
		"nama"=>"Candice",
		"nim"=>"220403",
		"mobile"=>"0812345665"
	]
];

function tampil($arr) {
    foreach ($arr as $val) {
        echo '("' . $val["nama"] . '", "' . $val["nim"] . '", "' . $val["mobile"] . '"),<br>';
    }
}

echo "Data awal: <br>";
echo "students = (<br>";
tampil($students);
echo ")<br>";


$nama = ["Daniel", "Elena", " Fiona", "Gabe", "Hannah"];
$nim = ["220404","220405","220406","220407","220408"];
$mobile = ["0812345611","0812345612","0812345613","0812345614","0812345615"];

for ($i = 0; $i < count($nama); $i++) {
    array_push($students, ["nama"=>$nama[$i], "nim"=>$nim[$i], "mobile"=>$mobile[$i]]);
}

echo "<br>Data setelah ditambah 5 data lain: <br>";
echo "students = (<br>";
tampil($students);
echo ")<br><br>";

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>tabel</title>
	<style>
		table, th, td {
		  border: 1px solid;
		}
	</style>
</head>
<body>

</body>
</html>
<table>
	<tr>
		<th>Name</th>
		<th>NIM</th>
		<th>Mobile</th>
	</tr>
	<?php 
		foreach($students as $val){
			echo "<tr>";
			echo "<td> " . $val['nama'] . " </td>";
			echo "<td> " . $val['nim'] . " </td>";
			echo "<td> " . $val['mobile'] . " </td>";
			echo "</tr>";
		}
	 ?>
</table>
