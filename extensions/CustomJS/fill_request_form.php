<?php
if(isset($_POST['submit']))
{
    delete_extension_by_name($extension_name);
     
    foreach($_POST['display_position'] as $k=>$v)
    {
        $insert_content = array();
        if(empty($_POST['is_actived'])) $insert_content['is_actived'] = 0;
        else $insert_content['is_actived'] = 1;
        $insert_content['display_position'] = $_POST['display_position'][$k];
        $insert_content['attributes'] = json_encode( array('content'=>$_POST['content'][$k]) );
        $insert_content['name'] = $extension_name;
        $insert_id = models_DB::insert($insert_content, EXTENSION_TABLE);
    }
    header('Location:'.CURRENT_URL);
}
else
{
    $extension_info = get_extension($extension_name);
    $default_value = array();
    if($extension_info === FALSE)
    {
        $default_value['display_position'] = '';
        $default_value['content'] = '';
    }
    else
    {
        $default_value['display_position'] = $extension_info[0]['display_position'];
        $temp = json_decode($extension_info[0]['attributes'], TRUE);
        
        $default_value['content'] = $temp['content'];
    }
}

 