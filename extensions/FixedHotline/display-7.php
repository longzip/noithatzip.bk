<?php 
$fixed_hotline = get_option('fixed-hotline');
if(empty($fixed_hotline)) $fixed_hotline = '0422.132.888';

$fixed_hotline_text_title = get_option('hotline-fixed-text-title');
if(empty($fixed_hotline_text_title)) $fixed_hotline_text_title = 'Hotline';
?>



<div class="hotline-fixed-7 quick-alo-phone quick-alo-green quick-alo-show" id="quick-alo-phoneIcon"   >
  <a href="tel:<?php echo price_to_num($fixed_hotline) ?>" title="<?php echo $fixed_hotline ?>">
      <div class="quick-alo-ph-circle"></div>
      <div class="quick-alo-ph-circle-fill"></div>
      <div class="quick-alo-ph-img-circle"></div>
  </a>
  <a  class="hotline-fixed-7-text" href="tel:<?php echo price_to_num($fixed_hotline) ?>"  >
      <span><?php echo $fixed_hotline;display_edit_option_icon('fixed-hotline', 'text') ?></span>
  </a>
   
</div>

<link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/extensions/FixedHotline/css/style-7.css" />


<style>

 <?php 
     
 
    switch($default_value['hotline_position'])
    {
        case 'bottom_left' :
        {
            ?>
            .hotline-fixed-7 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .hotline-fixed-7 {
                top:<?php echo $default_value['top'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'bottom_right' :
        {
            ?>
            .hotline-fixed-7 {
                bottom:<?php echo $default_value['bottom'] ?>px;
                right:<?php echo $default_value['right'] ?>px;
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .hotline-fixed-7 {
                top:<?php echo $default_value['top'] ?>px;
                left:<?php echo $default_value['left'] ?>px;
            }
            <?php
            break;
        }
    }
?>
</style>