<h3>Posted data:</h3>
<?php
foreach ($_POST as $key => $value) {
    echo "($key) => ($value) <br/>";
}

require 'validate.inc';

// if (validateName($_POST, 'surname')) {
//     echo 'Data OK!';
// } else {
//     echo 'Data invalid!';
// }

// function validateName(&$errors, $field_list, $field_name)
// {
//     $pattern = "/^[a-zA-Z'-]+$/";
    
//     if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
//         $errors[$field_name] = 'required';
//     } else if (!preg_match($pattern, $field_list[$field_name])) {
//         $errors[$field_name] = 'invalid';
//     }
// }

require 'validate.inc';

$errors = array();
validateName($errors, $_POST, 'surname');

if ($errors) {
    echo 'Errors:<br/>';
    foreach ($errors as $field => $error) {
        echo "$field $error<br/>";
    }
} else {
    echo 'Data OK!';
}
?>