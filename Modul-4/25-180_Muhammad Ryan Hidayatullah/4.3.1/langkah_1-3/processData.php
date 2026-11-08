<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posted Data</title>
    <style>
        body { font-family: Verdana, Arial, sans-serif; font-size: 12px; }
        h3 { margin-bottom: 8px; }
    </style>
</head>
<body>
    <h3>Posted data: </h3>
<?php
// LANGKAH 2: ubah processData.php, tambahkan file validate.inc
require 'validate.inc';

foreach ($_POST as $key => $value)
    echo "(" . htmlspecialchars($key) . ") => (" . htmlspecialchars($value) . ")<br/>";

echo '<br/>';

// LANGKAH 2: lakukan validasi surname
if (validateName($_POST, 'surname'))
    echo 'Data OK!';
else
    echo 'Data invalid!';
// LANGKAH 3: pengujian - isi surname dengan data benar
if (validatePassword($_POST, 'passwd'))
    echo 'Data OK!';
else
    echo 'Data invalid!';

?>
</body>
</html>
