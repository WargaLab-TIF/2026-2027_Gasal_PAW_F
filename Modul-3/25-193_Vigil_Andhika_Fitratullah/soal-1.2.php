<?php
$fruits = array("Avocado","Blueberry","Cherry","Durian","Elderberry","Fig","Grape","Honeydew");
unset($fruits[1]);

echo 'data blueberry dihapus'.'<br>';
echo 'fruits = ("'. implode('", "', $fruits).'")'. '<br>';
echo "Nilai dengan indeks tertinggi: ". end($fruits);
?>