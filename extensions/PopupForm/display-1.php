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
 
<div class="v-form-fixed-1 v-form-fixed <?php //if(!isset($_COOKIE['popup_form'])) echo ' active1 ' ?>  "> 
    <?php display_form($form_param) ?>
    <div class="before v-close-form-fixed">+</div>
</div>

<div class="v-open-form-fixed-1 <?php if(isset($_COOKIE['popup_form'])) echo ' active ' ?>">
    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
</div>

<script>
    $(document).ready(function(){
        $(".v-close-form-fixed").click(function(){
            $(".v-form-fixed-1").removeClass("active");
            $(".v-open-form-fixed-1, v-open-form-fixed").addClass("active");
        });
        setTimeout(function(){
            <?php 
                if(!isset($_COOKIE['popup_form']))
                {
                    ?>
                    $(".v-form-fixed-1").addClass("active");
                    $(".v-open-form-fixed-1").removeClass("active");
                    <?php
                }
            ?>  
             
        },<?php echo $time_to_display ?>)
        $(".v-open-form-fixed-1,.v-open-form-fixed").click(function(){
            $(".v-form-fixed-1").addClass("active");
            $(".v-open-form-fixed-1").removeClass("active");
        });
        
        $(".v-toggle-form-fixed-1, .v-toggle-form-fixed").click(function(){
             
              $(".v-form-fixed-1").toggleClass("active");
        });
        
    });
</script>