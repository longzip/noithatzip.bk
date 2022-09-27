<?php
	$default = array(
        'name'          => '',
        'title'         => '',
        'description'   => '',
        'require'       => 0,
        'default'       => '',
        'value'         => json_encode(array()),
        'value_display' => json_encode(array()),
    );
    if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
    
     
?>
    <script>
        <?php include_once PATH_ROOT . '/admin/post_type/select/js.js' ?>
    </script>
    
    <style>
        .new-select-option {
            top: 10px;
            right: 0px;
        }
        
        .list-option-item {
            font-size: 13px;
            margin: 10px;
            border-bottom: 1px dashed silver;
            padding: 10px 0;
            cursor:move;
        }
        
        .list-option-item i {
            position: relative;
            top: 5px;
        }
        
        .list-option .inner {
            border: 1px solid rgb(234, 226, 226);
            margin: 10px;
        }
        
        .remove-option{
            top: 15px!important;
            right: 0px;
            position: absolute!important;
        }
    </style>
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
        
        
        
        
        
        <div class="attribute_item relative list-option">
            <label>List Option : </label><br />
            <input class="field_attribute text" attribute_name="value" type="hidden" value="<?php echo htmlspecialchars($default['value']) ?>" id="value-<?php echo $field_id ?>" />
            <input class="field_attribute text" attribute_name="value_display" type="hidden" value="<?php echo htmlspecialchars($default['value_display']) ?>" id="value_display-<?php echo $field_id ?>" />
            <i class="new-select-option fa fa-plus pointer absolute" field_id="<?php echo $field_id ?>"></i>
                <div class="inner option-sortable option-ui-sortable">
                    <?php 
                        $tem_value = json_decode($default['value'], TRUE);
                        $tem_display_value = json_decode($default['value_display'], TRUE);
                        
                        foreach($tem_value as $tem_k=>$tem_p)
                        {
                            ?>
                            <div class="list-option-item relative" field_id="<?php echo $field_id ?>">
                                <i class="fa fa-wheelchair fl">&nbsp;&nbsp;</i>
                                <label class="fl" style="width: 257px;">Value : <input value="<?php echo $tem_p ?>" class="value option_change" field_id="<?php echo $field_id ?>" /></label> 
                                <label class="fl"  style="width: 257px;">Display : <input value="<?php echo $tem_display_value[$tem_k] ?>" class="value_display option_change" field_id="<?php echo $field_id ?>"  /></label>
                                <span class="clear"></span>
                                <i class="fa fa-remove absolute pointer remove-option"  field_id="<?php echo $field_id ?>"></i>
                            </div>
                            <?php
                        }
                    ?>
                    
                </div>
                
            
             <span class="clear"></span>
        </div>
        
        
        <span class="clear"></span>
        
        
