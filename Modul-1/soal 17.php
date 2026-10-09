<?php
function sum($x, $y) {
    $z = $x + $y;
    return $x . " + " . $y . " = " . $z;
}

echo sum(5, 10) . "<br>";
echo sum(7, 13) . "<br>";
echo sum(2, 4);
?>