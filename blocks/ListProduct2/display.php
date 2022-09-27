 <?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
     
    <div class="block-content">
    		<div  >
        
            <?php 
            $param = array(
        		'field'     => '*',
        		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
        		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
                'category'  => $temporary_setting_parameter['category']
                 
        	);
             
        	
        	   
        	$posts = get_posts($param);
        	 
        	foreach($posts as $post)
        	{
        		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=240&h=240';
        		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=255&h=344';
        		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
        		$title = $post['title'];
                 
                
                 include TEMPLATE_PATH . '/box.php'; 
        	}
            
            ?>
			
            
		</div>   
    
    </div>
<span class="clear"></span>