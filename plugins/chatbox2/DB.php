<?php
class models_DB
{
    public function __construct()
    {
        global $global_sqli;
        self::$class_sqli = $global_sqli;
    }
    
    public static function insert($insert_content, $table_name)
    {
        foreach($insert_content as $k_insert_content => $v_insert_content)
        {
            $insert_content[$k_insert_content] = self::$class_sqli->real_escape_string($v_insert_content);
        }
        
        $i = 0;
        $array_lengh = count($insert_content);
        $column = '';
        $value = '';
        foreach($insert_content as $k_insert_content => $v_insert_content)
        {
            $i++;
            if($i != $array_lengh)
            {
                $column .= $k_insert_content . ', ';
                $value  .= "'$v_insert_content', ";
            }
            else
            {
                $column .= $k_insert_content;
                $value  .= "'$v_insert_content'";
            }
        }
        
        $moment = "INSERT INTO $table_name($column) VALUES($value)";
        //echo $moment,"<br />";
        
        
        $result = self::$class_sqli->query($moment);
        
        if($result) self::$last_result_status = 'Insert Success'; 
        else 
        {
            //echo self::$class_sqli->error
            self::$last_result_status = self::$class_sqli->error;
            
        }
        //echo self::$last_result_status;    
        return self::$class_sqli->insert_id;
    }
    
    public static function update($new_value, $talbe_name, $where)
    {
        //h($new_value);
        $query_string = 'UPDATE ' . $talbe_name . ' SET ';
        $i = 0;
        foreach($new_value as $k => $v)
        {
            $new_value[$k] = self::$class_sqli->real_escape_string($v);
        }
        foreach($new_value as $k=>$v)
        {
            if($i == 0) $query_string .= $k . '=' . '\''. $v .'\'';
            else $query_string .= ', ' . $k . '=' . '\''. $v .'\'';
            $i++;
        }
        
        $query_string .= ' ' . $where;
        
        //echo $query_string, '<br /><br />';
        
        $query = self::$class_sqli->query($query_string);
          //echo $query_string;
        if(!$query) self::$last_result_status = self::$class_sqli->error; else self::$last_result_status = 'Success for update data';
        return $query;
    }
    
    public static function get($query_string)
    {
         //echo $query_string, '<br />';
        //h(self::$class_sqli);
        $result = array();
        $query = self::$class_sqli->query($query_string);
        
        $i = 0;
        while($row = $query->fetch_assoc())
        {
            foreach($row as $k_row => $v_row)
            {
                $result[$i][$k_row] = $v_row;
            }
            $i++;
        }
        
        return $result;
        
        
        
        
    }
    

    public static function query_string($query_string)
    {
        $query = self::$class_sqli->query($query_string);
        if($query) self::$last_result_status = 'SUCCESS : '.$query_string; else self::$last_result_status = self::$class_sqli->error;
        return $query;
    }
    
    
    public static $class_sqli;
    
    public static $last_result_status;
}

function get_last_id()
{
    $last_id = models_DB::get('SELECT max(id) as the_max FROM list');    
    if(empty($last_id)) return 0;
    else return $last_id[0]['the_max']; 
}

define('TIME_DELAY', -21600);
define('NUMBER_ITEM_TO_LOAD', 20);

function hcv_time()
{
    return time() - TIME_DELAY;
}
