 <?php 

 
if(USER_PERMISSION != 'admin') die('Login Require');

 

if(empty($_GET['dir'])) {
    $_GET['dir'] = CLIENT_ROOT . '/uploads/auto/slide';
    if(!file_exists( CLIENT_ROOT . '/uploads/auto' )) mkdir( CLIENT_ROOT . '/uploads/auto' );
    if(!file_exists( CLIENT_ROOT . '/uploads/auto/slide' )) mkdir( CLIENT_ROOT . '/uploads/auto/slide' );   
}

 

//$valid_file_type = explode(' ', get_option('file_upload_format'));//
$valid_file_type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg', 'image/x-png', 'application/x-shockwave-flash', 'application/x-zip-compressed', 'video/mp4', 'audio/mp3');
$i = 1;
$j = 1;


$valid_ex = array('png', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'flv',  'docx', 'txt', 'doc', 'xlsx', 'pdf', 'ttf', 'otf', 'svg');

$ex = pathinfo($_FILES['file']['name']);


//$_GET['dir'] = CLIENT_ROOT . '/' . $_GET['dir'];

$uploadfile = $_GET['dir'] . '/' . pretty_string($ex['filename']) . '.' . $ex['extension'];
$duplicate_file = 1;

while(file_exists( $uploadfile ))
{
    $uploadfile = $_GET['dir'] . '/' . pretty_string($ex['filename']) . '-' . $duplicate_file . '.' . $ex['extension'];
    $duplicate_file++;
}

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
        
        $k = 999;
        $v['image'] = str_replace(CLIENT_ROOT, SITE_URL, $uploadfile);
        $v['link'] = '';
        $v['caption'] = '';
        if(empty($v['image'])) die();
       ?>
       <div class="list-slide-item flex-item slide-option-item array_form" id="slide-<?php echo $k ?>">
    			<div class="slide-option-item-title" particular="<?php echo $k ?>">
        			<img class="title-image" src="<?php echo $v['image'] ?>" />        			 
    			</div>
    			 <span class="clear"></span>
    			<div class="slide-option-item-content">
    				<div class="slide-option-option image">    					 
    					<input type="hidden" particular="<?php echo $k ?>"  class="parameter-depth-1 image-field" id="select_image_<?php echo $k ?>" parameter="image"  value="<?php echo $v['image'] ?>" />                        
                       				
    				</div>
                    
                    <div class="slide-option-option-des none">
                        <span class="clear"></span>
        				<div class="slide-option-option">
        					<label>Liên kết</label>
        					<input  class="form-control parameter-depth-1" parameter="link" type="text"  value="<?php echo $v['link'] ?>" />        				
        				</div>
        				<span class="clear"></span>
        				<div class="slide-option-option">
        					<label>Tiêu đề</label>
        					<input particular="<?php echo $k ?>" class="form-control title-field parameter-depth-1" parameter="title" type="text" value="<?php if(!empty($v['title'])) echo $v['title'] ?>" />
        				</div>
        				<span class="clear"></span>
        				<div class="slide-option-option clearfix">
        					<label>Miêu tả</label>
        					<textarea  class="main-content form-control parameter-depth-1" parameter="caption"><?php echo $v['caption'] ?></textarea>        				
        				</div>
        				
        				<span class="close-slide-des"><i class="fa fa-close"></i></span>
                    </div>
    				
    			 </div>
    			 <span class="clear"></span>
    			 <span class="remove-slide"><i class="fa fa-close"></i></span>
                 <span class="setting-slide"><i class="fa fa-gear"></i></span>
    		</div> 
       <?php
    }
}