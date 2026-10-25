<?php
// Validasi field Surname (hanya format alfabet)
function validateName(&$errors, $field_list, $field_name) {
    $pattern = "/^[a-zA-Z'-]+$/";
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'required';
    } else if (!preg_match($pattern, trim($field_list[$field_name]))) {
        $errors[$field_name] = 'invalid';
    }
}

// Validasi field Email Address (format email valid)
function validateEmail(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
        $errors[$field_name] = 'required';
    } else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'invalid format';
    }
}

// Validasi field State (dropdown pilihan)
function validateSelect(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == '-1') {
        $errors[$field_name] = 'must be selected';
    }
}

// Validasi field Gender (radio button)
function validateRadio(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name])) {
        $errors[$field_name] = 'must be chosen';
    }
}
?>