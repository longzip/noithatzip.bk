<?php

//session_start();
//define('SECURE_CHECK', true);

//include dirname(dirname(dirname(__FILE__))) . '/config.php';

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

$scandirs = scandir(CLIENT_ROOT . '/uploads/' . urldecode($_GET['dir']));
unset($scandirs[0], $scandirs[1]);

$attachments = array();
$dirs = array();

foreach($scandirs as $scandir)
{
	if(is_dir( CLIENT_ROOT . '/uploads/' . urldecode($_GET['dir']) . '/' . $scandir ))
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

<p class="fl"><a class="gallery-folder" href="<?php echo SITE_URL ?>/admin/?page_type=media-dir">&nbsp;&nbsp;&nbsp;&nbsp;Thư mục của bạn</a></p> &nbsp;&nbsp;/ 
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
		<a class="gallery-folder" href="<?php echo SITE_URL ?>/admin/?page_type=media-upload-to-dir&dir=<?php echo urlencode($href) ?>">&nbsp;&nbsp;&nbsp;<?php echo $list_dir ?> &nbsp;</a>
		<?php
        
        if( $k != ( count($list_dirs) - 1 ) ) echo '/';
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
                    <a class="dir-inner" href="<?php echo SITE_URL ?>/admin/?page_type=media-upload-to-dir&dir=<?php echo $dir_path ?>">
                         <img src="<?php echo CDN_DOMAIN ?>/admin/images/folder-icon.png" />
                    </a>
                    <a class="name" href="<?php echo SITE_URL ?>/admin/?page_type=media-upload-to-dir&dir=<?php echo $dir_path ?>"><?php echo $dir ?></a>                 
                    <span dir_name="<?php echo urldecode($_GET['dir']) . '/' . $dir ?>" class="absolute pointer handle delete-dir glyphicon glyphicon-remove"></span>
                </div>               
            </div>
            <?php
        }
        ?>
    </div>
    <div id="inner-gallery">
        <?php
        foreach($attachments as $a)
        { 
            if(isset($_GET['s']))
             {
                $att = get_attachment_by_url('uploads/' . urldecode($_GET['dir']) . '/' . $a);
                 
                if( ( !strpos( 'vos' . $a , $_GET['s'] ) ) && ( !strpos( 'vos' . $att['title']  , $_GET['s'] ) ) && (( !strpos( 'vos' . $att['alt'] , $_GET['s'] ) )) && (( !strpos( 'vos' . $att['description'] , $_GET['s'] ) )) ) continue;
             }
             $moment = array(
                    'url'           =>  'uploads/' . urldecode($_GET['dir']) . '/' . $a,
                    'title'			=> $a,
        			'alt'			=> $a,
        			'description'	=> '',
        			'align'			=> 'none',
                    'user_id'       => $g_user['id']
                );
            $v_attachments['title'] = $a;
            $v_attachments['alt'] = $a;
            $v_attachments['url'] =  'uploads/' . urldecode($_GET['dir']) . '/' . $a;
        	$v_attachments['description']	= '';
            $v_attachments['align'] = 'none';
            include PATH_ROOT . '/media/tpl/file_item_in_dir.php';
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
        <div class="upload-form-meta clearfix">
            <label id="quality" class="upload-form-meta-item">
                Chất lượng ảnh &nbsp;
                <select name="quality">
                    <?php
                        $qualty = get_option('v-core-quality-upload');
                        if(empty($qualty)) $qualty = 100;
                        for($i=1;$i<=150;$i++)
                        {
                            ?>
                            <option <?php if($qualty == $i) echo ' selected ' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php
                        }
                    ?>
                </select>  ( % )
            </label>
            <div class="max-upload-width upload-form-meta-item">
                <?php 
                    $w = get_option('v-core-max-width-upload');
                    if(empty($w)) $w = '';
                ?>
                Chiều rộng tối đa của ảnh 
                <input class="number" type="number" name="max_width" value="<?php echo $w; ?>" placeholder="Không giới hạn" /> ( pixel )
            </div>
        </div>
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
    
     <div class="uploadSizeWarning"><b>Chú ý :</b> Không nên up file ảnh nặng quá 10MB, có thể gây ảnh hưởng tới tốc độ load website</div>
	
    <div  id="display-upload-item">            
        <span class="clear"></span>
    </div>
    
	<div id="ajaxloading"><img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" /></div>
</div>
<?php include PATH_ROOT . '/media/tpl/footer.php' ?>

