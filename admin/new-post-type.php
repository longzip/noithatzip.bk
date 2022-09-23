<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
     
    if(!user_can('new-post-type')) die();
    
    //h($g_page_info);
    
	$default_value = array(
		'name'	           	=> '',
        'default_field'     => '1',
        'image'             => '',
        'default_template'  => 'default'
	);
	
    if(isset($_POST['submit']))
    {
		validate_value('name','Tên post type', FALSE, array('min_lenght'=>'3'));
	 
        
        $insert_content['name']            = strip_tags(htmlspecialchars($_POST['name']));
        
        $insert_content['default_field'] = $_POST['default_field'];
        $insert_content['image'] = $_POST['image'];
        $insert_content['default_template'] = $_POST['default_template'];
		
		
        if(form_validation())
        {
			$insert_id = insert_post_type($insert_content);
            if($insert_id) header('Location:' . SITE_URL . '/admin/?page_type=post-type');
		}
        
			
		$default_value = array(
			'name'		     => $insert_content['name'],
			'default_field'  => $insert_content['default_field']
		);
		
		 
    } 
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Thêm Post type mới';
    $g_page_content['meta_des'] = 'Thêm post type';
?>

<?php
	include 'header.php'
?>

<div id="content" class="container">
    <form action="" method="POST">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="fl col-10-6"> 
            <div class="box">
                <div id="bread-crumbs">
            		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
            		<span class="arrow">›</span>
                    
                    <a class="link"  href="<?php echo SITE_URL . '/admin/?page_type=post-type'; ?>" class="home-icon block fl">
                					 
        					Danh sách post type
        			 
        			</a>
                     
            		
            	</div>
            </div>
            <div id="new-post-col-1" class="fl border-box v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
                <div id="new-post-col-1-inner">
                    
                        <div class="box">
                            <h2 class="title">New post type</h2>
                             <?php show_form_error() ?>
                             
                             <?php include 'inc/post-type-form.php' ?>
                             
                        </div> 
                    
                </div>
            </div>
            
            <div id="new-post-col-2" class=" fr border-box v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
                <div id="new-post-col-2-inner" class="fixed-on-scroll">
                    <div id="save" class="box"><input type="submit" value="Add" name="submit" class="btn btn-success" /></div>
                </div>
            </div>
            
        </div>
    </div>
        
    </form>
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>