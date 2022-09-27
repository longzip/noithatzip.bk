<?php

	models_DB::insert(array('name'=>'post_count', 'value'=> 4), CONFIG_TABLE);

    if(!user_can('post-type')) die();
  
  
	$g_page_content['title'] = 'All Post Type';
?>

<?php
	include 'header.php';
?>

<div id="" class="container">

   <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="fl col-10-6">
    <div class="box">
    
            <h1 class="h1-title">All Post Type  
                <div class="fr inline-block posts-action">
                     <a title="Thêm mới" class="posts-new-post  " href="<?php echo SITE_URL . '/admin/?page_type=new-post-type' ?>"><i class="fa fa-plus"></i></a>
                </div>
            </h1>
             
            
            
               <div class="box">
        	
            
        	   
        	   <span class="clear"></span>
        	<?php 
        	
        		
                
        		
        		
        		$list_posts = models_DB::get('SELECT * FROM ' . POST_TYPE_TABLE);
        		
        		 
        		
        		//h($total);
        		
        	 
        		 
        		foreach($list_posts as $list_post)
        		{
        		
        			if(empty($list_post['image'])) $image_link = TEMPLATE_URL . '/images/noimage.png';
        			else $image_link = $list_post['image'];
        			?>
        			<div class="list-thread-item border-left-hover">
        				 
        				<a class="thread-name" href="<?php echo SITE_URL ?>/admin/?page_type=edit-post-type&post_type_id=<?php echo $list_post['id'] ?>">
        					<?php echo $list_post['name'] ?>
        				</a>
        				
        				<p class="list-thread-item-des">
        					<a class="view" href="<?php echo SITE_URL,'/admin/?page_type=manager-post-type-field&post_type_id=', $list_post['id'] ?>">Manager field</a>
        					<a class="edit" href="<?php echo SITE_URL ?>/admin/?page_type=edit-post-type&post_type_id=<?php echo $list_post['id'] ?>">Sửa</a>
        					&nbsp;&nbsp;&nbsp;&nbsp;
        					<a class="delete delete-post-type" post_id="<?php echo $list_post['id'] ?>" href="<?php echo SITE_URL ?>/admin/delete-post-type/<?php echo $list_post['id'] ?>">Xóa</a>
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
        
    