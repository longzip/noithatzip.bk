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
 
      <section class="divas1" id="divas1-slider-<?php echo $block_param['block_id'] ?>">
      
      
        
      <!-- <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/CSSreset.min.css" /> 
	  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/divas_instructions_style.css" /> -->
	  <link id="skin" rel="stylesheet" type="text/css" media="screen" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/divas_free_skin.css" />
	  <!-- <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/content.css" /> -->
	  <!--  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/prism.css" /> -->
      
      <section class="slider_wrapper" id="slider_wrapper-<?php echo $block_param['block_id'] ?>">
			<div id="slider-<?php echo $block_param['block_id'] ?>" class="divas-slider">
				<ul class="divas-slide-container">
                    <?php 
                 
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
                     ?>
                     <li class="divas-slide"><img src="<?php echo $timthumb_image ?>" alt="<?php echo $item['title'] ?>" data-src="<?php echo $timthumb_image ?>" data-title="<?php echo $item['title'] ?>"/></li>
                     <?php
                     }
                    ?>
			    </ul>
			    <div class="divas-navigation">
			        <span class="divas-prev">&nbsp;</span>
			        <span class="divas-next">&nbsp;</span>
			    </div>
                <div class="divas-controls">
                	<span class="divas-start"><i class="fa fa-play"></i></span>
			        <span class="divas-stop"><i class="fa fa-pause"></i></span>
                </div>
			</div>
		</section>
        
        
        
        
      </section>
       
     
 <script defer src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/js/jquery.divas-1.2.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
        $("#slider-<?php echo $block_param['block_id'] ?>").divas({
        	slideTransitionClass: "divas-slide-transition-left",
        	titleTransitionClass: "divas-title-transition-left",
        	titleTransitionParameter: "left",
        	titleTransitionStartValue: "-999px",
        	titleTransitionStopValue: "0px",
        	wingsOverlayColor: "rgba(0,0,0,0.6)"
        });	
    });
 
  </script>


 
  <!-- Optional FlexSlider Additions -->
  <!--
  <script src="js/jquery.easing.js"></script>
  <script src="js/jquery.mousewheel.js"></script>
  <script defer src="js/demo.js"></script>
  -->