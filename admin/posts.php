<?php


if (!defined('SECURE_CHECK')) die('Invalid to include');

if (!user_can('posts')) die();

if (!isset($_GET['post_type_id'])) die('post_type_id not defined !');

if (!is_numeric($_GET['post_type_id'])) die('post_type_id invalid !');

if (!isset($_GET['page'])) $current_page = 1;
else {
    if (!is_numeric($_GET['post_type_id'])) die('post_type_id invalid !');
    $current_page = $_GET['page'];
}


$post_type_id = $_GET['post_type_id'];

$g_page_content['title'] = 'Posts';

$post_type_info = get_post_type($post_type_id);

if ($post_type_info == FALSE) die('Post type not found');


$param = array();

//h($g_page_info);

if ((isset($_GET['the_status'])) && ($_GET['the_status'] != 'all')) $param['status'] = $_GET['the_status'];
else $param['status'] = 'all';

if ((isset($_GET['category'])) && ($_GET['category'] != 'all')) $param['category'] = $_GET['category'];

if ((isset($_GET['tag'])) && ($_GET['tag'] != 'all')) $param['tag'] = $_GET['tag'];

if (!empty($_GET['s'])) $param['s'] = $_GET['s'];

//$param['field'] = 'id, url, title, image, description, user_id, time_create ';

//$param['limit'] = 'LIMIT ' . POSTS_PER_PAGE*($g_page_info['page'] - 1) . ', '. POSTS_PER_PAGE;

$param['page'] = $current_page;
$param['posts_per_page'] = POSTS_PER_PAGE;

$param['post_type'] = $post_type_id;
$param['schedule'] = ' 1 ';


$list_posts = get_posts($param);

$param['field'] = 'COUNT(*) AS total_post';

$param['limit'] = ' ';

$total = get_posts($param);

//h($total);

$total = $total[0]['total_post'];

//h($g_page_info);

if (isset($_GET['filter'])) {
    $suffix = '?category=' . $_GET['category'] . '&tag=' . $_GET['tag'] . '&s=' . $_GET['s'] . '&the_status=' . $_GET['the_status'] . '&filter=Lọc/';
} else $suffix = '';

$base_link = SITE_URL . '/admin/';

?>

<?php

include 'header.php';
?>

<div id="" class="container">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div class="box">
            <div id="bread-crumbs">
                <a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
                <span class="arrow">›</span>
                <a class="link"
                   href="<?php echo SITE_URL ?>/admin/?page_type=posts&post_type_id=<?php echo $post_type_id ?>">Danh
                    sách "<?php echo $post_type_info['name'] ?>"</a>
                <span class="current-page"></span>

            </div>
        </div>
        <div id="main-content">
            <div class="box">


                <h1>Danh sách "<?php echo $post_type_info['name'] ?>" (<?php echo $total ?>)
                    <div class="fr inline-block posts-action">
                        <span title="Tìm kiếm" class="pointer toggle-filter  "><i class="fa fa-search"></i></span>
                        <a title="Thêm mới" class="posts-new-post  "
                           href="<?php echo SITE_URL . '/admin/?page_type=new-post&post_type_id=' . $post_type_id; ?>"><i
                                class="fa fa-plus"></i></a>
                    </div>
                </h1>


                <div class=" ">


                    <div id="filter-field" style="<?php if (isset($_GET['filter'])) echo 'display:block' ?>">

                        <form action="">
                            <input name="page_type" type="hidden" value="posts"/>
                            <input name="post_type_id" type="hidden" value="<?php echo $post_type_id ?>"/>
                            <div class="filter-item">
                                <label class="fl block">Chuyên mục : </label>


                                <div class="field fl">
                                    <?php
                                    $sub_count = 0;
                                    if (isset($_GET['category'])) {
                                        $default_value['category'] = $_GET['category'];
                                    } else $default_value['category'] = 'all';
                                    function display_forum($forum)
                                    {
                                        global $sub_count;
                                        global $default_value;
                                        ?>
                                        <option
                                            value="<?php echo $forum['id'] ?>" <?php check_select('category', $default_value['category'], $forum['id']) ?>><?php for ($i = 0; $i < $sub_count; $i++) echo '----';
                                            echo $forum['title'] ?></option>
                                        <?php

                                        $sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
                                        if (!empty($sub_forums)) {
                                            $sub_count++;
                                            foreach ($sub_forums as $s_k => $s_v) {
                                                display_forum($s_v);
                                                if ($s_k == (count($sub_forums) - 1)) $sub_count--;
                                            }
                                            ?>

                                            <?php
                                        }
                                        //else

                                        ?>

                                        <?php
                                        ?>

                                        <?php
                                    }

                                    ?>
                                    <select name="category" id="parent">
                                        <option
                                            value="all" <?php check_select('category', $default_value['category'], '0') ?>>
                                            Tất cả
                                        </option>

                                        <?php
                                        $forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY stt ASC');

                                        foreach ($forums as $forum) {
                                            display_forum($forum);
                                        }
                                        ?>


                                    </select>
                                </div>

                            </div>

                            <div class="filter-item">
                                <label class="fl block">TAG : </label>
                                <select name="tag">
                                    <option value="all">Tất cả</option>

                                    <?php
                                    $temp_tags = get_tags();
                                    foreach ($temp_tags as $temp_tag) {
                                        ?>
                                        <option <?php if (isset($_GET['tag']) && ($_GET['tag'] == $temp_tag['id'])) echo 'selected' ?>
                                            value="<?php echo $temp_tag['id'] ?>"><?php echo $temp_tag['title'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="filter-item">
                                <label class="block fl">Trạng thái : </label>
                                <select name="the_status">
                                    <option value="all">Tất cả</option>
                                    <option
                                        value="publish" <?php if ((isset($_GET['the_status'])) && ($_GET['the_status'] == 'publish')) echo 'selected' ?>>
                                        Đã xuất bản
                                    </option>
                                    <option
                                        value="pending" <?php if ((isset($_GET['the_status'])) && ($_GET['the_status'] == 'pending')) echo 'selected' ?>>
                                        Nháp
                                    </option>
                                </select>
                            </div>

                            <div class="filter-item">
                                <label class="block fl">Từ khóa : </label>
                                <input type="text" class="text" autocomplete="off" placeholder="Từ khóa tìm kiếm"
                                       value="<?php if (isset($_GET['s'])) echo $_GET['s'] ?>" name="s"/>
                            </div>

                            <span class="clear"></span>
                            <input type="submit" name="filter" id="submit" value="Lọc"/>
                        </form>
                        <form action="" method="GET">
                            <input name="post_type_id" type="hidden" value="<?php echo $post_type_id ?>"/>
                            <input name="page_type" type="hidden" value="posts"/>
                            <input type="submit" value="Bỏ lọc" class="fr" id="remove-filter"/>
                        </form>
                    </div>

                    <span class="clear"></span>

                    <div class="border-box clearfix ">
                        <div class="fl">
                            <div class="view-list-count">Đang xem từ
                                <strong><?php echo POSTS_PER_PAGE * ($current_page - 1) + 1 ?></strong> đến
                                <strong><?php if ($total < POSTS_PER_PAGE * ($current_page)) echo $total; else echo POSTS_PER_PAGE * ($current_page) ?></strong>
                                trong tổng số <strong><?php echo $total ?></strong> bài viết
                            </div>
                        </div>
                        <div id="action-all" class="fr" action="" method="">Với các mục đã chọn :

                            <select>
                                <option value="0">None</option>
                                <option value="del">Xóa</option>
                            </select>
                            <input type="button" id="submit-action-all" value="Xác nhận"/>

                        </div>
                    </div>

                    <table id="list-post" class="list-table">
                        <tr class="tr-first">
                            <td class="check">
                                <i class="fa fa-square-o check-hd-all check check-all " child="hd"></i>
                            </td>
                            <td class="stt">
                                STT
                            </td>
                            <td class="image">
                                Hình ảnh
                            </td>
                            <td class="title">
                                Bài viết
                            </td>
                            <?php if($post_type_id == 2){?>
                            <td class="price">
                                Giá
                            </td>
                            <?php } ?>
                            <td class="categories">
                                Chuyên mục
                            </td>
                            <td class="tags">
                                Tag
                            </td>
                        </tr>
                        <?php
                        foreach ($list_posts as $k => $list_post) {
                            if (empty($list_post['image'])) $image_link = CDN_DOMAIN . '/inc/images/noimage.png';
                            else $image_link = $list_post['image'];

                            $categories = get_post_categories($list_post['id'], 'id, url, title');
                            $tags = get_post_tags($list_post['id'], 'id, url, title');
                            ?>
                            <tr class="list-thread-item list-thread-item-<?php echo $list_post['url'] ?> ">
                                <td class="check">
                                    <i class="fa fa-square-o check-hd check" ten="ID <?php echo $list_post['id'] ?>"
                                       par="<?php echo $list_post['id'] ?>" p_id="<?php echo $list_post['id'] ?>"></i>
                                    <input class=" input-check input-check-hd none "
                                           par="<?php echo $list_post['id'] ?>"
                                           id="input-check-<?php echo $list_post['id'] ?>" type="checkbox"/>
                                </td>
                                <td class="stt">
                                    <?php echo $k + 1 ?>
                                </td>
                                <td class="image">
                                    <a class="block image"
                                       href="<?php if (!user_can('edit-post', $list_post['id'])) echo '#'; else echo SITE_URL ?>/admin/?page_type=edit-post&post_id=<?php echo $list_post['id'] ?>"
                                       title="<?php echo $list_post['title'] ?>">
                                        <img src="<?php timthumb_url($image_link, 140, 100); ?>"/>
                                    </a>
                                </td>
                                <td class="title">
                                    <a class="thread-name"
                                       href="<?php if (!user_can('edit-post', $list_post['id'])) echo '#'; else echo SITE_URL ?>/admin/?page_type=edit-post&post_id=<?php echo $list_post['id'] ?>">
                                        <?php echo $list_post['title'] ?>
                                    </a>
                                    <p class="list-thread-item-des">
                                        <a class="view"
                                           href="<?php hcv_url('p', $list_post['url'], $list_post['id']) ?>">Xem</a>

                                        <?php
                                        if (user_can('edit-post', $list_post['id'])) {
                                            ?>
                                            <a class="edit"
                                               href="<?php echo SITE_URL ?>/admin/?page_type=edit-post&post_id=<?php echo $list_post['id'] ?>">Sửa</a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
                                        }

                                        ?>
                                        <?php
                                        if (user_can('delete-post', $list_post['id'])) {
                                            ?>
                                            <a class="delete delete-post" post_id="<?php echo $list_post['id'] ?>"
                                               href="<?php echo SITE_URL ?>/admin/delete-post/<?php echo $list_post['id'] ?>">Xóa</a>

                                            <?php
                                        }

                                        ?>

                                    </p>
                                </td>
                                <?php if($post_type_id == 2){?>
                                    <td class="price">
                                        <p><span class="priceTitle">Giá gốc :</span> <span
                                                class="priceContent"><?php echo num_to_price($list_post['gia']) ?></span>
                                        </p>
                                        <p><span class="priceTitle">(%)KM :</span> <span
                                                class="priceContent"><?php if (!empty($list_post['recent_km'])) echo num_to_price($list_post['recent_km']), ' %'; else echo '0%' ?></span>
                                        </p>
                                        <p><span class="priceTitle">Giá KM :</span> <span
                                                class="priceContent"><?php if (!empty($list_post['gia']) && !empty($list_post['recent_km'])) echo num_to_price($list_post['gia'] - ($list_post['recent_km'] / 100 * (($list_post['gia'])) / 1000) * 1000); else echo num_to_price($list_post['gia']) ?></span>
                                        </p>
                                        <!--																<p><span class="priceTitle">Đã giảm :</span> <span class="priceContent">-->
                                        <?php //if( !empty($list_post['gia']) && !empty($list_post['gia_km']) ) echo floor(100 * (  ($list_post['gia'] - $list_post['gia_km'])/$list_post['gia'])), '%'; else echo '0 %'
                                        ?><!--</span></p>-->
                                    </td>
                                <?php } ?>
                                <td class="categories archive-info">
                                    <div class="  categories">
                                        <?php
                                        foreach ($categories as $k => $category) {
                                            if ($k) echo ' ,';
                                            ?>
                                            <a title="Xem các bài viết trong chuyên mục <?php echo $category['title'] ?>"
                                               href="<?php echo SITE_URL ?>/admin/?page_type=posts&post_type_id=<?php echo $post_type_id ?>&category=<?php echo $category['id'] ?>&tag=all&s=&the_status=all&filter=Lọc"><?php echo $category['title'] ?></a>
                                            <?php

                                        }

                                        ?>
                                    </div>
                                </td>
                                <td class="tags archive-info">
                                    <div class="  tags">
                                        <?php
                                        foreach ($tags as $k => $tag) {
                                            if ($k) echo ' ,';
                                            ?>
                                            <a title="Xem các bài viết trong tag <?php echo $tag['title'] ?>"
                                               href="<?php echo SITE_URL ?>/admin/?page_type=posts&post_type_id=<?php echo $post_type_id ?>&category=all&tag=<?php echo $tag['id'] ?>&the_status=all&s=&filter=Lọc"><?php echo $tag['title'] ?></a>

                                            <?php

                                        }

                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>

                    <span class="clear"></span>
                    <?php
                    $param = array(
                        'base_url' => $base_link,
                        'current_page' => $current_page,
                        'total_post' => $total,
                        'posts_per_page' => POSTS_PER_PAGE,
                        'suffix' => $suffix
                    );
                    new_display_pagination($param)

                    ?>

                    <span class="clear"></span>


                </div>


            </div>
            <span class="clear"></span>
        </div>
    </div>
