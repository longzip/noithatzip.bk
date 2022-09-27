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

<div  class="vc_row wpb_row  construction_slider vc_custom_1431594758196" data-vc-full-width="true" data-vc-full-width-init="false" >
   <div class="wpb_column vc_column_container vc_col-sm-12 vc_hidden-xs">
      <div class="wpb_wrapper">
         <div class="wpb_layerslider_element wpb_content_element">
            <script data-cfasync="false" type="text/javascript">var lsjQuery = jQuery;</script>
            <script data-cfasync="false" type="text/javascript"> lsjQuery(document).ready(function() { if(typeof lsjQuery.fn.layerSlider == "undefined") { lsShowNotice('layerslider_1_1460512449_1_1','jquery'); } else { lsjQuery("#layerslider_1_1460512449_1_1").layerSlider(
            {
                responsive: false, 
                responsiveUnder: 1170, 
                layersContainer: 1170, 
                skin: 'construct', 
                navStartStop: true, 
                navButtons: true, 
                showCircleTimer: false, 
                thumbnailNavigation: 'disabled', 
                skinsPath: 'http://bestbuild.stylemixthemes.com/wp-content/themes/bestbuild/inc/ls-skins/',
                slideDelay              : 100000,
            }) } }); </script>
            <div class="ls-wp-fullwidth-container" style="height:550px;">
               <div class="ls-wp-fullwidth-helper">
                  <div id="layerslider_1_1460512449_1_1" class="ls-wp-container" style="width:1170px;height:550px;max-width:1920px;margin:0 auto;margin-top: -91px; margin-bottom: 0px;">
                     <?php
                     
                        foreach($all_item as $k=>$item)
        				{
        				    $image = $item['image'];
                            $title = $item['title'];
                            $link = $item['link'];
                            $post['description'] = $item['caption'];
                            //$title = $item[]
                            //h($item);
        				    ?>
                            <div class="ls-slide" data-ls="transition3d:all;">
                                <img src="<?php echo $image ?>" class="ls-bg" alt="title_box_bg" />
                                <div class="ls-l overlay" style="top:0px;left:0px;white-space: nowrap;" data-ls="offsetxin:0;offsetxout:0;"> </div>
                                <div class="ls-l mobile_remove" style="top:125px;left:30px;width:430px;height:255px;background:rgba(0,0,0, 0.10);white-space: nowrap;" data-ls="offsetxin:-1000;durationin:800;transformoriginin:50% top 0;"></div>
                                <div class="ls-l mobile_remove" style="top:151px;left:75px;white-space: nowrap;" data-ls="offsetxin:0;delayin:700;easingin:easeInOutBounce;rotatexin:90;scalexin:0;scaleyin:0;transformoriginin:50% top 0;">
                                   <div class="slider_line"></div>
                                </div>
                                <div class="ls-l ls-l1 mobile_remove" style="top:177px;left:76px;font-weight: 900;width:310px;font-size:30px;line-height:32px;color:#fff;" data-ls="offsetxin:0;durationin:2500;delayin:800;easingin:easeOutElastic;rotatexin:90;">
                                    <?php echo $title ?>
                                </div>
                                <div class="ls-l ls-l2 mobile_remove" style="top:255px;left:76px;width:320px;font-size:15px;line-height:22px;color:#fff;" data-ls="offsetxin:-200;durationin:2000;delayin:500;easingin:easeInOutElastic;">
                                <?php the_excerpt_max_charlength( strip_tags(($post['description'])), 400 ) ?></div>
                                <div class="ls-l mobile_remove" style="top:410px;left:30px;white-space: nowrap;" data-ls="offsetxin:0;delayin:1300;easingin:easeInOutCirc;rotatexin:90;transformoriginin:50% top 0;">
                                <a href="<?php echo $link ?>" class="button_3d white"><span data-hover="Chi ti?t">Chi tiết</span></a>
                                </div>
                             </div>
                            <?php
        				}
                         
                     ?>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php   include TEMPLATE_PATH . '/custom.php';    ?>
<link rel='stylesheet' id='layerslider-css'  href='http://kindow.vn/tpl/bestbuild/css/layerslider.css?ver=5.5.0' type='text/css' media='all' />
 



