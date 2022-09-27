<?php
    
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('general')) die();
    
    
    if($_GET['type']== 'publish-post')
    {
        $post = get_post($_GET['post_id']);
        models_DB::update(array('the_status'=>'publish'), POST_TABLE, ' WHERE id='. $_GET['post_id']);
        header('Location:' . hcv_url('p', $post['url'], $post['id']));
        die();
    }