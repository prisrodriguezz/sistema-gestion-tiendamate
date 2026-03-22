<?php

if (!function_exists('no_spaces')) {
    function no_spaces(string $str, string &$error = null): bool
    {
        if (preg_match('/\s/', $str)) {
            $error = 'La contraseña no debe contener espacios.';
            return false;
        }
        return true;
    }
}
