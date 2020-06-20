<?php

$app->post('/v1/token', ['\\Auth\\Services\\Controllers\\AuthController','generateToken']) ;