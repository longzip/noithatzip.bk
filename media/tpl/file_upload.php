<?php

define('SECURE_CHECK', true);

include dirname(dirname(dirname(__FILE__))) . '/config.php';




/**
 * Read template
 */

include PATH_ROOT . '/media/tpl/header.php';
/**
 * END Read template
 */     
?>



<div class="container">
<?php include PATH_ROOT . '/media/tpl/sidebar.php' ?>
<h1 class="title-font">&nbsp;&nbsp;&nbsp;&nbsp;Tải ảnh lên</h1>

<?php 
    $total_upload_size = v_total_dir_size(PATH_ROOT . '/uploads');
    if($total_upload_size > MAX_UPLOAD_DIR_SIZE) die('Ổ đĩa đầy, vui lòng xóa bớt hoặc nâng cấp hosting trước khi upload tiếp');
    //v_filesize($total_upload_size);
?>

<div class="row">

    <div  id="display-upload-item">
        
        <span class="clear"></span>
    </div>
    <span class="clear"></span>
    <form id="upload-form" class="col-xs-12 uploadform" enctype="multipart/form-data" action="<?php echo SITE_URL ?>/media/tpl/upload_multi_handle.php" method="POST">
        <!-- MAX_FILE_SIZE must precede the file input field -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"  />
        <!-- Name of input element determines name in $_FILES array --> 
        <div class="col-xs-6" id="upload-drop-area">
            <input class="none" multiple="multiple" id="hcv_upload_button" dir_upload="<?php ?>" name="userfile[]"  type="file"   />
            <input class="btn btn-info" type="button" value="Chọn ảnh từ máy tính" id="virtual_select_file" /><br />
            <p style="  color: #7B7B7B;margin-top: 15px;">Hoặc kéo thả tệp vào đây</p>
        </div>
        
        
        
        <div class="col-xs-6">
            <input  id="upload_instant" class="btn btn-info none" type="submit" value="Chọn ảnh từ máy tính" />
        </div>
    
    </form>
	
    
    
	<div id="ajaxloading"><img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" /></div>
</div>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<?php include PATH_ROOT . '/media/tpl/footer.php' ?>

