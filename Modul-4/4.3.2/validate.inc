<?php
// Fungsi validasi untuk surname (huruf saja)
function validateName(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'is required';
    } else if (!preg_match("/^[A-Za-z ]+$/", $field_list[$field_name])) {
        $errors[$field_name] = 'must contain only letters and spaces';
    }
}

// Fungsi validasi untuk email
function validateEmail(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
        $errors[$field_name] = 'is required';
    } else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)) {
        $errors[$field_name] = 'format is invalid';
    }
}

// Fungsi validasi untuk state (memastikan user memilih state, bukan nilai default '-1')
function validateState(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || $field_list[$field_name] == '-1') {
        $errors[$field_name] = 'must be selected';
    }
}
?>