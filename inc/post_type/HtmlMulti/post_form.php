<style>
    .html-multi-item input.text{
        max-width:500px;
        display:block;
    }
    
    .html-multi-item label{
        margin: 10px 20px;
         
        display:block;
    }
    
    .html-multi-item label.title{
        width:880px;
    }
    
    .html-multi-item textarea{
        
    }
    
    .html-multi-item {
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

.html-multi-item:hover .remove-text-field {
    display: block;
}

.html-multi-item .label{
    display:block;
}
</style>
<script>
   $(document).ready(function(){
        $(".sortable").sortable({helper:"clone", revert:true})
        $(".new-text-field_<?php echo $field['id'] ?>").click(function(){
            var the_id = $(this).attr("the_id");
            var add = '';
           
            
            add = add + '<div class="html-multi-item relative">\
                        <label class="block fl title">Tiêu đề : <input name="<?php echo $temp_post_type['name'] ?>_title[]" class="text" value="" /></label> <label class="block fl">Nội dung : <textarea name="<?php echo $temp_post_type['name'] ?>_value[]" class="main-content text"></textarea></label>\
                        <span class="clear"></span>\
                        <span class="remove-text-field fa fa-remove pointer absolute" the_id="<?php echo $field['id'] ?>"></span>\
                    </div>';
            $("#field-" + the_id + " .sortable").append(add);
            
            tinymce.init({
                entity_encoding : "raw",
            	convert_urls: false,
                selector: ".main-content",
                skin:"custom",
                plugins: [
                    "advlist autolink lists link charmap print preview anchor textcolor ",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu wordcount hcv_upload"
                ],
                menu : { // this is the complete default configuration
                    ///file   : {title : 'File'  , items : 'newdocument'},
                    //edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
                    //insert : {title : 'Insert', items : 'link media | template hr'},
                    //view   : {title : 'View'  , items : 'visualaid'},
                    format : {title : 'Format', items : 'strikethrough superscript subscript | removeformat'},
                    table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
                    tools  : {title : 'Tools' , items : 'spellchecker'}
                },
                toolbar: "fontselect fontsizeselect | forecolor backcolor | undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link | hcv_upload |  code fullscreen"
            });

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
            $default_value[$temp_post_type['name']] = json_encode(array(array('value'=>'', 'title'=>'')));
        }
         
        $temp_text_multi = json_decode($default_value[$temp_post_type['name']], TRUE);
           
        foreach($temp_text_multi as $k=>$v)
        {
            ?>
            <div class="html-multi-item relative">
                <label class="block fl title">Tiêu đề : <input name="<?php echo $temp_post_type['name'] ?>_title[]" class="text" value="<?php echo $v['title'] ?>" /></label>
                <label class="block fl">Nội dung : <textarea name="<?php echo $temp_post_type['name'] ?>_value[]" class="text main-content"><?php echo $v['value'] ?></textarea></label>
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


 