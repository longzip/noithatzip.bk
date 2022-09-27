<?php 

session_start();
define('SECURE_CHECK', true);

 
 
include dirname(dirname(dirname(__FILE__))) . '/config.php';

if($g_user['permission'] != 'admin') die();

//h($_GET);die();

/**
 * Configuration
 */
$uploaddir_relative = 'uploads';
$uploaddir = PATH_ROOT . '/uploads';
$obj_BD = new models_DB; 
/**
 * END Configuration
 */
 
 

//$valid_file_type = explode(' ', get_option('file_upload_format'));//
$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png', 'application/x-shockwave-flash', 'application/x-zip-compressed', 'video/mp4', 'audio/mp3');
$i = 1;
$j = 1;


$valid_ex = array('png', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'flv',  'docx', 'txt', 'doc', 'xlsx', 'pdf');

$ex = pathinfo($_FILES['file']['name']);
$ex = $ex['extension'];
$uploading = TRUE;
if(in_array(strtolower($ex), $valid_ex)) // in_array($_FILES['file']['type'], $valid_file_type)
{
    if(empty($_GET['dir']))
    {
         $current_upload_folder = '';
    	$path_file =  pathinfo($_FILES['file']['name']);
    	
        $ori_path_file_name = $path_file['filename'];
    		
   		 $path_file['extension'] = strtolower($path_file['extension']);
    		
    	$path_file['filename'] = pretty_string($path_file['filename']);
    	$_FILES['file']['name'] = $path_file['filename'] . '.' . $path_file['extension'];
    	
        /**
         * Check exists name of file uploading. if exist, rename it before save to folder.
         */
        $duplicate_file = 1;
        if(file_exists( PATH_ROOT . '/uploads' . $current_upload_folder . '/' . $_FILES['file']['name'])) 
        {
            
            while(file_exists( PATH_ROOT . '/uploads' . $current_upload_folder . '/' . $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'] ))
            {
                $duplicate_file++;
            }
            $_FILES['file']['name'] = $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'];
        }
    
        
        /**
         * Save file to folder
         */
        //$uploadfile = $uploaddir . '/' . $current_upload_folder . '/' . basename($_FILES['file']['name']);
        $current_upload_folder = '';
        $uploadfile = $uploaddir . '/' . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
        {
            $moment = pathinfo($_FILES['file']['name']);
            $original_alt_title =  $moment['filename'];        
            $moment = array(
                'url'           =>  'uploads' .'/'. $current_upload_folder . $_FILES['file']['name'],
                'title'			=> $ori_path_file_name,
    			'alt'			=> $ori_path_file_name,
    			'description'	=> '',
    			'align'			=> 'none',
                'user_id'       => $g_user['id']
            );
            $obj_BD->insert( $moment, ATTACHMENT_TABLE );
            
            $v_attachments['title'] = $moment['title'];
            $v_attachments['alt'] = $moment['title'];
            $v_attachments['url'] = $moment['url'];
    		$v_attachments['description']	=  $moment['description'];
            $v_attachments['align'] = 'none';
            ?>
    
            
            <!-- Display file uploaded -->
            <?php $active_item = TRUE; include 'file_item_in_dir.php'; ?>
            
            <?php
            $i++;
            $j++;
			
			$param = array(
				'user_id'		=> $g_user['id'],
				'action'		=> 'new-file',
				'content'		=> 'uploads/' . $current_upload_folder . '/' . basename($_FILES['file']['name']),
				'time_create'	=> hcv_time()
			);
			//insert_admin_statistic($param);
    
        } 
        else 
        {
            echo "Failed : ", $_FILES['file']['name'], " upload attack!\n";
        }
    }
    else
    {
        /**
         * Count element in current upload folder 
         */
         $current_upload_folder = $_GET['dir'];
        if( (count(scandir($uploaddir . '/' . $current_upload_folder)) - 2) >= MAX_ATTACHMENT_PER_FOLDER )
        {
            $current_upload_folder++;
            $obj_BD->query_string('UPDATE config SET value=\''. $current_upload_folder .'\' WHERE name=\'current_upload_folder\'');
            if(!file_exists("$uploaddir/$current_upload_folder")) mkdir("$uploaddir/$current_upload_folder");
        }
        
    	
    	$path_file =  pathinfo($_FILES['file']['name']);
    	
        $path_file['extension'] = strtolower($path_file['extension']);
        
        $ori_path_file_name = $path_file['filename'];
    		
    	$path_file['filename'] = pretty_string($path_file['filename']);
    	$_FILES['file']['name'] = $path_file['filename'] . '.' . $path_file['extension'];
    	
        /**
         * Check exists name of file uploading. if exist, rename it before save to folder.
         */
        $duplicate_file = 1;
         if(file_exists( PATH_ROOT . '/uploads/' . $current_upload_folder . '/' . $_FILES['file']['name'])) //file_exists( PATH_ROOT . '/uploads' .'/'. $current_upload_folder . '/' . $_FILES['file']['name']) 
        {
            
            //$path_file['filename'] .= '-' . $duplicate_file;
    		
    		//$ori_path_file_name = $path_file['filename'];
    		
    		 
    		
    		//$path_file['filename'] = pretty_string($path_file['filename']);
             
            while(file_exists( PATH_ROOT . '/uploads' .'/'. $current_upload_folder . '/' . $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'] ))
            {
                $duplicate_file++;
            }
            $_FILES['file']['name'] = $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'];
        }
    
        
        /**
         * Save file to folder
         */
        $uploadfile = $uploaddir . '/' . $current_upload_folder . '/' . basename($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
        {
             
            $moment = pathinfo($_FILES['file']['name']);
            $original_alt_title =  $moment['filename'];        
            $moment = array(
                'url'           =>  'uploads' .'/'. $current_upload_folder . '/' . $_FILES['file']['name'],
                'title'			=> $ori_path_file_name,
    			'alt'			=> $ori_path_file_name,
    			'description'	=> '',
    			'align'			=> 'none',
                'user_id'       => $g_user['id']
            );
            // Luu file upload vào CSDL
            $obj_BD->insert( $moment, ATTACHMENT_TABLE );
            
            $v_attachments['title'] = $moment['title'];
            $v_attachments['alt'] = $moment['title'];
            $v_attachments['url'] = $moment['url'];
    		$v_attachments['description']	=  $moment['description'];
            $v_attachments['align'] = 'none';
            
    
             
            ?>
            <!-- Display file uploaded -->
            <?php $active_item = TRUE; include 'file_item_in_dir.php'; ?>
            
            <?php
            $i++;
            $j++;
			
			$param = array(
				'user_id'		=> $g_user['id'],
				'action'		=> 'new-file',
				'content'		=> 'uploads/' . $current_upload_folder . '/' . basename($_FILES['file']['name']),
				'time_create'	=> hcv_time()
			);
			//insert_admin_statistic($param);
			
			 
    
        } 
        else 
        {
            echo "Failed : ", $_FILES['file']['name'], " upload attack!\n";
        }
    }
    
}
else 
{
?>
<div  class="box relative" style="font-size:11px">
    <div style="padding: 5px 10px;">
        <?php echo 'File không hợp lệ : <br />' , $_FILES['file']['name']; ?>
    </div>
</div>

<?php
}