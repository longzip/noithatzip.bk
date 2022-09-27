<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
     
    if(!user_can('new-user')) die();
    
    //h($g_page_info);
    
	$default_value = array(
		'user_name'	       	=> '',
        'password'          => '',
        'image'             => '',
        'permission'        => 'member',
        'email'             => ''
	);
$noti = '';

include( PATH_ROOT . '/apps/demo_thecao_PHP/config.php');
include( PATH_ROOT . '/apps/demo_thecao_PHP/includes/MobiCard.php');


   
if(isset( $_POST['submit'] ))
{
		 
}
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Nạp tiền thành công';
    $g_page_content['meta_des'] = 'Nạp tiền thành công';
?>

<?php
	include 'header.php'
?>

<link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/nap-the.css" />

<div id="content" class="container">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
    
        <div id="main-content" class=" ">
           <div class="box">
                <div id="bread-crumbs">
            		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
            		<span class="arrow">›</span>
                    
            	</div>
           </div>
           <h1 class="title box">Nạp tiền thành công</h1>
           
            
            <div id="list-billing" class="clearfix  box">
                <p>Quý khách vừa nạp thành công <span class="red"><?php echo num_to_price($_GET['val']) ?><sup>đ</sup></span></p>
                <p>Số dư hiện tại của quý khách là <span class="red"><?php echo num_to_price($kh_info['the_point']) ?><sup>đ</sup></span></p>
            </div>
        </div>
    </div>
     
        
    
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>