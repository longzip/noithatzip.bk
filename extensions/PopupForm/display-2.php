<?php 
if(defined('ADMIN_PAGE') && (ADMIN_PAGE)) 
{
    $form_param = array('id'=>$default_value['form_id'], 'form_element_name'=>'div');
    $time_to_display = 0;
}
else
{
    $form_param = array('id'=>$default_value['form_id']);
    $time_to_display = 1000 * ($attr['time_delay_minute'] * 60 + $attr['time_delay_second']);    
}  
?>
<div class="v-form-fixed v-form-fixed-2 ">
    <div class="v-form-fixed-opacity" style="position: fixed; background: #000; opacity: 0.7; width: 100%; height: 100%; left: 0; top: 0; z-index: 99;"></div>
    <div class="v-form-fixed-2-wrap">
        <?php display_form($form_param) ?>
        <div class=" v-close-form-fixed v-close-form-fixed-2">×</div>
    </div>        
</div>

     <?php
     
     if(!defined('TEMP_POPUP_FORM_STYLE_2'))
     {
        define('TEMP_POPUP_FORM_STYLE_2', '1');
        ?>
         
        <script>
            $("document").ready(function(){
                
                
                setTimeout(function(){
                    <?php 
                    if(!isset($_COOKIE['popup_form']))
                    {
                        ?>
                        $(".v-form-fixed-2").addClass("active"); 
                        <?php
                    }
                ?>  
                                            
                }, <?php echo $time_to_display ?>);
                    
                $(".v-close-form-fixed-2").click(function(){
                      $(".v-form-fixed-2").removeClass("active");
                });
                
                $("body").on("click", ".v-toggle-form-fixed-2, .v-toggle-form-fixed", function(){
                     
                    $(".v-form-fixed-2").toggleClass("active");
                });
                
                $(".v-show-form-fixed").click(function(){
                    $(".v-form-fixed").addClass("active");
                    $(".v-open-form-fixed").removeClass("active");
                    set_fixed_form_max_width();
                });
                
                
            });
        </script>
        <?php
     }
     ?>
         
    
    