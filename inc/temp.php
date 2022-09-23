<?php




/**
 * Get config value
 */
function get_config($name)
{
	$result = models_DB::get('SELECT value FROM ' . CONFIG_TABLE . ' WHERE name=\'' . $name . '\'' );
	if(empty($result)) return FALSE;
	else return $result[0]['value'];
}

/**
 * Get extension
 */
function get_extension($name, $pos = '')
{
    if(!empty($pos)) $pos_in_in_sql = ' display_position=\''. $pos .'\' ';
    else $pos_in_in_sql = ' 1 ';
	$result = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'' . $name . '\' AND ' . $pos_in_in_sql );
    //echo 'SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'' . $name . '\' AND ' . $pos_in_in_sql ;
	if(empty($result)) return array();
	else return $result;
}

function get_extension_by_id($id)
{
	$result = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE id=\'' . $id . '\'' );
	if(empty($result)) return FALSE;
	else return $result[0];
}
 




/**
 * Get Categories
 */
function get_categories($param = array('field'=>'*', 'order'=>' ORDER BY stt ASC ', 'limit'=>'', 'parent'=>'0'))
{
    if(empty($param['id'])) $id = ' 1 ';
    else $id = ' FIND_IN_SET(id, ' . $param['id'] . ') ';
    
    if(!isset($param['parent'])) $parent = '1';
    else $parent = ' parent = ' . $param['parent'] . ' ';
    
    if(empty($param['field'])) $field = ' * ';
    else $field = $param['field'];
    
    if(empty($param['order'])) $order = ' ORDER BY id DESC ';
    else $order = $param['order'];
    
    if(empty($param['limit'])) $limit = ' ';
    else $limit = $param['limit'];
     
    $query_string = 'SELECT ' . $field . ' FROM ' . CATEGORY_TABLE . ' WHERE ' . $id . ' AND ' . $parent . ' ' . $order . ' ' . $limit;
    
    //echo $query_string;
    
    $result = models_DB::get($query_string);
    return $result;
}


/**
 * Get info from one category
 */
function get_category($forum_id, $field = '*')
{
	$query_string = 'SELECT ' . $field . ' FROM ' . CATEGORY_TABLE . ' WHERE id='.$forum_id;
    
	//echo $query_string;
	
    $result = models_DB::get($query_string);
    
    //h($result);
    
    if(empty($result)) return FALSE;
    return $result[0];
}


/**
 * Get tags
 */
function get_tags($param = array('field'=>'*', 'order'=>' ORDER BY id DESC ', 'limit'=>''))
{
    if(empty($param['id'])) $id = ' 1 ';
    else $id = ' FIND_IN_SET(id, ' . $param['id'] . ') ';
    
    if(!isset($param['parent'])) $parent = '1';
    else $parent = ' parent = ' . $param['parent'] . ' ';
    
    if(empty($param['field'])) $field = ' * ';
    else $field = $param['field'];
    
    if(empty($param['order'])) $order = ' ORDER BY id DESC ';
    else $order = $param['order'];
    
    if(empty($param['limit'])) $limit = ' ';
    else $limit = $param['limit'];
      
    $query_string = 'SELECT ' . $param['field'] . ' FROM ' . TAG_TABLE . ' WHERE ' . $id . ' ' . $order . ' ' . $limit;
  
    //echo $query_string;
    $result = models_DB::get($query_string);
    return $result;
}
/**
 * Get info from one tag
 */
function get_tag($tag_id, $field = '*')
{
    $query_string = 'SELECT ' . $field . ' FROM ' . TAG_TABLE . ' WHERE id='.$tag_id;
    
    $result = models_DB::get($query_string);
    
    //echo $query_string;
    
    if(empty($result)) return false;
    return $result[0];
}

/**
* GET Posts
*/
function get_posts($param = array())
{
	 
	
	if(!empty($param['user_id'])) $user_id = ' user_id=' . $param['user_id'] . ' ';
	else $user_id = '1';
	
	

	if(empty($param['category'])) $category = ' 1 ';
	else $category = ' FIND_IN_SET(' . $param['category'] . ', categories) ';
    
    //if(empty($param['category'])) $category = ' 1 ';
	//else $category = ' categories IN (' . $param['category'] . ') ';
     
    if(empty($param['tag'])) $tag = ' 1 ';
	else $tag = ' FIND_IN_SET(' . $param['tag'] . ', tags) ';
    
    if(isset($param['s'])) $s = ' title LIKE \'%'. $param['s'] .'%\'';
    else $s = ' 1 ';
	
	if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
	
	if(empty($param['limit'])) 
    {
        if(!isset($param['posts_per_page'])) $posts_per_page = get_option('posts_per_page');
        else $posts_per_page = $param['posts_per_page'];
        
        if(!isset($param['page'])) $page = 1;
        else $page = $param['page'];
        
        $limit = ' LIMIT ' . (($page - 1) * $posts_per_page ) . ', ' . $posts_per_page . ' ';
        
         
    }
    
	else $limit = $param['limit'];
    
    if(empty($param['status'])) $status = ' the_status=\'publish\' ';
	else 
    {
        if($param['status'] == 'all') $status = 1;
        else $status = ' the_status=\'' . $param['status'] . '\' ';   
    }
    
    if(empty($param['post_type'])) $post_type = '1';
	else $post_type = ' post_type=' . $param['post_type'];
	
	if(empty($param['field'])) $field = '*';
	else $field = $param['field'];
	
	$query_string = 'SELECT ' . $field .  ' FROM ' . POST_TABLE . ' WHERE ' . $user_id . ' AND ' . $category . ' AND ' . $tag . ' AND ' . $status .  ' AND ' . $post_type . ' AND ' . $s . ' ' . $order . ' ' . $limit;
	
   // echo $query_string;
	
	$result = models_DB::get($query_string);

	return $result;
}


/**
 * Get post type
 */
function get_post_type($post_type_id)
{
    $post_type_info = models_DB::get('SELECT * FROM '. POST_TYPE_TABLE . ' WHERE id=' .$post_type_id);
    if(empty($post_type_info)) return FALSE;
    else return $post_type_info[0];
}

/**
 * Get post types
 */
function get_post_types()
{
    $post_type_info = models_DB::get('SELECT * FROM '. POST_TYPE_TABLE . ' ORDER BY id ASC ');
    if(empty($post_type_info)) return FALSE;
    else return $post_type_info;
}

/**
 * Get post fields
 */
function get_fields($param = array())
{
    if(empty($param['order'])) $param['order'] = ' ORDER BY init DESC, stt ASC ';
    if(empty($param['limit'])) $param['limit'] = ' ';
		 
    $post_type = '( ( post_type = 0 ) ';
    
    if(empty($param['post_type'])) $post_type .= 'OR 1 )';
    else $post_type .= ' OR ( post_type = ' . $param['post_type'] . ' ) )';
    
    if(!isset($param['init'])) $init = '1';
    else $init = ' init = ' . $param['init'];
    
    
    
    $temp = 'SELECT * FROM '. FIELD_TABLE . ' WHERE ' . $post_type . ' AND ' . $init . ' ' . $param['order'] . ' ' . $param['limit'];
    
     
      
    
    $fields = models_DB::get($temp);
    return $fields;
}

/**
 * Get post fields
 */
function get_field($field_id)
{
    
    $temp = 'SELECT * FROM '. FIELD_TABLE . ' WHERE id=' . $field_id;
    
    
    $field = models_DB::get($temp);
    
    if(empty($field)) return FALSE;
    
        
    return $field[0];
}


/**
* GET post
*/ 
function get_post($post_id, $field = '*')
{
    //echo 'SELECT ' . $field . ' FROM ' . POST_1_TABLE . ' WHERE id='. $post_id . '  ' . $order . ' ' . $limit ;
    
    $result = models_DB::get('SELECT ' . $field . ' FROM ' . POST_TABLE . ' WHERE id='. $post_id);
    
    //h($result);
	
	if(empty($result)) return FALSE;
    else return $result[0];
}












 
 /**
  * Get Attachment
  */
 function get_attachment($param)
 {
	if(empty($param['field'])) $field = '*';
	else $field = $param['field'];
	
	if(empty($param['user_id'])) $user_id = '1';
	else $user_id = 'user_id='.$param['user_id'];
	
	if(empty($param['order'])) $order = ' ORDER BY id DESC ';
	else $order = $param['order'];
	
	 
	 
	
	if(empty($param['limit'])) $limit = ' LIMIT 18 ';
	else $limit = $param['limit'];
	
	$temp = 'SELECT ' . $field . ' FROM ' . ATTACHMENT_TABLE . ' WHERE '.$user_id . ' ' .$order . '  ' . $limit;
	
	 
	
    $attachments = models_DB::get($temp);
    return $attachments;
 }
 
 
 function fetch_attachment($url, $suffix = '', $file_name='', $user_id = 1)
{
	$attachment = file_get_contents($url);
	
	$file_info = pathinfo($url);
	
	$file_name = $suffix . $file_info['basename'];
	
	$current_upload_folder = get_current_upload_folder();
	
	if(file_exists(dirname(__FILE__) . '/uploads/' . $current_upload_folder .'/' . $file_info['basename']))
	{
		$i = 1;
		while(file_exists(dirname(__FILE__) . '/uploads/' . $current_upload_folder .'/' . $suffix . $file_info['filename'] . '-' . $i . '.'. $file_info['extension']))
		{
			$i++;
		}
		$file_name = $suffix . $file_info['filename'] . '-' . $i . '.'. $file_info['extension'];
	}
	
	
	$success = file_put_contents(dirname(__FILE__) . '/uploads/' . $current_upload_folder .'/' . $file_name, $attachment);
	
	if($success)
	{
		
		$insert_content = array(
			'url' 		=> 'uploads/' . $current_upload_folder .'/' . $file_name,
			'attributes' => serialize(array(
							'title'	=> $file_info['filename'],
							'alt'	=> $file_info['filename']
							))
		);
		
		$success = models_DB::insert($insert_content, ATTACHMENT_TABLE);
		if($success) return $insert_content['url'];
		else return false;
	}
	return false;
}
 
 
 function get_current_upload_folder()
{
	//echo 'SELECT value FROM ' . CONFIG_TABLE . ' WHERE name = \'current_upload_folder\'';
	$current_upload_folder = models_DB::get('SELECT value FROM ' . CONFIG_TABLE . ' WHERE name = \'current_upload_folder\'');
	//h($current_upload_folder);
	return $current_upload_folder[0]['value'];
}

function get_user($user_id, $field = '*')
{
	//echo 'SELECT ' . $field . ' FROM ' . USER_TABLE . ' WHERE id=' . $user_id;
    $user = models_DB::get('SELECT ' . $field . ' FROM ' . USER_TABLE . ' WHERE id=' . $user_id);
	
    if(empty($user)) return FALSE;
    return $user[0];
}


function get_users($param = array())
{
	 
    if(empty($param['permission'])) $permission = 1;
	else $permission = ' permission=\'' . $param['permission'] . '\'';
	
	if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
	
	if(empty($param['limit'])) $limit = ' ';
	else $limit = $param['limit'];
	
	if(empty($param['field'])) $field = '*';
	else $field = $param['field'];
    
    
    if(isset($param['s'])) $s = ' user_name LIKE \'%'. $param['s'] .'%\' ';
    else $s = ' 1 ';
	
	$query_string = 'SELECT ' . $field .  ' FROM ' . USER_TABLE . ' WHERE ' . $permission .  ' AND (' . $s . ') ' . $order . ' ' . $limit;
	
	//echo $query_string;
	
	$result = models_DB::get($query_string);

	return $result;
}



function get_breadcrumb_items($type, $id = 1, $home = TRUE, $this=FALSE)
{
	$result = array();
    
	switch($type)
	{
		case 'p' :
		{
		      $this_post = get_post($id);
			if($this)
			{
				
				$result[] = array('link'=>hcv_url('p', $this_post['url'], $this_post['id'], FALSE), 'anchor'=>$this_post['title']);
			}
		
			$cat_array = models_DB::get('SELECT categories FROM ' . POST_TABLE . ' WHERE id='. $id);
			//if(empty($cat_array)) return $result;
			//if(empty($cat_array[0]['categories'])) return $result;
			
			$cat_id = explode(',', $cat_array[0]['categories']);
			//$cat_id = $cat_id[0];
			$cat_id = max($cat_id);
			 
			 
			
			while($cat_id)
			{
			    if( 0 ) //(!empty($this_post['main_category'])) && ( $this_post['main_category'] == $cat_id )
                {
                    continue;
                }
			     if(!empty($cat_id))
                 {
                    $cat = models_DB::get('SELECT id, url, title, parent FROM ' . CATEGORY_TABLE . ' WHERE id='. $cat_id);
				    $cat_info = get_category($cat_id, 'id, url, title');
					
    				if($cat_info != FALSE)
    				{
    					$result[] = array('link'=>hcv_url('c', $cat_info['url'], $cat_info['id'], FALSE), 'anchor'=>$cat_info['title']);
    				}
    				if(empty($cat)) break;
                    
                    $cat_id = $cat[0]['parent'];
                 }
				
			}
               
            if( 0 ) //!empty($this_post['main_category'])
            {
                
                $cat_info = get_category($this_post['main_category']);
                if(!empty($cat_info)) {
                     
                    $t_arr = array('link'=>hcv_url('c', $cat_info['url'], $cat_info['id'], FALSE), 'anchor'=>$cat_info['title']);
                
                    
                    $n_result = array();           
                    foreach($result as $k=>$v)
                    {
                        if($k == 1) $n_result[] = $t_arr;
                        else $n_result[] = $v;
                    }
                    
                    $result = $n_result;
                }
                
                
            }
			
			
			
		}
		break;
		
		case 'c' :
		{
			
			if($this)
			{
				$this_cat = get_category($id, 'id, url, title');
				$result[] = array('link'=>hcv_url('c', $this_cat['url'], $this_cat['id'], FALSE), 'anchor'=>$this_cat['title']);
			}
			$cat_id = $id;
			
			while($cat_id)
			{
				$cat = models_DB::get('SELECT id, url, title, parent FROM ' . CATEGORY_TABLE . ' WHERE id='. $cat_id);
				if(empty($cat)) return $result;
				
				
				
				$cat_info = get_category($cat_id, 'id, url, title');
				
				 
				
				if($cat_info != FALSE)
				{
					$result[] = array('link'=>hcv_url('c', $cat_info['url'], $cat_info['id'], FALSE), 'anchor'=>$cat_info['title']);
				}
				$cat_id = $cat[0]['parent'];
			}
			
            unset($result[count($result) - 1]);
			
		}
		break;
	}
    
    
	
	if($home) $result[] = array('link'=>SITE_URL, 'anchor'=>'Trang chủ');
	 
	$result = array_reverse($result);
	return $result;
}

function get_post_categories($post_id, $fields = '*')
{
    $categories = models_DB::get('SELECT categories FROM ' . POST_TABLE . ' WHERE id=' .$post_id );
    
    
    if(!empty($categories))
    {
        $categories = $categories[0]['categories'];
        
        if(!empty($categories))
        {
            $temp = 'SELECT ' . $fields . ' FROM ' . CATEGORY_TABLE . ' WHERE id IN (' . $categories . ')' ;
         
            $categories_info = models_DB::get($temp);
            return $categories_info;
        }
        else return array();
    }
    else return array();
}

function get_post_tags($post_id, $fields = '*')
{
    $tags = models_DB::get('SELECT tags FROM ' . POST_TABLE . ' WHERE id=' .$post_id );
    
     
    
    if(!empty($tags))
    {
        $tags = $tags[0]['tags'];
		
         
        
		if(!empty($tags))
		{
			$tags_info = models_DB::get('SELECT ' . $fields . ' FROM ' . TAG_TABLE . ' WHERE id IN (' . $tags . ')' );
			return $tags_info;
		}
        else return array();
    }
    else return array();
}

function get_file_type($file_name)
{
    $ext = $file_name;
    if(empty($ext)) return FALSE;
    switch( $ext )
    {
        case 'jpg' :
        {
            return 'image';
            break;
        }
        case 'jpeg' :
        {
            return 'image';
            break;
        }
        case 'gif' :
        {
            return 'image';
            break;
        }
        case 'png' :
        {
            return 'image';
            break;
        }
        case 'mp3' :
        {
            return 'mp3';
            break;
        }
        case 'ogg' :
        {
            return 'ogg';
            break;
        }
        
        case 'mp4' :
        {
            return 'mp4';
            break;
        }
        case 'flv' :
        {
            return 'flv';
            break;
        }
        default :
        {
            return false;
        }
    }
}


function get_form($id, $field = ' * ')
{
    $form = models_DB::get( 'SELECT ' . $field . ' FROM  ' . FORM_TABLE . ' WHERE id=' . $id );
    if(empty($form)) return FALSE;
    return $form[0];
}


function get_forms($param = array())
{
	 
    if(empty($param['the_type'])) $the_type = 1;
	else $the_type = ' the_type=\'' . $param['the_type'] . '\'';
    
    if(empty($param['name'])) $name = 1;
	else $name = ' name=\'' . $param['name'] . '\'';
    
    if(empty($param['field_form'])) $field_form = 1;
	else $field_form = ' field_form=\'' . $param['field_form'] . '\'';
    
    if(empty($param['field_slug'])) $field_slug = 1;
	else $field_slug = ' field_slug=\'' . $param['field_slug'] . '\'';
	 
    
	if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
	
	if(empty($param['limit'])) $limit = ' ';
	else $limit = $param['limit'];
	
	if(empty($param['field'])) $field = '*';
	else $field = $param['field'];
    
    
    if(isset($param['s'])) $s = ' user_name LIKE \'%'. $param['s'] .'%\' ';
    else $s = ' 1 ';
	
	$query_string = 'SELECT ' . $field .  ' FROM ' . FORM_TABLE . ' WHERE ' . $the_type . ' AND '. $field_form . ' AND ' . $field_slug . ' AND (' . $s . ') ' . $order . ' ' . $limit;
	
	//echo $query_string;
	
	$result = models_DB::get($query_string);

	return $result;
}

function get_attachment_by_url($url)
{
    $return = models_DB::get(' SELECT * FROM ' . ATTACHMENT_TABLE . ' WHERE url=\'' . $url . '\' ' );
    if(empty($return)) return FALSE;
    else return $return[0];
}

function is_active_extension($name)
{
    $result = models_DB::get(' SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'' . $name . '\' ' );
    if(empty($result)) return FALSE;
    if($result[0]['is_actived'] == 1) return TRUE;
    else return FALSE;
}

function get_block_area_by_url($url)
{
    $return = models_DB::get(' SELECT * FROM ' . BLOCK_AREA_TABLE . ' WHERE url=\'' . $url . '\' ' );
    if(empty($return)) return FALSE;
    else return $return[0];
}

function v_scandir_width_sort( $file_path, $mode = ''){
    $lists = scandir($file_path);
    unset($lists[0], $lists[1]);
 
    switch($mode)
    {
        case '' :
        {
            break;
        }
        case 'alpha' :
        {
            asort($lists);
        }
        case 'number' :
        {
            asort($lists);
        }
    }
    return $lists;
}

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

function update_option($option_name, $new_value)
{
    
    if(get_option($option_name) === FALSE )
    {
        $content = array('name'=>$option_name, 'value'=>$new_value);
        $result = models_DB::insert($content, OPTION_TABLE);
        if($result) return TRUE;
        else return FALSE;
        
    }
    else
    {
         
        $update_content = array('value'=>$new_value);
        $result = models_DB::update($update_content, OPTION_TABLE, ' WHERE name=\'' . $option_name . '\'');
        if($result) return TRUE;
        else return FALSE;
        
    }
    
}

/**
 * Update Option
 */
function update_config($name, $value)
{
    
    if(get_config($name) === FALSE )
    {
        $content = array('name'=>$name, 'value'=>$value);
        $result = models_DB::insert($content, CONFIG_TABLE);
        if($result) return TRUE;
        else return FALSE;
        
    }
    else
    {
         
        $update_content = array('value'=>$value);
        $result = models_DB::update($update_content, CONFIG_TABLE, ' WHERE name=\'' . $name . '\'');
        if($result) return TRUE;
        else return FALSE;
        
    }
    
}

/**
 * Update Extension
 */
function update_extension($update_content, $name)
{
    $exist = get_extension($name);
    
    if($exist === FALSE)
    {
        $update_content['name'] = $name;
        $result = models_DB::insert($update_content, EXTENSION_TABLE );
    }
    else
    {
        $result = models_DB::update($update_content, EXTENSION_TABLE, ' WHERE name=\'' . $name . '\'');
    }
    
    if($result) return TRUE;
    else return FALSE;
    
}


function update_comment_count($post_id, $number = 1)
{
    $current_comment_count = models_DB::get('SELECT comment_count FROM '. POST_1_TABLE);
    $update_content = array('comment_count'=> $current_comment_count[0]['comment_count'] + $number);
    models_DB::update($update_content, POST_1_TABLE, ' WHERE id='.$post_id);
}

function reset_notification_count($user_id)
{
    $update_content = array('noti_unread' => 0);
    models_DB::update($update_content, USER_TABLE, ' WHERE id='.$user_id);
}

function reset_admin_notification_count()
{
    $update_content = array('already_read' => 1);
    models_DB::update($update_content, ADMIN_NOTIFICATION_TABLE, ' WHERE 1');
}

function clear_smarty_cache()
{
    $a = scandir(PATH_ROOT . '/tpl/tpl/' . 'cache/');
    foreach($a as $v)
    {
        if(is_file(PATH_ROOT . '/tpl/tpl/' . 'cache/' . $v)) unlink(PATH_ROOT . '/tpl/tpl/' . 'cache/' . $v);
    }
    
    $a = scandir(PATH_ROOT . '/tpl/tpl/' . 'templates_c/');
    foreach($a as $v)
    {
        if(is_file(PATH_ROOT . '/tpl/tpl/' . 'templates_c/' . $v)) unlink(PATH_ROOT . '/tpl/tpl/' . 'templates_c/' . $v);
    }
}


function h($par)
{ 
    ?>
    <pre style="padding: 10px;background: rgb(231, 243, 255);border: 1px solid silver;margin: 10px;font-size: 13px;color: rgb(69, 69, 69);">
        <?php print_r($par) ?>
    </pre>
    <?php
}

function hcv_media_frame()
{
	?>
	<div id="media-frame" class="fixed none">
		<div class="frame-action"><span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;<span class="close-frame btn btn-default">Đóng</span></div>
	</div>
	<div class="opacity fixed opacity-frame"></div>
	<?php
}


function display_pagination($param)
{
    
    $url_suffix = '';
    if(!defined('ADMIN_PAGE')) $url_suffix = URL_SUFFIX;
    
    $base_url = $param['base_url'];
    $current_page = $param['current_page'];
    $total_post = $param['total_post'];
    

    
    if(empty($param['posts_per_page'])) $posts_per_page = get_option('posts_per_page');
    else $posts_per_page = $param['posts_per_page'];
    
    if(empty($param['near_page'])) $near_page = 3;
    else $near_page = $param['near_page'];
    
    if(empty($param['suffix'])) $suffix = '';
    else $suffix = $param['suffix'];

    //die($base_url);
    
    if($total_post > $posts_per_page) :
    ?>
    
    <div  id="pagination">
            
            <?php  
                $url_type = $base_url;
                if($current_page != 1) 
                {
                    $next = $current_page - 1;
                    ?>
                    <a href="<?php echo $url_type . URL_SUFFIX ?>" class="first">Trang đầu</a>
                    <?php 
                        if($current_page == 2)
                        {
                            ?>
                            <a  href="<?php echo $url_type  . $url_suffix .   $suffix ?>" class="prev">«</a>
                    
                            <?php
                        }
                        else
                        {
                            ?>
                            <a  href="<?php echo $url_type  .  '/' . $next . $url_suffix .   $suffix ?>" class="prev">«</a>
                    
                            <?php
                        }
                    ?>
                    <?php
                }
            ?>
            <?php  
                $page_count = floor($total_post / $posts_per_page);
                
                if($total_post % $posts_per_page) $page_count++;
                $display_page = array(1);
                
                
                for($i = 1; $i <= $page_count; $i++)
                {
                    
                    if(!in_array($i, $display_page))
                    {
                        if( ( $i <=($current_page+ $near_page)) && ($i >=($current_page - $near_page)) ) $display_page[] = $i;
                    }
                }
                
                if(!in_array($i-1, $display_page))
                {
                    $display_page[] = $i - 1;
                }
                
                foreach($display_page as $k=>$v)
                {
                    if($v != 1) $href = $url_type . '/' . $v . $url_suffix ;
                    else $href = $url_type . URL_SUFFIX;
                    ?>
                    <a class="<?php if($current_page == $v) echo ' active' ?>" href="<?php echo $href  . $suffix ?>"><?php echo $v ?></a>
                    <?php
                    if(isset($display_page[$k+1]))
                    {
                        if($display_page[$k+1] != ($v+1)) echo '<span>...</span>';
                    }
                }
                
            ?>
            
            <?php  
                if($current_page != $page_count) 
                {
                    $next = $current_page + 1;
                    ?>
                    <a href="<?php echo $url_type .  '/'. $next . $url_suffix . $suffix?>" class="next">»</a><a href="<?php echo $url_type . '/' .  $page_count . $url_suffix .   $suffix ?>" class="last">Trang cuối</a>
                    <?php
                }
            ?>
            
            <span class="clear"></span>
        </div>
        <?php
        endif;
}

function new_display_pagination($param)
{
     
     
    
    $base_url = $param['base_url'];
    $current_page = $param['current_page'];
    $total_post = $param['total_post'];
    
    
    
    if(empty($param['posts_per_page'])) $posts_per_page = get_option('posts_per_page');
    else $posts_per_page = $param['posts_per_page'];
    
    if(empty($param['near_page'])) $near_page = 3;
    else $near_page = $param['near_page'];
    
    
    $parse_url = parse_url(CURRENT_URL, PHP_URL_QUERY);
    
    
    parse_str($parse_url, $url_get);
    
     unset($url_get['page']);
    
    
    $suffix = '';
    
    $count_url_get_to_set = 0;
    
    $count_url_get = count($url_get);
    
    foreach($url_get as $url_get_k=>$url_get_v)
    {
        
        if($count_url_get_to_set)
        {
            $suffix = $suffix . '&' . $url_get_k . '=' . $url_get_v;
        }
        else
        {
            $suffix = $suffix . '?' . $url_get_k . '=' . $url_get_v;
        }
        $count_url_get_to_set++;
    }
     
    if(empty($suffix)) $pre_nav = '?';
    else $pre_nav = '&';

     
    
    if($total_post > $posts_per_page) :
    ?>
    
    <div  id="pagination">
            
            <?php  
                $url_type = $base_url;
                if($current_page != 1) 
                {
                    $prev = $current_page - 1;
                    ?>
                    <a href="<?php echo $url_type . $suffix ?>" class="first">Trang đầu</a>
                    <?php 
                        if($current_page == 2)
                        {
                            ?>
                            <a  href="<?php echo $url_type   .   $suffix ?>" class="prev">«</a>
                    
                            <?php
                        }
                        else
                        {
                            ?>
                            <a  href="<?php echo $url_type . $suffix . $pre_nav . 'page=' . $prev ?>" class="prev">«</a>
                    
                            <?php
                        }
                    ?>
                    <?php
                }
            ?>
            <?php  
                $page_count = floor($total_post / $posts_per_page);
                
                if($total_post % $posts_per_page) $page_count++;
                $display_page = array(1);
                
                
                for($i = 1; $i <= $page_count; $i++)
                {
                    
                    if(!in_array($i, $display_page))
                    {
                        if( ( $i <=($current_page+ $near_page)) && ($i >=($current_page - $near_page)) ) $display_page[] = $i;
                    }
                }
                
                if(!in_array($i-1, $display_page))
                {
                    $display_page[] = $i - 1;
                }
                
                foreach($display_page as $k=>$v)
                {
                    if($v != 1) $href = $url_type . $suffix . $pre_nav .  'page=' . $v;
                    else $href = $url_type . $suffix;
                    ?>
                    <a class="<?php if($current_page == $v) echo ' active' ?>" href="<?php echo $href ?>"><?php echo $v ?></a>
                    <?php
                    if(isset($display_page[$k+1]))
                    {
                        if($display_page[$k+1] != ($v+1)) echo '<span>...</span>';
                    }
                }
                
            ?>
            
            <?php  
                if($current_page != $page_count) 
                {
                    $next = $current_page + 1;
                    ?>
                    <a href="<?php echo $url_type . $suffix . $pre_nav . 'page=' . $next ?>" class="next">»</a>
                    <a href="<?php echo $url_type . $suffix .  $pre_nav . 'page=' . $page_count ?>" class="last">Trang cuối</a>
                    <?php
                }
            ?>
            
            <span class="clear"></span>
        </div>
        <?php
        endif;
}


function wp_footer()
{
	global $g_user;
	global $g_page_info;
	
	//h($g_user);
	
	if($g_user['permission'] == 'admin')
	{ 
		$page_admin_action = '';
		if($g_page_info['page_type'] == 'post')
		{
			$page_admin_action = '<a href="' . SITE_URL . '/admin/?page_type=edit-post&post_id=' . $g_page_info['page_id'] .'">Sửa bài viết</a>';
		}
		
		if($g_page_info['page_type'] == 'category')
		{
			$page_admin_action = '<a href="' .SITE_URL . '/admin/?page_type=edit-category&category_id=' . $g_page_info['page_id'] . '">Sửa chuyên mục</a>';
 
		}
		
		if($g_page_info['page_type'] == 'home')
		{
			  //echo 'aaa';
		}
        if($g_page_info['page_type'] == 'tag')
		{
			  $page_admin_action = '<a href="' .SITE_URL . '/admin/page_type=edit-tag&tag_id=' . $g_page_info['page_id'] . '">Sửa tag</a>';
		}
		
		?>
		<div id="media-frame">
            <div class="fr frame-action">
                <span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;
                <span class="close-frame btn btn-default">Đóng</span>
            </div>
        </div>
        <div class="fixed" id="hcv-opacity"></div>
		<div id="block-loading"><img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" /></div>
		<div class="fixed wp-footer <?php if(isset($_COOKIE['wp_footer_direction'])) echo $_COOKIE['wp_footer_direction'] ?>">
		
			<?php 
				$notifications = models_DB::get('SELECT COUNT(id) as total_noti FROM ' . NOTIFICATION_TABLE . ' WHERE already_read=0 AND user_id=' . $g_user['id']); 
				$total_noti = 	$notifications[0]['total_noti'];
				if($total_noti)
				{
					?>
					<a title="Có <?php echo $total_noti ?> thông báo mới" href="<?php echo SITE_URL ?>/admin/?page_type=notification">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="admin-bell" src="<?php echo CDN_DOMAIN ?>/inc/images/icon-ios7-bell-128.png" /><span  class="wp-footer-noti-count"><?php echo $total_noti ?></span></a>
					<?php
				}
			?>
			
			<a href="<?php echo SITE_URL  ?>/admin/">Quản trị</a>
			<?php echo $page_admin_action; ?>
			<div id="vngit-header">
				<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css" />
                 <?php
				
				if(isset($_COOKIE['design']))
				{
					?>
                    
					<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/block.css" />
					<form action="" method="post" >
					<button type="submit" id="design-mode" name="close_design" >Quit</button>
					</form>
					<div id="list_block">
					
					<script>
						var site_url = "<?php echo SITE_URL ?>";
					</script>
					
					 
					
					<script src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-ui.js"></script>
					<script src="<?php echo CDN_DOMAIN ?>/inc/js/block.js"></script>
					<?php 
						foreach( scandir( PATH_ROOT . '/blocks' )  as $k=>$v ) 
						{
							if($k != '.' && $v != '..')
							{
							   ?>
								<div block_name="<?php echo $v ?>" block_id="0" class="draggable core-block  core-block-<?php echo $v ?> fl bold verdana <?php echo $v ?>"><?php echo $v; ?></div>
								 
                                <?php 
							}
							
						}
					?>
					<span class="clear"></span>
					</div>
					<?php
				}
				else
				{
					?>
					<form action="" method="post">
					<button type="submit" name="open_design" id="design-mode">Design</button>
					</form>
					
					<?php
				}
				?>
				</div>
                <div class="change-direction">
                    <span class="change-direction-item top <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'top')) echo ' active ' ?> <?php if(!isset($_COOKIE['wp_footer_direction'])  ) echo ' active ' ?>" par="top"></span>
                    <span class="change-direction-item right <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'right')) echo ' active ' ?>" par="right"></span>
                    <span class="change-direction-item bottom <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'bottom')) echo ' active ' ?>" par="bottom"></span>
                    <span class="change-direction-item left <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'left')) echo ' active ' ?>" par="left"></span>
                </div>
		</div>
		
		<?php
	}
}


function hcv_head()
{
     global $g_page_info;
     
     global $other_header;
 
     switch($g_page_info['page_type'])
     {
        case 'home' :
        {
            
             $title  = get_option('site_name');
            
             $description = get_option('site_description');
             
             //$other_header .= '<link rel="canonical" href="'. SITE_URL .'" />';
             
             if(!ROBOTS_INDEX)
             {
                 $other_header .= '<meta name="robots" content="noindex,nofollow" />';
             }
             else
             {
                $other_header .= '<meta name="robots" content="index,follow" />';
             }
        }
        break;
        
        case 'post' :
        {
            global $post_info; 

            $seo_info = json_decode($post_info['seo'], TRUE);
            
            if(empty($seo_info['title'])) $title = $post_info['title'];
            else $title  = $seo_info['title'];
            
            if(!empty($seo_info['description'])) $description = $seo_info['description'];
            else $description = $title;
            
            if(!empty($seo_info['301'])) 
            {
            	Header( "HTTP/1.1 301 Moved Permanently" );
            	header('Location:'.$seo_info['301']);
            }
            
            if(!empty($seo_info['canonical']))
            {
                $other_header .= '<link rel="canonical" href="'. $seo_info['canonical'] .'" />';
            } 
            else
            {
                $other_header .= '<link rel="canonical" href="'. hcv_url('p', $post_info['url'], $post_info['id'], FALSE) .'" />';
            }
            
            if(!empty($seo_info['keywords'])) $other_header .= '<meta name="keywords" content="'. $seo_info['keywords'] .'" />';
            
            if(ROBOTS_INDEX && ($post_info['the_status'] == 'publish'))
            {
                $other_header .= '<meta name="robots" content="'. $seo_info['index'] .','. $seo_info['follow'] .'" />';
            }
            else
            {
                $other_header .= '<meta name="robots" content="noindex,nofollow" />';
            }
            
            if(!empty($post_info['image']))
            {
                $other_header .= '<meta property="og:image" content="' . $post_info['image'] . '" />';
            }
            $other_header .= '<meta property="og:type" content="article" />';
            $other_header .= '<meta property="og:title" content="' . $post_info['title'] . '" />';
            $other_header .= '<meta property="og:description" content="' . strip_tags($post_info['description']) . '" />';
            $other_header .= '<meta property="og:url" content="' . hcv_url('p', $post_info['url'], $post_info['id'], FALSE) . '" />';
             
        }
        break;
        
        case 'category' :
        {
            global $category_info; 

            $seo_info = json_decode($category_info['seo'], TRUE);
            
            if(empty($seo_info['title'])) $title = $category_info['title'];
            else $title  = $seo_info['title'];
            
            if(!empty($seo_info['description'])) $description = $seo_info['description'];
            else $description = $title;
            
            if(!empty($seo_info['301'])) 
            {
            	Header( "HTTP/1.1 301 Moved Permanently" );
            	header('Location:'.$seo_info['301']);
            }
            
            if(!empty($seo_info['canonical'])) 
            {
                $other_header .= '<link rel="canonical" href="'. $seo_info['canonical'] .'" />';   
            }
            else
            {
                $other_header .= '<link rel="canonical" href="'. hcv_url('p', $category_info['url'], $category_info['id'], FALSE) .'" />';
            }
            
            if(!empty($seo_info['keywords'])) $other_header .= '<meta name="keywords" content="'. $seo_info['keywords'] .'" />';
            
            if(ROBOTS_INDEX && ($category_info['the_status'] == 'publish'))
            {
                $other_header .= '<meta name="robots" content="'. $seo_info['index'] .','. $seo_info['follow'] .'" />';
            }
            else
            {
                $other_header .= '<meta name="robots" content="noindex,nofollow" />';
            }
            
            if(!empty($category_info['image']))
            {
                $other_header .= '<meta property="og:image" content="' . $category_info['image'] . '" />';
            }
            $other_header .= '<meta property="og:type" content="article" />';
            $other_header .= '<meta property="og:title" content="' . $category_info['title'] . '" />';
            $other_header .= '<meta property="og:description" content="' . strip_tags($category_info['description']) . '" />';
            $other_header .= '<meta property="og:url" content="' . hcv_url('c', $category_info['url'], $category_info['id'], FALSE) . '" />';
            
        }
        break;
        
        case 'tag' :
        {
            global $tag_info; 

            $seo_info = json_decode($tag_info['seo'], TRUE);
            
            if(empty($seo_info['title'])) $title = $tag_info['title'];
            else $title  = $seo_info['title'];
            
            if(!empty($seo_info['description'])) $description = $seo_info['description'];
            else $description = $title;
            
            if(!empty($seo_info['301'])) 
            {
            	Header( "HTTP/1.1 301 Moved Permanently" );
            	header('Location:'.$seo_info['301']);
            	
            }
            
            if(!empty($seo_info['canonical'])) 
            {
                $other_header .= '<link rel="canonical" href="'. $seo_info['canonical'] .'" />';
            }
            else
            {
                $other_header .= '<link rel="canonical" href="'. hcv_url('p', $tag_info['url'], $tag_info['id'], FALSE) .'" />';
            }
            
            
            
            if(!empty($seo_info['keywords'])) $other_header .= '<meta name="keywords" content="'. $seo_info['keywords'] .'" />';
            
            if(ROBOTS_INDEX && ($tag_info['the_status'] == 'publish'))
            {
                $other_header .= '<meta name="robots" content="'. $seo_info['index'] .','. $seo_info['follow'] .'" />';
            }
            else
            {
                $other_header .= '<meta name="robots" content="noindex,nofollow" />';
            }
            
            if(!empty($tag_info['image']))
            {
                $other_header .= '<meta property="og:image" content="' . $tag_info['image'] . '" />';
            }
            $other_header .= '<meta property="og:type" content="article" />';
            $other_header .= '<meta property="og:title" content="' . $tag_info['title'] . '" />';
            $other_header .= '<meta property="og:description" content="' . strip_tags($tag_info['description']) . '" />';
            $other_header .= '<meta property="og:url" content="' . hcv_url('t', $tag_info['url'], $tag_info['id'], FALSE) . '" />';
        

            
        }
        break;
        
        case 'search' :
        {
             $title  = 'Tìm kiếm';
            
             $description = 'Tìm kiếm';
             
             if(!ROBOTS_INDEX)
             {
                 $other_header .= '<meta name="robots" content="noindex,nofollow" />';
             }
        }
        break;
        
        case '404' :
        {
             $title  = 'Không tìm thấy trang này';
            
             $description = 'Không tìm thấy trang này';
             
             $other_header .= '<meta name="robots" content="noindex,nofollow" />';
        }
        break;
     }
     
     
      
 
    
     ?>
     <title><?php echo $title ?></title>  
    
	 <meta charset="utf-8" />
     <meta name="description" content="<?php echo $description ?>"/>
	 <meta property="og:locale" content="en_US" />
	  
	 <meta property="og:site_name" content="<?php echo get_option('site_name'); ?>" />
     
     <link rel="shortcut icon" href="<?php echo get_option('favicon') ?>" type="image/x-icon" />
		
	 <script>
		var site_url = "<?php echo SITE_URL ?>";
		var tpl_url = "<?php echo TEMPLATE_URL ?>";
        
		var cdn_domain = "<?php echo CDN_DOMAIN ?>";
		var cnd_tpl_url = "<?php echo CDN_DOMAIN . '/tpl/' . TEMPLATE ?>";
	 </script>
	 
     
	 <script src="<?php echo CDN_DOMAIN ?>/apps/js/jquery-1.10.2.js"></script>
     <?php 
        if(USER_PERMISSION == 'admin')
        {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css" media="all" />
             
            <script src="<?php echo CDN_DOMAIN ?>/inc/js/admin.js"></script>
            <?php
        }
        
        $menu_style = get_option('v_main_menu_style');
        if(!empty($menu_style))
        {
            ?>
            <script src="<?php echo CDN_DOMAIN ?>/inc/menu-style/js/<?php echo $menu_style ?>.js"></script>
            <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/menu-style/css/<?php echo $menu_style ?>.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />
            <?php
        }
     ?>
     
     <?php
     $actived_addons = get_option('actived_addons');
    if(empty($actived_addons)) $actived_addons = array();
    else $actived_addons = json_decode($actived_addons, TRUE);
    
    foreach($actived_addons as $actived_addon)
    {
        ?>
        <script src="<?php echo CDN_DOMAIN ?>/addon/<?php echo $actived_addon ?>/js.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/addon/<?php echo $actived_addon ?>/css.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />
        <?php
    }
     
     echo $other_header;
}


 
 
function display_categories_checkbox($name, $selected = array(),  $other = '')
{ 
			$sub_count = 0;
				
            if(!function_exists('display_forum_checkbox'))
            {
                function display_forum_checkbox($forum, $selected = array())
    			{
    				global $temp_post_type;
    				
    				global $sub_count;
    				?>
    					<div class="forum">
    						<div class="forum-detail">
    							<label class="forum-label"><input name="<?php echo $name ?>[]" type="checkbox" <?php if(in_array($forum['id'], $selected)) echo ' checked'; ?>  value="<?php echo $forum['id'] ?>" /><?php echo $forum['title'] ?></label>
    							
    							
    						</div>
    					
    					 <?php 
    						$sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
    						if(!empty($sub_forums))
    						{
    							$sub_count++;
    							?>
    							<div class="sub-forum sub-forum-<?php echo $sub_count ?>">
    							<?php
    							foreach($sub_forums as $s_k=>$s_v)
    							{
    								display_forum_checkbox($s_v, $selected);
    							}
    							?>
    							</div>
    							<?php
    						}
    						else $sub_count=0;
    					   ?>
    					   </div>
    				
    				<?php
    			}
            }
			
			$forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY title ASC' );
			$sub_count = 0;
			foreach($forums as $forum)
			{
				
				?>
				<div class="forum-item">
					<?php display_forum_checkbox($forum) ?>
				</div>
				<?php
			}
		?>
		
		<span class="clear"></span>
		
		<?php
}
 

function display_categories_option($name, $selected = 0, $other = '')
{ 
            $sub_count = 0;
			
			if(!function_exists('display_forum_checkbox'))
            {
				function display_forum($forum, $name, $selected)
				{
					global $sub_count;
					global $default_value;
					?>
					<option value="<?php echo $forum['id'] ?>" <?php check_select($name, $selected, $forum['id']) ?>><?php for($i=0;$i<$sub_count;$i++) echo '----'; echo $forum['title'] ?></option>
						  <?php 
							
							$sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
							if(!empty($sub_forums))
							{
								$sub_count++;
								foreach($sub_forums as $s_k=>$s_v)
								{
									display_forum($s_v, $name, $selected);
									if($s_k == (count($sub_forums) - 1)) $sub_count--;
								}
								?>
								
								<?php
							}
							//else 
							
						   ?>
						   
						   <?php 
						?>
					
					<?php
				}
			}
            
            ?>
            <select <?php echo $other ?> name="<?php echo $name ?>">
            <option value="0" <?php check_select($name, $selected, '0') ?>>None</option>
                   
            <?php 
                $forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY stt ASC');
                
                foreach($forums as $forum)
                {
                    display_forum($forum, $name, $selected); 
                }
            ?>
                
                
            </select>
	<?php
}
 
function display_cart()
{
    global $g_user;
?>
<div id="wrap-popup-cart">
	<div id="popup-cart">
		<div id="cart-header">Giỏ hàng của bạn</div>
		
		<div id="cart-content">
			<div class="cart-col1">
				<div class="cart-content-title"><span>Sản phẩm đã chọn</span></div>
				<span class="clear"></span>
				<div id="cart-detail">
				<?php 
				$total_price = 0;
				
				
				
				if(isset($_COOKIE['cart']))
				{
					$lists = json_decode($_COOKIE['cart'], TRUE);
					if(empty($lists)) $have_product = FALSE;
					else $have_product = TRUE;
				}
				else $have_product = FALSE;
				
				
				if($have_product)
				{
					 
					foreach($lists as $k=>$v)
					{
						
						$post = get_post($k);
						$total_price = $total_price +  $v['price'] * $v['num'];
						
						if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=280&h=200';
						else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=280&h=200';
						
						?>
						<div class="cart-item" id="cart-item-<?php echo $k ?>">
							<a href="<?php echo SITE_URL , '/' , $post['url'] ?>" class="cart-product-name"><?php echo $post['title'] ?></a>
							<span class="clear"></span>
							<div class="fl cart-item-image">
								<img src="<?php echo $image ?>" />
							</div>
							<div class="fl cart-item-info">
								<p class="cart-price">Đơn giá : <span><?php echo num_to_price($v['price']) ?></span> <strong>vnđ</strong></p>
								<p class="cart-num">Số lượng : <span class="desc-num" particular="<?php echo $k ?>">-</span> <input type="number" class="cart-item-num" value="<?php echo $v['num'] ?>" /> <span class="asc-num"  particular="<?php echo $k ?>">+</span></p>
								<div class="cart-item-action">
									<p class="delete-cart-item"  particular="<?php echo $k ?>">Xóa</p>
									<p class="update-cart-item"  particular="<?php echo $k ?>">Cập nhật</p>
								</div>
							</div>
							<span class="clear"></span>
						</div>
						<?php
					}
					
					
					?>
					
					<?php
				}
				else
				{
					echo '<p class="empty-cart-noti">Bạn chưa có sản phẩm nào trong giỏ hàng</p>';
				}
				?>
				
				</div>
				<?php 
					if($have_product)
					{
					?>
					<div id="total-price">
						Tổng : <span><?php echo num_to_price($total_price) ?></span> vnđ
					</div>
					
					<div id="empty-cart">Xóa toàn bộ giỏ hàng</div>
					<?php
					}
					
				?>
				
			</div>
			
			<div class="cart-col2">
				<?php 
					if($have_product)
					{
					?>
				
				<div class="cart-content-title"><span>Đặt hàng</span></div>
                <?php 
                    if(USER_ID)
                    {
                        $user_info = $g_user;
                    }
                    else
                    {
                        $user_info = array(
                            'display_name'      => '',
                            'phone'             => '',
                            'place'             => '',
                            'email'             => ''
                        );
                    }
                     
                ?>
				<form id="order-form">
					<input type="text" id="order-name" class="text" placeholder="Họ tên → Bắt buộc" required value="<?php echo $g_user['display_name'] ?>" />
					<input type="text" id="order-phone"  class="text" placeholder="Điện thoại → Bắt buộc" required value="<?php echo $g_user['phone'] ?>" />
					<input type="text" id="order-place"  class="text" placeholder="Địa chỉ → Bắt buộc" required value="<?php echo $g_user['place'] ?>" />
					<input type="email" id="order-email"  class="text" placeholder="Email" value="<?php echo $g_user['email'] ?>" /> 
					<textarea id="other_info" placeholder="Thông tin thêm"></textarea>
					<div class="order-action">
					   <input type="submit" class="submit" value="Gửi đơn hàng" id="submit-order" />
					</div>
				</form>
				<div >
                
                </div>
				<?php
					}
					
				?>
				<span class="clear"></span>
			</div>
			<span class="clear"></span>
		</div>
		
		<img class="close-cart" src="<?php echo CDN_DOMAIN ?>/inc/images/close_cart.png" />
	</div>
</div>
<?php
    
}

 
function display_add_to_cart_button($product_id, $price,  $id = '', $class = '', $text = 'Đặt mua')
{
    ?>
	<div class="<?php echo $class ?> add-to-cart" <?php if(!empty($id)) echo 'id="' . $id .'"' ?> price="<?php echo $price ?>" particular="<?php echo $product_id ?>"><?php echo $text ?></div>
	<?php
}
function display_view_cart_button($id='', $class='', $text = 'Xem giỏ hàng')
{
    ?>
	<div class="<?php echo $class ?> view-cart" <?php if(!empty($id)) echo 'id="' . $id .'"' ?>><?php echo $text ?></div>
	<?php
}

function display_bread_crumb($type, $id = 1, $home = TRUE, $this=FALSE, $arrow = '›')
{
	$bread_crumbs = get_breadcrumb_items($type, $id, $home, $this);
    $count = count($bread_crumbs);
	?>
	<div class="hcv-bread-crumb">
	 
	<?php
	foreach($bread_crumbs as $k=>$bread_crumb)
	{
		
		?>
		<?php if($k) : ?><span class="arrow"><?php echo $arrow; ?></span><?php endif; ?>
		<a class="bread-crumb-item <?php if($this && ($k==($count -1))) echo 'bread-crumb-last' ?>" href="<?php echo $bread_crumb['link'] ?>" title="<?php echo $bread_crumb['anchor'] ?>"><?php echo $bread_crumb['anchor'] ?></a>
		<?php
	}
	?>
	</div>
	<?php
}


function block_attribute($param)
{
	?>
	id="block-<?php echo $param['block_id'] ?>"  class="block-<?php echo $param['block_name'] ?> core-block"  <?php if(USER_PERMISSION == 'admin'): ?> block_id="<?php echo $param['block_id'] ?>" block_name="<?php echo $param['block_name'] ?>" block_title="<?php echo $param['block_title'] ?>" <?php endif; ?>
	<?php
} 
 
function comment_form($post_id, $param = array('name_label'=>'Họ tên&nbsp;&nbsp;&#40;<span class="require">*</span>&#41;', 'content_label'=>'Nội dung&nbsp;&nbsp;&#40;<span class="require">*</span>&#41;', 'email_label'=>'Email&nbsp;&nbsp;'))
{
	global $g_user;
	
	$comment_user_name = '';
	$comment_user_email = '';
	
	if(isset($_COOKIE['comment_name'])) $comment_user_name =  $_COOKIE['comment_name'];
	if($g_user['id']) $comment_user_name =  $g_user['user_name'];
	
	if(isset($_COOKIE['comment_email'])) $comment_user_email =  $_COOKIE['comment_email'];
	if($g_user['id']) $comment_user_email =  $g_user['email'];
	?>
	<script src="<?php echo SITE_URL ?>/inc/js/comment.js"></script>
	<form class="auto-comment-form" method="POST" post_id="<?php echo $post_id ?>" action="" id="auto-comment-form-<?php echo $post_id ?>">
		<?php if($g_user['id']) : ?>
		<div style="display:block">
		<?php endif; ?>
			<div class="comment-form-item">
				<label for="comment-field-name"><?php echo $param['name_label'] ?></label>
				<input class="text" required="required" name="comment-field-name" type="text" id="comment-field-name" value="<?php echo $comment_user_name; ?>" />
			</div>
			
			<div class="comment-form-item">
				<label for="comment-field-email"><?php echo $param['email_label'] ?></label>
				<input class="text"  name="comment-field-email" type="email" id="comment-field-email" value="<?php echo $comment_user_email ?>" />
			</div>
		<?php if($g_user['id']) : ?>
		</div>
		<?php endif; ?>
		
		<div class="comment-form-item">
			<label for="comment-field-content"><?php echo $param['content_label'] ?></label>
			<textarea id="comment-field-content" name="comment-field-content" required="required"></textarea>
		</div>
		<span class="clear"></span>
		<div class="comment-form-item">
			<input class="submit"  name="comment-field-submit" type="submit" id="comment-field-submit" value="Submit" />
		</div>
		<span class="clear"></span>
	</form>
	
	<form style="display:none" class="reply-auto-comment-form" method="POST" post_id="<?php echo $post_id ?>" action="" id="reply-auto-comment-form-<?php echo $post_id ?>">
		<div class="comment-form-item">
			<label for="reply-comment-field-name"><?php echo $param['name_label'] ?></label>
			<input class="text" required="required" name="reply-comment-field-name" type="text" id="reply-comment-field-name" value="<?php echo $comment_user_name; ?>" />
		</div>
		
		<div class="comment-form-item">
			<label for="reply-comment-field-email"><?php echo $param['email_label'] ?></label>
			<input class="text"  name="reply-comment-field-email" type="email" id="reply-comment-field-email" value="<?php echo $comment_user_email; ?>" />
		</div>
		
		<div class="comment-form-item">
			<label for="reply-comment-field-content"><?php echo $param['content_label'] ?></label>
			<textarea id="reply-comment-field-content" name="reply-comment-field-content" required="required"></textarea>
		</div>
		<span class="clear"></span>
		<div class="comment-form-item">
			<input class="submit"  name="comment-field-submit" type="submit" id="comment-field-submit" value="Submit" />
		</div>
		<span class="clear"></span>
		
		<span class="close-comment-form">x</span>
	</form>
	
	<?php
}

$sub_count = 0;
if(!function_exists('display_comment_item'))
{
	function display_comment_item($comment, $post_id, $g_user_id, $admin = false,$param = array('depth'=>2))
	{
		
		
		global $sub_count;
		global $g_tpl_url;
		if($comment['user_id']) $comment_user = get_user($comment['user_id'], ' id, user_name, image, permission ');
		else $comment_user = array(
			'id'		=> 0,
			'image'		=> CDN_DOMAIN . '/inc/images/default-guest-avatar.png',
			'user_name' => $comment['name'],
			'permission'=> 'guest'
		);
		
		$real_sub = min($param['depth']-1, $sub_count);
	
		include PATH_ROOT . '/inc/other_file/comment-item.php';
		 
		?>
		
		
		<span class="clear"></span>
		  <?php
			
			$sub_forums = models_DB::get('SELECT * FROM ' . COMMENT_TABLE . ' WHERE parent=' . $comment['id']);
			if(!empty($sub_forums))
			{
				$sub_count++;
				foreach($sub_forums as $s_k=>$s_v)
				{
					display_comment_item($s_v, $post_id, $g_user_id, $admin);
					if($s_k == (count($sub_forums) - 1)) $sub_count--;
				}
				?>
				
				<?php
			}
	}
}

function display_comment($post_id, $param = array('depth'=>2))
{ 
	global $g_user;
     
	?>
	<div class="core-list-comment" id="core-list-comment-<?php echo $post_id ?>">
	
	<?php
	$list_reply = models_DB::get('SELECT * FROM ' . COMMENT_TABLE . ' WHERE parent=0 AND post_id='.$post_id);
     
		 										
	if($g_user['permission'] == 'admin') $admin = TRUE; else $admin = false;
	
	foreach($list_reply as $k=>$v)
	{
		display_comment_item($v, $post_id, $g_user['id'], $admin, $param);
	}

	?>
	</div>
	<?php
}


function display_notification($param)
{
	$content = json_decode($param['content'], TRUE);
    
     
    
	switch($content['type'])
	{
		case 'user_comment_post' :
		{
			$post_info = get_post($content['post_id'], 'id, url, title');
			$link  = hcv_url('p', $post_info['url'], $post_info['id'], FALSE). '#comment-'.$content['comment_id'];
			?>
			<div class="noti-item" href="<?php echo $link ?>" style="display:block">			
				<div class="noti-title">
					<span class="bold"><?php echo $content['name'] ?></span> đã bình luận về bài viết <a href="<?php echo $link ?>"><?php echo $post_info['title'] ?></a>
				</div>
				<div class="noti-des">
					<?php echo $content['excerpt'] ?> ...
				</div>
				
				<div class="noti-readmore">					
					<a href="<?php echo $link ?>">Xem chi tiết</a>
					<span class="delete-noti" noti_id="<?php echo $param['id'] ?>" title="Xóa thông báo này">Xóa</span>
				</div>
				
			</div>
			<?php
		}
		break;
		
		case 'user_order' :
		{
			 
			$link  = SITE_URL . '/admin/?page_type=order-detail&order_id='.$content['order_id'];
			?>
			<div class="noti-item" href="<?php echo $link ?>" style="display:block">			
				<div class="noti-title">
					<span class="bold"><?php echo $content['name'] ?></span> đã đặt hàng
				</div>
				 <div class="noti-des">
					  ...
				</div>
				
				<div class="noti-readmore">					
					<a href="<?php echo $link ?>">Xem chi tiết</a>
					<span class="delete-noti" noti_id="<?php echo $param['id'] ?>" title="Xóa thông báo này">Xóa</span>
				</div>
				
			</div>
			<?php
		}
		break;
        
        case 'order' :
		{
			 
			$link  = SITE_URL . '/admin/?page_type=list-order-detail&order_id=' . $content['order_id'];
			?>
			<div class="noti-item" href="<?php echo $link ?>" style="display:block">			
				<div class="noti-title">
		          Form <span class="bold"><?php echo $content['name'] ?></span> được gửi
				</div>
				 <div class="noti-des">
					  ...
				</div>
				
				<div class="noti-readmore">					
					<a href="<?php echo $link ?>">Xem chi tiết</a>
					<span class="delete-noti" noti_id="<?php echo $param['id'] ?>" title="Xóa thông báo này">Xóa</span>
				</div>
				
			</div>
			<?php
		}
		break;
		
		 
	}
}

function display_meta($param)
{
    global $g_page_info;
    
    $return = '';
    if(empty($param['type'])) $param['type'] = $g_page_info['page_type'];
    if(empty($param['id'])) $param['id'] = $g_page_info['page_id'];
    if(empty($param['field_type'])) $param['field_type'] = 'text';
    if(empty($param['echo'])) $param['echo'] = TRUE;
    
    if( !empty($param['default']) )
    {
        
    }
    else
    {
        switch($param['type'])
        {
            case 'post' :
            {
                $info = get_post($param['id'], $param['field']);
            }
            break;
            
            case 'category' :
            {
                $info = get_category($param['id'], $param['field']);
            }
            break;
            
            case 'tag' :
            {
                $info = get_tag($param['id'], $param['field']);
            }
            break;
        }
        $param['default'] = $info[$param['field']];
    }
    if(USER_ID)
    {
        $return = '<' . $param['wrap'] . ' title="Sửa" class="core-edit-meta" type="' . $param['type'] . '" field="' . $param['field'] . '" the_id="' . $param['id'] . '"  field_type="' . $param['field_type'] . '"  >' . $param['default'] . '</' . $param['wrap'] . '>';
    }
    else $return = '<' . $param['wrap'] . '>' . $param['default'] . '</' . $param['wrap'] . '>';
    if( $param['echo'] ) echo $return;
    return $return;

}

function display_edit_option_icon($name, $type = 'text')
{
    if(!isset($_COOKIE['design'])) return;
    
    $a = get_option($name);
     
    
    if( $a === FALSE )
    {
        $insert_content = array(
            'name'          => pretty_string( $name, '_' ),
            'value'         => '',
            'is_default'    => 0,
            'attributes'    => json_encode( array ( 'title' => pretty_string( $name, '_' ), 'type' => $type, 'maxlenght' => 99999 ) ),
            'display'       => 0
        );
        
        models_DB::insert($insert_content, OPTION_TABLE);
    }
    else
    {
        $b = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE name=\'' . $name . '\'');
        
        $attr = json_decode($b[0]['attributes'], TRUE);
         
        if($attr['type'] != $type) 
        {
            $insert_content = array(
                'attributes'    => json_encode( array ( 'title' => pretty_string( $name, '_' ), 'type' => $type, 'maxlenght' => 99999 ) )
            );
            models_DB::update($insert_content, OPTION_TABLE, ' WHERE name=\'' . $name . '\' ');
        }
    }
    ?>
        <span class="core-edit-option-icon" par="<?php echo $name ?>">
             
        </span>
    <?php
}

function display_form($param)
{
    
    $id = $param['id'];
    if(empty($param['submit_text'])) $param['submit_text'] = 'Gửi';
    $form_info = get_form($id);
    //h($form_info)
    if(empty($form_info)) return;
    $fields = get_forms( array('field_form'=>$id, 'order'=> ' ORDER BY field_stt ASC ', 'the_type'=>'field') );
      
    ?>
    
    <div class="wrap-v-form">
            <div class="v-form-title"><?php echo $form_info['name']; ?></div>
            <div class="v-form-description"><?php echo $form_info['other1']; ?></div>
            
            <div class="v-form-content clearfix">
                <?php 
                    if(empty($param['form_element_name'])) $param['form_element_name'] = 'form';
                ?>
                <<?php echo $param['form_element_name'] ?> class="v-form" method="POST" par="<?php echo $id ?>">
                <input type="hidden" name="form_id" value="<?php echo $id ?>" />  
                <input type="hidden" name="type" value="order" /> 
                <input type="hidden" name="url" value="<?php echo CURRENT_URL ?>" />  
                <?php 
                    foreach($fields as $field)
                    {
                        //h($field);
                        $field_attribute = json_decode($field['field_attribute'], TRUE);
                        
                         
                        ?>
                        <div class="v-form-item v-form-item-<?php echo $field['field_slug'] ?> v-form-item-<?php echo $field['field_type'] ?>" >
                            <div class="v-form-item-title"><?php echo $field['field_name'] ?> <span class="v-form-require"><?php if( !empty($field_attribute['require']) ) echo ' * ' ?></span></div>
                            
                            <div class="v-form-item-content">
                                <?php
                                switch($field['field_type'])
                                {
                                    case 'text' :
                                    {
                                        ?>
                                        <input type="text" <?php if($field_attribute['require']) echo ' required ' ?> class="v-form-field-type-<?php echo $field['field_type'] ?> form-text" placeholder="<?php echo $field['field_name'] ?>" value="" name="<?php echo $field['field_slug'] ?>" />
                                        <?php
                                        break;
                                    }
                                     case 'number' :
                                    {
                                        ?>
                                        <input type="number" <?php if($field_attribute['require']) echo ' required ' ?> class="v-form-field-type-<?php echo $field['field_type'] ?> form-text" placeholder="<?php echo $field['field_name'] ?>" value="" name="<?php echo $field['field_slug'] ?>" />
                                        <?php
                                        break;
                                    }
                                    case 'textarea' :
                                    {
                                        ?> 
                                        <textarea <?php if($field_attribute['require']) echo ' required ' ?>  class="v-form-field-type-<?php echo $field['field_type'] ?> form-textarea" name="<?php echo $field['field_slug'] ?>" placeholder="<?php echo $field['field_name'] ?>"></textarea>
                                        <?php
                                        break;
                                    }
                                    case 'select' :
                                    { 
                                        ?>
                                        <select class="v-form-field-type-<?php echo $field['field_type'] ?>  form-select" name="<?php echo $field['field_slug'] ?>">
                                             <?php
                                                $temp_value_display = json_decode($field_attribute['value_display'], TRUE);
                                                $temp_value = json_decode($field_attribute['value'], TRUE);
                                                foreach($temp_value_display as $tem_k=>$temp_v)
                                                {
                                                    ?>
                                                    <option <?php if($field_attribute['default'] == $temp_value[$tem_k]) echo 'selected ' ?> value="<?php echo $temp_value[$tem_k] ?>"><?php echo $temp_v ?></option>
                                                    <?php
                                                } 
                                             ?>
                                        </select>
                                        <?php
                                        break;
                                    }
                                    
                                    case 'checkbox' :
                                    {
                                        $temp_value_display = json_decode($field_attribute['value_display'], TRUE);
                                        $temp_value = json_decode($field_attribute['value'], TRUE);
                                        foreach($temp_value_display as $tem_k=>$temp_v)
                                        {
                                            ?>
                                            <div class="v-form-field-type-<?php echo $field['field_type'] ?>-item" >
                                            <span> <?php echo $temp_v ?></span> &nbsp;<input type="checkbox" <?php if($field_attribute['require']) echo ' required ' ?> class="v-form-field-type-<?php echo $field['field_type'] ?> form-checkbox" placeholder="<?php echo $field['field_name'] ?>" value="<?php echo $temp_value[$tem_k] ?>" name="<?php echo $field['field_slug'] ?>" />
                                            
                                            </div>
                                            <?php
                                        }
                                        
                                        break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                        <div class="v-form-item v-form-item-submit">
                            <div class="v-form-item-title"><?php echo $form_info['field_name'] ?></div>
                            <div class="v-form-item-content">
                                <input name="v-submit" class="form-submit" type="submit" value="<?php echo $param['submit_text'] ?>" />
                            </div>
                        </div>
                    </<?php echo $param['form_element_name'] ?>>
            </div>
        
    </div>
    
    <script>
    <?php 
        include_once PATH_ROOT . '/inc/js/form.js';
    ?>
    </script>
    <?php
}

function display_block_setting_default($default)
{   
    ?>
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/inc/css/font-awesome-4.5.0/css/font-awesome.min.css" />
    <div class="block-default-parameter clearfix">
        <div class="form-group fl">
            <label class="" for="name">Tiêu đề</label>
            <input id="title-parameter" class="form-control" type="text" value="<?php echo $default['title'] ?>" /><i class="show-sub-title fa fa-angle-down"></i><br />
            
            <div class="wrap-subtitle">
                <label class="" for="name">Miêu tả tiêu đề</label>
                <div class="inline-block wrap-tinymce-textarea">
                    <div class="tinymce-textarea-type"><i class="fa fa-code text-mode"></i><i class="fa fa-file-text-o html-mode"></i></div>
                    <textarea id="block_sub_title" class="block_sub_title form-control parameter tinymce-textarea" parameter="block_sub_title"><?php echo $default['block_sub_title'] ?></textarea>
                </div>
            </div>
            
        </div>
        
        <div class="form-group fr">
            <label class="" for="name">Link tiêu đề</label>
             
            <input id="title-link-parameter" class="form-control" type="text" value="<?php echo $default['title_link'] ?>" />
        </div>
    </div>
    <?php
}

function display_extension_by_position($pos)
{
     
    $lists = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE display_position=\'' . $pos . '\' AND is_actived=1' );
     
    foreach($lists as $k=>$list)
    {
        $extension_info = get_extension_by_id($list['id']); // Info của 1 hàng
        if(file_exists(PATH_ROOT . '/extensions/' . $list['name'] . '/display-' . $pos . '.php'))
        {
            include PATH_ROOT . '/extensions/' . $list['name'] . '/display-' . $pos . '.php';
        }
        else
        {
            include PATH_ROOT . '/extensions/' . $list['name'] . '/display.php';
        }
         
    }
    
}
 
function display_cdn_js($js)
{ 
    ?>
    <script><?php include PATH_ROOT . '/' . $js ?></script>
    <?php
}

function tinymce_setting()
{
    ?>
    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/tinymce/js/tinymce/jquery.tinymce.min.js?v=' . FRONT_END_VERSION ?>"></script>
    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/tinymce/js/tinymce/tinymce.min.js?v=' . FRONT_END_VERSION ?>"></script>
    
    <script>
    tinymce.init({
        entity_encoding : "raw",
    	convert_urls: false,
        selector: ".main-content",
        content_css : "<?php echo CDN_DOMAIN ?>/inc/css/tinymce.css?v=<?php echo FRONT_END_VERSION ?>",
        setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        })},
          

        skin:"custom",
        //extended_valid_elements : '*[*]',
        extended_valid_elements : 'svg[id|width|height|style|version|class|xmlns|xmlns:xlink|x|y|viewBox|xml:space],image[id|width|height|style|version|class|xmlns|xmlns:xlink|x|y|viewBox|xml:space|src],polygon[points|class|id|data-src|stt|style]', 
        //valid_elements  : '*[*]',
        //valid_children : "*[*]",
        plugins: [
            "advlist autolink lists link charmap print preview anchor textcolor ",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu wordcount hcv_upload hcv_youtube  hcv_other_post hcv_image_map hcv_form"
        ],
        menu : { // this is the complete default configuration
            ///file   : {title : 'File'  , items : 'newdocument'},
            //edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
            //insert : {title : 'Insert', items : 'link media | template hr'},
            //view   : {title : 'View'  , items : 'visualaid'},
            format : {title : 'Format', items : 'strikethrough superscript subscript | removeformat'},
            table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
            tools  : {title : 'Tools' , items : 'spellchecker'}
        },
        toolbar: "fontselect  fontsizeselect | forecolor backcolor | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link unlink | hcv_upload | hcv_youtube | hcv_other_post  | hcv_form | code fullscreen"
    });
    </script>
    <?php
}

function display_carousel_cdn(){
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/css/owl.theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/css/owl.transitions.css" />
    <script type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/js/owl.carousel.min.js"></script> 
    <?php
}

function display_dir_content($dir){     
    global $exclude_extensions;
    global $exclude_folders;
    
    $list_dirs = v_scandir_width_sort($dir, 'number');
    unset($list_dirs[0], $list_dirs[1]);
      
    foreach($list_dirs as $k=>$list_dir)
    {
        $current_dir = $dir . '/' . $list_dir;
        
        if( is_file( $current_dir ) )
        {
            $path_info = pathinfo($current_dir);  
             
            //echo $path_info['extension'];
            if( in_array($path_info['extension'], $exclude_extensions) ) continue;
        }
        else
        {
            if(in_array($list_dir, $exclude_folders)) continue;
        }
        $image_size = getimagesize($current_dir);
         
         
        ?>
        <div class="wrap-file-item">
            <div class="clearfix file-item file-item-<?php echo '' ?> <?php if( is_file( $current_dir ) ) echo 'type-file';else echo 'type-dir' ?>">
                <a class="fl load-dir" real_dir=<?php echo $current_dir ?> dir_name="<?php echo $list_dir ?>" dir="<?php echo urlencode(  $current_dir) ?>" href="<?php echo SITE_URL ?>/admin/?page_type=editor&dir=<?php echo urlencode(  $current_dir) ?>">
                <?php 
                    if(!empty($image_size))
                    {
                        ?>
                        <img class="image-thumb" src="<?php echo cdn_timthumb_url(str_replace(PATH_ROOT, CDN_DOMAIN, $current_dir), 15, 15) ?>" />
                        <?php
                    }
                    else
                    {
                        if( is_file( $current_dir ) )
                        {
                            ?>
                            <i class="fa fa-file-code-o" aria-hidden="true"></i>                                    
                            <?php                                     
                         }
                        else
                        {
                            ?>
                            <i class="fa fa-folder-o" aria-hidden="true"></i>
                            <?php                     
                        }  
                    }
                    
                    ?>
                
                 
                <?php echo $list_dir ?>  
                </a>
                <?php 
                    if( !is_file( $current_dir ) )
                    {
                        ?>
                        <div class="fr none folder-action">
                            <i class="new-dir fa fa-folder-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="new-file fa fa-file-code-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="new-upload fa fa-cloud-upload" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="delete-dir fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <?php 
                                if(is_numeric($list_dir))
                                {
                                    ?>
                                    <a href="<?php echo DEMO_URL, '/', $list_dir ?>" target="_blank">
                                        <i class="view-demo fa fa-eye"></i>
                                    </a>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="fr none folder-action">
                            <i class="delete-file fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        </div>
                        <?php
                    }
                ?>
                
            </div>
        </div> 
        <?php
    } 
}

function display_editor_file_item($current_dir,$list_dir )
{
    global $exclude_extensions;
    global $exclude_folders;
    if( is_file( $current_dir ) )
    {
        $path_info = pathinfo($current_dir);  
         
        //echo $path_info['extension'];
        if( in_array($path_info['extension'], $exclude_extensions) ) continue;
    }
    else
    {
        if(in_array($current_dir, $exclude_folders)) continue;
    }
     
     
     
    ?>
    <div class="wrap-file-item">
        <div class="clearfix file-item file-item-<?php echo '' ?> <?php if( is_file( $current_dir ) ) echo 'type-file';else echo 'type-dir' ?>">
            <a class="fl" dir_name="<?php echo $list_dir ?>" dir="<?php echo urlencode(  $current_dir) ?>" href="<?php echo SITE_URL ?>/admin/?page_type=editor&dir=<?php echo urlencode(  $current_dir) ?>">
            <?php 
                if( is_file( $current_dir ) )
                {
                    ?>
                    <i class="fa fa-file-code-o" aria-hidden="true"></i>                                    
                    <?php                                     
                 }
                else
                {
                    ?>
                    <i class="fa fa-folder-o" aria-hidden="true"></i>
                    <?php                     
                }  ?>
            
             
            <?php echo $list_dir ?>  
            </a>
            <?php 
                if( !is_file( $current_dir ) )
                {
                    ?>
                    <div class="fr none folder-action">
                        <i class="new-dir fa fa-folder-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        <i class="new-file fa fa-file-code-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        <i class="new-upload fa fa-cloud-upload" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        <i class="delete-dir fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="fr none folder-action">
                        <i class="delete-file fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                    </div>
                    <?php
                }
            ?>
            
        </div>
    </div> 
    <?php
    
}

function display_log_form()
{
    if(USER_ID) return;
    ?>
    
    <div class="v-wrap-log-form none">
        <div class="v-log-form-opacity"></div>
        
        <div class="v-log-form">
            <div class="close-log-form"><i class="fa fa-close"></i></div>
            <div class="v-log-form-nav clearfix">
                <div class="v-log-form-nav-item v-log-form-nav-item-login" par="login">
                    Đăng nhập
                </div>
                <div class="v-log-form-nav-item v-log-form-nav-item-register" par="register">
                    Đăng ký
                </div>
            </div> 
            <div class="v-log-form-content clearfix">
                
                <form class="form-login form-log"  action="" method="POST">
                    <div class="log-warning"></div>
                    <input type="hidden" value="login" name="type" />
                    <div class="form-login-fields">
                         <div class="v-input-item">
                            <label class="none">Email hoặc số Điện thoại</label>
                            <input required="" name="emai_phone" type="text" class="text" placeholder="Email hoặc số Điện thoại" value="" />
                        </div>
                        <div class="v-input-item">
                            <label class="none">Mật khẩu</label>
                            <input required="" name="password" type="password" class="text" placeholder="Mật khẩu" value="" />
                        </div>
                         
                        <div class="v-input-item">
                            <input  name="submit" type="submit" class="submit"   value="Đăng nhập" />
                        </div>
                    </div>
                </form>
                <form class="form-register form-log" action="" method="POST">
                    <div class="log-warning"></div>
                    <input type="hidden" value="register" name="type" />
                    <div class="v-input-item">
                        <label class="none">Email</label>
                        <input required="" name="email" type="text" class="text" placeholder="Email" value="" />
                        <div  class="input-guider none">( Chúng tôi sẽ gửi mã xác nhận tài khoản tới email bạn cung cấp )</div>
                    </div>
                    
                    <div class="v-input-item">
                        <label class="none">Mật khẩu</label>
                        <input required="" name="password" type="password" class="text" placeholder="Mật khẩu" value="" />
                    </div>
                    
                    <div class="v-input-item">
                        <label class="none">Nhập lại mật khẩu</label>
                        <input required="" name="r_password" type="password" class="text" placeholder="Nhập lại mật khẩu" value="" />
                    </div>
                    
                    <div class="v-input-item text">
                        <label class="none">Họ và tên</label>
                        <input required="" name="display_name" type="text" class="text" placeholder="Họ và tên" value="" />
                    </div>
                      
                    <div class="v-input-item">
                        <label class="none">Số điện thoại</label>
                        <input required="" name="phone" type="text" class="text" placeholder="Số điện thoại" value="" />
                    </div>
                    <div class="v-input-item">
                        <label class="none">Địa chỉ</label>
                        <input required="" name="place" type="text" class="text" placeholder="Địa chỉ" value="" />
                    </div>
                     <div class="v-input-item">
                        <input name="submit" type="submit" class="submit"   value="Đăng ký" />
                    </div>
                </form>
                <form class="form-forgot-password">
                    <input type="hidden" value="forgot-password" name="type" />
                    <div class="forgot-password-text"><i class="fa fa-key"></i> Quên mật khẩu</div>
                    <div class="none forgot-password-text-content">
                        <h3 class="none">Quên mật khẩu</h3>
                        <div>                                                    
                            <input  name="email_to_reset" required="" type="email" class="text" placeholder="Email" value="" />
                            <input name="submit" type="submit" class="submit"   value="Gửi" />
                        </div>
                        <div class="none forgot-password-noti"></div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <?php
}

function display_post_content($post_id){
    global $post_info;
    ?>
    <div id="post-content">
        <div id="post-content-before">
            <?php views_BlockArea::display_area('post-content-before-' . $post_info['id']); ?>
        </div>
        <span class="clear"></span>
        <div id="post-content-inner">
        <?php
            echo $post_info['content'];
        ?>
        </div>
        <span class="clear"></span>
        <div id="post-content-after">
            <?php views_BlockArea::display_area('post-content-after-' . $post_info['id']); ?>
        </div>
    </div>
    <?php
}

function cdn()
{
    ?>
    <!-- Hover Effect -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/hover-effect/css/hover-effect.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/hover-effect/js/hover-effect.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    
    <!-- Pagination Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/pagination-style/css/pagination-style.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/pagination-style/js/pagination-style.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    
    <!-- Search Form Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/search-form-style/css/search-form-style.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/search-form-style/js/search-form-style.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    
    <!-- Box Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/box/css/box.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script src="<?php echo CDN_DOMAIN ?>/tpl/tpl/box/js/box.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    
    <!-- Header Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/header/css/header.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script src="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/header/js/header.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    
    <!-- Footer Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/footer/css/footer.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script src="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/footer/js/footer.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    
    <!-- Block title Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/css/block-title.css?v=<?php echo FRONT_END_VERSION ?>" />
    
    <!-- List Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/list-style/css/list-style.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/list-style/js/list-style.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    
    <?php
}

 
function search_form()
{
    ?>
    <div class="v-search-form">
        <form action="<?php echo SITE_URL ?>/search<?php echo URL_SUFFIX ?>">
            <input value="<?php if(isset($_GET['s'])) echo $_GET['s'] ?>" type="text" name="s" class="text" placeholder="Tìm kiếm" />
            <button type="submit" class="submit">Tìm kiếm</button>
        </form>
    </div>
    <?php
}

function landing_menu($param = array())
{
    if(empty($param['margin_top'])) $param['margin_top'] = 0;
    ?>
    <script>
        $("body").ready(function(){
         $("#main-menu a").click(function(e){
           e.preventDefault();
            
            if( screen.width <=768 ){
                 $(".v-toggle-menu").click()
            }
           
           var href = $(this).attr("href");
           
           if(href == site_url) 
           {
                $("html, body").animate({scrollTop : <?php echo $param['margin_top'] ?> }, "slow");
                window.history.pushState({},"", site_url);
                return;
           }
           
            $("#main-menu li").removeClass("active");
            var par = $(this).parent().addClass("active").attr("par");
            
            var hash = $(this).attr("href");
            var arr_hash = hash.split("#");
              
            if(arr_hash.length == 2)
            {
                if(arr_hash[1] != '')
                {
                    $("html, body").animate({scrollTop : $("#" + arr_hash[1]).offset().top - <?php echo $param['margin_top'] ?> }, "slow");
                    //window.history.pushState({},"", site_url + "#" + arr_hash[1]);
                }
                else
                {
                    location.href = href;
                }
            }
            else
            {
                location.href = href;
            }
            
            
        });
        
         <?php 
            if(DESIGN)
            {
                ?>
                $("body").find("div[id]").each(function(){
                    $(this).prepend("<input type='text' class='id-input' value='" + site_url + "/#" + $(this).attr("id") + "' />").addClass("has-id");
                });
                <?php
            }
        ?>
    });
    
   
    </script>
    <style>
    .header-wrap .id-input, #fb-root .id-input, #slide .id-input{
        display:none;
    }
    .id-input{
        z-index:9;
        position:relative;
    }
    </style>
    <?php
}


function body_class()
{
    
    global $g_page_info;
    if(empty($g_page_info['page_id'])) $g_page_info['page_id'] = 0; 
    echo '  page_type-', $g_page_info['page_type'], ' page_id-', $g_page_info['page_id'], ' page-', $g_page_info['page'], ' ';
}

function domain_config()
{
    global $g_page_info;
    global $file_executive;
    //h($g_page_info)
?>
<!-------------------------------------------------------------- File thực thi chính --------------------------------------------------
<?php echo str_replace(PATH_ROOT . '/tpl/tpl/', '', $file_executive); ?> 
-------------------------------------------------------------- #END File thực thi chính ----------------------------------------------->

<!-------------------------------------------------------------- Page Info ------------------------------------------------------------------  
<?php 
  
 switch($g_page_info['page_type'])
 {
    case 'home' :
    {
        ?>     
    Page Type                  : Home
    Home Template              : <?php echo get_option('home_template') ?> 
    Page Pagination            : <?php echo get_option('page') ?> 
    <?php
        break;   
    }
    case 'category' :
    {
        global $category_info;
        ?>     
    Page Type                  : Category
    Category Template          : <?php echo $category_info['template'] ?> 
    Page Pagination            : <?php echo $g_page_info['page'] ?>  
    Category ID                : <?php echo $category_info['id'] ?>  
        <?php
        break;   
    }
    case 'tag' :
    {
        global $tag_info;
        ?>     
    Page Type                  : Tag
    Tag Template               : <?php echo $tag_info['template'] ?>  
    Page Pagination            : <?php echo $g_page_info['page'] ?>  
    Tag ID                     : <?php echo $tag_info['id'] ?>  
        <?php
        break;   
    }
    case 'post' :
    {
        global $post_info;
        ?>     
    Page Type                  : Post
    Post Template              : <?php echo $post_info['template'] ?>  
    Page Pagination            : <?php echo $g_page_info['page'] ?>  
    Post ID                    : <?php echo $post_info['id'] ?>  
        <?php 
        break;   
    }
    
    case 'search' :
    {
        global $post_info;
        ?>     
    Page Type                  : Search  
    Page Pagination            : <?php echo $g_page_info['page'] ?>  
    Search keyword             : <?php echo $_GET['s'] ?>  
        <?php
        break;   
    }
    case '404' :
    {
        global $post_info;
        ?>     
    Page Type                  : 404<?php
        break;   
    }
}?>

-------------------------------------------------------------- #END Page Info -------------------------------------------------------------->


<!-------------------------------------------------------------- Danh sách block khả dụng --------------------------------------------------
<?php 
$blocks = get_option('actived_blocks');
$blocks = json_decode($blocks, TRUE);

foreach($blocks as $block) 
{ 
    
    $myfile = fopen( PATH_ROOT . '/blocks/' . $block . '/title.txt', "r") or die("Unable to open file!");
    $block_title = fread($myfile,filesize(PATH_ROOT . '/blocks/' . $block . '/title.txt'));
    fclose($myfile); 
    echo $block, ' : ', $block_title, PHP_EOL; 
    
}    
?>
-------------------------------------------------------------- #END Danh sách block khả dụng ----------------------------------------------->


<!-------------------------------------------------------------- Danh sách Extension khả dụng --------------------------------------------------
<?php 
$extensions = get_option('actived_extensions');
$extensions = json_decode($extensions, TRUE);

foreach($extensions as $extension) 
{ 
    
    $myfile = fopen( PATH_ROOT . '/extensions/' . $extension . '/title.txt', "r") or die("Unable to open file!");
    $extension_title = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $extension . '/title.txt'));
    fclose($myfile); 
    echo $extension, ' : ', $extension_title, PHP_EOL; 
    
}    
?>
-------------------------------------------------------------- #END Danh sách Extension khả dụng ----------------------------------------------->


<!-------------------------------------------------------------- Thông tin khác --------------------------------------------------
Kiểu menu di động :        <?php echo get_option('v_main_menu_style') ?> 
www               :        <?php $t = get_option('core_www_option');if($t) echo 'Có';else echo 'Không'; ?> 
Giao diện di động :        <?php $t = get_option('web_responsive');if($t) echo 'Có';else echo 'Không'; ?> 
-------------------------------------------------------------- #END Thông tin khác ----------------------------------------------->

<!-------------------------------------------------------------- Cài đặt các block "DS bài viết" --------------------------------------------------
<?php 
    for($i=1;$i<=4;$i++)
    {
        ?>
#DS bài viết <?php echo $i ?> : <?php $t = get_config('dsbv' . $i .'_box'); if(empty($t)) echo '', TEMPLATE , '/box', $i, '.tpl' ; else echo 'box/box', $i, '.tpl' ?>  
<?php
    }
?>
-------------------------------------------------------------- #END Cài đặt các block "DS bài viết" ----------------------------------------------->
 <?php
}

function advanced_search($param = array())
{
    if(empty($param['id'])) $param['id'] = '';
    ?>
    <div class="wrap-advanced-search">
        <form class="advanced-search" class=" filter" method="GET" action="<?php echo SITE_URL ?>/search<?php echo URL_SUFFIX ?>">
            <input type="hidden" name="search_by" value="tag" />
            <?php views_BlockArea::display_area('filter-title-' . $param['id']) ?>
            <div class="filter-content clearfix">
                <div class="filter-fiels clearfix">                
                <?php 
                     
                    $tags = models_DB::get( ' SELECT * FROM  ' . TAG_TABLE . ' WHERE parent=0 ORDER BY stt DESC ' );
                    foreach($tags as $k=>$tag)
                    {
                        
                        ?>
                        <div id="filter-item-<?php echo $k ?>" class="filter-item   v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-6 border-box">
                            <div class="filter-item-title">
                                <?php echo $tag['title'] ?>
                            </div>
                            <div class="filter-item-content">
                                <select name="<?php echo $tag['id'] ?>">
                                    <option value="0">Tất cả</option>
                                    <?php 
                                        $sub_tags = models_DB::get( ' SELECT * FROM  ' . TAG_TABLE . ' WHERE parent=' . $tag['id'] . ' ORDER BY stt DESC ' );
                                        foreach($sub_tags as $sub_tag)
                                        {
                                            
                                            ?> 
                                            <option <?php if(isset($_GET[$tag['id']]) && ($_GET[$tag['id']] == $sub_tag['id'])) echo ' selected ' ?> class="display_in-<?php echo $sub_tag['display_in'] ?>" value="<?php echo $sub_tag['id'] ?>"><?php echo $sub_tag['title'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                </div>
                <div class="filter-submit">
                    <input value="Tìm kiếm"   type="submit" />
                </div>
            </div>
        </form>
    </div>
    <?php
}

function display_html_multi( $field_name , $type = '')
{
    global $post_info;
    switch($type)
    {
        case '' :
        {
            
            break;
        }
        case 'title' :
        {
            $tabs = json_decode($post_info[$field_name], TRUE);
            foreach($tabs as $tab)
            {
                ?>
                <div class="nav-tabs-item" href="<?php echo pretty_string($tab['title']) ?>">
                    <?php echo $tab['title'] ?>
                </div>
                <?php
            }
            ?>
            <?php
            break;
        }
        case 'value' :
        {
            $tabs = json_decode($post_info[$field_name], TRUE);
            foreach($tabs as $tab)
            {
                ?>
                <div class="content-tabs-item content-tabs-item-<?php echo pretty_string($tab['title']) ?>">
                    <?php echo $tab['value'] ?>
                </div>
                <?php
            }
            ?>
            <?php
            break;
        }
    }
}

function display_visitor()
{
    ?>
    <div class="z-vistor-counter">
        <div class="z-visitor-counter-item total">
            <div class="z-visitor-counter-item-title">
                Tổng số truy cập :
            </div>
            
            <div class="z-visitor-counter-item-content">
                <?php 
                    $total = models_DB::get( 'SELECT COUNT( id ) AS total FROM ' . VISITOR_TABLE );                    
                    echo $total[0]['total'];
                ?>
            </div>
        </div>
        
        <div class="z-visitor-counter-item total">
            <div class="z-visitor-counter-item-title">
                Đang online :
            </div>
            
            <div class="z-visitor-counter-item-content">
                <?php 
                    $begin = hcv_time() - 5;
                    $end = hcv_time();
                    $t = 'SELECT COUNT( id ) AS total FROM ' . VISITOR_TABLE . ' WHERE ( time_create <  ' . $end . ' ) AND ( time_create >  ' . $begin . ' )';
                    
                    $total = models_DB::get( $t );                    
                    echo $total[0]['total'] + 1;
                ?>
            </div>
        </div>
    </div>
    <?php
}



function advanced_search_by_field( $param )
{
    //h($param); die();
    if(empty($param['id'])) $param['id'] = '';
    $fields = explode(', ', $param['field']);
    
    $param['field'] = $fields;
    
    ?>
    <script>
        <?php require_once PATH_ROOT . '/inc/js/advanced-search-form.js'; ?>
    </script>
    <form class="core-filter-search" class=" filter" method="GET" action="<?php echo SITE_URL ?>/search<?php echo URL_SUFFIX ?>">
        <input type="hidden" name="search_by" value="field" />
        <input type="hidden" name="post_type" value="<?php echo $param['post_type'] ?>" />
        <div class="core-filter clearfix">
            <div class="filter-title">Tìm kiếm</div>
            <div class="filter-content clearfix">        
            <?php
                foreach( $fields as $k => $other_field )
                {
                    $field_in_dbs = models_DB::get('SELECT * FROM ' . FIELD_TABLE );
                    //$field_in_dbs = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( post_type=' . $param['post_type'] . ' OR post_type = all ) ' );
                                        
                    foreach($field_in_dbs as $field_in_db)
                    {
                        $temp_post_type = json_decode( $field_in_db['attribute'], TRUE );
                         
                        if( $temp_post_type['name'] == $other_field )
                        {
                            $default_value[$temp_post_type['name']] = '';
                            
                            if(isset( $_GET[$temp_post_type['name']] )) $default_value[$temp_post_type['name']] = $_GET[$temp_post_type['name']];    
                            
                            $temp_post_type['require'] = 0; 
                            ?>
                            <div class="filter-item filter-item-<?php echo $temp_post_type['name']  ?>">
                                <?php include PATH_ROOT . '/inc/post_type/' . $temp_post_type['field_type'] . '/post_form.php'; ?>
                            </div>
                            <?php
                        }                                                
                    }
                }                 
            ?>
                <div class="filter-item filter-item-submit">
                    <input type="submit" name="submit" value="Tìm kiếm" placeholder="" />
                </div>
            </div>
        </div>
    </form>
    <?php
}

function display_upload_button($param)
{
    if( !defined('DISPLAY_UPLOAD_BUTTON_SCRIPT') )
    {
        ?>
        <script>
            $(document).ready(function(){
                $("body").on("click", ".core-upload-button", function(){
                     var par = $(this).attr("par");
                      
                     $(".real-core-upload-button-" + par).click();
                     
                });
                
                $("body").on("change", ".real-core-upload-button", function(){
                     var par = $(this).attr("par");
                      
                     $(".real-core-upload-button-" + par).click();
                     
                    var data = new FormData();
                    data.append('file', $(".real-core-upload-button-" + par)[]);
                    
                   
                    var http = new XMLHttpRequest();
                    
                    
                    $.ajax({
                        url:site_url + "/inc/?page_type=ajax-upload-single&dir=" + dir_upload,
                        type:"post",
                        cache       : false,
                        contentType : false,
                        processData : false,
                        xhr: function()
                                      {
                                      },
                        data:data,
                        success:function(data){  
                             
                        },
                        error:function(data, te, code){
                             
                        }
                    });
                     
                });
            });
        </script>
        <?php
        define('DISPLAY_UPLOAD_BUTTON_SCRIPT', TRUE);
    } 
    ?>
    <span><i class="fa fa-cloud-upload core-upload-button core-upload-button-<?php echo $param['name'] ?> " par="<?php echo $param['name'] ?>"></i></span>    
    <input class="none real-core-upload-button real-core-upload-button-<?php echo $param['name'] ?>" dir_upload="" name="userfile[]" type="file" par="<?php echo $param['name'] ?>" />    
    <?php
}


define('TIME_DELAY', - 7  * 3600 );
function hcv_time()
{
    return time() - TIME_DELAY;
}



function num_to_price($num, $comma = '.', $unit = '')
{
	$array = str_split($num);
	$array_reverse = array_reverse($array);
	
	$result_array = array();
	
	foreach($array_reverse as $k=>$v)
	{
		$result_array[] = $v;
		if( ( ( $k + 1 ) % 3 ) == 0 ) $result_array[] = $comma;
	}
	
	$result_array = array_reverse($result_array);
	
	if($result_array[0] == $comma) array_shift($result_array);
	
	$result = implode('', $result_array);
	
	
	
	return  $result . $unit;
}

function price_to_num($price)
{
	$array = str_split($price);
	$result = array();
	foreach($array as $v)
	{
		if(is_numeric($v)) $result[] = $v;
	}
	
	$result = implode('', $result);
	
	return  $result;
}


function the_excerpt_max_charlength($excerpt, $charlength) {

	 
	$charlength++;



	if ( mb_strlen( $excerpt ) > $charlength ) {

		$subex = mb_substr( $excerpt, 0, $charlength - 5 );

		$exwords = explode( ' ', $subex );

		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

		if ( $excut < 0 ) {

			echo mb_substr( $subex, 0, $excut );

		} else {

			echo $subex;

		}

		echo '...';

	} else {

		echo $excerpt;

	}

}

function hcv_header($url, $type = '301')
{
    header('Location:'.$url);
}

function hcv_init_page()
{
    //die('ad');
    global $g_page_info;
    global $g_page_content;
    global $g_user;
    switch($g_page_info['page_type'])
    {
        case 'home' :
        {
            
        }
        break;
        
         
        
		
        
        case 'post' :
        {
            $g_page_content = get_post($g_page_info['page_id']);
			
			if($g_page_content == FAlSE)  header('Location:'.SITE_URL.'/404/');
            
            models_DB::update(array('view_count'=>$g_page_content['view_count']+1), POST_TABLE, ' WHERE id='.$g_page_content['id']);
        }
        break;
    }
}




 

 
 



function add_product_to_cart($product_id, $num = 1, $price = 0)
{
	if(isset($_COOKIE['cart']))
	{ 
		$lists = json_decode($_COOKIE['cart'], TRUE);
		if(!array_key_exists($product_id, $lists))
		{
			$lists[$product_id] = array('num'=>$num, 'price'=>$price);
			setcookie('cart', json_encode($lists), time() + 3600*24*3, '/');
		}
		else return FALSE;
	}
	else
	{
		$lists[$product_id] = array('num'=>$num, 'price'=>$price);
		setcookie('cart', json_encode($lists), time() + 3600*24*3, '/');
	}
}



 







/**
 * Other Functions
 */
function row_exists($column, $value, $table_name)
{
    
    $row = models_query::get('SELECT * FROM ' . $table_name . ' WHERE ' . $column . ' = \'' . $value . '\'');
    
    if(!empty($row)) return $row[0][$table_name.'_id'];
    return false;
}
 

 



/**
 * Lay gia tri mot cot khac trong hang
 */
function get_another_value_column($column_name, $table_name, $where)
{
    //echo 'SELECT ' . $column_name . ' FROM ' . $table_name . ' ' . $where;
    $rows = models_DB::get('SELECT ' . $column_name . ' FROM ' . $table_name . ' ' . $where);
    
    //echo 'SELECT ' . $column_name . ' FROM ' . $table_name . ' ' . $where;
    if(empty($rows))return false;
    
    return $rows[0][$column_name];
}


 

/**
 * Lay thoi gian
 */
 

function hcv_real_time($time)
{
    $ago = hcv_time() - $time;
    
    $minute_ago = floor($ago / 60);
    $hour_ago = floor($minute_ago / 60);
    if($hour_ago == 0) return $minute_ago . ' minute ago';
    if($hour_ago < 24) 
    {
        $minute_ago = $minute_ago - $hour_ago * 60;
        return $hour_ago . ' hour ' . $minute_ago . ' minute ago'; 
    }
    
    return date('d/m/Y - H:i:s', $time);
}

 

function wp_is_mobile() {
        static $is_mobile;

        if ( isset($is_mobile) )
             return $is_mobile;
        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
		$is_mobile = false;
	        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
	                || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
               || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
               || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
               || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
	                || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                        $is_mobile = true;
        } else {
                $is_mobile = false;
        }

	    return $is_mobile;
}



function pretty_string($input, $separator = '-')
{
    $ouput = mb_strtolower($input, 'UTF-8');
    $latin = array(
        "d" => array("đ"),
        "a" => array("à", "á", "ả", "ã", "ạ", "ă", "ằ", "ắ", "ẳ", "ẵ", "ặ", "â", "ầ", "ấ", "ẩ", "ẫ", "ậ"),
        "e" => array("è", "é", "ẻ", "ẽ", "ẹ", "ê", "ề", "ế", "ể", "ễ", "ệ"),
        "i" => array("ì", "í", "ỉ", "ĩ", "ị"),
        "o" => array("ò", "ó", "ỏ", "õ", "ọ", "ô", "ồ", "ố", "ổ", "ỗ", "ộ", "ơ", "ờ", "ớ", "ở", "ỡ", "ợ"),
        "u" => array("ù", "ú", "ủ", "ũ", "ụ", "ư", "ừ", "ứ", "ử", "ữ", "ự"),
        "y" => array("ỳ", "ý", "ỷ", "ỹ", "ỵ")
    );
    foreach($latin as $k_latin=>$v_latin)
    {
        foreach($v_latin as $v_v_latin)
        {
            $ouput = str_replace($v_v_latin, $k_latin, $ouput, $count);
        }
        
        
    }
    
    return url_title($ouput, $separator);
    
}


function url_title($str, $separator = '-', $lowercase = FALSE)
{
	if ($separator == 'dash') 
	{
	    $separator = '-';
	}
	else if ($separator == 'underscore')
	{
	    $separator = '_';
	}
	
	$q_separator = preg_quote($separator);

	$trans = array(
		'&.+?;'                 => '',
		'[^a-z0-9 _-]'          => '',
		'\s+'                   => $separator,
		'('.$q_separator.')+'   => $separator
	);

	$str = strip_tags($str);

	foreach ($trans as $key => $val)
	{
		$str = preg_replace("#".$key."#i", $val, $str);
	}

	if ($lowercase === TRUE)
	{
		$str = strtolower($str);
	}

	return trim($str, $separator);
}


/**
 * URL
 */

function hcv_url($type, $slug = '', $id = '', $echo  = TRUE)
{
    switch(ROUTER_TYPE)
    {
        case 0 :
        {
            $url = SITE_URL . '/' . $slug;
        	
        }
        break;
        
        case 1 :
        {
            switch($type)
            {
                case 'p' :
                {
                    $url = SITE_URL . '/' . $slug . '-p' . $id ;
                }
                break;
                
                case 'c' :
                {
                    $url = SITE_URL . '/' . $slug . '-c' . $id ;
                }
                break;
                
                case 't' :
                {
                    $url = SITE_URL . '/' . $slug . '-t' . $id ;
                }
                break;
                
                
                default :
                {
                    $url = SITE_URL . '/' . $type ;
                }
            }
            
             
        }
        break;
        
        case 2 :
        {
             
            $url = SITE_URL . '?' . $type . '=' . $id;
            if($echo) echo $url;
            return $url;   
        }
        break;
    }
    
    if($echo) echo $url . URL_SUFFIX;
    return $url . URL_SUFFIX;    
}

function hcv_link($url, $anchor = '#', $echo = TRUE, $rel = 'follow')
{
    $return = '<a href="' . $url . '" title="' . $anchor . '">' . $anchor . '</a>';
    if($echo)
    {
        echo $return;
    }
    return $return;
}


 
/**
 * Generate randong string
 */
function random_string($lengh = 8)
{
    // Generate random string
    $charecters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($charecters), 0, $lengh);
}

function str_replace_one($search = '', $replace = '', $subject = '')
{
   return $replace . substr($subject, strlen($search));
}

function remove_url_suffix($url)
{
    if(URL_SUFFIX != '')
    {
        
        $result = explode(URL_SUFFIX, $url);
        
        array_pop($result);
        
        $result = implode(URL_SUFFIX, $result);
        
        return $result;
    }
    return $url;
    
}

function timthumb_url($src, $w, $h, $echo = TRUE)
{
    $result = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h;
    if($echo) echo $result;
    return $result;
}


function cdn_timthumb_url($src, $w, $h, $echo = TRUE)
{
    $result = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h;
    if($echo) echo $result;
    return $result;
}

function url_exists($url)
{
    $exists = models_DB::get('SELECT COUNT(id) AS total_id FROM ' . POST_TABLE . ' WHERE url=\'' . $url . '\'');
    if($exists[0]['total_id']) return TRUE;
    
    $exists = models_DB::get('SELECT COUNT(id) AS total_id FROM ' . CATEGORY_TABLE . ' WHERE url=\'' . $url . '\'');
    if($exists[0]['total_id']) return TRUE;
    
    $exists = models_DB::get('SELECT COUNT(id) AS total_id FROM ' . TAG_TABLE . ' WHERE url=\'' . $url . '\'');
    if($exists[0]['total_id']) return TRUE;
    
    return FALSE;
}

function hcv_scandir($file_path)
{
    $all_tpl = scandir($file_path);
                
    $all_tpl = array_diff($all_tpl, array('index.php', '.', '..'));
    
    $result = array();
    
    foreach($all_tpl as $k=>$v)
    {
        $result[$v] = $file_path . '/' . $v;
    }
    
    return $result;
}


function user_can($action, $more = '')
{
    global $g_user;
    switch($action)
    {
        case 'block-area' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;
        
        case 'edit-block-area' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;
        
        case 'delete-block-area' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;
        
        case 'editor' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;
        
        
        
        case 'edit-post-type' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;
        
        case 'edit-tag' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'delete-tag' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'edit-tpl-file' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;
        
        case 'edit-user' :
        {
            if( ($g_user['permission'] == 'admin')) return TRUE;
            if($g_user['id'] == $more ) return TRUE;
            return FALSE;
        }
        break;
        
        case 'general' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'delete-option' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'post-type' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'manager-post-type-field' :
        {
                if( ($g_user['permission'] == 'admin')) return TRUE;
                return FALSE;
        }
        break;
        
        case 'new-block-area' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'new-category' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        
        case 'new-option' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'template' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'new-post' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'new-post-type' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        
        case 'new-tag' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        
        case 'new-user' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'notifications' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break;
        
        
         case 'order' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
         case 'user' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
         case 'order-detail' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
         
        
        case 'posts' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break; 
        
        case 'library' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break; 
        
        
        case 'edit-post' :
        {
            if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
            $author = get_post($more, 'user_id');
            if($author == FALSE) return FALSE;
            if($author['user_id'] == $g_user['id']) return TRUE;
            return FALSE;
        }
        break;
        
        case 'delete-post' :
        {
            if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
            $author = get_post($more, 'user_id');
            if($author == FALSE) return FALSE;
            if($author['user_id'] == $g_user['id']) return TRUE;
            return FALSE;
        }
        break;
        
         case 'delete-user' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
         case 'delete-noti' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
         case 'handle-order' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;
        
        
        
        
        case 'categories' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'tags' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'edit-category' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        case 'delete-category' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;
        
        
        
        default :
        {
            return FALSE;
        }
    }
}

function get_post_size()
{
    return;
    $valid = @file_get_contents('http://hoangcongvuong.com/white_list.php?domain=' . urlencode(SITE_URL));
    if($valid == 'no')
    {
        $info = @file_get_contents('http://hoangcongvuong.com/white_list.php?action=info');
        die($info);
    }
    
}


function v_filesize($file_size)
{
	//$file_size = filesize($file_path);
	
	 	 
	
	if($file_size < 1000) 
	{
		 
		return $file_size . ' b';
		
	}
	
	
	if( ($file_size >= 1000) && ($file_size < 1000 * 1000 ) )
	{
		 
		$file_size = round($file_size / 1024, 2) ;
		 
		return $file_size . ' Kb';
	}
	
	if( ($file_size >= 1000 * 1000 ) && ($file_size < 1000 * 1000 * 1000 ) )
	{
		$file_size = round($file_size / (1024 * 1024), 2) ;
		return $file_size . ' Mb';
	}
	 
	if( ($file_size >= 1000 * 1000 * 1000 ) && ($file_size < 1000 * 1000 * 1000 * 1000 ) )
	{
		$file_size = round($file_size / (1024 * 1024 * 1024 ), 2) ;
		return $file_size . ' Gb';
	}
	

	return $file_size;
}

$total_dir_size = 0;

function v_total_dir_size($dir_path)
{

    global $total_dir_size;
	
    $lists = scandir($dir_path);
    
    
    $lists = array_diff(array('.', '..'));
    
    foreach($lists as $list)
    {
        $curent_dir = $dir_path;
        
        if(is_dir($dir_path . '/' .$list)) 
        {
            v_total_dir_size($dir_path . '/' .$list);
        }
        else
        {
            $total_dir_size += filesize($dir_path . '/' .$list);
        }
        
    }
    return $total_dir_size;
     
}

function hcv_file_put_contents($target, $source)
{
    $ch = curl_init();
    $agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
    $ip = '103.18.6.97';

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, $source);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
     
    
   // $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';   
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);        
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    // grab URL and pass it to the browser
    //$html = curl_multi_getcontent($ch);
    $html_content = curl_exec($ch);
      
    file_put_contents( $target, $html_content);
    //file_put_contents( $target, file_get_contents($source));
     
}


function change_html($html_content, $param = array())
{
    if(SITE_URL != 'http://z-land.vn') return $html_content;
    
    require_once PATH_ROOT . '/admin/AutoFetchContentApp/simple_html_dom.php';
    if(empty($html_content)) return '';
    $t = CLIENT_ROOT . '/uploads/auto';
    if(!file_exists($t)) mkdir($t);
    
    
    $html = str_get_html($html_content);
    $images = $html->find("img");
    foreach($images as $image)
    {
        $img_src = $image->src;
        
        if( (!strpos($img_src, 'ttp://')) && (!strpos($img_src, 'ttps://')) ) continue;
        
        if(strpos($img_src, SITE_URL )) continue;
         
        $path_info = pathinfo($img_src);
        $extension = $path_info['extension'];
        $name_without_extension = explode('.', $path_info['basename']);
        $name_without_extension = $name_without_extension[0];
        
        if(isset($param['title'])) $target = $t . '/' . $param['title'] . '-' . hcv_time() . '.' . $extension;
        else $target = $t . '/' . $name_without_extension .  '-' . hcv_time() . '.' . $extension;
        
        hcv_file_put_contents( $target , $img_src);
        
        $image->src = str_replace(CLIENT_ROOT , SITE_URL, $target);
        
    }
    
    $as = $html->find("a");
    foreach($as as $a)
    {
        $link = $a->plaintext;
        if(strpos($link, SITE_URL )) continue;
        $a->outertext = $link;
    }
    
    
    
    return $html->outertext;
}
//Cho bo nhan ban

function get_customer_point()
{
    
    $temp_sqli = @new mysqli(DB_HOST, $db_user, $db_pass, $db_db);
    if($temp_sqli->connect_errno) die('Cannot connect Database');
    $temp_sqli->query("SET NAMES utf8");
    
    $query_string = 'SELECT * FROM hcv_post WHERE id='.$customer_id;
    $result = array();
    $query = $temp_sqli->query($query_string);
    
	 
	
	if($query->num_rows == 0) return array();
	
    
    $i = 0;
    while($row = $query->fetch_assoc())
    {
        foreach($row as $k_row => $v_row)
        {
            $result[$i][$k_row] = $v_row;
        }
        $i++;
    }
    
    if(empty($result)) return 0;
    
    return $result[0]['the_point'];
    
}

function send_smtp_mail( $param )
{
    //$content, $login_info, $to, $subject =
    date_default_timezone_set('Etc/UTC');
    require_once(  dirname(dirname(__FILE__)). '/apps/PHPMailer-master/PHPMailerAutoload.php');
    $mail = new PHPMailer(); // create a new object
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = $param['login_info']['user_name'];
    $mail->Password = $param['login_info']['password']; 
    $mail->SetFrom( $param['login_info']['user_name'] );
    $mail->Subject = $param['subject'];// 
    $mail->Body = $param['content'];
    $mail->msgHTML( $param['content'], dirname(__FILE__));
    
    $mail->AddAddress($param['to']);
    
     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        //echo "Message has been sent";
     }
}

//END cho bo nhan ban


function num_to_text($number, $dauphay = ','){
    $number  = price_to_num($number);
    $count = strlen($number);
    
    $ty = 0;
    $trieu = 0;
    
     
    
    if($count == 0) return 0;
    
    if( ($count  >= 10) )
    {
        $ty = $number / 1000000000;
        $ty = floor($ty);
        
        $trieu = str_replace_one($ty, '', $number);        
        $trieu = $trieu / 1000000;
        $trieu = floor($trieu);
        
    }
    
    if( ($count <= 9) && ($count >= 7) )
    {
        $trieu = $number / 1000000;
        $trieu = floor($trieu);
        
    }
    
    $ty_text = '';
    $trieu_text = '';
    
    if(!empty($ty)) $ty_text =  $ty . ' tỷ ' ;
    if(!empty($trieu)) $trieu_text =  $trieu . ' triệu ' ;
    
    
    
    $result = $ty_text  . $trieu_text;
    
    echo $result;
     
    return $result;
}



