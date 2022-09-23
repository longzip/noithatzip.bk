<?php
if(empty($_POST['type'])) die();

if($_POST['type'] == 'smartBedRoomOption'){
  //setcookie('cart', '', time() - 3600*24*30, '/');


  if($_POST['cartAction'] == 'yes') setcookie('sb', '', time() - 3600*24*365, '/');


  $ls = array();


  $lists = array();

///h($_POST);

  foreach ($_POST['post_id'] as $k => $post_id) {
    $l = array();

    if($_POST['is_default_display'][$k] == 'no') continue;
    $l['post_id'] = $_POST['post_id'][$k];
    $l['is_default_display'] = $_POST['is_default_display'][$k];
    $ls[$k] = $l;
    $post = get_post($_POST['post_id'][$k]);
    if(empty($post['gia_km'])) $gia = $post['gia'];
    else $gia = $post['gia_km'];
    if(empty($gia)) $gia = 0;

    if( isset($lists[$_POST['post_id'][$k]]) ){
      $num = $lists[$_POST['post_id'][$k]]['num'] + 1;
    } else $num = 1;

    $lists[$_POST['post_id'][$k]] = array('num'=>$num, 'price'=>$num * $gia);
    //add_product_to_sb($_POST['post_id'][$k], 1,  $gia);

  }

  if($_POST['cartAction'] == 'yes')  setcookie('sb', json_encode($lists), time() + 3600*24*3, '/');

  //$ls = __array_sort($ls, 'post_id', SORT_ASC);

  //$ls = array_values($ls);

  //$ls = array_diff();

  $file_name = '';
  foreach ($ls as $k => $l) {
    if($k==0) $file_name = $l['post_id'];
    else {
      if( ($k>=1) && ($k<=4) ) {
        $file_name = $file_name . '-' . $l['post_id'] . 'l';
        continue;
      }
      if( ($k>=5) && ($k<=8) ) {
        $file_name = $file_name . '-' . $l['post_id'] . 'r';
        continue;
      }
      $file_name = $file_name . '-' . $l['post_id'] . 'r';
    }
  }

  if(empty($file_name)){

    $file_path = PATH_ROOT . '/uploads/smartbedroom/default' . $_POST['block_id'] . '.png';

    if(!file_exists($file_path)){
      echo '';
      echo '010516';
      echo '';

      ?>
      <div class="emty-preview">
        <p>Chưa có ảnh phù hợp trong thư viện</p>
        <p>Vui lòng upload mặc định  : <b>smartbedroom/<?php echo $file_name ?>default<?php echo $_POST['block_id'] ?>.png</b></p>
      </div>
      <div class="form-group">

        <span class="clear"></span>
        <div class="none" id="select_image_display">
            <img class="smartBedRoomImgPreview" src="<?php echo $file_url ?>" />
        </div>
        <?php
          if(!empty($_POST['is_admin']) && ($_POST['is_admin']=='yes')){
            ?>
            <input type="hidden" placeholder="src" class="parameter fl" id="select_image" parameter="src"  value="<?php echo $file_url ?>" />
            <input type="button" dir="smartbedroom" value="Upload" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />

            <?php
          }
        ?>

        </div>
      <?php

    } else {
      $file_url = SITE_URL . '/uploads/smartbedroom/default' . $_POST['block_id'] . '.png';
      echo $file_url;
      echo '010516';
      echo '';
      ?>
      <div class="form-group">

        <span class="clear"></span>
        <div class="none" id="select_image_display">
            <img class="smartBedRoomImgPreview" src="<?php echo $file_url ?>" />
        </div>
        <?php
          if(!empty($_POST['is_admin']) && ($_POST['is_admin']=='yes')){
            ?>
            <input type="hidden" placeholder="src" class="parameter fl" id="select_image" parameter="src"  value="<?php echo $file_url ?>" />
            <input type="button" dir="smartbedroom" value="Upload" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />
            <p style="text-align:center">Đổi ảnh  : <b>smartbedroom/<?php echo $_POST['block_id'] ?>.png</b></p>
            <?php
          }
        ?>

        </div>
      <?php
      die();

    }

    die();
  }

  $file_name = $file_name . '-' . $_POST['color'] . '-' . $_POST['openClose'];

  $file_path = PATH_ROOT . '/uploads/smartbedroom/' . $file_name . '.png';

  $file_url = SITE_URL . '/uploads/smartbedroom/' . $file_name . '.png';

  if(file_exists($file_path)){
    echo $file_url;
    echo '010516';
    echo '';
    ?>
    <div class="form-group">

      <span class="clear"></span>
      <div class="none" id="select_image_display">
          <img class="smartBedRoomImgPreview" src="<?php echo $file_url ?>" />
      </div>
      <?php
        if(!empty($_POST['is_admin']) && ($_POST['is_admin']=='yes')){
          ?>
          <input type="hidden" placeholder="src" class="parameter fl" id="select_image" parameter="src"  value="<?php echo $file_url ?>" />
          <input type="button" dir="smartbedroom" value="Upload" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />
          <p style="text-align:center">Đổi ảnh  : <b>smartbedroom/<?php echo $file_name ?>.png</b></p>
          <?php
        }
      ?>

      </div>
    <?php
    die();
  } else {
    $file_url = '';
    echo $file_url;
    echo '010516';

    if(!empty($_POST['is_admin']) && ($_POST['is_admin']=='yes')){
      ?>

      <div class="emty-preview">
        <p>Chưa có ảnh phù hợp trong thư viện</p>
        <p>Vui lòng upload ảnh  : <b>smartbedroom/<?php echo $file_name ?>.png</b></p>
      </div>
      <?php
    }
    ?>
    <?php
  }



    ?>

      <div class="form-group">

        <span class="clear"></span>
        <div id="select_image_display">
            <img class="smartBedRoomImgPreview" src="<?php echo $file_url ?>" />
        </div>
        <?php
          if(!empty($_POST['is_admin']) && ($_POST['is_admin']=='yes')){
            ?>
            <input type="hidden" placeholder="src" class="parameter fl" id="select_image" parameter="src"  value="<?php echo $file_url ?>" />
            <input type="button" dir="smartbedroom" value="Upload" class="fl show-media-frame btn btn-info" particular="select_image" /><br /><br />

            <?php
          }
        ?>
        </div>
    <?php
}
