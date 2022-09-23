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
		'limit'     => ' limit 0, 2',// . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	 	 
	$posts = get_posts($param);
	 
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=180';
		else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=300&h=180';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews2-item fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-sx-6 v-col-tx-6 border-box">
            <div class="ListNews2-item-image">
                <a href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <img src="<?php echo $image ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" />
                </a>
            </div>
            <div class="ListNews2-item-text">
                <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                    <?php echo $title ?>
                </a>
            </div>
            <span class="clear"></span>
        </div>
        
        <?php
	  
		 
	}
    ?>
    <span class="clear"></span>
    <div class="ListNews2-small">
        <?php
        $temporary_setting_parameter['posts_per_page'] = $temporary_setting_parameter['posts_per_page'] - 2;
        $param['limit'] = ' limit 2, ' . $temporary_setting_parameter['posts_per_page'];
         
        $posts = get_posts($param);
    	 
    	foreach($posts as $post)
    	{
    		if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=180';
    		else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=300&h=180';
    		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
    		$title = $post['title'];
    		
    		?>
            
                <a title="<?php echo $title ?>" href="<?php echo $link ?>">
                                <i class="fa fa-circle"></i>
                                <?php echo $title ?></a>
                <span class="clear"></span>
            <?php
    	}
        ?>
    </div>
    </div>
<span class="clear"></span>