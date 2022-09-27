<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
     
    if(!user_can('library')) die();
    
    //h($g_page_info);
    
  
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Thư viện';
    $g_page_content['meta_des'] = 'Thư viện';
?>

<?php
	include 'header.php'
?>
<style>
    iframe{
          width: 100%;
          height: 600px;
          border: 1px solid #D6D7DB;
    }
</style>
<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="fl col-10-6">
           
           
           <div class="box">
            <div id="bread-crumbs">
        		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
        		<span class="arrow">›</span>
                <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=media-dir">Thư viện</a>
                
        		<span class="current-page"></span>
        		
        	</div>
           </div>
             
                <div class="box">
                    <h1 class="title">Thư viện</h1>
                     
                     <iframe src="<?php  echo SITE_URL ?>/admin/?page_type=media-dir"></iframe>
                    
                </div>
                 
        </div>
    </div>
        
    
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>