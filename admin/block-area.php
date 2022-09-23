<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('block-area')) die('Only for admin'); 
    
    if(isset($_POST['submit']))
    { 
       
       
        
    }
	$g_page_content['title'] = 'All Block Area';
    
    
?>

<?php
	include 'header.php';
?>

<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="fl col-10-6">
        
        <div class="box">
            <div id="bread-crumbs">
    			<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
    			<span class="arrow">›</span>
    			
    			
    			<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=block-area" >Block area</a>
    		
    	
    		</div>
        </div>
    
        <div class="box">
        
        
        
        <h1>All Block Area</h1> 
        </div>
        
        <div class="box" id="forum">
            <?php 
                $block_areas = models_DB::get('SELECT * FROM ' . BLOCK_AREA_TABLE . ' ORDER BY id DESC ');
                 foreach($block_areas as $v_block_area)
				 {
					?>
					<div area_name="<?php  echo $v_block_area['url'] ?>" id="area-<?php echo $v_block_area['id'] ?>" class="forum-detail category-item border-left-hover forum-item">
						<a class="forum-title category-title" href="<?php echo SITE_URL, '/admin/?page_type=edit-block-area&block_area_id=', $v_block_area['id'] ?>"><?php echo $v_block_area['name'] ?></a>
						<div class="des"><?php echo $v_block_area['description'] ?></div>
						
						<div class="action">
							<a class="edit" href="<?php echo SITE_URL, '/admin/?page_type=edit-block-area&block_area_id=', $v_block_area['id'] ?>">Sửa</a>
							<a class="delete-block-area delete" forum_id="<?php echo $v_block_area['id'] ?>" href="<?php echo SITE_URL, '/admin/?page_type=delete-block-area&id=' . $v_block_area['id'] ?>">Xóa</a>
							<span class="get-block-area-code pointer" forum_id="<?php echo $v_block_area['id'] ?>" href="#">Lấy mã</span>
							
						</div> 
					</div>
					<?php
				 }
            ?>
			
			
        </div>
       
       
    </div>
    </div>
        
    
    <span class="clear"></span>
</div>