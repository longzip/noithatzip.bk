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
		'field'     => ' * ',
		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
	 
	$posts = get_posts($param);
	
	 
	 
   
    
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=76&h=76' . '&q=' . TIMTHUMB_QUALITY;
		else $image = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . CDN_DOMAIN . '/tpl/default/images/noimage.png&w=76&h=76' . '&q=' . TIMTHUMB_QUALITY;
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		$price = price_to_num($post['gia']);
        $sale_price = price_to_num($post['gia_km']);
		?>
        <div class="SidebarProduct-item">
            <div class="SidebarProduct-item-image fl v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-4 v-col-tx-4">
                <a href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <img src="<?php echo $image ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" />
                </a>
            </div>
            <div class="SidebarProduct-item-text fl v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-8 v-col-tx-8">
                <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                    <?php echo $title ?>
                </a>
                <div class="list-price">
                    <?php 
                        if( !empty($sale_price) )
                        {
                            ?>
                           
        
                    		<p class="price inline-block">
                    			<span></span> <?php echo num_to_price($sale_price) ?><span>₫</span>
                    		</p>
                             <p class="price-old inline-block">
                                 
                    			<span></span> <?php echo num_to_price($price) ?><span>₫</span>
                    		</p>
                            <?php
                        }
                        else
                        {
                            ?>
                            <p class="price-old inline-block">
                    		</p>
        
                    		<p class="price inline-block">
                    			<span></span> <?php echo num_to_price($price) ?><span>₫</span>
                    		</p>
                            <?php
                        }
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