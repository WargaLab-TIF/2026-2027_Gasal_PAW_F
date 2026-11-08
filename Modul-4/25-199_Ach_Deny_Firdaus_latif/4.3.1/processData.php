<?php
foreach ($_POST as $key => $value)
    echo "($key) => ($value)<br/>";

require 'validate.inc';
$errors = array();

validateName($errors, $_POST, 'surname',);
validatePassword($errors, $_POST, 'passwd');
if ($errors)
{
    echo 'Errors:<br/>';
    foreach ($errors as $field => $error)
        echo "$field $error<br/>";
}
else
    echo 'Data OK!';
?>