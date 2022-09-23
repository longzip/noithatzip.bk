<?php
if($global_admin){}
else if ((isset($attribute['require'])) && ($attribute['require'] == '1') && (empty($_POST[$attribute['field_name']]))) $error_notification[] = '- Bạn chưa nhập <span class="noti-title">'. $attribute['field_title'] .'</span>';
//if($_POST[$attribute['field_name']] != $_SESSION['capcha']) $error_notification[] = '- Bạn đã nhập sai <span class="noti-title">'. $attribute['field_title'] .'</span>';

$the_field[$k]['name'] = $attribute['field_name'];
$the_field[$k]['title'] = $attribute['field_title'];
$the_field[$k]['value'] = $_POST[$attribute['field_name']];
