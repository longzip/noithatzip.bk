<?php
if(isset($_POST['submit']))
{
    delete_extension_by_name($extension_name);
     
    foreach($_POST['display_position'] as $k=>$v)
    {
        $insert_content = array();
        $insert_content['display_position'] = $_POST['display_position'][$k];
        if(empty($_POST['is_actived'])) $insert_content['is_actived'] = 0;
        else $insert_content['is_actived'] = 1;
        $insert_content['attributes'] = json_encode( array('list_url'=>$_POST['list_url'][$k]) );
        $insert_content['name'] = $extension_name;
        $insert_id = models_DB::insert($insert_content, EXTENSION_TABLE);
    }
    
    header('Location:'.CURRENT_URL);
}
else
{
    $extension_info = get_extension($extension_name);
    if(empty($extension_info))
    {
        $extension_info[0] = array(
            'id'                    => 'none',
            'name'                  => $extension_name,
            'attributes'            => '{"list_url":""}',
            'display_position'      => 'after_open_head',
            'is_actived'            => 0
        );
    }
     
    
    $default_value = array();
    if($extension_info === FALSE)
    {
        $default_value['display_position'] = '';
        $default_value['list_url'] = '';
         
    }
    else
    {
        $default_value['display_position'] = $extension_info[0]['display_position'];
        $temp = json_decode($extension_info[0]['attributes'], TRUE);
        
        $default_value['list_url'] = $temp['list_url'];
    }
}

 