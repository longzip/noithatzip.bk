<?php

	 
    if(!defined('SECURE_CHECK')) die('Invalid to include');
  
    if(!user_can('user')) die();
    
	$g_page_content['title'] = 'Block manager';
	
    
    if(isset($_POST['submit']))
    {
        if(empty($_POST['name'])) $_POST['name'] = array();
        update_option('actived_blocks', json_encode($_POST['name']));
    }
    
?>
<style>
.tr-HomeProduct, .tr-HomeProduct1, .tr-KHLDanhGiaSidebar, .tr-KHLListNews4, .tr-KHLListNews5, .tr-ListNews1, .tr-ListNews2, .tr-ListNews3, .tr-ListNews4,  .tr-ListNews8, .tr-ListProduct1, .tr-ListProduct2, .tr-SidebarProduct, .tr-SlideListNews1, .tr-SlideListProduct1, .tr-default-title.php{
    display:none;
}
span.change-block-sc {
    cursor: pointer;
    font-size: 13px;
    color: #37b2d6;
    text-decoration: underline;
    position: absolute;
    right: 10px;
    top: 10px;
}

span.change-block-sc:hover {
    color: #f78e05;
}
</style>

<?php
    
	include 'header.php';
?>
<script src="<?php echo CDN_DOMAIN ?>/admin/js/block-manager.js"></script>
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
	
    <h1>Quản lý Block</h1>
    
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
                $actived_blocks = get_option('actived_blocks');
                if(empty($actived_blocks)) $actived_blocks = array();
                else $actived_blocks = json_decode($actived_blocks, TRUE);
            
                $list_blocks = scandir(PATH_ROOT . '/blocks/' );
                unset($list_blocks[0], $list_blocks[1]);
                foreach($list_blocks as $k=>$list_block)
                {
                    if(!is_dir(PATH_ROOT . '/blocks/' . $list_block)) continue;
                    if( file_exists( PATH_ROOT . '/blocks/' . $list_block . '/title.txt' ) ) 
                   {
                        $myfile = fopen( PATH_ROOT . '/blocks/' . $list_block . '/title.txt', "r") or die("Unable to open file!");
                        $block_title = fread($myfile,filesize(PATH_ROOT . '/blocks/' . $list_block . '/title.txt'));
                        fclose($myfile);
                   }
                   else $block_title = $list_block;
                   
                   if( file_exists( PATH_ROOT . '/blocks/' . $list_block . '/description.txt' ) ) 
                   {
                        $myfile = fopen( PATH_ROOT . '/blocks/' . $list_block . '/description.txt', "r") or die("Unable to open file!");
                        $block_description = fread($myfile,filesize(PATH_ROOT . '/blocks/' . $list_block . '/description.txt'));
                        fclose($myfile);
                   }
                   else $block_description = '';
                 
                   ?>
                   <tr class="tr-<?php echo $list_block ?>">
                        <td class="stt"><?php echo $k-1 ?>
                            <input value="<?php echo $list_block ?>" <?php if(in_array( $list_block ,$actived_blocks)) echo 'checked' ?> name="name[]" type="checkbox" />
                        </td>
                        <td class="title"><?php echo $block_title ?></td>
                        <td class="sc">
                            <?php 
                                if(file_exists( CLIENT_ROOT . '/admin/images/block-sc-' . $list_block . '.png' ))
                                {
                                    ?>
                                    <img alt="<?php echo $block_title ?>" src="<?php echo SITE_URL . '/admin/images/block-sc-' . $list_block . '.png'; ?>" /> 
                                    <?php
                                }
                                else
                                {
                                   if(file_exists( PATH_ROOT . '/blocks/' . $list_block . '/sc.png' ))
                                    {
                                        ?>
                                        <img alt="<?php echo $block_title ?>" src="<?php echo CDN_DOMAIN . '/blocks/' . $list_block . '/sc.png' ?>" /> 
                                        <?php
                                    } 
                                    else
                                    {
                                        ?>
                                        <img alt="<?php echo $block_title ?>" src="" /> 
                                        <?php
                                    } 
                                }
                                
                            ?>
                            <span class="change-block-sc" par="<?php echo $list_block ?>">Thay đổi</span>
                            <input  par="<?php echo $list_block ?>" class="none fr file-change-block-sc file-change-block-sc-<?php echo $list_block ?>" multiple="multiple"  name="userfile[]" type="file" />
                             
                        </td>
                        <td class="description">
                            <?php 
                                if( !empty($block_description) )
                                {
                                    ?>
                                    <div class="addon-item-description">
                                        <?php echo $block_description ?>
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