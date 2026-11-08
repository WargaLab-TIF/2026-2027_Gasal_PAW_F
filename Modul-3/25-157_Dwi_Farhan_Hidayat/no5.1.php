<?php 
	$data = array(
		array("Alex", "220401", "0812345678"),
		array("Bianca", "220402", "0812345675"),
		array("Candire", "220403","0812345674")
	);
	echo "Data Awal : <br>";
	echo "Data = ";
	$panjang = count($data);
	for ($i = 0; $i < $panjang; $i++) {
	    echo '("';
	    $totalkolom = count($data[$i]);
	    for ($j = 0; $j < $totalkolom; $j++) {
	        echo $data[$i][$j];
	        if ($j < $totalkolom - 1) {
	            echo '", "';
	        }
	    }
	    echo '"),<br>';
	}
	echo ")";
	array_push($data, 
    array("Daniel", "220404", "0812345611"),
    array("Elena", "220405", "0812345622"),
    array("Fiona", "220406", "0812345633"),
    array("Gabe", "220407", "0812345644"),
    array("Hannah", "220408", "0812345655")
);	
	echo "<br><br>Data Setelah ditambah 5 data<br>";
	echo "Data = ";
	$panjang_baru = count($data);
	for ($i = 0; $i < $panjang_baru; $i++) {
	    echo '("';
	    $totalkolom = count($data[$i]);
	    for ($j = 0; $j < $totalkolom; $j++) {
	        echo $data[$i][$j];
	        if ($j < $totalkolom - 1) {
	            echo '", "';
	        }
	    }
	    echo '"),<br>';
	}
	echo ")";


?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>tabel</title>
</head>
<body>
	<table border="1">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Mobile</th>
        </tr>
        <?php
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>