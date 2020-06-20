<?php

namespace Auth\Services\Controllers;

use Ambitious\Core;
use OAuth2;

class AuthController
{

    function generateToken($request, $response)
    {
        // create some users in memory
        $users = array('abhi' => array('password' => 'pass123', 'first_name' => 'Abhi', 'last_name' => 'G'));

        // create test clients in memory
        $clients = array('TestClient' => array('client_secret' => 'TestSecret'));

        // create a storage object
        $storage = new OAuth2\Storage\Memory(array('client_credentials' => $clients,'user_credentials' => $users));

        $server = new OAuth2\Server($storage);

        // create the grant type
        $grantType = new OAuth2\GrantType\UserCredentials($storage);

        // add the grant type to your OAuth server
        $server->addGrantType($grantType);

        $server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();

    }

}