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
		'limit'     => ' limit  ' .    $temporary_setting_parameter['posts_per_page'],
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
     
	$posts = get_posts($param);
    ?>
    <div >
    
    <?php
    foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=260&h=150';
		else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=260&h=150';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="ListNews7-item clearfix border-box ">
            <div class="ListNews7-item-inner ">
                <div class="ListNews7-item-image fl border-box">
                    <a href="<?php echo $link ?>" title="<?php echo $title ?>">
                       <img class="scale scale-05" alt="<?php echo $title ?>" src="<?php echo $image ?>" />
                    </a>
                </div>
                <div class="ListNews7-item-text fr border-box">
                    <a href="<?php echo $link ?>" class="ListNews7-title" title="<?php echo $title ?>">
                       <?php echo $title ?>
                    </a>
                    <div class="ListNews7-meta clearfix ">
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
                                        
                                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>" class="ListNews7-item-cat"   title="<?php echo $cat['title']  ?>">
                                            <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $cat['title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        
                    </div>
                    <div class="ListNews7-item-text-des">
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