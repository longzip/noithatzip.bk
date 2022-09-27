<?php
    if(!empty($v['attributes'])) $attributes = json_decode($v['attributes'], TRUE);
    else $attributes = array('title'=>'Untitle', 'name'=>'', 'type'=>'text', 'maxlenght'=>'-1');
?>
<div class="option-item option-item-<?php echo $v['name'] ?>">
    
    <div class="option-content">
        <label for="<?php echo $k ?>" class="fl"><?php echo $attributes['title'] ?></label>
        <div class="field fl">
            <?php 
                switch($attributes['type'])
                {
                    case 'text' :
                    {
                        ?>
                        <input type="text" name="<?php echo $v['name'] ?>" id="<?php echo $v['name'] ?>" value="<?php echo  htmlentities($v['value'])// return_value($v['name'], htmlentities($v['value']), FALSE, FALSE) ?>" />
                        <?php
                    }
                    break;
                    
                    case 'password' :
                    {
                        ?>
                        <input type="text" name="<?php echo $v['name'] ?>" id="<?php echo $v['name'] ?>" value="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" />
                        <?php
                    }
                    break;
                    
                    case 'textarea' :
                    {
                        ?>
                        <textarea name="<?php echo $v['name'] ?>" id="<?php echo $v['name'] ?>"><?php return_value($v['name'], $v['value'], FALSE, FALSE) ?></textarea>
                        <?php
                    }
                    break;
                    
                    case 'html' :
                    {
                        ?>
                        <textarea class="main-content" name="<?php echo $v['name'] ?>" id="<?php echo $v['name'] ?>"><?php return_value($v['name'], $v['value'], FALSE, FALSE) ?></textarea>
                        <?php
                    }
                    break;
                    
                    case 'number' :
                    {
                        ?>
                        <input type="number" name="<?php echo $v['name'] ?>" id="<?php echo $v['name'] ?>" value="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" />
                        <?php
                    }
                    break;
                    
                    case 'image' :
                    {
                        ?>
                         
                			<div class="form-field">
                				<input style="width: 70%;" class="form-control" id="<?php echo $v['name'] ?>"  value="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" type="hidden" name="<?php echo $v['name'] ?>" />&nbsp;&nbsp;
                				<input type="button" value="Chọn" class="show-media-frame btn btn-info" particular="<?php echo $v['name'] ?>" /><br /><br />
                				
                			</div>
                            
                            <div id="<?php echo $v['name'] ?>_display" style="max-width: 100%;" >
                                <?php 
                                
                                $ext = pathinfo($v['value'], PATHINFO_EXTENSION);
                                switch( get_file_type($ext) )
                                {
                                    case 'image' :
                                    {
                                        ?>
                                        <img style="max-width: 100%;" src="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" />
                                        <?php
                                        break;
                                    }
                                    case 'mp3' :
                                    {
                                        ?>
                                        <audio controls>                               
                                          <source src="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" type="audio/mpeg" />
                                          Trình duyệt của bạn không hỗ trợ định dạng này
                                        </audio>
                                        <?php
                                        break;
                                    }
                                    case 'ogg' :
                                    {
                                        ?>
                                        <audio controls>                               
                                          <source src="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" type="audio/ogg" />
                                          Trình duyệt của bạn không hỗ trợ định dạng này
                                        </audio>
                                        <?php
                                        break;
                                    }
                                    case 'mp4' :
                                    {
                                        ?>
                                        <video controls>
                                          <source src="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" type="video/mp4" />
                                          Trình duyệt của bạn không hỗ trợ định dạng này
                                        </video>
                                        <?php
                                        break;
                                    }    
                                    default :
                                    {
                                        ?>
                                        <img style="max-width: 100%;" src="<?php return_value($v['name'], $v['value'], FALSE, FALSE) ?>" />
                                        <?php
                                        break;
                                    }                   
                                    
                                }
                                
                                ?>
                            </div>
                			 
        <?php
                    }
                    break;
                    
                    case 'template' :
                    { 
                        $a = scandir(PATH_ROOT . '/tpl');
                        $b = array('index.php', '.', '..');
                        
                        $a = array_diff($a, $b);
                            
                        ?>
                        
                        <select name="<?php echo $v['name'] ?>">
                             <?php 
                                 
                                foreach($a as $temp_v)
                                {
                                    $temp_v = str_replace('.php', '', $temp_v)
                                    ?>
                                    <option <?php if($v['value'] == $temp_v) echo 'selected ' ?> value="<?php echo $temp_v ?>"><?php echo $temp_v ?></option>
                                    <?php
                                } 
                             ?>
                        </select>
                        <?php
                    }
                    break; 
                    
                    case 'home-template' :
                    { 
                        echo TEMPLATE_PATH;
                        if(file_exists( TEMPLATE_PATH  . '/index.php')  ) $a = scandir(PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/home');
                        else $a = scandir(PATH_ROOT . '/tpl/' . TEMPLATE . '/home');
                        $b = array('index.php', '.', '..');
                        
                        $a = array_diff($a, $b);
                            
                        ?>
                        
                        <select name="<?php echo $v['name'] ?>">
                             <?php 
                                 
                                foreach($a as $temp_v)
                                {
                                    $temp_v = str_replace('.php', '', $temp_v);
                                    $temp_v = str_replace('.tpl', '', $temp_v);
                                    ?>
                                    <option <?php if($v['value'] == $temp_v) echo 'selected ' ?> value="<?php echo $temp_v ?>"><?php echo $temp_v ?></option>
                                    <?php
                                } 
                             ?>
                        </select>
                        <?php
                    }
                    break;
                    
                    case 'image' :
                    {
                        ?>
                        <div class="form-box image" id="form-<?php echo $v['name'] ?>">
                            <p class="form-title">
                                <label class="" for="<?php echo $v['name'] ?>"><?php echo $v['title'] ?></label>
                            </p>
                            
                            <div class="form-field">
                                <input style="width: 70%;" class="form-control" id="<?php echo $v['name'] ?>"  value="<?php echo $v['name'] ?>" type="text" name="<?php echo $v['name'] ?>" />&nbsp;&nbsp;
                                <input type="button" value="Select" class="show-media-frame btn btn-info" particular="<?php echo $v['name'] ?>" /><br /><br />
                                
                            </div>
                            <img id="<?php echo $v['name'] ?>_display" style="max-width: 100%;" src="<?php echo $v['name'] ?>" />
                        
                          
                        </div>
                        <?php
                    }
                    break;
                    
                    case 'permalink' :
                    {
                        $permalink_array = array('{url}{URL_SUFFIX}', '{url}-p{id}{URL_SUFFIX}', '?p={id}');
                        foreach($permalink_array as $permalink_array_k => $permalink_array_v)
                        {
                            ?>
                            <input class="none" id="radio-<?php echo $v['name'] ?>-<?php echo $permalink_array_k ?>" <?php if($v['value'] == $permalink_array_k) echo 'checked'; ?>     value="<?php echo $permalink_array_k ?>" type="radio"  name="<?php echo $v['name'] ?>" />
                            <label style="text-transform: none;font-weight:normal" name_particular="<?php echo $v['name'] ?>" class="radio-beautiful  <?php if($v['value'] == $permalink_array_k) echo 'radiochecked ';else echo ' radiouncheck' ?>" for="radio-<?php echo $v['name'] ?>-<?php echo $permalink_array_k ?>" ><?php echo $permalink_array_v ?></label>
    
                            <?php
                        }
                        ?>
                        
                        <?php
                    }
                    break;
                    
                    case 'robots_index' :
                    { 
                        
                            
                        ?>
                        
                        <select name="<?php echo $v['name'] ?>">
                           
                            <option <?php if($v['value'] == 1) echo 'selected ' ?> value="<?php echo 1 ?>">Yes</option>
                            <option <?php if($v['value'] == 0) echo 'selected ' ?> value="<?php echo 0 ?>">No</option>
                             
                        </select>
                        <?php
                    }
                    break;
                    
                    
                    
                }
            ?>
        </div>
        
        <span class="clear"></span>
    </div>
    <?php 
        if($v['is_default']!=1)
        {
            ?>
            <i option_name="<?php echo $v['name'] ?>" class="fa fa-remove fa-lg pointer delete-option"></i>
            <?php
        }
    ?>
    
</div>
<span class="clear"></span>