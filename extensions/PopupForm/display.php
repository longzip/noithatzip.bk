<?php
if( 1 ) //!isset($_COOKIE['popup_form'])
{
    $popup_info = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'PopupForm\' AND display_position=\'before_close_body\'' );
    $popup_info = $popup_info[0];        
    $attr = json_decode($popup_info['attributes'], TRUE);
    if(empty($attr['display_style'])) $attr['display_style'] = 'center';
    $default_value = $attr;
     
    
    if(defined('ADMIN_PAGE') && (ADMIN_PAGE)) $form_param = array('id'=>$default_value['form_id'], 'form_element_name'=>'div');
    else  $form_param = array('id'=>$default_value['form_id']);
    
    include_once 'include-css.php';
    include 'style-' . $default_value['display_style'] . '.php';
    include 'display-' . $default_value['display_style'] . '.php';
    
    
}
 
    ?>
    
    <?php 
if(defined( 'ADMIN_PAGE' ) && ( ADMIN_PAGE )) 
{
     
}
else
{
     //require_once 'form_js.php';
}  
?>
