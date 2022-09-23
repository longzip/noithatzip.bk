<?php
class models_GlobalQueryString
{
    public static function add($param)
    {
        global $global_query_string;
        global $global_query_string_counter;
        $global_query_string[] = $param;
        $global_query_string_counter++;
        //echo 'asdfadsaaaaaaaaaaaaaaaaaaaf';
    }
    
    public static function error($param)
    {
        global $global_query_error;
        global $global_query_error_counter;
        $global_query_error[] = $param;
        $global_query_error_counter++;
    }
}