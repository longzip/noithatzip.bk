<?php

class controllers_init
{
	
    public function __construct()
    {
        /**
         * SET USER PARAM
         */
        global $g_user;
        if(!defined('SITE_URL')) 
        {
             
            if((isset($_SESSION['user_name']) && isset($_SESSION['password'])))
            {
    			
    			if(!preg_match('/^[a-zA-Z0-9_]{3,31}$/', $_SESSION['user_name'])) 
                {
                    return FALSE;
                }
                $user = models_DB::get('SELECT * FROM ' . USER_TABLE . ' WHERE user_name=\'' . $_SESSION['user_name'] .'\' AND password=\'' . $_SESSION['password'] . '\'');        
                if(!empty($user)) 
    			{
    				 $g_user = $user[0];
    			     define('USER_PERMISSION', $g_user['permission']);
                     define('USER_ID', $g_user['id']);
    			}
    			else 
                {   
                    define('USER_ID', 0);
                    define('USER_PERMISSION', 'GUEST');   
                }
            }
    		else
    		{
    		    define('USER_ID', 0);
    			define('USER_PERMISSION', 'GUEST');
    		}
        }
        
        
        /**
         * MAGIC QUOTE SET UP
         */
        if (get_magic_quotes_gpc()) {
            $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
            while (list($key, $val) = each($process)) {
                foreach ($val as $k => $v) {
                    unset($process[$key][$k]);
                    if (is_array($v)) {
                        $process[$key][stripslashes($k)] = $v;
                        $process[] = &$process[$key][stripslashes($k)];
                    } else {
                        $process[$key][stripslashes($k)] = stripslashes($v);
                    }
                }
            }
            unset($process);
        }
        
        
        /**
         * DEFINE CONSTANT
         */
         if(!defined('SITE_URL')) 
         {
             define('SITE_URL', get_option('site_url'));
             define('URL_SUFFIX', get_option('url_suffix'));
             define('ROUTER_TYPE', get_option('permalink_setting'));
             define('CURRENT_URL', get_current_url());
             define('MAX_ATTACHMENT_PER_FOLDER', get_option('max_attachment_per_folder'));
             define('TEMPLATE', get_option('template'));
             define('TEMPLATE_URL', SITE_URL . '/tpl/' . TEMPLATE);
             define('TEMPLATE_PATH', PATH_ROOT. '/tpl/' . TEMPLATE);
             define('ROBOTS_INDEX', get_option('robots_index'));   
             
         }
         
         
         
    }
    
    public static function home_init()
    {
         
    }

}