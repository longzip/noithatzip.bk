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
	
     
    
    if(isset($_POST['submit']))
    {
		validate_value('user_name','User Name', FALSE, array('type'=>'user_name'));
	 
        validate_value('password','Password', FALSE, array('type'=>'password'));
        
        
        $insert_content['secure_key'] = random_string();
        $insert_content['user_name']  = strip_tags(htmlspecialchars($_POST['user_name']));
        $insert_content['password'] = md5($_POST['password'] . $insert_content['secure_key']);
        $insert_content['image'] = $_POST['image'];
        $insert_content['permission'] = $_POST['permission'];
        $insert_content['email'] = $_POST['email'];
		
		
        if(form_validation())
        {
			$insert_id = insert_user($insert_content);
            
            
            
             
            if($insert_id) header('Location:' . SITE_URL . '/admin/?page_type=user');
		}
        
			
		$default_value = array(
    		'user_name'	       	=> $_POST['user_name'],
            'password'          => $_POST['password'],
            'image'             => $_POST['image'],
            'permission'        => $_POST['permission'],
            'email'             => $_POST['email']
    	);
		
		 
    } 
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Thêm người dùng mới';
    $g_page_content['meta_des'] = 'Thêm người dùng';
?>

<?php
	include 'header.php'
?>

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
                    <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=user">Danh sách thành viên</a>
            		<span class="current-page"></span>
            	</div>
           </div>
            <form action="" method="POST">
                <div id="new-post-col-1" class="fl border-box v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
                    <div id="new-post-col-1-inner">
                        <div class=" ">
                            <h1 class="title box">Thêm người dùng</h1>
                             <?php show_form_error() ?>
                             
                             <?php include 'inc/user-form.php' ?> 
                        </div>
                    </div>
                </div>
                
                <div id="new-post-col-2" class=" fr border-box v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
                    <div id="new-post-col-2-inner" class="fixed-on-scroll">
                        <div id="save" class="box"><input type="submit" value="Lưu lại" name="submit" class="btn btn-success" /></div>
                    </div>
                </div>
                
                
                
                
            </form>
        </div>
    </div>
     
        
    
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>