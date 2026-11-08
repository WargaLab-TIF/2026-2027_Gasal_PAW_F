<?php
function validateName(&$errors, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/"; // format surname (alfabet)
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
        $errors[$field_name] = 'required';
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = 'invalid (letters, apostrophe and hyphen only)';
}

function validateEmail(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'is required';
    else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL))
        $errors[$field_name] = 'is not a valid email address';
}

function validatePassword(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] === '')
        $errors[$field_name] = 'is required';
    else if (strlen($field_list[$field_name]) < 6)
        $errors[$field_name] = 'must be at least 6 characters';
}

function validateAddress(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'is required';
}

function validateState(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == '-1')
        $errors[$field_name] = 'must be chosen';
}

function validateGender(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]))
        $errors[$field_name] = 'must be selected';
    else if (!in_array($field_list[$field_name], array('male', 'female')))
        $errors[$field_name] = 'is invalid';
}
?>
