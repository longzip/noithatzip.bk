<?php
$default = array(
    'title'     => '',
    'content'   => '',
    'title_link'=> ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
<form id="text_form_setting" class="block_form" block_id="0">
   <?php  display_block_setting_default($default);  ?>
    
    <div class="form-group" style="padding: 10px;">
        <label class="block" style="float: none;margin-bottom:10px;" for="name">Nội dung</label>
        
        <textarea class="form-control parameter" parameter="content"><?php echo $default['content'] ?></textarea>
    </div>
</form>
	
