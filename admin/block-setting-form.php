<?php


if($g_user['permission'] != 'admin') die('');
?>
<!DOCTYPE html>
<html>
<head>
<title>Block - <?php echo $_GET['block_name'] ?></title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=vietnamese" rel="stylesheet" />

<meta charset="utf-8" />
<script>
	var href  = "<?php echo SITE_URL ?>"
	var site_url  = "<?php echo SITE_URL ?>";
	var cdn_domain = "<?php echo CDN_DOMAIN ?>";
	var cnd_tpl_url = "<?php echo CDN_DOMAIN . '/tpl/' . TEMPLATE ?>";
</script>
<script src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-1.10.2.js?v=<?php echo FRONT_END_VERSION ?>"></script>

<?php 
    if($_GET['block_name'] != 'MatBang')
    {
        ?>
        <script src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-ui.js?v=<?php echo FRONT_END_VERSION ?>"></script> 
        <script src="<?php echo CDN_DOMAIN ?>/admin/js/admin.js?v=<?php echo FRONT_END_VERSION ?>"></script>
        <script lang="javascript" src="<?php echo CDN_DOMAIN ?>/media/media-frame.js?v=<?php echo FRONT_END_VERSION ?>"></script>

        <?php
    }
?>




<style>

</style>
<script>
	 

	$(document).ready(function(){
		$("#block-file-loading").css("display", "none");
        
        $(".show-sub-title").click(function(){
            $(".wrap-subtitle").slideToggle();
        });
        
             $(".html-mode").click(function(){
                
                
                
                var parent = $(this).closest('.wrap-tinymce-textarea');
               
                parent.find(".tinymce-textarea").each(function(){
                     
                    var current_id = $(this).attr("id");
                    
                    tinymce.init({
                        entity_encoding : "raw",
                    	convert_urls: false,
                        selector: "#" + current_id,
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
                        toolbar: "fontselect fontsizeselect | forecolor backcolor | undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link | hcv_upload | code"
                     });
                    
                    stt++;    
                });
                
             });
             
             $(".text-mode").click(function(){
                   var parent = $(this).closest('.wrap-tinymce-textarea');
                    
                    
                    var current_id = $(this).attr("id");
                    
                    parent.find(".tinymce-textarea").each(function(){
                        $(this).attr("id", "tinymce-textarea-" + stt);
                        alert(stt)
                        tinymce.execCommand('mceRemoveControl', true, current_id);
                    });
                
             });
             
             
         });
</script>

<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/reset.css?v=<?php echo FRONT_END_VERSION ?>" />
 
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css?v=<?php echo FRONT_END_VERSION ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/vos-responsive.css?v=<?php echo FRONT_END_VERSION ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/block-setting-form.css?v=<?php echo FRONT_END_VERSION ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/media/media-frame.css?v=<?php echo FRONT_END_VERSION ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/blocks/<?php echo $_GET['block_name'] ?>/setting_form.css?v=<?php echo FRONT_END_VERSION ?>" />



</head>
<body class="arial">
<div id="block-file-loading"><img src="<?php SITE_URL ?>/inc/images/ajaxloader.gif" /></div>
<?php
//if(isset($_COOKIE['temporary_setting_parameter'])) $temporary_setting_parameter = json_decode($_COOKIE['temporary_setting_parameter'], TRUE);

//if(isset($_SESSION['temporary_setting_parameter'])) $temporary_setting_parameter = json_decode($_SESSION['temporary_setting_parameter'], TRUE);


if(!empty($_GET['block_id']))
{
    $block_content = models_DB::get('SELECT parameter FROM '.BLOCK_TABLE.' WHERE id = ' . $_GET['block_id']);
    
    $block_content = $block_content[0];
    
	$temporary_setting_parameter = json_decode($block_content['parameter'], TRUE);
}





?>

 
<div class="edit-option-content">
    <?php include PATH_ROOT . '/blocks/' . $_GET['block_name'] . '/setting_form.php'; ?> 
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
 

 