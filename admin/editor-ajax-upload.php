<?php 

 
if($g_user['permission'] != 'admin') die();

//h($_GET);die();
 

//$valid_file_type = explode(' ', get_option('file_upload_format'));//
$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png', 'application/x-shockwave-flash', 'application/x-zip-compressed', 'video/mp4', 'audio/mp3');
$i = 1;
$j = 1;


$valid_ex = array('png', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'flv',  'docx', 'txt', 'doc', 'xlsx', 'pdf', 'ttf', 'otf', 'svg');

$ex = pathinfo($_FILES['file']['name']);
$ex = $ex['extension'];
$uploading = TRUE;

$uploadfile = $_GET['dir'] . '/' . basename($_FILES['file']['name']);
$_POST['dir_name'] = $_FILES['file']['name'];

if(in_array(strtolower($ex), $valid_ex)) // in_array($_FILES['file']['type'], $valid_file_type)
{
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
    {
        $path_info = pathinfo($_POST['dir_name']);
         
        
        $list_dir = $_POST['dir_name'];
        $current_dir = $_GET['dir'] . '/' . $list_dir; 
             
       include PATH_ROOT . '/admin/inc/editor-file-item.php';
    }
}
else 
{
?>

<?php
}