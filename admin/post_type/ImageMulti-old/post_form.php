<style>
    .text-multi-item input.text{
        width: 360px;
    }
	
	.text-multi-item input.text:focus{
		outline:none;
	}
    
    .text-multi-item label{
        margin: 20px 20px;
    }
    
    .text-multi-item {
    border: 1px dashed rgb(189, 184, 184);
    margin: 25px 0px;
    cursor: move;
	padding:10px 15px;
}

.new-text-field_<?php echo $field['id'] ?> {
    bottom: 10px;
    right: 10px;
}

.remove-text-field {
    top: 45px;
    right: 10px;
    display: none;
    cursor: pointer;
}

.text-multi-item:hover .remove-text-field {
    display: block;
}

.image-multi-image-display {
    max-width: 156px;
    max-height: 75px;
    border: 1px solid rgb(236, 236, 236);
	margin-right:30px;
}

.text-multi-item .left{
	width:555px
}
</style>


<div class="new-thread-item box relative" id="field-<?php echo $field['id'] ?>">


    <label class="label block fl"><?php echo $temp_post_type['title'] ?>  </label>
    <br />
    <div class="sortable ui-sortable">

    <?php 
        //h($default_value[$temp_post_type['name']]);
         
        if(empty($default_value[$temp_post_type['name']]))
        {
            $default_value[$temp_post_type['name']] = json_encode(array());
			
        }
		
		
		//h($default_value[$temp_post_type['name']]);
       
        $temp_text_multi = json_decode($default_value[$temp_post_type['name']], TRUE);
        $image_multi_count = 0;
		
		 
		
        foreach($temp_text_multi as $k=>$v)
        {
			 
            ?>
            <div class="text-multi-item relative ImageMulti-item">
                <div class="fl left">
					<div class="block">
					Tiêu đề : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="<?php echo $temp_post_type['name'] ?>_title[]" class="text" value="<?php echo $v['title'] ?>" />
					</div>
					<br />
					<div class="block">
					Đường dẫn ảnh : <input type="text" name="<?php echo $temp_post_type['name'] ?>_src[]" id="image-<?php echo $field['id'] ?>-<?php echo $k ?>" class="text"  value="<?php echo $v['src'] ?>" />
					
					<input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="image-<?php echo $field['id'] ?>-<?php echo $k ?>">
			 
					</div>
					
				</div>
				<div class="block fr"> 
					 <img class="image-multi-image-display" id="image-<?php echo $field['id'] ?>-<?php echo $k ?>_display"   src="<?php echo $v['src'] ?>">
				</div>
				 
				
                <span class="clear"></span>
                <span class="remove-text-field fa fa-remove pointer absolute" the_id="<?php echo $field['id'] ?>"></span>
     
            </div>
            <?php
			$image_multi_count++;
        }
		$image_multi_count++;
		
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
<script>

	var image_multi_count = "<?php echo $image_multi_count ?>"
   $(document).ready(function(){
        $(".sortable").sortable({helper:"clone", revert:true})
        $(".new-text-field_<?php echo $field['id'] ?>").click(function(){
            var the_id = $(this).attr("the_id");
            var add = '<div class="text-multi-item relative">\
							<div class="fl left">\
								<div class="block">\
								Tiêu đề : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="<?php echo $temp_post_type['name'] ?>_title[]" class="text" value="" />\
								</div>\
								<br />\
								<div class="block">\
								Đường dẫn ảnh : <input type="text" name="<?php echo $temp_post_type['name'] ?>_src[]" id="image-<?php echo $field['id'] ?>-'+ image_multi_count +'" class="text"  value="" />\
								<input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="image-<?php echo $field['id'] ?>-'+ image_multi_count +'">\
								</div>\
							</div>\
							<div class="block fr">\
								 <img class="image-multi-image-display" id="image-<?php echo $field['id'] ?>-'+ image_multi_count +'_display"   src="">\
							</div>\
							<span class="clear"></span>\
							<span class="remove-text-field fa fa-remove pointer absolute" the_id="<?php echo $field['id'] ?>"></span>\
						</div>';
            $("#field-" + the_id + " .sortable").append(add);
			image_multi_count++;
        })
        
        
        $("body").on('click', '.remove-text-field', function(){
           $(this).parent().remove();
        })
   });
</script>

 