<?php
//session_start();
define('SECURE_CHECK', true);
 
include dirname(dirname(__FILE__)).'/config.php';

if(!user_can('editor')) die();

if($g_user['permission'] != 'admin') die('');

if(!isset($_POST['type'])) die();



if($_POST['type']=='load_folder_content')
{   
    $items = hcv_scandir($_POST['dir_path']);
    foreach($items as $base_name=>$file_path)
    {
        ?>
        <div class="dirbox <?php if(is_dir($file_path)) echo 'folder load-folder-content'; else echo 'file' ?>" relative_path="<?php echo str_replace(PATH_ROOT . '/', '', $file_path) ?>" dir_path="<?php echo $file_path ?>">
                        
             <div class="fl"><?php echo $base_name ?></div> 
             
             <div class="fr">
                <?php 
                    if(is_dir($file_path))
                    {
                        ?>
                        <span class="dir-action rename">Rename</span>
                        <span class="dir-action delete">Delete</span>
                        
                        <?php
                    } 
                    else
                    {
                         
                        ?>
                        <a target="_blank" href="<?php echo SITE_URL ?>/admin/edit-tpl-file?file=<?php echo urlencode(str_replace(PATH_ROOT . '/tpl', '', $file_path)) ?>" class="dir-action view">View</a>
                        <a target="_blank" href="<?php echo SITE_URL ?>/admin/edit-tpl-file?file=<?php echo urlencode(str_replace(PATH_ROOT . '/tpl', '', $file_path)) ?>" class="dir-action edit">Edit</a>
                        <span class="dir-action rename">Rename</span>
                        <span class="dir-action delete">Delete</span>
                        <?php
                    }
                ?>
             </div>
             <span class="clear"></span>
        </div>
        <?php
    } 
}

if($_POST['type']=='load_bread_crumb')
{   
    $current_path = $_POST['dir_path'];
    
    $result = array();
    
    $index = array();
    
    while($current_path != PATH_ROOT . '/tpl')
    {
        //echo basename($current_path), '<br />';
        $result[] = $current_path;
        $index[] = basename($current_path);
        $current_path = dirname($current_path);
    }
    
    $result = array_reverse($result);
    $index = array_reverse($index);
     
    
     
    
    ?>
    <span class="load-folder-content  bread-crumb-item" dir_path="<?php echo PATH_ROOT ?>/tpl">
             tpl             
        </span>
        <span class="arrow"> » </span>
    <?php
    
    foreach($result as $k=>$v)
    {
        if($k != (count($result) - 1))
        {
        ?>
        <span class="load-folder-content bread-crumb-item" dir_path="<?php echo $v ?>">
             <?php echo $index[$k] ?>             
        </span>
        <span class="arrow"> » </span>
        <?php
        }
        else
        {
            ?>
            <span class="current bread-crumb-item">
                 <?php echo $index[$k] ?>             
            </span>
            <?php
        }
    }     
}

if($_POST['type']=='change_url')
{
    $result = str_replace(PATH_ROOT . '/tpl/', '', $_POST['dir_path']);
    
    //echo $result;die();
    
    echo '?dir_path=' . urlencode( $result);
}


if($_POST['type']=='save_file')
{
   $file = fopen($_POST['dir_path'], 'w');
   $result = fwrite($file, $_POST['content']);
   fclose($file);
    
   if($result) echo 'Success';
   else echo 'Error';
}



 

 