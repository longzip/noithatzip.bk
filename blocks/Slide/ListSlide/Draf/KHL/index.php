<?php 
    $slide_item_width = $temporary_setting_parameter[0]['width'];
    $slide_item_height = $temporary_setting_parameter[0]['height'];
   
    
    $slide_name = 'hcv_flex_' . $block_param['block_id'];    
    $slide_timer = $temporary_setting_parameter[0]['timer'];	
	$slide_transition = $temporary_setting_parameter[0]['transition'];
    
	$all_item = $temporary_setting_parameter;
		
    array_shift($all_item);array_shift($all_item);array_shift($all_item);
	
    $slide_item_count = count($all_item); 
?> 

<section class="box-slider">

<!-- carousel -->
<script type="text/javascript" src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/js/main.min.js"></script>
<link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/bootstrap.min.css" />

<!-- carousel -->
<link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/owl.transitions.css" />
<!-- select2 -->
<!-- Main -->
<link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/main.min.css" />

<div id="owl-slider" class="owl-carousel">

<?php 
foreach($all_item as $k=>$item)
{
    $timthumb_image = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src='.$item['image'].'&h='.$slide_item_height.'&w=' . $slide_item_width;
    ?>
    <div class="item " >
        <div class="item-img bottom-right" style="background-image:url('<?php echo $timthumb_image; ?>');"></div>
        <div class="container">
            <div class="row">
                <div class="v-col-md-4 col-md-4 col-sm-6">
                    <div class="bg-arrow">
                    </div>
                    <?php 
                    if( ( !empty($item['title']) ) && (!empty($item['caption'])) )
                    {
                        ?>
                        <div class="rst-dev">
                            <?php
    						if(!empty($item['title']))
    						{
    						  	?>
                                <h2 class="rst-animate" data-animate="fadeInDown" data-delay="0s" data-time="3s"><?php echo $item['title'] ?></h2>
    						 
    							<?php
    						}
                            ?>
                            <?php
    						if(!empty($item['caption']))
    						{
    						  	?>
                                <p class="rst-animate"  data-animate="fadeInLeft" data-delay="0s" data-time="3s" >
                                <?php echo $item['caption'] ?>   
                                </p>
    							<?php
    						}
    						?>
                            
                            
                        </div>
                        <?php   
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <?php
}
?> 
</div>
</section>