<script>
    $(document).ready(function(){
        $(".tag-search").keyup(function(){
            var particular = $(this).attr("particular");
            
            var str = '';
            
            if($(".tag-search").val() != '')
            {
                var current = $(".tag-search").val().toLowerCase();
                
                
                
                $("#field-" + particular).find(".tag-item").each(function()
                {
                    $(this).css("display", "none");
                    
                    str = $(this).text().toLowerCase();
                    
                     
                    
                    if(str.search(current) >= 0) $(this).css("display", "block");
                })
            }
            else
            {
                $(".tag-item").css("display", "block");
            }
            
        })
    })
</script>

<div class="new-thread-item box CheckboxTag" id="field-<?php echo $field['id'] ?>">
    <div class="field-title">
        <label style="width: 300px;" class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
        <input placeholder="Tìm kiếm"  class="block fr text tag-search" type="text" particular="<?php echo $field['id'] ?>" />
        <span class="clear"></span>
    </div>
    
     <div class="field-content">
    <?php
        $field_id = $field['id'];
        $temp_tags = get_tags();
        foreach($temp_tags as $temp_tag)
        {
            ?>
            <div class="tag-item fl" val="<?php echo $temp_tag['title']  ?>">
                <label class="checkbox-beautiful <?php if(in_array($temp_tag['id'], explode(',', $default_value[$temp_post_type['name']]))) echo ' checked ';else echo ' uncheck ' ?>" for="tags-<?php echo $field_id ?>-<?php echo $temp_tag['id'] ?>">
                <?php echo $temp_tag['title']  ?>
                </label>
                <input class="none" id="tags-<?php echo $field_id ?>-<?php echo $temp_tag['id'] ?>" type="checkbox" <?php if(in_array($temp_tag['id'], explode(',', $default_value[$temp_post_type['name']]))) echo 'checked ' ?>  name="<?php echo $temp_post_type['name'] ?>[]" value="<?php echo $temp_tag['id'] ?>" />
                
            </div>
            <?php
        }
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


 