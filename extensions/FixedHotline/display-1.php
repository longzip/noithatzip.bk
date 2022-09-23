<?php 
$fixed_hotline = get_option('fixed-hotline');
if(empty($fixed_hotline)) $fixed_hotline = '0422.132.888';
?>

<div class="hotline-fixed hotline-fixed-1 ">
	<img class="animate-flicker " src="<?php echo CDN_DOMAIN ?>/images/hotline1.png" />
	<a <?php if(1) : ?> href="tel:<?php echo price_to_num($fixed_hotline) ?>" <?php endif; ?> ><?php echo $fixed_hotline;display_edit_option_icon('fixed-hotline', 'text') ?></a>
</div>