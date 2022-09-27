<!DOCTYPE html>
<html>
<head>
    <title>Kích hoạt tài khoản</title>
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
    </style>
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
        $user = get_user($_GET['user_id']);
        if(empty($user)) die('Tài khoản không tồn tại!');
        if($user['secure_key'] != $_GET['secure-key']) die('Sai mã kích hoạt');
        $update = array('the_status'=>'active');
        models_DB::update($update, USER_TABLE, ' WHERE id=' . $_GET['user_id'] );
    ?>
    <div class="success">
        <p class="first-p">Xin chúc mừng, tài khoản của bạn đã được xác minh</p>
        <p class="second-p">Click vào <a href="<?php echo SITE_URL ?>">đây</a> hoặc đợi trình duyệt tự chuyển sau <span class="num">5</span>s</p>
    </div>
</body>
</html>