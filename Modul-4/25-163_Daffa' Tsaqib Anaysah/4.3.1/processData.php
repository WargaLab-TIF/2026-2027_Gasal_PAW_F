<?php
require 'validate.inc'; 

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    validateName($errors, $_POST, 'surname');

    if ($errors) {
        echo 'Errors:<br/>';
        foreach ($errors as $field => $error) {
            echo "$field $error<br/>";
        }
    } else {
        echo 'Data OK!<br><br>';
        
        echo '<h3>Posted data:</h3>';
        foreach ($_POST as $key => $value) {
            echo "($key) => ($value)<br>";
        }
    }
} else {
    echo "Akses ditolak. Silakan isi form terlebih dahulu.";
}
?>