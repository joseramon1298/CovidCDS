<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('618088990720-5708uv7ftr20nvf65e4thl0k9ptvlrv0.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/inicia.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>