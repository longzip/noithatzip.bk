<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
if(!defined('SECURE_CHECK')) define('SECURE_CHECK', true);
if(!defined('ADMIN_PAGE')) define('ADMIN_PAGE', true);





//include dirname(dirname(__FILE__)).'/config.php';

if(isset($_GET['page_type'])) $g_page_info['page_type'] = $_GET['page_type'];
else $g_page_info['page_type'] = 'home';

//$g_all_admin_page_type = array('general', 'new-option', 'template', 'forum', 'new-forum', 'edit-forum', 'delete-forum', 'posts');






$g_router = new controllers_router;



$exclude_page = array('login', 'logout');

if( !in_array($g_page_info['page_type'], $exclude_page) ) if($g_user['permission'] == 'guest') header('Location: ' . SITE_URL . '/admin?page_type=login');




include $g_page_info['page_type'] . '.php';
