<?php

    $result = $global_sqli->query("SHOW COLUMNS FROM `hcv_post` LIKE 'url'"); 
    
     
     
    if(!defined('SECURE_CHECK')) die('Stop');
    
     
    if(!user_can('manager-post-type-field')) die();
    
     if(!isset($_GET['post_type_id'])) die('post_type_id not defined !');
    
    if(!is_numeric($_GET['post_type_id'])) die('post_type_id invalid !');
    
    $post_type_id = $_GET['post_type_id'];
    
	 
	 
    if($post_type_id)
    {
        $post_type_info = get_post_type($post_type_id);
    
        if($post_type_info == FALSE) die('Post type not found');
    }
    
	else
    {
        $post_type_info['name'] = $_GET['page_type'];
    }
  
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Quản lý field';
    $g_page_content['meta_des'] = 'Quản lý field';
?>

<?php
	include 'header.php'
?>
 <?php display_cdn_js('admin/js/post_type.js') ?> 
<div id="wrap-content" class="container">

   <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="fl col-10-6">
       
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
                    
                    <a class="link"  href="<?php echo SITE_URL . '/admin/?page_type=post-type'; ?>" class="home-icon block fl">
                					 
        					Danh sách post type
        			 
        			</a>
                     
            		
            	</div>
            </div>
      
       <div class="box">
            <h2 class="title">Quản lý trường cho post type "<?php echo $post_type_info['name'] ?>"</h2>
       </div>
            <?php 
                if(!isset($_GET['page_type_field']))
                {
                    $page_type_id = $post_type_id;    
                    $page_type = 'post';
                    $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE (post_type=0 OR post_type='. $post_type_id .') AND (page_type=\'all\' OR page_type=\'post\') AND (init!=1) ORDER BY stt ASC');
                } 
                else
                {
                    $page_type_id = $_GET['page_type_field'];
                    $page_type = $page_type_id;
                    $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE   (page_type=\'all\' OR page_type=\'' . $page_type_id . '\') AND (init!=1) ORDER BY stt ASC');
                
                }
            ?>
             <div id="content" page_type="<?php echo $page_type ?>" post_type_id="<?php echo $page_type_id ?>" class="box fl current-post-types fl sortable">
                   <?php 
                    
                    $temp = array('post_type'=>$post_type_id, 'init'=>0);
                    
                    //h($fields);
                    
                    foreach($fields as $field)
                    {
                        $field_id = $field['id'];
                        $temporary_setting_parameter = json_decode($field['attribute'], TRUE); 
                    ?>
                    
                    <div field_id="<?php echo $field['id'] ?>" id="field-<?php echo $field_id ?>" class="field" field_type="<?php echo $temporary_setting_parameter['field_type'] ?>">
                        <div class="field_title">
                            <span class="title-area"><?php echo $temporary_setting_parameter['title'] ?></span>
							<i class="fa fa-sort-desc fr"></i>
							<span class="fr title-file-type"><?php echo $temporary_setting_parameter['field_type'] ?></span>
						</div>
                        
                        <div class="field_content">
                    <?php
                        include 'post_type/'.$temporary_setting_parameter['field_type']. '/setting_form.php';
                        ?>
                        <div class="tab-display-wrap">
                            <label>Tab display : </label>
                            
                            <select class="tab-display">
                                <option <?php if($field['tab_display']=='other') echo ' selected ' ?> value="other">Other</option>
                                <option <?php if($field['tab_display']=='general') echo ' selected ' ?> value="general">General</option>
                                <option <?php if($field['tab_display']=='seo') echo ' selected ' ?> value="seo">SEO</option>
                            </select>
                            
                            <span class="clear"></span>
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <span class="btn btn-info update">Update</span>
                        <span class="delete  delete-field btn btn-danger">Delete</span>
                        </div>
                         </div>
                        <?php
                    }
                 ?>
                
                
            </div>
            
            <section class="fl" id="list-post-type">
                <ul style="position: relative;">
                <?php 
                    $post_types = scandir( PATH_ROOT . '/admin/post_type');
                    $num_post_type = count($post_types);
                    for($i=2;$i<$num_post_type;$i++)
                    {
                        $file_type = pathinfo($post_types[$i]);
                        ?>
                        <li field_id="0" class="draggable" field_type="<?php  echo $file_type['filename'] ?>"><?php  echo $file_type['filename'] ?></li>
                        <?php
                    }
                ?>
                </ul>
            </section>
    </div>
    </div>

        
    
    <span class="clear"></span>
</div>






<?php
	include 'footer.php' 
?>