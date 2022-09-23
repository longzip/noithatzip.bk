<?php
    session_start();

	define('SECURE_CHECK', TRUE);

    include 'config.php';
	
	setcookie('user_name', '', time() - 36000*24*1000, '/');
	
	setcookie('password', '', time() - 36000*24*1000, '/');
    
    if($g_user['id']) 
    {
        header('Location:'. SITE_URL . '/admin/');
    
        die();
    }
    
	
    if(isset($_POST['submit']))
    {
        validate_value('user_name','Tên đăng nhập', FALSE, array('type'=>'user_name'));
        validate_value('password','Mật khẩu', FALSE, array('type'=>'password'));

        if(form_validation())
        {
            $exist_user_name = models_DB::get('SELECT id, secure_key FROM ' . USER_TABLE . ' WHERE user_name=\'' . $_POST['user_name'] .'\'');
            if(empty($exist_user_name))
            {
                $g_form_error_noti[] = 'Sai tên đăng nhập hoặc mật khẩu';
            }
            else
            {
                $exist1 = models_DB::get('SELECT id FROM ' . USER_TABLE . ' WHERE user_name=\'' . $_POST['user_name'] .'\' AND password=\'' . md5($_POST['password'] . $exist_user_name[0]['secure_key']) . '\'');
            
                if(empty($exist1))
                {
                    $g_form_error_noti[] = 'Sai tên đăng nhập hoặc mật khẩu';
                }
                else
                {
                    //setcookie('user_name', $_POST['user_name'], time() + 3600*24*3, '/');
                    //setcookie('password', md5($_POST['password']), time() + 3600*24*3, '/');
                    
                    $_SESSION['user_name'] = $_POST['user_name'];
                    $_SESSION['password'] = md5($_POST['password'] . $exist_user_name[0]['secure_key']);
                    
                     
    				if(isset($_GET['continue']))
    				{
    					header('Location:'.  urldecode($_GET['continue']) );
    				}
    				else
    				{
    					header('Location:'.  SITE_URL) ;
    				}
    				
                }
            }            
        }
    }
    
	//h($g_form_error_noti);
	
    
?>




<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8" />
	<title>Đăng nhập</title>
	
	<link rel="stylesheet" type="text/css" href="inc/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="inc/css/login.css" />
</head>



<div id="main-content" class="row register">
    <div class="col1 col col-9-6 fl" id="login">
        <div class="inner">
            
			
            <h1 class="title-font h1-title">Đăng nhập tài khoản</h1>
            
            
            
            
            <span class="clear"></span>
            <hr />
             <?php show_form_error() ?>
    
            
            
            <form  class="block" action="" method="POST">
                <div class="field-item">
                    <div class="option-content">
                        <label for="user_name" class="fl">Tên đăng nhập</label>
                        <div class="field fl">
                            <input required="" type="text" name="user_name" id="user_name" value="<?php return_value('user_name', '', FALSE, FALSE) ?>" />
                            <br />
                            
                        </div>
                        
                        <span class="clear"></span>
                        

                    </div>
                </div>
                
                <div class="field-item">
                    <div class="option-content">
                        <label for="password" class="fl">Mật khẩu</label>
                        <div class="field fl">
                            <input required="" type="password" name="password" id="password" value="<?php return_value('password', '', FALSE, FALSE) ?>" />
                        </div>
                        
                        <span class="clear"></span>
                    </div>
                </div>
                
                
                <div class="field-item">
                    <div class="option-content">
                        <label for="password" class="fl">&nbsp;</label>
                        <div class="submit fl">
                            <input type="submit" class="title-font pointer btn btn-info" name="submit" id="submit" value="Đăng nhập" />
                            <br />
                            
                        </div>
                        
                        <div class="forgot-password fl">
                            <a href="<?php hcv_url('forgot-password') ?>">Quên mật khẩu ?</a>
                        </div>
                        
                        <span class="clear"></span>
                        

                    </div>
                    <span class="clear"></span>
                </div>
                
                <hr /> 
                
               
			   
                <span class="clear"></span>
                
              
            </form>
        
        
            
        </div>
    </div>
    
	
    
    <span class="clear"></span>
</div>


</body>

</html>