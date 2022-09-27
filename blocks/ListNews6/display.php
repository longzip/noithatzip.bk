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
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=520&h=400';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=520&h=380';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews6-big clearfix border-box ">
            <div class="ListNews6-big-inner clearfix ">
                <div class="ListNews6-big-image fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-12 v-lg-pr-15 v-md-mr-15 v-sm-mr-15 v-xs-mr-15 border-box">
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                       <img class="scale scale-05" alt="<?php echo $title ?>" src="<?php echo $image ?>" />
                    </a>
                </div>
                <div class="ListNews6-big-text fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-12  border-box">
                    <a href="<?php echo $link ?>" class="ListNews6-big-title" title="<?php echo $title ?>">
                       <?php echo $title ?>
                    </a>
                    <div class="ListNews6-meta clearfix ListNews6-date-big">
                        <div class="fl ListNews6-meta-item ListNews6-meta-date">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo date('d-m-Y', $post['time_update']) ?>
                        </div> 
                            <?php 
                                $cat = explode(',', $post['categories']);
                                if(!empty($cat)) $cat = get_category($cat[0]);
                                if(!empty($cat))
                                {
                                    ?>
                                    <div class="fl ListNews6-meta-item ListNews6-meta-category">
                                        
                                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>"   title="<?php echo $cat['title']  ?>">
                                            <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $cat['title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        
                    </div>
                    <div class="ListNews6-big-text-des ">
                        <?php 
                            if(!empty($post['description']))   the_excerpt_max_charlength(strip_tags($post['description']), 340);
                            else   the_excerpt_max_charlength(strip_tags($post['content']), 340);
                        ?>
                    </div>
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>" class="ListNew6-big-readmore">
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
    <div class="ListNews6-small clearfix border-box ">
    
    <?php
    foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=260&h=180';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=260&h=180';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews6-small-item clearfix border-box  fl v-col-lg-3 v-col-md-3 v-col-sm-6 v-col-xs-6 v-col-tx-6">
            <div class="ListNews6-small-item-inner ">
                <div class="ListNews6-small-item-image border-box">
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                       <img class="scale scale-05" alt="<?php echo $title ?>" src="<?php echo $image ?>" />
                    </a>
                </div>
                <div class="ListNews6-small-item-text   border-box">
                    <a href="<?php echo $link ?>" class="ListNews6-small-title" title="<?php echo $title ?>">
                       <?php echo $title ?>
                    </a>
                    <div class="ListNews6-meta clearfix ListNews6-date-small">
                        <div class="fl ListNews6-meta-item ListNews6-meta-date">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo date('d-m-Y', $post['time_update']) ?>
                        </div> 
                            <?php 
                                $cat = explode(',', $post['categories']);
                                if(!empty($cat)) $cat = get_category($cat[0]);
                                if(!empty($cat))
                                {
                                    ?>
                                    <div class="fl ListNews6-meta-item ListNews6-meta-category">
                                        
                                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>"   title="<?php echo $cat['title']  ?>">
                                            <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $cat['title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        
                    </div>
                    <div class="ListNews6-small-item-text-des v-md-none">
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