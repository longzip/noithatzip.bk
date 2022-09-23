<?php
class hcv_init
{
    public function __construct()
    {
        global $g_user;
        if((isset($_COOKIE['user_name']) && isset($_COOKIE['password'])))
        {
            $user = models_DB::get('SELECT * FROM ' . USER_TABLE . ' WHERE user_name=\'' . $_COOKIE['user_name'] .'\' AND password=\'' . $_COOKIE['password'] . '\'');        
            if(!empty($user)) $g_user = $user[0];
        }
    }
}