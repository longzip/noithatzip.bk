<?php
//Khai báo các giá tr? m?c d?nh và các tru?ng input



$default_value = array(
    'form_id'           => 1,
    'time_delay_minute' => '0',
    'time_delay_second' => '20',
    'display_style'     => '1',
    'form_position'     => 'top_right',
    'top'               => '55',
    'right'             => 10,
    'left'               => 10,
    'bottom'            => 55
);

if(isset($_POST['submit']))
{
    setcookie('popup_form', '1', time() - 86400 * 30, '/');
      
    delete_extension_by_name($extension_name);
    
    $insert_content = array();
    $insert_content['display_position'] = 'begin';
    if(empty($_POST['is_actived'])) $insert_content['is_actived'] = 0;
    else $insert_content['is_actived'] = 1;
    $insert_content['attributes'] = json_encode( array(
        'repeat_time_day'       => $_POST['time_day'], 
        'repeat_time_hour'      => $_POST['time_hour'], 
        'repeat_time_minute'    => $_POST['time_minute'], 
        'repeat_time_second'    => $_POST['time_second']
        ) 
    );
    $insert_content['name'] = $extension_name;
    $insert_id = models_DB::insert($insert_content, EXTENSION_TABLE);
    
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
    die();
}
else
{
    
    
    $t = 'SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'PopupForm\' AND display_position=\'before_close_body\'' ;
    $_info = models_DB::get($t);
    
    if(empty($_info))
    {
        $extension_info[0]['is_actived'] = 0;
    }
    else
    {
        $temp = json_decode($_info[0]['attributes'], TRUE);   
        $extension_info = $_info;
        
        foreach($default_value as $k=>$v)
        {
            if(isset($temp[$k])) $default_value[$k] = $temp[$k];
        }
          
    }
     
}

 

 