<?php

//session_start();
$exclude_folders = array('templates_c', 'config', 'cache');
$exclude_extensions = array('php');

if(!defined('SECURE_CHECK')) die('Stop'); 

if(!isset($_POST['type'])) die();

clear_smarty_cache();
 
if($_POST['type']=='get_dir_item')
{
    display_dir_content( urldecode($_POST['dir']) );
}

$inc = array('css');
$mini_file = FALSE;


 
 

if($_POST['type']=='get_file_content')
{
    $path_info = pathinfo( $_POST['dir'] );
    
    $a = file_get_contents( urldecode($_POST['dir']) );
        
    if(in_array($path_info['extension'], $inc))
    {
        if( !empty($_POST['mini_file']) )
        {
            $mini_file = TRUE;
        }
    }
    
    if( $mini_file )
    {
        
        $a = str_replace('{', "{" . PHP_EOL . '    ', $a);
        $a = str_replace(';}', '091117', $a);
        $a = str_replace('}', PHP_EOL . "}" . PHP_EOL, $a);        
        $a = str_replace(';', ';' . PHP_EOL . "    ", $a);
        $a = str_replace('091117', ';' . PHP_EOL . '}', $a);
        $a = str_replace('}', "}" . PHP_EOL, $a);         
    }
    
    echo $a;
}

if($_POST['type']=='save_editor')
{
    $path_info = pathinfo( $_POST['current_dir'] );
    if(empty($_POST['current_dir'])) die();
     
    
    
    $dir = urldecode($_POST['current_dir']);
     
    $myfile = fopen($dir, "r") or die("Unable to open file!");
    $a = fread($myfile,filesize( $dir ));
    echo $a;
    if(in_array($path_info['extension'], $inc))
    {
        if( !empty($_POST['mini_file']) )
        {
            $mini_file = TRUE;
        }
    }
    if( $mini_file )
    {
        $a = str_replace('{', "{" . PHP_EOL . '    ', $a);
        $a = str_replace(';}', '091117', $a);
        $a = str_replace('}', PHP_EOL . "}" . PHP_EOL, $a);        
        $a = str_replace(';', ';' . PHP_EOL . "    ", $a);
        $a = str_replace('091117', ';' . PHP_EOL . '}', $a);
        $a = str_replace('}', "}" . PHP_EOL, $a);        
    }
    
    
	$insert_content = array(
		'name'		        => str_replace(PATH_ROOT . '/tpl/tpl/', '', $dir),
		'time_create'		=> hcv_time(),
		'content'			=> $a, 
        'user_id'           => $g_user['id']
	);

     
    
    $a = $_POST['content'];
    
    $space = ' ';
    if( $mini_file )
    {
        $a = str_replace(PHP_EOL, '', $a);
        for($i = 0;$i<=20;$i++)
        {
            $a = str_replace('  ', ' ', $a);
            
            $a = str_replace('} ', "}", $a); 
            $a = str_replace(' }', "}", $a);
            
            $a = str_replace('{ ', '{', $a); 
            $a = str_replace(' {', "{", $a); 
            
            $a = str_replace('; ', ";", $a);
            $a = str_replace(' ;', ";", $a);
            
            $a = str_replace(': ', ":", $a);
            $a = str_replace(' :', ":", $a); 
        }
        
          
         
    }
    $_POST['content'] = $a;
    
    file_put_contents( urldecode($_POST['current_dir']), $_POST['content']) ;
    
    
    
   
    //Update front_end_version
    $template_id = str_replace(PATH_ROOT . '/tpl/tpl/', '', $dir);
    $template_id = explode('/', $template_id);
    $template_id = $template_id[0];
    $template_id;
    
    $v = get_config('front_end_version');
    if(empty($v)) update_config('front_end_version', 1);
    $v++;
    update_config('front_end_version', $v);    
    
    $myfile = fopen(PATH_ROOT . '/inc/front_end_version.php', "r") or die("Unable to open file!");
    $ori_front_end = fgets($myfile,filesize(PATH_ROOT . '/inc/front_end_version.php'));
    fclose($myfile);
    
    $ori_front_end = str_replace("<?php define('FRONT_END_VERSION', ", "", $ori_front_end);
    $ori_front_end = str_replace(");", "", $ori_front_end);
    $ori_front_end = $ori_front_end + 1;
    
    $myfile = fopen(PATH_ROOT . '/inc/front_end_version.php', "w") or die("Unable to open file!");
    $txt = "<?php define('FRONT_END_VERSION', " . $ori_front_end . ");";     
    fwrite($myfile, $txt);
    fclose($myfile);
}
if($_POST['type']=='get_file_path_for_nav')
{
    echo str_replace(PATH_ROOT . '/tpl/tpl/', '', urldecode($_POST['dir']));
}

if($_POST['type']=='new_dir')
{
    if(file_exists(urldecode($_POST['dir']) . '/' . $_POST['dir_name'])) die("exist");
    mkdir(urldecode($_POST['dir']) . '/' . $_POST['dir_name']);
    $list_dir = $_POST['dir_name'];
    $dir = urldecode($_POST['dir']);
    
     
    
    $current_dir = $dir . '/' . $list_dir;
    
     
    
        if(in_array($list_dir, $exclude_folders)) continue;
        if( is_file( $current_dir ) )
        {
            $path_info = pathinfo($current_dir);
            if( in_array($path_info['extension'], $exclude_extensions) ) continue;
        }
        $image_size = @getimagesize($current_dir);
        ?>
        <div class="wrap-file-item">
            <div class="clearfix file-item file-item-<?php echo $k ?> <?php if( is_file( $current_dir ) ) echo 'type-file';else echo 'type-dir' ?>">
                <a class="fl" dir_name="<?php echo $list_dir ?>" dir="<?php echo urlencode(  $current_dir) ?>" href="<?php echo SITE_URL ?>/admin/?page_type=editor&dir=<?php echo urlencode(  $current_dir) ?>">
                <?php 
                    if(!empty($image_size))
                    {
                        ?>
                        <img class="image-thumb" src="<?php echo cdn_timthumb_url(str_replace(PATH_ROOT, CDN_DOMAIN, $current_dir), 15, 15) ?>" />
                        <?php
                    }
                    else
                    {
                        if( is_file( $current_dir ) )
                        {
                            ?>
                            <i class="fa fa-file-code-o" aria-hidden="true"></i>                                    
                            <?php                                     
                         }
                        else
                        {
                            ?>
                            <i class="fa fa-folder-o" aria-hidden="true"></i>
                            <?php                     
                        }  
                    }
                    
                    ?>
                
                 
                <?php echo $list_dir ?>  
                </a>
                <?php 
                    if( !is_file( $current_dir ) )
                    {
                        ?>
                        <div class="fr none folder-action">
                            <i class="new-dir fa fa-folder-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="new-file fa fa-file-code-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="new-upload fa fa-cloud-upload" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="delete-dir fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="fr none folder-action">
                            <i class="delete-file fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        </div>
                        <?php
                    }
                ?>
                
            </div>
        </div>
        <?php
}
 
if($_POST['type']=='new_file')
{
    if(file_exists(urldecode($_POST['dir']) . '/' . $_POST['dir_name'])) die("exist");
    
    $path_info = pathinfo($_POST['dir_name']);
    if( in_array($path_info['extension'], $exclude_extensions) ) die('invalid');
    
     
    
    $myfile = fopen(urldecode($_POST['dir']) . '/' . $_POST['dir_name'], "w");
    fclose($myfile);
    
    $list_dir = $_POST['dir_name'];
    $current_dir = urldecode($_POST['dir']) . '/' . $list_dir;
    
     
    include PATH_ROOT . '/admin/inc/editor-file-item.php';
}

if($_POST['type']=='delete_file')
{
    
    
    
    
    $dir = urldecode($_POST['dir']);
    
    $myfile = fopen($dir, "r") or die("Unable to open file!");
	$insert_content = array(
		'name'		        => str_replace(PATH_ROOT . '/tpl/tpl/', '', $dir),
		'time_create'		=> hcv_time(),
		'content'			=> fread($myfile,filesize( $dir )),
        'user_id'           => $g_user['id']
	);
     
    
    unlink(urldecode($_POST['dir']));
}

if($_POST['type']=='view_backup_file')
{
    $external_connent = new models_ExternalDB($external_db);
    
    if( !empty($_POST['path_name']) ) $t = 'SELECT * FROM hcv_backup_editor WHERE name LIKE \'%' . $_POST['path_name'] .  '%\' ORDER BY id DESC limit 1000' ;
    else $t = 'SELECT * FROM hcv_backup_editor ORDER BY id DESC limit 1000';
     
    $lists = $external_connent->get($t);
    
    foreach($lists as $k=>$list)
    {
        $user = get_user($list['user_id']);
        if(empty($user['display_name'])) $user['display_name'] = $user['user_name'];
        
        $list['name'] = str_replace('/home/zland/web/', '', $list['name']);
        for($i=1;$i<=20;$i++)
        {
            $list['name'] = str_replace('/home/zland' . $i . '/web/', '', $list['name']);
        }
        
        
        ?>
        <div class="backup-item" >
            <div class="backup-item-name" par="<?php echo $list['id'] ?>">
                <?php echo $k+1 ?>. <?php echo $list['name'] ?> <span class="time"> <span class="bold"><?php echo $user['display_name'] ?></span> (<?php echo date('d/m/Y - H:i:s', $list['time_create']) ?>)</span>
            </div>
            <div class="backup-item-content backup-item-content-<?php echo $list['id'] ?>" >
                <textarea spellcheck="false"><?php echo $list['content'] ?></textarea>
            </div> 
        </div>
        <?php
    }
}


if($_POST['type']=='unminify')
{
    $path_info = pathinfo( $_POST['dir'] );
    
    $a = $_POST['content'];
         
    if(in_array($path_info['extension'], $inc))
    {
        $a = str_replace(PHP_EOL, '', $a);
        for($i = 0;$i<=20;$i++)
        {
            $a = str_replace('  ', ' ', $a);
            
            $a = str_replace('} ', "}", $a); 
            $a = str_replace(' }', "}", $a);
            
            $a = str_replace('{ ', '{', $a); 
            $a = str_replace(' {', "{", $a); 
            
            $a = str_replace('; ', ";", $a);
            $a = str_replace(' ;', ";", $a);
            
            $a = str_replace(': ', ":", $a);
            $a = str_replace(' :', ":", $a);
        }
        
        $a = str_replace('{', "{" . PHP_EOL . '    ', $a);
        $a = str_replace(';}', '091117', $a);
        $a = str_replace('}', PHP_EOL . "}" . PHP_EOL, $a);        
        $a = str_replace(';', ';' . PHP_EOL . "    ", $a);
        $a = str_replace('091117', ';' . PHP_EOL . '}', $a);
        $a = str_replace('}', "}" . PHP_EOL, $a);        
    }
    echo $a;
}





//Custom TPL

function duplicate_folder($old_path, $new_path)
{
    $old_lists = scandir($old_path);
    
    //$olds = array_diff(array('.', '..'), $old_lists);
     unset($old_lists[0], $old_lists[1]);
     
     
     $olds = $old_lists;
     
     
     
    foreach($olds as $old)
    {
        $old_t_path = $old_path . '/' . $old;
        $new_t_path = $new_path . '/' . $old;
        
        if(is_dir($old_t_path ))
        {
            if(!file_exists( $new_path . '/' . $old )) mkdir($new_path . '/' . $old);
            duplicate_folder($old_t_path, $new_path . '/' . $old);
        }
        else
        {
            $myfile = fopen($old_t_path, "r") or die("Unable to open file!");
            if(filesize( $old_t_path ) == 0) continue;
            $file_content =  fread($myfile,filesize( $old_t_path ));
            fclose($myfile);
            
            $myfile = fopen($new_t_path, "w") or die("Unable to open file!");            
            fwrite($myfile, $file_content);
            fclose($myfile);
             
        }
        
    }
}


if($_POST['type']=='active_custom_tpl')
{
    if(!file_exists( CLIENT_ROOT . '/tpl' )) mkdir(CLIENT_ROOT . '/tpl');
    if(!file_exists( CLIENT_ROOT . '/tpl/' . TEMPLATE )) mkdir(CLIENT_ROOT . '/tpl/' . TEMPLATE);
    
    duplicate_folder(PATH_ROOT . '/tpl/tpl/' . TEMPLATE, CLIENT_ROOT . '/tpl/' . TEMPLATE);
    
    
    $client_tpl_dir = CLIENT_ROOT . '/tpl/';
    display_dir_content($client_tpl_dir);
    ?>
    
    <?php
} 

if($_POST['type']=='delete_dir')
{
    
    //$dir_path = urldecode($_POST['dir_path']);
    $dir_path = CLIENT_ROOT . '/tpl/';
    delete_folder($dir_path);
     
    ?>
    <div class="not-exist-custom-noti">
        <p>Website này chưa có file giao diện riêng</p>
        <p class="active-custom-tpl-now">Kích hoạt ngay</p>
    </div>
    <?php
}

