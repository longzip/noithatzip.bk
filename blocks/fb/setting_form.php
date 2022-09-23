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
    
    <div class="form-group clearfix">
        <label class="" for="name">Liên kết Facebook Fanpage</label>
         
        <input class="form-control parameter" parameter="link" type="text" value="<?php echo $default['link'] ?>" />
    </div>
    
    <div class="form-group clearfix">
        <label class="" for="name">Chiều rộng</label>
        <input class="form-control parameter" parameter="width" type="text" value="<?php echo $default['width'] ?>" />
    </div>
    
    <div class="form-group clearfix">
        <label class="" for="name">Chiều Cao</label>
        <input class="form-control parameter" parameter="height" type="text" value="<?php echo $default['height'] ?>" />
    </div>
    
    <div class="form-group clearfix">
        <label class="" for="name">Giao diện</label>
        <select class="form-control parameter" parameter="colorscheme">
            <option value="light" <?php if($default['colorscheme'] == 'light') echo ' selected ' ?> >Sáng</option>
            <option value="dark" <?php if($default['colorscheme'] == 'dark') echo ' selected ' ?> >Tối</option>
        </select>
         
    </div>
    
</form>
	
