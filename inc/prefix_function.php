<?php
/**
 * Get value from option table
 */
function get_option($option_name)
{
    $result = models_DB::get('SELECT value FROM ' . OPTION_TABLE . ' WHERE name=\''. $option_name . '\'');
    
    //echo 'SELECT value FROM ' . OPTION_TABLE . ' WHERE name=\''. $option_name . '\'';
    
    if(empty($result)) return FALSE;
    else return $result[0]['value'];
}

function get_option_info($option_name)
{
    $result = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE name=\''. $option_name . '\'');
    
    //echo 'SELECT value FROM ' . OPTION_TABLE . ' WHERE name=\''. $option_name . '\'';
    
    if(empty($result)) return FALSE;
    else return $result[0];
}

/**
 * Autoload function
 */
function __autoload($name)
{ 
      
    $list_core_class = array('models_DB', 'models_delete_function', 'models_ExternalDB', 'models_GlobalQueryString', 'models_HandleAction', 'models_manipulation','models_query', 'controllers_init','views_view','controllers_router','controllers_load', 'views_BlockArea', 'functions_list');
    if(!in_array($name, $list_core_class)) return;
    $parts = explode('_', $name);
    require_once PATH_ROOT . '/system/class/' . $parts[0] . '/' . $parts[1] . '.php';
}