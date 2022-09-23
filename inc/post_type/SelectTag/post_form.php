<div class="new-thread-item box">
    <div class="field-title">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <div class="field fl">
        <?php
            $sub_count = 0;
            if(!function_exists('display_select_tag'))
            {
                function display_select_tag($forum)
                {
                    global $sub_count;
                    global $default_value;
                    global $temp_post_type;
                    ?>
                    <option value="<?php echo $forum['id'] ?>" <?php check_select($temp_post_type['name'], $default_value[$temp_post_type['name']], $forum['id']) ?>><?php for($i=0;$i<$sub_count;$i++) echo '----'; echo $forum['title'] ?></option>
                          <?php 
                            
                            $sub_forums = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
                            if(!empty($sub_forums))
                            {
                                $sub_count++;
                                foreach($sub_forums as $s_k=>$s_v)
                                {
                                    display_select_tag($s_v);
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
            }
            
            ?>
            <select  name="<?php echo  $temp_post_type['name'] ?>" id="<?php echo $temp_post_type['name'] ?>">
            <option value="0" <?php check_select($temp_post_type['name'], $default_value[$temp_post_type['name']], '0') ?>>None</option>
                   
            <?php 
                $forums = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=0 ORDER BY stt ASC');
                
                foreach($forums as $forum)
                {
                    display_select_tag($forum); 
                }
            ?>
                
                
            </select>
    </div>
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


 