<?php

$user = get_user($_GET['user_id']);
if(empty($user)) die('Tài khoản không tồn tại!');
if($user['secure_key'] != $_GET['secure-key']) die('Sai mã kích hoạt');
 
 

$g_form_error_noti = array();
$update_content = array();
if(isset($_POST['submit']))
{
    validate_value('password','Mật khẩu', FALSE, array('type'=>'password'));
    if(!empty($g_form_error_noti)) $case = 'error';
    else
    {
        if( $_POST['password'] != $_POST['r_password'] )
        {
              $case = 'missmatch-password';
              $g_form_error_noti[] = 'Mật khẩu không khớp nhau'; 
        } 
        else
        {
            $case = 'success';
            $update_content['password'] = md5( $_POST['password'] . $user['secure_key'] );
            models_DB::update($update_content, USER_TABLE, ' WHERE id=' . $_GET['user_id'] );
            $_SESSION['password'] =  $update_content['password'];
            $_SESSION['user_name'] =  $user['user_name'];
        }
    }
    
}
else $case = 'ori';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đặt lại mật khẩu</title>
    <meta charset="utf-8" />
    
    <script src="<?php echo CDN_DOMAIN ?>/apps/js/jquery-1.10.2.js"></script>
    
</head>

<body>
    <style>
        body {
        font-family: Verdana, arial;
        font-size: 14px;
    }
    
    .success {
        padding: 5px 10px;
        background: #d2eef5;
        border-radius: 5px;
        line-height: 35px;
        margin: 20px;
        text-align: center;
    }
    
    * {
        margin: 0;
        padding: 0;
    }
    
    .success .second-p a {
        color: #fff;
        text-decoration: none;
        background: #e2a04b;
        padding: 0 10px;
        border-radius: 5px;
        display: inline-block;
    }
    
    .success .second-p a:hover {
            background: #a76715;
        }
        
        p.second-p .num {
            font-size: 19px;
            color: #0b84bf;
        }
        form.success {
        max-width: 500px;
        margin: 20px auto;
        padding: 10px 20px;
        box-sizing: border-box;
    }
    
    .form-item input {
        display: block;
        width: 100%;
        margin: 15px auto;
        border: 1px solid #f1f1f1;
        padding: 6px 10px;
        box-sizing: border-box;
    }
    
    input.submit {
        background: #2dabcc;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        border: 0;
    }
    form.success h1 {
        font-size: 18px;
        color: #5f5f5f;
    }
    
    input.submit:hover {
        background: #167892;
    }
    .error-noti {
        background: #f1ca5c;
        border-radius: 2px;
        margin: 10px auto;
        font-size: 12px;
    }
    </style>
    <script>
        $("document").ready(function(){
             
        });
    </script>
    
    
    <?php 
        switch($case)
        {
            case 'ori' :
            {
                ?>
                <form action="" method="POST" class="success">
                    <div class="form-item" >
                        <h1>Đặt lại mật khẩu</h1>
                        <input class="text" required="" type="text" placeholder="Nhập mật khẩu mới" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" />
                        <input class="text" required="" type="text" placeholder="Nhập lại mật khẩu mới" name="r_password" value="<?php if(isset($_POST['r_password'])) echo $_POST['r_password'] ?>" />
                        <input class="submit" type="submit" name="submit" value="Gửi" />            
                    </div>
                </form>
                <?php
                break;
            }
            case 'error' :
            {
                ?>
                <form action="" method="POST" class="success">
                    <div class="form-item" >
                        <h1>Đặt lại mật khẩu</h1>
                        <div class="error-noti">
                            <?php 
                                foreach($g_form_error_noti as $k=>$v)
                                {
                                    echo $v;
                                    ?>
                                    
                                    <?php
                                }
                            ?>
                        </div>
                        <input class="text" required="" type="text" placeholder="Nhập mật khẩu mới" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" />
                        <input class="text" required="" type="text" placeholder="Nhập lại mật khẩu mới" name="r_password" value="<?php if(isset($_POST['r_password'])) echo $_POST['r_password'] ?>" />
                        <input class="submit" type="submit" name="submit" value="Gửi" />            
                    </div>
                </form>
                <?php
                break;
            }
            
            case 'missmatch-password' :
            {
                ?>
                <form action="" method="POST" class="success">
                    <div class="form-item" >
                        <h1>Đặt lại mật khẩu</h1>
                        <div class="error-noti">
                            <?php 
                                foreach($g_form_error_noti as $k=>$v)
                                {
                                    echo $v;
                                    ?>
                                    
                                    <?php
                                }
                            ?>
                        </div>
                        <input class="text" required="" type="text" placeholder="Nhập mật khẩu mới" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" />
                        <input class="text" required="" type="text" placeholder="Nhập lại mật khẩu mới" name="r_password" value="<?php if(isset($_POST['r_password'])) echo $_POST['r_password'] ?>" />
                        <input class="submit" type="submit" name="submit" value="Gửi" />            
                    </div>
                </form>
                <?php
                break;
            }
            
            case 'success' :
            {
                ?>
                <div class="success">
                    <p class="first-p">Xin chúc mừng, tài khoản của bạn đã được xác minh</p>
                    <p class="second-p">Click vào <a href="<?php echo SITE_URL ?>">đây</a> hoặc đợi trình duyệt tự chuyển sau <span class="num">5</span>s</p>
                    
                </div>
                <script>
                    $("document").ready(function(){
                        setInterval(function(){
                            var remain = parseInt($(".second-p .num").text());
                            remain--;
            
                            if(remain == 0){
                                window.location = "<?php  echo SITE_URL ?>";
                                return;
                            }
                            $(".second-p .num").text(remain);
                        }, 1000);
                    });
                </script>
                <?php
                die();
            }
        }
    ?>
    
</body>
</html>