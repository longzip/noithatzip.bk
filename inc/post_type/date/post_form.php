<div class="new-thread-item box time">


    <div class="field-title">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <?php
            //echo $default_value[$temp_post_type['name']];
        if(isset($_POST['submit']))
        {
            $default_value[$temp_post_type['name']] = strtotime($default_value[$temp_post_type['name']]);
        }
        else
        {
            if(empty($default_value[$temp_post_type['name']]) ) $default_value[$temp_post_type['name']] = hcv_time();
        }
            
        ?>
        <input value="<?php echo date('Y-m-d\TH:i', $default_value[$temp_post_type['name']]) ?>"  type="datetime-local"  spellcheck="false" field_id="<?php echo $field['id'] ?>" autocomplete="off" <?php if($temp_post_type['require'] == '1') echo 'required' ?> name="<?php echo $temp_post_type['name'] ?>" class="block text text-field ?> fl" id="text-field-<?php echo $field['id'] ?>" />
        <span class="clear"></span>
        <div class="suggest-content">
            
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


 