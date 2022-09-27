<?php

	 
    if(!defined('SECURE_CHECK')) die('Invalid to include');
  
    if(!user_can('user')) die();
    
	$g_page_content['title'] = 'Extensions manager';
	
    
    if(isset($_POST['submit']))
    {
        if(empty($_POST['name'])) $_POST['name'] = array();
        update_option('actived_extensions', json_encode($_POST['name']));
    }
    
?>

<?php
    
	include 'header.php';
?>

<div id="" class="container">

    <?php //include 'sidebar.php'; ?>
        
    <div id="main-content" class="fl col-10-6">
    <div class="box">
    
	<div id="bread-crumbs">
		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
		<span class="arrow">›</span>
        <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=extension-manager">Quản lý extension</a>
		<span class="current-page"></span>
		
	</div>
	
    <h1>Quản lý Add on</h1>
    
        <div class="box">
        <form id="addon-manager-form" action="" method="POST">
        <table class="addon-table">
            <tr class="tr-first">
                <td class="stt">STT</td>
                <td class="title">Tên</td>
                <td class="sc">ScreenShot</td>
                <td class="description">Miêu tả</td> 
            </tr>
        
            <?php 
                $actived_extensions = get_option('actived_extensions');
                if(empty($actived_extensions)) $actived_extensions = array();
                else $actived_extensions = json_decode($actived_extensions, TRUE);
            
                $list_extensions = scandir(PATH_ROOT . '/extensions' );
                unset($list_extensions[0], $list_extensions[1]);
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
                   <tr>
                        <td class="stt"><?php echo $k-1 ?>
                            <input value="<?php echo $list_extension ?>" <?php if(in_array( $list_extension ,$actived_extensions)) echo 'checked' ?> name="name[]" type="checkbox" />
                        </td>
                        <td class="title"><?php echo $extension_title ?></td>
                        <td class="sc">
                            <?php 
                                if(file_exists( PATH_ROOT . '/admin/images/extension-' . $list_extension . '.png' ))
                                {
                                    ?>
                                     
                                        <img alt="<?php echo $extension_title ?>" src="<?php echo CDN_DOMAIN . '/admin/images/extension-' . $list_extension . '.png' ?>" />
                                     
                                    <?php
                                }
                            ?>
                        </td>
                        <td class="description">
                            <?php 
                                if( !empty($extension_description) )
                                {
                                    ?>
                                    <div class="addon-item-description">
                                        <?php echo $extension_description ?>
                                    </div>
                                    <?php
                                }
                            ?>
                        </td>
                         
                    </tr>
                   
                   
                   <?php
                }
            ?>
            </table>
            <br />
            <div style="text-align: right;">
                <input type="submit" name="submit" value="Lưu lại" class="btn btn-success" />
            </div>
            </form>
        </div>
        
    </div>
    <span class="clear"></span>
</div>