<?php
  require_once 'Recursos/vendor/autoload.php';

  $clientID = '284388371606-6du1403daqmins6ic96hpggtuqt3pbl3.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/cohesio/ACTIVITAT-DE-COHESIO/Codi/Controlador/controlador.php';

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

 
?>