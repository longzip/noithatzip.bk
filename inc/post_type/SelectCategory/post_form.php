<div class="new-thread-item box">
    <div class="field-title">
        <label class="label"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <div class="field  ">
            <?php echo $temp_post_type['name'] ?>
            <select  name="<?php echo $temp_post_type['name'] ?>" >
            <?php
                
                if(!empty($temp_post_type['description'])) $other_field['parent'] = $temp_post_type['description'];
                  
                $parent = get_category($other_field['parent']);
               
                $cats = get_categories(array('parent'=>$other_field['parent'], 'order'=> ' ORDER BY stt ASC, id ASC ')) ;
            ?>
                <option value="0">-- <?php echo $parent['title'] ?> --</option>
            <?php 
                foreach($cats as $cat)
                {
                    ?>
                    <option value="<?php echo $cat['id'] ?>"><?php echo $cat['title'] ?></option>
                    <?php
                }
            ?>
            </select>
    </div>
    </div>
    <?php
    if(!empty($temp_post_type['description']))
    {
        ?>
        <div class="form-description none">
            <span class="arrow"></span>

            <?php echo $temp_post_type['description'] ?>
        </div>
        <?php
    }
    ?>
     
</div>
<span class="clear"></span>


 