<?php

session_start();
define('SECURE_CHECK', true);

include dirname(dirname(dirname(__FILE__))) . '/config.php';

if($g_user['permission'] != 'admin') die();
 
/**
 * Read template
 */

include PATH_ROOT . '/media/tpl/header.php';
/**
 * END Read template
 */     
?>

<?php 
if(empty( $_GET['dir'] )) $_GET['dir'] = '';
$scandirs = scandir(PATH_ROOT . '/uploads/library/' . urldecode($_GET['dir']));
unset($scandirs[0], $scandirs[1]);

$attachments = array();
$dirs = array();

foreach($scandirs as $scandir)
{
	if(is_dir( PATH_ROOT . '/uploads/library' . urldecode($_GET['dir']) . '/' . $scandir ))
	{
		$dirs[] = $scandir;
	}
	else
	{
		$attachments[] = $scandir;
	}
}
?>
<style>
h1.title-font {
    position: fixed;
    top: 35px;
    width: 100%;
    left: 0;
    background: #FFFFFF;
    z-index: 222222222;
    border-bottom: 1px solid rgb(103, 100, 100);
}
</style>
<div class="container">
<?php include PATH_ROOT . '/media/tpl/sidebar.php' ?>
<h1 class="title-font">

<?php 

$list_dirs = explode('/', urldecode($_GET['dir']));


?>

<script>
$(document).ready(function(){
    $(".root-box").click(function(){      
        $(this).toggleClass("active");     
        var _this = $(this);
        _this.find("img").each(function(){
            $(this).toggleClass("active");             
        })
    })
})
</script>

<p class="fl"><a class="gallery-folder" href="<?php echo SITE_URL ?>/admin/?page_type=media-dir">&nbsp;&nbsp;&nbsp;&nbsp;Thư mục của bạn</a></p> &nbsp;&nbsp;  /
&nbsp;&nbsp;<a class="gallery-folder" href="<?php echo SITE_URL ?>/admin/?page_type=media-root-library">Thư viện</a>&nbsp;&nbsp;
<?php 
foreach($list_dirs as $k=>$list_dir)
{
	$href = '';
	for($i=0;$i<=$k;$i++)
	{
		if($i==0)
		{
				$href .=  $list_dirs[$i];
		}
		else
		{
			$href .= '/' . $list_dirs[$i];
		}
		
	}
		?>
		<a class="gallery-folder" href="<?php echo SITE_URL ?>/admin/?page_type=media-root-library&dir=<?php echo urlencode($href) ?>"><?php echo $list_dir ?> &nbsp;&nbsp;</a> / &nbsp;&nbsp;
		<?php
        
        if( $k != ( count($list_dirs) - 1 ) )
        {
            ?>
            
            <?php
        }
}
?>



&nbsp;&nbsp;( <?php echo count($attachments) ?> mục )


	<!-- <form action="" class="fr" id="search-attachments-form" method="POST">
		<input type="text" autocomplete="off" name="input" id="search-attachments-value" value="" />
		<input  type="submit" value="" id="search-attachments-button" />
	</form>
    -->
    <div id="new-dir" current_dir="<?php echo urldecode($_GET['dir']) ?>" class="fr">Tạo thư mục mới</div>
	
     <form class="fr media-search" action="" method="GET">
            <input class="text" name="s" placeholder="Tìm kiếm" value="<?php if(isset($_GET['s'])) echo $_GET['s'] ?>" />
            <input value="<?php echo $_GET['dir'] ?>" type="hidden" name="dir" />
            <input type="hidden" name="page_type" value="media-dir" />
            <input name="submit"  type="submit" value="" class="submit" />
        </form>
    
    <span class="clear"></span>
</h1>

<?php 
    $total_upload_size = v_total_dir_size(CLIENT_ROOT . '/uploads');
    if($total_upload_size > MAX_UPLOAD_DIR_SIZE) die('<br /><br /><br /><br />Ổ đĩa đầy, vui lòng xóa bớt hoặc nâng cấp hosting trước khi upload tiếp');
    //v_filesize($total_upload_size);
    

?> 

<br /><br />
<div style="margin-top:40px;" class="row fl" id="gallery">
    <div id="inner-dir">
        <?php 
        foreach($dirs as $dir)
        {
        	$dir_path = urlencode(urldecode($_GET['dir']) . '/' . $dir )
        	 ?>
            <div class="dir flex-item">
                <div class="dir-inner-new">
                    <a class="dir-inner" href="<?php echo SITE_URL ?>/admin/?page_type=media-root-library&dir=<?php echo $dir_path ?>">
                         <img style="width: 100%;"  src="<?php echo CDN_DOMAIN ?>/admin/images/folder-icon-zland.png" />
                    </a>
                    <a class="name" href="<?php echo SITE_URL ?>/admin/?page_type=media-root-library&dir=<?php echo $dir_path ?>"><?php echo $dir ?></a>                 
                    <span dir_name="<?php echo urldecode($_GET['dir']) . '/' . $dir ?>" class="absolute pointer handle delete-dir glyphicon glyphicon-remove"></span>
                </div>               
            </div>
            <?php
        }
        ?>
    </div>
    <div id="inner-gallery" class="flex-wrap">
        <?php
        $lists = array(); 
        foreach($attachments as $a)
        { 
            $lists[] = CDN_DOMAIN . '/uploads/library' . urldecode($_GET['dir']) . '/' . $a;
        }
        
        foreach($lists as $k=>$a)
        {
            $path_info = pathinfo($a);
             
            ?>
            <div stt_post="<?php echo $k+1 ?>" stt="<?php echo $attachments[$k] ?>" attachment_id="" class="flex-item stt-<?php echo $k+1 ?> box relative root-box" style="">
                <div real_src="<?php echo $a ?>" class="img active pointer" src="<?php echo $a ?>">
                    <img real_src="<?php echo $a ?>" class=" lazyload active pointer" src="<?php echo $a ?>" data-src="<?php echo $a ?>" />                                                     
                </div>
                             
                <span class="absolute pointer handle setting_attribute glyphicon glyphicon-wrench setting_icon"></span>
                <span file_name="uploads/camera-dahua-hac-hfw1000rp.png" file_name_2="uploads/camera-dahua-hac-hfw1000rp.png" class="absolute pointer handle delete-in-dir glyphicon glyphicon-remove"></span>
            
                <p class="none image-name absolute"><?php echo $path_info['basename'] ?></p>
                
                <form  action="" method="POST" class="attribute absolute">
                    <a class="form-link" href="<?php echo $a ?>" target="_blank">Xem</a>
    				<div class="setting-item">
                    <label> Url : </label>
                        <input class="attribute_input form-control"  value="<?php echo $a ?>" /><br />
                    </div>
    			     <div class="setting-item">
                    <label> Title : </label>
                    <input class="attribute_input title form-control"  value="<?php echo $path_info['filename'] ?>" /><br />
                    </div>
    			   
    				<div class="clear"></div>
    				
    				<div class="setting-item">
                    <label> Alt : </label>
                    <input class="attribute_input alt form-control"  value="<?php echo $path_info['filename'] ?>" />
                    <br />
    				</div>
    				
    				<div class="clear"></div>
    				
    				<div class="setting-item">
                    <label> Align : </label>
                    <select class="form-control align">                    
                        <option <?php if($att['align'] == 'none') echo 'selected="selected"' ?>  value="none">None</option>
    					<option <?php if($att['align'] == 'center') echo 'selected="selected"' ?> value="center">Center</option>
                        <option <?php if($att['align'] == 'left') echo 'selected="selected"' ?> value="left">Left</option>
                        <option <?php if($att['align'] == 'right') echo 'selected="selected"' ?> value="right">Right</option>
    					
                    </select>
    				 <br />
    				</div>
    				
    				<div class="setting-item">
    				<label> Description : </label>
                    <textarea class="attribute_input description form-control" ></textarea>
                    <br />
                    </div>
    				<div class="clear"></div>
    				
                    
                        
                    <input type="submit" class="btn btn-primary fl action save-attribute submit" value="Save" />
                    <span class="noti relative bold"></span>
                    <input type="button" class="btn btn-default fr action close_attribute_form" value="Close" />
                </form>
                
            </div>
            <?php
        }
         
        ?>
        
        
        <div style="bottom: 0;" class="row absolute none">
            <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
        </div>
    </div>
    
</div>

<div class="row fr new-gallery-upload-form" style="margin-top:40px;">
    
    <span class="clear"></span>
    <form id="upload-form" class="col-xs-12 uploadform" enctype="multipart/form-data" action="<?php echo SITE_URL ?>/media/tpl/upload_multi_handle.php" method="POST">
        <!-- MAX_FILE_SIZE must precede the file input field -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"  />
        <!-- Name of input element determines name in $_FILES array --> 
        <div class="col-xs-6" id="upload-drop-area">
            <input class="none" multiple="multiple" id="hcv_upload_button" dir_upload="<?php echo $_GET['dir'] ?>" name="userfile[]"  type="file"   />
            <input class="btn btn-info" type="button" value="Chọn ảnh từ máy tính" id="virtual_select_file" /><br />
            <p style="  color: #7B7B7B;margin-top: 15px;">Hoặc kéo thả tệp vào đây</p>
        </div>
        
        
        
        <div class="col-xs-6">
            <input  id="upload_instant" class="btn btn-info none" type="submit" value="Chọn ảnh từ máy tính" />
        </div>
    
    </form>
	
    <div  id="display-upload-item">            
        <span class="clear"></span>
    </div>
    
	<div id="ajaxloading"><img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" /></div>
</div>
<?php include PATH_ROOT . '/media/tpl/footer.php' ?>

