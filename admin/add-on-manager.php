<?php

	 
    if(!defined('SECURE_CHECK')) die('Invalid to include');
  
    if(!user_can('user')) die();
    
	$g_page_content['title'] = 'Add on manager';
	
    
    if(isset($_POST['submit']))
    {
        if(empty($_POST['name'])) $_POST['name'] = array();
        update_option('actived_addons', json_encode($_POST['name']));
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
        <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=add-on-manager">Quản lý add on</a>
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
                <td class="Syntax">Mẫu</td>
            </tr>
        
            <?php 
                $actived_addons = get_option('actived_addons');
                if(empty($actived_addons)) $actived_addons = array();
                else $actived_addons = json_decode($actived_addons, TRUE);
            
                $list_addons = scandir(PATH_ROOT . '/addon' );
                unset($list_addons[0], $list_addons[1]);
                foreach($list_addons as $k=>$list_addon)
                {
                    if( file_exists( PATH_ROOT . '/addon/' . $list_addon . '/title.txt' ) ) 
                   {
                        $myfile = fopen( PATH_ROOT . '/addon/' . $list_addon . '/title.txt', "r") or die("Unable to open file!");
                        $addon_title = fread($myfile,filesize(PATH_ROOT . '/addon/' . $list_addon . '/title.txt'));
                        fclose($myfile);
                   }
                   else $addon_title = $list_addon;
                   
                   if( file_exists( PATH_ROOT . '/addon/' . $list_addon . '/description.txt' ) ) 
                   {
                        $myfile = fopen( PATH_ROOT . '/addon/' . $list_addon . '/description.txt', "r") or die("Unable to open file!");
                        $addon_description = fread($myfile,filesize(PATH_ROOT . '/addon/' . $list_addon . '/description.txt'));
                        fclose($myfile);
                   }
                   else $addon_description = '';
                   
                   if( file_exists( PATH_ROOT . '/addon/' . $list_addon . '/syntax.txt' ) ) 
                   {
                        $myfile = fopen( PATH_ROOT . '/addon/' . $list_addon . '/syntax.txt', "r") or die("Unable to open file!");
                        $addon_syntax = fread($myfile,filesize(PATH_ROOT . '/addon/' . $list_addon . '/syntax.txt'));
                        fclose($myfile);
                   }
                   else $addon_syntax = '';
                   ?>
                   <tr>
                        <td class="stt"><?php echo $k-1 ?>
                            <input value="<?php echo $list_addon ?>" <?php if(in_array( $list_addon ,$actived_addons)) echo 'checked' ?> name="name[]" type="checkbox" />
                        </td>
                        <td class="title"><?php echo $addon_title ?></td>
                        <td class="sc">
                            <?php 
                                if(file_exists( PATH_ROOT . '/addon/' . $list_addon . '/sc.png' ))
                                {
                                    ?>
                                     
                                        <img alt="<?php echo $addon_title ?>" src="<?php echo SITE_URL . '/addon/' . $list_addon . '/sc.png' ?>" />
                                     
                                    <?php
                                }
                            ?>
                        </td>
                        <td class="description">
                            <?php 
                                if( !empty($addon_description) )
                                {
                                    ?>
                                    <div class="addon-item-description">
                                        <?php echo $addon_description ?>
                                    </div>
                                    <?php
                                }
                            ?>
                        </td>
                        <td class="Syntax">
                            <?php 
                                if( !empty($addon_syntax) )
                                {
                                    ?>
                                    <textarea spellcheck="false" style="width: 100px;height:75px" class="text"><?php echo $addon_syntax; ?></textarea>
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