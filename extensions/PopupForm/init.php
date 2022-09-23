<?php
$init = get_extension($_GET['extension']);
if(empty($init)){
    $new_extension = array('name'=>$_GET['extension'], 'attributes'=>'{"form_id":"1","time_delay_minute":"0","time_delay_second":"0","display_style":"1","form_position":"top_right","top":"55","right":"10","left":"10","bottom":"55"}', 'display_position'=> 'before_close_body' , 'is_actived'=>0); 
    models_DB::insert($new_extension, EXTENSION_TABLE); 
} 