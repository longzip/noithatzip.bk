<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);



define('SECURE_CHECK', true);
define('ADMIN_PAGE', TRUE);

include dirname(dirname(__FILE__)).'/config.php';



include PATH_ROOT . '/admin/index-cdn.php';
