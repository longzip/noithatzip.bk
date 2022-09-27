<?php
session_start();
error_reporting(E_ALL);



define('SECURE_CHECK', true);
define('ADMIN_PAGE', TRUE);

include dirname(dirname(__FILE__)).'/config.php';

 

include PATH_ROOT . '/inc/index-cdn.php';
