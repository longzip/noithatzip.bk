<?php 
$fixed_hotline = get_option('fixed-hotline');
if(empty($fixed_hotline)) $fixed_hotline = '0422.132.888';

$fixed_hotline_text_title = get_option('hotline-fixed-text-title');
if(empty($fixed_hotline_text_title)) $fixed_hotline_text_title = 'Hotline';
?>
 

<div class="hotline-fixed hotline-fixed-4">
	<div class="hotline-fixed-4-text clearfix">
        <div class="hotline-fixed-4-text-title">
            <?php echo $fixed_hotline_text_title;display_edit_option_icon('hotline-fixed-text-title')  ?>
        </div>
        <div class="hotline-fixed-4-text-hotline">
            <a <?php if(1) : ?> href="tel:<?php echo price_to_num($fixed_hotline) ?>" <?php endif; ?> ><?php echo $fixed_hotline;display_edit_option_icon('fixed-hotline', 'text') ?></a>
        </div>
    </div>
</div>  