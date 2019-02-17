<?php

$router->get('/api/v1', function(\App\Kernel\Request $request) {
    json_response(['message' => 'Welcome to SMS sending REST API !']);
});
