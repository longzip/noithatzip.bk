<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
     
    <div class="block-content">
    <?php 
    $param = array(
		'field'     => ' * ',
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
        <div class="ListNews3-item">
             
            <div class="ListNews3-item-text">
                <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                   <i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $title ?>
                </a>
                <div class="ListNews3-item-des">
                <?php 
                    if(!empty($post['description'])) the_excerpt_max_charlength(strip_tags($post['description']),200);
                    else the_excerpt_max_charlength(strip_tags($post['content']),200);
                ?>
                </div>
            </div>
            <span class="clear"></span>
        </div>
        <?php
	  
		 
	}
    
    ?>
    
    </div>
<span class="clear"></span>