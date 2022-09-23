<?php




//session_start();
error_reporting(E_ALL);



if(!defined('SECURE_CHECK')) define('SECURE_CHECK', true);
if(!defined('ADMIN_PAGE')) define('ADMIN_PAGE', false);

if(isset($_GET['page_type'])) $g_page_info['page_type'] = $_GET['page_type'];
else $g_page_info['page_type'] = 'home';

$g_router = new controllers_router;


include $g_page_info['page_type'] . '.php';
