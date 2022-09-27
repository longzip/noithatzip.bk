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




    $result = models_DB::get($query_string);

    $real_result = array();
    foreach($result as $k=>$v)
    {
        $real_result[$k] = $v;
        $post_count = get_posts(array( 'field'=>'*', 'category'=>$v['id']));
        $real_result[$k]['post_count'] = count($post_count);
    }

    return $real_result;
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


    // Ex : $param['category_or'] = '1,2,3';
    if(empty($param['category_or'])) $category_or = ' 1 ';
	else
    {
        $or_categories = explode( $param['category_or'] );

        $category_or = ' 0 ';

        foreach($or_categories as $or_category)
        {
            $category_or = $category_or . ' OR FIND_IN_SET(' . $or_category . ', categories)' ;
        }

    }

    //if(empty($param['category'])) $category = ' 1 ';
	//else $category = ' categories IN (' . $param['category'] . ') ';

    if(empty($param['tag'])) $tag = ' 1 ';
	else $tag = ' FIND_IN_SET(' . $param['tag'] . ', tags) ';

    if(isset($param['s'])) $s = ' title LIKE \'%'. $param['s'] .'%\'';
    else $s = ' 1 ';

    if(!isset( $param['schedule']) ) $schedule =  '( ( start_time <= ' . hcv_time() . ' OR start_time IS NULL OR start_time = \'\' ) AND ( end_time >= ' . hcv_time() . ' OR end_time IS NULL OR end_time = \'\' ) )' ;
    else $schedule = $param['schedule'];

    if(isset($param['custom'])) $custom = $param['custom'];
    else $custom = ' 1 ';


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

	//$query_string = 'SELECT ' . $field .  ' FROM ' . POST_TABLE . ' WHERE ' . $user_id . ' AND ' . $category . ' AND ' . $tag . ' AND ' . $status .  ' AND ' . $post_type . ' AND ' . $s .  ' ' . $order . ' ' . $limit;

    $query_string = 'SELECT ' . $field .  ' FROM ' . POST_TABLE . ' WHERE ' . $user_id . ' AND ' . $category . ' AND ' . $category_or . ' AND ' . $tag . ' AND ' . $status .  ' AND ' . $post_type . ' AND ' . $s . ' AND ' . $schedule . ' AND ' . $custom . ' ' . $order . ' ' . $limit;

    //echo $query_string;

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
 * Get post field
 */
function get_field($field_id)
{

    $temp = 'SELECT * FROM '. FIELD_TABLE . ' WHERE id=' . $field_id;


    $field = models_DB::get($temp);

    if(empty($field)) return FALSE;


    return $field[0];
}
function get_field_by_field_name($field_name)
{

    $temp = 'SELECT * FROM '. FIELD_TABLE . ' WHERE field_name=\'' . $field_name . '\'';


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
    if(empty($user[0]['display_name'])) $user[0]['display_name'] = $user[0]['user_name'];
    if(empty($user[0]['image'])) $user[0]['image'] = CDN_DOMAIN . '/inc/images/default-avatar.jpg';
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
				$this_cat = get_category($id, 'id, url, title, parent');
				$result[] = array('link'=>hcv_url('c', $this_cat['url'], $this_cat['id'], FALSE), 'anchor'=>$this_cat['title']);
			}
			$cat_id = $id;



			while($cat_id)
			{
				$cat = models_DB::get('SELECT id, url, title, parent FROM ' . CATEGORY_TABLE . ' WHERE id='. $this_cat['parent']);

				if(!empty($cat)) {

						$cat_info = get_category($cat[0]['id'], 'id, url, title');

						//h($cat_info);

						if($cat_info != FALSE)
						{
							$result[] = array('link'=>hcv_url('c', $cat_info['url'], $cat_info['id'], FALSE), 'anchor'=>$cat_info['title']);
						}
						$cat_id = $cat[0]['parent'];
				} else $cat_id = 0;



			}



            //unset($result[count($result) - 1]);

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
        case 'ico' :
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


 function hcv_file_get_content($file)
    {
        if(!file_exists( CLIENT_ROOT. '/temp.html' ))
         {
                $myfile = fopen( CLIENT_ROOT. '/temp.html', "w") or die("Unable to open file!");
                fclose($myfile);
         }

         $ch = curl_init();
         $agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
         $ip = '103.18.6.97';


        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $file);
        curl_setopt($ch, CURLOPT_HEADER, 0);



       // $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        // grab URL and pass it to the browser
        //$html = curl_multi_getcontent($ch);
        $html_content = curl_exec($ch);

        file_put_contents(CLIENT_ROOT. '/temp.html', $html_content);

        $html = file_get_html( CLIENT_ROOT. '/temp.html');

        return $html;

    }

function get_list_block_display_css()
{
    global $init_active_blocks;
    $actived_blocks = get_option('actived_blocks');
    if(empty($actived_blocks)) $actived_blocks = array();
    else $actived_blocks = json_decode($actived_blocks, TRUE);

    $actived_blocks = array_unique( array_merge($init_active_blocks, $actived_blocks) );

	foreach( scandir( PATH_ROOT . '/blocks' )  as $k=>$v )
	{

    }

}
