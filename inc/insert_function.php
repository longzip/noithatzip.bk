<?php
/**
 * Insert user notification
 */
 function insert_user($insert_content, $header = FALSE, $duplicate_user_name = FALSE, $duplicate_email = FALSE)
{
	global $g_form_error_noti;
	
	if(empty($insert_content['secure_key'])) $insert_content['secure_key'] = random_string();
	if(empty($insert_content['time_create'])) $insert_content['time_create'] = hcv_time();     
    if(empty($insert_content['point'])) $insert_content['point'] = 0;
	
	
	
	$exist1 = models_DB::get('SELECT id FROM ' . USER_TABLE . ' WHERE user_name=\'' . $insert_content['user_name'] .'\'');
		
	if($duplicate_user_name == FALSE)
	{
		if(!empty($exist1)) 
		{
			$g_form_error_noti[] = 'Tên đăng nhập đã tồn tại';
			return FALSE;
		}
		
	}
	else
	{
		$i = 0;
		while(!empty($exist1))
		{
			$i++;
			$exist1 = models_DB::get('SELECT id FROM ' . USER_TABLE . ' WHERE user_name=\'' . $insert_content['user_name'] . $i .'\'');
		}
		if($i) $insert_content['user_name'] .= $i;
	}
	
	if($duplicate_email == FALSE)
	{
		$exist2 = models_DB::get('SELECT id FROM ' . USER_TABLE . ' WHERE email=\'' . $insert_content['email'] .'\'');
		if(!empty($exist2)) 
		{
			$g_form_error_noti[] = 'Email đã được đăng ký';
			return FALSE;
		}
	}
	
	$insert_id = 0;
	if(empty($g_form_error_noti)) $insert_id = models_DB::insert($insert_content, USER_TABLE);
	
	if($insert_id)
	{

		///include 'inc/send_active_email.php';
		
		//setcookie('user_name', $insert_content['user_name'], time() + 3600*24*7, '/');
		//setcookie('password', $insert_content['password'], time() + 3600*24*7, '/');
		
		 
		return $insert_id;
		if($header) header('Location:' . SITE_URL . '/admin/');
	}          
}




/**
 * Insert OPTION
 */ 
function insert_option($name, $value)
{
    $insert_content = array(
        'name'  => $name,
        'value' => $value  
    );
    models_DB::insert($insert_content, OPTION_TABLE);
}

function insert_post_type($insert_content)
{
    if(empty($insert_content['name'])) $insert_content['name'] = 'No title';
    //if(empty($insert_content['default_field'])) $insert_content['default_field'] = '1';
    
    $insert_id = models_DB::insert($insert_content, POST_TYPE_TABLE);
    if($insert_id) return $insert_id;
    else return 0;
}

/**
 * Insert Config
 */ 
function insert_config($name, $value)
{
    $insert_content = array(
        'name'  => $name,
        'value' => $value  
    );
    models_DB::insert($insert_content, CONFIG_TABLE);
}





/**
 * Insert Config
 */
function insert_post($insert_content, $header=TRUE)
{
    global $g_user;
    
	
	
    if(empty($insert_content['title'])) $insert_content['title'] = 'No title';
    
    if(empty($insert_content['url'])) $insert_content['url'] = pretty_string($insert_content['title']);
    
     
    if(empty($insert_content['user_id'])) $insert_content['user_id'] = $g_user['id'];
    
    if(empty($insert_content['time_create'])) $insert_content['time_create'] = hcv_time();
    
    if(empty($insert_content['time_update'])) $insert_content['time_update'] = hcv_time();
    
    if(empty($insert_content['time_create'])) $insert_content['time_create'] = hcv_time();
    
    $insert_content['view_count']       = 0;
    $insert_content['secure_key']       = random_string();
    
	if(!$insert_content['user_id']) die();
	
	
    
	
    $insert_id = models_DB::insert($insert_content, POST_TABLE);
    
    if($insert_id)
    {
        return $insert_id;  
    }
    
    else return 0;
}



function insert_comment($param)
{
	global $g_user;
	
	if(empty($param['user_id'])) $insert_content['user_id'] = 0;
	else $insert_content['user_id'] = $param['user_id'];
	
	if(empty($param['time_create'])) $insert_content['time_create'] = hcv_time();
	else $insert_content['time_create'] = $param['time_create'];
	
	if(empty($param['name'])) return FALSE;
	else $insert_content['name'] = $param['name'];
	
	if(empty($param['content'])) return FALSE;
	else $insert_content['content'] = $param['content'];
	
	if(empty($param['post_id'])) return FALSE;
	else $insert_content['post_id'] = $param['post_id'];
	
	if(empty($param['parent'])) $insert_content['parent'] = 0;
	else $insert_content['parent'] = $param['parent'];
	
	if(empty($param['title'])) $insert_content['title'] ='';
	else $insert_content['title'] = $param['title'];
	
	if(empty($param['email'])) $insert_content['email'] ='';
	else $insert_content['email'] = $param['email'];
	 
	
    /**
 * Insert to comment table
 */
	
    $inset_id = models_DB::insert($insert_content, COMMENT_TABLE);
    
    
    if($inset_id)
    {         
         
     
	 
         /**
         * admin notification
         */
        $notification_content = array(
            'type'      	=> 'user_comment_post',
            'user_id'   	=> $insert_content['user_id'],
			'comment_id'	=> $inset_id,
            'post_id'   	=> $insert_content['post_id'],
            'excerpt'   	=> substr(strip_tags($insert_content['content']), 0, 100),
			'name'			=> $param['name']
         );         
		 
		 $admin = models_DB::get('SELECT id FROM ' . USER_TABLE . ' WHERE permission=\'admin\'');
		 
		  
		 
		 foreach($admin as $v_admin)
		 {
			$param_noti = array(
				'user_id'		=> $v_admin['id'],
				'content'		=> json_encode($notification_content),
				'already_read'	=> 0,
				'time_create'	=> $insert_content['time_create']
			 );
			 insert_user_notification($param_noti);
		 }
		
		
     
        /**
         * Increment post comment count
         */
         $post_meta = models_DB::get('SELECT comment_count FROM '. POST_TABLE . ' WHERE id='.$insert_content['post_id']);
         $update_content = array('comment_count'=> $post_meta[0]['comment_count'] + 1, 'time_update'=>hcv_time());
         models_DB::update($update_content, POST_TABLE, ' WHERE id='.$insert_content['post_id']);
         
         
         
         return $inset_id;
         
    }
    else return FALSE;
}


function insert_attachment($url, $title = '', $alt = '', $user_id = 1)
{
	$moment = array(
		'url'           =>  $url,
		'attributes'    => json_encode(array(
			'title'         => $title,
			'alt'           => $alt
		)),
		'user_id'       => $user_id
	);
	$insert_id = models_DB::insert( $moment, ATTACHMENT_TABLE );
	return $insert_id;
}

/**
 * Insert admin notification
 */
function insert_admin_notification($content, $time_create, $already_read = 0)
{
    $insert_content = array(
        'content'       => $content,
        'time_create'   => $time_create,
        'already_read'  => $already_read
    );
    $insert_id = models_DB::insert($insert_content, ADMIN_NOTIFICATION_TABLE);
    if($insert_id) 
    {
        return $insert_id;
    }
    
    else return FALSE;
}

function insert_user_notification($param)
{
	$insert_id = models_DB::insert($param, NOTIFICATION_TABLE);
	return $insert_id;
}