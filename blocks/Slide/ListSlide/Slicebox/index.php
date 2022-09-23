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
 
      <section class="slicebox-slider" id="slicebox-slider-<?php echo $block_param['block_id'] ?>">
      
       
      <link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/slicebox.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/css/custom.css" type="text/css" media="screen" />
      
      
        <div class="flexslider wrapper" id="">
          <ul class="slides sb-slider" id="sb-slider">            
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
                        if( ( !empty($item['title']) ) && (!empty($item['caption'])) )
                        {
                            ?>
                            <div class="flex-text sb-description v-xs-none v-tx-none">
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
          
          <div id="shadow" class="shadow"></div>
			<div id="nav-arrows" class="nav-arrows">
				<a href="#">Next</a>
				<a href="#">Previous</a>
			</div>

			<div id="nav-dots" class="nav-dots">
				<span class="nav-dot-current"></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
          
        </div>
      </section>
       
     

    <script   src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/js/modernizr.custom.46884.js"></script>
  
  <script   src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/js/jquery.slicebox.js"></script>
  

<script type="text/javascript">
	$(function() {

		var Page = (function() {

			var $navArrows = $( '#nav-arrows' ).hide(),
				$navDots = $( '#nav-dots' ).hide(),
				$nav = $navDots.children( 'span' ),
				$shadow = $( '#shadow' ).hide(),
				slicebox = $( '#sb-slider').slicebox( {
					onReady : function() {

						$navArrows.show();
						$navDots.show();
						$shadow.show();

					},
					onBeforeChange : function( pos ) {

						$nav.removeClass( 'nav-dot-current' );
						$nav.eq( pos ).addClass( 'nav-dot-current' );

					}
				} ),
				
				init = function() {

					initEvents();
					
				},
				initEvents = function() {

					// add navigation events
					$navArrows.children( ':first' ).on( 'click', function() {

						slicebox.next();
						return false;

					} );

					$navArrows.children( ':last' ).on( 'click', function() {
						
						slicebox.previous();
						return false;

					} );

					$nav.each( function( i ) {
					
						$( this ).on( 'click', function( event ) {
							
							var $dot = $( this );
							
							if( !slicebox.isActive() ) {

								$nav.removeClass( 'nav-dot-current' );
								$dot.addClass( 'nav-dot-current' );
							
							}
							
							slicebox.jump( i + 1 );
							return false;
						
						} );
						
					} );

				};

				return { init : init };

		})();

		Page.init();

	});
</script>

 