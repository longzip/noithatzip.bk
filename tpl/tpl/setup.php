<?php
/* Smarty
if (function_exists('mb_internal_charset')) {
  mb_internal_charset('UTF-8');
}
define('SMARTY_RESOURCE_CHAR_SET', 'UTF-8');

require_once( PATH_ROOT . '/apps/smarty-3.1.30/libs/Smarty.class.php');

class hcv_Smarty extends Smarty {

   function __construct()
   {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->setTemplateDir( PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/' );
        $this->setCompileDir(PATH_ROOT . '/tpl/tpl/' . 'templates_c/');
        $this->setConfigDir(PATH_ROOT . '/tpl/tpl/' . 'configs/');
        $this->setCacheDir(PATH_ROOT . '/tpl/tpl/' . 'cache/');

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        //$smarty->caching = 2; 
   }

} 
require_once( PATH_ROOT . '/system/class/functions/list.php');
 
end */

//require_once( PATH_ROOT . '/tpl/tpl/setup.php');

 

global $smarty;    
global $g_functions;
global $g_models_DB;
global $g_views_BlockArea; 

$site_url_widthout_http = str_replace('https://', '', SITE_URL);
$site_url_widthout_http = str_replace('http://', '', SITE_URL);
 

if(file_exists( CLIENT_ROOT . '/tpl/tpl/' . TEMPLATE )) include 'custom-looking-file.php';
else include 'cdn-looking-file.php';