<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
     
    if(!user_can('new-post-type')) die();
    
    $form_id = $_GET['form_id'];
    
    $form_info = get_form($form_id);
    
	$default_value = array(
		'name'	           	=> $form_info['name'],
        'mail_to'           => $form_info['mail_to'],
        'text_after_submit' => $form_info['text_after_submit'],
        'other1'            => $form_info['other1'], 
        'other2'            => $form_info['other2'],
        'auto_reply_content'=> $form_info['auto_reply_content'],
        'auto_reply_title'=> $form_info['auto_reply_title']
        
	);
	
    if(isset($_POST['submit']))
    {
	
    	validate_value('name','Tên Form', FALSE, array('min_lenght'=>'1'));
	 
        $insert_content['name'] = strip_tags(htmlspecialchars($_POST['name']));
        
        $insert_content['mail_to'] = $_POST['mail_to'];
        $insert_content['text_after_submit'] = $_POST['text_after_submit'];
        $insert_content['other1'] = $_POST['other1'];
        $insert_content['other2'] = $_POST['other2'];
        $insert_content['auto_reply_content'] = $_POST['auto_reply_content'];
        $insert_content['auto_reply_title'] = $_POST['auto_reply_title'];
        
        $insert_content['the_type'] = 'form';
        $insert_content['time_create'] = hcv_time(); 
        
        if(form_validation())
        {
			$insert_id = models_DB::update($insert_content, FORM_TABLE, ' WHERE id=' . $form_id);
            //if($insert_id) header('Location:' . SITE_URL . '/admin/?page_type=form');
		}
        
			
		$default_value = array(
			'name'		=> $insert_content['name'],
			'mail_to'  => $insert_content['mail_to'],
            'text_after_submit' => $insert_content['text_after_submit'],            
            'other1'            => $_POST['other1'],
            'other2'            => $_POST['other2'], //Mã chạy khi gửi form
            'auto_reply_content'            => $_POST['auto_reply_content'] ,
            'auto_reply_title'            => $_POST['auto_reply_title'] 
		);        
		
		 
    } 
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Sửa Form';
    $g_page_content['meta_des'] = 'Sửa Form';
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
                    
                    <a class="link"  href="<?php echo SITE_URL . '/admin/?page_type=form'; ?>" class="home-icon block fl">
        					Danh sách Form    			 
        			</a>
            	</div>
             </div>
         
            <div id="new-post-col-1" class="fl border-box v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
                <div id="new-post-col-1-inner">
                    
                        <div class="box">
                            <h2 class="title">Edit Form</h2>
                             <?php show_form_error() ?>
                             
                             <?php include 'inc/form-form.php' ?>
                             
                        </div>
                    
                </div>
            </div>
            
            <div id="new-post-col-2" class=" fr border-box v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
                <div id="new-post-col-2-inner" class="fixed-on-scroll">
                    <div id="save" class="box"><input type="submit" value="Save" name="submit" class="btn btn-success" /></div>
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