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
 
      <section class="slider" id="flex-slider-<?php echo $block_param['block_id'] ?>">      
        <link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/dist/zoomslider.css" type="text/css" media="screen" />
        <div class="zoomlider">
            <div style="height:<?php echo $slide_item_height ?>px" data-zs-src='[<?php
                foreach($all_item as $k=>$item)
				{
            		 $timthumb_image = SITE_URL . '/apps/timthumb/timthumb.php?src='.$item['image'].'&h='.$slide_item_height.'&w=' . $slide_item_width;
                     
                     if( isset( $temporary_setting_parameter[0]['cut_image'] ) )
                     {
                        if( empty($temporary_setting_parameter[0]['cut_image']) ) {
                            $timthumb_image = $item['image'];                        
                         } 
                     }
                     
                     if(empty($item['title'])) $item['alt'] = 'Slide ' . $k;
                     else $item['alt'] = $item['title'];
                     echo '"', $timthumb_image, '"';
                     if( $k!= ( count($all_item) - 1 ) ) echo ', ';
               }
             ?>]'>
                <p>Sample inner content</p>
            </div>
        </div>
      </section>
       
     

  <script src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/demo/js/modernizr-2.6.2.min.js"></script>
  <script src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/dist/jquery.zoomslider.min.js"></script>

    