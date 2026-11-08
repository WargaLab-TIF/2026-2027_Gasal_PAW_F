<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
  body { font-family: Verdana, sans-serif; font-size: 12px; }
  fieldset { background: #ddf; width: 480px; }
  .field { margin: 4px 0; }
  .field label { display: inline-block; width: 110px; text-align: right; margin-right: 8px; }
</style>
</head>
<body>
<h1>Register</h1>
<?php
$errors = array();
if (isset($_POST['surname']))
{
    require 'validate.inc';
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'passwd');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateGender($errors, $_POST, 'sex');
    if ($errors)
    {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error)
            echo "$field $error</br>";
        
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
