<?php

if((isset($temp_post_type['require'])) && ($temp_post_type['require'] == '1') && (empty($_POST[$temp_post_type['name']]))) $g_form_error_noti[] = '- Bạn chưa nhập <span class="noti-title">'. $temp_post_type['title'] . '</span>';

else
{
    if(empty($_POST[$temp_post_type['name']])) $_POST[$temp_post_type['name']] = array();
    
    //$temp_cat_array = explode(',', )
    
    foreach($_POST[$temp_post_type['name']] as $temp_tag)
    {
        if(!is_numeric($temp_tag)) die('Tag id is not a number');
    }
    
    //if(empty($_POST[$temp_post_type['name']])) $_POST[$temp_post_type['name']] = $_POST[$temp_post_type['name']] = array();
    
    $default_value[$temp_post_type['name']] = implode(',', $_POST[$temp_post_type['name']]);
    $insert_content[$temp_post_type['name']] = implode(',', $_POST[$temp_post_type['name']]);
} 
 


