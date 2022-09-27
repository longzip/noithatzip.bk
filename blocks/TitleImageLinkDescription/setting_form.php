<?php
$default = array(
    'title'         => '',
    'content'       => '',
    'title_link'    => '',
    'box_title'          => '',
    'box_link'          => '',
    'box_description'          => '',
    'box_image'          => '',
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
<form id="text_form_setting" class="block_form" block_id="0">
   <?php  display_block_setting_default($default);  ?>
    <div class="form-group clearfix">
        <label class="" for="name">Tiêu đề</label>         
        <input class="form-control parameter" parameter="box_title" type="text" value="<?php echo $default['box_title'] ?>" />
    </div>
   	<div class="form-group">
        <label class="" for="name" style="width: 20%;">Link ảnh</label>         
        <input type="text" placeholder="box_image" class="parameter fl" id="select_image" parameter="box_image"  value="<?php echo $default['box_image'] ?>" />
		
		<input type="button" value="Chọn ảnh" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />
		<span class="clear"></span><br />
        <div id="select_image_display" style="max-width: 90%;margin:auto" >
            <img style="max-width: 90%;display:block;margin:auto" src="<?php echo $default['box_image'] ?>" />
        </div>         
    </div>
    
    <div class="form-group clearfix">
        <label class="" for="name">Liên kết</label>         
        <input class="form-control parameter" parameter="box_link" type="text" value="<?php echo $default['box_link'] ?>" />
    </div>
    
    <div class="form-group">
        <label class="block" style="float: none;margin-bottom:10px;" for="name">Nội dung</label>        
        <textarea class="form-control parameter" parameter="box_description"><?php echo $default['box_description'] ?></textarea>
    </div>
</form>
	
