<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
 
 
     <?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
    <div class="block-content">
    
    <div class="featured">
		
 
		<div visible_posts="<?php echo $temporary_setting_parameter['visible_posts'] ?>" class="owl-carousel">
        
            <?php 
            $param = array(
        		'field'     => ' * ',
        		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
        		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
                'category'  => $temporary_setting_parameter['category']
                 
        	);
             
        	
        	   
        	$posts = get_posts($param);
        	 
        	foreach($posts as $post)
        	{
        		 $link = hcv_url('p', $post['url'], $post['id'], FALSE);
        		$title = $post['title'];
                
                 
        		
        		?>
                 
    <div class="item">
                <?php include TEMPLATE_PATH . '/news-box-2.php'; ?>
                </div>
                <?php
                
        	}
            
            ?>
			
            
		</div> <!-- owl-featured -->
	</div>
    
     
    
    </div>
<span class="clear"></span>