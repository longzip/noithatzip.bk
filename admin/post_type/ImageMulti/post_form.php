<?php
if(!defined('CHECK_CONS_POST_TYPE_IMAGE_MULTI_JS'))
{
    define('CHECK_CONS_POST_TYPE_IMAGE_MULTI_JS', 1);
    ?>
    <script defer lang="javascript" src="<?php echo CDN_DOMAIN . '/inc/js/multi-image-upload.js?v=' . time() ?>"></script>
    <?php
}



?>


<style>
.upload-button {
    font-size: 25px;
    color: #30a8d8;
    display: block;
    padding: 0px 0;
    width: 100%;
    text-align: center;
}
.multi-image-item {
    width:  8%;
    float: left;
    margin: 1%;
    position: relative;
    cursor: move;
    min-height:60px;
}

.multi-image-item-des {
    position: absolute;
    top: 50%;
    left: 5%;
    z-index: 2;
    box-sizing: border-box;
    width: 90%;
    transform: translateY( -50% );
    -webkit-transform: translateY( -50% );
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    opacity: 0;
}

.multi-image-item-image
 img {
    width: 100%;
}

.multi-image-item-des input {
    width: 100%;
    border: 1px solid #bd7147;
    background: #f7ebeb;
    box-sizing: border-box;
}

.multi-image-item-des {}

.multi-image-item:hover .multi-image-item-des {
    opacity: 1;
}

.remove-multi-image-item {
    position: absolute;
    color: #ce0909;
    font-size: 15px;
    cursor: pointer;
    bottom:5px;
    right:5px;
    display:none;
}

.multi-image-item:hover .remove-multi-image-item {
    display:block;
}
</style>

<div class="new-thread-item new-thread-item-MultiImage  box relative" id="field-<?php echo $field['id'] ?>">
    <label class="label block fl"><?php echo $temp_post_type['title'] ?>  </label>
    <br />
    <div class="sortable ui-sortable list-image clearfix">

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
            <div class="multi-image-item">
                <div class="multi-image-item-des">
                    <input type="text" value="<?php echo $v['title'] ?>" name="<?php echo $temp_post_type['name'] ?>_title[]" />
                </div>
                <div class="multi-image-item-image">
                    <img src="<?php echo $v['src'] ?>" alt="" />
                    <input type="hidden" value="<?php echo $v['src'] ?>" name="<?php echo $temp_post_type['name'] ?>_src[]" />
                </div>
                <i class="fa fa-close remove-multi-image-item"></i>
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

     <br />
     <span field_name="<?php echo $temp_post_type['name'] ?>" class="upload-button new-text-field_<?php echo $field['id'] ?> fa fa-plus pointer absolute" the_id="<?php echo $field['id'] ?>"></span>
     <br />
     <input class="none real-upload-button" multiple="multiple" id="hcv_upload_button" dir_upload="" name="userfile[]" type="file" />
</div>
<span class="clear"></span>
<script>

	var image_multi_count = "<?php echo $image_multi_count ?>"
   $(document).ready(function(){
        $("body").on('click', '.remove-multi-image-item', function(){
           if(confirm("Xóa ảnh ?"))
           {
                $(this).closest(".multi-image-item").remove();
           }
        })
   });
</script>
