<?php
    if(!defined('SECURE_CHECK')) die('Stop');
    
   if(!user_can('notifications')) die();
   
    $g_page_content['title'] = 'Thông báo';
	$g_page_content['meta_des'] = 'Thông báo';
	
    
    if(!isset($_GET['page'])) $current_page = 1;
    else
    {
        
        $current_page = $_GET['page'];
    }
     
	include 'header.php';
    
    //h($default_value);
?>




<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="fl col-10-6">
       
            
            <div class="box">
				<?php 
				
				
				$posts_per_page = 10;
				
				$all_noti = models_DB::get('SELECT COUNT(id) as total_order FROM ' . NOTIFICATION_TABLE  . ' WHERE user_id='.$g_user['id']);
			 			
				 
				
				$all_noti = $all_noti[0]['total_order'];
				
				$base_link = SITE_URL . '/admin/';
				
				$notifications = models_DB::get('SELECT * FROM ' . NOTIFICATION_TABLE . ' WHERE already_read=0 AND user_id='.$g_user['id'] . ' ORDER BY id DESC '); 
					 ?>
			
                <h1 class="title-font h1-title new-thread">Thông báo mới (<span><?php echo count($notifications) ?></span>)</h1>
				
                <?php 
					foreach($notifications as $k=>$notification)
					{
						 ?>
						 <div class="wrap-noti-item" id="wrap-noti-item-<?php echo $notification['id'] ?>">
						 <?php
						 display_notification($notification);
						 ?>
						 <div class="noti-time"><?php echo hcv_real_time($notification['time_create']) ?></div>
						 <div class="noti-stt"><?php echo $k+1 ?></div>
						 </div>
						 <?php
					}
				?>
            </div>
			
			<div class="box">
			
				<?php 
				$notifications = models_DB::get('SELECT COUNT(id) as total_noti FROM ' . NOTIFICATION_TABLE . ' WHERE already_read=1 AND user_id='.$g_user['id']); 
				
				 
				
				$total_noti = 	$notifications[0]['total_noti'];
				?>
                <h1 class="title-font h1-title new-thread">Cũ hơn (<span><?php echo $total_noti ?></span>)</h1>
				
                <?php 
					$notifications = models_DB::get('SELECT * FROM ' . NOTIFICATION_TABLE . ' WHERE already_read=1 AND user_id='.$g_user['id'] . ' ' . ' ORDER BY id DESC LIMIT ' . $posts_per_page * ($current_page - 1) . ', '. $posts_per_page); 
					foreach($notifications as $k=>$notification)
					{
						 ?>
						 <div class="wrap-noti-item" id="wrap-noti-item-<?php echo $notification['id'] ?>">
						 <?php
						 display_notification($notification);
						 ?>
						 <div class="noti-time">( <?php echo hcv_real_time($notification['time_create']) ?> )</div>
						 <div class="noti-stt"><?php echo $k+1 ?></div>
						 </div>
						 <?php
					}
					
					models_DB::update(array('already_read'=>1), NOTIFICATION_TABLE, ' WHERE user_id='.$g_user['id']);
				?>
				
				<span class="clear"></span>
   <?php  
          
        $param = array(
            'base_url'          => $base_link,
            'current_page'      => $current_page,
            'total_post'        => $all_noti,
            'posts_per_page'    => POSTS_PER_PAGE 
        );  
        new_display_pagination( $param ) 
   ?>
																																																																																																																																																																																			
	<span class="clear"></span>
            </div>
            
        
             
     </div>
    </div>
        
    
</div>
    
  
    
    <span class="clear"></span>

<?php
	include 'footer.php' 
?>