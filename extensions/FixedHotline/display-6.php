<?php
$fixed_hotline = get_option('fixed-hotline');
if(empty($fixed_hotline)) $fixed_hotline = '0422.132.888';

$fixed_hotline_text_title = get_option('hotline-fixed-text-title');
if(empty($fixed_hotline_text_title)) $fixed_hotline_text_title = 'Hotline';

 die();
?>
<script>
$("document").ready(function(){
     $(".hotline-fixed-6-icon i").click(function(){
        $(".hotline-fixed-6").toggleClass("active");
    });
  ;
})


</script>

<div class="hotline-fixed hotline-fixed-6">
    <a href="tel:<?php echo price_to_num($fixed_hotline) ?>" mypage="" class="call-now" rel="nofollow">
        <div class="mypage-alo-phone">
            <div class="animated infinite zoomIn mypage-alo-ph-circle go"></div>
            <div class="animated infinite pulse mypage-alo-ph-circle-fill go"></div>
            <div class="animated infinite tada mypage-alo-ph-img-circle go"></div>
        </div>
    </a>
	<div class="hotline-fixed-6-text">
        <div class="hotline-fixed-6-text-title">
            <?php echo $fixed_hotline_text_title;display_edit_option_icon('hotline-fixed-text-title')  ?>
        </div>
        <div class="hotline-fixed-6-text-hotline">
            <a <?php if(1) : ?> href="tel:<?php echo price_to_num($fixed_hotline) ?>" <?php endif; ?> ><?php echo $fixed_hotline;display_edit_option_icon('fixed-hotline', 'text') ?></a>
        </div>
    </div>

</div>
