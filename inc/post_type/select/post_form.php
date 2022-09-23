<div class="new-thread-item box">
    <div class="field-title">
        <label class="label  "><?php echo $temp_post_type['title'] ?></label>
    </div>
    
    <div class="field-content">
        <select  <?php if( !empty($temp_post_type['require']) ) echo 'required' ?> name="<?php echo $temp_post_type['name'] ?>">
             <?php 
               
               
                $temp_value_display = json_decode($temp_post_type['value_display'], TRUE);
                $temp_value = json_decode($temp_post_type['value'], TRUE);
                foreach($temp_value_display as $tem_k=>$temp_v)
                {
                    ?>
                    <option <?php if($default_value[$temp_post_type['name']] == $temp_value[$tem_k]) echo 'selected ' ?> value="<?php echo $temp_value[$tem_k] ?>"><?php echo $temp_v ?></option>
                    <?php
                } 
             ?>
        </select>
        
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
 
 