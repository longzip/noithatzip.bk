<?php
$default = array(
    'title'     => '',
    'form_id'   => '',
    'title_link'=> ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
<form id="text_form_setting" class="block_form" block_id="0">

    <?php  display_block_setting_default($default);  ?>
    
    <div class="form-group" style="margin: 10px;">
        <label class="" style="width: 100px;" for=" ">Chọn form</label>
        <select style="padding: 5px 10px;min-width:200px" class="text form-control parameter" parameter="form_id">
        
        
        <?php 
            $list_forms = get_forms(array('the_type'=>'form'));
            foreach($list_forms as $list_form)
		    {
		        ?>
                <option value="<?php echo $list_form['id'] ?>"><?php echo $list_form['name'] ?></option>
                <?php  
            }
        ?>
        </select>
    </div>
</form>
	
