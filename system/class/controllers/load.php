<?php
class controllers_load
{
    public function __construct()
    {
        
    }
    
    public static function helper($helper_name)
    {
        include_once PATH_ROOT . '/system/helper/' . $helper_name . '.php';
    }
} 