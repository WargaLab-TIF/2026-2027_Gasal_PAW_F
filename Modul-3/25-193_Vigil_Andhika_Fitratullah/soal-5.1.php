<?php
$data = [
  ["Alex", "220401", "0812345678"],
  ["Bianca", "220402", "0812345687"],
  ["Candice", "220403", "0812345665"]
];
echo "Data awal:<br> students = (<br>";
foreach ($data as $i => $baris) {
  echo '("' . implode('", "', $baris) . '")';
  if ($i < count($data) - 1){
    echo ",".'<br>';
  }
}
echo "<br>)<br><br>";

echo "Data setelah ditambah 5 data lain:<br> students = (<br>";
array_push($data,
  ["Daniel", "220404", "0812345611"],
  ["Elena","220405","0812345622"],
  ["Fiona","220406","0812345633"],
  ["Gabe","220407","0812345644"],
  ["Hannah","220408","0812345655"],
);
foreach ($data as $j => $tmbh) {
  echo '("' . implode('", "', $tmbh) . '")';
  if ($j < count($data) - 1){
    echo ",".'<br>';
  }
}
echo "<br>)<br><br>";

echo "<table border='1'>";
echo 
"<tr>
  <th>Name</th>
  <th>NIM</th>
  <th>Mobile</th>
</tr>";
foreach ($data as $tmbh) {
  echo "<tr><td>" . implode("</td><td>", $tmbh) . "</td></tr>";
}
echo "</table>";
?>