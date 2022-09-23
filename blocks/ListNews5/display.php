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
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=520&h=370';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=260&h=200';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews5-left clearfix border-box fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
            <div class="ListNews5-left-inner clearfix v-lg-pr-15 v-md-mr-15 v-sm-mr-15 v-xs-mr-15">
                <div class="ListNews5-left-image   border-box">
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                       <img class="scale scale-05" alt="<?php echo $title ?>" src="<?php echo $image ?>" />
                    </a>
                </div>
                <div class="ListNews5-left-text   border-box">
                    <a href="<?php echo $link ?>" class="ListNews5-left-title" title="<?php echo $title ?>">
                       <?php echo $title ?>
                    </a>
                    <div class="ListNews5-meta clearfix ListNews5-date-left">
                        <div class="fl ListNews5-meta-item ListNews5-meta-date">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo date('d-m-Y', $post['time_update']) ?>
                        </div> 
                            <?php 
                                $cat = explode(',', $post['categories']);
                                if(!empty($cat)) $cat = get_category($cat[0]);
                                if(!empty($cat))
                                {
                                    ?>
                                    <div class="fl ListNews5-meta-item ListNews5-meta-category">
                                        
                                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>"   title="<?php echo $cat['title']  ?>">
                                            <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $cat['title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        
                    </div>
                    <div class="ListNews5-left-text-des ">
                        <?php 
                            if(!empty($post['description']))   the_excerpt_max_charlength(strip_tags($post['description']), 240);
                            else   the_excerpt_max_charlength(strip_tags($post['content']), 340);
                        ?>
                    </div>
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
    <div class="ListNews5-right clearfix border-box fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
    
    <?php
    foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=260&h=180';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=260&h=180';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews5-right-item clearfix border-box ">
            <div class="ListNews5-right-item-inner ">
                <div class="ListNews5-right-item-image fl border-box">
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                       <img class="scale scale-05" alt="<?php echo $title ?>" src="<?php echo $image ?>" />
                    </a>
                </div>
                <div class="ListNews5-right-item-text fr border-box">
                    <a href="<?php echo $link ?>" class="ListNews5-right-title" title="<?php echo $title ?>">
                       <?php echo $title ?>
                    </a>
                    <div class="ListNews5-meta clearfix ListNews5-date-right">
                        <div class="fl ListNews5-meta-item ListNews5-meta-date">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo date('d-m-Y', $post['time_update']) ?>
                        </div> 
                            <?php 
                                $cat = explode(',', $post['categories']);
                                if(!empty($cat)) $cat = get_category($cat[0]);
                                if(!empty($cat))
                                {
                                    ?>
                                    <div class="fl ListNews5-meta-item ListNews5-meta-category">
                                        
                                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>"   title="<?php echo $cat['title']  ?>">
                                            <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $cat['title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        
                    </div>
                    <div class="ListNews5-right-item-text-des v-md-none">
                        <?php 
                            if(!empty($post['description']))   the_excerpt_max_charlength(strip_tags($post['description']), 140);
                            else   the_excerpt_max_charlength(strip_tags($post['content']), 140);
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