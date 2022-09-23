<?php

	if(!defined('SECURE_CHECK')) die('Stop');
    
    if(!user_can('edit-category')) die();
   
    if(!isset($_GET['category_id'])) die('category_id not defined !');
    
    if(!is_numeric($_GET['category_id'])) die('category_id invalid !');
   
    $category_id = $_GET['category_id'];
   
    $category_info = get_category($category_id, ' * ');
    
    if($category_info == FALSE ) die('Category not found');
    
     
    
    $page_type = 'category';
    $post_type_id = 'category';
    foreach($category_info as $k=>$post_value)
    {
        $default_value[$k] = $post_value;
    }
    //h($default_value);
    $g_page_content['title'] = 'Sửa chuyên mục "' . $category_info['title'] .'"';
    $g_page_content['meta_des'] = 'Sửa chuyên mục';
    
    if(isset($_POST['submit']))
    {
       
        $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\'category\' OR page_type=\'all\' ) ORDER BY stt ASC ');
        
        
        foreach($fields as $field)
        {
            $temp_post_type = json_decode($field['attribute'], TRUE);

            include 'post_type/' . $temp_post_type['field_type'] . '/fill_request_form.php';
            
             
        }
        
        ///h($g_page_info); 
        
        
        
        $insert_content['time_update'] = hcv_time();
		
		//h($insert_content);
		
		 if($category_info['url'] != $insert_content['url'])
        {
            if(url_exists($insert_content['url']))
            {
                $g_form_error_noti[] = '- <span class="noti-title">URL</span> đã tồn tại';
                $_POST['url'] = $insert_content['url'];  
            }
        }
        
        if( $_POST['parent'] == $_GET['category_id'] )
        {
            $g_form_error_noti[] = '- <span class="noti-title">Chuyên mục cha  </span> không hợp lệ';
              
        } 
		
		if(form_validation())
        {            
            
            $insert_content['time_update']  = hcv_time();
			models_DB::update($insert_content, CATEGORY_TABLE, ' WHERE id= '. $category_id);
            $success_notification = 'Category Updated';
            $g_page_content['title'] = 'Sửa chuyên mục "' . $_POST['title'] .'"';
            $category_info['url'] = $_POST['url'];
		}
        
         
		  
    }
    //h($default_value);
	
?>

<?php
	include 'header.php';
    
    //h($default_value);
?>




<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
			
			<div class="box">
                <div id="bread-crumbs"  >
    				<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
    				<span class="arrow">›</span>
    				
    				
    				<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=categories" >Quản lý chuyên mục</a>
    				<span class="arrow">›</span>
    				
    				<span class="current-page">Sửa Chuyên mục &nbsp; <a  class="link" style="font-style:italic" href="<?php hcv_url('c', $category_info['url'], $category_info['id']) ?>"><?php echo $default_value['title'] ?></a></span>
    		
    			</div>
            </div>
              
        <form action="" method="POST" id="post-form">
                <div class="box">
                      <?php show_form_error();  
                        if(!empty($success_notification))
                        {
                            ?>
                            <div style="" class="success-noti">
                                <?php echo $success_notification ?>
                            </div><br />
                            <?php
                        }
                        include 'inc/post-form.php'    ?>
                    
                    
                </div>
                
                
            </form>
        
        </div>
    </div>
        
    
    </div>
    
  
    
    <span class="clear"></span>

<?php
	include 'footer.php' 
?>