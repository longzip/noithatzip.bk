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
 
<div class="v-form-fixed-3   v-form-fixed   "> 
    <?php display_form($form_param) ?>
    <div class="before v-close-form-fixed">+</div>
</div>

<div class="v-open-form-fixed-3">
    <i class="fa fa-envelope" aria-hidden="true"></i>
    <i style="display: none;" class="none fa fa-angle-double-right" aria-hidden="true"></i>
</div>

<script>
    $(document).ready(function(){
        
        function set_fixed_form_max_width()
        {
            var fixed_form_w = $(".v-form-fixed-3").outerWidth();
            if(screen.width <= fixed_form_w )
            {
                $(".v-form-fixed-3").addClass("over-screen");
            }
        }
        
        set_fixed_form_max_width();
        
        $(".v-close-form-fixed").click(function(){
            $(".v-form-fixed-3").removeClass("active");
            $(".v-open-form-fixed-3").addClass("active");
        });
        
        <?php
        if( !isset($_COOKIE['popup_form']) )
        {
            ?>
            setTimeout(function(){
                 $(".v-form-fixed-3").addClass("active");
                 set_fixed_form_max_width();
            },<?php echo $time_to_display ?>);
            <?php
        }
        else
        {
            ?>
            $(".v-open-form-fixed-3").addClass("active");
            <?php 
        }
        ?>
        
        
        
        $(".v-open-form-fixed-3, .v-show-form-fixed, .v-open-form-fixed").click(function(){
            
            $(".v-form-fixed-3").addClass("active");
            $(".v-open-form-fixed-3").removeClass("active");
            set_fixed_form_max_width();
        });
        
        $(".v-toggle-form-fixed").click(function(){
            
            $(".v-form-fixed-3").toggleClass("active");
            $(".v-open-form-fixed-3").toggleClass("active");
            set_fixed_form_max_width();
        });
        
        
        
        var fixed_form_3_item = $(".v-form-fixed-3 .v-form-item").size();
         
         
        switch(fixed_form_3_item)
        {
            case 2 :
            {
                $(".v-form-fixed-3 .v-form-item").addClass("v-col-6 fl border-box");
                break;
            }
            case 3 :
            {
                $(".v-form-fixed-3 .v-form-item").addClass("v-col-4 fl border-box");
                break;
            }
            case 4 :
            {
                $(".v-form-fixed-3 .v-form-item").addClass("v-col-6 fl border-box");
                break;
            }
        }
        
        
    });
</script>