<?php tinymce_setting() ?>

<link rel="stylesheet" type="text/css" href="<?php echo CDN_TEMPLATE_URL ?>/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/vos-responsive.css" media="all" />

<?php
$default = array(
    'title'             => '',
    'content'           => '',
    'title_link'        => '',
    'bg_color'          => '',
    'bg_image'          => '',
    'left_title'        => '',
    'left_content'      => '',
    'right_title'       => '',
    'right_content'     => '',
    'left_div_right'    => '1'
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;

switch($default['left_div_right'])
{
    case '1' :
    {
        $left_class = ' v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-12 ';
        $right_class = ' v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-12 ';
        break;
    }
    case '1/2' :
    {
        $left_class = ' v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-6 v-col-tx-12 ';
        $right_class = ' v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-6 v-col-tx-12 ';
        break;
    }
    case '2' :
    {
        $left_class = ' v-col-lg-8 v-col-md-8 v-col-sm-8 v-col-xs-6 v-col-tx-12 ';
        $right_class = ' v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-6 v-col-tx-12 ';
        break;
    }
    case '1/3' :
    {
        $left_class = ' v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12 ';
        $right_class = ' v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-6 v-col-tx-12 ';
        break;
    }
    case '3' :
    {
        $left_class = ' v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-6 v-col-tx-12 ';
        $right_class = ' v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12 ';
        break;
    }
}

?>
<style>
.form-group {
    margin: 10px 0 35px 10px;
}

input {
    padding: 3px 5px;
    width: 500px;
    border: 1px solid silver;
}

select {
    padding: 3px 5px;
    border: 1px solid silver;
    width: 400px;
}

input[type="button"]{
    width:100px;
    background: #46b8da;
    border:0;
    padding: 8px 0;
    color:#fff;
    cursor:pointer;
    border-radius: 3px;
    position: relative;
    left: 20px;
}

input[type="button"]:hover {
    background: rgb(41, 152, 185);
}
</style>
<form id="text_form_setting" class="block_form" block_id="0">
    <?php  display_block_setting_default($default);  ?>
    <span class="clear"></span>
    
    <div class="form-group clearfix">
        <label style="width: 100px;"  class="" for="name">Ảnh nền</label>
          
        <input type="text" style="width: 50%;padding:6px 10px" placeholder="Để trống nếu không muốn chọn ảnh nền" class="parameter" id="bg_image" parameter="bg_image"  value="<?php echo $default['bg_image'] ?>" />
		
		<input style="width: 100px;"  type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="bg_image" /><br /><br />
		
        <div id="bg_image_display none" style="max-width: 100%;" >
            <img style="max-width: 100%;" src="<?php echo $default['bg_image'] ?>" />
        </div>
         
    </div>
    
    <div class="wrap-col  border-box fl <?php echo $left_class ?>">
        <label class="" for="name">Màu nền</label>
        <br />
        <div class="parameter-col-title">
            <input placeholder="Điền mã màu vào đây. Để trống nếu không muốn chọn màu nền" class="text form-control parameter " parameter="bg_color" value="<?php echo $default['bg_color'] ?>" />
        </div>
        
    </div>
    
    
     <div class="wrap-col  border-box fl <?php echo $left_class ?>">
        <label class="" for="name">Tỉ lệ <strong>Cột trái / cột phải :</strong></label>
        <br />
        <div class="parameter-col-title">
            <select class="text form-control parameter " parameter="left_div_right" >
                <option value="1/3" <?php if($default['left_div_right'] == '1/3') echo ' selected ' ?> >1/3</option>
                <option value="1/2" <?php if($default['left_div_right'] == '1/2') echo ' selected ' ?> >1/2</option>
                <option value="1" <?php if($default['left_div_right'] == '1') echo ' selected ' ?> >1</option>
                <option value="2" <?php if($default['left_div_right'] == '2') echo ' selected ' ?> >2</option>
                <option value="3" <?php if($default['left_div_right'] == '3') echo ' selected ' ?> >3</option>
                
            </select>
            
        </div>
        
    </div>
    
    <span class="clear"></span>
    <div class="wrap-col  border-box fl <?php echo $left_class ?>">
        <div class="parameter-col-title">
            <input placeholder="Tiêu đề" class="text form-control parameter " parameter="left_title" value="<?php echo $default['left_title'] ?>" />
        </div>
        <textarea placeholder="Nội dung" class="main-content form-control parameter" parameter="left_content"><?php echo $default['left_content'] ?></textarea>
    </div>
    
    <div class="wrap-col border-box fl <?php echo $right_class ?>">
        <div class="parameter-col-title">
            <input placeholder="Tiêu đề" class="text form-control parameter" parameter="right_title" value="<?php echo $default['right_title'] ?>" />
        </div>
        <textarea placeholder="Nội dung" class="main-content form-control parameter" parameter="right_content"><?php echo $default['right_content'] ?></textarea>
    </div>
    
    <span class="clear"></span>
    
    
</form>
	
