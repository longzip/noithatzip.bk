<?php
$default = array(
    'title'         => '',
    'title_link'    => '',
    'name'          => '',
    'image'         => '',
    'sdt'           => '',
    'email'         => '',
    'skype'         => '',
    'zalo'          => '',
    'viber'         => ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
<form id="text_form_setting" class="block_form" block_id="0">
   <?php  display_block_setting_default($default);  ?>
    
    <div class="form-group clearfix" >
        <label class="" for="name">Họ tên</label>
        <input class="form-control parameter block text"   parameter="name" type="text" value="<?php echo $default['name'] ?>" />
    </div>
    <div class="form-group">
        <label class="" for="name" style="">Avatar</label>
         
        <input type="text" placeholder="" class="parameter fl" id="select_image" parameter="image"  value="<?php echo $default['image'] ?>" />
		
		<input type="button" value="Chọn ảnh" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />
		<span class="clear"></span><br />
        <div id="select_image_display" style="max-width: 90%;margin:auto" >
            <img style="max-width: 90%;display:block;margin:auto" src="<?php echo $default['image'] ?>" />
        </div>
         
    </div>
    <div class="form-group clearfix" >
        <label class="" for="name">Số ĐT</label>
        <input class="form-control parameter block text"   parameter="sdt" type="text" value="<?php echo $default['sdt'] ?>" />
    </div>
    
    <div class="form-group clearfix" >
        <label class="" for="name">Email</label>
        <input class="form-control parameter block text"   parameter="email" type="text" value="<?php echo $default['email'] ?>" />
    </div>
    
    <div class="form-group clearfix" >
        <label class="" for="name">Skype</label>
        <input class="form-control parameter block text"   parameter="skype" type="text" value="<?php echo $default['skype'] ?>" />
    </div>
    
    <div class="form-group clearfix" >
        <label class="" for="name">Zalo</label>
        <input class="form-control parameter block text"   parameter="zalo" type="text" value="<?php echo $default['zalo'] ?>" />
    </div>
    
    <div class="form-group clearfix" >
        <label class="" for="name">Viber</label>
        <input class="form-control parameter block text"   parameter="viber" type="text" value="<?php echo $default['viber'] ?>" />
    </div>

     
</form>
	
