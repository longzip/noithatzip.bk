<?php

$exclude_folders = array('templates_c', 'config', 'cache');
    $exclude_extensions = array('php');
//$temp = get_option('template');


 
/**
  * Define user permission
  */
  
  
$g_user_permission_id = array(
    0 => 'guest',
    1 => 'pending',
    2 => 'member',
    3 => 'publisher',
    4 => 'admin',
    5 => 'super_admin'
);

$g_user_permission = array(
    'super_admin'       => 'Super Admin',
    'admin'             => 'Admin',
    'publisher'         => 'Publisher',
    'member'            => 'Member',
    'guest'             => 'Guest',
    'pending'           => 'Pending'
);


/**
  * Define user level
  */
$g_user_level = array(
    'guest'         => 'Khách',
    'pending'       => 'Thành viên chưa kích hoạt',
    'newmember'     => 'Thành viên mới',
    'member'        => 'Thành viên',
    'admin'         => 'Admin'
);

 $init_active_blocks = array(
        'Form',
        'search',
        'SidebarNews',
        'SidebarNews2',
        'Slide',
        'TextImage',
        'fb',
        'html',
        'image',
        'menu',
        'posts-1',
        'posts-2',
        'text',
        'video'
    );

 


/**
 * User Info
 */
$g_user = array(
    'id'                 => '0',
    'permission'         => 'guest',
    'user_name'          => 'guest',
    'display_name'       => 'Guest',
    'email'              => 'Unknow',
	'user_level'		 => 0
    
);

/**
 * Notification Error
 */
$g_form_error_noti = array();

/**
 * Notification Success
 */
$g_form_success = '';


/**
 * General page info
 */
 $g_page_info = array();
 
 
/**
 * General content
 */
 $g_page_content = array();
 

define('POSTS_PER_PAGE', 10);
 
$g_all_page_type = array('forum', 'post', 'member', 'profile', 'register', 'login','logout', 'congratulation', '404', 'new-thread', 'thank', 'edit-thread', 'fb-login', 'thank', 'reply', 'edit-comment', 'member-list', 'admin-noti');
 
$g_template = 'default';

$external_db = array('host' => '', 'user' => '', 'password' => '', 'name' => '');

//Smarty exclude foldernd file
$exclude_folders = array('templates_c', 'config', 'cache', 'includes');
$exclude_extensions = array('php');
// END 

define('DEMO_URL', '');
define('BUS_URL', '');



// Chat 
define('CONVER_PER_PAGE', 20);
define('DELAY_CHAT_TIME_LEVEL_1', 20);  //second
define('DELAY_CHAT_TIME_LEVEL_2', 86400);  //second

define('DELAY_TO_GET_MESSENGER', 1);  //second
define('TIME_RANGE_ONLINE', 10);  //second
define('TIME_RANGE_TYPING', 2);  //second
// #END Chat 
 
 
 define('DELAY_ACTIVITY_TO_GET_SEND_EMAIL', 6);  //second
define('DELAY_LAST_TIME_TO_GET_SEND_EMAIL', 3600 * 1);  //second

