<div class="form-box capcha require"  id="form-capcha">
    <p class="form-title">
        <label class="" for="">
            <span class="field-title"><?php echo $attribute['field_title'] ?></span> 
            <span class="require"> * </span> : 
        </label>
    </p>

    
    <div class="form-field">
        <input autocomplete="off" style="float: left;width:158px;margin-right:15px" id="<?php echo $the_field[$k]['name'] ?>"  value="<?php echo $the_field[$k]['value'] ?>" type="text" name="<?php echo $the_field[$k]['name'] ?>" />
        <img style="float: left;" src="<?php echo SITE_URL . '/admin/capcha.php'; ?>" />
    </div>
    
    <?php
        if(!empty($attribute['description']))
        {
            
        ?>
        <div class="form-description">
            <span class="arrow"></span>
            <?php echo $attribute['description'] ?>
        </div>
        <?php
        }
    ?>
    <span class="clear"></span>
</div>

