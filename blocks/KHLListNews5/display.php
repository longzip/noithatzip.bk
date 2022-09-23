<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
 
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
     
    <div class="block-content">
    <div class="">
    
     
                                 
    <?php 
    $param = array(
		'field'     => '* ',
		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
    
    if(!empty($param['category']))
    {
        $cat = get_category($param['category']);
        if(!empty($cat))
        {
            ?>
            <a class="view-full-category" href="<?php hcv_url('c', $cat['url'], $cat['id']) ?>">Xem tất cả</a>
            <?php
        }
        ?>
        
        <?php
    }
    
    
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
	 
	$posts = get_posts($param);
	 
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=260&h=175';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=260&h=175';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
        include TEMPLATE_PATH . '/tin-tuc-box.php';
	}
    
    ?>
    </div>
    
    </div>
<span class="clear"></span>