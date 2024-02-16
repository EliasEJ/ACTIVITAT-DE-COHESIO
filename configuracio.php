<?php
  require_once 'vendor/autoload.php';

  $clientID = '82832488003-ohurv2hbsqqvavuj10to35pgavj5qcc5.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/Practiques/Pt05_AlexVazquez/Controlador/usuari_controlador.php';

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

 
?>