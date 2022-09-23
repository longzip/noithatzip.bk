<div class="new-thread-item box">
    <label class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    <input autocomplete="off" <?php if($temp_post_type['require'] == '1') echo 'required' ?> name="<?php echo $temp_post_type['name'] ?>" class="block text fl" value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, TRUE) ?>" />
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


 