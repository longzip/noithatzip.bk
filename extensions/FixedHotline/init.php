<?php
$init = get_extension($_GET['extension']);
if(empty($init)){
    $new_extension = array('name'=>$_GET['extension'], 'attributes'=>'{"display_style":"1","hotline_position":"bottom_right","color1":"005BA5","color2":"338CD4","top":"120","bottom":"20","right":"100","left":"100"}', 'display_position'=> 'before_close_body' , 'is_actived'=>0); 
    models_DB::insert($new_extension, EXTENSION_TABLE); 
} 