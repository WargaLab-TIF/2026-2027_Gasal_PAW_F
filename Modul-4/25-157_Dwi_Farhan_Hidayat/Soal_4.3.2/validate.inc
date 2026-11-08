<?php
// function validatename(&$errors, $field_list, $field_name)
// {
//     $pattern = "/^[a-zA-Z'-]+$/";
//     if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
//         $errors[$field_name] = 'required';
//     } elseif (!preg_match($pattern, $field_list[$field_name])) {
//         $errors[$field_name] = 'invalid';
//     }
// }

function validateName(&$error, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/";
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $error[$field_name] = 'required';
    } elseif (!preg_match($pattern, $field_list[$field_name])) {
        $error[$field_name] = 'invalid';
    }
}

function validateEmail(&$error, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $error[$field_name] = 'required';
    } elseif (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $error[$field_name] = 'invalid format';
    }
}

function validatePassword(&$error, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $error[$field_name] = 'required';
    } elseif (strlen($field_list[$field_name]) < 6) {
        $error[$field_name] = 'must be at least 6 characters';
    }
}

function validateState(&$error, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == '-1') {
        $error[$field_name] = 'must be chosen';
    }
}
?>