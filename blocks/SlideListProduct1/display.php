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
        		'field'     => 'id, image, url, title, time_update, gia, gia_km ',
        		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
        		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
                'category'  => $temporary_setting_parameter['category']
                 
        	);
             
        	
        	   
        	$posts = get_posts($param);
        	 
        	foreach($posts as $post)
        	{
        		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=118&h=118' . '&q=' . TIMTHUMB_QUALITY;
        		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=118&h=118' . '&q=' . TIMTHUMB_QUALITY;
        		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
        		$title = $post['title'];
                
                $price = price_to_num($post['gia']);
                $sale_price = price_to_num($post['gia_km']);
        		
        		?>
                <?php 
                if(empty($sale_price)) $real_price = $price;
                else $real_price = $sale_price;
?>
                <div class="item">
    				<div class="img-chi-tiet">
    					<div class="img">
    						<a href="<?php echo $link ?>"><img class="lazyOwl" src="<?php echo $image ?>" data-src="<?php echo $image ?>" alt="<?php echo $title ?>" /></a>
    						<p class="item-action add-to-cart inline"   price="<?php echo $real_price ?>" particular="<?php echo $post['id'] ?>" ><span>Mua ngay</span></p>
                            <a href="<?php echo $link ?>" class="readmore-button item-action inline"><span>Chi tiết</span></a>
    					</div>
                        <?php 
                        if( !empty($sale_price) )
                        {
                            ?>
                            <span class="sale-percent">-<?php echo  100 * ( $price - $sale_price ) / $price ?>%</span>
                            <?php
                        }
                        ?>
    					<div class="chi-tiet">
    						<h3><a href="<?php echo $link ?>"><?php echo $title ?></a></h3>
    						
                            
                             							
    					</div>
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
    			</div>
                <?php
                
        	}
            
            ?>
			
            
		</div> <!-- owl-featured -->
	</div>
    
     
    
    </div>
<span class="clear"></span>