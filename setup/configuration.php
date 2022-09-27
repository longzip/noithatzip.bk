<?php
    define('SECURE_CHECK', TRUE);

    if(!file_exists(dirname(dirname(__FILE__)) . '/config.php')) 
    {
        header('Location:index.php');   
    }
    if(file_exists(dirname(dirname(__FILE__)) . '/.htaccess')) die('Already Setup');
     
    
	
    
    define('LANG', 'eng');
	require dirname(dirname(__FILE__)) . '/system/helper/form.php';
    
    $result_url = 'http';
    if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) $result_url = 'https';
    $result_url .= '://';
    $result_url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    $site_url = str_replace('/setup/configuration.php', '', $result_url);
 
if(isset($_POST['submit_general_info'])) 
{
    
    validate_value('site_url','Site Url', FALSE, array('type'=>'url'));
    validate_value('user_name','User Name', FALSE, array('type'=>'user_name'));
    validate_value('password','Password', FALSE, array('type'=>'password'));
    validate_value('email','Email', FALSE, array('type'=>'email')); 
    validate_value('attachment_per_folder','Attachment per folder', FALSE, array('type'=>'number'));
    validate_value('table_prefix','Table prefix', FALSE, array('type'=>'user_name'));
    
   
    
    $standard = true;
    
   
    
    if(!form_validation())
    {   
        show_form_error();
        $standard = false;
    }
    
    if($_POST['password'] != $_POST['r_password'])
    {
        echo '<p class="error-noti noti">Password không khớp nhau</p>';
        $standard = false;
    }
    
    if($standard) 
    {
        
        include 'init.php';
        
        header('Location: ' . $_POST['site_url'] . '/admin/');
        exit;
    } 
}
?>

<!DOCTYPE HTML>
<html>
<head>
		<title>Setup General Infomation </title>
        <meta charset="utf-8" />
        
        <link type="text/css" rel="stylesheet" href="setup.css" />
</head>

<body>

<form id="setup-form" action="" method="POST">
    <h1>Setup General Infomation</h1>
    

    
    <div class="form-item">
        <label>Site Name : <input required type="text" name="site_name" value="<?php return_value('site_name', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    
    <div class="form-item">
        <label>Site Description : <input required type="text" name="description" value="<?php return_value('description', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>Site URL : <input required type="url" name="site_url" value="<?php return_value('site_url', $site_url, FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    <hr />
    
    <div class="form-item">
        <label>User Name : <input required type="text" name="user_name" value="<?php return_value('user_name', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>Password : <input required type="text" name="password" value="<?php return_value('password', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>Password Repeat : <input required type="text" name="r_password" value="<?php return_value('r_password', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>Email : <input required type="email" name="email" value="<?php return_value('email', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    <hr />
    
     
    
    <div class="form-item">
        <label>Max attachment per folder : <input required type="number" name="attachment_per_folder"  value="<?php return_value('attachment_per_folder', '1000', FALSE, FALSE) ?>"/></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>Table prefix : <input required type="text" name="table_prefix" value="<?php return_value('table_prefix', 'hcv_', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>URL suffix : <input  type="text" name="url_suffix" value="<?php return_value('url_suffix', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item" id="submit">
        <input type="submit" value="Submit" name="submit_general_info" /></label>
    </div>
    
    <span class="clear"></span>
</form>

</body>
</html>