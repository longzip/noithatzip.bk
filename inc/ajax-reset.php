<?php
 
if(isset($_POST['type']) && $_POST['type']=='load_more_posts')
{
    $_POST['current_page']++;
    
    
     $param = array(
		'field'     => ' * ',
		'order'     => $_POST['order'], 
		//'limit'     => ' limit ' . $_POST['posts_per_page'] . ' OFFSET  ' . $_POST['current_page'] * $_POST['posts_per_page'],
        'category'  => $_POST['category'],
        'post_type' => $_POST['post_type'],
        'posts_per_page'    => $_POST['posts_per_page'], 
        'page'  => $_POST['current_page']
	);
	
      
	$posts = get_posts($param);
    
    
    
    $parent = dirname(__FILE__);
    $suffix = explode('-', $parent);
    
    clear_smarty_cache();
	
    global $smarty;   
    global $g_functions;
    global $g_models_DB;
    global $g_views_BlockArea;
    
   
    $n_posts = array();
	foreach($posts as $k=>$post)
	{
	    if(empty($post['image'])) $post['image'] = CDN_DOMAIN . '/inc/images/noimage.png';
        $post['link'] = hcv_url('p', $post['url'], $post['id'], FALSE);
        $post['loop_id'] = $k;
        $post['thumb_width'] = '';
        $post['thumb_height'] = '';
        $post['box_class'] = '';
        $n_posts[] = $post;
	} 
     
         
    $smarty->assign('posts', $n_posts);
    $smarty->assign('temporary_setting_parameter', $_POST);
    $t = PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/' . $_POST['box'];
    if(empty($n_posts))
    {
        ?>
        <div class="empty-posts-noti">
            Hết bài viết để hiển thị
        </div>
        <?php
    }         
    else if( file_exists( $t ) ) $smarty->display( $t );
} 