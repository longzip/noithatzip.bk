<?php
/**
 * Delete Option
 */
function delete_option($option_name)
{
    $result = models_DB::query_string('DELETE FROM ' . OPTION_TABLE . ' WHERE name=\''. $option_name . '\'');
    return $result;
}


/**
 * Delete Post
 */
function delete_post($post_id)
{
	if(!is_numeric($post_id)) die();
     models_DB::delete(POST_TABLE, ' WHERE id='.$post_id);
 	 
}

/**
 * Delete Comment
 */
function delete_comment($comment_id)
{
	if(!is_numeric($comment_id)) die();
	 	
	models_DB::delete(COMMENT_TABLE, ' WHERE id='.$comment_id);
 	 
}

function delete_noti($notification_id)
{
	if(!is_numeric($notification_id)) die();
	 	
	models_DB::delete(NOTIFICATION_TABLE, ' WHERE id='.$notification_id);
 	 
}

function delete_extension_by_name($name)
{
    models_DB::delete(EXTENSION_TABLE, ' WHERE name=\'' . $name. '\'');
}