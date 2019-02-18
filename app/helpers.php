<?php

if (!function_exists('str_camel_case')) {

    /**
     * Returns camel-cased string
     *
     * @param $value
     * @return string
     */
    function str_camel_case($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', strtolower($value)));
        return lcfirst(str_replace(' ', '', $value));
    }
}

if (!function_exists('json_response')) {

    /**
     * Returns 200 OK json response
     *
     * @param array $responseData
     */
    function json_response(array $responseData)
    {
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }
}

if (!function_exists('json_error_response')) {

    /**
     * Returns json error
     *
     * @param $error
     * @param $code
     */
    function json_error_response($error, $code)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode(['error' => $error]);
    }
}

if (!function_exists('call_controller')) {

    /**
     * Calls controller method
     *
     * @param $name
     * @param $method
     * @param array $params
     * @return mixed
     */
    function call_controller($name, $method, array $params)
    {
        return call_user_func_array([(new $name), $method], $params);
    }
}
