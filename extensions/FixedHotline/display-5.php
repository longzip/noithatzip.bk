<?php 
$fixed_hotline = get_option('fixed-hotline');
if(empty($fixed_hotline)) $fixed_hotline = '0422.132.888';

$fixed_hotline_text_title = get_option('hotline-fixed-text-title');
if(empty($fixed_hotline_text_title)) $fixed_hotline_text_title = 'Hotline';
?>

<?php 
if(wp_is_mobile())
{
    ?>
    <div class="">
        <div class="site-support  hotline-fixed hotline-fixed-5-mobile">
           <div class="site-content">           
              <a href="tel:<?php echo price_to_num($fixed_hotline) ?>">
                 <div class="item toogle-support-item"> <i class="fa fa-phone" aria-hidden="true"></i> <span>Hotline: <strong><?php echo $fixed_hotline;display_edit_option_icon('fixed-hotline', 'text') ?></strong></span></div>
              </a>
               
              <div class="contact-fill"></div>
              <a href="tel:<?php echo price_to_num($fixed_hotline) ?>">
                 <div class="item hidden-pc"> <i class="fa fa-phone" aria-hidden="true"></i></div>
              </a>
           </div>
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="hotline-fixed hotline-fixed-5">
    	<img class="animate-flicker " src="<?php echo CDN_DOMAIN ?>/images/hotline1.png" />
    	<a <?php if(1) : ?> href="tel:<?php echo price_to_num($fixed_hotline) ?>" <?php endif; ?> ><?php echo $fixed_hotline;display_edit_option_icon('fixed-hotline', 'text') ?></a>
    </div>
    <?php
}
?> 
 