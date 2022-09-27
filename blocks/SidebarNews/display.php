<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
<div class="col-md-12 col-sm-6 col-xs-12">
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
     
    <div class="sidebar-box-content block-content">
    <?php 
    $param = array(
		'field'     => '*',
		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
	 
	$posts = get_posts($param);
	
	 
	 
   
    
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=77&h=56' . '&q=' . TIMTHUMB_QUALITY;
		else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . CDN_DOMAIN . '/tpl/default/images/noimage.png&w=77&h=56' . '&q=' . TIMTHUMB_QUALITY;
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="SidebarNews-item">
            <div class="SidebarNews-item-image fl v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-4 v-col-tx-4">
                <a href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <img src="<?php echo $image ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" />
                </a>
            </div>
            <div class="SidebarNews-item-text fl v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-8 v-col-tx-8">
                <a class="SidebarNews-item-text-a" href="<?php echo $link ?>" title="<?php echo $title ?>">
                    <?php echo $title ?>
                </a>
                <div class="SidebarNews-item-text-des none">
                     <?php 
                        if(!empty($post['description']))   the_excerpt_max_charlength(strip_tags($post['description']), 70);
                        else   the_excerpt_max_charlength(strip_tags($post['content']), 70);
                    ?>
                </div>
            </div>
            <span class="clear"></span>
        </div>
        <span class="clear"></span>
        <?php
	  
		 
	}
    
    $block_cat = get_category($temporary_setting_parameter['category'], 'id, url');
     
    ?>
    
           
            
             
            
             
            </div>
     <span class="clear"></span>
</div>
<span class="clear"></span>