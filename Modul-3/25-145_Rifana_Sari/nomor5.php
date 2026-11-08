<?php 
$student=[["Alex","220401","0812345678"],["Bianca","220402","0812345687"],["Candice","220403","0812345665"]];
echo "Data awal :"."<br>";
print_r($student);

array_push($student,["Daniel","220404","0812345611"]);
array_push($student,["Elena","220405","0812345622"]);
array_push($student,["Fiona","220406","0812345633"]);
array_push($student,["Gabe","220407","0812345644"]);
array_push($student,["Hannah","220408","0812345655"]);
echo "<br>"."<br>"."Data setelah ditambah 5 data lain :"."<br>";
print_r($student);
echo "<br>";
echo "<br>";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table border="1">
		<tr>
			<th>Name</th>
			<th>NIM</th>
			<th>Mobile</th>
		</tr>
		<tr>
			<td><?=$student[0][0]?></td>
			<td><?=$student[0][1]?></td>
			<td><?=$student[0][2]?></td>
		</tr>
		<tr>
			<td><?=$student[1][0]?></td>
			<td><?=$student[1][1]?></td>
			<td><?=$student[1][2]?></td>
		</tr>
		<tr>
			<td><?=$student[2][0]?></td>
			<td><?=$student[2][1]?></td>
			<td><?=$student[2][2]?></td>
		</tr>
		<tr>
			<td><?=$student[3][0]?></td>
			<td><?=$student[3][1]?></td>
			<td><?=$student[3][2]?></td>
		</tr>
		<tr>
			<td><?=$student[4][0]?></td>
			<td><?=$student[4][1]?></td>
			<td><?=$student[4][2]?></td>
		</tr>
		<tr>
			<td><?=$student[5][0]?></td>
			<td><?=$student[5][1]?></td>
			<td><?=$student[5][2]?></td>
		</tr>
		<tr>
			<td><?=$student[6][0]?></td>
			<td><?=$student[6][1]?></td>
			<td><?=$student[6][2]?></td>
		</tr>
		<tr>
			<td><?=$student[7][0]?></td>
			<td><?=$student[7][1]?></td>
			<td><?=$student[7][2]?></td>
		</tr>
	</table>
</body>
</html>