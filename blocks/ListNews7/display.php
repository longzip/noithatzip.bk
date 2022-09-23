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
		'limit'     => ' limit 0,1',// . $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
    
	$posts = get_posts($param);
	 
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=520&h=350';
		else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=520&h=380';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews7-big clearfix border-box ">
            <div class="ListNews7-big-inner clearfix ">
                <div class="ListNews7-big-image fl v-col-lg-5 v-col-md-5 v-col-sm-6 v-col-xs-6 v-col-tx-12 v-lg-pr-15 v-md-pr-15 v-sm-pr-15 v-xs-pr-15 border-box">
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                       <img class="scale scale-05" alt="<?php echo $title ?>" src="<?php echo $image ?>" />
                    </a>
                </div>
                <div class="ListNews7-big-text fl v-col-lg-7 v-col-md-7 v-col-sm-6 v-col-xs-6 v-col-tx-12  border-box">
                    <a href="<?php echo $link ?>" class="ListNews7-big-title" title="<?php echo $title ?>">
                       <?php echo $title ?>
                    </a>
                    <div class="ListNews7-meta clearfix ListNews7-date-big">
                        <div class="fl ListNews7-meta-item ListNews7-meta-date">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo date('d-m-Y', $post['time_update']) ?>
                        </div> 
                            <?php 
                                $cat = explode(',', $post['categories']);
                                if(!empty($cat)) $cat = get_category($cat[0]);
                                if(!empty($cat))
                                {
                                    ?>
                                    <div class="fl ListNews7-meta-item ListNews7-meta-category">
                                        
                                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>"   title="<?php echo $cat['title']  ?>">
                                            <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $cat['title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        
                    </div>
                    <div class="ListNews7-big-text-des v-xs-none v-tx-none ">
                        <?php 
                            if(!empty($post['description']))   the_excerpt_max_charlength(strip_tags($post['description']), 340);
                            else   the_excerpt_max_charlength(strip_tags($post['content']), 340);
                        ?>
                    </div>
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>" class="ListNews6-big-readmore">
                        Chi tiết
                    </a>
                </div>
                <span class="clear"></span>
            </div>
        </div>
        <?php
	  
		 
	}
    $temporary_setting_parameter['posts_per_page']--;
    $param['limit'] = ' limit 1, ' . $temporary_setting_parameter['posts_per_page'];
    
	$posts = get_posts($param);
    ?>
    <div class="ListNews7-small clearfix border-box ">
    
    <?php
    foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=260&h=180';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=260&h=180';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews7-small-item clearfix border-box">
            <div class="ListNews7-small-item-inner ">
                
                <div class="ListNews7-small-item-text   border-box">
                    <a href="<?php echo $link ?>" class="ListNews7-small-title" title="<?php echo $title ?>">
                       <?php echo $title ?>
                    </a>
                    <div class="ListNews7-meta clearfix ListNews7-date-small">
                        <div class="fl ListNews7-meta-item ListNews7-meta-date">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo date('d-m-Y', $post['time_update']) ?>
                        </div> 
                            <?php 
                                $cat = explode(',', $post['categories']);
                                if(!empty($cat)) $cat = get_category($cat[0]);
                                if(!empty($cat))
                                {
                                    ?>
                                    <div class="fl ListNews7-meta-item ListNews7-meta-category">
                                        
                                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>"   title="<?php echo $cat['title']  ?>">
                                            <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $cat['title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        
                    </div>
                    <div class="ListNews7-small-item-text-des v-md-none">
                        <?php 
                            if(!empty($post['description']))   the_excerpt_max_charlength(strip_tags($post['description']), 60);
                            else   the_excerpt_max_charlength(strip_tags($post['content']), 60);
                        ?>
                    </div>
                </div>
                 
                <span class="clear"></span>
            </div>
        </div>
        <?php
	  
		 
	}
    ?>
    </div>
    </div>
<span class="clear"></span>