<?php
$insert_content = array();
function t_after_check($user_id)
{
    if(empty($user_id)) die('K ton tai nguoi dung');
    
    $user_info = get_user($user_id);
    $_SESSION['user_name'] = $user_info['user_name'];
    $_SESSION['password'] =  $user_info['password'];
    
    //if(!empty($_GET['redirect_url'])) header('Location:' . urldecode($_GET['redirect_url']));
    header('Location:' . SITE_URL . '/dang-tin/' );
    die();
}

$insert_content = array(
    'secure_key'            => random_string(),
    'point'                 => 0,
    'time_create'           => hcv_time(),
    'permission'            => 'member',
    'member_permission'     => 'member',
    'the_status'            => 'active'
);

$insert_content['display_name'] = urldecode($_GET['display_name']);
$insert_content['email'] = urldecode($_GET['email']);




if(isset($_GET['gg_id']))
{
    $t = 'SELECT id FROM ' . USER_TABLE . ' WHERE ( gg_id=' . $_GET['gg_id'] . ' OR email=\'' . $insert_content['email'] . '\' )';
    $exist = models_DB::get($t);
    if(!empty($exist)) t_after_check($exist[0]['id']);
    
    $insert_content['gg_id'] = $_GET['gg_id'];
    $insert_id = models_DB::insert($insert_content, USER_TABLE);
     
}

 
if(isset($_GET['fb_id']))
{
    $t = 'SELECT id FROM ' . USER_TABLE . ' WHERE ( fb_id=' . $_GET['fb_id'] . ' OR email=\'' . $insert_content['email'] . '\' )';
    $exist = models_DB::get($t);
    if(!empty($exist)) t_after_check($exist[0]['id']);
    
    $insert_content['fb_id'] = $_GET['fb_id'];
    $insert_id = models_DB::insert($insert_content, USER_TABLE);
}


//Update some info
$update_content = array();

$update_content['user_name'] = pretty_string($insert_content['display_name'], '_') . '_' . $insert_id;

$update_content['password'] = md5(random_string());

$t = CLIENT_ROOT . '/uploads/auto';
if(!file_exists( $t  )) mkdir($t);


 
 
$image_path = $t . '/' . 'avatar-' . $insert_id . '.jpg';
$image_url = str_replace(CLIENT_ROOT, SITE_URL, $image_path);
 
hcv_file_put_contents($image_path, urldecode($_GET['image']));

 
$update_content['image'] = $image_url;
if(isset($_GET['fb_id']))
{
    $update_content['image'] = urldecode($_GET['image']) . '/?type=large';
}

models_DB::update($update_content, USER_TABLE, 'WHERE id=' . $insert_id);

t_after_check($insert_id);



