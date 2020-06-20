<?php

$app->post('/token', ['\\Auth\\Services\\Controllers\\AuthController','generateToken']) ;