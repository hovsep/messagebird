<?php

if (!function_exists('str_camel_case')) {

    function str_camel_case($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', strtolower($value)));
        return lcfirst(str_replace(' ', '', $value));
    }
}

if (!function_exists('json_response')) {

    function json_response(array $responseData)
    {
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }
}

if (!function_exists('json_error_response')) {

    function json_error_response($error, $code)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode(['error' => $error]);
    }
}
