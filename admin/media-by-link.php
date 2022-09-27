<?php
 
if(!$g_user['id']) die('stops');


/**
 * Read template
 */
/*
$tpl = new views_view();

$tpl->assign('title', 'Thư viện');    
$tpl->assign('css', array(
    CDN_DOMAIN . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    CDN_DOMAIN . '/admin/' . 'css/admin.css',
    '../uploads.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js',
    '../uploads.js'
));
*/

include PATH_ROOT . '/media/tpl/header.php';
/**
 * END Read template
 */    
 
$_GET['dir'] = '';

$scandirs = scandir(CLIENT_ROOT . '/uploads' . urldecode($_GET['dir']));
unset($scandirs[0], $scandirs[1]);
 
$attachments = array();
$dirs = array();
 
foreach($scandirs as $scandir)
{
	if(is_dir( CLIENT_ROOT . '/uploads' . urldecode($_GET['dir']) . '/' . $scandir ))
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
    	<p class="fl"><a class="gallery-folder"  href="<?php echo SITE_URL ?>/admin/?page_type=media-dir">&nbsp;&nbsp;&nbsp;&nbsp;Thư mục của bạn</a></p>
    	<!-- <form action="" class="fr" id="search-attachments-form" method="POST">
    		<input type="text" autocomplete="off" name="input" id="search-attachments-value" value="" />
    		<input  type="submit" value="" id="search-attachments-button" />
    	</form>
        -->
        &nbsp;&nbsp; ( <?php echo count($attachments) ?> mục )
        
        <div id="new-dir" current_dir="" class="fr">Tạo thư mục mới</div>
        
        <form class="fr media-search" action="" method="GET">
            <input class="text" name="s" placeholder="Tìm kiếm" value="<?php if(isset($_GET['s'])) echo $_GET['s'] ?>" />
            <input type="hidden" name="page_type" value="media-dir" />
            <input name="submit"  type="submit" value="" class="submit" />
            
        </form>
        
        
    	<span class="clear"></span>
    </h1>
    <?php 
    $j=1;
    $i=1;
    $obj_BD = new models_DB;
    
    include PATH_ROOT . '/media/tpl/sidebar.php'; ?>
    
      
    
    <div class="row">
        <form class="col-xs-12" id="insert_by_link_form" class=" box active"  method="POST">
            <div class="insert-by-link-item clearfix">
                <label class="" for="link_insert">Đường dẫn ảnh : </label> 
                <input class="form-control" id="link_insert" value="" type="text" name="link_insert" /> 
            </div>
            
            <span class="clear"></span>
            <div class="insert-by-link-item clearfix">
                <label class="" for="title">Miêu tả</label> 
                <input class="form-control title by-link-description" id="title" value="" type="text" name="title" /> 
            </div>
            
            <span class="clear"></span>
            <div class="insert-by-link-item clearfix">
                <label class="" for="alt">Alt</label> 
                <input class="form-control alt" id="alt" value="" type="text" name="alt" /> 
            </div>
            
            <span class="clear"></span>
        </form>
        
        
        <div class="col-xs-12" id="display"><img real_src="" src="" style="max-width: 100%;" /></div>
    </div>

</div>
<div class="clear"></div> 
<?php include 'footer.php' ?>