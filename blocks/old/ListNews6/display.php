<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
 
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
     
    <div class="block-content">
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
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=260&h=175';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=260&h=175';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
        include TEMPLATE_PATH . '/box.php';
	}
     
    $cat = get_category($temporary_setting_parameter['category']);
    
    ?>
    
    <div class="home-item relative fl v-col-lg-3 v-col-md-3 v-col-sm-6 v-col-xs-6 v-col-tx-12">
        <div class="home-item-inner  ">
            <a class="block" href="<?php hcv_url('c', $cat['url'], $cat['id']) ?>">
                <img src="<?php echo cdn_timthumb_url( CDN_TEMPLATE_URL . '/images/arrow-right2.png' , 270, 185); ?>" />
            </a>
        </div>
    </div>
    
    </div>
    <div class="other-cat">
        <?php 
            //echo get_option('other-cat-block-id-' . $block_id);display_edit_option_icon('other-cat-block-id-' . $block_id, 'html');
            $cats = get_categories(array('parent'=>$temporary_setting_parameter['category'], 'limit'=>' LIMIT 2 '));
            foreach($cats as $k=>$cat)
            {
                if($k) echo '|';
                ?>
                <a href="<?php hcv_url('c', $cat['url'], $cat['id']) ?>"><?php echo $cat['title'] ?></a>
                <?php
            }
        ?>
    </div>
    <div class="title-line"></div>
<span class="clear"></span>