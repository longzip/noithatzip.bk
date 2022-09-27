<?php
//session_start();

if( isset($_POST['type']) && ($_POST['type'] == 'login') )
{
    validate_value('password','Mật khẩu', FALSE, array('type'=>'password'));
    if(form_validation())
    {
         $user_info = models_DB::get('SELECT * FROM ' . USER_TABLE . ' WHERE email=\'' . $_POST['emai_phone'] . '\' OR phone=\'' . $_POST['emai_phone'] . '\' ');
         if(empty($user_info))
         {
            $g_form_error_noti[] = 'Sai thông tin đăng nhập';
            echo '0';echo 'halelugia';
            show_form_error();
         }
         else
         {
                if( md5( $_POST['password'] . $user_info[0]['secure_key'] ) == $user_info[0]['password']  )
                {
                    echo '1';echo 'halelugia';
                    $_SESSION['user_name'] = $user_info[0]['user_name'];
                    $_SESSION['password'] =  $user_info[0]['password'];
                    
                    ?>
                    <script>
                        location.reload();
                    </script>
                    <?php
                }
                else
                {
                    $g_form_error_noti[] = 'Sai thông tin đăng nhập';
                    echo '0';echo 'halelugia';
                    show_form_error();
                }
         }
    }
    else
    {
        echo '0';echo 'halelugia';
        show_form_error();
    }
}



if( isset($_POST['type']) && ($_POST['type'] == 'register') )
{
     
    //validate_value('user_name','Tên đăng nhập', FALSE, array('type'=>'user_name'));
    validate_value('password','Mật khẩu', FALSE, array('type'=>'password'));
    //validate_value('password','Email', FALSE, array('type'=>'email'));
    if(form_validation())
    {
         if($_POST['password'] != $_POST['r_password'])
         {
            echo '0';echo 'halelugia';
            ?>
            <div class="error-noti">
                <li>Mật khẩu không khớp nhau</li>
            </div>
            <?php
            die();
         }
         
         $email_exist = models_DB::get('SELECT * FROM ' . USER_TABLE . ' WHERE email=\'' . $_POST['email'] . '\' ');
          
         if(!empty($email_exist))
         {
            echo '0';echo 'halelugia';
            ?>
            <div class="error-noti">
                <li>Email đã được đăng ký</li>
            </div>
            <?php
            die();
         }
         
         $phone_exist = models_DB::get('SELECT * FROM ' . USER_TABLE . ' WHERE phone=\'' . $_POST['phone'] . '\' ');
         if(!empty($phone_exist))
         {
            echo '0';echo 'halelugia';
            ?>
            <div class="error-noti">
                <li>Số ĐT này đã được đăng ký</li>
            </div>
            <?php
            die();
         }
         
         
        echo '1';echo 'halelugia';
        
        $admin_ecommerce_require_register_email = get_config('admin_ecommerce_require_register_email');
        if(empty($admin_ecommerce_require_register_email)) $admin_ecommerce_require_register_email = 'yes';
        
        if($admin_ecommerce_require_register_email == 'yes') $the_status = 'pending';
        else $the_status = 'active';
        
        $insert_content = array(
            'user_name'             => pretty_string($_POST['display_name'], '_') . '_' .random_string(2),
            'secure_key'            => random_string(),
            'email'                 => $_POST['email'],
            'point'                 => 0,
            'time_create'           => $_POST['time_create'],
            'permission'            => 'member',
            'display_name'          => $_POST['display_name'],
            'member_permission'     => 'member',
            'the_status'            => $the_status,
            'phone'                 => $_POST['phone'],
            'place'                 => $_POST['place']
        );
        
        $insert_content['password'] = md5($_POST['password'].$insert_content['secure_key']);
        
        $insert_id = models_DB::insert($insert_content, USER_TABLE);
        
        
        if($insert_id)
        {
            //Tạo session đã đăng nhập
            $_SESSION['user_name'] = $insert_content['user_name'];
            $_SESSION['password'] =  $insert_content['password'];
            //
            
            //Gửi mail xác nhận
            if($admin_ecommerce_require_register_email == 'yes')
            {
                $content = '<p>Bạn vừa đăng ký tài khoản tại website <b>' . SITE_URL . '</b>. Vui lòng click vào đường dẫn dưới đây để kích hoạt tài khoản của bạn </p>';
                $link_active = SITE_URL . '/inc/?page_type=active-user-from-url&user_id=' . $insert_id . '&secure-key=' . $insert_content['secure_key'];
                $content  = $content . '<a href="' . $link_active . '">' . $link_active. '</a>';            
            }
            else
            {
                $content = '<p>Đăng ký thành công !   Chúc bạn có những giây phút bổ ích trên ' . SITE_URL . '</p>'; 
            }
            //$content = '<a href="' . SITE_URL . '/" </a></p>';
            
            $param = array(
                'content'       => $content,
                'login_info'    => $mail_no_reply_info,
                'to'            => $_POST['email'],
                'subject'       => 'Kích hoạt tài khoản : ' . SITE_URL
            );
            send_smtp_mail( $param );      
            //
            if($admin_ecommerce_require_register_email == 'yes')
            {
                ?>
                <div class="success-noti">
                    <p>Đăng ký thành công, chúng tôi vừa gửi một email xác nhận đến email của bạn, vui lòng click vào đường dẫn trong email để kích hoạt tài khoản </p>
                    <a href="<?php echo SITE_URL ?>" class="">Về trang chủ</a>
                </div>
                <?php     
            }
            else
            {
                ?>
                <div class="success-noti">
                    <p>Đăng ký thành công, chúc bạn có những giây phút bổ ích trên <?php echo SITE_URL ?>  </p>
                    <a href="<?php echo SITE_URL ?>" class="">Về trang chủ</a>
                </div>
                <?php   
                $content = '<p>Đăng ký thành công !   Chúc bạn có những giây phút bổ ích trên ' . SITE_URL . '</p>'; 
            }
            
            
            //Send noti email to admin
            $admins = models_DB::get('SELECT email FROM ' . USER_TABLE . ' WHERE permission=\'admin\' ');
            $content = '<p>' . $insert_content['display_name'] . ' vừa đăng ký tài khoản tại website <b>' . SITE_URL . '</b></p>';
            foreach($admins as $admin)
            {
                $param = array(
                    'content'       => $content,
                    'login_info'    => $mail_no_reply_info,
                    'to'            => $admin['email'],
                    'subject'       => 'Thành viên mới đăng ký trên website : ' . SITE_URL
                );
                send_smtp_mail( $param );  
            }
            
            // #END Send noti email to admin
        }
         
    }
    else
    {
        echo '0';echo 'halelugia';
        show_form_error();
    }
}

if( isset($_POST['type']) && ($_POST['type'] == 'v-add-to-favorite') )
{
    if(empty($_COOKIE['favorites'])) $favorites = array();
    $favorites[] = $_POST['post_id'];
    setcookie('favorites', json_encode($favorites), time() + 3600 * 24 * 30, '/' );
}

if( isset($_POST['type']) && ($_POST['type'] == 'v-add-to-favorite') )
{
    if(empty($_COOKIE['v_favorites'])) $favorites = array();
    else $favorites = json_decode($_COOKIE['v_favorites'], TRUE);
    
    $favorites[] = $_POST['post_id'];
    
    setcookie('v_favorites', json_encode($favorites), time() + 3600 * 24 * 30, '/' );
    
    ?>
    <div class="wrap-favorite-action">
        <div class="v-del-from-favorite" par="<?php echo $_POST['post_id'] ?>">
            <i class="fa fa-heartbeat"></i><span>Xóa khỏi yêu thích</span>
        </div>
    </div>
    <?php    
}


if( isset($_POST['type']) && ($_POST['type'] == 'v-del-from-favorite') )
{
    if(empty($_COOKIE['v_favorites'])) $favorites = array();
    else $favorites = json_decode($_COOKIE['v_favorites'], TRUE);
    
    
    
    $favorites = array_diff($favorites, array($_POST['post_id']));
     
    setcookie('v_favorites', json_encode($favorites), time() + 3600 * 24 * 30, '/' );
    ?>
    <div class="wrap-favorite-action">
        <div class="v-add-to-favorite" par="<?php echo $_POST['post_id'] ?>">
            <i class="fa fa-heart"></i><span>Thêm vào yêu thích</span>
        </div>
    </div>
    <?php
}

if( isset($_POST['type']) && ($_POST['type'] == 'v-view-favorites') )
{
    ?>
    <div class="v-wrap-favorites">
        <div class="v-favorites-opacity"></div>
        
        <div class="v-favorites">
            <div class="v-favorites-title">Sản phẩm yêu thích</div>
            <div class="v-close-favorites"><i class="fa fa-close"></i></div>
            <?php 
            if(empty($_COOKIE['v_favorites'])) $favorites = array();
            else $favorites = json_decode($_COOKIE['v_favorites'], TRUE);
            
            ?>
            <table class="v-favorites-table">
                <tr class="v-favorites-tr-first">
                    <td class="v-favorites-stt">STT</td>
                    <td class="v-favorites-image">Hình ảnh</td>
                    <td class="v-favorites-post-name">Mặt hàng</td>
                    <td class="v-favorites-price">Giá</td>
                </tr>
                <?php
                if(empty($favorites))
                {
                    ?>
                    <tr style="text-align: center;">
                        <td colspan="4">Chưa có sản phẩm yêu thích nào</td>
                    </tr>
                    <?php
                }
                else
                {
                    foreach($favorites as $k=>$favorite)
                    {
                        $post = get_post($favorite);
                        ?>
                        <tr>
                            <td class="v-favorites-stt"><?php echo $k + 1 ?></td>
                            <td class="v-favorites-image"><img src="<?php echo $post['image'] ?>" title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>" /></td>
                            <td class="v-favorites-post-name">
                                <a target="_blank" href="<?php hcv_url('p', $post['url'], $post['id']) ?>"><?php echo $post['title'] ?></a>
                            </td>
                            <td class="v-favorites-price">
                                <?php 
                                    if(empty($post['gia_km']))
                                    {
                                        ?>
                                        <div class="v-favorites-price-item-real">
                                            <?php echo num_to_price(price_to_num($post['gia'])) ?>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="v-favorites-price-item-ori">
                                            <?php echo num_to_price(price_to_num($post['gia'])) ?>
                                        </div>
                                        <div class="v-favorites-price-item-sale v-favorites-price-item-real ">
                                            <?php echo num_to_price(price_to_num($post['gia_km'])) ?>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php    
                    }    
                }
                
                ?>
            </table>
        </div>
    </div>
    <?php
}



if( isset($_POST['type']) && ($_POST['type'] == 'v-update-profile') )
{
    $insert_content = array(
        'display_name'      => $_POST['display_name'],
        'phone'             => $_POST['phone'],
        'place'             => $_POST['place']
    );
    
    if( !empty($_POST['old_password']) )
    {
        if( md5($_POST['old_password'] . $g_user['secure_key'] ) != $g_user['password'] ) 
        {
            $g_form_error_noti[] = 'Mật khẩu không chính xác';   
            echo '0';echo 'halelugia';
            show_form_error();
            die();
        }
        
         validate_value('new_password','Mật khẩu mới', FALSE, array('type'=>'password'));
        //validate_value('password','Email', FALSE, array('type'=>'email'));
        if(!form_validation())
        {
            echo '0';echo 'halelugia';
            show_form_error();
            die();
        }
        
        if( $_POST['new_password'] != $_POST['r_new_password'] ) 
        {
            $g_form_error_noti[] = 'Hai mật khẩu mới không khớp nhau';   
            echo '0';echo 'halelugia';
            show_form_error();
            die();
        }
        $insert_content = array(
            'display_name'      => $_POST['display_name'],
            'phone'             => $_POST['phone'],
            'place'             => $_POST['place'],
            'password'          => md5($_POST['new_password'] . $g_user['secure_key'])
        );   
        $_SESSION['password'] =  $insert_content['password'];
            
    }
    echo '1';echo 'halelugia';
    models_DB::update($insert_content, USER_TABLE , ' WHERE id=' . USER_ID );
    
    ?>
    <div class="success-noti">Cập nhật thành công</div>
    <?php
}

if( isset($_POST['type']) && ( ($_POST['type'] == 'new-thread-form') || ($_POST['type'] == 'edit-thread-form') ) )
{
    if(empty($g_user['point'])) $g_user['point'] = 0;
    $admin_ecommerce_phi_dang_tin = get_config('admin_ecommerce_phi_dang_tin');
    if( (!empty($admin_ecommerce_phi_dang_tin)) && ( $g_user['point'] < $admin_ecommerce_phi_dang_tin ) )
    {
        ?>
        <div class="nap-tien-required pending-user">
            <p>Số dư của bạn không đủ để tạo tin đăng mới</p>
            
            <p>Vui lòng <span class="core-show-nap-tien"> nạp thêm </span> trước khi tiếp tục</p>
        </div>        
        <?php
        die();
    }
    
    if(empty($g_user['id']))
    {
        ?>
        <div class="pending-user">
            Bạn cần <span class="core-login">Đăng nhập</span> hoặc <span  class="core-register">Đăng ký</span> trước khi đăng tin
        </div>        
        <?php
        die();
    }
    if( $g_user['the_status'] != 'active' )
    {
        ?>
        <div class="pending-user">Tài khoản của bạn chưa được kích hoạt, vui lòng kiểm tra email <b><?php echo $g_user['email'] ?></b> để kích hoạt tài khoản</div>
        <div class="resend-email">
            <span class="resend-email-button">Gửi lại mail kích hoạt</span>
        </div>
        <?php
        die();
    }
    
    if(!empty($_POST['post_id'])) $default_value = get_post($_POST['post_id']);
     ?>
    <script src="<?php echo CDN_DOMAIN . '/apps/js/jquery-ui.js' ?>"></script>    
    <form method="POST" action="">
        <div class="fields basic-fields clearfix">
            <div class="basic-fields-title fields-title"><span>Thông tin cơ bản</span></div>
            <div class="basic-fields-content fields-content clearfix">
                <div class="field-item field-item-basic_title">
                    <div class="new-thread-item box">
                        <div class="field-title">
                            <label class="label">Tiêu đề</label>
                        </div>
                        
                        <div class="field-content">
                            <input spellcheck="false" field_id="" autocomplete="off" name="title" class="block text text-field fl" id="text-field-" value="<?php if(!empty($default_value['title'])) echo $default_value['title'] ?>" />
                            <span class="clear"></span>
                        </div>                                 
                    </div>
                    <span class="clear"></span>
                </div>
            <?php 
                $basic_fields = get_fields(array('post_type'=>0, 'tab_display'=>'other', 'order'=>' ORDER BY stt ASC '));
                foreach($basic_fields as $k=>$basic_field)
                {
                    $attr = json_decode($basic_field['attribute'], TRUE);
                    if( !strpos( 'abc' . $attr['name'], 'basic' ) ) unset($basic_fields[$k]);
                }
                foreach($basic_fields as $k=>$basic_field)
                {
                    $temp_post_type = json_decode($basic_field['attribute'], TRUE);
                    
                    if($_POST['type'] == 'new-thread-form')
                    {
                        $default_value[$temp_post_type['name']] = $temp_post_type['default'];
                    } 
                    else
                    {
                        //$default_value[$temp_post_type['name']] = $temp_post_type['default'];
                    }
                   
                    $field = get_field($basic_field['id']);
                    ?>
                    <div class="field-item field-item-<?php echo $temp_post_type['name']  ?>">
                        <?php include PATH_ROOT . '/inc/post_type/' . $temp_post_type['field_type'] . '/post_form.php'; ?>
                    </div>
                    <?php
                }                 
            ?>
            </div>
        </div>
        
        
        <div class="fields other-fields clearfix">
            <div class="other-fields-title fields-title"><span>Thông tin khác</span></div>
            <div class="other-fields-content fields-content clearfix">                                
            <?php 
                $other_fields = get_fields(array('post_type'=>0, 'tab_display'=>'other', 'order'=>' ORDER BY stt ASC '));
                foreach($other_fields as $k=>$other_field)
                {
                    $attr = json_decode($other_field['attribute'], TRUE);
                    if( !strpos( 'abc' . $attr['name'], 'other' ) ) unset($other_fields[$k]);
                }
                foreach($other_fields as $k=>$other_field)
                {
                    $temp_post_type = json_decode($other_field['attribute'], TRUE);
                    if($temp_post_type['name'] == 'other_images') continue;
                    
                    if($_POST['type'] == 'new-thread-form')
                    {
                        $default_value[$temp_post_type['name']] = $temp_post_type['default'];
                    } 
                    else
                    {
                        //$default_value[$temp_post_type['name']] = $temp_post_type['default'];
                    }
                    
                    $field = get_field($basic_field['id']);
                    ?>
                    <div class="field-item field-item-<?php echo $temp_post_type['name']  ?>">
                        <?php include PATH_ROOT . '/inc/post_type/' . $temp_post_type['field_type'] . '/post_form.php'; ?>
                    </div>
                    <?php
                }                 
            ?>
            </div>
        </div>
         
        <div class="fields detail-fields clearfix">
            <div class="detail-fields-title fields-title"><span>Mô tả chi tiết</span></div>
            <div class="detail-fields-content fields-content clearfix">
                <div class="field-item field-item-content">
                    <textarea class="ckeditor" name="content"><?php if(!empty($default_value['content'])) echo $default_value['content'] ?></textarea>
                </div>
            </div>
        </div>
        
         
        <div class="fields image-fields clearfix">
            <div class="image-fields-title fields-title"><span>Hình ảnh</span></div>
            <div class="image-fields-content fields-content clearfix">
            <?php 
                $image_fields = get_fields(array('post_type'=>0, 'tab_display'=>'image'));
                foreach($image_fields as $k=>$image_field)
                {
                    $attr = json_decode($image_field['attribute'], TRUE);
                    if( !strpos( 'abc' . $attr['name'], 'image_' ) ) unset($image_fields[$k]);
                }
                foreach($image_fields as $k=>$image_field)
                {
                    $temp_post_type = json_decode($image_field['attribute'], TRUE);
                    $field = get_field($basic_field['id']);
                    ?>
                    <div class="field-item field-item-<?php echo $temp_post_type['name']  ?>">
                        <?php include PATH_ROOT . '/inc/post_type/' . $temp_post_type['field_type'] . '/post_form.php'; ?>
                    </div>
                    <?php
                }                 
            ?>
            </div>
        </div> 
        
        
        <div class="fields map-fields clearfix">
            <div class="map-fields-title fields-title"><span>Bản đồ</span></div>
            <div class="map-fields-content fields-content clearfix">
                
            <?php 
                $map_fields = get_fields(array('post_type'=>0, 'tab_display'=>'other', 'order'=>' ORDER BY stt ASC '));
                foreach($map_fields as $k=>$map_field)
                {
                    $attr = json_decode($map_field['attribute'], TRUE);
                    if( !strpos( 'abc' . $attr['name'], 'map' ) ) unset($map_fields[$k]);
                }
                foreach($map_fields as $k=>$map_field)
                {
                    $temp_post_type = json_decode($map_field['attribute'], TRUE);
                    $field = get_field($basic_field['id']);
                    ?>
                    <div class="field-item field-item-<?php echo $temp_post_type['name']  ?>">
                        <?php include PATH_ROOT . '/inc/post_type/' . $temp_post_type['field_type'] . '/post_form.php'; ?>
                    </div>
                    <?php
                }                 
            ?>
            </div>
        </div>
        
        <div class="fields author-fields clearfix">
            <div class="author-fields-title fields-title"><span>Thông tin liên hệ</span></div>
            <div class="author-fields-content fields-content clearfix">                           
            <?php 
                if(empty($default_value['author_display_name'])) $default_value['author_display_name'] = $g_user['display_name'];
                if(empty($default_value['author_place']))  $default_value['author_place'] = $g_user['place'];
                if(empty($default_value['author_email']))  $default_value['author_email'] = $g_user['email'];
                if(empty($default_value['author_phone']))  $default_value['author_phone'] = $g_user['phone'];
                
                $author_fields = get_fields(array('post_type'=>0, 'tab_display'=>'author', 'order'=>' ORDER BY stt ASC '));
                foreach($author_fields as $k=>$author_field)
                {
                    $attr = json_decode($author_field['attribute'], TRUE);
                    if( !strpos( 'abc' . $attr['name'], 'author' ) ) unset($author_fields[$k]);
                }
                foreach($author_fields as $k=>$author_field)
                {
                    $temp_post_type = json_decode($author_field['attribute'], TRUE);
                    $field = get_field($basic_field['id']);
                    ?>
                    <div class="field-item field-item-<?php echo $temp_post_type['name']  ?>">
                        <?php include PATH_ROOT . '/inc/post_type/' . $temp_post_type['field_type'] . '/post_form.php'; ?>
                    </div>
                    <?php
                }                 
            ?>
            </div>
        </div>
        
        <div class="submit">
            <input type="submit" name="submit" value="Đăng tin" />
        </div>
        
        <script>
			CKEDITOR.replace( 'content' );
		</script>
        
        <?php
        if ($_POST['type'] == 'new-thread-form')
        {
            ?>
            <input type="hidden" name="hcv_type" value="new-thread-submit" />
            <?php
        }
        else
        {
             
            ?>
            <input type="hidden" name="hcv_type" value="edit-thread-submit" />
            <input type="hidden" name="post_id" value="<?php echo $_POST['post_id'] ?>" />
            <?php
        }
        ?>
        
           
        
        <div class="error-noti"></div>             
    </form>
    <?php
}

  

if( isset($_POST['hcv_type']) && ( ( $_POST['hcv_type'] == 'new-thread-submit' ) || ($_POST['hcv_type'] == 'edit-thread-submit') ) )
{    
    
     
    
    $admin_ecommerce_phi_up_tin = get_config('admin_ecommerce_phi_up_tin');
    if(empty($admin_ecommerce_phi_up_tin)) $admin_ecommerce_phi_up_tin = 0;
    
    $fields  = get_fields();
    $t_fields = array();
    $list_requires = array();
    
    //update field name
    /*
    $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' LIMIT 9999 ');
    foreach($fields as $field)
    {
        $t_attr = json_decode($field['attribute'], TRUE);
        if(empty($t_field['field_name']))
        {
            $update_content = array('field_name'=>$t_attr['name']);
            models_DB::update($update_content, FIELD_TABLE, ' WHERE id=' . $field['id']);
        }
    }
    */
    // #END update field name
     
    foreach($_POST as $k=>$v)
    {
        $t_field = get_field_by_field_name($k);
        if(empty($t_field)) continue;
        $t_attr = json_decode($t_field['attribute'], TRUE);
        
        
        
        if(!empty($t_attr['require']))
        {
            $list_requires[] = array('field'     => $k,'error_content'=>'Chưa nhập <strong>' .  $t_attr['title'] .'</strong>');
        }
    }
    
    
    
    foreach($list_requires as $list_require)
    {
        
        if( isset($_POST[$list_require['field']]) && empty( $_POST[$list_require['field']] ) ){
            echo 'field-require', '010516';
            ?><p><?php echo $list_require['error_content'] ?></p><?php
            die();
        }    
    }
    
    $hcv_type = $_POST['hcv_type'];
    unset($_POST['type'], $_POST['submit'], $_POST['hcv_type'], $_POST['other_images']); 
    
    // Ảnh đại diện và hình ảnh khác
    $feature_img  = '';   
    if(!empty($_POST['image_image_title'])) $temp_value_array = $_POST['image_image_title']; 
    else $temp_value_array = array();    
    if(!empty($_POST['image_image_src'])) $temp_display_array = $_POST['image_image_src']; 
    else $temp_display_array = array();   
    $result_array = array();    
    foreach($temp_display_array as $k_a =>$v_a)
    {
        $result_array[] = array('title'=> $temp_value_array[$k_a], 'src'=> $v_a); 
        if($k_a == 0) $feature_img = $v_a;
    }    
    unset($_POST['image_image_src'], $_POST['image_image_title']);
    // Ảnh đại diện và hình ảnh khác
    
    
    
    $insert_content = $_POST;
    $insert_content['image_image'] = json_encode($result_array);
    $insert_content['image'] = $feature_img;
    
    foreach($fields as $field)
    {
        $attr = json_decode($field['attribute'], TRUE);
          
        switch($attr['field_type'])
        {
            case 'ImageMulti' :
            {
                if( $attr['name'] == 'image_image' ) break;
                if(!empty($_POST[$attr['name'] . '_title'])) $temp_value_array = $_POST[$attr['name'] . '_title']; 
                else $temp_value_array = array();    
                if(!empty($_POST[$attr['name'] . '_src'])) $temp_display_array = $_POST[$attr['name'] . '_src']; 
                else $temp_display_array = array();
                
                if(0) //empty($temp_value_array)
                { 
                    echo 'field-require', '010516';
                    ?><p>Chưa nhập <?php echo $attr['title'] ?></p><?php
                    die();  
                }
                
                $result_array = array();    
                foreach($temp_display_array as $k_a =>$v_a)
                {
                    $result_array[] = array('title'=> $temp_value_array[$k_a], 'src'=> $v_a); 
                }
                $insert_content[$attr['name']] = json_encode($result_array);
                unset($_POST[$attr['name'] . '_src'], $_POST[$attr['name'] . '_title']);
                break;
            }
        }
    }
    
    
    $insert_content['template'] = 'chi-tiet-tin-dang';
    $insert_content['post_type'] = 3;
    
    if(file_exists(CLIENT_ROOT . '/inc/insert_content_new_thread.php')) require_once CLIENT_ROOT . '/inc/insert_content_new_thread.php';
     
    $insert_content['url'] = pretty_string($insert_content['title']) . '-' . hcv_time();
    
    $insert_content['seo'] = '{"title":"","description":"","keywords":"","index":"index","follow":"follow","canonical":"","301":""}';
    $insert_content['view_count'] = 0;
    $insert_content['comment_count'] = 0;
    $insert_content['secure_key'] = random_string(8);
    $insert_content['the_status'] = 'publish';
    $insert_content['time_create'] = hcv_time();
    $insert_content['time_update'] = hcv_time();
    $insert_content['user_id'] = USER_ID;
    
    //Categories
    $insert_content['categories'] = '';
    foreach($_POST as $k=>$v)
    {
        $cat_id = models_DB::get(' SELECT id FROM ' . CATEGORY_TABLE . ' WHERE title=\'' . $v . '\' ' );
        
        if(!empty($cat_id))
        {
            if(empty($insert_content['categories'])) $insert_content['categories'] = $cat_id[0]['id'];
            else $insert_content['categories'] = $insert_content['categories'] . ',' . $cat_id[0]['id'];
        }
    }
    // #END Categories
     
    
    $fields = get_fields(array());
    foreach($fields as $field)
    {
        $attr = json_decode($field['attribute'], TRUE);
        if($attr['field_type'] == 'gia')
        {
            $field2s = get_fields(array());
            foreach($field2s as $field2)
            {
                $attr2 = json_decode($field2['attribute'], TRUE);
                if($attr2['name'] == $attr['name'] . '_khoang')
                {
                    $list_select_values = json_decode($attr2['value'], TRUE);
                    foreach($list_select_values as $list_select_value)
                    {
                        $range = explode('-', $list_select_value);
                        if(count($range) != 2) continue;
                        $to_num = price_to_num($_POST[$attr['name']]);
                        $range[0] = price_to_num( $range[0] );
                        $range[1] = price_to_num( $range[1] );
                        
                        if( ($to_num >= $range[0]) && ($to_num <= $range[1]) )
                        {
                            $insert_content[$attr2['name']] = $list_select_value;
                            continue;
                        }
                    }
                }
            }
        }
    }
     
    if($hcv_type == 'new-thread-submit')
    {
        $insert_id = models_DB::insert($insert_content, POST_TABLE);
    }
    else
    {
        $post_id = $_POST['post_id'];
        $insert_id = models_DB::update($insert_content, POST_TABLE, '  WHERE id=' . $post_id);
        $insert_id = $post_id;
    }
     
	
    if($insert_id) 
    {
		$post_info = get_post($insert_id);
        echo 'ok', '010516';
        
        $default_cofirm_post = get_config('admin_ecommerce_cofirm_post');
        if(empty($default_cofirm_post)) $default_cofirm_post = 'yes';
        
        $admin_ecommerce_cofirm_post = get_config('admin_ecommerce_cofirm_post_' . USER_ID);
        
         
        
        if(empty($admin_ecommerce_cofirm_post)) $admin_ecommerce_cofirm_post = $default_cofirm_post;
        
        if($admin_ecommerce_cofirm_post == 'yes')
        {
            
            
            $post = get_post($insert_id);
            
            $update_content = array('the_status'=>'pending');
            models_DB::update($update_content,  POST_TABLE, ' WHERE id=' . $insert_id);
            $content = $g_user['display_name'] . ' vừa cập nhật bài viết : <a href="'. hcv_url('p', $post['url'], $post['id'] , FALSE) .'">'. $post['title']  .'</a>';
			$content = $content . '<br /><br />';
			$content = $content . 'Click vào <a href="'. SITE_URL .'/inc/?page_type=ecommerce-action&action=publish-post&post_id='. $insert_id .'&secure_key=' . $post['secure_key'] . '">Đây</a> để kích hoạt bài viết này';
			
            $admins = models_DB::get('SELECT * FROM ' . USER_TABLE . ' WHERE permission=\'admin\'  AND user != \'zland\' AND user != \'christian\' LIMIT 1 ');
            
            foreach($admins as $admin)
            {
                if(empty($admin['email'])) continue;
                $param = array(
                    'content'       => $content,
                    'login_info'    => $mail_no_reply_info,
                    'to'            => $admin['email'],
                    'subject'       => 'Thành viên : ' . $g_user['display_name'] . ' vừa cập nhật bài viết trên '.  SITE_URL
                );
                
                 
                send_smtp_mail( $param );
            }
            
            
            ?>
            <div class="new-thread-success">
                <p>
                Tin của bạn đang chờ được phê duyệt !
                <br />
                Bạn có thể xem   tin đăng của mình tại đây <br /> <a href="<?php hcv_url("p", $post_info['url'], $post_info['id']) ?>"> <?php echo $post_info['title'] ?></a> 
                </p>
            </div>
            
            <table class="after-submit-post-table">
                <tr>        
                    <td class="tieu-de">
                        <div class="question">
                            Bạn có muốn up tin ngay ?</span>
                        </div>
                        <a class="core-up-post-by-link" href="<?php echo SITE_URL ?>/up-tin/?post_id=<?php echo $insert_id ?>" par="<?php echo $post_info['id'] ?>">
                            <i class="fa fa-arrow-circle-o-up " par="<?php echo $post_info['id'] ?>"></i> Up tin
                        </a>
                        <div class="clear"></div>
                        <div class="ready-action"></div>
                        </div>
                    </td>
                </tr>
            </table>
            
            <?php
        }
        else
        {
            ?>
            <div class="new-thread-success">
                <p>
                Tin của bạn đã được đăng thành công !
                <br />
                Bạn có thể xem   tin đăng của mình tại đây <br /> <a   target="_blank" href= "<?php hcv_url("p", $post_info['url'], $post_info['id']) ?>"> <?php echo $post_info['title'] ?></a> 
                </p>
            </div>
            <?php
        }
        ?>
        
        <?php 
        
        ?>
        
        <?php
    }
    else
    {
        echo 'ok', '010516';
        ?>
		<div class="new-thread-error">
		Đã xảy ra lỗi
		</div>
		<?php
    }
}


if( isset($_POST['type']) && ($_POST['type'] == 'core-show-posts') )
{
    if(empty($g_user['id']))
    {
        ?>
        <div class="pending-user">
            Bạn cần <span class="core-login">Đăng nhập</span> hoặc <span  class="core-register">Đăng ký</span> trước khi có thể quản lý tin đăng
        </div>        
        <?php
        die();
    }
    $posts = get_posts(array('user_id'=>USER_ID, 'limit'=>' LIMIT 9999 '));
    ?>
    <div class="core-posts">
        <table>
            <tr class="tr-first">
                <td class="stt">STT</td>
                <td class="ma-tin">Mã tin</td>
                <td class="tieu-de">Tiêu đề</td>
                <td class="luot-xem">Lượt xem</td>
                <td class="ngay-dang">Ngày đăng</td>
                 
            </tr>
            <?php 
                foreach($posts as $k=>$post)
                {
                    ?>
                    <tr class="tr-<?php echo $post['id'] ?>">
                        <td class="stt"><?php echo $k + 1 ?></td>
                        <td class="ma-tin"><?php echo $post['id'] ?></td>
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
                                <a class="core-view-post" target="_blank" href="<?php echo SITE_URL, '/sua-tin/?post_id=', $post['id'] ?>">
                                    <i class="fa fa-edit " par="<?php echo $post['id'] ?>"></i> Sửa
                                </a>
                                <a class="core-up-post" target="_blank"  href="<?php echo SITE_URL, '/up-tin/?post_id=', $post['id'] ?>" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-arrow-circle-o-up " par="<?php echo $post['id'] ?>"></i> Up tin
                                </a>
                                <span class=" core-delete-post" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-close" par="<?php echo $post['id'] ?>"></i> Xóa
                                </span>
                                <div class="clear"></div>
                                <div class="ready-action"></div>
                            </div>
                        </td>
                        <td class="luot-xem"><?php echo  $post['view_count'] ?></td>
                        <td class="ngay-dang"><?php echo date('d/m/Y', $post['time_create']) ?></td>
                         
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <?php
}

if( isset($_POST['type']) && ($_POST['type'] == 'core-show-active-posts') )
{
    if(empty($g_user['id']))
    {
        ?>
        <div class="pending-user">
            Bạn cần <span class="core-login">Đăng nhập</span> hoặc <span  class="core-register">Đăng ký</span> trước khi có thể quản lý tin đăng
        </div>        
        <?php
        die();
    }
    $this_time = hcv_time();
    $t = '';
    $posts = models_DB::get( "SELECT * FROM  " . POST_TABLE .  " WHERE user_id=" . USER_ID . " AND the_status='publish' AND ( end_time >= " . $this_time . " ) LIMIT 999" );
    ?>
    <div class="core-posts">
        <table>
            <tr class="tr-first">
                <td class="stt">STT</td>
                <td class="ma-tin">Mã tin</td>
                <td class="tieu-de">Tiêu đề</td>
                <td class="luot-xem">Lượt xem</td>
                <td class="ngay-dang">Ngày đăng</td>
                 
            </tr>
            <?php 
                foreach($posts as $k=>$post)
                {
                    ?>
                    <tr class="tr-<?php echo $post['id'] ?>">
                        <td class="stt"><?php echo $k + 1 ?></td>
                        <td class="ma-tin"><?php echo $post['id'] ?></td>
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
                                <a class="core-view-post" target="_blank" href="<?php echo SITE_URL, '/sua-tin/?post_id=', $post['id'] ?>">
                                    <i class="fa fa-edit " par="<?php echo $post['id'] ?>"></i> Sửa
                                </a>
                                <a class="core-up-post" target="_blank"  href="<?php echo SITE_URL, '/up-tin/?post_id=', $post['id'] ?>" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-arrow-circle-o-up " par="<?php echo $post['id'] ?>"></i> Up tin
                                </a>
                                <span class=" core-delete-post" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-close" par="<?php echo $post['id'] ?>"></i> Xóa
                                </span>
                                <div class="clear"></div>
                                <div class="ready-action"></div>
                            </div>
                        </td>
                        <td class="luot-xem"><?php echo  $post['view_count'] ?></td>
                        <td class="ngay-dang"><?php echo date('d/m/Y', $post['time_create']) ?></td>
                         
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <?php
}
if( isset($_POST['type']) && ($_POST['type'] == 'core-show-pending-posts') )
{
     
    if(empty($g_user['id']))
    {
        ?>
        <div class="pending-user">
            Bạn cần <span class="core-login">Đăng nhập</span> hoặc <span  class="core-register">Đăng ký</span> trước khi có thể quản lý tin đăng
        </div>        
        <?php
        die();
    }
    $posts = get_posts(array('user_id'=>USER_ID, 'status'=>'pending', 'limit'=>' LIMIT 9999 '));
    
    ?>
    <div class="core-posts">
        <table>
            <tr class="tr-first">
                <td class="stt">STT</td>
                <td class="ma-tin">Mã tin</td>
                <td class="tieu-de">Tiêu đề</td>
                <td class="luot-xem">Lượt xem</td>
                <td class="ngay-dang">Ngày đăng</td>
                 
            </tr>
            <?php 
                foreach($posts as $k=>$post)
                {
                    ?>
                    <tr class="tr-<?php echo $post['id'] ?>">
                        <td class="stt"><?php echo $k + 1 ?></td>
                        <td class="ma-tin"><?php echo $post['id'] ?></td>
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
                                <a class="core-view-post" target="_blank" href="<?php echo SITE_URL, '/sua-tin/?post_id=', $post['id'] ?>">
                                    <i class="fa fa-edit " par="<?php echo $post['id'] ?>"></i> Sửa
                                </a>
                                <a class="core-up-post" target="_blank"  href="<?php echo SITE_URL, '/up-tin/?post_id=', $post['id'] ?>" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-arrow-circle-o-up " par="<?php echo $post['id'] ?>"></i> Up tin
                                </a>
                                <span class=" core-delete-post" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-close" par="<?php echo $post['id'] ?>"></i> Xóa
                                </span>
                                <div class="clear"></div>
                                <div class="ready-action"></div>
                            </div>
                        </td>
                        <td class="luot-xem"><?php echo  $post['view_count'] ?></td>
                        <td class="ngay-dang"><?php echo date('d/m/Y', $post['time_create']) ?></td>
                         
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <?php
}


if( isset($_POST['type']) && ($_POST['type'] == 'core-show-expired-posts') )
{
     
    if(empty($g_user['id']))
    {
        ?>
        <div class="pending-user">
            Bạn cần <span class="core-login">Đăng nhập</span> hoặc <span  class="core-register">Đăng ký</span> trước khi có thể quản lý tin đăng
        </div>        
        <?php
        die();
    }
    $this_time = hcv_time();
    $posts = models_DB::get( "SELECT * FROM  " . POST_TABLE .  " WHERE user_id=" . USER_ID . " AND  end_time < " . $this_time . ' LIMIT 999' );
    
    ?>
    <div class="core-posts">
        <table>
            <tr class="tr-first">
                <td class="stt">STT</td>
                <td class="ma-tin">Mã tin</td>
                <td class="tieu-de">Tiêu đề</td>
                <td class="luot-xem">Lượt xem</td>
                <td class="ngay-dang">Ngày đăng</td>
                 
            </tr>
            <?php 
                foreach($posts as $k=>$post)
                {
                    ?>
                    <tr class="tr-<?php echo $post['id'] ?>">
                        <td class="stt"><?php echo $k + 1 ?></td>
                        <td class="ma-tin"><?php echo $post['id'] ?></td>
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
                                <a class="core-view-post" target="_blank" href="<?php echo SITE_URL, '/sua-tin/?post_id=', $post['id'] ?>">
                                    <i class="fa fa-edit " par="<?php echo $post['id'] ?>"></i> Sửa
                                </a>
                                <a class="core-up-post" target="_blank"  href="<?php echo SITE_URL, '/up-tin/?post_id=', $post['id'] ?>" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-arrow-circle-o-up " par="<?php echo $post['id'] ?>"></i> Up tin
                                </a>
                                <span class=" core-delete-post" par="<?php echo $post['id'] ?>">
                                    <i class="fa fa-close" par="<?php echo $post['id'] ?>"></i> Xóa
                                </span>
                                <div class="clear"></div>
                                <div class="ready-action"></div>
                            </div>
                        </td>
                        <td class="luot-xem"><?php echo  $post['view_count'] ?></td>
                        <td class="ngay-dang"><?php echo date('d/m/Y', $post['time_create']) ?></td>
                         
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
    <?php
}


if( isset($_POST['type']) && ($_POST['type'] == 'core-delete-post') )
{
    $post_info = get_post($_POST['post_id']);
    if($post_info['user_id'] != USER_ID) die();
    delete_post($_POST['post_id']);
}

if( isset($_POST['type']) && ($_POST['type'] == 'core-show-profile') )
{
    if(empty($g_user['id']))
    {
        ?>
        <div class="pending-user">
            Bạn cần <span class="core-login">Đăng nhập</span> hoặc <span  class="core-register">Đăng ký</span>
        </div>        
        <?php
        die();
         
    }
    ?>
        
    <div class="core-profile">
        <form class="form-profile" action="" method="POST">
            <div class="billing-info">
                <div class="billing-info-item user">
                    <i class="fa fa-user"></i> ID: <span><?php echo USER_ID ?></span>
                </div>
                <div class="billing-info-item point">
                    <i class="fa fa-money"></i> Số dư hiện tại: <span><?php echo $g_user['point'] ?></span>
                </div>
            </div>
            <div class="log-warning"></div>
            <input type="hidden" value="profile" name="type" />
            <div class="clearfix">
                <div class="core-profile-avatar">
                    <?php $param = array('name'=>'image', 'default'=>$g_user['image']); display_upload_button($param) ?>
                    <img alt="<?php $g_user['display_name'] ?>" title="<?php $g_user['display_name'] ?>"  src="<?php echo $g_user['image'] ?>" />
                </div>
                
                <div class="core-profile-input">
                    <div class="v-input-item">
                        <label class="none">Email</label>
                        <input required="" name="email" type="text" class="text" placeholder="Email" value="<?php echo $g_user['email'] ?>" />
                        <div class="input-guider none">( Chúng tôi sẽ gửi mã xác nhận tài khoản tới email bạn cung cấp )</div>
                    </div>
                    
                    <div class="v-input-item text"> 
                        <label class="none">Họ và tên</label>
                        <input required="" name="display_name" type="text" class="text" placeholder="Họ và tên" value="<?php echo $g_user['display_name'] ?>" />
                    </div>
                      
                    <div class="v-input-item">
                        <label class="none">Số điện thoại</label>
                        <input required="" name="phone" type="text" class="text" placeholder="Số điện thoại" value="<?php echo $g_user['phone'] ?>">
                    </div>
                    <div class="v-input-item">
                        <label class="none">Địa chỉ</label>
                        <input  name="place" type="text" class="text" placeholder="Địa chỉ" value="<?php echo $g_user['place'] ?>">
                    </div>
                </div>
            </div>
            
             
                <div class="change-password-text"><i class="fa fa-key"></i> Đổi mật khẩu</div>
                <div class="none change-password-text-content">
                    <h3 class="none">Đổi mật khẩu</h3>
                    <div>
                        <div class="v-input-item">
                        <label class="none">Mật khẩu mới</label>
                        <input  name="password" type="password" class="text" placeholder="Mật khẩu" value="" />
                    </div>
                    
                    <div class="v-input-item">
                        <label class="none">Nhập lại mật khẩu</label>
                        <input   name="r_password" type="password" class="text" placeholder="Nhập lại mật khẩu" value="" />
                    </div>
                </div>
            </div>
            <div class="v-input-item">
                <input name="submit" type="submit" class="submit" value="Lưu lại" />
            </div>
        </form>
    </div>
    <?php
}

if( isset($_POST['type']) && ($_POST['type'] == 'profile') )
{
    
    if(!empty( $_POST['password'] ))
    {
        if( $_POST['password'] != $_POST['r_password'] )
        {
            ?>
            <div class="error-noti" style="display: block;">
                Mật khẩu không khớp nhau
            </div>
            <?php
            die();
        }
    }
    
    $update_content = array();
    foreach($g_user as $k=>$v)
    {
        if(isset($_POST[$k]))
        {
            $update_content[$k] = $_POST[$k];
        }
    }
    
    if(empty($update_content['password'])) unset( $update_content['password'] );
    else
    {
        $update_content['password'] = md5( $update_content['password'] . $g_user['secure_key'] );
        $_SESSION['password'] =  $update_content['password'];
    } 
    
    $update_id = models_DB::update($update_content, USER_TABLE, ' WHERE id=' . $g_user['id']);
    ?>
    <div class="success-noti">Cập nhật hồ sơ cá nhân thành công </div>
    <?php
}



if( isset($_POST['type']) && ($_POST['type'] == 'resend-email-button') )
{
    //Gửi mail xác nhận
    $content = '<p>Kích hoạt tài khoản tại website <b>' . SITE_URL . '</b>. Vui lòng click vào đường dẫn dưới đây để kích hoạt tài khoản của bạn </p>';
    $link_active = SITE_URL . '/inc/?page_type=active-user-from-url&user_id=' . USER_ID . '&secure-key=' . $g_user['secure_key'];
    $content  = $content . '<a href="' . $link_active . '">' . $link_active. '</a>'; 
    //$content = '<a href="' . SITE_URL . '/" </a></p>';
    
    $param = array(
        'content'       => $content,
        'login_info'    => $mail_no_reply_info,
        'to'            => $g_user['email'],
        'subject'       => 'Kích hoạt tài khoản : ' . SITE_URL
    );
    send_smtp_mail( $param );
    
    ?>
    <p class="resend-active-mail-suceess">Email kích hoạt đã được gửi tới <?php echo $g_user['email'] ?>, vui lòng kiểm tra mail của bạn</p>
    <?php
}
 
if( isset($_POST['type']) && ($_POST['type'] == 'convert-gia') )
{
    echo num_to_price( price_to_num($_POST['gia']) );
    die();
}

if( isset($_POST['type']) && ($_POST['type'] == 'forgot-password') )
{
    $exist = models_DB::get(' SELECT * FROM ' . USER_TABLE . ' WHERE email=\'' . $_POST['email_to_reset'] . '\'' );
    if(empty($exist))
    {
        ?>
        <div class="error-noti" style="display: block;">Email bạn vừa nhập không tồn tại. <span class="re-open-reset-password-form">Vui lòng kiểm tra lại</span></div>
        <?php
        die();
    }
    
    $update_content = array();
    $update_content['secure_key'] = random_string();
    models_DB::update($update_content, USER_TABLE, ' WHERE email=\'' . $_POST['email_to_reset'] . '\'');
    //Gửi mail xác nhận
    $content = '<p>Reset mật khẩu website <b>' . SITE_URL . '</b><br />. Vui lòng click vào đường dẫn dưới đây để cài đặt lại mật khẩu của bạn </p>';
    $link_active = SITE_URL . '/inc/?page_type=reset-password&user_id=' . $exist[0]['id'] . '&secure-key=' . $update_content['secure_key'];
    $content  = $content . '<a href="' . $link_active . '">' . $link_active. '</a>'; 
    //$content = '<a href="' . SITE_URL . '/" </a></p>';
    
    $param = array(
        'content'       => $content,
        'login_info'    => $mail_no_reply_info,
        'to'            => $_POST['email_to_reset'],
        'subject'       => 'Đặt lại mật khẩu : ' . SITE_URL
    );
    send_smtp_mail( $param );
    
    ?>
    <div class="success-noti">
        <p class="forgot-mail-suceess">Email reset mật khẩu đã được gửi tới <?php echo $_POST['email_to_reset'] ?>, vui lòng kiểm tra mail của bạn</p>
    </div>
    <?php
}


if( isset($_POST['type']) && ($_POST['type'] == 'load_quan_huyen') )
{     
    ?>
    <option  value="">-- Quận Huyện --</option>
    <?php
    $lists = models_DB::get('SELECT * FROM ' . KHU_VUC_TABLE . ' WHERE title=\'' . $_POST['value'] . '\'');
    if(empty($lists)) die();
    $lists = models_DB::get('SELECT * FROM ' . KHU_VUC_TABLE . ' WHERE parent=' . $lists[0]['id'] . ' ORDER BY stt DESC, id DESC ');
    /*
    $t = 'SELECT * FROM ' . KHU_VUC_TABLE . ' WHERE parent=' . $_POST['value'] . '';    
    $lists = models_DB::get($t);
    */
    ?>
    
    <?php
    foreach($lists as $list)
    {
        ?>
        <option  value="<?php echo $list['title'] ?>"><?php echo $list['title'] ?></option>
        <?php
    }
    ?>
    
    <?php
}

if( isset($_POST['type']) && ($_POST['type'] == 'load_phuong_xa') )
{     
    ?>
    <option  value="">-- Phường xã --</option>
    <?php
    $lists = models_DB::get('SELECT * FROM ' . KHU_VUC_TABLE . ' WHERE title=\'' . $_POST['value'] . '\'');
    
    if(empty($lists)) die();

    $lists = models_DB::get('SELECT * FROM ' . KHU_VUC_TABLE . ' WHERE parent=' . $lists[0]['id'] . '');
    
    ?>
    
    <?php
    foreach($lists as $list)
    {
        ?>
        <option  value="<?php echo $list['title'] ?>"><?php echo $list['title'] ?></option>
        <?php
    }
    ?>
    
    <?php
}

if( isset($_POST['type']) && ($_POST['type'] == 'core-show-nap-tien') )
{
    if(empty($g_user['id']))
    {
        ?>
        <div class="pending-user">
            Bạn cần <span class="core-login">Đăng nhập</span> hoặc <span  class="core-register">Đăng ký</span> để thực hiện giao dịch
        </div>        
        <?php
        die();
    }
    ?>
    <div>
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/nap-the.css" />
    <?php
    include PATH_ROOT . '/inc/ecommerce/billing.php';
    ?>
    </div>
    <?php
}

 
if( ( isset($_POST['type']) ) && ($_POST['type']=='nap_the_cao_dt') )
{
    define('MERCHANT_ID', get_config('admin_ecommerce_ngan_luong_merchant_id'));
    define('MERCHANT_PASSWORD', get_config('admin_ecommerce_ngan_luong_merchant_password'));
    define('MERCHANT_EMAIL', get_config('admin_ecommerce_ngan_luong_merchant_email'));
     
    include( PATH_ROOT . '/apps/demo_thecao_PHP/config.php');
    include( PATH_ROOT . '/apps/demo_thecao_PHP/includes/MobiCard.php');
    
    	$soseri = $_POST['card_seri'];
	$sopin = $_POST['card_number'];
	$type_card = $_POST['card_type'];
	
	
	if ($_POST['card_seri'] == "" ) {
		echo '<script>alert("Vui lòng nhập Số Seri");</script>';
		//echo "<script>location.href='".$_SERVER['HTTP_REFERER']."';</script>";
		exit();
	}
	if ($_POST['card_number'] == "" ) {
		echo '<script>alert("Vui lòng nhập Mã Thẻ");</script>';
		//echo "<script>location.href='".$_SERVER['HTTP_REFERER']."';</script>";
		exit();
	}
	
	 $arytype= array(92=>'VMS',93=>'VNP',107=>'VIETTEL',121=>'VCOIN',120=>'GATE');
	//Tiến hành kết nối thanh toán Thẻ cào.
	  $call = new MobiCard();
	  $rs = new Result();
	  $coin1 = rand(10,999);
	  $coin2 = rand(0,999);
	  $coin3 = rand(0,999);
	  $coin4 = rand(0,999);
	  $ref_code = $coin4 + $coin3 * 1000 + $coin2 * 1000000 + $coin1 * 100000000;
			
	  $rs = $call->CardPay($sopin,$soseri,$type_card,$ref_code,"","","");
	  
      $form_info['mail_to'] = 'hoangcongvuong@gmail.com';
      
	  if($rs->error_code == '00') {				//
		// Cập nhật data tại đây
		
        $val = $rs->card_amount;
		//$val = 10000;
        }
        else
        {
             echo  '<script>alert("Lỗi :'.$rs->error_message.'");</script>';
        }
}

if(  ( isset($_POST['type']) ) && ($_POST['type']=='up_tin') )
{
    
    $post_info = get_post($_POST['post_id']);
    $tin_vip_cat_id = models_DB::get('SELECT title, url, id FROM ' . CATEGORY_TABLE . ' WHERE url=\'tin-vip\' ');
    
    if(!empty($tin_vip_cat_id)) 
    {
        $tin_vip_cat_id = $tin_vip_cat_id[0]['id'];    
        
        
        if(empty($post_info['categories'])) $new_cats = $tin_vip_cat_id;
        else
        {
            $cats = explode(',' , $post_info['categories']);
            if(in_array($tin_vip_cat_id, $cats)) $new_cats = $post_info['categories'];
            else
            {
                $new_cats = $post_info['categories'] . ',' . $tin_vip_cat_id;
            }
        }
        
    }
    else
    {
        $new_cats = $post_info['categories'];
    }
    
     
    
    $admin_ecommerce_phi_up_tin = get_config('admin_ecommerce_phi_up_tin');
    if(empty($admin_ecommerce_phi_up_tin))
    {
        models_DB::update(array('time_update'=>hcv_time(), 'categories'=>$new_cats, 'the_status'=>'publish'), POST_TABLE, ' WHERE id=' . $_POST['post_id'] ); 
        ?>
        <div class="up_tin_success">Tin đăng được up thành công !</div>
        <?php
    }
    else
    {
        if($g_user['point'] >= $admin_ecommerce_phi_up_tin)
        {
            ?>
            <div class="up_tin_success up_tin_success-before">
                <div class="up_tin_success-before-item">
                    <span class="before-title">Phí up tin :</span>
                    <span class="before-content"><?php  echo num_to_price($admin_ecommerce_phi_up_tin) ?> điểm</span>
                </div>
                <div class="up_tin_success-before-item">
                    <span class="before-title">Số dư hiện tại :</span>
                    <span class="before-content"><?php  echo num_to_price( $g_user['point'] ) ?> điểm</span>
                </div>
                <div class="up_tin_success-before-item">
                    <span class="before-title">Số dư còn lại :</span>
                    <span class="before-content"><?php  echo num_to_price($g_user['point'] - $admin_ecommerce_phi_up_tin) ?> điểm</span>
                </div>
                <div class="xac-nhan-up-tin" par="<?php echo $_POST['post_id'] ?>"><span>Xác nhận</span></div>
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="up_tin_success up_tin_success-before">
                <p>Số dư của bạn hiện không đủ để up tin, vui lòng <span class="core-show-nap-tien"> nạp thêm </span> trước khi tiếp  tục </p>
            </div>
            <?php
        }
        
    }
}

if( ( isset($_POST['type']) ) && ( $_POST['type']=='xac_nhan_up_tin') )
{
    $post_info = get_post($_POST['post_id']);
    $tin_vip_cat_id = models_DB::get('SELECT title, url, id FROM ' . CATEGORY_TABLE . ' WHERE url=\'tin-vip\' ');
    
    if(!empty($tin_vip_cat_id)) 
    {
        $tin_vip_cat_id = $tin_vip_cat_id[0]['id'];    
        
        
        if(empty($post_info['categories'])) $new_cats = $tin_vip_cat_id;
        else
        {
            $cats = explode(',' , $post_info['categories']);
            if(in_array($tin_vip_cat_id, $cats)) $new_cats = $post_info['categories'];
            else
            {
                $new_cats = $post_info['categories'] . ',' . $tin_vip_cat_id;
            }
        }
        
    }
    else
    {
        $new_cats = $post_info['categories'];
    }
    
    $admin_ecommerce_phi_up_tin = get_config('admin_ecommerce_phi_up_tin');
    $remain = $g_user['point'] - $admin_ecommerce_phi_up_tin;
    
    if( $remain >= 0 )
    {
        models_DB::update(array('time_update'=>hcv_time(), 'categories'=>$new_cats, 'the_status'=>'publish'), POST_TABLE, ' WHERE id=' . $_POST['post_id'] ); 
        models_DB::update(array('point'=> $remain), USER_TABLE, ' WHERE id=' . USER_ID ); 
        ?>
        <div class="up_tin_success">Tin đăng được up thành công !</div>
        <?php
    }
    else
    {
        ?>
        <div class="up_tin_success up_tin_success-before">
            <p>Số dư của bạn hiện không đủ để up tin, vui lòng <span class="core-show-nap-tien"> nạp thêm </span> trước khi tiếp  tục </p>
        </div>
        <?php      
    }
}

if( ( isset($_POST['type']) ) && ( $_POST['type']=='up-tin-form') )
{
    $post_info = get_post($_POST['post_id']);
    
     
    
    ?>
    <form class="up-tin-form clearfix" action="" method="POST">
        <div class="up-tin_col1">
            <input type="hidden" id="up-tin_input-type" name="type" value="up-tin-form_submit" />
                <input type="hidden" id="up-tin_vip_cat_id" name="vip_cat_id" value="" />
                <input type="hidden" id="up-tin_total_price" name="up-tin_total_price" value="" />
                <input type="hidden" id="" name="post_id" value="<?php echo $_POST['post_id'] ?>" />
                
                <h1><span></span> Up tin <span class="real-name"><?php echo $post_info['title'] ?></span> </h1>
                <div class="core-wrap-option clearfix">
                    <div class=" core-wrap-option-title">
                        Loại tin
                    </div>
                    <div class="core-list-vip core-wrap-option-content">
                        <?php
                        $stt = 1;
                        for($i=1;$i<=5;$i++)
                        {
                            ${'admin_ecommerce_vip' . $i . '_cat_id'} = get_config('admin_ecommerce_vip' . $i .'_cat_id');
                            ${'admin_ecommerce_vip' . $i . '_gia'} = get_config('admin_ecommerce_vip' . $i .'_gia');
                            if(!empty(${'admin_ecommerce_vip' . $i . '_cat_id'}))
                            {
                                $category = get_category(${'admin_ecommerce_vip' . $i . '_cat_id'});
                                if(!empty($category))
                                {
                                    ?>
                                    <div cat_id="<?php echo $category['id'] ?>" gia="<?php echo ${'admin_ecommerce_vip' . $i . '_gia'} ?>" class="<?php if($stt == 1) echo 'active' ?> core-list-vip-item clearfix">
                                        <div class="core-list-vip-item-cat">
                                            <?php echo $category['title'] ?>
                                        </div>
                                        <div class="core-list-vip-item-gia">
                                            <?php echo num_to_price(${'admin_ecommerce_vip' . $i . '_gia'}) ?> vnđ
                                        </div>
                                    </div>
                                    <?php
                                }
                                $stt++;
                            }
                        }
                
                        ?>
                        </div>
                </div>
                
                <div class="core-wrap-option clearfix">
                    <div class=" core-wrap-option-title">
                        Thời gian
                    </div>
                    <div class="core-up-tin-thoi_gian core-wrap-option-content">
                       <p><span style="display: inline-block;width:40px">Từ</span>  <input id="up-tin-start_time" value="<?php echo date('Y-m-d\TH:i', hcv_time()) ?>"  type="datetime-local" name="start_time" class=" text " /></p>
                       <p><span style="display: inline-block;width:40px">đến</span> <input  id="up-tin-end_time" value="<?php echo date('Y-m-d\TH:i', hcv_time() + 86400*3) ?>"  type="datetime-local" name="end_time" class=" text " /></p>
                       
                    </div>
                </div>
        </div>
        <div class="up-tin_col2">
            <div class="up-tin_col2-title">
                Thông tin thanh toán
            </div>
            <div class="up-tin_col2-content">
                <div>
                    <span class="price-title">Số dư hiện tại</span>
                    <span class="current-price"><?php echo num_to_price($g_user['point']) ?> vnđ</span>
                </div>
                <span class="clear"></span>
                <div>
                    <span class="price-title">Thành tiền</span>
                    <span class="price"></span>
                </div>
                
                
            </div>
            <div class="submit">
                <input type="submit" value="Xác nhận" name="submit" />
            </div>
        </div>
        
    </form>
    <?php
}
 
if( ( isset($_POST['type']) ) && ( $_POST['type']=='cal_before_up_tin') )
{
    $start_time = strtotime($_POST['start_time'] );
    $end_time = strtotime($_POST['end_time'] );
    $day = floor(($end_time - $start_time) / 86400);
    $so_du  = ($end_time - $start_time) % 86400;
    if($so_du > 0) $day++;
    
    echo num_to_price( $_POST['gia'] * $day ) . ' vnđ ';
}

if( ( isset($_POST['type']) ) && ( $_POST['type']=='up-tin-form_submit') )
{
     
    $post_info = get_post($_POST['post_id']);
    if($post_info['user_id'] != USER_ID ) die();
    
    $start_time = strtotime($_POST['start_time'] );
    $end_time = strtotime($_POST['end_time'] );
    $day = floor(($end_time - $start_time) / 86400);
    $so_du  = ($end_time - $start_time) % 86400;
    if($so_du > 0) $day++;
    
    $tong = price_to_num($_POST['up-tin_total_price']);
     
    
    $remain = $g_user['point'] - $tong;
    
    
     
    
    if( $remain >= 0 )
    {
        
        
        $categories = $post_info['categories'];
        if(empty($categories)) $new_cats = $_POST['vip_cat_id'];
        else 
        {
            $old_cats = explode(',', $categories);
            if(in_array($_POST['vip_cat_id'], $old_cats)) $new_cats = $categories;
            else $new_cats =  $categories . ',' . $_POST['vip_cat_id'];
        }
        
        
        $update_content = array(
            'start_time'    => $start_time,
            'end_time'      => $end_time,
            'the_status'    => 'publish',
            'categories'    => $new_cats
        );
        
         
        
        models_DB::update($update_content, POST_TABLE, ' WHERE id=' . $_POST['post_id'] ); 
        models_DB::update(array('point'=> $remain), USER_TABLE, ' WHERE id=' . USER_ID ); 
        ?>
        <div class="up_tin_success">Tin đăng được up thành công !</div>
        <?php
    }
    else
    {
        ?>
        <input type="submit" value="Xác nhận" name="submit" />
        <div class="up_tin_success up_tin_success-before">
            <p>Số dư của bạn hiện không đủ để up tin, vui lòng <span class="core-show-nap-tien"> nạp tiền </span> trước khi tiếp  tục </p>
        </div>
        <?php      
    }
}
 