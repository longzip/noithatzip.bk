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
        
        
         
        //Remove not exsit colum
        if(0)
        {
            foreach($insert_content as $k_insert_content => $v_insert_content)
            {
                $temp = "SHOW COLUMNS FROM `" . $table_name . "` LIKE '" . $k_insert_content . "'"; 
                $t_result = self::$class_sqli->query($temp);     
                if(!empty($t_result))
                {
                    $exists = ($t_result->num_rows)?TRUE:FALSE;  
                    if(!$exists) 
                    {
                        unset($insert_content[$k_insert_content]);
                    }
                } 
                
            }
        }
        //#END Remove not exsit colum
        
        //ADD column if not exsit
        if(0)
        {
            foreach($insert_content as $k_insert_content => $v_insert_content)
            {
                $temp = "SHOW COLUMNS FROM `" . $table_name . "` LIKE '" . $k_insert_content . "'"; 
                $t_result = self::$class_sqli->query($temp);     
                if(!empty($t_result))
                {
                    $query_string = 'ALTER TABLE ' . $table_name . ' ADD ' . pretty_string($k_insert_content, '_') . ' VARCHAR(225) NOT NULL';
                    self::$class_sqli->query($query_string);
                } 
                
            }
        }
        //#END ADD column if not exsit
        
        
        
        
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
        
         //echo $moment, '<br />';
        
        models_GlobalQueryString::add($moment);
        
        $result = self::$class_sqli->query($moment);
        
        if($result) self::$last_result_status = 'Insert Success'; 
        else 
        {
             
            self::$last_result_status = self::$class_sqli->error; 
            models_GlobalQueryString::error(self::$class_sqli->error);
        }
           
        return self::$class_sqli->insert_id;
    }
    
    public static function update($new_value, $talbe_name, $where)
    { 
        $query_string = 'UPDATE ' . $talbe_name . ' SET ';
        $i = 0;
         
        //Remove not exsit colum
        if(1)
        {
            foreach($new_value as $k_insert_content => $v_insert_content)
            {
                $temp = "SHOW COLUMNS FROM " . $talbe_name . " LIKE '" . $k_insert_content . "'"; 
                //echo $temp;
                $t_result = self::$class_sqli->query($temp);     
                if(!empty($t_result))
                {
                    $exists = ($t_result->num_rows)?TRUE:FALSE;  
                    if(!$exists) 
                    {
                        unset($new_value[$k_insert_content]);
                    }
                } 
                
            }
        }
        //#END Remove not exsit colum
        
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
        //echo $query_string;
         
        
        $query = self::$class_sqli->query($query_string);
        
        
        
        if(!$query) self::$last_result_status = self::$class_sqli->error; else self::$last_result_status = 'Success for update data';
        return $query;
    }
	
	public static function delete($talbe_name, $where)
    {
         
        $query_string = 'DELETE FROM ' . $talbe_name . '  ' . $where;
        
        $query = self::$class_sqli->query($query_string);
           
        if(!$query) self::$last_result_status = self::$class_sqli->error; else self::$last_result_status = 'Success for update data';
        return $query;
    }
    
    public static function get($query_string)
    {
        $result = array();
        $query = self::$class_sqli->query($query_string);
        models_GlobalQueryString::add($query_string);
        
		//echo $query_string, '<br />'; 
		
        if(empty($query)) return array();
        
		if($query->num_rows == 0) return array();
		
        if(!$query) models_GlobalQueryString::error(self::$class_sqli->error); else self::$last_result_status = 'Success for get data';
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