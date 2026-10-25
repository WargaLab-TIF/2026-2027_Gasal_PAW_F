
<?php
require_once 'validate.inc';

$errors = array();

validateName($errors, $_POST, 'surname');

if (!empty($errors)) {
    echo 'Errors:<br/>';

    foreach ($errors as $field => $error) {
        echo "$field $error<br/>";
    }
} else {
    echo 'Data OK!';
}
?>
