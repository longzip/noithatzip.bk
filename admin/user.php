<?php


    if(!defined('SECURE_CHECK')) die('Invalid to include');

    if(!user_can('user')) die();

	$g_page_content['title'] = 'Users';

    if(!isset($_GET['page'])) $current_page = 1;
    else
    {

        $current_page = $_GET['page'];
    }


    $param = array();

        //h($g_page_info);

		if(isset($_GET['permission'])) $param['permission'] = $_GET['permission'];
        else $param['permission'] = '';


        if(!empty($_GET['s'])) $param['s'] = $_GET['s'];


		$param['limit'] = 'LIMIT ' . POSTS_PER_PAGE*($current_page - 1) . ', '. POSTS_PER_PAGE;



		$list_users = get_users($param);

		$param['field'] = 'COUNT(*) AS total_post';

		$param['limit'] = ' ';

		$total = get_users($param);

		//h($total);

		$total = $total[0]['total_post'];

        //h($g_page_info);



		$base_link = SITE_URL . '/admin/'; //hcv_url('admin/posts/' . $g_page_info['page_id'], '', '', FALSE);

?>

<?php

	include 'header.php';
?>

<div id="" class="container">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
            <div class="box">
                <div id="bread-crumbs">
            		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
            		<span class="arrow">›</span>
                    <a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=user">Danh sách thành viên</a>
            		<span class="current-page"></span>

            	</div>
            </div>

            <div class="box">

            <h1>Danh sách thành viên (<?php echo $total - 2 ?>) 
                <span class="pointer toggle-filter fr none">Lọc thành viên</span>
                <div class="fr inline-block posts-action">
                     <a title="Thêm mới" class="posts-new-post  " href="<?php echo SITE_URL . '/admin/?page_type=new-user' ?>"><i class="fa fa-plus"></i></a>
                </div>
            </h1>


               <div class="box">

        	   <div id="filter-field" style="<?php if(isset($_GET['filter'])) echo 'display:block' ?>">

        		<form action="">
        		<input name="page_type" type="hidden" value="user" />


        		  <div class="filter-item">
        				<label class="block fl">Permission : </label>
        				<select name="the_status">
        					<option value="all">Tất cả</option>
        					<option value="admin" <?php if((isset($_GET['permission']))&&($_GET['permission'] == 'admin')) echo 'selected' ?>>Admin</option>
        					<option value="editor" <?php if((isset($_GET['permission']))&&($_GET['permission'] == 'editor')) echo 'selected' ?>>Editor</option>
                            <option value="author" <?php if((isset($_GET['permission']))&&($_GET['permission'] == 'author')) echo 'selected' ?>>Author</option>
                            <option value="contributor" <?php if((isset($_GET['permission']))&&($_GET['permission'] == 'contributor')) echo 'selected' ?>>Contributor</option>
                            <option value="member" <?php if((isset($_GET['permission']))&&($_GET['permission'] == 'member')) echo 'selected' ?>>Member</option>
        				</select>
        		  </div>

                  <div class="filter-item">
        				<label class="block fl">Từ khóa : </label>
        				<input type="text" class="text" autocomplete="off" placeholder="Từ khóa tìm kiếm" value="<?php if(isset($_GET['s'])) echo $_GET['s'] ?>" name="s" />
        		  </div>

        		 <span class="clear"></span>
        		 <input type="submit" name="filter" id="submit" value="Lọc" />
        		 </form>
                 <form action="" method="GET">
                    <input name="page_type" type="hidden" value="user" />
                    <input type="submit" value="Bỏ lọc" class="fr" id="remove-filter" />
                 </form>
        	   </div>


        	   <span class="clear"></span>
        	<?php



                //echo $base_link;

        		//h($list_posts);
        		foreach($list_users as $list_user)
        		{

        			if(empty($list_user['image'])) $image_link = CDN_DOMAIN . '/admin/images/user-128.png';
        			else $image_link = $list_user['image'];

                    if($list_user['id']==1) continue;

        			?>
        			<div class="list-thread-item border-left-hover user-<?php echo $list_user['user_name'] ?>">
        				<a class="block image fl" href="<?php echo SITE_URL ?>/admin/?page_type=edit-user&user_id=<?php echo $list_user['id'] ?>" title="<?php echo $list_user['user_name'] ?>">
        					<img style="width: 60px;" src="<?php echo CDN_DOMAIN ?>/apps/timthumb/timthumb.php?src=<?php echo $image_link ?>&w=200&h=200" />

        				</a>

                        <div class="general-info fl">
                            <a class="thread-name" href="<?php echo SITE_URL ?>/admin/?page_type=edit-user&user_id=<?php echo $list_user['id'] ?>">
            					<?php echo $list_user['user_name'] ?>
            				</a>

                   	    <p class="list-thread-item-des">
            					<!-- <a class="view" href="#">Xem</a> -->
            					<a class="edit" href="<?php echo SITE_URL ?>/admin/?page_type=edit-user&user_id=<?php echo $list_user['id'] ?>">Sửa</a>
            					&nbsp;&nbsp;&nbsp;&nbsp;
            					<a class="delete delete-user" user_id="<?php echo $list_user['id'] ?>" href="<?php echo SITE_URL ?>/admin/delete-user/<?php echo $list_user['id'] ?>">Xóa</a>
            				</p>

                        </div>


                        <div class="archive-info fr">
                            <div class="fl categories"><strong>Permission : </strong>

                                        <a title="Xem các  <?php echo $list_user['permission'] ?>" href="<?php echo SITE_URL ?>/admin/user?s=&permission=<?php echo $list_user['permission'] ?>&filter=Lọc"><?php echo $list_user['permission'] ?></a>

                            </div>
                            <span class="clear"></span>

                        </div>

        				<span class="clear"></span>
        			</div>
        			<?php
        		}
        	?>
           <span class="clear"></span>
           <?php
                $param = array(
                    'base_url'          => $base_link,
                    'current_page'      => $current_page,
                    'total_post'        => $total,
                    'posts_per_page'    => POSTS_PER_PAGE
                );
                new_display_pagination( $param )

           ?>

        	<span class="clear"></span>
               </div>

               <div class="view-list-count">Đang xem từ <strong><?php echo POSTS_PER_PAGE*($current_page - 1) + 1 ?></strong> đến <strong><?php if($total < POSTS_PER_PAGE*($current_page )) echo $total - 1; else echo POSTS_PER_PAGE*($current_page) ?></strong> trong tổng số <strong><?php echo $total - 2 ?></strong> thành viên</div>


            </div>
            <span class="clear"></span>
        </div>
    </div>

      <?php include 'footer.php'; ?>
