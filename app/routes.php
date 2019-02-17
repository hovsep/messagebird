<?php

$router->get('/api/v1', function() {
    //Direct response
    json_response(['message' => 'Welcome to SMS sending REST API !']);
});

$router->post('/api/v1/sendSms', function(\App\Kernel\Request $request) {
    //Call controller action
    call_controller(\App\Controller\SmsGateController::class, 'sendSms', [$request]);
});
