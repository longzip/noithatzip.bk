<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
     
    <div class="block-content">
    <?php 
    $param = array(
		'field'     => 'id, image, url, title, time_update ',
		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
	 
	$posts = get_posts($param);
	 
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=180';
		else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=300&h=180';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews1-item fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-sx-6 v-col-tx-12 border-box">
            <div class="ListNews1-item-image fl">
                <a href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <img src="<?php echo $image ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" />
                </a>
            </div>
            <div class="ListNews1-item-text fl">
                <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                    <?php echo $title ?>
                </a>
            </div>
            <span class="clear"></span>
        </div>
        <?php
	  
		 
	}
    
    ?>
    
    </div>
<span class="clear"></span>