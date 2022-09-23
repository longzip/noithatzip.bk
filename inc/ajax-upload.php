 <?php
 

if($g_user['id'] == 0) die('Login Require');



if(empty($_GET['dir'])) {
    $_GET['dir'] = CLIENT_ROOT . '/uploads/auto';
    if(!file_exists( CLIENT_ROOT . '/uploads/auto' )) mkdir( CLIENT_ROOT . '/uploads/auto' );
}



//$valid_file_type = explode(' ', get_option('file_upload_format'));//
$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png', 'application/x-shockwave-flash', 'application/x-zip-compressed', 'video/mp4', 'audio/mp3');
$i = 1;
$j = 1;


$valid_ex = array('png', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'flv',  'docx', 'txt', 'doc', 'xlsx', 'pdf', 'ttf', 'otf', 'svg');

$ex = pathinfo($_FILES['file']['name']);

$uploadfile = $_GET['dir'] . '/' . pretty_string($ex['filename']) . '-' . hcv_time() . '.' . $ex['extension'];

$ex = $ex['extension'];
$uploading = TRUE;


$_POST['dir_name'] = $_FILES['file']['name'];



if(in_array(strtolower($ex), $valid_ex)) // in_array($_FILES['file']['type'], $valid_file_type)
{

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))
    {
        $path_info = pathinfo($_POST['dir_name']);


        $list_dir = $_POST['dir_name'];
        $current_dir = $_GET['dir'] . '/' . $list_dir;

       ?>
       <div class="multi-image-item">
            <div class="multi-image-item-des">
                <input type="text" name="<?php echo $_GET['field_name'] ?>_title[]" />
            </div>
            <div class="multi-image-item-image">
                <img src="<?php echo str_replace(CLIENT_ROOT, SITE_URL, $uploadfile) ?>" alt="" />
                <input type="hidden" value="<?php echo str_replace(CLIENT_ROOT, SITE_URL, $uploadfile) ?>" name="<?php echo $_GET['field_name'] ?>_src[]" />
            </div>
            <i class="fa fa-close remove-multi-image-item"></i>
       </div>
       <?php
    }
}
else
{
?>

<?php
}
