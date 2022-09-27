<?php
$default = array(
    'title'     => '',
    'src'      => '',
    'title_link'        => '',
    'block_sub_title'   => ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<form id="image_form_setting" class="block_form" block_id="0">
	<?php  display_block_setting_default($default);  ?>
	
	<div class="form-group">
        <label class="" for="name" style="width: 20%;">Link ảnh</label>
         
        <input type="text" placeholder="src" class="parameter fl" id="select_image" parameter="src"  value="<?php echo $default['src'] ?>" />
		
		<input type="button" value="Chọn ảnh" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />
		<span class="clear"></span><br />
        <div id="select_image_display" style="max-width: 90%;margin:auto" >
            <img style="max-width: 90%;display:block;margin:auto" src="<?php echo $default['src'] ?>" />
        </div>
         
    </div>
	
</form>

