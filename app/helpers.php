<?php

if (!function_exists('str_camel_case')) {

    function str_camel_case($value)
    {
        return lcfirst(str_studly_case($value));
    }
}

if (!function_exists('str_studly_case')) {

    function str_studly_case($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return str_replace(' ', '', $value);
    }
}
