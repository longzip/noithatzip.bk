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
	   $link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="SidebarNews2-item">
            <div class="SidebarNews2-item-image">
                <a href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <img src="<?php echo $post['image'] ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" />
                </a>
            </div>
            <div class="SidebarNews2-item-time">
                <span><?php echo date('d-m-Y', $post['time_update']) ?></span>
            </div>
            <div class="SidebarNews2-item-text">
                <a class="SidebarNews2-item-text-a" href="<?php echo $link ?>" title="<?php echo $title ?>">
                    <?php echo $title ?>
                </a>                
            </div>
            <div class="SidebarNews2-item-text-des none">
                     <?php 
                        if(!empty($post['description']))   the_excerpt_max_charlength(strip_tags($post['description']), 170);
                        else   the_excerpt_max_charlength(strip_tags($post['content']), 170);
                    ?>
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