<?php
	//$temporary_setting_parameter,, $current_block_id
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
    
    <style>
    .block-content .fb_iframe_widget,.block-content .fb_iframe_widget span, .block-content .fb_iframe_widget span iframe[style] {
    width: 100% !important;
}
    </style>
    
    <div class="block-content">
        <div style="" class="fb-like-box" data-width="<?php echo $temporary_setting_parameter['width'] ?>" data-height="<?php echo $temporary_setting_parameter['height'] ?>" data-href="<?php echo $temporary_setting_parameter['link'] ?>" data-colorscheme="<?php echo $temporary_setting_parameter['colorscheme'] ?>" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
    </div>
      