<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?> 
<div   class="home-item home-category block-item">
	<?php 
        if(!empty($temporary_setting_parameter['title'])) 
        {
            ?>
            <h2 class="segoeui uppercase block-title">
                <?php 
                    if(!empty($temporary_setting_parameter['title_link'])) 
                    {
                        ?>
                        <a title="<?php echo $temporary_setting_parameter['title'] ?>" href="<?php echo $temporary_setting_parameter['title_link'] ?>">
                        <?php
                    }
                    echo $temporary_setting_parameter['title'];                   
                    if(!empty($temporary_setting_parameter['title_link'])) 
                    {
                        ?>
                        </a>
                        <?php
                    }
                ?>
            </h2>
            <?php
        }
    ?>
    
	<div class="block-content">
         
		<?php

			  $param = array(
				'field'     => 'id, image, url, title, description ',
				'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
				'limit'     => ' limit 0, 1 ',// . $temporary_setting_parameter['posts_per_page'],
				'post_type' => 1
                 
			);
			
			if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
			 
			$posts = get_posts($param);
			
			 
			 
            
			foreach($posts as $post)
			{
				$image = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200'; 
				$link = hcv_url('p', $post['url'], $post['id'], FALSE);
				$title = $post['title'];
				 
				?>
                
                <div class="home-category-post-big fl v-col-lg-5 v-col-md-5 v-col-sm-5 v-col-xs-12 v-col-tx-12">
                    <a class="" title="<?php echo $post['title'] ?>" href="<?php echo $link ?>">
                        <img title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>" src="<?php echo $image ?>" />
                    </a>
                    <div class="home-category-post-big-title">
                        <a class="" title="<?php echo $post['title'] ?>" href="<?php echo $link ?>">
                              <?php echo $post['title'] ?>
                        </a>
                    </div>
                    <div class="home-category-post-big-des">
<?php the_excerpt_max_charlength(strip_tags($post['description']), 270)  ?>
                    
 
                    </div>
                </div>
                
                 
                
                
                <?php
				 
			}
            
            
		?> 
                <div class="home-category-post-small fl v-col-lg-7 v-col-md-7 v-col-sm-7 v-col-xs-12 v-col-tx-12">
                    <?php 
                        $param['limit'] = ' LIMIT 1, 3 ';
                        $posts = get_posts($param);
			
			 
			 
            
			foreach($posts as $post)
			{
				$image = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=120&h=80'; 
				$link = hcv_url('p', $post['url'], $post['id'], FALSE);
				$title = $post['title'];
                ?>
                <div class="home-category-post-small-item v-tx-mrl-5">
                    <div class="home-category-post-smaill-image fl">
                        <a class="" title="<?php echo $post['title'] ?>" href="<?php echo $link ?>">
                            <img title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>" src="<?php echo $image ?>" />
                        </a>
                    </div>
                    
                    <div class="home-category-post-smaill-text fl">
                        <div class="home-category-post-smaill-title">
                            <a class="" title="<?php echo $post['title'] ?>" href="<?php echo $link ?>">
                                  <?php echo $post['title'] ?>
                            </a>
                        </div>
                        <div class="home-category-post-smaill-des v-tx-none ">
                        <?php the_excerpt_max_charlength(strip_tags($post['description']), 150)  ?>
                        </div>
                    </div>
                    
                    <span class="clear"></span>
                </div>
                <span class="clear"></span>
            
                <?php
            }
                    ?>
                </div>
         <span class="clear"></span>
    </div>
</div> 
