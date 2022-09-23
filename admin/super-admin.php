<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
	$g_page_content['title'] = 'Dashboard';

    
?>

<?php
	include 'header.php';
?>

<div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
<div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
    <div id="home">
		<?php
            if(user_can('posts'))
            {
         
    			$post_types = get_post_types();
                 
                foreach($post_types as $post_type)
                {
                    $count = get_posts( array('field'=>'COUNT(id) AS total', 'post_type'=>$post_type['id'], 'limit'=> '  ') );
                    $count = $count[0]['total'];
    				?>
                    <div style="margin-top: 0;" class="border-box home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12 ">
                        <div class="home-group-inner">
                            <div class="title">
                            <a href="<?php echo SITE_URL . '/admin/?page_type=posts&post_type_id='.$post_type['id']; ?>" class="home-icon block">
            					 <?php echo $post_type['name'] ?>  <span class="count">( <?php echo $count ?> )</span> 
            				</a> 
                            
                            </div>
        				    <div class="image">
                                <a href="<?php echo SITE_URL . '/admin/?page_type=posts&post_type_id='.$post_type['id']; ?>" class="home-icon block">
                					 <img src="<?php cnd_timthumb_url($post_type['image'], 100, 100) ?>" />
                				</a>                            
                            </div>
                            
                            <div class="action clearfix">
                				<a  href="<?php echo SITE_URL . '/admin/?page_type=posts&post_type_id='.$post_type['id']; ?>" class="border-box  home-action-1 home-icon block">
                					    <i class="fa fa-list-ul"></i>
                						Qu?n lý 
                				 
                				</a>
                				
                				<a href="<?php echo SITE_URL . '/admin/?page_type=new-post&post_type_id='.$post_type['id']; ?>" class="border-box  home-action-2 block home-icon">
          					             <i class="fa fa-plus"></i>
                						Thêm m?i
                					 
                				</a>
                            </div>
        				    <span class="clear"></span>
                        </div>
    				 </div>
                     
    				<?php
    			}
            }
		?>
			  
			  <span class="clear"></span>
              
            <?php
            if(user_can('categories'))
            {
                $count = get_categories( array('field'=>'COUNT(id) AS total', 'post_type'=>$post_type['id'], 'limit'=> '  ') );
                $count = $count[0]['total'];
                
                ?>
			<div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=categories' ?>" class="home-icon block">
        					 Chuyên m?c  <span class="count">( <?php echo $count ?> )</span> 
        				</a>
                    </div>
                    
    			    <div class="image">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=categories' ?>" class="home-icon block">
        					 <img src="<?php cnd_timthumb_url(CDN_DOMAIN . '/inc/images/post-type-category.png', 100, 100) ?>" />
        				</a>
                    
                    </div>
                    
                    <div class="action">
        				<a href="<?php echo SITE_URL . '/admin/?page_type=categories' ?>" class="home-icon block border-box  home-action-1">
        					   <i class="fa fa-list-ul"></i>
        						
                                Qu?n lý 
        				 
        				</a>
        				
        				<a href="<?php echo SITE_URL . '/admin/?page_type=new-category' ?>" class="home-icon block border-box  home-action-2">
        					   <i class="fa fa-plus"></i>
        						Thêm m?i
        					 
        				</a>
                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
            
            <?php
                $count = get_tags( array('field'=>'COUNT(id) AS total', 'post_type'=>$post_type['id'], 'limit'=> '  ') );
                $count = $count[0]['total'];
            ?>
            
            
            <div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title">
                    <a href="<?php echo SITE_URL . '/admin/?page_type=tags' ?>" class="home-icon block">
    					Tag  <span class="count">( <?php echo $count ?> )</span> 
    				</a>
                    </div>
    			    <div class="image">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=tags' ?>" class="home-icon block">
        					 <img src="<?php cnd_timthumb_url( CDN_DOMAIN . '/inc/images/post-type-tag.png', 100, 100) ?>" />
        				</a>                    
                    </div>
                    
                    <div class="action">
        				<a href="<?php echo SITE_URL . '/admin/?page_type=tags' ?>" class="home-icon block border-box  home-action-1"><i class="fa fa-list-ul"></i>Qu?n lý</a>
        				
        				<a href="<?php echo SITE_URL . '/admin/?page_type=new-tag' ?>" class="home-icon block border-box  home-action-2">
        					   <i class="fa fa-plus"></i>
        						Thêm m?i
        					 
        				</a>
                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
             
             <?php
            }
            ?>
             
            <span class="clear"></span>
            
            <?php
            if(user_can('order'))
            {
                ?>
			<div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title"><a href="<?php echo SITE_URL . '/admin/?page_type=order' ?>" class="home-icon block">Ðon hàng</a></div>
    			    <div class="image">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=order' ?>" class="home-icon block">
                            <img src="<?php cnd_timthumb_url(CDN_DOMAIN . '/inc/images/cart.png', 100, 100) ?>" />
                        </a>
        				
                        
                    </div>
                    
                    <div class="action">
        				<a href="<?php echo SITE_URL . '/admin/?page_type=order' ?>" class="home-icon block border-box  home-action-1 home-icon-only"><i class="fa fa-list-ul"></i>Qu?n lý</a>
        				
        				 
                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
			
			 
            
            <div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=notification' ?>" class="home-icon block">
        					 Thông báo
        				</a>
                    </div>
    			    <div class="image">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=notification' ?>" class="home-icon block">
        					 <img src="<?php cnd_timthumb_url(CDN_DOMAIN . '/inc/images/icon-ios7-bell-128.png', 100, 100) ?>" />
        				</a>
                        
                        <?php 
            				$notifications = models_DB::get('SELECT COUNT(id) as total_noti FROM ' . NOTIFICATION_TABLE . ' WHERE already_read=0 AND user_id='.$g_user['id']); 
            				$total_noti = 	$notifications[0]['total_noti'];
            				if($total_noti)
            				{
            					?>
           					    <span  class="noti-count"><?php echo $total_noti ?></span>
            					<?php
            				}
            			?>
                    </div>
                    
                    <div class="action">
        				<a href="<?php echo SITE_URL . '/admin/?page_type=notification' ?>" class="home-icon block border-box  home-action-1 home-icon-only">
        					 <i class="fa fa-list-ul"></i>
        						Qu?n lý 
        				 
        				</a>
        				
        				 
                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
             
             <?php 
                }
             ?>
             
             <span class="clear"></span>
                
              <?php
            if(user_can('posts'))
            {
                ?>   
             <div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title">
                        <a href="<?php echo SITE_URL . '/admin?page_type=general' ?>" class="home-icon block">Cài d?t website</a>
                    </div>
    			    <div class="image">
                    <a href="<?php echo SITE_URL . '/admin?page_type=general' ?>" class="home-icon block">
        					<img src="<?php cnd_timthumb_url(CDN_DOMAIN . '/inc/images/settings.png', 100, 100) ?>" /></div>
    				</a>
                    
                    
                    <div class="action">
        				<a  href="<?php echo SITE_URL . '/admin?page_type=general' ?>" class="home-icon block border-box  home-action-1 home-icon-only">
        					 <i class="fa fa-list-ul"></i>
        						Cài d?t
        				</a>
        				
        				 
                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
			 <div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title">
                        <a href="<?php echo SITE_URL . '/admin?page_type=library' ?>" class="home-icon block">Thu vi?n</a>
                    </div>
    			    <div class="image">
                    <a href="<?php echo SITE_URL . '/admin?page_type=library' ?>" class="home-icon block">
        					<img src="<?php cnd_timthumb_url(CDN_DOMAIN . '/inc/images/gallery.png', 100, 100) ?>" /></div>
    				</a>
                    
                    
                    <div class="action">
        				<a  href="<?php echo SITE_URL . '/admin?page_type=library' ?>" class="home-icon block border-box  home-action-1 home-icon-only">
        					 <i class="fa fa-list-ul"></i>
        						Qu?n lý 
        				 
        				</a>
        				
        				 
                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
             <?php 
             }
             ?>
             
			  <span class="clear"></span>
              
              
              
		
	</div>

</div>


 