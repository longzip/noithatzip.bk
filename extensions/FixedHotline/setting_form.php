<div class="wrap-add none"  ><span class="add"><i title="Thêm" class="fa fa-plus"></i></span></div>
<div class="post-form-item clearfix" id="list-post-item" > 

 

<script src="<?php echo CDN_DOMAIN ?>/apps/colorpicker/bgrins-spectrum/spectrum.js"></script>
<link rel='stylesheet' href='<?php echo CDN_DOMAIN ?>/apps/colorpicker/bgrins-spectrum/spectrum.css' />

<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/extensions/<?php echo $_GET['extension'] ?>/css/setting_form.css?v=<?php echo random_string() ?>" />
<script src="<?php echo CDN_DOMAIN ?>/extensions/<?php echo $_GET['extension'] ?>/js/setting_form.js?v=<?php echo random_string() ?>"></script>
 

            <?php
                $popup_info = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'FixedHotline\' AND display_position=\'before_close_body\'' );
                $popup_info = $popup_info[0];        
                $attr = json_decode($popup_info['attributes'], TRUE);   
                
                $default_value = $attr;
                                     
                $fixed_hotline = get_option('fixed-hotline');
                if(empty($fixed_hotline)) $fixed_hotline = '0422.132.888';
                
                $hotline_title = get_option('hotline-fixed-text-title');
                if(empty($hotline_title)) $hotline_title = 'Hotline';
                
               
                if(empty($attr['bottom'])) $attr['bottom'] = 20;
                if(empty($attr['top'])) $attr['top'] = 20;
                if(empty($attr['left'])) $attr['left'] = 20;
                if(empty($attr['right'])) $attr['right'] = 20;               
                
                      
            ?>
            <input type="hidden" id="type" name="type" value="FixedHotline_preview" />
             
            <div class="extension-settings clearfix">
                <div class="extension-col extension-col1 fl">
                    <div class="extension-setting clearfix">
                        <div class="item-50">
                            <div class="extension-setting-title">
                                Hotline
                            </div>
                            <div class="extension-setting-content">
                                 <input type="text" value="<?php echo $fixed_hotline ?>" name="content" />
                            </div>
                        </div>
                        <div class="item-50">
                            <div class="extension-setting-title">
                                Tiêu đề
                            </div>
                            <div class="extension-setting-content">
                                 <input type="text" value="<?php echo $hotline_title ?>" name="hotline_title" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="extension-setting clearfix">
                        <div class="item-50 fl">
                            <div class="extension-setting-title">
                                Vị trí
                            </div>
                            <div class="extension-setting-content">
                                <span active=".tlrb-content .bottom, .tlrb-content .left" class="position-item bottom_left active" par="bottom_left"></span>
                                <span active=".tlrb-content .bottom, .tlrb-content .right" class="position-item bottom_right" par="bottom_right"></span>
                                <span active=".tlrb-content .top, .tlrb-content .left" class="position-item top_left" par="top_left"></span>
                                <span active=".tlrb-content .top, .tlrb-content .right" class="position-item top_right" par="top_right"></span>
                                <span active=".tlrb-content .bottom" class="position-item bottom_center" par="bottom_center"></span>
                                <input type="hidden" name="hotline_position" class="input_position" value="bottom_left" />
                            </div>
                        </div>
                        <div class="item-50 fr">
                            <span class="tlrb-title">Cách lề</span>
                            <div class="tlrb-content none">
                                <span class="position-name top">Trên : <input name="top" type="text" value="<?php echo $attr['bottom'] ?>" /> (px)</span>
                                <span class="position-name bottom">Dưới : <input name="bottom"  type="text" value="<?php echo $attr['bottom'] ?>" /> (px)</span>
                                <span class="position-name left">Trái &nbsp; : <input  name="left" type="text" value="<?php echo $attr['bottom'] ?>" /> (px)</span>
                                <span class="position-name right">Phải : <input  name="right" type="text" value="<?php echo $attr['bottom'] ?>" /> (px)</span>
                                
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="extension-setting">
                        <div class="extension-setting-title">
                            Kiểu Hotline
                        </div>
                        <div class="extension-setting-content">
                            <span class="view-popup view-display_style-button" popup_name="list-display_style">Chọn</span>
                            <span class="display_style-name">( <?php echo $default_value['display_style'] ?> )</span>
                            <input type="hidden" name="display_style" class="input_display_style" value="<?php echo $default_value['display_style'] ?>" />
                            <div class="popup popup-list-display_style">
                                <span class="close-popup">x Đóng</span>
                                <h2>Chọn kiểu Hotline</h2>
                                <div class="clearfix flex-wrap">
                                <?php
                                    $t = PATH_ROOT . '/tpl/tpl/extensions/FixedHotline';
                                    
                                    $lists = scandir( $t );
                                    $exs = array('.', '..', 'readme.txt');
                                    $lists = array_diff($lists, $exs);
                                     
                                    foreach($lists as $list)
                                    {
                                        ?>
                                        <div class="display_style-item flex-item">
                                            <img class="<?php if($list == $attr['display_style'] ) echo ' active ' ?>"  par="<?php echo $list ?>" src="<?php echo CDN_DOMAIN . '/tpl/tpl/extensions/FixedHotline/' . $list ?>/preview.png" />
                                        </div>
                                        <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="extension-setting extension-setting-color">
                        <div class="extension-setting-title">
                            Màu sắc
                        </div>
                        <div class="extension-setting-content clearfix">
                            <div class=" extension-setting-color-item" >
                                Màu 1 : &nbsp; <input class="bgrins-spectrum text" name="color1" value="<?php echo $default_value['color1'] ?>" />
                            </div> 
                            <div class=" extension-setting-color-item" >
                                Màu 2 : &nbsp; <input class="bgrins-spectrum text" name="color2" value="<?php echo $default_value['color2'] ?>" />                             
                            </div>
                            <div class=" extension-setting-color-item" >
                                Màu 3 : &nbsp; <input class="bgrins-spectrum text" name="color3" value="<?php echo $default_value['color3'] ?>" />                             
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                <div class="extension-col extension-col2 extension-preview fl">
                    <div class="desktop-preview">
                        <div class="ex_domain">https://zland.vn</div>
                        <div class="desktop-preview-inner"></div>
                    </div>
                </div> 
                <div class="opacity"></div>
            </div>
            
            
            
            
            
            
            
             
            
            
             
            
            
            
</div>