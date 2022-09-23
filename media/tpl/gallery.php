<?php
session_start();
define('SECURE_CHECK', true);
include dirname(dirname(dirname(__FILE__))) . '/config.php';

if(!$g_user['id']) die('stops');


/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Thư viện');    
$tpl->assign('css', array(
    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    SITE_URL . '/admin/' . 'css/admin.css',
    '../uploads.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js',
    '../uploads.js'
));
include 'header.php';
/**
 * END Read template
 */    
 

?>



<div class="container">
<h1 class="title-font">
	<p class="fl">&nbsp;&nbsp;&nbsp;&nbsp;Ảnh của bạn</p>
	<form action="" class="fr" id="search-attachments-form" method="POST">
		<input type="text" autocomplete="off" name="input" id="search-attachments-value" value="" />
		<input  type="submit" value="" id="search-attachments-button" />
	</form>
	<span class="clear"></span>
</h1>

<div class="row" id="gallery" select="<?php if(isset($_GET['select'])) echo $_GET['select'];else echo '0' ?>">
<?php include PATH_ROOT . '/media/tpl/sidebar.php' ?>

<?php 
$j=1; 
$i=1;
$obj_BD = new models_DB;

$attachments = get_attachment(array('user_id'=>$g_user['id']));
if(empty($attachments)) echo 'Bạn chưa có ảnh nào!';

?>
<div id="inner-gallery">
<?php

foreach($attachments as $v_attachments)
{ 
include 'file_item.php';
} 
?>

<span class="clear after-append"></span>
<div id="loading-image">
<br /><br />
<img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" />
</div>
</div>

</div>
<span id="load-more-point" class="fixed glyphicon glyphicon-heart" style="opacity: 0;"></span>
<span id="end-gallery" class="glyphicon glyphicon-heart"  style="opacity: 0;"></span>
<div id="button-load-more" class="btn btn-info" style="margin: auto;display:block">Tải thêm</div>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<div class="clear"></div>

<?php include 'footer.php' ?>