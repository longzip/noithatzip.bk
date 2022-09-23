<?php
//$temporary_setting_parameter,$current_block_id

//h($temporary_setting_parameter)
?>

<?php
include PATH_ROOT . '/blocks/default-title.php';
require_once 'require_once.php';


$groups = array(
  array('title' => 'Giường mặc định'),
    array('title' => 'Trái'),
    array('title' => 'Phải'),
    array('title' => 'Trước'),
    array('title' => 'Trước 2')
);

?>

<div class="block-content">
    <form class="SmartBedRoomOptionForm clearfix">
        <div class="SmartBedRoomOptionFormCol1 fl">

            <div class="colors">
                <span class="colorsTitle" style="">Màu sắc : </span>
                <div class="color color1 active" code="color1"></div>
                <div class="color color2" code="color2"></div>
                <div class="color color3" code="color3"></div>
                <select name="color" class="none colorSlect">
                    <option value="color1">Color 1</option>
                    <option value="color2">Color 2</option>
                    <option value="color3">Color 3</option>
                </select>
            </div>

            <?php

            array_shift($temporary_setting_parameter);
            array_shift($temporary_setting_parameter);
            $count = count($temporary_setting_parameter);
            //echo $count;
            //h($temporary_setting_parameter);
            foreach ($temporary_setting_parameter as $k => $v) {




                $par = $block_param['block_id'] . '-' . $v['post_id'];
                $post = get_post($v['post_id'], 'title, short_name');

                if (empty($post['short_name'])) $ten = $post['title'];
                else $ten = $post['short_name'];



                if ($k == 0) {

                    ?>
                    <span class="clear"></span>
                    <h2 class="none col-title"><?php echo $groups[0]['title'] ?></h2>
                    <select name="" stt="<?php echo $k ?>" class="selectType none" style="display:none">
                      <option value="">
                          Không có
                      </option>
                        <?php

                        foreach ($temporary_setting_parameter as $k2 => $v2) {
                            if ($k2 == 1) break;
                            $post2 = get_post($v2['post_id'], 'title, short_name');

                            if (empty($post2['short_name'])) $ten = $post2['title'];
                            else $ten = $post2['short_name'];
                            ?>
                            <option value="<?php echo $k2 ?>">
                                <?php echo $ten ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                    <?php
                }

                if ($k == 1) {

                    ?>
                    <span class="clear"></span>
                    <h2 class="col-title"><?php echo $groups[1]['title'] ?></h2>
                    <select name="" stt="<?php echo $k ?>" class="selectType">
                      <option value="">
                          Không có
                      </option>
                        <?php

                        foreach ($temporary_setting_parameter as $k2 => $v2) {


                            if ($k2 >=1  && $k2 <=4) {
                              $post2 = get_post($v2['post_id'], 'title, short_name');

                              if (empty($post2['short_name'])) $ten = $post2['title'];
                              else $ten = $post2['short_name'];
                              ?>
                              <option value="<?php echo $k2 ?>">
                                  <?php echo $ten ?>
                              </option>
                              <?php
                            }
                            //if ($k2 == 5) break;

                        }
                        ?>

                    </select>
                    <?php
                }

                if ($k == 5) {
                    ?>
                    <span class="clear"></span>
                    <h2 class="col-title"><?php echo $groups[2]['title'] ?></h2>
                    <select name="" stt="<?php echo $k ?>" class="selectType">
                      <option value="">
                          Không có
                      </option>
                        <?php
                        foreach ($temporary_setting_parameter as $k2 => $v2) {
                            if ($k2 <= 4 || $k2 >= 9) continue;
                            $post2 = get_post($v2['post_id'], 'title, short_name');

                            if (empty($post2['short_name'])) $ten = $post2['title'];
                            else $ten = $post2['short_name'];
                            ?>
                            <option value="<?php echo $k2 ?>">
                                <?php echo $ten ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                    <?php
                }
                if ($k == 9) {
                    ?>
                    <span class="clear"></span>
                    <h2 class="col-title"><?php echo $groups[3]['title'] ?></h2>
                    <select name="" stt="<?php echo $k ?>" class="selectType">
                      <option value="">
                          Không có
                      </option>
                        <?php
                        foreach ($temporary_setting_parameter as $k2 => $v2) {
                            if ($k2 <= 8 || $k2 >= 11) continue;
                            $post2 = get_post($v2['post_id'], 'title, short_name');

                            if (empty($post2['short_name'])) $ten = $post2['title'];
                            else $ten = $post2['short_name'];
                            ?>
                            <option value="<?php echo $k2 ?>">
                                <?php echo $ten ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                    <?php
                }
                if ($k == 11) {

                    ?>
                    <span class="clear"></span>
                    <h2 class="col-title"><?php echo $groups[4]['title'] ?></h2>
                    <select name="" stt="<?php echo $k ?>" class="selectType">
                      <option value="">
                          Không có
                      </option>
                        <?php
                        foreach ($temporary_setting_parameter as $k2 => $v2) {
                            if ($k2 <= 10) continue;
                            $post2 = get_post($v2['post_id'], 'title, short_name');

                            if (empty($post2['short_name'])) $ten = $post2['title'];
                            else $ten = $post2['short_name'];
                            ?>
                            <option value="<?php echo $k2 ?>">
                                <?php echo $ten ?>
                            </option>
                            <?php
                        }
                        ?>

                    </select>
                    <?php
                }
                $post = get_post($v['post_id'], 'title, short_name');

                if (empty($post['short_name'])) $ten = $post['title'];
                else $ten = $post['short_name'];


                ?>
                <div class="optionItem optionItem-<?php echo $k ?>" stt="<?php echo $k ?> clearfix">
                    <label for="optionItem-<?php echo $par ?>"
                           class="forum-label checkbox-beautiful <?php if ($v['is_default_display'] == 'yes') echo 'checked'; else echo 'uncheck'; ?>"><?php echo $ten ?></label>

                    <select name="is_default_display[]" class="none is_default_display" parameter="is_default_display">
                        <option value="yes">-- Hiển thị mặc định --</option>

                        <option <?php if ($v['is_default_display'] == 'yes') echo 'selected' ?> value="yes">Có</option>
                        <option <?php if ($v['is_default_display'] == 'no') echo 'selected' ?> value="no">Không</option>
                    </select>

                    <input type="hidden" name="post_id[]" value="<?php echo $v['post_id'] ?>"/>
                </div>
                <?php
            }
            ?>

        </div>
        <div class="SmartBedRoomOptionFormCol2 col-preview fl">
            <div class="col-preview-inner"></div>
        </div>
        <input type="submit" name="submit" value="Submit" class="none"/>
        <input type="hidden" name="type" value="smartBedRoomOption" class="none"/>
        <input name="openClose" type="hidden" value="open" class="openCloseInput"/>
        <input name="cartAction" type="hidden" value="no" class="saveCookie"/>
        <input type="hidden" name="block_id" value="<?php echo $block_param['block_id'] ?>" class="none"/>
        <div class="openClose openState"></div>
    </form>

</div>
