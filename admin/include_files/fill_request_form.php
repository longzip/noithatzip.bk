<?php



foreach($default_fields as $k=>$v)
{
    
    $attribute = unserialize($v['attribute']);
    if(!isset($attribute['description'])) $attribute['description'] = '';
    include PATH_ROOT . '/admin/post_type/' . $v['field_type'] . '/fill_request_form.php'; 
    
}



$fields = $obj_DB->get('SELECT * FROM ' . FIELD_TABLE . ' WHERE post_type=' . $global_current_row['post_type_id'] . ' ORDER BY stt ASC');
foreach($fields as $k=>$v)
{
    $attribute = unserialize($v['attribute']);
    if(!isset($attribute['description'])) $attribute['description'] = '';
    include PATH_ROOT . '/admin/post_type/' . $v['field_type'] . '/fill_request_form.php';  
}
//h($insert_content);