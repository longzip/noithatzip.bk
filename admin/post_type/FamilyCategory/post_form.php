<div class="new-thread-item box">
    <div class="field-title">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?><?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <div class="field fl">
            <select  name="<?php echo $temp_post_type['name'] ?>" id="<?php echo $temp_post_type['name'] ?>">
                <option value="0" <?php check_select($temp_post_type['name'], $default_value[$temp_post_type['name']], '0') ?>>None</option>
                
                <?php
                    $lists = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $temp_post_type['parent_category']);
                    foreach( $lists as $list)
                    {
                        
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


 