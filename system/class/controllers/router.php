<?php

if(!defined('SECURE_CHECK')) die('Invalid to include');
class controllers_router
{
    public function __construct()
    {
        //$request_uri = explode('/', $_SERVER['REQUEST_URI']);
        
        self::$url =  str_replace_one(SITE_URL . '/', '', CURRENT_URL);
        
         
        
        //$temporary = explode('?', self::$url);
        
        //$real_url = explode('/', $temporary[0]);
        
        //self::$real_url = $real_url[0];
    }
    
    public static function admin_url_router()
    { 
    }
    
    
    
    public static function url_router()
    {
        global $g_page_info;
        
         
         
        //global $g_all_page_type;
        //global $g_user;
        
        //self::$url = str_replace_one(SITE_URL . '/', '', CURRENT_URL);
        
         
        if( ROUTER_TYPE == '0' ) include PATH_ROOT . '/inc/routers/router-0.php';
		else include PATH_ROOT . '/inc/routers/router-' . ROUTER_TYPE . '.php';
       
		 
    }
    public static $real_url;
    public static $url;
}