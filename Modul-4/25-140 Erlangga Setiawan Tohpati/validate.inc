<?php
// function validateName($field_list, $field_name)
// {
//     if (!isset($field_list[$field_name]))
//         return false;
    
//     $pattern = "/^[a-zA-Z'-]+$/";
//     if (!preg_match($pattern, $field_list[$field_name]))
//         return false;
        
//     return true;
// }

// function validateName(&$errors, $field_list, $field_name)
// {
//     $pattern = "/^[a-zA-Z'-]+$/";
//     if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
//         $errors[$field_name] = 'required';
//     } else if (!preg_match($pattern, $field_list[$field_name])) {
//         $errors[$field_name] = 'invalid';
//     }
// }

function validateName(&$errors, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/";
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'required';
    } else if (!preg_match($pattern, trim($field_list[$field_name]))) {
        $errors[$field_name] = 'invalid format (alphabet only)';
    }
}

function validateEmail(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'required';
    } else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'invalid email format';
    }
}

function validateAddress(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'required';
    }
}

function validateState(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == "-1") {
        $errors[$field_name] = 'please select a valid state';
    }
}

function validateGender(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = 'please select a gender';
    }
}
?>