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



        <div id="owl-carousel-id-<?php echo $block_param['block_id'] ?>" class="owl-carousel owl-theme">



            <?php
				foreach($all_item as $k=>$item)
				{

            		 //$timthumb_image = timthumb_url($item['image'], $slide_item_width, $slide_item_height, false);
            		 $g_functions = new functions_list();
                      if (!$g_functions->wp_is_mobile()){
                        $timthumb_image = timthumb_url($item['image'], $slide_item_width, $slide_item_height, false);
                      }else{
                        $timthumb_image = timthumb_url($item['image'], 800, 600, false);
                      }
                     if( empty($temporary_setting_parameter[0]['cut_image']) ) $timthumb_image = $item['image'];
                     ?>
                     <div class="item clearfix v-slide-item">

                        <?php
						if(!empty($item['link']))
						{
							?>
							<a href="<?php echo $item['link'] ?>">
                <div style="background-image:url(<?php echo $timthumb_image ?>)" class="itemBg">
                  <img src="<?php echo $timthumb_image ?>" />
                </div>

                            </a>
							<?php
						}
                        else
                        {
                           ?>
                           <div style="background-image:url(<?php echo $timthumb_image ?>)" class="itemBg">
                             <img src="<?php echo $timthumb_image ?>" />
                           </div>
							<?php
                        }
                        ?>
                        <div class="owl-carousel-text">
                        <?php
						if(!empty($item['title']))
						{
						  	?>
							<p class="owl-carousel-title"><?php echo $item['title'] ?></p>
							<?php
						}
						?>

                        <?php
						if(!empty($item['caption']))
						{
						  	?>
							<div class="owl-carousel-caption">
                                <?php echo $item['caption'] ?>
                            </div>
							<?php
						}
						?>
      	    	        </div>

      	    		</div>
                     <?php
            	}
            ?>





		</div>


      </section>


  <?php
    display_carousel_cdn();
  ?>
  <script type="text/javascript">

    $("#owl-carousel-id-<?php echo $block_param['block_id'] ?>.owl-carousel").owlCarousel({
	    items : <?php echo $temporary_setting_parameter[0]['slides_per_screen'] ?>,
	    lazyLoad : true,
	    navigation : true,
        autoplay:true,
        autoplayTimeout:<?php echo $temporary_setting_parameter[0]['timer'] ?>,
        autoplaySpeed:<?php echo $temporary_setting_parameter[0]['transition'] ?>,
        navSpeed:<?php echo $temporary_setting_parameter[0]['transition'] ?>,
        dotsSpeed:<?php echo $temporary_setting_parameter[0]['transition'] ?>,
        center:true,
        nav:true,
        loop:true,
        autoPlayHoverPause:false,
        navigationText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
        responsive:{
            0:{
                items:1,
                stagePadding:25
            },
            414:{
                items:1,
                stagePadding:25
            },
            768:{
                items:1,
                stagePadding:25
            },
            992:{
                items:<?php echo $temporary_setting_parameter[0]['slides_per_screen'] ?>
            },
            1200:{
                items:<?php echo $temporary_setting_parameter[0]['slides_per_screen'] ?>
            }
        },
        stagePadding:50
	});

  </script>
