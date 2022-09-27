<?php

$start_time = microtime(TRUE);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
session_start();
$dir = dirname(__FILE__);
define('SECURE_CHECK', true);

include dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php';


if(empty($_POST['type'])) die();

if($_POST['type']=='filter'){
  $ls = array();
  $ls = get_posts( array('post_type' => 3, 'custom'=> ' khu_vuc LIKE \'%'. $_POST['khu_vuc'] .'%\' ', 'order'=>' ORDER BY time_update DESC ') );

  if(empty($ls)) {
    ?>
    <div class="showRoomMainImg">
       &nbsp;
    </div>
    <?php
    echo '010516';
    ?>
    <div class="emptyShowRoom">Không có showRoom nào tại địa chỉ này</div>
    <?php
  } else {
    ?>
    <div class="showRoomMainImg">
       <img src="<?php  echo $ls[0]['image'] ?>" />
    </div>
    <div class="showRoomMainContent">
       <?php echo $ls[0]['content'] ?>
    </div>

    <?php
    echo '010516';
    foreach ($ls as $k => $l) {
      ?>
      <div class="showRoomItem <?php if($k==0) echo 'active' ?>" post_id="<?php echo $l['id'] ?>">
        <div class="showRoomTitle"><?php echo $l['title'] ?></div>
        <div class="showRoomOther showRoomOtherPlace"><i class="fa fa-map-marker"></i> <?php echo $l['showroom_dia_chi'] ?></div>
        <div class="showRoomOther showRoomOtherMap"><i class="fa fa-map-marker"></i> <a target="_blank" href="<?php echo $l['showroom_map'] ?>">Chỉ đường cho tôi !</a></div>
        <div class="showRoomOther showRoomOtherPhone"><i class="fa fa-phone"></i> <a href="tel:<?php echo $l['showroom_phone'] ?>"><?php echo $l['showroom_phone'] ?></a></div>
      </div>
      <?php
    }
  }
  die();
}

if($_POST['type']=='viewShowRoom'){
  $post = get_post($_POST['post_id']);
  ?>
  <div class="showRoomMainImg">
     <img src="<?php  echo $post['image'] ?>" />
  </div>
  <div class="showRoomMainContent">
     <?php echo $post['content'] ?>
  </div>
  <?php
  die();
}
