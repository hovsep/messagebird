<?php

if (!function_exists('str_camel_case')) {

    function str_camel_case($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', strtolower($value)));
        return lcfirst(str_replace(' ', '', $value));
    }
}
