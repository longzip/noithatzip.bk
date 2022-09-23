<div class="new-thread-item box">
    <div class="field-title">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?></label>
    </div>
    
    <div class="field-content">
        
         <?php 
           
           
            $temp_value_display = json_decode($temp_post_type['value_display'], TRUE);
            $temp_value = json_decode($temp_post_type['value'], TRUE);
            foreach($temp_value_display as $tem_k=>$temp_v)
            {
                ?>
                
                <input class="none" id="radio-<?php echo $field['id'] ?>-<?php echo $tem_k ?>" <?php if($default_value[$temp_post_type['name']] == $temp_value[$tem_k]) echo 'checked'; ?>     value="<?php echo $temp_value[$tem_k] ?>" type="radio"  name="<?php echo $temp_post_type['name'] ?>" />
                <label name_particular="<?php echo $temp_post_type['name'] ?>" class="radio-beautiful  <?php if($default_value[$temp_post_type['name']] == $temp_value[$tem_k]) echo 'radiochecked ';else echo ' radiouncheck' ?>" for="radio-<?php echo $field['id'] ?>-<?php echo $tem_k ?>" ><?php echo $temp_v ?></label>
                            
                <br />
                 
                
               
               <?php
            } 
         ?>
         
        
        <?php 
            
        ?>
    
    </div>
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
 
 