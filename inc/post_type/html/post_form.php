<div class="html new-thread-item box">
    <div class="field-title">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div> 
    
    <div class="field-content">
        <textarea  <?php if($temp_post_type['require'] == '1') echo 'required' ?> name="<?php echo $temp_post_type['name'] ?>" class="block textarea main-content"><?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], TRUE, TRUE) ?></textarea>
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


 