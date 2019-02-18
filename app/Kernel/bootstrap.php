<?php

/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 17.02.19
 * Time: 19:19
 */

require __DIR__ . '/../../vendor/autoload.php';

error_reporting(E_ALL);
session_start();

global $config;//Yes, I know this is bad. In real world we should use Registry patter or IoC
$config = require_once __DIR__ . '/../config.php';

//Global error handlers
//All unhandled exceptions go here
set_exception_handler(function(Throwable $e) {
    if ($e instanceof \App\Kernel\Exception\HttpException) {
        json_error_response($e->getMessage(), $e->getCode());
    } else {
        json_error_response('Service is unavailable. Please try later ' . $e->getMessage(), 500);
    }
});

//Capture request
$request = new \App\Kernel\Request();

//Setup router
$router = new \App\Kernel\Router($request);
require_once __DIR__ . '/../routes.php';

//Run app
$router->resolve();