<?php
foreach ($_POST as $key => $value)
    echo "($key) => ($value)<br/>";

require 'validate.inc';
$errors = array();

validateName($errors, $_POST, 'surname');
validateEmail($errors, $_POST, 'email');
validatePassword($errors, $_POST, 'passwd');
validateRequired($errors, $_POST, 'address');
validateSelect($errors, $_POST, 'prodi');
validateRequired($errors, $_POST, 'sesi');

if ($errors)
{
    echo 'Errors:<br/>';
    foreach ($errors as $field => $error)
        echo "$field $error<br/>";
}
else
    echo 'Data OK!';
?>