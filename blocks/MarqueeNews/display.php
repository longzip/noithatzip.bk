<?php
	//$temporary_setting_parameter,, $current_block_id
	
	 
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?> 
    <div class="block-content v-xs-none v-tx-none">
        <marquee behavior="scroll" scrollamount="5">
            <ul>
            <?php 
            $param = array(
        		'field'     => 'id, image, url, title, time_update, categories ',
        		'order'     => ' ORDER BY ' . $temporary_setting_parameter['orderby'] . ' ' . $temporary_setting_parameter['order'] . ' ', 
        		'limit'     => ' limit ' . $temporary_setting_parameter['posts_per_page'],
                'category'  => $temporary_setting_parameter['category']
                 
        	);
        	
        	if(!empty($temporary_setting_parameter['category'])) $param['category'] = $temporary_setting_parameter['category'];
        	 
        	$posts = get_posts($param);
        	 
        	foreach($posts as $post)
        	{
        		if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=180';
        		else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=300&h=180';
        		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
        		$title = $post['title'];
                $cat = explode(',', $post['categories']);
                if(!empty($cat)) $cat = get_category($cat[0]);
                 
        		?>
                <li class="marquee-item">
                    <?php
                    if(!empty($cat))
                    {
                        ?>
                        <a href="<?php   hcv_url('c', $cat['url'], $cat['id']) ?>" class="MarqueeNews-cat-link" title="<?php echo $cat['title']  ?>">
                            <?php echo $cat['title'] ?>
                        </a>
                        <?php
                    }
                    ?>
                    <a href="<?php echo $link ?>" class="MarqueeNews-post-link" title="<?php echo $title ?>">
                        <?php echo $title ?>
                    </a>
                </li>
                <?php
        	}
            
            ?>  
            </ul>
        </marquee>
    </div>
<span class="clear"></span>
<style>
marquee ul {
    overflow: hidden;
}
</style>
<script>
    $("document").ready(function(){
        $("body").find("marquee ul").each(function(){
             
            var this_marquee = $(this);
            var this_w = 0;
            this_marquee.find("li.marquee-item").each(function(){
                this_w = this_w + $(this).width();
            });
             
            
            this_marquee.width(this_w);
        });
    });
</script>