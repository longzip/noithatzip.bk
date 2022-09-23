<div class="new-thread-item box">
    <label class="label block fl"><?php echo $temp_post_type['title'] ?></label>
    
    <?php 
        if(file_exists(TEMPLATE_PATH  . '/index.php') ) $t_template_path = PATH_ROOT . '/tpl/tpl/' . TEMPLATE;
        else $t_template_path = TEMPLATE_PATH;
        
         
        
        switch($g_page_info['page_type'])
        {
            
            case 'new-post' :
            {
                $a = scandir($t_template_path . '/post');
                $default_value[$temp_post_type['name']] = $post_type_info['default_template']; 
            }   
            break; 
            case 'edit-post' :
            {
                $a = scandir($t_template_path . '/post');
            }   
            break; 
            case 'new-category' :
            {
                $a = scandir($t_template_path . '/category');
            }   
            break; 
            case 'edit-category' :
            {
                $a = scandir($t_template_path . '/category');
            }   
            break;
            case 'new-tag' :
            {
                $a = scandir($t_template_path . '/tag');
            }   
            break; 
            case 'edit-tag' :
            {
                $a = scandir($t_template_path . '/tag');
            }   
            break;
        }
        $b = array('index.php', '.', '..');
        
        $a = array_diff($a, $b);
        
    ?>
    
    <select name="<?php echo $temp_post_type['name'] ?>">
         <?php 
             
            foreach($a as $temp_v)
            {
                $temp_v = str_replace('.php', '', $temp_v);
                $temp_v = str_replace('.tpl', '', $temp_v);
                ?>
                <option <?php if($default_value[$temp_post_type['name']] == $temp_v) echo 'selected ' ?> value="<?php echo $temp_v ?>"><?php echo $temp_v ?></option>
                <?php
            } 
         ?>
    </select>
    
    <?php 
        
    ?>
    
    <span class="clear"></span>
    
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


 