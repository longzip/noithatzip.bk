<div  stt_post="<?php echo $k + 1 ?>" stt="<?php echo $v_attachments['url']; ?>" attachment_id="<?php  ?>"  class="stt-<?php echo ($k + 1) % 4 ?> box relative<?php if(!empty($active_item)) echo ' active' ?>" style="">
    <?php
     if(empty($uploading))
    {
        $ex = pathinfo($v_attachments['url']);
        $ex = $ex['extension'];
    }
     
    $image_name = explode('/', $v_attachments['url']);
     
    $image_name = $image_name[count($image_name)-1];
     
    $real_v_attachments['url'] = $v_attachments['url'];
    $v_attachments_type = explode('.', $v_attachments['url']);
    $v_attachments_type = $v_attachments_type[count($v_attachments_type)-1];
    $v_attachments_type = strtolower($v_attachments_type);
    //echo $v_attachments_type;
    //if(!in_array($v_attachments_type, array('jpg', 'jpeg', 'png', 'x-png', 'gif'))) $v_attachments['url'] = 'media/attachment.png';
	
	$timthumb_src = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/' . $v_attachments['url'] . '&w=140&h=140';
	
    $ext = pathinfo($v_attachments['url'], PATHINFO_EXTENSION);
    switch( get_file_type($ext) )
    {
        case 'image' :
        {
            ?>
            <div real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo $timthumb_src ?>"  >
                <img real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo $timthumb_src ?>" /> 
            </div>
            <?php
            break;
        }
        case 'mp3' :
        {
            ?>
            <div real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo $timthumb_src ?>"  >
                <audio   controls>                               
                  <source src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" type="audio/mpeg" />
                  Trình duyệt của bạn không hỗ trợ định dạng này
                </audio>
            </div>
            
            <?php
            break;
        }
        case 'ogg' :
        {
            ?>
            <div real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo $timthumb_src ?>"  >
                <audio   controls>                               
                  <source src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" type="audio/ogg" />
                  Trình duyệt của bạn không hỗ trợ định dạng này
                </audio>
            </div>
            
            <?php
            break;
        }
        case 'mp4' :
        {
            ?>
            <div real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo $timthumb_src ?>"  >
                <video    controls>
                  <source src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" type="video/mp4" />
                  Trình duyệt của bạn không hỗ trợ định dạng này
                </video>
            </div>
            
            <?php
            break;
        }
        
        default :
        {
            ?>
            <div real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo $timthumb_src ?>"  >
                <img real_src="<?php echo SITE_URL, '/', $real_v_attachments['url']; ?>" class="active pointer" src="<?php echo timthumb_url(SITE_URL . '/media/images/' . $ex . '.png', 140, 140) ?>" />
            </div>
            <?php
            break;
        }
        
    }
    ?>
     
    <?php
    	if($g_user['permission'] == 'admin')
        {
            $att = get_attachment_by_url($real_v_attachments['url']);
             
            if(empty($att))
            {
                $att = array();
                $att['url'] = $real_v_attachments['url'];
                $att['tilte'] = basename($real_v_attachments['url']);
                $att['alt'] = basename($real_v_attachments['url']);
                $att['align'] = 'none';
                $att['description'] = '';
            }
            ?>
            <span class="absolute pointer handle setting_attribute glyphicon glyphicon-wrench setting_icon"></span>
            <span file_name="<?php echo $real_v_attachments['url'] ?>" file_name_2="<?php echo $real_v_attachments['url'] ?>" class="absolute pointer handle delete-in-dir glyphicon glyphicon-remove"></span>
            
             <form  action="" method="POST" class="attribute absolute">
                <a class="form-link" href="<?php echo SITE_URL . '/', $att['url'] ?>" target="_blank">Xem</a>
				<div class="setting-item">
                <label> Url : </label>
                    <input class="attribute_input form-control"  value="<?php echo SITE_URL . '/', $att['url'] ?>" /><br />
                </div>
			     <div class="setting-item">
                <label> Title : </label>
                <input class="attribute_input title form-control"  value="<?php echo $att['title'] ?>" /><br />
                </div>
			   
				<div class="clear"></div>
				
				<div class="setting-item">
                <label> Alt : </label>
                <input class="attribute_input alt form-control"  value="<?php echo $att['alt'] ?>" />
                <br />
				</div>
				
				<div class="clear"></div>
				
				<div class="setting-item">
                <label> Align : </label>
                <select class="form-control align">                    
                    <option <?php if($att['align'] == 'none') echo 'selected="selected"' ?>  value="none">None</option>
					<option <?php if($att['align'] == 'center') echo 'selected="selected"' ?> value="center">Center</option>
                    <option <?php if($att['align'] == 'left') echo 'selected="selected"' ?> value="left">Left</option>
                    <option <?php if($att['align'] == 'right') echo 'selected="selected"' ?> value="right">Right</option>
					
                </select>
				 <br />
				</div>
				
				<div class="setting-item">
				<label> Description : </label>
                <textarea class="attribute_input description form-control" ><?php echo $att['description'] ?></textarea>
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
    <!--<div class="file-type <?php echo $ex ?>"></div>-->
    <p class="none image-name absolute"><?php echo $image_name; ?></p>
    
</div>