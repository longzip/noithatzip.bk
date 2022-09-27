<?php

	if(!defined('SECURE_CHECK')) die('Stop');
    
    if(!isset($_GET['post_id'])) die('post_id not defined !');
    
    if(!is_numeric($_GET['post_id'])) die('post_id invalid !');
   
    $post_id = $_GET['post_id'];
    
    if(!user_can('edit-post', $post_id)) die();
    
    $post_info = get_post($post_id, ' * ');
     
    
    //$g_page_info['id'];
    
    if($post_info == FALSE) die('Post not found');
    
    $post_type_info = get_post_type($post_info['post_type']);
    
    
    $post_type_id = $post_type_info['id'];
    
    if($post_type_info['default_field']) $temp = array('post_type'=>$post_type_info['id']);
    else $temp = array('post_type'=>$post_type_info['id'], 'init'=>0);
    
    $page_type = 'post';
    
    foreach($post_info as $k=>$post_value)
    {
        $default_value[$k] = $post_value;
    }
    //h($default_value);
	 
    if(isset($_POST['submit']))
    {
       
        $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\'post\' OR page_type=\'all\' ) AND ( post_type=0 OR post_type=\'' . $post_type_id . '\' ) ORDER BY stt ASC ');
        
        
        foreach($fields as $field)
        {
            $temp_post_type = json_decode($field['attribute'], TRUE);

            include PATH_ROOT . '/admin/post_type/' . $temp_post_type['field_type'] . '/fill_request_form.php';
        }
         
		if($post_info['url'] != $insert_content['url'])
        {
            if(url_exists($insert_content['url']))
            {
                $g_form_error_noti[] = '- <span class="noti-title">URL</span> đã tồn tại';
                $_POST['url'] = $insert_content['url'];      
            }
            
        }
		
		 
		
		if(form_validation())
        {          
            
            // STATISTIC
            $old_content = get_post($post_id);
            $insert_to_statistic = array(
                'the_type'      => 'edit-post',
                'content'       => json_encode($insert_content), 
                'old_content'   => json_encode($old_content), 
                'time_create'   => hcv_time(),
                'user_id'       => USER_ID
            );
            models_DB::insert( $insert_to_statistic, STATISTIC_TABLE );
            // #end STATISTIC
            
            //$insert_content['time_update']  = hcv_time();
            //$insert_content['url'] = pretty_string($insert_content['url']);
            
            //if(!empty($insert_content['gia'])) $insert_content['gia'] = price_to_num($insert_content['gia']);
            //if(!empty($insert_content['gia_km'])) $insert_content['gia_km'] = price_to_num($insert_content['gia_km']);
            
			models_DB::update($insert_content, POST_TABLE, ' WHERE id=' . $post_id);
            $success_notification = 'Post Updated';
            $post_info['url'] = $_POST['url'];
            
            //header('Location:'.SITE_URL. '/admin/?page_type=edit-post&post_id='.$post_id);
            
        }
        
        
		  
    }
    //h($default_value);
	$g_page_content['title'] = 'Sửa bài viết';
    $g_page_content['meta_des'] = 'Sửa bài viết';
?>

<?php
	include 'header.php';
    
    //h($default_value);
?>

<script type="text/javascript">
  
  function confirmExit()
  {
    return "Bạn có thật sự muốn thoát ? ";
  }
  
  $(document).ready(function(){
	
	window.onbeforeunload = null;
	  
	$("#save").mouseenter(function(){
		window.onbeforeunload = null;		
	});
	
	$("#save").mouseleave(function(){
		window.onbeforeunload = confirmExit;
	});
    
    $("body").keyup(function(){
		window.onbeforeunload = confirmExit;
	});
    
  });
 
</script>



<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
    
        <div id="main-content" class=" ">
			
			<div class="box">
                <div id="bread-crumbs" >
    				<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
    				<span class="arrow">›</span>
    				
    				
    				<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=posts&post_type_id=<?php echo $post_type_info['id'] ?>" >Danh sách "<?php echo $post_type_info['name'] ?>"</a>
    				<span class="arrow">›</span>
    				
    				<span class="current-page">Sửa bài viết &nbsp; <a  class="link" style="font-style:italic" href="<?php hcv_url('p', $post_info['url'], $post_info['id']) ?>"><?php echo $default_value['title'] ?></a></span>
    				 <a class="link fr" target="_blank" href="<?php echo SITE_URL ?>/admin/?page_type=new-post&coppy_id=<?php echo $post_info['id'] ?>" >Coppy</a>
    			</div>
            </div>
             
            
           <form action="" method="POST"  id="post-form">
            <div class="box"> 
             <?php 
                    if(!empty($success_notification))
                    {
                        ?>
                        <div style="" class="success-noti">
                            <?php echo $success_notification ?>
                        </div><br />
                        <?php
                    }
                 ?>
            
                 <?php show_form_error() ?>
                 
                  
                 
                <?php include 'inc/post-form.php'    ?>
                
                
            </div>
            
            
            
        </form>
        </div>
    </div>
        
    
    </div>
    
  
    
    <span class="clear"></span>

<?php
	include 'footer.php' 
?>