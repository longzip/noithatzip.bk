<?php

/* attack */




include PATH_ROOT . '/inc/black-list-ip.php';



if(in_array($_SERVER['REMOTE_ADDR'], $black_ips)) die('');



$black_ip_ranges = array(
    //'74.125',
    //'111.13',
    //'1.0.252'
);

foreach($black_ip_ranges as $black_ip_range)
{
    if( strpos( 'hcv' . $_SERVER['REMOTE_ADDR'], $black_ip_range ) ) die('');
}




/* END attack */

if(!defined('SECURE_CHECK')) die('Stop');





/**
 * Database connection
 */
$global_sqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


if($global_sqli->connect_errno) die('Cannot connect Database : ' . $global_sqli->connect_errno);
$global_sqli->query("SET NAMES utf8");



/**
 * Table define
 */
define('USER_TABLE', TABLE_PREFIX . 'user');
define('OPTION_TABLE', TABLE_PREFIX . 'option');
define('CONFIG_TABLE', TABLE_PREFIX . 'config');
define('POST_TABLE', TABLE_PREFIX . 'post');
define('COMMENT_TABLE', TABLE_PREFIX . 'comment');
define('CATEGORY_TABLE', TABLE_PREFIX . 'category');
define('TAG_TABLE', TABLE_PREFIX . 'tag');
define('ATTACHMENT_TABLE', TABLE_PREFIX . 'attachment');
define('BLOCK_TABLE', TABLE_PREFIX . 'block');
define('BLOCK_AREA_TABLE', TABLE_PREFIX . 'block_area');
define('FIELD_TABLE', TABLE_PREFIX . 'field');
define('NOTIFICATION_TABLE', TABLE_PREFIX . 'notification');
define('CHAT_TABLE', TABLE_PREFIX . 'chat');
define('POST_TYPE_TABLE', TABLE_PREFIX . 'post_type');
define('ORDER_TABLE', TABLE_PREFIX . 'order');
define('FORM_TABLE', TABLE_PREFIX . 'form');
define('EXTENSION_TABLE', TABLE_PREFIX . 'extension');
define('VISITOR_TABLE', TABLE_PREFIX . 'visitor');
define('STATISTIC_TABLE', TABLE_PREFIX . 'statistic');
define('KHU_VUC_TABLE', TABLE_PREFIX . 'khu_vuc');
define('CHAT_VISITOR_TABLE', TABLE_PREFIX . 'chat_visitor');




include dirname(__FILE__) . '/inc/global_variable.php';
include dirname(__FILE__) . '/system/helper/default.php';



require_once 'inc/prefix_function.php';

$g_DB = new models_DB;
$g_init = new controllers_init;
$g_views_BlockArea = new views_BlockArea;



require_once 'inc/get_function.php';
require_once 'inc/insert_function.php';
require_once 'inc/delete_function.php';
require_once 'inc/update_function.php';
require_once 'inc/display_function.php';
require_once 'inc/other_function.php';
require_once 'inc/chat_function.php';

//require_once 'inc/temp.php';

require_once 'inc/front_end_version.php';

/**
Some Config
*/
define('CDN_DOMAIN', get_option('site_url'));
define('CDN_TIMTHUMB', CDN_DOMAIN);
if(!defined('MEDIA_ROOT')) define('MEDIA_ROOT', dirname( dirname(dirname(__FILE__)) ) . '/' . DOMAIN . '/public_html/uploads' ); //Sua khi thay VPS
if(!defined('CLIENT_ROOT')) define('CLIENT_ROOT', dirname( dirname(dirname(__FILE__)) ) . '/' . DOMAIN . '/public_html' ); //Sua khi thay VPS
define('CDN_TEMPLATE_URL', CDN_DOMAIN . '/tpl/' . TEMPLATE); //Sua khi thay VPS
define('CDN_TEMPLATE_PATH', PATH_ROOT . '/tpl/' . TEMPLATE);  //Sua khi thay VPS

/**
END Some Config
*/

$actived_extensions = get_option('actived_extensions');
if(empty($actived_extensions)) $actived_extensions = array();
else $actived_extensions = json_decode($actived_extensions, TRUE);
/**
 * Default Init
 */


//Other Define
$timthumb_quality = get_option('v-timthumb-quality');
if( empty($timthumb_quality) ) define( 'TIMTHUMB_QUALITY', 75 );
else define( 'TIMTHUMB_QUALITY', $timthumb_quality );
//#END Other Define


$mail_info_info =  array();

$mail_no_reply_info = array();
$mail_no_reply_info['user_name'] = get_option('no-reply-email-user');
if(empty( $mail_no_reply_info['user_name'] )) $mail_no_reply_info['user_name']  = '';
$mail_no_reply_info['password'] = get_option('no-reply-email-password');
if(empty( $mail_no_reply_info['password'] )) $mail_no_reply_info['password']  = '';

if(!strpos( $mail_no_reply_info['user_name'], '@' ))
{

}


// h($mail_no_reply_info);

$g_router = new controllers_router;



controllers_load::helper('form');

//$g_template = get_option('template');



//$g_tpl_url = SITE_URL . '/tpl/' . $g_template;


//if(!TEMPLATE) $g_template = 'default';


/**
  * Define constant
  */

//Smarty

//clear_smarty_cache();

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
        $this->setCompileDir(PATH_ROOT . '/tpl/tpl/' . 'templates_c/' . DOMAIN_ID . '/');
        $this->setConfigDir(PATH_ROOT . '/tpl/tpl/' . 'configs/');
        $this->setCacheDir(PATH_ROOT . '/tpl/tpl/' . 'cache/');

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        //$smarty->caching = 2;
   }

}



require_once( PATH_ROOT . '/system/class/functions/list.php');
$smarty = new hcv_Smarty();
$g_functions = new functions_list();
$g_models_DB = new models_DB();
$g_views_BlockArea = new views_BlockArea();


$smarty->assign('g_user', $g_user);
$smarty->assign('g_functions', $g_functions);
$smarty->assign('g_models_DB', $g_models_DB);
$smarty->assign('g_views_BlockArea', $g_views_BlockArea);

$smarty->assign('c_cdn_template_url', CDN_TEMPLATE_URL);

if(file_exists( CLIENT_ROOT . '/tpl/tpl/' . TEMPLATE )) $smarty->assign('c_fontend_template_url', SITE_URL . '/tpl/tpl/' . TEMPLATE );
else $smarty->assign('c_fontend_template_url', CDN_DOMAIN . '/tpl/tpl/' . TEMPLATE );

$smarty->assign('c_cdn_domain', CDN_DOMAIN);
$smarty->assign('c_cdn_path_root', PATH_ROOT);
$smarty->assign('c_cdn_tpl_tpl_path', PATH_ROOT . '/tpl/tpl');
$smarty->assign('c_cdn_client_root', CLIENT_ROOT);
$smarty->assign('c_fontend_template_path', PATH_ROOT . '/tpl/tpl/' . TEMPLATE );
$smarty->assign('c_site_url', SITE_URL);
$smarty->assign('c_url_suffix', URL_SUFFIX);
$smarty->assign('template', TEMPLATE);
$smarty->assign('customer_url', CDN_DOMAIN .'/tpl/tpl/customer/' . DOMAIN );
$smarty->assign('v', FRONT_END_VERSION );
$smarty->assign('g_user', $g_user );




//For box
$i = 1;
while(file_exists( PATH_ROOT . '/tpl/tpl/box/box' . $i . '.tpl' ))
{
    $smarty->assign('box' . $i . '_thumbnail_width', get_config('box' . $i . '_thumbnail_width'));
    $smarty->assign('box' . $i . '_thumbnail_height', get_config('box' . $i . '_thumbnail_height'));
    $smarty->assign('box' . $i . '_class', get_config('box' . $i . '_class'));
    $i++;
}
// END for box


// end Smarty
