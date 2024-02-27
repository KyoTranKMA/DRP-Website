<?php

// define Google API configuration
define('client_id', '561685310040-3508vsi0vm2td439n8f2uiv9gattqp9r.apps.googleusercontent.com');
define('client_secret', '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');
define('redirect_uri', 'http://localhost:3000/auth/google_login.php');

//  set Client Configs in Google API
require(__DIR__ . "/../vendor/autoload.php");
$client = new Google\Client();
$client->setClientId(client_id);
$client->setClientSecret(client_secret);

$client->setRedirectUri(redirect_uri);
$client->addScope("email");
$client->addScope("profile");


?>