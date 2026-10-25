
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Process Data</title>
</head>
<body>

<?php
$errors = array();

if (isset($_POST['firstname']) || isset($_POST['surname']))
{
    require 'validate.inc';

    validateName($errors, $_POST, 'firstname');
    validateName($errors, $_POST, 'surname');

    if ($errors)
    {
        echo '<h1>Invalid, correct the following errors:</h1>';

        foreach ($errors as $field => $error)
            echo "$field $error<br/>";

        include 'form.inc';
    }
    else
    {
        echo 'Form submitted successfully with no errors';
    }
}
else
{
    include 'form.inc';
}
?>

</body>
</html>
