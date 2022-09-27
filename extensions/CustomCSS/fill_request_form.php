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
        $insert_content['attributes'] = json_encode( array('content'=>$_POST['content'][$k]) );
        $insert_content['name'] = $extension_name;
        $insert_id = models_DB::insert($insert_content, EXTENSION_TABLE);
    }
    
     
    
    
    
    if(  !file_exists(CLIENT_ROOT . '/custom')  )
    {
        mkdir(CLIENT_ROOT . '/custom');
    }
    
    if( !file_exists(CLIENT_ROOT . '/custom/css')  )
    {
        mkdir(CLIENT_ROOT . '/custom/css');
    }
    
    if( !file_exists(CLIENT_ROOT . '/custom/css/custom.css')  )
    {
        $myfile = fopen(urldecode( CLIENT_ROOT . '/custom/css/custom.css' , "w"));
        fclose($myfile);
    }
    
    file_put_contents(CLIENT_ROOT . '/custom/css/custom.css', $_POST['editor-textarea']);
    
    
    $myfile = fopen(PATH_ROOT . '/inc/front_end_version.php', "r") or die("Unable to open file!");
    $ori_front_end = fgets($myfile,filesize(PATH_ROOT . '/inc/front_end_version.php'));
    fclose($myfile);
    
    $ori_front_end = str_replace("<?php define('FRONT_END_VERSION', ", "", $ori_front_end);
    $ori_front_end = str_replace(");", "", $ori_front_end);
    $ori_front_end = $ori_front_end + 1;
    
    $myfile = fopen(PATH_ROOT . '/inc/front_end_version.php', "w") or die("Unable to open file!");
    $txt = "<?php define('FRONT_END_VERSION', " . $ori_front_end . ");";     
    fwrite($myfile, $txt);
    fclose($myfile);
    
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
//h($extension_info);
 