<?php
if((isset($temp_post_type['require'])) && ($temp_post_type['require'] == '1') && ($_POST[$temp_post_type['name']] == '')) $g_form_error_noti[] = '- Bạn chưa nhập <span class="noti-title">'. $temp_post_type['title'] . '</span>';

if($temp_post_type['max_lenght'] > 0)
{
    validate_value($temp_post_type['name'], $temp_post_type['title'], FALSE, array('max_lenght'=>$temp_post_type['max_lenght']));
    //if(strlen($_POST[$temp_post_type['name']]) > $temp_post_type['max_lenght']) $g_form_error_noti[] = '- Trường <span class="noti-title">'. $temp_post_type['title'] .'</span> bạn nhập quá dài';
}

if($temp_post_type['min_lenght'] > 0)
{
    validate_value($temp_post_type['name'], $temp_post_type['title'], FALSE, array('min_lenght'=>$temp_post_type['min_lenght']));
}


 

if($_POST[$temp_post_type['name']] == '')
{
    $ref_field = get_field($temp_post_type['ref']);
    
    
    
    if($ref_field != FALSE)
    {
        $ref_attribute = json_decode($ref_field['attribute'], TRUE);
        $default_value[$temp_post_type['name']] = pretty_string($_POST[$ref_attribute['name']]);
        $insert_content[$temp_post_type['name']] =  pretty_string($_POST[$ref_attribute['name']]);
        
        
    }
    else
    {
        $default_value[$temp_post_type['name']] =  $_POST[$temp_post_type['name']];
        $insert_content[$temp_post_type['name']] = $_POST[$temp_post_type['name']];
        
    }
}
else
{
    $default_value[$temp_post_type['name']] =  $_POST[$temp_post_type['name']];
    $insert_content[$temp_post_type['name']] = $_POST[$temp_post_type['name']];
}


