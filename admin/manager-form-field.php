<?php

    $result = $global_sqli->query("SHOW COLUMNS FROM `hcv_post` LIKE 'url'"); 
     
    if(!defined('SECURE_CHECK')) die('Stop');
    
     
    if(!user_can('manager-post-type-field')) die();
    
     if(!isset($_GET['form_id'])) die('form_id not defined !');
    
    if(!is_numeric($_GET['form_id'])) die('form_id invalid !');
    
    $form_id = $_GET['form_id'];
    
    if($form_id)
    {
        $form_info = get_form($form_id);
    
        if($form_info == FALSE) die('Form not found');
    }
    
	else
    {
        $form_info['name'] = $_GET['page_type'];
    }
  
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Quản lý field';
    $g_page_content['meta_des'] = 'Quản lý field';
?>

<?php
	include 'header.php'
?>

<style>
.file-CheckboxCategory,
.file-CheckboxTag,
.file-HtmlMulti ,
.file-ImageMulti ,
.file-SelectCategory ,
.file-SelectTag ,
.file-TextMulti ,
.file-capcha ,
.file-date ,
.file-media ,
.file-seo ,
.file-slug ,
.file-template ,
.file-time{
    display:none;
}
</style>

<script src="<?php echo CDN_DOMAIN . '/admin/js/form.js' ?>"></script>
<div id="wrap-content" class="container">

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
          
           <div class="box">
                <h2 class="title">Quản lý trường cho Form "<?php echo $form_info['name'] ?>"</h2>
           </div>
                <?php 
                    $page_type_id = $form_id;
                    $page_type = 'form';
                    $fields = get_forms( array('field_form'=>$form_id, 'the_type'=>'field', 'order'=> ' ORDER BY field_stt ASC ') );
                ?>
                 <div id="content" page_type="<?php echo $page_type ?>" form_id="<?php echo $form_id ?>" class="box fl current-post-types fl sortable">
                       <?php 
                        
                        //$temp = array('post_type'=>$form_id, 'init'=>0);
                        
                        foreach($fields as $field)
                        {
                            $field_id = $field['id'];
                            $temporary_setting_parameter = json_decode($field['field_attribute'], TRUE); 
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
                    <ul  style="position: relative;">
                    <?php 
                        $post_types = scandir( PATH_ROOT . '/admin/post_type');
                        $num_post_type = count($post_types);
                        for($i=2;$i<$num_post_type;$i++)
                        {
                            $file_type = pathinfo($post_types[$i]);
                            ?>
                            <li field_id="0" class="draggable file-<?php  echo $file_type['filename'] ?>" field_type="<?php  echo $file_type['filename'] ?>"><?php  echo $file_type['filename'] ?></li>
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