<?php
$init = get_extension($_GET['extension']);
if(empty($init)){
    $new_extension = array('name'=>'CustomCSS', 'attributes'=>'{"content":""}', 'display_position'=> 'before_close_body' , 'is_actived'=>0); 
    models_DB::insert($new_extension, EXTENSION_TABLE); 
} 