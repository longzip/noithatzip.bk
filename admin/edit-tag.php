 <?php

	if(!defined('SECURE_CHECK')) die('Stop');
    
    if(!user_can('edit-tag')) die();
   
   
   if(!isset($_GET['tag_id'])) die('tag_id not defined !');
    
    if(!is_numeric($_GET['tag_id'])) die('tag_id invalid !');
   
    $tag_id = $_GET['tag_id'];
    
    $tag_info = get_tag($tag_id, ' * '); 
    
    if($tag_info == FALSE ) die('Tag not found');
    
    $page_type = 'tag';
    $post_type_id = 'tag';
    
    foreach($tag_info as $k=>$post_value)
    {
        $default_value[$k] = $post_value;
    }
    //h($default_value);
	 
    if(isset($_POST['submit']))
    {
       
        $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\'tag\' OR page_type=\'all\' ) ORDER BY stt ASC ');
        
        
        foreach($fields as $field)
        {
            $temp_post_type = json_decode($field['attribute'], TRUE);

            include 'post_type/' . $temp_post_type['field_type'] . '/fill_request_form.php';
            
             
        }
        
        ///h($g_page_info); 
        
        
        
        $insert_content['time_update'] = hcv_time();
		
		//h($insert_content);
		if($tag_info['url'] != $insert_content['url'])
        {
            if(url_exists($insert_content['url']))
            {
                $g_form_error_noti[] = '- <span class="noti-title">URL</span> đã tồn tại';
                $_POST['url'] = $insert_content['url'];  
            }
        }
		 
		if( $_POST['parent'] == $_GET['tag_id'] )
        {
            $g_form_error_noti[] = '- <span class="noti-title">Tag cha  </span> không hợp lệ';
              
        } 
		if(form_validation())
        {            
            $insert_content['time_update']  = hcv_time();
			
			models_DB::update($insert_content, TAG_TABLE, ' WHERE id='. $tag_id);
            
            $success_notification = 'Tag Updated';
            $tag_info['title'] = $_POST['title'];
            $tag_info['url'] = $_POST['url'];
		}
        
        
           
        
		  
    }
    //h($default_value);
	$g_page_content['title'] = 'Sửa tag "'. $tag_info['title'] .'"';
    $g_page_content['meta_des'] = 'Sửa tag';
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
			<div  class="box">
                <div id="bread-crumbs">
    				<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
    				<span class="arrow">›</span>
    				
    				
    				<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=tags" >Quản lý tag</a>
    				<span class="arrow">›</span>
    				
    				<span class="current-page">Sửa tag &nbsp; <a  class="link" style="font-style:italic" href="<?php hcv_url('t', $tag_info['url'], $tag_info['id']) ?>"><?php echo $default_value['title'] ?></a></span>
    		
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