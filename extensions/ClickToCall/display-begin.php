<?php
if(empty($extension_info)) $time_info = array(
    'day'   => 0,
    'hour'   => 0,
    'minute'   => 0,
    'second'   => 0
);
else $time_info = json_decode($extension_info['attributes'], TRUE);

$total = $time_info['day'] * 86400 + $time_info['hour'] * 3600 + $time_info['minute'] * 60 + $time_info['second'];


setcookie('popup_form', '1', time() + $total, '/');