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

                    if(empty($post_type['image'])) $post_type['image'] = '';
                    $count = get_posts( array('field'=>'COUNT(id) AS total', 'post_type'=>$post_type['id'], 'limit'=> '  ', 'schedule'=>'1') );
                    $count = $count[0]['total'];
                    if( !file_exists(str_replace(SITE_URL, CLIENT_ROOT, $post_type['image'] )) ) $post_type['image'] = CDN_DOMAIN . '/admin/images/post-type-news.png';
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
                					 <img src="<?php cdn_timthumb_url($post_type['image'], 100, 100) ?>" />
                				</a>
                            </div>

                            <div class="action clearfix">
                				<a  href="<?php echo SITE_URL . '/admin/?page_type=posts&post_type_id='.$post_type['id']; ?>" class="border-box  home-action-1 home-icon block">
                					    <i class="fa fa-list-ul"></i>
                						Quản lý

                				</a>

                				<a href="<?php echo SITE_URL . '/admin/?page_type=new-post&post_type_id='.$post_type['id']; ?>" class="border-box  home-action-2 block home-icon">
          					             <i class="fa fa-plus"></i>
                						Thêm mới

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
                $count = get_categories( array('field'=>'COUNT(id) AS total, id', 'post_type'=>$post_type['id'], 'limit'=> '  ') );
                $count = $count[0]['total'];

                ?>
			<div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=categories' ?>" class="home-icon block">
        					 Chuyên mục  <span class="count">( <?php echo $count ?> )</span>
        				</a>
                    </div>

    			    <div class="image">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=categories' ?>" class="home-icon block">
        					 <img src="<?php cdn_timthumb_url(CDN_DOMAIN . '/inc/images/post-type-category.png', 100, 100) ?>" />
        				</a>

                    </div>

                    <div class="action">
        				<a href="<?php echo SITE_URL . '/admin/?page_type=categories' ?>" class="home-icon block border-box  home-action-1">
        					   <i class="fa fa-list-ul"></i>

                                Quản lý

        				</a>

        				<a href="<?php echo SITE_URL . '/admin/?page_type=new-category' ?>" class="home-icon block border-box  home-action-2">
        					   <i class="fa fa-plus"></i>
        						Thêm mới

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
        					 <img src="<?php cdn_timthumb_url(CDN_DOMAIN . '/inc/images/post-type-tag.png', 100, 100) ?>" />
        				</a>
                    </div>

                    <div class="action">
        				<a href="<?php echo SITE_URL . '/admin/?page_type=tags' ?>" class="home-icon block border-box  home-action-1"><i class="fa fa-list-ul"></i>Quản lý</a>

        				<a href="<?php echo SITE_URL . '/admin/?page_type=new-tag' ?>" class="home-icon block border-box  home-action-2">
        					   <i class="fa fa-plus"></i>
        						Thêm mới

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
			<div class="home-group none fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title"><a href="<?php echo SITE_URL . '/admin/?page_type=order' ?>" class="home-icon block">Đơn hàng</a></div>
    			    <div class="image">
                        <a href="<?php echo SITE_URL . '/admin/?page_type=order' ?>" class="home-icon block">
                            <img src="<?php cdn_timthumb_url(CDN_DOMAIN . '/inc/images/cart.png', 100, 100) ?>" />
                        </a>


                    </div>

                    <div class="action">
        				<a href="<?php echo SITE_URL . '/admin/?page_type=order' ?>" class="home-icon block border-box  home-action-1 home-icon-only"><i class="fa fa-list-ul"></i>Quản lý</a>


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
        					 <img src="<?php cdn_timthumb_url(CDN_DOMAIN . '/inc/images/icon-ios7-bell-128.png', 100, 100) ?>" />
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
        						Quản lý

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
                        <a href="<?php echo SITE_URL . '/admin?page_type=general' ?>" class="home-icon block">Cài đặt tổng quan</a>
                    </div>
    			    <div class="image">
                    <a href="<?php echo SITE_URL . '/admin?page_type=general' ?>" class="home-icon block">
        					<img src="<?php cdn_timthumb_url(CDN_DOMAIN . '/inc/images/settings.png', 100, 100) ?>" /></div>
    				</a>


                    <div class="action">
        				<a  href="<?php echo SITE_URL . '/admin?page_type=general' ?>" class="home-icon block border-box  home-action-1 home-icon-only">
        					 <i class="fa fa-list-ul"></i>
        						Cài đặt
        				</a>


                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
			 <div class="home-group fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-12">
                <div class="home-group-inner">
                    <div class="title">
                        <a href="<?php echo SITE_URL . '/admin?page_type=library' ?>" class="home-icon block">Thư viện</a>
                    </div>
    			    <div class="image">
                    <a href="<?php echo SITE_URL . '/admin?page_type=library' ?>" class="home-icon block">
        					<img src="<?php cdn_timthumb_url(CDN_DOMAIN . '/inc/images/gallery.png', 100, 100) ?>" /></div>
    				</a>


                    <div class="action">
        				<a  href="<?php echo SITE_URL . '/admin?page_type=library' ?>" class="home-icon block border-box  home-action-1 home-icon-only">
        					 <i class="fa fa-list-ul"></i>
        						Quản lý

        				</a>


                    </div>
    			    <span class="clear"></span>
                </div>
			 </div>
             <?php
             }
             ?>

			  <span class="clear"></span>

              <div class=" clearfix" id="home-footer">
                    <div id="home-footer-1" class="home-footer-col fl border-box v-col-lg-12 v-col-md-12 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                        <h2 class="home-footer-title">Tiện ích</h2>
                        <div class="home-footer-content clearfix">
                        <?php
                             $list_extensions = scandir(PATH_ROOT . '/extensions' );
                            unset($list_extensions[0], $list_extensions[1]);
                            foreach($list_extensions as $k=>$list_extension)
                            {
                                if($list_extension == 'old') continue;
                                if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/title.txt' ) )
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/title.txt', "r") or die("Unable to open file!");
                                    $extension_title = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/title.txt'));
                                    fclose($myfile);
                               }
                               else $extension_title = $list_extension;

                               if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/description.txt' ) )
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/description.txt', "r") or die("Unable to open file!");
                                    $extension_description = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/description.txt'));
                                    fclose($myfile);
                               }
                               else $extension_description = '';

                               if( file_exists( PATH_ROOT . '/extensions/' . $list_extension . '/price.txt' ) )
                               {
                                    $myfile = fopen( PATH_ROOT . '/extensions/' . $list_extension . '/price.txt', "r") or die("Unable to open file!");
                                    $extension_price = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $list_extension . '/price.txt'));
                                    fclose($myfile);
                               }

                               ?>
                               <div class="extension-item border-box fl">
                                    <div  class="extension-item-inner">
                                    <a href="<?php echo SITE_URL ?>/admin/?page_type=extension-setting&extension=<?php echo $list_extension ?>" class="extension-item-title block">
                                        <?php echo $extension_title ?>
                                    </a>
                                    <div class="extension-description">
                                        ( <?php echo $extension_description ?> )
                                    </div>
                                     <a href="<?php echo SITE_URL ?>/admin/?page_type=extension-setting&extension=<?php echo $list_extension ?>" class="extension-item-title">
                                        <img src="<?php cdn_timthumb_url( CDN_DOMAIN . '/admin/images/extension-' . $list_extension . '.png', 100, 100 )  ?>" />
                                    </a>

                                    <?php
                                        if(empty($extension_price))
                                        {
                                            ?>
                                            <span class="extension-price mien-phi">
                                            Miễn phí</span>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="extension-price">
                                            <?php echo num_to_price($extension_price) ?><sup>vnđ</sup></span>
                                            <?php
                                        }

                                    ?>
                                     </div>
                                </div>


                               <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div id="home-footer-2" class="none home-footer-col fl border-box v-col-lg-12 v-col-md-12 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                        <h2 class="home-footer-title">ZLAND - Trung tâm hỗ trợ khách hàng</h2>
                        <div class="home-footer-content">
                            <img src="<?php echo CDN_DOMAIN ?>/admin/images/zland-support.png" />

                        </div>
                    </div>
                    
                </div>

                 <?php
            if( isset($_COOKIE['superadmin']))
            {
                ?>
             <div class="superadmin box">
                <p><a href="?page_type=template">Template</a></p>
                <p><a href="?page_type=block-manager">Block Manager</a></p>
                <p><a href="?page_type=extension-manager">Extension Manager</a></p>
             </div>
             <?php
             }
             ?>


	</div>

</div>

<span class="clear"></span>
