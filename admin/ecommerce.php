<?php

	 
    if(!defined('SECURE_CHECK')) die('Invalid to include');
  
    if(!user_can('user')) die();
    
	$g_page_content['title'] = 'Quản trị đăng tin';
	
    
?>

<?php
    
	include 'header.php';
    include PATH_ROOT . '/inc/ecommerce/config_val.php';
?>

<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/admin/css/ecommerce.css" />
<script src="<?php echo CDN_DOMAIN ?>/admin/js/ecommerce.js"></script>

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
                    <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=ecommerce">Quản trị đăng tin</a>
            		<span class="current-page"></span>
            		
            	</div>
            </div>
        
            <div class="box">
        	
            <h1>Quản trị đăng tin</h1>
            <div class="box box-ecommerce">
                <div class="nav">
                    <div class="nav-item active" par="general">Cài đặt chung</div>
                    <div class="nav-item" par="member">Thành viên</div>
                    <div class="nav-item" par="posts">Tin đăng</div>
                    <div class="nav-item" par="billing">Cài đặt thanh toán</div>
                    <div class="nav-item" par="notifications">Thông báo</div>
                </div>
                <div class="content">
                    <div class="content-item  content-item-general active">
                        <form class="general-form">
                            <?php 
                            
                            ?>
                            <input value="edit-general-permission" name="type" type="hidden" />
                            <div class="form-item">
                                <label class="form-item-title">Số điện thoại</label>
                                
                                <div class="form-item-content">
                                    <?php
                                        
                                    ?>
                                    <input name="admin_ecommerce_phone_show" style="max-width: 100px;text-align:right" type="text" class="text" value="<?php echo $admin_ecommerce_phone_show; ?>" />
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-item-title">Phí đăng tin</label>
                                
                                <div class="form-item-content">
                                    <?php
                                        
                                    ?>
                                    <input name="admin_ecommerce_phi_dang_tin" style="max-width: 100px;text-align:right" type="text" class="text" value="<?php echo $admin_ecommerce_phi_dang_tin ?>" /> &nbsp; &nbsp; ( vnđ )
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-item-title">Phí up tin</label>
                                
                                <div class="form-item-content">
                                    <?php
                                        
                                    ?>
                                    <input name="admin_ecommerce_phi_up_tin" style="max-width: 100px;text-align:right" type="text" class="text" value="<?php echo $admin_ecommerce_phi_up_tin ?>" /> &nbsp; &nbsp; ( vnđ )
                                </div>
                            </div>
                            
                            <div class="form-item">
                                <label class="form-item-title">Yêu cầu xác thực email khi đăng ký</label>
                                <div class="form-item-content">
                                    <input <?php if($admin_ecommerce_require_register_email== 'yes') echo 'checked' ?> name="admin_ecommerce_require_register_email" type="radio" value="yes" /> Có
                                    &nbsp;&nbsp;&nbsp;
                                    
                                    <input <?php if($admin_ecommerce_require_register_email== 'no') echo 'checked' ?> name="admin_ecommerce_require_register_email" type="radio" value="no" /> Không
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                            
                            <div class="form-item">
                                <label class="form-item-title">Tin đăng cần được xét duyệt</label>
                                <div class="form-item-content">
                                    <input <?php if($admin_ecommerce_cofirm_post== 'yes') echo 'checked' ?> name="admin_ecommerce_cofirm_post" type="radio" value="yes" /> Có
                                    &nbsp;&nbsp;&nbsp;
                                    
                                    <input <?php if($admin_ecommerce_cofirm_post== 'no') echo 'checked' ?> name="admin_ecommerce_cofirm_post" type="radio" value="yes" /> Không
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                            
                            <div class="form-item">
                                <label class="form-item-title">Số ảnh tối đa cho phép upload</label>
                                <div class="form-item-content">                                     
                                    <input class="text number" name="admin_ecommerce_max_files_upload" type="number" value="<?php echo $admin_ecommerce_max_files_upload ?>" />
                                    &nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                            
                            <?php 
                                for($i=1;$i<=5;$i++)
                                {
                                    ?>
                                    <div class="form-item">
                                        <label class="form-item-title">Danh mục VIP <?php echo $i ?></label>
                                        <div class="form-item-content">          
                                            <select name="admin_ecommerce_vip<?php echo $i ?>_cat_id">      
                                            <option value="">Chưa chọn</option>                     
                                            <?php 
                                                
                                                $categories = get_categories();
                                                foreach($categories as $category)
                                                {
                                                    ?>
                                                    <option <?php if(${'admin_ecommerce_vip' . $i . '_cat_id'} == $category['id']) echo ' selected ' ?>  value="<?php echo $category['id'] ?>">
                                                        <?php 
                                                            echo $category['title']
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            ?>
                                            </select>
                                            
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Phí đăng tin
                                             
                                            <input class="text number gia" name="admin_ecommerce_vip<?php echo $i ?>_gia" type="number" value="<?php echo ${'admin_ecommerce_vip' . $i . '_gia'} ?>" /> / ngày
                                            
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                             
                        </form>
                    </div>
                    <div class="content-item  content-item-member   ">
                        <?php 
                            $users = models_DB::get(' SELECT * FROM  ' . USER_TABLE . ' ORDER BY id DESC LIMIT 50 ');
                            foreach($users as $user)
                            {
                                if(empty($user['image'])) $user['image'] = CDN_DOMAIN . '/inc/images/noimage.png';
                                if(empty($user['display_name'])) $user['display_name'] = $user['user_name'];
                                
                                $admin_ecommerce_cofirm_post = get_config('admin_ecommerce_cofirm_post_' . $user['id']);
                                if(empty($admin_ecommerce_cofirm_post)) $admin_ecommerce_cofirm_post = 'yes';
                                
                                $admin_ecommerce_max_files_upload = get_config('admin_ecommerce_max_files_upload_' . $user['id']);
                                if(empty($admin_ecommerce_max_files_upload)) $admin_ecommerce_max_files_upload = 9;
                                
                                ?>
                                
                                <div class="member-item">
                                <form class="user-setting-form user-setting-form-<?php echo $user['id'] ?>">
                                    <div class="member-item-title">
                                        <?php echo $user['display_name'] ?>
                                            <span class="member-edit" par="<?php echo $user['id'] ?>"><i class="fa fa-gear"></i></span>
                                            <div class="meta-setting meta-setting-<?php echo $user['id'] ?>">
                                                <input value="<?php echo $user['id'] ?>" type="hidden" name="user_id" />
                                                <input value="edit-user-permission" type="hidden" name="type" />
                                                <div class="form-item">
                                                    <label class="form-item-title">Tin đăng cần được xét duyệt</label>
                                                    <div class="form-item-content">
                                                        <input <?php if($admin_ecommerce_cofirm_post== 'yes') echo 'checked' ?> name="admin_ecommerce_cofirm_post" type="radio" value="yes" /> Có
                                                        &nbsp;&nbsp;&nbsp;
                                                        
                                                        <input <?php if($admin_ecommerce_cofirm_post== 'no') echo 'checked' ?> name="admin_ecommerce_cofirm_post" type="radio" value="no" /> Không
                                                        &nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                                
                                                <div class="form-item">
                                                    <label class="form-item-title">Số ảnh tối đa cho phép upload</label>
                                                    <div class="form-item-content">                                     
                                                        <input class="text number" name="admin_ecommerce_max_files_upload" type="number" value="<?php echo $admin_ecommerce_max_files_upload ?>" />
                                                        &nbsp;&nbsp;&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        
                                    </div>
                                    <div class="member-item-content clearfix">
                                        <div class="fl member-avatar">
                                            <img src="<?php echo $user['image'] ?>" />
                                        </div>
                                        <div class="fl member-info">
                                             
                                            <div class="member-info-item clearfix">
                                                <div class="fl member-info-item-title"><i class="fa fa-user"></i>ID : </div>
                                                <div class="fl member-info-item-content">
                                                    <?php echo $user['id'] ?>
                                                </div>
                                            </div>
                                            <div class="member-info-item clearfix">
                                                <div class="fl member-info-item-title"><i class="fa fa-money"></i>Điểm : </div>
                                                <div class="fl member-info-item-content">
                                                    <input name="point" type="number" value="<?php echo $user['point'] ?>" class="text" />
                                                </div>
                                            </div>
                                            <div class="member-info-item clearfix">
                                                <div class="fl member-info-item-title"><i class="fa fa-phone"></i>Số ĐT : </div>
                                                <div class="fl member-info-item-content">
                                                    <input name="phone" value="<?php echo $user['phone'] ?>" class="text" />
                                                </div>
                                            </div>
                                            <div class="member-info-item clearfix">
                                                <div class="fl member-info-item-title"><i class="fa fa-envelope"></i> Email : </div>
                                                <div class="fl member-info-item-content">
                                                    <input name="email" value="<?php echo $user['email'] ?>" class="text" /> 
                                                </div>
                                            </div>
                                            <div class="member-info-item clearfix">
                                                <div class="fl member-info-item-title"><i class="fa fa-map-marker"></i> Địa chỉ : </div>
                                                <div class="fl member-info-item-content">
                                                    <input name="place" value="<?php echo $user['place'] ?>" class="text" />
                                                </div>
                                            </div>
                                             <div class="ecommerce-delete-user" par="<?php echo $user['id'] ?>">Xóa thành viên này</div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                
                                <?php
                            }
                        ?>
                    </div>
                    <div class="content-item  content-item-posts core-posts">
                        <table>
                            <tr class="tr-first">
                                <td class="stt">STT</td>
                                <td class="ma-tin">Mã tin</td>
                                <td class="trang_thai">Trạng thái</td>
                                <td class="tieu-de">Tiêu đề</td>
                                <td class="nguoi-dang">Người đăng</td>
                                <td class="luot-xem">Lượt xem</td>
                                <td class="ngay-dang">Ngày đăng</td>                                
                            </tr>
                            
                            <?php 
                            $posts = models_DB::get('SELECT * FROM ' . POST_TABLE . ' WHERE post_type=3 ORDER BY id DESC LIMIT 9999  ');
                            //$posts = get_posts(array('limit'=>' LIMIT 9999 ', 'the_status')); ?>
                            
                            <?php 
                                foreach($posts as $k=>$post)
                                {
                                    ?>
                                    <tr class="tr-<?php echo $post['id'] ?>">
                                        <td class="stt"><?php echo $k + 1 ?></td>
                                        <td class="ma-tin"><?php echo $post['id'] ?></td>
                                        <td class="trang_thai bold">
                                            <?php 
                                                if($post['the_status']=='pending')
                                                {
                                                    ?>
                                                    <div style="color: gray;">
                                                    Chờ duyệt
                                                    </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <div style="color: green;">
                                                    Đã xuất bản
                                                    </div>
                                                    <?php
                                                    }
                                            ?>
                                        </td>
                                        <td class="tieu-de">
                                            <div class="clearfix">
                                                <div class="image fl">
                                                    <img src="<?php timthumb_url($post['image'], 300, 200) ?>" alt="" />
                                                </div>
                                                <div class="text fl">
                                                    <a target="_blank" href="<?php hcv_url('p', $post['url'], $post['id']) ?>">
                                                        <?php echo $post['title'] ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="tieu-de-action">
                                                <a class="core-view-post" href="<?php hcv_url('p', $post['url'], $post['id']) ?>">
                                                    <i class="fa fa-eye " par="<?php echo $post['id'] ?>"></i> Xem
                                                </a>
                                                
                                                <a class="core-view-post" href="<?php echo SITE_URL, '/sua-tin/?post_id=', $post['id'] ?>">
                                                    <i class="fa fa-edit " par="<?php echo $post['id'] ?>"></i> Sửa
                                                </a>
                                                
                                                <?php 
                                                    if($post['the_status']=='pending')
                                                    {
                                                        ?>
                                                         <span par="<?php echo $post['id'] ?>" class="status-post publish-post" href="<?php hcv_url('p', $post['url'], $post['id']) ?>">
                                                            <i class="fa fa-check " ></i> Duyệt tin
                                                        </span>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                         <span par="<?php echo $post['id'] ?>" class="status-post pending-post" href="<?php hcv_url('p', $post['url'], $post['id']) ?>">
                                                            <i class="fa fa-unlink " ></i> Bỏ duyệt
                                                        </span>
                                                        <?php
                                                        }
                                                ?>
                                                <span style="cursor:pointer;"  par="<?php echo $post['id'] ?>" class="up-post" href="<?php hcv_url('p', $post['url'], $post['id']) ?>">
                                                            <i class="fa fa-arrow-circle-o-up " ></i> Up tin
                                                        </span> &nbsp; &nbsp; &nbsp;
                                               
                                                
                                                <i class="fa fa-close core-delete-post" par="<?php echo $post['id'] ?>"></i>
                                            </div>
                                        </td>
                                        <td class="nguoi-dang">
                                        <?php $user = get_user($post['user_id']); if(empty($user['display_name'])) $user['display_name'] = $user['user_name']; ?>
                                        
                                        <?php echo $user['display_name']  ?>
                                        
                                        </td>
                                        <td class="luot-xem"><?php echo  $post['view_count'] ?></td>
                                        <td class="ngay-dang"><?php echo date('d/m/Y', $post['time_create']) ?></td>
                                         
                                    </tr>
                                    <?php
                                }
                            ?>
                            
                        </table>
                    </div>
                    <div class="content-item  content-item-billing">
                        <form class="billing-form">
                            <input type="hidden" value="billing_form" name="type" />
                            <div class="billing-item">
                                <h2>Thông tin chuyển khoản ngân hàng</h2>
                                <div class="content-item-content">
                                    <?php 
                                        
                                    ?>
                                    <textarea name="admin_ecommerce_bank_info" class="main-content"><?php echo $admin_ecommerce_bank_info ?></textarea>
                                </div>
                            </div>
                            <div class="billing-item">
                                <h2>Cổng thanh toán trực tuyến</h2>
                                <h3>Tích hợp ngân lượng</h3>
                                 
                                <div style="font-size: 12px;">
                                    Merchant ID: <input name="admin_ecommerce_ngan_luong_merchant_id" value="<?php echo get_config('admin_ecommerce_ngan_luong_merchant_id') ?>" />
                                     &nbsp;&nbsp;&nbsp;
                                    Merchant Password: <input name="admin_ecommerce_ngan_luong_merchant_password" value="<?php echo get_config('admin_ecommerce_ngan_luong_merchant_password') ?>" />
                                    &nbsp;&nbsp;&nbsp;
                                    Merchant Email: <input name="admin_ecommerce_ngan_luong_merchant_email" value="<?php echo get_config('admin_ecommerce_ngan_luong_merchant_email') ?>" />
                                    
                                </div>
                                <div class="content-item-content">
                                    
                                </div>
                            </div>
                            
                            <div class="billing-item">
                                <h2>Nạp tiền qua tin nhắn văn bản</h2>
                                <p>Sử dụng @id thay cho ID thành viên</p><br />
                                
                                <div class="content-item-content">
                                    
                                    <?php 
                                        
                                    ?>
                                    <textarea name="admin_ecommerce_billing_sms" class="main-content"><?php echo $admin_ecommerce_billing_sms ?></textarea>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="content-item  content-item-notifications"></div>
                </div>
            </div>
            </div>
            <span class="clear"></span>
        </div>
    </div>
      
      <?php include 'footer.php'; ?>
      
      
       