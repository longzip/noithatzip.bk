<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?> 
<div   class="sidebar-item">
	<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
    
	<div class="sidebar-content padding-add">
        <div class="row">
		<?php

			  $param = array(
				'field'     => ' * ',
				'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
				'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
				'post_type' => 1
                 
			);
			
			if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
			 
			$posts = get_posts($param);
			
			 
			 
            
			foreach($posts as $post)
			{
				if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=186&h=170';
				else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/hcv/images/noimage.png&w=186&h=170';
				$link = hcv_url('p', $post['url'], $post['id'], FALSE);
				$title = $post['title'];
				
				
				$price = price_to_num($post['gia']);
				
				$sale_price = price_to_num($post['gia_km']);
				
				include CDN_TEMPLATE_URL . '/box.php';
				 
			}
		?>
	</div>
    </div>
</div> 
