<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h3>Posted data: </h3>
	<?php 
		foreach ($_GET as $key => $value) {
			echo "($key) => ($value) <br>";
		}
	?>
</body>
</html>