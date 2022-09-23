<?php
$default = array(
    'title'     => '',
    'src'      => ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>

<form id="image_form_setting" class="block_form" block_id="0">
	<?php  display_block_setting_default($default);  ?>
	
	<div class="form-group">
        <label style="width: 100px;" class="" for="name">Link Video</label>
         
        <input style="width: 300px;" type="text" placeholder="src" class="parameter" id="select_image" parameter="src"  value="<?php echo $default['src'] ?>" />
		
		<input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="select_image" /><br /><br />
		
        <div style="margin-top: 30px;"  id="select_image_display" style="max-width: 100%;" >
            <?php 
                $videos = array('flv', 'mp4');
                $ex = pathinfo($temporary_setting_parameter['src']);
                 
                if(in_array( $ex['extension'], $videos))
                {
                    ?>
                    <video autoplay loop >
                      <source src="<?php echo $temporary_setting_parameter['src'] ?>" type="video/mp4" />
                      <source src="<?php echo $temporary_setting_parameter['src'] ?>" type="video/ogg" />
                        Your browser does not support the video tag.
                    </video>
                    <?php
                }
                else
                {
                    ?>
                    <img style="max-width: 100%;" src="<?php echo $temporary_setting_parameter['src'] ?>" />
                    <?php
                }
            ?>
            
        </div>
         
    </div>
	
</form>


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


