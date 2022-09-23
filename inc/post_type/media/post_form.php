<div class="new-thread-item box">
    <div class="field-title">
        <label class="block label" style="width:300px"><?php echo $temp_post_type['title'] ?></label><br />
	</div>
    
    <div class="field-content">
        <div class="field fl">
    		<div class="form-box image" id="form-<?php echo $temp_post_type['name'] ?>">
    			<div class="form-field">
    				<input style="width: 70%;" class="form-control" id="<?php echo $temp_post_type['name'] ?>"  value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?>" type="hidden" name="<?php echo $temp_post_type['name'] ?>" />&nbsp;&nbsp;
    				<input type="button" value="Chọn" class="show-media-frame btn btn-info" particular="<?php echo $temp_post_type['name'] ?>" /><br /><br />
    				
    			</div>
                
                <div id="<?php echo $temp_post_type['name'] ?>_display" style="max-width: 100%;" >
                    <?php 
                    
                    $ext = pathinfo($default_value[$temp_post_type['name']], PATHINFO_EXTENSION);
                    switch( get_file_type($ext) )
                    {
                        case 'image' :
                        {
                            ?>
                            <img style="max-width: 100%;" src="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?>" />
                            <?php
                            break;
                        }
                        case 'mp3' :
                        {
                            ?>
                            <audio controls>                               
                              <source src="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?>" type="audio/mpeg" />
                              Trình duyệt của bạn không hỗ trợ định dạng này
                            </audio>
                            <?php
                            break;
                        }
                        case 'ogg' :
                        {
                            ?>
                            <audio controls>                               
                              <source src="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?>" type="audio/ogg" />
                              Trình duyệt của bạn không hỗ trợ định dạng này
                            </audio>
                            <?php
                            break;
                        }
                        case 'mp4' :
                        {
                            ?>
                            <video controls>
                              <source src="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?>" type="video/mp4" />
                              Trình duyệt của bạn không hỗ trợ định dạng này
                            </video>
                            <?php
                            break;
                        }                       
                        
                    }
                    
                    ?>
                </div>
    			
    		  
    		</div>
    		
    	</div>
    	
    	<span class="clear"></span>
    </div>
    <?php
    if(!empty($temp_post_type['description']))
    {
        ?>
        <div class="form-description">
            <span class="arrow"></span>

            <?php echo $temp_post_type['description'] ?>
        </div>
        <?php
    }
    ?>
     
</div>
<span class="clear"></span>


 