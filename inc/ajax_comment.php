<?php
 
 
if(isset($_POST['type']) && $_POST['type']=='add_comment')
{
	 
	
	$param = array(
		'user_id'	=> $g_user['id'],
		'post_id'	=> $_POST['post_id'],
		'name'		=> htmlspecialchars($_POST['name']),
		'content'	=> htmlspecialchars($_POST['content']),
		'parent'	=> $_POST['parent'],
		'email'		=> htmlspecialchars($_POST['email']),
	);
    $comment_id = insert_comment($param);
	
	//h($_POST);die();
	
	$real_sub = $_POST['real_sub'];
	
	if(!$param['user_id'])
	{
		setcookie('comment_name', $param['name'], time() + 3600 * 24 * 7, '/');
		setcookie('comment_email', $param['email'], time() + 3600 * 24 * 7, '/');
	}
	
	
	if($param['user_id']) $comment_user = get_user($param['user_id'], ' id, user_name, image, permission ');
	
	else $comment_user = array(
		'id'		=> 0,
		'image'		=> SITE_URL . '/inc/images/default-guest-avatar.png',
		'user_name' => $param['name'],
		'permission'=> 'guest'
	);
	
	$comment = array(
		'time_create'	=>  hcv_time(),
		'content'		=> $param['content'],
		'id'			=> $comment_id
	);
	
	define('NEW_COMMENT', TRUE);
	
	include PATH_ROOT . '/inc/other_file/comment-item.php';
	 
}
if(isset($_POST['type']) && $_POST['type']=='delete_comment')
{
	if(USER_PERMISSION == 'admin')
	{
		delete_comment($_POST['comment_id']);
	}
}
 
