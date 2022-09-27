<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
    if(!user_can('edit-post-type')) die();
    
    if($g_user['permission'] != 'admin') die('Dang nhap de tiep tuc');
    
     if(!isset($_GET['post_type_id'])) die('post_type_id not defined !');
    
    if(!is_numeric($_GET['post_type_id'])) die('post_type_id invalid !');
    
    $post_type_id = $_GET['post_type_id'];
    
	 
	
	$post_type_info = get_post_type($post_type_id);
    
    if($post_type_info == FALSE) die('Post type not found');
    
	$default_value = $post_type_info;
    
    
    if(isset($_POST['submit']))
    {
		validate_value('name','Tên post type', FALSE, array('min_lenght'=>'3'));
	 
        
        $insert_content['name'] = strip_tags(htmlspecialchars($_POST['name']));
        
        $insert_content['default_field'] = $_POST['default_field'];
	 
        $insert_content['image'] = $_POST['image'];
        $insert_content['default_template'] = $_POST['default_template'];
		
        if(form_validation())
        {
			$insert_id = models_DB::update($insert_content, POST_TYPE_TABLE, ' WHERE id='. $post_type_id);
            if($insert_id) header('Location:' . SITE_URL . '/admin/?page_type=post-type');
		}
        
			
		$default_value = array(
			'name'		     => $insert_content['name'],
			'default_field'  => $insert_content['default_field']
		);
		
		 
    } 
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Sửa Post type ';
    $g_page_content['meta_des'] = 'Sửa post type';
?>

<?php
	include 'header.php'
?>

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
                    
                    <a class="link"  href="<?php echo SITE_URL . '/admin/?page_type=post-type'; ?>" class="home-icon block fl">
                					 
        					Danh sách post type
        			 
        			</a>
                     
            		
            	</div>
            </div>
       
       
        <form action="" method="POST">
            
        
            <div class="box">
                <h2 class="title">Sửa post type "<?php echo $post_type_info['name'] ?>"</h2>
                 <?php show_form_error() ?>
                 
                 <?php include 'inc/post-type-form.php' ?>
                
                
            </div>
            
            <div id="save" class="box"><input type="submit" value="Edit" name="submit" class="btn btn-success" /></div>
        </form>
    </div>
    </div>

        
    
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>