<?php


if(!defined('SECURE_CHECK')) die('Stop');

//if(!isset($_POST['type'])) die();

if($_POST['type']=='get_image_size')
{
    $size = getimagesize(str_replace(SITE_URL, CLIENT_ROOT, $_POST['src']));
    ///echo str_replace(SITE_URL, PATH_ROOT, $_POST['src']);
    echo $size[0] . '-' . $size[1];
}

 if($_POST['type']=='change_extension_fixedhotline_setting')
{
     $default_value = $_POST;
     $default_value['display_style'] = $_POST['current_style'];



    include PATH_ROOT . '/extensions/FixedHotline/style-' . $default_value['display_style'] . '.php';

}

 if(isset($_POST['fixed_form_type']) && ($_POST['fixed_form_type']=='change_extension_fixedform_setting') )
{
     $default_value = $_POST;
     $default_value['display_style'] = $_POST['current_style'];
    include PATH_ROOT . '/extensions/PopupForm/style-' . $default_value['display_style'] . '.php';
    die();
}


if($_POST['type']=='delete_option')
{

    if(!user_can('delete-option')) die('0');

    $obj_HandleAction = new models_HandleAction;

    $success = delete_option($_POST['option_name']);

    if($success) echo '1'; else echo '0';
}





if($_POST['type']=='delete_category')
{
    if(!user_can('delete-category')) die('0');
     $_info = get_category($_POST['category_id']);
    $success = models_DB::delete(CATEGORY_TABLE, ' WHERE id='.$_POST['category_id']);
    if($success) echo '1'; else echo '0';



}

if($_POST['type']=='delete_block_area')
{
    if(!user_can('delete-block-area')) die('0');
    $success = models_DB::delete(BLOCK_AREA_TABLE, ' WHERE id='.$_POST['block_area_id']);

    if($success) echo '1'; else echo '0';
}



if($_POST['type']=='delete_tag')
{

    if(!user_can('delete-tag')) die('0');
    $_info = get_tag($_POST['category_id']);
    $success = models_DB::delete(TAG_TABLE, ' WHERE id='.$_POST['category_id']);

    //h($_POST);

    if($success) echo '1'; else echo '0';


}

if($_POST['type']=='delete_post')
{
   if(!user_can('delete-post', $_POST['post_id'])) die();
   $post_info = get_post($_POST['post_id']);
   delete_post($_POST['post_id']);


}

if($_POST['type']=='delete_user')
{
    if(!user_can('delete-user')) die('0');

    $user = get_user($_POST['user_id'], 'permission,user_name');

    if($user == FALSE) die('0');

    if( $_POST['user_id'] == 1 ) die('0');

   models_DB::delete(USER_TABLE, ' WHERE id='.$_POST['user_id']);


}

if($_POST['type']=='delete_noti')
{
    if(!user_can('delete-noti')) die('0');
   delete_noti($_POST['noti_id']);
}

if($_POST['type']=='handle_order')
{
     if(!user_can('handle-order')) die('0');

	if(in_array($_POST['the_status'], array('new','seen', 'rac')))
	{
		$update = array(
		'the_status'	=> $_POST['the_status']
	   );
	   models_DB::update($update, ORDER_TABLE, ' WHERE id='.$_POST['order_id']);
	}

	if(in_array($_POST['the_status'], array('delete')))
	{

	   models_DB::delete(ORDER_TABLE, ' WHERE id='.$_POST['order_id']);
	}

}


if($_POST['type']=='load_menu_block')
{
	 ?>
	 <div class="search-result-inner">
	 <?php
	 $i = 1;
	 $a = 'SELECT id,url,title FROM ' . CATEGORY_TABLE . ' WHERE title LIKE \'%' . $_POST['s'] .'%\'';
	 $categories = models_DB::get($a);

	 foreach($categories as $post)
	 {
		$title = $post['title'];
		$link = hcv_url('c', $post['url'], $post['id'], FALSE);
		?>
		<div stt="<?php echo $i ?>" id="menu-search-item-<?php echo $i; ?>" class="menu-search-item <?php if($i==1) echo 'active'; ?>">
			 <p class="serch-result-title"><?php echo $title ?></p>
			 <p class="serch-result-link"><?php echo $link ?></p>
		</div>
		<?php
		$i++;
	 }


	 $a = 'SELECT id,url,title FROM ' . POST_TABLE . ' WHERE title LIKE \'%' . $_POST['s'] .'%\'';
	 $posts = models_DB::get($a);
	 foreach($posts as $post)
	 {
		$title = $post['title'];
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		?>
		<div stt="<?php echo $i ?>" id="menu-search-item-<?php echo $i; ?>" class="menu-search-item <?php if($i==1) echo 'active'; ?>" >
			 <p class="serch-result-title"><?php echo $title ?></p>
			 <p class="serch-result-link"><?php echo $link ?></p>
		</div>
		<?php
		$i++;
	 }

	 $a = 'SELECT id,url,title FROM ' . TAG_TABLE . ' WHERE title LIKE \'%' . $_POST['s'] .'%\'';
	 $tags= models_DB::get($a);



	 foreach($tags as $post)
	 {
		$title = $post['title'];
		$link = hcv_url('c', $post['url'], $post['id'], FALSE);
		?>
		<div stt="<?php echo $i ?>" id="menu-search-item-<?php echo $i; ?>" class="menu-search-item <?php if($i==1) echo 'active'; ?>">
			 <p class="serch-result-title"><?php echo $title ?></p>
			 <p class="serch-result-link"><?php echo $link ?></p>
		</div>
		<?php
		$i++;
	 }

	 ?>
	 </div>
	 <?php
}



if($_POST['type']=='load_smartbedoption_block')
{
	 ?>
	 <div class="search-result-inner">
	 <?php
	 $i = 1;


	 $a = 'SELECT id,url,title FROM ' . POST_TABLE . ' WHERE post_type=2 AND title LIKE \'%' . $_POST['s'] .'%\'';
	 $posts = models_DB::get($a);
	 foreach($posts as $post)
	 {
		$title = $post['title'];
		$link = hcv_url('p', $post['url'], $post['id'], FALSE);
		?>
		<div post_id="<?php echo $post['id'] ?>" stt="<?php echo $i ?>" id="menu-search-item-<?php echo $i; ?>" class="menu-search-item <?php if($i==1) echo 'active'; ?>" >
			 <p class="serch-result-title"><?php echo $title ?></p>
			 <p class="serch-result-link"><?php echo $link ?></p>
		</div>
		<?php
		$i++;
	 }



	 ?>
	 </div>
	 <?php
}


if($_POST['type']=='get_media_display')
{
     //echo get_file_type($ext) ;
    $ext = pathinfo($_POST['file_name'], PATHINFO_EXTENSION);
    switch( get_file_type($ext) )
    {
        case 'image' :
        {
            ?>
            <img style="max-width: 100%;" src="<?php echo  $_POST['file_name'] ?>" />
            <?php
            break;
        }
        case 'mp3' :
        {
            ?>
            <audio controls>
              <source src="<?php echo  $_POST['file_name'] ?>" type="audio/mpeg" />
              Tr??nh duy???t c???a b???n kh??ng h??? tr??? ?????nh d???ng n??y
            </audio>
            <?php
            break;
        }
        case 'ogg' :
        {
            ?>
            <audio controls>
              <source src="<?php echo  $_POST['file_name'] ?>" type="audio/ogg" />
              Tr??nh duy???t c???a b???n kh??ng h??? tr??? ?????nh d???ng n??y
            </audio>
            <?php
            break;
        }
        case 'mp4' :
        {
            ?>
            <video controls>
              <source src="<?php echo  $_POST['file_name'] ?>" type="video/mp4" />
              Tr??nh duy???t c???a b???n kh??ng h??? tr??? ?????nh d???ng n??y
            </video>
            <?php
            break;
        }

    }
}

if($_POST['type']=='calc_to_active_extension')
{
    $extension_name = $_POST['extension_name'];
    if( file_exists( PATH_ROOT . '/extensions/' . $extension_name . '/price.txt' ) )
   {
        $myfile = fopen( PATH_ROOT . '/extensions/' . $extension_name . '/price.txt', "r") or die("Unable to open file!");
        $extension_price = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $extension_name . '/price.txt'));
        fclose($myfile);
   }
   else $extension_price = '';

   $external_connent = new models_ExternalDB($external_db);

   if(empty($kh_info['the_point'])) $kh_info['the_point'] = 0;
   if( $kh_info['the_point'] <  $extension_price)
   {
        ?>
        <div class="k-du-so-du">
            <p>S??? d?? hi???n t???i c???a b???n l?? <span><?php echo num_to_price($kh_info['the_point']) ?><sup>??</sup> </span>, kh??ng ????? ????? k??ch ho???t modul n??y. Vui l??ng n???p th??m ????? ti???p t???c</p>
            <a class="billing" href="<?php echo SITE_URL ?>/admin/?page_type=billing"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp; N???p ti???n</a>
        </div>
        <?php
   }
   else
   {
        ?>
        <div class="xnttmd">
            <p class="xnttmd-title">X??c nh???n thanh to??n module</p>
            <p class="xnttmd-item">
                <span class="xnttmd-item-title">S??? d?? hi???n t???i : </span>
                <span class="xnttmd-item-content"><?php echo num_to_price($kh_info['the_point']) ?><sup>??</sup></span>
            </p>
            <p class="xnttmd-item">
                <span class="xnttmd-item-title">Thanh to??n : </span>
                <span class="xnttmd-item-content"><?php echo num_to_price($extension_price) ?><sup>??</sup></span>
            </p>
            <p class="xnttmd-item">
                <span class="xnttmd-item-title">S??? d?? c??n l???i : </span>
                <span class="xnttmd-item-content"><?php echo num_to_price( $kh_info['the_point'] - $extension_price) ?><sup>??</sup></span>
            </p>
        </div>
        <span class="xn-mua-module" extension_name="<?php echo $extension_name ?>"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp; X??c nh???n</span>
        <div class="xn-mua-module-noti"></div>
        <?php
   }



}



if($_POST['type']=='tinymce_get_form_html')
{

    display_form(array('id'=>$_POST['form_id']));
    ?>

    <?php
}
