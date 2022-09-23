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



        <div class="flexslider">
          <ul class="slides">
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



  <!-- jQuery -->
  <!--
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>
  -->
  <!-- FlexSlider
  <script defer src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/demo/js/jquery.flexslider.js"></script>
    -->
  <script type="text/javascript">
     $(document).ready(function(){
        $('#flex-slider-<?php echo $block_param['block_id'] ?> .flexslider').flexslider({
            animation: "slide",
            start: function(slider){
              $('body').removeClass('loading');
            },
            pauseOnHover:true,
            direction: "horizontal",
            controlNav:true,
            slideshowSpeed:<?php echo $temporary_setting_parameter[0]['timer'] ?>,
            animationSpeed:<?php echo $temporary_setting_parameter[0]['transition'] ?>,
            easing:"swing",
            animateHeight: true,
            smoothHeight: true,
            stagePadding:40
          });
     })

  </script>



  <!-- Optional FlexSlider Additions -->
  <!--
  <script src="js/jquery.easing.js"></script>
  <script src="js/jquery.mousewheel.js"></script>
  <script defer src="js/demo.js"></script>
  -->
