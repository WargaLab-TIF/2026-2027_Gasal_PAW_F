<?php
function validateName(&$errors,$field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet);
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
        $errors[$field_name]="Surname wajib diisi";
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name]="Surname hanya boleh huruf a-z, A-Z, apostrof, atau tanda hubung";
}
// Validasi email
function validateEmail(&$errors,$field_list, $field_name)
{
    $pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name])==="")
        $errors[$field_name]="Email wajib diisi";
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name]="Format email tidak valid (contoh Hadi@gmail.com)";
}
// Validasi password: minimal 6 karakter
function validatePassword(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] === '')
        $errors[$field_name] = 'Password wajib diisi';
    else if (strlen($field_list[$field_name]) < 6)
        $errors[$field_name] = 'Password minimal 6 karakter';
}

// Validasi alamat: tidak boleh kosong
function validateAddress(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'Alamat wajib diisi';
}

// Validasi state: harus memilih salah satu (bukan -1)
function validateState(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] === '-1')
        $errors[$field_name] = 'Silakan pilih state';
    else if (!in_array($field_list[$field_name], ['1','2','3','4','5','6','7','8']))
        $errors[$field_name] = 'State tidak dikenal';
}

// Validasi gender: radio harus dipilih
function validateGender(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]))
        $errors[$field_name] = 'Gender wajib dipilih';
    else if (!in_array($field_list[$field_name], ['Male', 'Female']))
        $errors[$field_name] = 'Gender tidak valid';
}
?>