<?php
	//$temporary_setting_parameter,, $current_block_id 
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
    
    <?php 
    
    if(empty($temporary_setting_parameter['post_type'])) $temporary_setting_parameter['post_type'] = '';
    $param = array(
		'field'     => ' * ',
		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category'],
        'post_type' => $temporary_setting_parameter['post_type']
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
	 
	$posts = get_posts($param);
    
    $parent = dirname(__FILE__);
    $suffix = explode('-', $parent);
    $post_block_id = $suffix[count($suffix) - 1];
	
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
        $post['thumb_width'] = $temporary_setting_parameter['thumb_width'];
        $post['thumb_height'] = $temporary_setting_parameter['thumb_height'];
        $post['box_class'] = get_config( 'dsbv' . $post_block_id . '_class' );
        $n_posts[] = $post;
	} 
         
    $smarty->assign('posts', $n_posts);
    $smarty->assign('temporary_setting_parameter', $temporary_setting_parameter);
    
    clear_smarty_cache();
    if( empty($temporary_setting_parameter['default_box']) ) {
        ?>
        <div class="block-content block-posts flex-wrap box-in-template clearfix">
        <?php
        $t = PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/box' . $post_block_id . '.tpl';
         
        if( file_exists( $t ) ) $smarty->display( $t );
        
        
        ?>
        </div>
        <?php 
        if(!empty($temporary_setting_parameter['category']))
        {
            $cat_info = get_category( $temporary_setting_parameter['category'] );
            ?>
            <div class="none posts-<?php echo $post_block_id  ?>-readmore posts-readmore">
                <a class="" href="<?php hcv_url('p', $cat_info['url'], $cat_info['id']) ?>">Xem t???t c???</a>
            </div>
            <span box="box<?php echo $post_block_id ?>.tpl" current_page="1" posts_per_page="<?php echo $temporary_setting_parameter['posts_per_page'] ?>" post_type="<?php echo $param['post_type'] ?>" order="<?php echo $param['order'] ?>" category="<?php echo $param['category'] ?>" class="none  posts-<?php echo $post_block_id  ?>-readmore-ajax posts-readmore-ajax" >Xem th??m</span>
            <?php
        }
        ?>
        <?php
    }
    else {
        ?>
        <div class="block-content block-posts flex-wrap box-in-cdn clearfix">
        <?php
        if(file_exists(PATH_ROOT . '/tpl/tpl/box/' . $temporary_setting_parameter['default_box'] . '.tpl')) $smarty->display( PATH_ROOT . '/tpl/tpl/box/' . $temporary_setting_parameter['default_box'] . '.tpl' );    
        if(!empty($temporary_setting_parameter['category']))
        {
            $cat_info = get_category( $temporary_setting_parameter['category'] );
            ?>
            <a class="none posts-<?php echo $post_block_id  ?>-readmore posts-readmore" href="<?php hcv_url('p', $cat_info['url'], $cat_info['id']) ?>">Xem t???t c???</a>
            
            
            
            
            <span box="box<?php echo $post_block_id ?>.tpl" current_page="1" posts_per_page="<?php echo $temporary_setting_parameter['posts_per_page'] ?>" post_type="<?php echo $param['post_type'] ?>" order="<?php echo $param['order'] ?>" category="<?php echo $param['category'] ?>" class="none  posts-<?php echo $post_block_id  ?>-readmore-ajax posts-readmore-ajax" >Xem th??m</span>
            <?php
        }
        ?>
        </div>
        <?php
    }
    
    ?>
<span class="clear"></span>