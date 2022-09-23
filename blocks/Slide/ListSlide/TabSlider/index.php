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

<script src="<?php echo CDN_DOMAIN, '/blocks/Slide/ListSlide/', $temporary_setting_parameter[0]['style'] ?>/js/jssor.slider-27.1.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        var jssor_1_SlideshowTransitions = [
          {$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
          {$Duration:800,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
        ];

        var jssor_1_options = {
          $AutoPlay: 1,
          $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: jssor_1_SlideshowTransitions,
            $TransitionsOrder: 1
          },
          $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
          },
          $ThumbnailNavigatorOptions: {
            $Class: $JssorThumbnailNavigator$
          }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*#region responsive code begin*/

        var MAX_WIDTH = 980;

        function ScaleSlider() {
            var containerElement = jssor_1_slider.$Elmt.parentNode;
            var containerWidth = containerElement.clientWidth;

            if (containerWidth) {

                var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                jssor_1_slider.$ScaleWidth(expectedWidth);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }

        ScaleSlider();

        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        /*#endregion responsive code end*/
    });
</script>
<style>
    /*jssor slider loading skin spin css*/
    .jssorl-009-spin img {
        animation-name: jssorl-009-spin;
        animation-duration: 1.6s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes jssorl-009-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /*jssor slider arrow skin 051 css*/
    .jssora051 {display:block;position:absolute;cursor:pointer;}
    .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
    .jssora051:hover {opacity:.8;}
    .jssora051.jssora051dn {opacity:.5;}
    .jssora051.jssora051ds {opacity:.3;pointer-events:none;}

    /*jssor slider thumbnail skin 111 css*/
    .jssort111 .p {position:absolute;top:0;left:0;width:200px;height:100px;background-color:#000;}
    .jssort111 .p img {position:absolute;top:0;left:0;width:100%;height:100%;}
    .jssort111 .t {position:absolute;top:0;left:0;width:100%;height:100%;border:none;opacity:.45;}
    .jssort111 .p:hover .t{opacity:.8;}
    .jssort111 .pav .t, .jssort111 .pdn .t, .jssort111 .p:hover.pdn .t{opacity:1;}
    .jssort111 .ti {position:absolute;bottom:0px;left:0px;width:100%;height:28px;line-height:28px;text-align:center;font-size:12px;color:#fff;background-color:rgba(0,0,0,.3)}
    .jssort111 .pav .ti, .jssort111 .pdn .ti, .jssort111 .p:hover.pdn .ti{color:#000;background-color:rgba(255,255,255,.6);}
</style>

<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:480px;overflow:hidden;visibility:hidden;">
    <!-- Loading Screen -->
    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
    </div>
    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
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
                     <div data-p="170.00" class="v-slide-item">
                        <?php
						if(!empty($item['link']))
						{
							?>
							<a href="<?php echo $item['link'] ?>" class="flex-slide-a">
							     <img data-u="image" src="<?php echo $timthumb_image ?>" alt="<?php echo $item['alt'] ?>" />
                            </a>
                            
                            
							<?php
						}
                        else
                        {
                           ?> 
                           <img data-u="image" src="<?php echo $timthumb_image ?>" alt="<?php echo $item['alt'] ?>" />                                
							<?php 
                        }
                        ?>
                        
                        <div data-u="thumb">
                            <img data-u="thumb" src="<?php echo $timthumb_image ?>" />
                            <div class="ti">
                            <?php
                            if( ( !empty($item['title']) ) )
                            {
                                ?>
                                <div class="TabSlider-text v-xs-none v-tx-none">
                                <?php
        						if(!empty($item['title']))
        						{
        						  	?>
        							<p class="TabSlider-title"><?php echo $item['title'] ?></p>
        							<?php
        						}
        						?>
                                
                                <?php
        						if(!empty($item['caption']))
        						{
        						  	?>
        							<div class="TabSlider-caption"><?php echo $item['caption'] ?></div>
        							<?php
        						}
        						?>
                                <?php
        						if(!empty($item['link']))
        						{ 
        							?>
        							<a class="TabSlider-readmore" href="<?php echo $item['link'] ?>">
        							     Chi tiết
                                    </a>
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
                     
                     <?php
            	}
            ?>
        
    </div>
    <!-- Thumbnail Navigator -->
    <div data-u="thumbnavigator" class="jssort111" style="position:absolute;left:0px;bottom:0px;width:980px;height:100px;cursor:default;" data-autocenter="1" data-scale-bottom="0.75">
        <div data-u="slides">
            <div data-u="prototype" class="p">
                <div data-u="thumbnailtemplate" class="t"></div>
            </div>
        </div>
    </div>
    <!-- Arrow Navigator -->
    <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:162px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
        </svg>
    </div>
    <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:162px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
        </svg>
    </div>
</div>