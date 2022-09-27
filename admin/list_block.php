<?php
session_start();
define('SECURE_CHECK', true);

include dirname(dirname(__FILE__)).'/config.php';

if($g_user['permission'] != 'admin') die('');
?>
<!DOCTYPE html>
<html>
<head>
<title>Danh sách Block</title>

<meta charset="utf-8" />
<script>
	var href  = "<?php echo SITE_URL ?>"
	var site_url  = "<?php echo SITE_URL ?>"
</script>
<script src="<?php echo SITE_URL ?>/inc/js/jquery-1.10.2.js"></script>
<script src="<?php echo SITE_URL ?>/admin/js/block.js"></script> 



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

 

<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/inc/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/inc/css/vos-responsive.css" />
</head>
<body class="arial">
<div id="block-file-loading"><img src="<?php SITE_URL ?>/inc/images/ajaxloader.gif" /></div>

<?php

$option_info = get_option_info($_GET['option_name']);
$att_info = json_decode($option_info['attributes'], TRUE);

?>
<div class="edit-option-title">Chỉnh sửa <strong><?php echo $att_info['title'] ?></strong></div>
<div class="edit-option-content">
    
    
</div>
 
<div class="fixed opacity opacity-frame" id="hcv-opacity"></div>


</body>
</html>
 

 