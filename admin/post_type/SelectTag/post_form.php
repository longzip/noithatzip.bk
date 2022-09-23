<div class="new-thread-item box">
    <div class="field-title">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <div class="field fl">
        <?php
            $sub_count = 0;
            
            ?>
            <select  name="<?php echo  $temp_post_type['name'] ?>" id="<?php echo $temp_post_type['name'] ?>">
            <option value="0"  >None</option>
                   
            <?php 
                $forums = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=0 ORDER BY stt ASC');
                
                foreach($forums as $forum)
                {
                    $forum['name'] = $temp_post_type['name'];
                    $forum['value'] = $default_value[$temp_post_type['name']];
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


 