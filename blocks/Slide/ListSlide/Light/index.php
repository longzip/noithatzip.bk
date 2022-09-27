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
 
    <section class="slider">      
      <link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/src/css/lightslider.css" type="text/css" media="screen" />
        <div class="lightlider">
            <ul id="lightslider-id-<?php echo $block_param['block_id'] ?>" class="gallery list-unstyled cS-hidden">
                <?php
                foreach($all_item as $k=>$item)
				{
            		 $timthumb_image = SITE_URL . '/apps/timthumb/timthumb.php?src='.$item['image'].'&h='.$slide_item_height.'&w=' . $slide_item_width . '&q=' . TIMTHUMB_QUALITY;
                     
                     if( isset( $temporary_setting_parameter[0]['cut_image'] ) )
                     {
                        if( empty($temporary_setting_parameter[0]['cut_image']) ) {
                            $timthumb_image = $item['image'];                        
                         } 
                     }
                     
                     
                     
			         ?>
                     <li data-thumb="<?php echo $timthumb_image ?>"  class="v-slide-item">
                        <?php
    					if(!empty($item['link']))
    					{
    						?>
    						<a href="<?php echo $item['link'] ?>">
    						     <img src="<?php echo $timthumb_image ?>" alt="<?php echo $item['title'] ?>" />
                            </a>
    						<?php
    					}
                        else
                        {
                           ?> 
                                <img src="<?php echo $timthumb_image ?>" alt="<?php echo $item['title'] ?>" /> 
    						<?php 
                        }
                        ?>
                        <?php
                        if( ( !empty($item['title']) )   )
                        {
                            ?>
                            <div class="flex-text v-xs-none v-tx-none">
                            <?php
    						if(!empty($item['title']))
    						{
    						  	?>
    							<p class="flex-title"><?php echo $item['title'] ?></p>
    							<?php
    						}
    						?>
                            
                            <?php
    						if(!empty($item['caption']))
    						{
    						  	?>
    							<p class="flex-caption"><?php echo $item['caption'] ?></p>
    							<?php
    						}
    						?>
                            <?php
    						if(!empty($item['link']))
    						{ 
    							?>
    							<a class="flex-readmore" href="<?php echo $item['link'] ?>">
    							     Chi tiết
                                </a>
    							<?php
    						}
                            ?>
          	    	        </div>
                            <?php
                        }
                        ?>
                        
                         
      	    		</li>
                 <?php
                 }    
                 ?>
            </ul>
        </div>
      </section>
       
     

  <script defer src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/src/js/lightslider.js"></script>

  <script>
    	 $(document).ready(function() {
            $('#lightslider-id-<?php echo $block_param['block_id'] ?>').lightSlider({
                gallery:true,
                item:1,
                thumbItem:<?php echo $temporary_setting_parameter[0]['slides_per_screen'] ?>,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#lightslider-id-<?php echo $block_param['block_id'] ?>').removeClass('cS-hidden');
                }  
            });
		});
    </script>


 
  <!-- Optional FlexSlider Additions -->
  <!--
  <script src="js/jquery.easing.js"></script>
  <script src="js/jquery.mousewheel.js"></script>
  <script defer src="js/demo.js"></script>
  -->