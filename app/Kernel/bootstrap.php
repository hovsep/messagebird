<?php

/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 17.02.19
 * Time: 19:19
 */

error_reporting(E_ALL);

require __DIR__ . '/../../vendor/autoload.php';

global $config;//Yes, I know this is bad. In real world we should use something better, e.g. Registry patters or IoC
$config = require_once __DIR__ . '/../config.php';

set_exception_handler(function(Throwable $e) {
    if ($e instanceof \App\Kernel\Exception\HttpException) {
        json_error_response($e->getMessage(), $e->getCode());
    } else {
        json_error_response('Service is unavailable. Please try later ' . $e->getMessage(), 500);
    }
});

$request = new \App\Kernel\Request();
$router = new \App\Kernel\Router($request);

require_once __DIR__ . '/../routes.php';

$router->resolve();