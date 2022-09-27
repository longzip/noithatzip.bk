<?php
 

if($g_user['permission'] != 'admin') die('');
?>
<!DOCTYPE html>
<html>
<head>
<title>Option - <?php echo $_GET['option_name'] ?></title>

<meta charset="utf-8" />
<script>
	var href  = "<?php echo SITE_URL ?>"
	var site_url  = "<?php echo SITE_URL ?>"
</script>
<script src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-1.10.2.js"></script>
<script src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-ui.js"></script> 
<script src="<?php echo CDN_DOMAIN ?>/admin/js/admin.js"></script>
<script lang="javascript" src="<?php echo CDN_DOMAIN ?>/media/media-frame.js"></script>



<style>

	body{
		padding:0 15px 0 0;
		padding:50px 0;
	}
	div#block-file-loading {
		text-align: center;
		margin-top: 50px; 
	}

		div#media-frame {
 
 left: 45px!important;
  top: 20px!important;
}
</style>
<script>
	 

	$(document).ready(function(){
		$("#block-file-loading").css("display", "none")
	})
</script>

<?php tinymce_setting() ?>


<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/edit-option.css" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/media/media-frame.css" />

</head>
<body class="arial">
<div id="block-file-loading"><img src="<?php CDN_DOMAIN ?>/inc/images/ajaxloader.gif" /></div>

<?php

$option_info = get_option_info($_GET['option_name']);
$att_info = json_decode($option_info['attributes'], TRUE);

?>
<div class="edit-option-title">Chỉnh sửa <strong><?php echo $att_info['title'] ?></strong></div>
<div class="edit-option-content">
    <div class="edit-option-<?php echo $att_info['type'] ?>">
    <?php 
        switch($att_info['type'])
        {
            case 'text' :
            {
                ?>
                <input class="text" id="option-content" value="<?php echo $option_info['value'] ?>" />
                <?php
                break;
            }
            case 'textarea' :
            {
                ?>
                <textarea class="text" style="height: 200px;" id="option-content"><?php echo $option_info['value'] ?></textarea>
                <?php
                break;
            }
            case 'image' :
            {
                ?>  
                <div class="form-group">
                    <label class="" for="name">Link ảnh</label>
                    <br />
                    <input type="text" placeholder="src" class="parameter text" id="option-content" parameter="src"  value="<?php echo $option_info['value'] ?>" />
            		
            		<input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="option-content" /><br /><br />
            		
                    <div id="option-content_display" style="max-width: 100%;" >
                        <img style="max-width: 100%;" src="<?php echo $option_info['value'] ?>" />
                    </div>
                     
                </div>
                <?php
                break;
            }
            case 'html' :
            {
                ?>
                <div class="form-group">
                    <label class="" for="name">Nội dung</label>
                    <br />
                    <textarea id="option-content"  class="form-control parameter main-content" parameter="content"><?php echo $option_info['value'] ?></textarea>
                </div> 
                <?php
                break;
            }
        }
    ?>
    </div>
</div>

<div id="media-frame">
	<div class="fr frame-action">
		<span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;
		<span class="close-frame btn btn-default">Đóng</span>
	</div>
</div>
<div class="fixed opacity opacity-frame" id="hcv-opacity"></div>


</body>
</html>
 

 