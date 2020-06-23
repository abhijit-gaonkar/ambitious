<?php

$app->post('/v1/token', ['\\Auth\\Services\\Controllers\\AuthController','generateToken']) ;
$app->get('/status', function($response) {
    return $response->withStatus(200);
});