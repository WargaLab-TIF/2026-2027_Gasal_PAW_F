<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Posted data</title></head>
<body>
<h3>Posted data: </h3>
<?php

foreach ($_GET as $key => $value)
    echo "($key) => ($value)<br/>";

?>
</body>
</html>
