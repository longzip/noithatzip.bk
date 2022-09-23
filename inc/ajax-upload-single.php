 <?php 


 
if($g_user['id'] == 0) die('Login Require');


 

if(empty($_GET['dir'])) {
    $_GET['dir'] = PATH_ROOT . '/uploads/auto';
    if(!file_exists( PATH_ROOT . '/uploads/auto' )) mkdir( PATH_ROOT . '/uploads/auto' );   
}

 

//$valid_file_type = explode(' ', get_option('file_upload_format'));//
$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png', 'application/x-shockwave-flash', 'application/x-zip-compressed', 'video/mp4', 'audio/mp3');
$i = 1;
$j = 1;


$valid_ex = array('png', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'flv',  'docx', 'txt', 'doc', 'xlsx', 'pdf', 'ttf', 'otf', 'svg');

$image_ex = array('png', 'jpg', 'jpeg', 'png', 'gif', 'svg');
$audio_ex = array( 'mp3');
$text_ex = array('docx', 'txt', 'doc', 'xlsx', 'pdf');
$video_ex = array('mp4', 'flv');

$ex = pathinfo($_FILES['file']['name']);



$uploadfile = $_GET['dir'] . '/' . pretty_string($ex['filename']) . '-' . hcv_time() . '.' . $ex['extension'];



$ex = $ex['extension'];
$uploading = TRUE;

$uploadfile = CLIENT_ROOT . '/uploads/auto/' . hcv_time() . '.' . $ex;

$attachment_type = '';
if(in_array(strtolower($ex), $image_ex)) $attachment_type = 'image';
if(in_array(strtolower($ex), $audio_ex)) $attachment_type = 'audio';
if(in_array(strtolower($ex), $text_ex)) $attachment_type = 'text';
if(in_array(strtolower($ex), $video_ex)) $attachment_type = 'video';

$_POST['dir_name'] = $_FILES['file']['name'];
 
if(in_array(strtolower($ex), $valid_ex)) // in_array($_FILES['file']['type'], $valid_file_type)
{
    
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) 
    {
        $path_info = pathinfo($_POST['dir_name']);
         
        
        $list_dir = $_POST['dir_name'];
        $current_dir = $_GET['dir'] . '/' . $list_dir; 
       
        $src = str_replace(CLIENT_ROOT, SITE_URL, $uploadfile);
        echo $src; 
    }
}
else 
{
    
}