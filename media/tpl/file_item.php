<div stt="<?php echo $v_attachments['url']; ?>" attachment_id="<?php  ?>"  class="box relative<?php if(!empty($active_item)) echo ' active' ?>" style="">
    <?php 
         
         
         $image_name = explode('/', $v_attachments['url']);
         
         $image_name = $image_name[count($image_name)-1];
         
    
        $real_v_attachments['url'] = $v_attachments['url'];
        $v_attachments_type = explode('.', $v_attachments['url']);
        $v_attachments_type = $v_attachments_type[count($v_attachments_type)-1];
        $v_attachments_type = strtolower($v_attachments_type);
        //echo $v_attachments_type;
        if(!in_array($v_attachments_type, array('jpg', 'jpeg', 'png', 'x-png', 'gif'))) $v_attachments['url'] = 'media/attachment.png';
		
		$timthumb_src = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/' . $v_attachments['url'] . '&w=140&h=140';
		//$timthumb_src = SITE_URL . '/' . $v_attachments['url'];
	?>
    <img real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo $timthumb_src ?>" /><br />
    
    <?php
    	if($g_user['permission'] == 'admin')
        { 
            ?>
            <span class="absolute pointer handle setting_attribute glyphicon glyphicon-wrench setting_icon"></span>
            <span class="absolute pointer handle delete glyphicon glyphicon-remove"></span>
            <form  action="" method="POST" class="attribute absolute">
				
				 <div class="setting-item">
                <label> Title : </label>
                <input class="attribute_input title form-control"  value="<?php echo $v_attachments['title'] ?>" /><br />
                </div>
			   
				<div class="clear"></div>
				
				<div class="setting-item">
                <label> Alt : </label>
                <input class="attribute_input alt form-control"  value="<?php echo $v_attachments['alt'] ?>" />
                <br />
				</div>
				
				<div class="clear"></div>
				
				<div class="setting-item">
                <label> Align : </label>
                <select class="form-control align">                    
                    <option <?php if($v_attachments['align'] == 'none') echo 'selected="selected"' ?>  value="none">None</option>
					<option <?php if($v_attachments['align'] == 'center') echo 'selected="selected"' ?> value="center">Center</option>
                    <option <?php if($v_attachments['align'] == 'left') echo 'selected="selected"' ?> value="left">Left</option>
                    <option <?php if($v_attachments['align'] == 'right') echo 'selected="selected"' ?> value="right">Right</option>
					
                </select>
				
				<label style="display:inline-block"> URL : </label>
                <input style="width:120px;" value="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" />
				 <br />
				</div>
				
				<div class="setting-item">
				<label> Description : </label>
                <textarea class="attribute_input description form-control" ><?php echo $v_attachments['description'] ?></textarea>
                <br />
                </div>
				<div class="clear"></div>
				
                <input type="submit" class="btn btn-primary fl action save-attribute submit" value="Save" />
                <span class="noti relative bold"></span>
                <input type="button" class="btn btn-default fr action close_attribute_form" value="Close" />
            </form>
            <?php
        }
    ?>
    
    <p class="image-name absolute"><?php echo $image_name; ?></p>
    
</div>