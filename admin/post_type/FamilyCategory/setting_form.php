<?php
	$default = array(
        'name'     => '',
        'title'    => '',
        'require'        => '',
        'min_lenght'      => '0',
        'max_lenght'      => '-1',
        'description'    => '',
        'default'       => ''
    );
    if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
        <div class="attribute_item">
            <label>Field name : </label>
            <input <?php if(isset($temporary_setting_parameter)) echo 'disabled' ?>  type="text" value="<?php echo $default['name'] ?>" class="field_attribute text name" attribute_name="name" /><br />
            <span class="clear"></span>
        </div>
        
        <div class="attribute_item">
            <label>Field title : </label>
            <input type="text" value="<?php echo $default['title'] ?>" class="  text field_attribute title" attribute_name="title" />
            <span class="clear"></span>
        </div>
        
        <span class="clear"></span>
        
        <div class="attribute_item">    
            <label> Chuyên mục chính : </label>
            <div class="field-content fl">
                <div class="field">
                <?php
                    $sub_count = 0;
                    function display_forum($forum)
                    {
                        global $sub_count;
                        global $default_value;
                        ?>
                        <option value="<?php echo $forum['id'] ?>" <?php check_select('parent', $default_value['parent'], $forum['id']) ?>><?php for($i=0;$i<$sub_count;$i++) echo '----'; echo $forum['title'] ?></option>
                              <?php 
                                
                                $sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
                                if(!empty($sub_forums))
                                {
                                    $sub_count++;
                                    foreach($sub_forums as $s_k=>$s_v)
                                    {
                                        display_forum($s_v);
                                        if($s_k == (count($sub_forums) - 1)) $sub_count--;
                                    }
                                    ?>
                                    
                                    <?php
                                }
                                //else 
                                
                               ?>
                               
                               <?php 
                            ?>
                        
                        <?php
                    }
                    ?>
                    <select class="  text field_attribute parent_category" attribute_name="parent_category" >
                        <option value="0" <?php check_select($temp_post_type['name'], $default_value[$temp_post_type['name']], '0') ?>>None</option>                           
                        <?php 
                            $forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY stt ASC');
                            
                            foreach($forums as $forum)
                            {
                                display_forum($forum); 
                            }
                        ?>
                    </select>
            </div>
            </div>
        </div>
        
        <span class="clear"></span>
        
        <div class="attribute_item">
            <label>Min lenght : </label>
            <input type="number" value="<?php echo $default['min_lenght'] ?>" class="field_attribute text" attribute_name="min_lenght" />
            <span class="clear"></span>
        </div>
        
        <div class="attribute_item">
            <label>Max lenght : </label>
            <input type="number" value="<?php echo $default['max_lenght'] ?>" class="field_attribute text" attribute_name="max_lenght" />
            <span class="clear"></span>
        </div>
        
        <div class="attribute_item">
            <label>Require : </label>
            <select class="field_attribute require" attribute_name="require">
                <option <?php if($default['require'] == '0') echo 'selected' ?> value="0">No</option>
                <option <?php if($default['require'] == '1') echo 'selected' ?> value="1">Yes</option>
            </select>
            <span class="clear"></span>
        </div>
        
        <div class="attribute_item">
            <label>Default : </label>
            <input type="text" value="<?php echo $default['default'] ?>" class="field_attribute text" attribute_name="default" />
            <span class="clear"></span>
        </div>
        
        
        <div class="attribute_item">
            <label>Miêu tả : </label>
            <textarea class="field_attribute text" attribute_name="description" ><?php echo $default['description'] ?></textarea>
            <span class="clear"></span>
        </div>
        
        <span class="clear"></span>
        
        
