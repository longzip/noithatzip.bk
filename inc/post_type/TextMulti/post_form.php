<style>
    .text-multi-item input.text{
        width: 250px;
    }
    
    .text-multi-item label{
        margin: 20px 20px;
    }
    
    .text-multi-item {
    border: 1px dashed rgb(189, 184, 184);
    margin: 25px 0px;
    cursor: move;
}

.new-text-field_<?php echo $field['id'] ?> {
    bottom: 10px;
    right: 10px;
}

.remove-text-field {
    top: 26px;
    right: 10px;
    display: none;
    cursor: pointer;
}

.text-multi-item:hover .remove-text-field {
    display: block;
}
</style>
<script>
   $(document).ready(function(){
        $(".sortable").sortable({helper:"clone", revert:true})
        $(".new-text-field_<?php echo $field['id'] ?>").click(function(){
            var the_id = $(this).attr("the_id");
            var add = '<div class="text-multi-item relative">\
                        <label class="block fl">Hiển thị : <input name="<?php echo $temp_post_type['name'] ?>_display[]" class="text" value="" /></label> <label class="block fl">Giá trị : <input name="<?php echo $temp_post_type['name'] ?>_value[]" class="text"  value="" /></label>\
                        <span class="clear"></span>\
                    </div>';
            $("#field-" + the_id + " .sortable").append(add);
        })
        
        
        $("body").on('click', '.remove-text-field', function(){
           $(this).parent().remove();
        })
   });
</script>

<div class="new-thread-item box relative" id="field-<?php echo $field['id'] ?>">


    <label class="label block fl"><?php echo $temp_post_type['title'] ?>  </label>
    
    <div class="sortable ui-sortable">

    <?php 
        //h($temp_post_type);
       
        if(empty($default_value[$temp_post_type['name']]))
        {
            $default_value[$temp_post_type['name']] = json_encode(array(array('value'=>'', 'display'=>'')));
        }
         
        $temp_text_multi = json_decode($default_value[$temp_post_type['name']], TRUE);
           
        foreach($temp_text_multi as $k=>$v)
        {
            ?>
            <div class="text-multi-item relative">
                <label class="block fl">Hiển thị : <input name="<?php echo $temp_post_type['name'] ?>_display[]" class="text" value="<?php echo $v['display'] ?>" /></label> <label class="block fl">Giá trị : <input name="<?php echo $temp_post_type['name'] ?>_value[]" class="text"  value="<?php echo $v['value'] ?>" /></label>
                <span class="clear"></span>
                <span class="remove-text-field fa fa-remove pointer absolute" the_id="<?php echo $field['id'] ?>"></span>
     
            </div>
            <?php
        }
    ?>

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
     
     <span class="new-text-field_<?php echo $field['id'] ?> fa fa-plus pointer absolute" the_id="<?php echo $field['id'] ?>"></span>
     
     
</div>
<span class="clear"></span>


 