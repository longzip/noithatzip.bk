<?php
$google_client_id 		= '77863781413-ke6krtsrctpv8vkbhi1a2senvp7g9opu.apps.googleusercontent.com';
$google_client_secret 	= 'QnARIQy0vY8ReQhyeaY2EWHZ';
$google_redirect_url 	= SITE_URL . '/inc/?page_type=google-signin-redirect'; //path to your script
$google_developer_key 	= 'AIzaSyB4S_V67aebZpN6Fp7hxdEM8sggT7XcTN8';
require_once PATH_ROOT . '/apps/login-with-google/Google/Google_Client.php';
require_once PATH_ROOT . '/apps/login-with-google/Google/contrib/Google_Oauth2Service.php';

 
 
$gClient = new Google_Client();
$gClient->setApplicationName('Login to demo.zland.vn');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);
 
$google_oauthV2 = new Google_Oauth2Service($gClient);
 
//If user wish to log out, we just unset Session variable

 
if (isset($_REQUEST['reset'])) 
{
  unset($_SESSION['token']);
  $gClient->revokeToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	return;
}
 
 
if (isset($_SESSION['token'])) 
{ 
	$gClient->setAccessToken($_SESSION['token']);
}
 
 
if ($gClient->getAccessToken()) 
{
	  //For logged in user, get details from google using access token
      h($user);
	  $user 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $user['id'];
	  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
	  $_SESSION['token'] 	= $gClient->getAccessToken();
}
else {
	//For Guest user, get google login url
	$authUrl = $gClient->createAuthUrl();
}
 
if(isset($authUrl)) //user is not logged in, show login button
{
	header("Location: ".$authUrl);
} 
else // user logged in 
{	
	//list all user details
	echo '<pre>'; 
	print_r($user);
	echo '</pre>';	
}