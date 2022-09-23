<?php
	$default = array(
        'field_name'     => '',
        'field_title'    => '',
        'description'    => '',
        'static'         => 0,
        'require'        => 1
    );
    if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
        <div class="attribute_item">
            <label>Field name : </label>
            <input <?php if(isset($temporary_setting_parameter)) echo 'disabled' ?>  type="text" value="<?php echo $default['field_name'] ?>" class="field_attribute" attribute_name="field_name" /><br />
            <span class="clear"></span>
        </div>

        <div class="attribute_item">
            <label>Field title : </label>
            <input type="text" value="<?php echo $default['field_title'] ?>" class="field_attribute title" attribute_name="field_title" />
            <span class="clear"></span>
        </div>
        
        <div class="attribute_item">
            <label>Static : </label>
            <select class="field_attribute static" attribute_name="static">
                <option <?php if($default['static'] == '0') echo 'selected' ?> value="0">No</option>
                <option <?php if($default['static'] == '1') echo 'selected' ?> value="1">Yes</option>
            </select>
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
            <label>Miêu tả : </label>
            <textarea class="field_attribute" attribute_name="description" ><?php echo $default['description'] ?></textarea>
            <span class="clear"></span>
        </div>
        
        <span class="clear"></span>
        
        
