<?php


define('SECURE_CHECK', true);



include dirname(dirname(dirname(__FILE__))) . '/config.php';
 
if(!$g_user['id']) die('stop');
/**
 * Read template
 */
$tpl = new views_view();

$tpl->assign('title', 'Uploads');    
$tpl->assign('css', array(
    SITE_URL . '/apps/bootstrap-3.1.1-dist/css/bootstrap.min.css',
    SITE_URL . '/admin/' . 'css/admin.css',
    '../uploads.css'
));
$tpl->assign('script',array(
    SITE_URL . '/apps/js/jquery-1.9.1.min.js',
    SITE_URL . '/apps/bootstrap-3.1.1-dist/js/bootstrap.min.js',
    '../uploads.js'
));
include 'header.php';
/**
 * END Read template
 */     
?>


<div class="container">
<?php include PATH_ROOT . '/media/tpl/sidebar.php' ?>
<h1 class="title"><?php echo $tpl->variable['title'] ?></h1>
<div class="row">
 
 <div class="col-xs-12">
 
<?php  
/**
 * Configuration
 */
$uploaddir_relative = 'uploads';
$uploaddir = PATH_ROOT . '/uploads';
$obj_BD = new models_DB;
$current_upload_folder = $obj_BD->get('SELECT value FROM ' . CONFIG_TABLE . ' WHERE name = \'current_upload_folder\'');
$current_upload_folder = $current_upload_folder[0]['value'];
if(!file_exists("$uploaddir/$current_upload_folder")) mkdir("$uploaddir/$current_upload_folder");
/**
 * END Configuration
 */
 
 

$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png', 'application/x-shockwave-flash');
$i = 1;
$j = 1;

/**
 * Loop through all files
 */
foreach($_FILES['userfile']['error'] as $k=>$v)
{
    
    if(in_array($_FILES['userfile']['type'][$k], $valid_file_type))
    {
        
        /**
         * Count element in current upload folder 
         */
        if( (count(scandir($uploaddir . '/' . $current_upload_folder)) - 2) >= MAX_ATTACHMENT_PER_FOLDER )
        {
            $current_upload_folder++;
            $obj_BD->query_string('UPDATE config SET value=\''. $current_upload_folder .'\' WHERE name=\'current_upload_folder\'');
            if(!file_exists("$uploaddir/$current_upload_folder")) mkdir("$uploaddir/$current_upload_folder");
        }
        
		
		$path_file =  pathinfo($_FILES['userfile']['name'][$k]);
		
        $ori_path_file_name = $path_file['filename'];
			
			 
			
		$path_file['filename'] = pretty_string($path_file['filename']);
		$_FILES['userfile']['name'][$k] = $path_file['filename'] . '.' . $path_file['extension'];
		
        /**
         * Check exists name of file uploading. if exist, rename it before save to folder.
         */
        $duplicate_file = 1;
        if(file_exists( PATH_ROOT . '/uploads' .'/'. $current_upload_folder . '/' . $_FILES['userfile']['name'][$k] )) 
        {
            
            //$path_file['filename'] .= '-' . $duplicate_file;
			
			//$ori_path_file_name = $path_file['filename'];
			
			 
			
			//$path_file['filename'] = pretty_string($path_file['filename']);
             
            while(file_exists( PATH_ROOT . '/uploads' .'/'. $current_upload_folder . '/' . $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'] ))
            {
                $duplicate_file++;
            }
            $_FILES['userfile']['name'][$k] = $path_file['filename'] . '-' . $duplicate_file . '.' . $path_file['extension'];
        }

        
        /**
         * Save file to folder
         */
        $uploadfile = $uploaddir . '/' . $current_upload_folder . '/' . basename($_FILES['userfile']['name'][$k]);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'][$k], $uploadfile)) 
        {
            $moment = pathinfo($_FILES['userfile']['name'][$k]);
            $original_alt_title =  $moment['filename'];        
            $moment = array(
                'url'           =>  'uploads' .'/'. $current_upload_folder . '/' . $_FILES['userfile']['name'][$k],
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
            <?php $active_item = TRUE; include 'file_item.php'; ?>
            
            <?php
            $i++;
            $j++;

        } 
        else 
        {
            echo "Failed : ", $_FILES['userfile']['name'][$k], " upload attack!\n";
        }
        
    }
    else 
    {
    ?>
    <div  class="box relative active" style="font-size:11px">
        <?php echo 'Invalid File Type : <br />' , $_FILES['userfile']['name'][$k]; ?>
    </div>
    
    <?php
    }
    
}

?>
</div>
</div>
<div style="bottom: 0;" class="row absolute none">
    <label><input type="checkbox"   id="insert_br_tag" />Auto line break after each Image</label>
</div>
</div>
<div class="clear"></div>

<?php include 'footer.php' ?>