<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
    if(!user_can('new-post')) die();
    
	if(isset($_GET['coppy_id']))
    {
        
        $ori_post = get_post($_GET['coppy_id']);
												
		if($ori_post == FALSE ) echo '<span style="color:red">Bài viết gốc bạn vừa nhập không tồn tại</span>';
		else
		{
			unset($ori_post['id']);
			
			for($i=0;$i<1;$i++)
			{
				$j = $i + 1;
				$coppy_content = $ori_post;
				$coppy_content['title'] = $ori_post['title'] . ' - Coppy ' . $j ;
				$coppy_content['url'] = random_string() . '-' . hcv_time();
				$coppy_content['time_create'] = hcv_time();
				//$coppy_content['time_update'] = hcv_time();

				$insert_id = insert_post($coppy_content, $header=FALSE);
                
                $block_areas = models_DB::get('SELECT * FROM ' . BLOCK_AREA_TABLE . ' WHERE page_type=\'post\' AND page_id=' . $_GET['coppy_id'] );
				foreach($block_areas as $block_area)
                {
                    $new_block_area_content = '';
                    
                    if(empty($block_area['content'])) continue;
                    
                    $list_blocks = explode(',', $block_area['content']);
                    foreach($list_blocks as $list_block)
                    {
                        $block = models_DB::get('SELECT * FROM ' . BLOCK_TABLE . ' WHERE  id=' . $list_block );
                        if(empty($block)) continue;
                        $block = $block[0];
                        unset($block['id']);
                        $block_id = models_DB::insert($block, BLOCK_TABLE);
                        if(empty($new_block_area_content)) $new_block_area_content = $block_id;
                        else $new_block_area_content = $new_block_area_content . ',' . $block_id;
                    }
                    
                    $new_area_content = array(
                        'name'          =>  str_replace($_GET['coppy_id'] , $insert_id, $block_area['name']  ),
                        'url'           =>  str_replace($_GET['coppy_id'] , $insert_id, $block_area['url']  ),
                        'content'       =>  $new_block_area_content,
                        'page_type'     => 'post',
                        'page_id'       => $insert_id
                    );
                    
                    models_DB::insert($new_area_content, BLOCK_AREA_TABLE);
                }
				
			}
            
            
            
            header('Location:'.SITE_URL. '/admin/?page_type=edit-post&post_id='.$insert_id);
        }
        die();
    }
	
    if(!isset($_GET['post_type_id'])) die('post_type_id not defined !');
    
    if(!is_numeric($_GET['post_type_id'])) die('post_type_id invalid !');
    
    
    $post_type_id = $_GET['post_type_id']; 
    
    $post_type_info = get_post_type($post_type_id);
    
    if($post_type_info == FALSE) die('Post type not found');
    
    
    if($post_type_info['default_field']) $temp = array('post_type'=>$post_type_id);
    else $temp = array('post_type'=>$post_type_id, 'init'=>0);
    
    $page_type = 'post';
   
	
	
    if(isset($_POST['submit']))
    {
         
        
        $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\'post\' OR page_type=\'all\' ) AND (post_type=0 OR post_type=\''. $post_type_id .'\') ORDER BY stt ASC ');
                        
        foreach($fields as $field)
        {
            $temp_post_type = json_decode($field['attribute'], TRUE);
            include PATH_ROOT . '/admin/post_type/' . $temp_post_type['field_type'] . '/fill_request_form.php';
        }
        
        //$default_value['url'] = $insert_content['url'];
        
        
        $url_add = 1;
        $ori_url = $insert_content['url'];
        /** while(url_exists($insert_content['url']))
        {
            $insert_content['url'] = $ori_url . '-' . $url_add;
        }
        **/
        
        if(url_exists($insert_content['url']))
        {
            $g_form_error_noti[] = '- <span class="noti-title">URL</span> đã tồn tại';
            $_POST['url'] = $insert_content['url'];  
        } 
        
		if(form_validation())
        {
            $insert_content['view_count'] = 0;
            //$insert_content['time_create'] = hcv_time();
            $insert_content['time_update']  = hcv_time();
            
            $insert_content['post_type'] = $post_type_id;
            
            //$insert_content['url'] = pretty_string($insert_content['url']);
            
            //if(!empty($insert_content['gia'])) $insert_content['gia'] = price_to_num($insert_content['gia']);
            //if(!empty($insert_content['gia_km'])) $insert_content['gia_km'] = price_to_num($insert_content['gia_km']);
            
			$insert_id = insert_post($insert_content, $header=FALSE);
            
           
            
            
            
            
            if($insert_id) header('Location:' . SITE_URL . '/admin/?page_type=edit-post&post_id=' .$insert_id);
		}
        
    } 
    
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Thêm bài viết mới';
    $g_page_content['meta_des'] = 'Thêm bài viết';
?>

<?php
	include 'header.php';
    
            
     
    
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

 <?php display_cdn_js('admin/js/post_form.js') ?>
<div id="content" class="container v-full-width">
    
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
         <div class="box clearfix">
            <div id="bread-crumbs">
        		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
        		<span class="arrow">›</span>
                
                <a class="link"  href="<?php echo SITE_URL . '/admin/?page_type=posts&post_type_id=' .$post_type_id; ?>" class="home-icon block fl">
            					 
    					Quản lý "<?php echo $post_type_info['name'] ?>"
    			 
    			</a>
                <span class="arrow">›</span>
        		<span class="current-page">Thêm "<?php echo $post_type_info['name'] ?>"</span>
        		
        	</div>
         </div>
         
         <div class="post-form-box clearfix">
            <?php if(!empty($insert_id))
              {
                ?>
                <a id="view-post" href="<?php hcv_url('p', $insert_content['url'], $insert_id) ?>">Xem bài viết</a>
                <?php
              } ?>
               
               
               
                <form action="" method="POST" id="post-form">
                    <div class=" clearfix inner-post-form">
                          <?php show_form_error(); ?>
                         
                            <?php  include PATH_ROOT . '/admin/inc/post-form.php'    ?>
                    </div>
                    
                    
                </form>
         </div>
    </div>
     
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>