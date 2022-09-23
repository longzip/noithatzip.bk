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
 
$_GET['dir'] = '';

$scandirs = scandir(PATH_ROOT . '/uploads' . urldecode($_GET['dir']));
unset($scandirs[0], $scandirs[1]);
 
$attachments = array();
$dirs = array();
 
foreach($scandirs as $scandir)
{
	if(is_dir( PATH_ROOT . '/uploads' . urldecode($_GET['dir']) . '/' . $scandir ))
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
    z-index: 222222;
    border-bottom: 1px solid rgb(103, 100, 100);
}
</style>

<div class="container">
    <h1 class="title-font">
    	<p class="fl"><a class="gallery-folder"  href="<?php echo SITE_URL ?>/media/tpl/dir.php">&nbsp;&nbsp;&nbsp;&nbsp;Thư mục của bạn</a></p>
    	<!-- <form action="" class="fr" id="search-attachments-form" method="POST">
    		<input type="text" autocomplete="off" name="input" id="search-attachments-value" value="" />
    		<input  type="submit" value="" id="search-attachments-button" />
    	</form>
        -->
        &nbsp;&nbsp; ( <?php echo count($attachments) ?> mục )
        
        <div id="new-dir" current_dir="" class="fr">Tạo thư mục mới</div>
        
        <form class="fr media-search" action="" method="GET">
            <input class="text" name="s" placeholder="Tìm kiếm" value="<?php if(isset($_GET['s'])) echo $_GET['s'] ?>" />
            <input name="submit"  type="submit" value="" class="submit" />
        </form>
        
        
    	<span class="clear"></span>
    </h1>

    <div  style="margin-top:40px;" class="row fl" id="gallery"  >
        <?php 
        include PATH_ROOT . '/media/tpl/sidebar.php';
        $j=1;
        $i=1;
        $obj_BD = new models_DB;
        
        $all_dirs = scandir(PATH_ROOT . '/uploads/');
        $all_dirs = $dirs;
        ?>
        <div id="inner-dir">
            <?php
            
            foreach($all_dirs as $dir)
            { 
                 
                ?>
                <div class="dir">
                <a class="dir-inner" href="<?php echo SITE_URL ?>/media/tpl/upload_to_dir.php?dir=<?php echo $dir ?>">
                         
                </a>
                <div class="name"><?php echo $dir ?></div>
                     
                     <span dir_name="<?php echo $dir ?>" class="absolute pointer handle delete-dir glyphicon glyphicon-remove"></span>
                   
                </div>
                <?php
            } 
            ?>
            
            <span class="clear after-append"></span>
            <div id="loading-image">
            <br /><br />
            <img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" />
            </div>
        </div>
        
        <div id="inner-gallery">
        <?php
        foreach($attachments as $k=>$a)
        { 
             
             if(isset($_GET['s']))
             {
                $att = get_attachment_by_url('uploads' . urldecode($_GET['dir']) . '/' . $a);
                 
                if( ( !strpos( 'vos' . $a , $_GET['s'] ) ) && ( !strpos( 'vos' . $att['title']  , $_GET['s'] ) ) && (( !strpos( 'vos' . $att['alt'] , $_GET['s'] ) )) && (( !strpos( 'vos' . $att['description'] , $_GET['s'] ) )) ) continue;
             }
             $moment = array(
                    'url'           =>  'uploads' . urldecode($_GET['dir']) . '/' . $a,
                    'title'			=> $a,
        			'alt'			=> $a,
        			'description'	=> '',
        			'align'			=> 'none',
                    'user_id'       => $g_user['id']
                );
            $v_attachments['title'] = $a;
            $v_attachments['alt'] = $a;
            $v_attachments['url'] =  'uploads' . urldecode($_GET['dir']) . '/' . $a;
        	$v_attachments['description']	= '';
            $v_attachments['align'] = 'none';
            include 'file_item_in_dir.php';
        } 
        ?>
        <span class="clear"></span>
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
    	<div id="ajaxloading"><img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" /></div>
        <div  id="display-upload-item"><span class="clear"></span>
        </div>
    </div>

</div>
<div class="clear"></div> 
<?php include 'footer.php' ?>