<?php

$router->get('/', function() {
    echo json_response(['message' => 'Welcome to SMS sending REST API !']);
});
