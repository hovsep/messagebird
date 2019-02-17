<?php
/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 17.02.19
 * Time: 19:19
 */

require __DIR__.'/../vendor/autoload.php';

$request = new \App\Kernel\Request();

print_r($request->getBody());