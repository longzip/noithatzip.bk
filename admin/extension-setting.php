<?php

	 
    if(!defined('SECURE_CHECK')) die('Invalid to include');
  
    if(!user_can('user')) die();
    
    if(!isset($_GET['extension'])) die();
    
    $extension_name = $_GET['extension'];
    
    if( !file_exists(PATH_ROOT . '/extensions/' . $extension_name ) ) die('No');
    
    
    
    include PATH_ROOT . '/extensions/' . $extension_name . '/fill_request_form.php';
    
    
    
    if( file_exists( PATH_ROOT . '/extensions/' . $extension_name . '/title.txt' ) ) 
   {
        $myfile = fopen( PATH_ROOT . '/extensions/' . $extension_name . '/title.txt', "r") or die("Unable to open file!");
        $extension_title = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $extension_name . '/title.txt'));
        fclose($myfile);
   }
   else $extension_title = $extension_name;
   
   if( file_exists( PATH_ROOT . '/extensions/' . $extension_name . '/description.txt' ) ) 
   {
        $myfile = fopen( PATH_ROOT . '/extensions/' . $extension_name . '/description.txt', "r") or die("Unable to open file!");
        $extension_description = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $extension_name . '/description.txt'));
        fclose($myfile);
   }
   else $extension_description = '';
   
   if( file_exists( PATH_ROOT . '/extensions/' . $extension_name . '/price.txt' ) ) 
   {
        $myfile = fopen( PATH_ROOT . '/extensions/' . $extension_name . '/price.txt', "r") or die("Unable to open file!");
        $extension_price = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $extension_name . '/price.txt'));
        fclose($myfile);
   }
   else $extension_price = '';
    
	$g_page_content['title'] = 'Cài đặt tiện ích : ' . $extension_title;
    
    
    
?>

<?php
    
	include 'header.php';
  
?>
<link rel="stylesheet" href="<?php echo CDN_DOMAIN . '/extensions/' . $extension_name . '/setting_form.css' ?>"  />
<script src="<?php echo CDN_DOMAIN . '/extensions/' . $extension_name . '/setting_form.js' ?>"></script>
<div id="" class="container">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
        <?php
          $actived_extensions = get_option('actived_extensions');
            if(empty($actived_extensions)) $actived_extensions = array();
            else $actived_extensions = json_decode($actived_extensions, TRUE);
            //
        ?>
            <div class="box">
                <div id="bread-crumbs">
            		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
                    <span class="arrow">›</span>
                    <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=extensions">Danh sách Module</a>
            		<span class="current-page"></span>        	
            	</div>
            </div>
            <?php 
                if(!in_array($extension_name, $actived_extensions))
                {
                      
                    ?>
                    <div class="un-active-module box">
                        <div class="un-active-module-title clearfix">
                            <p class="fl">
                                Module : <span><?php echo $extension_title ?></span>
                            </p>
                            <p class="fr price"><?php echo num_to_price($extension_price) ?><sup>đ</sup></p>
                        </div>
                        <div class="noti-active-extension">
                            <p>Module này chưa được kích hoạt, Vui lòng kích hoạt module trước khi sử dụng</p>
                            <span class="active-module-now"  extension_name="<?php echo $extension_name ?>"><i class="fa fa-wrench" aria-hidden="true"></i> &nbsp; Kích hoạt ngay</span>
                        </div>
                        <div class="calc_to_active_extension none"></div>
                    </div>
                    <?php
                }
                else 
                { 
                    ?>
                    <form action="" method="POST">
                        <div id="new-post-col-1" class="fl border-box v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
                            <div id="new-post-col-1-inner">
                                 <div class=" box">
                                      <div class="field-item clearfix">
                                        <div >  
                                            <div class="forum-detail">
                        							<label for="categories-8-1" class="forum-label checkbox-beautiful <?php if($extension_info[0]['is_actived']) echo 'checked';else echo 'uncheck' ?>  ">Kích hoạt</label>
                                                    <input <?php if($extension_info[0]['is_actived']) echo 'checked'; ?> id="categories-8-1" class="none" name="is_actived" type="checkbox" value="1" />
                        						</div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <?php include PATH_ROOT . '/extensions/' . $extension_name . '/setting_form.php' ?>
                            </div>
                        </div>
                        <div id="new-post-col-2" class=" fr border-box v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
                            <div id="new-post-col-2-inner" style="min-width: 200px;" class="fixed-on-scroll">
                                <div style="margin-top: 30px;" id="save" class="box"><input type="submit" name="submit" value="Lưu lại" class="btn btn-success" /></div>
                            </div>
                        </div>
                        
                  </form>
                    <?php
                }
            ?>
              
            <span class="clear"></span>
        </div>
    </div>
<?php include 'footer.php'; ?>
      