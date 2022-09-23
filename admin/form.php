<?php

    if(!user_can('post-type')) die();
  
  
	$g_page_content['title'] = 'All Form';
?>

<?php
	include 'header.php';
?>
<script src="<?php echo CDN_DOMAIN . '/admin/js/form.js' ?>"></script>
<div id="" class="container"> 

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
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
            <h1 class="h1-title">All Form  
            
            <div class="fr inline-block posts-action">
                     <a title="Thêm mới" class="posts-new-post  " href="<?php echo SITE_URL . '/admin/?page_type=new-form' ?>"><i class="fa fa-plus"></i></a>
                </div>
            </h1>
        </div>
    <div class="box">
       <div class="">
	
        
    	   
    	   <span class="clear"></span>
    	<?php 
    	
    		$list_posts = get_forms(array('the_type'=>'form'));
    		
    		 
    		foreach($list_posts as $list_post)
    		{
    		
    			if(empty($list_post['image'])) $image_link = TEMPLATE_URL . '/images/noimage.png';
    			else $image_link = $list_post['image'];
    			?>
    			<div class="list-thread-item border-left-hover">
                    
                    
    				<a class="thread-name" href="<?php echo SITE_URL ?>/admin/?page_type=edit-form&form_id=<?php echo $list_post['id'] ?>">
    					<?php echo $list_post['name'] ?>
    				</a>
    				
    				<p class="list-thread-item-des">
    					<a href="<?php echo SITE_URL ?>/admin/?page_type=list-order&id=<?php echo $list_post['id'] ?>">
        					Danh sách
        				</a>
                        <a class="view" href="<?php echo SITE_URL,'/admin/?page_type=manager-form-field&form_id=', $list_post['id'] ?>">Manager field</a>
    					<a class="edit" href="<?php echo SITE_URL ?>/admin/?page_type=edit-form&form_id=<?php echo $list_post['id'] ?>">Sửa</a>
    					&nbsp;&nbsp;&nbsp;&nbsp;
    					<a class="delete delete-form" post_id="<?php echo $list_post['id'] ?>" href="<?php echo SITE_URL ?>/admin/delete-form/<?php echo $list_post['id'] ?>">Xóa</a>
    				</p>
    				
    				<span class="clear"></span>
    			</div>
    			<?php
    		}
    	?>
       <span class="clear"></span>
       																																																																																																																																																																																			
    	<span class="clear"></span>
           </div>
        </div>
        <span class="clear"></span>
    </div>
    </div>
    
        
    