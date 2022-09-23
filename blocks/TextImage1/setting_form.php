<?php
$default = array(
    'title'         => '',
    'src'           => '',
    'title2'        => '',
    'link'          => '',
    'category'      => '',
    'image_width'   => '370',
    'image_height'  => '350'
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<form id="image_form_setting" class="block_form" block_id="0">
	<?php  display_block_setting_default($default);  ?>
	
    <div class="form-group clearfix">
        <label class="" for="name">Tiêu đề bài viết</label> 
        <div class="parameter-col-title">
            <input placeholder="" class="text form-control parameter " parameter="title2" value="<?php echo $default['title2'] ?>" />
        </div>
    </div>
    
    <div class="form-group clearfix">
        <label class="" for="name">Liên kết</label> 
        <div class="parameter-col-title">
            <input placeholder="" class="text form-control parameter " parameter="link" value="<?php echo $default['link'] ?>" />
        </div>
    </div>
    
    <div class="form-group">
        <label class="" for="name">Chuyên mục</label>
        <br />
        <?php display_categories_option('', $default['category'], 'class="form-control parameter" parameter="category"') ?>
    
    </div>
    
    <span class="clear"></span>
    
	<div class="form-group">
        <label class="" for="name" style="width: 20%;">Link ảnh</label>
         
        <input type="text" placeholder="src" class="parameter fl" id="select_image" parameter="src"  value="<?php echo $default['src'] ?>" />
		
		<input type="button" value="Chọn ảnh" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />
		<span class="clear"></span><br />
        <div id="select_image_display" style="max-width: 90%;margin:auto" >
            <img style="max-width: 90%;display:block;margin:auto" src="<?php echo $default['src'] ?>" />
        </div>
         
    </div>
    
    <div class="form-group clearfix">
        <label class="" for="name">Chiều rộng ảnh</label> 
        <div class="parameter-col-title">
            <input placeholder="" class="text form-control parameter " parameter="image_width" value="<?php echo $default['image_width'] ?>" />
        </div>
    </div>
    
    <div class="form-group clearfix">
        <label class="" for="name">Chiều cao ảnh</label> 
        <div class="parameter-col-title">
            <input placeholder="" class="text form-control parameter " parameter="image_height" value="<?php echo $default['image_height'] ?>" />
        </div>
    </div>
	
</form>

