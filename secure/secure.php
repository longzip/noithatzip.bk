<?php
class secure_secure
{
    public static function check_login($user_name, $password)
    {
        $moment_obj = new models_DB;
        $get_user = $moment_obj->get('SELECT * FROM ' . USER_TABLE . ' WHERE user_name=\'' . $user_name . '\' AND password=\''. md5($password) .'\'');
        if(!empty($get_user)) 
        {
            setcookie('user_name',$user_name, time() +  60*60*24*30, '/');
            setcookie('password',md5($password), time() + 60*60*24*30, '/');
            //if(isset($_GET['continue']))  header('Location: ' .$_GET['continue']) ;
            //else 
            //header('Location: index.php');
            return true;
        }
        
        else return false;
    }
    
    public static function check_admin()
    {
        if( !isset($_COOKIE['user_name']) || !isset($_COOKIE['password']) ) die('You must <a href="' .SITE_URL. '/admin/login.php?continue=' . get_current_url() . '">login</a> to continue');
        
        
        else
        {
            $moment_obj = new models_DB;
            $get_user = $moment_obj->get('SELECT * FROM ' . USER_TABLE .' WHERE user_name=\'' . $_COOKIE['user_name'] . '\' AND password=\''. $_COOKIE['password'] .'\'');
            if(empty($get_user)) return false;
            else return true;
        }        
    }
    
    
    
    public static function check_user_login($user_name, $password)
    {
        
        global $global_current_row;
        //$global_current_row['user'] = array('title'=>'ten');
        //return true;
        $exist = models_query::query_posts_by_post_type(array('post_type_id'=>USER_POST_TYPE_ID, 'post_type_table'=>1, 'user_name'=>$user_name, 'password'=> md5($password)));
        ///h($exist);
        if(empty($exist)) return false;
        else
        {
            setcookie('user_name',$user_name, time() +  60*60*24*30, '/');
            setcookie('password',md5($password), time() + 60*60*24*30, '/');
            $global_current_row['user'] = $exist[0];
           
            return true;
        }
    }
    
    public static function generator_random_secure_key()
    {
        models_DB::query_string('UPDATE TABLE config SET secure_key = \'' .random_string(). '\'');
    }
}