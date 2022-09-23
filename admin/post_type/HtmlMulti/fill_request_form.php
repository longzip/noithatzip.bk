<?php

if(!empty($_POST[$temp_post_type['name'] . '_value'])) $temp_value_array = $_POST[$temp_post_type['name'] . '_value']; 
else $temp_value_array = array();

if(!empty($_POST[$temp_post_type['name'] . '_title'])) $temp_display_array = $_POST[$temp_post_type['name'] . '_title']; 
else $temp_display_array = array();

$result_array = array();

foreach($temp_display_array as $k_a =>$v_a)
{
    $result_array[] = array('value'=> change_html($temp_value_array[$k_a]), 'title'=> $v_a); 
}

$default_value[$temp_post_type['name']] = json_encode($result_array);


$insert_content[$temp_post_type['name']] = json_encode($result_array);
