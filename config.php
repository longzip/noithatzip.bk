<?php





if(!defined('SECURE_CHECK')) die('Stop');



define('DOMAIN_ID', '41674');



$domain = pathinfo(dirname(dirname(__FILE__)));



define('DOMAIN', $domain['basename']);

if(!defined('MEDIA_ROOT')) define('MEDIA_ROOT',  dirname(__FILE__) . '/uploads' );  //Sua khi thay VPS

if(!defined('CLIENT_ROOT')) define('CLIENT_ROOT', dirname(__FILE__) ); //Sua khi thay VPS





define('DB_HOST', 'localhost');

define('DB_USER', 'zip');

define('DB_PASSWORD', 'Zip@2022');

define('DB_DATABASE', 'noithatzip_new');



define('MAX_UPLOAD_DIR_SIZE', 1000000000 );

define('TABLE_PREFIX', 'hcv_');



define('PATH_ROOT', dirname(__FILE__) );



include PATH_ROOT . '/other.php';

