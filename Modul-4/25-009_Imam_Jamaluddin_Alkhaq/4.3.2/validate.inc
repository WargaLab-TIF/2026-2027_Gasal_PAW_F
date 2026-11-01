<?php
function validateName(&$errors, $field_list, $field_name)
{
    $pattern = '/^[a-zA-Z\'-]+$/';  // format surname(alfabet)
    if (!isset($field_list[$field_name]) ||
        empty($field_list[$field_name]))
        $errors[$field_name] = 'required';
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = 'invalid';
}

function validateEmail(&$errors, $field_list, $field_email)
{
    if (!isset($field_list[$field_email]) ||
        empty($field_list[$field_email]))
        $errors[$field_email] = 'required';
    else if (!filter_var($field_list[$field_email], FILTER_VALIDATE_EMAIL))
        $errors[$field_email] = 'invalid';
}

?>
