<?php
//session_start();

if(isset($_GET['domain'])) setcookie( 'domain', urldecode($_GET['domain']), time() + 60, '/' );

require_once PATH_ROOT . '/apps/login-with-facebook/Facebook/autoload.php';

$fb = new Facebook\Facebook ([
  'app_id' => '268957206966770', 
  'app_secret' => '7689254a586f8a1b89ad0814e569377b',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
    
if (! isset($accessToken)) {
    $permissions = array('public_profile','email'); // Optional permissions
    $loginUrl = $helper->getLoginUrl('https://bus.zland.vn/inc/?page_type=facebook-signin', $permissions);
    header("Location: ".$loginUrl);  
  exit;
}

try {
  // Returns a `Facebook\FacebookResponse` object
  $fields = array('id', 'name', 'email');
  $response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user_encoded = $response->getGraphUser();
$user_encoded['picture'] = 'http://graph.facebook.com/' . $user_encoded['id'] . '/picture';
$user_encoded['picture'] = urlencode($user_encoded['picture']);

if(isset($_COOKIE['domain'])) $domain = $_COOKIE['domain'];
$t = 'Location:' . $domain . '/inc/?page_type=get-user-info-from-url&fb_id=' . $user_encoded['id'] . '&display_name=' . $user_encoded['name']   . '&email=' . $user_encoded['email']  . '&image=' . $user_encoded['picture'];
header( $t );
 
die();

echo 'Faceook ID: ' . $user['id'];
echo '<br />Faceook Name: ' . $user['name'];
echo '<br />Faceook Email: ' . $user['email'];
?>