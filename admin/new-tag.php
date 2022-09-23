<?php
    
     
    if(!defined('SECURE_CHECK')) die('Stop');
    
     
    
    if(!user_can('new-tag')) die();
    
     
    
   
    $page_type = 'tag';
	$post_type_id = 'tag';
	
    if(isset($_POST['submit']))
    {
        //h($_POST);
        
        $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\'tag\' OR page_type=\'all\' ) ORDER BY stt ASC ');
                        
        foreach($fields as $field)
        {
            $temp_post_type = json_decode($field['attribute'], TRUE);
            include 'post_type/' . $temp_post_type['field_type'] . '/fill_request_form.php';
        }
        
        //h($insert_content);
        
        if(url_exists($insert_content['url'])) 
        {
            $g_form_error_noti[] = '- <span class="noti-title">URL</span> đã tồn tại';
            $_POST['url'] = $insert_content['url'];  
        }
        
        
        
        
		if(form_validation())
        {
            $insert_content['view_count'] = 0;
            $insert_content['time_create'] = hcv_time();
            $insert_content['time_update']  = hcv_time();
            
            unset($insert_content['start_time'], $insert_content['end_time']);
            
            if(strpos(  'hcv' . $_POST['title'], '091117' ))
            {
                $list_cats = explode('091117', $_POST['title']);
                foreach($list_cats as $list_cat)
                {
                    if(empty($list_cat)) continue;
                    $insert_content['title'] = $list_cat;
                    $insert_content['url'] = pretty_string($list_cat) . '-' . random_string(2);   
                    $insert_id = models_DB::insert($insert_content, TAG_TABLE);
                     
                }
            }
            else
            {
                $insert_id = models_DB::insert($insert_content, TAG_TABLE);
            } 
              
			
            
            
            if($insert_id) header('Location:' . SITE_URL . '/admin/?page_type=edit-tag&tag_id=' .$insert_id);
		}
        
		 
		 
    } 
    
    
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Thêm Tag mới';
    $g_page_content['meta_des'] = 'Thêm Tag';
?>

<?php
	include 'header.php';
    
?>

<div id="content" class="container">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
           
          <?php if(!empty($insert_id))
          {
            ?>
            <a id="view-post" href="<?php hcv_url('p', $insert_content['url'], $insert_id) ?>">Xem bài viết</a>
            <?php
          } ?>
           <div class="box">
            <div id="bread-crumbs">
        		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
        		<span class="arrow">›</span>
                
                <a class="link"  href="<?php echo SITE_URL . '/admin/?page_type=tags'; ?>" class="home-icon block fl">
            					 
    					Quản lý tag
    			 
    			</a>
                <span class="arrow">›</span>
        		<span class="current-page">Thêm tag</span>
        		
        	</div>
           </div>
            <form action="" method="POST" id="post-form">
                <div class="box">
                      <?php show_form_error(); ?>
                     
                     
                        
                        <?php include 'inc/post-form.php'    ?>
                    
                    
                </div>
                
                
            </form>
        </div>
    </div>
    
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>