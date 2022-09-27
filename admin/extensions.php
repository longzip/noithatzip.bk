<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
	$g_page_content['title'] = 'Danh sách module';

    
?>

<?php
	include 'header.php';
?>

<div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
<div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
    <div id="home">
           <div class="box">
                <div id="bread-crumbs">
            		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
                    <span class="arrow">›</span>
                    <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=extensions">Danh sách Module</a>
            		<span class="current-page"></span>        	
            	</div>
            </div>
            
            <h1 class="title box">Danh sách module</h1>
            
               
              <div class=" clearfix" id="home-footer" style="margin-top: -10px;border-top:0">
                    <div id="home-footer-1" class="home-footer-col fl border-box v-col-lg-12 v-col-md-12 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                        
                        <div class="  clearfix" style="border: 0;">
                        <?php
                            
                             $list_extensions = scandir(PATH_ROOT . '/extensions' );
                            unset($list_extensions[0], $list_extensions[1]);
                            
                            $list_extension_useds = array();
                            $list_extension_unuseds = array();
                            foreach($list_extensions as $k=>$list_extension)
                            {
                                if(in_array($list_extension, $actived_extensions)) $list_extension_useds[] = $list_extension;
                                else $list_extension_unuseds[] = $list_extension;
                            }
                            
                            ?>
                            <div class="col-module clearfix box">
                                <h2>Module đang sử dụng</h2>
                            
                            <?php
                            $list_extensions = $list_extension_useds;
                            foreach($list_extensions as $k=>$list_extension)
                            {
                                if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/title.txt' ) ) 
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/title.txt', "r") or die("Unable to open file!");
                                    $extension_title = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/title.txt'));
                                    fclose($myfile);
                               }
                               else $extension_title = $list_extension;
                               
                               if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/description.txt' ) ) 
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/description.txt', "r") or die("Unable to open file!");
                                    $extension_description = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/description.txt'));
                                    fclose($myfile);
                               }
                               else $extension_description = '';
                               
                               if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/price.txt' ) ) 
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/price.txt', "r") or die("Unable to open file!");
                                    $extension_price = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/price.txt'));
                                    fclose($myfile);
                               }
                                
                               ?>
                               <div class="extension-item border-box fl">   
                                    <div  class="extension-item-inner"> 
                                    <a href="<?php echo SITE_URL ?>/admin/?page_type=extension-setting&extension=<?php echo $list_extension ?>" class="extension-item-title block">
                                        <?php echo $extension_title ?>
                                    </a>
                                    <div class="extension-description">
                                        ( <?php echo $extension_description ?> )
                                    </div>
                                     <a href="<?php echo SITE_URL ?>/admin/?page_type=extension-setting&extension=<?php echo $list_extension ?>" class="extension-item-title">
                                        <img src="<?php cdn_timthumb_url( CDN_DOMAIN . '/admin/images/extension-' . $list_extension . '.png', 100, 100 )  ?>" />
                                    </a>
                                     
                                    <?php 
                                        if(empty($extension_price))
                                        {
                                            ?>
                                            <span class="extension-price mien-phi">
                                            Miễn phí</span>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="extension-price">
                                            <?php echo num_to_price($extension_price) ?><sup>vnđ</sup></span>
                                            <?php
                                        }
                                        
                                    ?>
                                     </div>
                                </div>
                               
                               
                               <?php
                            }
                            ?> 
                            </div>
                            <span class="clear"></span>
                            <div class="col-module clearfix box">
                                <h2>Module khác</h2>
                            
                            <?php
                            $list_extensions = $list_extension_unuseds;
                            foreach($list_extensions as $k=>$list_extension)
                            {
                                if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/title.txt' ) ) 
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/title.txt', "r") or die("Unable to open file!");
                                    $extension_title = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/title.txt'));
                                    fclose($myfile);
                               }
                               else $extension_title = $list_extension;
                               
                               if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/description.txt' ) ) 
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/description.txt', "r") or die("Unable to open file!");
                                    $extension_description = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/description.txt'));
                                    fclose($myfile);
                               }
                               else $extension_description = '';
                               
                               if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/price.txt' ) ) 
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/price.txt', "r") or die("Unable to open file!");
                                    $extension_price = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/price.txt'));
                                    fclose($myfile);
                               }
                                
                               ?>
                               <div class="extension-item border-box fl">   
                                    <div  class="extension-item-inner"> 
                                    <a href="<?php echo SITE_URL ?>/admin/?page_type=extension-setting&extension=<?php echo $list_extension ?>" class="extension-item-title block">
                                        <?php echo $extension_title ?>
                                    </a>
                                    <div class="extension-description">
                                        ( <?php echo $extension_description ?> )
                                    </div>
                                     <a href="<?php echo SITE_URL ?>/admin/?page_type=extension-setting&extension=<?php echo $list_extension ?>" class="extension-item-title">
                                        <img src="<?php cdn_timthumb_url( CDN_DOMAIN . '/admin/images/extension-' . $list_extension . '.png', 100, 100 )  ?>" />
                                    </a>
                                     
                                    <?php 
                                        if(empty($extension_price))
                                        {
                                            ?>
                                            <span class="extension-price mien-phi">
                                            Miễn phí</span>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="extension-price">
                                            <?php echo num_to_price($extension_price) ?><sup>vnđ</sup></span>
                                            <?php
                                        }
                                        
                                    ?>
                                     </div>
                                </div>
                               
                               
                               <?php
                            }
                            ?> 
                            </div>
                            
                        </div>
                    </div>
                     
                </div>
                 
		
	</div>

</div>

<span class="clear"></span>


 