<?php
	$default = array(
        'name'     => '',
        'title'    => '',
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
        
        
