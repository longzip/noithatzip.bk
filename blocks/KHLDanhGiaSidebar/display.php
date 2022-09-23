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
		'field'     => ' *  ',
		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
		'post_type' => 1,
        'category'  => $temporary_setting_parameter['category']
         
	);
	
	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
	 
	$posts = get_posts($param);
	
	 
	 
   
    
	foreach($posts as $post)
	{
		if(!empty($post['image'])) $image = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=150&h=110';
		else $image = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . CDN_DOMAIN . '/tpl/default/images/noimage.png&w=150&h=110';
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		$title = $post['title'];
		
		?>
        <div class="DanhGiaSidebar-item">
            <div class=" ">
                <a class="DanhGiaSidebar-item-title" href="<?php echo $link ?>" title="<?php echo $link ?>">
                    <?php echo $title ?>
                </a>
            </div>
             <div class="DanhGiaSidebar-item-des">
                        "<?php 
                            if(empty($post['description'])) $des = $post['content'];
                            else $des = $post['description'];
                            the_excerpt_max_charlength(strip_tags($des), 100);
                        
                        ?>"
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