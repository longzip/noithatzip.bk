<?php

$default_value = array(
    'display_style'             => '1',
    'hotline_position'          => 'bottom_right',
    'color1'                    => '005ba5',
    'color2'                    => '338cd4',
    'top'                       => '120',
    'bottom'                    => '20',
    'right'                     => '100',
    'left'                      => '100'
); 

if(isset($_POST['submit']))
{
    
    update_option('fixed-hotline', $_POST['content']);
      
    delete_extension_by_name($extension_name);
    
    $insert_content = array();
    $insert_content['display_position'] = 'before_close_body';
    if(empty($_POST['is_actived'])) $insert_content['is_actived'] = 0;
    else $insert_content['is_actived'] = 1;
    if(!empty($_POST['active'])) $active = 1;
    else $active = 0;
    
    
    
    $attributes = array();
    foreach($default_value as $k=>$v)
    {
        $attributes[$k] = $_POST[$k];
    }
    $insert_content['attributes'] = json_encode( $attributes ); 
    
     
     
    $insert_content['name'] = $extension_name;
    $insert_id = models_DB::insert($insert_content, EXTENSION_TABLE);
    
    header('Location:'.CURRENT_URL);
}
else
{
    $t = 'SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'FixedHotline\' AND display_position=\'before_close_body\'' ;
    $_info = models_DB::get($t);
   
    
    
    if(empty($_info))  
    {
        
    }   
    else
    {
        $extension_info = get_extension($extension_name);
        
        
        
        $extension_info1 = $_info[0];
         
        $default_value['display_position'] = $extension_info1['display_position'];
        $temp = json_decode($extension_info1['attributes'], TRUE);        
          
        $attr = $temp;       
        
        foreach($default_value as $k=>$v)
        {
            if(isset($temp[$k])) $default_value[$k] = $temp[$k];
        }
         
         
    }  
     
}

 