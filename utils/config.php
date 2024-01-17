<?php

/*
  Here is define connect to MySQL server in localhost
  ----------------------------------------------------------------------------------
    !!! Note to RUNNING SERVER  !!!
    
    =>DB_NAME, DB_USER, DB_PASSWORD need to replace with settings in DataBase Table

    =>DB_SOCKET can other PATH
  ----------------------------------------------------------------------------------

*/

// define connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_accounts');
define('DB_USER', 'ad_db_ct07');
define('DB_PASSWORD', 'admin');
define('DB_PORT', '3306');
define('DB_SOCKET', '/Applications/AMPPS/apps/mysql/var/mysql.sock');

// define Google API configuration
define('client_id', '561685310040-3508vsi0vm2td439n8f2uiv9gattqp9r.apps.googleusercontent.com');
define('client_secret', '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');
define('redirect_uri', 'http://localhost:3000/Projects/src/home/sign-in/Oauth/oauth-google.php');

//  set Client Configs in Google API
require(__DIR__ . "/../vendor/autoload.php");
$client = new Google\Client();
$client->setClientId(client_id);
$client->setClientSecret(client_secret);

$client->setRedirectUri(redirect_uri);
$client->addScope("email");
$client->addScope("profile");


?>