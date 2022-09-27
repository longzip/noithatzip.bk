<?php

session_start();

define('SECURE_CHECK', TRUE);

include dirname(dirname(dirname(__FILE__))) . '/config.php';

 

if((isset($_POST['type'])) && ($_POST['type'] == 'update_attribute'))
{
	 
	$update = array(
		'title'=>$_POST['new_title'], 
		'alt'=>$_POST['new_alt'], 
		'align'=>$_POST['new_align'], 
		'description'=>$_POST['new_description']
	);
     if( models_DB::update($update, ATTACHMENT_TABLE, ' WHERE url = \'' . $_POST['attachment_url'] . '\'') ) echo '1'; else echo $obj_BD->last_result_status;
	 
}

if((isset($_POST['type'])) && ($_POST['type'] == 'delete_attachment'))
{
    
    $moment = 'SELECT * FROM ' . ATTACHMENT_TABLE . ' WHERE url =\'' . $_POST['attachment_url'] . '\'';
	
    $attachments = models_DB::get($moment);
	
	if(empty($attachments)) die();
	
    
	if($attachments[0]['user_id'] != $g_user['id']) die('No permission');
	
	$url = $attachments[0]['url'];
	 
	$file = PATH_ROOT . '/' . $_POST['attachment_url'];
	 
    if( @unlink( $file ) || !file_exists($file) )
    {
        $moment = 'DELETE FROM ' . ATTACHMENT_TABLE . ' WHERE url = \'' . $_POST['attachment_url'] . '\'';
        if( models_DB::query_string($moment) ) echo '1'; else echo $obj_BD->last_result_status;
		
		$param = array(
			'user_id'		=> $g_user['id'],
			'action'		=> 'delete-file',
			'content'		=> $_POST['attachment_url'],
			'time_create'	=> hcv_time()
		);
		//insert_admin_statistic($param);
    }
    else echo 'Can\'t delete file'; 
}

if((isset($_POST['type'])) && ($_POST['type'] == 'load_more_gallery'))
{
    $start = $_POST['start'];
    $end = 18;
    $moment = 'SELECT * FROM ' . ATTACHMENT_TABLE . ' LIMIT '. $start . ',' .$end ;
    $attachments = models_DB::get($moment);
	
	if(empty($attachments)) die('<div style="clear:both"></div><p id="search-not-found" style="color:blue">&nbsp;&nbsp;&nbsp;Hết file để hiển thị !</p>');
	
    foreach($attachments as $v_attachments)
    {
        $attributes = json_decode($v_attachments['attributes'], TRUE);
        $moment_file = $attributes;
        $moment_file['url'] = $v_attachments['url'];
    ?>
        <?php include 'file_item.php'; ?>
    <?php
    } 
}

if((isset($_POST['type'])) && ($_POST['type'] == 'search_attachments'))
{
    $moment = 'SELECT * FROM ' . ATTACHMENT_TABLE . ' WHERE (url LIKE \'%' . $_POST['s'] .'%\') OR  (title LIKE \'%' . $_POST['s'] .'%\') OR (description LIKE \'%' . $_POST['s'] .'%\') OR (alt LIKE \'%' . $_POST['s'] .'%\') LIMIT 48';
   
	 
	
    //if(strpos('uploads', $_POST['s'])) $moment = 'SELECT * FROM ' . ATTACHMENT_TABLE . ' WHERE (title LIKE \'%' . $_POST['s'] .'%\') OR (description LIKE \'%' . $_POST['s'] .'%\') OR (alt LIKE \'%' . $_POST['s'] .'%\') LIMIT 48';
    
	
	
	
	 $attachments = models_DB::get($moment);
	
	if(empty($attachments)) die('<p id="search-not-found" style="color:red">Không tìm thấy file nào !</p>');
	
    foreach($attachments as $v_attachments)
    {
         
    include 'file_item.php'; ?>
    <?php
    } 
}

if((isset($_POST['type'])) && ($_POST['type'] == 'new-dir'))
{
        $all_dirs = scandir(PATH_ROOT . '/uploads/' . $_POST['current_dir']);
        unset($all_dirs[0], $all_dirs[1]);
        
        $_POST['dir_name'] = pretty_string($_POST['dir_name'], "_");
        
        if(in_array($_POST['dir_name'], $all_dirs) || ($_POST['dir_name'] == '') ) die('exist');
        
		if(empty( $_POST['current_dir'] ))
		{
			$dir_path  = pretty_string($_POST['dir_name'], '_');
			 
		}
		else
		{
			$dir_path  = $_POST['current_dir'] . '/' . pretty_string($_POST['dir_name'], '_');
		}
		
		
		mkdir(PATH_ROOT . '/uploads/' . $dir_path);
		
        ?>
        <a class="dir new" href="<?php echo SITE_URL ?>/media/tpl/upload_to_dir.php?dir=<?php echo urlencode($dir_path) ?>">
            <div class="name"><?php echo $_POST['dir_name'] ?></div>
        </a>
        
        <?php
		
		$param = array(
			'user_id'		=> $g_user['id'],
			'action'		=> 'new-folder',
			'content'		=> 'uploads/' . $dir_path,
			'time_create'	=> hcv_time()
		);
		//insert_admin_statistic($param);
}

if((isset($_POST['type'])) && ($_POST['type'] == 'delete_file_in_dir'))
{
    unlink(PATH_ROOT . '/' . $_POST['file_name']);
	
    models_DB::delete(ATTACHMENT_TABLE, ' WHERE url=\'' . $_POST['file_name'] . '\' ');
    
	$param = array(
			'user_id'		=> $g_user['id'],
			'action'		=> 'delete-file',
			'content'		=> $_POST['file_name'],
			'time_create'	=> hcv_time()
		);
		//insert_admin_statistic($param);
}

if((isset($_POST['type'])) && ($_POST['type'] == 'delete_dir'))
{
    //if($_POST['dir_name'] == 1) die('no');
    
    $files = scandir(PATH_ROOT . '/uploads/' . $_POST['dir_name']);
    
    
    
    unset($files[0], $files[1]);
    
    foreach($files as $file)
    {
        unlink(PATH_ROOT . '/uploads/' . $_POST['dir_name'] . '/' . $file);
    }
    
    rmdir(PATH_ROOT . '/uploads/' . $_POST['dir_name']);
	
	$param = array(
			'user_id'		=> $g_user['id'],
			'action'		=> 'delete-folder',
			'content'		=> 'uploads/' . $_POST['dir_name'],
			'time_create'	=> hcv_time()
		);
		//insert_admin_statistic($param);
}