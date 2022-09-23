<?php

 

    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('edit-tpl-file')) die();
    
    if(isset($_POST['submit']))
    { 
       
       
        
    }
    
    
	$g_page_content['title'] = 'Edit file';
    
    
?>

<?php
	include 'header.php';
?>
<script lang="javascript" src="<?php echo SITE_URL . '/admin/js/file-editor.js' ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo SITE_URL ?>/admin/css/file-editor.css" />

<div id="dir-action">
    abdce
</div>

<div id="content" class="container">
    
    <?php include 'sidebar.php'; ?>
        
    <div id="main-content" class="fl col-10-6">
        <div class="box">
         
        <h1 class="h1-title">Editor</h1> 
        </div>
        
        <div class="box" id="tpl">
                <div class="tpl">Edit file</div>
                
                
                <div id="file-content">
                    <?php 
                        
                        
                        $file_path = PATH_ROOT . '/tpl' . urldecode($_GET['file']);
                        //$file = fopen($file_path, 'w');
                        
                        if(!file_exists($file_path)) die('<p class="noti">File not exitst</p>');
                        
                         if(!is_readable($file_path)) echo '<p class="noti">You not have permission to read this file</p>';
                         else
                         {
                            if(!is_writeable($file_path)) echo '<p class="noti">You not have permission to edit this file</p>';
                            $file_content = file($file_path);
                        
                            ?>
                            <textarea spellcheck="false" id="file-content-textarea"><?php 
                                foreach($file_content as $file_content_k=>$file_content_v)
                                {
                                    echo htmlspecialchars($file_content_v);
                                }
                                 
                            
                            ?></textarea>
                            
                            
                         <?php
                            if(is_writeable($file_path))
                            {
                                ?>
                                <div class="fr" dir_path="<?php echo $file_path ?>" id="save-file-content">Save</div>
                                <?php
                            }
                         }
                         ?>
                         
                        <span class="clear"></span>
                        
                </div>  
              
        </div>
       
       
    </div>
    <span class="clear"></span>
</div>