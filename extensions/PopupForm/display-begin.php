<?php
if(empty($extension_info)) $time_info = array(
    'repeat_time_day'       => 0,
    'repeat_time_hour'      => 0,
    'repeat_time_minute'    => 0,
    'repeat_time_second'    => 0
);
else $time_info = json_decode($extension_info['attributes'], TRUE);

$total = $time_info['repeat_time_day'] * 86400 + $time_info['repeat_time_hour'] * 3600 + $time_info['repeat_time_minute'] * 60 + $time_info['repeat_time_second'];

if( !isset($_COOKIE['popup_form']) )  setcookie('popup_form', '1', time() + $total, '/');