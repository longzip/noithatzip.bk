<?php
if((isset($temp_post_type['require'])) && ($temp_post_type['require'] == '1') && (!isset($_POST[$temp_post_type['name']]))) $g_form_error_noti[] = '- Bạn chưa nhập <span class="noti-title">'. $temp_post_type['title'] . '</span>';
 

else
{
    if(isset($_POST[$temp_post_type['name']]))
    {
         $default_value[$temp_post_type['name']] =  $_POST[$temp_post_type['name']];


         $insert_content[$temp_post_type['name']] = $_POST[$temp_post_type['name']];
    }
    else
    {
        $default_value[$temp_post_type['name']] =  '';

        $insert_content[$temp_post_type['name']] = '';
    }
    
    
    
    
    
    
}
