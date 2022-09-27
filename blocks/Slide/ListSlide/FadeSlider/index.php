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

<style>

</style>


      <section class="slider fade-slider" id="slider-<?php echo $block_param['block_id'] ?> fade-slider-<?php echo $block_param['block_id'] ?>">
      
        <div class="fadeslider">
          <ul class="rslides">            
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
                     
                     if(empty($item['title'])) $item['alt'] = 'Slide ' . $k;
                     else $item['alt'] = $item['title'];
                     
			         ?>
                     <li class="v-slide-item">
                        <?php
						if(!empty($item['link']))
						{
							?>
							<a href="<?php echo $item['link'] ?>" class="flex-slide-a">
							     <img src="<?php echo $timthumb_image ?>" alt="<?php echo $item['title'] ?>" />
                            </a>
                            
                            <a href="<?php echo $item['link'] ?>" class="flex-slide-a-opacity">
                            </a>
							<?php
						}
                        else
                        {
                           ?> 
                                <img src="<?php echo $timthumb_image ?>" alt="<?php echo $item['alt'] ?>" /> 
							<?php 
                        }
                        ?>
                        <?php
                        if( ( !empty($item['title']) ) )
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
    							<div class="flex-caption"><?php echo $item['caption'] ?></div>
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
      
      
       <script src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/responsiveslides.min.js"></script>
       <link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/fadeslider.css" />
 <script>
 $(".rslides").responsiveSlides({
      auto: true,             // Boolean: Animate automatically, true or false
      speed: 1000,            // Integer: Speed of the transition, in milliseconds
      timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
      pager: false,           // Boolean: Show pager, true or false
      nav: true,             // Boolean: Show navigation, true or false
      random: false,          // Boolean: Randomize the order of the slides, true or false
      pause: false,           // Boolean: Pause on hover, true or false
      pauseControls: true,    // Boolean: Pause when hovering controls, true or false
      prevText: "Previous",   // String: Text for the "previous" button
      nextText: "Next",       // String: Text for the "next" button
      maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
      navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
      manualControls: "",     // Selector: Declare custom pager navigation
      namespace: "rslides",   // String: Change the default namespace used
      before: function(){},   // Function: Before callback
      after: function(){}     // Function: After callback
    });
 </script>