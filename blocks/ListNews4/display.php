<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
 
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
     
    <div class="block-content flex-wrap">
    <?php 
    $param = array(
		'field'     => '* ',
		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
	 
	$posts = get_posts($param);
	 
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=460&h=315';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=460&h=315';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
        include TEMPLATE_PATH . '/box.php';
	}
    if(!empty($temporary_setting_parameter['category']))
    {
        $temp_cat_info = get_category($temporary_setting_parameter['category']);
        if(!empty($temp_cat_info))
        {
            $temp_cat_info = get_category($temporary_setting_parameter['category']);
            ?>
            <div class="ListNews4-readmore-all">
                <a href="<?php hcv_url('c', $temp_cat_info['url'], $temp_cat_info['id']) ?>" title="Xem thêm">Xem thêm</a>
            </div>
            <?php
        }
         
    }
    ?>
    </div>
    
    <?php 
        if(!empty( $temporary_setting_parameter['category'] ))
        {
            $t_cat_info = get_category($temporary_setting_parameter['category'])
            ?>
            <div class="none ListNew4-readmore">
            <a href="<?php hcv_url('c', $t_cat_info['url'], $t_cat_info['id']) ?>">Xem tiếp</a>
            </div>
            <?php
        }
    ?>
    
<span class="clear"></span>