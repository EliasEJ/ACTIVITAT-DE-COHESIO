<?php
  require_once 'configuracio.php';

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;

  // get profile picture
  $picture = $google_account_info->picture;

    // save picture in session
    $_SESSION['picture'] = $picture;
}
?>