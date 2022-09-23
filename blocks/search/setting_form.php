<?php
$default = array(
    'title'     => '',
    'title_link'     => '',
    'link'   => '',
    'width' => 200,
    'height'    => 400,
    'colorscheme'   => 'light'
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
<form id="text_form_setting" class="block_form" block_id="0">
    
    <?php  display_block_setting_default($default);  ?>
     
</form>
	
