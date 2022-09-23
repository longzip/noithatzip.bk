<?php

define('LANG', 'eng');
require dirname(dirname(__FILE__)) . '/system/helper/form.php';
require dirname(dirname(__FILE__)) . '/inc/lang/' . LANG . '.php';

define('SECURE_CHECK', TRUE);

if(file_exists(dirname(dirname(__FILE__)) . '/config.php')) 
{
    require dirname(dirname(__FILE__)) . '/config.php'; 
    if(defined('SITE_URL')) header('Location:' . SITE_URL);
    else header('Location:configuration.php');
}

if(isset($_POST['submit']))
{
     
    $database_connect =  new mysqli($_POST['db_host'], $_POST['db_user'], $_POST['db_password'], $_POST['db_name']);
    
    
    validate_value('db_host','Dabatase Host', '/^[a-zA-Z0-9_]+$/');
    validate_value('db_user','Dabatase User', '/^[a-zA-Z0-9_]+$/');
    //validate_value('db_password','Dabatase Password', '/^[a-zA-Z0-9_]+$/');
    validate_value('db_name','Dabatase Name', '/^[a-zA-Z0-9_]+$/');
    
    if(form_validation())
    {
        if($database_connect->connect_errno)
        {
            ?>
            <p class="error-noti noti"><?php echo DATABASE_ERROR_NOTI ?></p>
            <?php
        }
        else
        {
            
            
            $file_config = fopen(dirname(dirname(__FILE__)) . '/config.php', 'w');
            
            $txt = '<?php' . "\n"; 
            $txt .= 'if(!defined(\'SECURE_CHECK\')) die(\'Stop\');' . "\n";       
            
            $txt .= 'define(\'DB_HOST\', \'' . $_POST['db_host'] . '\');' . "\n";    
            $txt .= 'define(\'DB_USER\', \'' . $_POST['db_user'] . '\');' . "\n";    
            $txt .= 'define(\'DB_PASSWORD\', \'' . $_POST['db_password'] . '\');' . "\n";    
            $txt .= 'define(\'DB_DATABASE\', \'' . $_POST['db_name'] . '\');' . "\n\n";    
            $txt .= 'define(\'MAX_UPLOAD_DIR_SIZE\', 1000000000);' . "\n\n";   
            
            fwrite($file_config, $txt);
            fclose($file_config);
            
            header('Location:configuration.php');
            exit;
        }
    }
    
}
 
    

?>
<!DOCTYPE HTML>
<html>
<head>
		<title><?php echo SETUP_TITLE ?> </title>
        <meta charset="utf-8" />
        
        <link type="text/css" rel="stylesheet" href="setup.css" />
</head>

<body>


<form id="setup-form" action="" method="POST">
    <h1><?php  echo SETUP_H1 ?></h1>
    


    
    <div class="form-item">
        <label>Database Host : <input type="text" name="db_host" value="<?php return_value('db_host', 'localhost', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    
    <div class="form-item">
        <label>Database User : <input type="text" name="db_user" value="<?php return_value('db_user', '', FALSE, FALSE) ?>"/></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>Database Password : <input type="text" name="db_password" value="<?php return_value('db_password', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item">
        <label>Database Name : <input type="text" name="db_name" value="<?php return_value('db_name', '', FALSE, FALSE) ?>" /></label>
    </div>
    <span class="clear"></span>
    
    <div class="form-item" id="submit">
        <input type="submit" value="Submit" name="submit" />
    </div>
    
    <span class="clear"></span>
</form>

</body>
</html>