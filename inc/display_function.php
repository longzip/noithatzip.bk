<?php

function h($par)
{
    ?>
    <pre style="padding: 10px;background: rgb(231, 243, 255);border: 1px solid silver;margin: 10px;font-size: 13px;color: rgb(69, 69, 69);">
        <?php print_r($par) ?>
    </pre>
    <?php
}

function hcv_media_frame()
{
	?>
	<div id="media-frame" class="fixed none">
		<div class="frame-action"><span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;<span class="close-frame btn btn-default">Đóng</span></div>
	</div>
	<div class="opacity fixed opacity-frame"></div>
	<?php
}


function display_pagination($param)
{

    $url_suffix = '';
    if(!defined('ADMIN_PAGE')) $url_suffix = URL_SUFFIX;

    $base_url = $param['base_url'];
    $current_page = $param['current_page'];
    $total_post = $param['total_post'];



    if(empty($param['posts_per_page'])) $posts_per_page = get_option('posts_per_page');
    else $posts_per_page = $param['posts_per_page'];

    if(empty($param['near_page'])) $near_page = 3;
    else $near_page = $param['near_page'];

    if(empty($param['suffix'])) $suffix = '';
    else $suffix = $param['suffix'];

    //die($base_url);

    if($total_post > $posts_per_page) :
    ?>

    <div  id="pagination">

            <?php
                $url_type = $base_url;
                if($current_page != 1)
                {
                    $next = $current_page - 1;
                    ?>
                    <a href="<?php echo $url_type . URL_SUFFIX ?>" class="first">Trang đầu</a>
                    <?php
                        if($current_page == 2)
                        {
                            ?>
                            <a  href="<?php echo $url_type  . $url_suffix .   $suffix ?>" class="prev">«</a>

                            <?php
                        }
                        else
                        {
                            ?>
                            <a  href="<?php echo $url_type  .  '/' . $next . $url_suffix .   $suffix ?>" class="prev">«</a>

                            <?php
                        }
                    ?>
                    <?php
                }
            ?>
            <?php
                $page_count = floor($total_post / $posts_per_page);

                if($total_post % $posts_per_page) $page_count++;
                $display_page = array(1);


                for($i = 1; $i <= $page_count; $i++)
                {

                    if(!in_array($i, $display_page))
                    {
                        if( ( $i <=($current_page+ $near_page)) && ($i >=($current_page - $near_page)) ) $display_page[] = $i;
                    }
                }

                if(!in_array($i-1, $display_page))
                {
                    $display_page[] = $i - 1;
                }

                foreach($display_page as $k=>$v)
                {
                    if($v != 1) $href = $url_type . '/' . $v . $url_suffix ;
                    else $href = $url_type . URL_SUFFIX;
                    ?>
                    <a class="<?php if($current_page == $v) echo ' active' ?>" href="<?php echo $href  . $suffix ?>"><?php echo $v ?></a>
                    <?php
                    if(isset($display_page[$k+1]))
                    {
                        if($display_page[$k+1] != ($v+1)) echo '<span>...</span>';
                    }
                }

            ?>

            <?php
                if($current_page != $page_count)
                {
                    $next = $current_page + 1;
                    ?>
                    <a href="<?php echo $url_type .  '/'. $next . $url_suffix . $suffix?>" class="next">»</a><a href="<?php echo $url_type . '/' .  $page_count . $url_suffix .   $suffix ?>" class="last">Trang cuối</a>
                    <?php
                }
            ?>

            <span class="clear"></span>
        </div>
        <?php
        endif;
}

function new_display_pagination($param)
{



    $base_url = $param['base_url'];
    $current_page = $param['current_page'];
    $total_post = $param['total_post'];



    if(empty($param['posts_per_page'])) $posts_per_page = get_option('posts_per_page');
    else $posts_per_page = $param['posts_per_page'];

    if(empty($param['near_page'])) $near_page = 3;
    else $near_page = $param['near_page'];


    $parse_url = parse_url(CURRENT_URL, PHP_URL_QUERY);


    parse_str($parse_url, $url_get);

     unset($url_get['page']);


    $suffix = '';

    $count_url_get_to_set = 0;

    $count_url_get = count($url_get);

    foreach($url_get as $url_get_k=>$url_get_v)
    {

        if($count_url_get_to_set)
        {
            $suffix = $suffix . '&' . $url_get_k . '=' . $url_get_v;
        }
        else
        {
            $suffix = $suffix . '?' . $url_get_k . '=' . $url_get_v;
        }
        $count_url_get_to_set++;
    }

    if(empty($suffix)) $pre_nav = '?';
    else $pre_nav = '&';



    if($total_post > $posts_per_page) :
    ?>

    <div  id="pagination">

            <?php
                $url_type = $base_url;
                if($current_page != 1)
                {
                    $prev = $current_page - 1;
                    ?>
                    <a href="<?php echo $url_type . $suffix ?>" class="first">Trang đầu</a>
                    <?php
                        if($current_page == 2)
                        {
                            ?>
                            <a  href="<?php echo $url_type   .   $suffix ?>" class="prev">«</a>

                            <?php
                        }
                        else
                        {
                            ?>
                            <a  href="<?php echo $url_type . $suffix . $pre_nav . 'page=' . $prev ?>" class="prev">«</a>

                            <?php
                        }
                    ?>
                    <?php
                }
            ?>
            <?php
                $page_count = floor($total_post / $posts_per_page);

                if($total_post % $posts_per_page) $page_count++;
                $display_page = array(1);


                for($i = 1; $i <= $page_count; $i++)
                {

                    if(!in_array($i, $display_page))
                    {
                        if( ( $i <=($current_page+ $near_page)) && ($i >=($current_page - $near_page)) ) $display_page[] = $i;
                    }
                }

                if(!in_array($i-1, $display_page))
                {
                    $display_page[] = $i - 1;
                }

                foreach($display_page as $k=>$v)
                {
                    if($v != 1) $href = $url_type . $suffix . $pre_nav .  'page=' . $v;
                    else $href = $url_type . $suffix;
                    ?>
                    <a class="<?php if($current_page == $v) echo ' active' ?>" href="<?php echo $href ?>"><?php echo $v ?></a>
                    <?php
                    if(isset($display_page[$k+1]))
                    {
                        if($display_page[$k+1] != ($v+1)) echo '<span>...</span>';
                    }
                }

            ?>

            <?php
                if($current_page != $page_count)
                {
                    $next = $current_page + 1;
                    ?>
                    <a href="<?php echo $url_type . $suffix . $pre_nav . 'page=' . $next ?>" class="next">»</a>
                    <a href="<?php echo $url_type . $suffix .  $pre_nav . 'page=' . $page_count ?>" class="last">Trang cuối</a>
                    <?php
                }
            ?>

            <span class="clear"></span>
        </div>
        <?php
        endif;
}


function wp_footer()
{
	global $g_user;
	global $g_page_info;

	//h($g_user);

	if($g_user['permission'] == 'admin')
	{
		$page_admin_action = '';
		if($g_page_info['page_type'] == 'post')
		{
			$page_admin_action = '<a href="' . SITE_URL . '/admin/?page_type=edit-post&post_id=' . $g_page_info['page_id'] .'">Sửa bài viết</a>';
		}

		if($g_page_info['page_type'] == 'category')
		{
			$page_admin_action = '<a href="' .SITE_URL . '/admin/?page_type=edit-category&category_id=' . $g_page_info['page_id'] . '">Sửa chuyên mục</a>';

		}

		if($g_page_info['page_type'] == 'home')
		{
			  //echo 'aaa';
		}
        if($g_page_info['page_type'] == 'tag')
		{
			  $page_admin_action = '<a href="' .SITE_URL . '/admin/page_type=edit-tag&tag_id=' . $g_page_info['page_id'] . '">Sửa tag</a>';
		}

		?>
		<div id="media-frame">
            <div class="fr frame-action">
                <span class="submit-frame btn btn-primary">Chọn</span>&nbsp;&nbsp;
                <span class="close-frame btn btn-default">Đóng</span>
            </div>
        </div>
        <div class="fixed" id="hcv-opacity"></div>
		<div id="block-loading"><img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" /></div>
		<div class="fixed wp-footer <?php if(isset($_COOKIE['wp_footer_direction'])) echo $_COOKIE['wp_footer_direction'] ?>">

			<?php
				$notifications = models_DB::get('SELECT COUNT(id) as total_noti FROM ' . NOTIFICATION_TABLE . ' WHERE already_read=0 AND user_id=' . $g_user['id']);
				$total_noti = 	$notifications[0]['total_noti'];
				if($total_noti)
				{
					?>
					<a title="Có <?php echo $total_noti ?> thông báo mới" href="<?php echo SITE_URL ?>/admin/?page_type=notification">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img class="admin-bell" src="<?php echo CDN_DOMAIN ?>/inc/images/icon-ios7-bell-128.png" /><span  class="wp-footer-noti-count"><?php echo $total_noti ?></span></a>
					<?php
				}
			?>

			<a href="<?php echo SITE_URL  ?>/admin/">Quản trị</a>
			<?php echo $page_admin_action; ?>
			<div id="vngit-header">
				<link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css" />
                 <?php

				if(isset($_COOKIE['design']))
				{
					?>

					<link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/block.css" />
					<form action="" method="post" >
					<button type="submit" id="design-mode" name="close_design" >Quit</button>
					</form>
					<div id="list_block">

					<script>
						var site_url = "<?php echo SITE_URL ?>";
					</script>



					<script     src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-ui.js"></script>
					<script defer  src="<?php echo CDN_DOMAIN ?>/inc/js/block.js"></script>
					<?php
						foreach( scandir( PATH_ROOT . '/blocks' )  as $k=>$v )
						{
							if($k != '.' && $v != '..')
							{
							   ?>
								<div block_name="<?php echo $v ?>" block_id="0" class="draggable core-block  core-block-<?php echo $v ?> fl bold verdana <?php echo $v ?>"><?php echo $v; ?></div>

                                <?php
							}

						}
					?>
					<span class="clear"></span>
					</div>
					<?php
				}
				else
				{
					?>
					<form action="" method="post">
					<button type="submit" name="open_design" id="design-mode">Design</button>
					</form>

					<?php
				}
				?>
				</div>
                <div class="change-direction">
                    <span class="change-direction-item top <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'top')) echo ' active ' ?> <?php if(!isset($_COOKIE['wp_footer_direction'])  ) echo ' active ' ?>" par="top"></span>
                    <span class="change-direction-item right <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'right')) echo ' active ' ?>" par="right"></span>
                    <span class="change-direction-item bottom <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'bottom')) echo ' active ' ?>" par="bottom"></span>
                    <span class="change-direction-item left <?php if(isset($_COOKIE['wp_footer_direction']) && ($_COOKIE['wp_footer_direction'] == 'left')) echo ' active ' ?>" par="left"></span>
                </div>
		</div>

		<?php
	}
}


function hcv_head()
{
     global $g_page_info;

     global $other_header;

     switch($g_page_info['page_type'])
     {
        case 'home' :
        {

             $title  = get_option('site_name');

             $description = get_option('site_description');


             //$other_header .= '<link rel="canonical" href="'. SITE_URL .'" />';

             if(!ROBOTS_INDEX)
             {
                 $other_header .= '<meta name="robots" content="noindex,nofollow" />';
             }
             else
             {
                $other_header .= '<meta name="robots" content="index,follow" />';
             }

             $site_keyword =  get_option('site_keyword');
             if(!empty($site_keyword)) $other_header .= '<meta name="keywords" content="'. $site_keyword .'" />';
        }
        break;

        case 'post' :
        {
            global $post_info;

            $seo_info = json_decode($post_info['seo'], TRUE);

            if(empty($seo_info['title'])) $title = $post_info['title'];
            else $title  = $seo_info['title'];

            if(!empty($seo_info['description'])) $description = $seo_info['description'];
            else $description = $title;

            if(!empty($seo_info['301']))
            {
            	Header( "HTTP/1.1 301 Moved Permanently" );
            	header('Location:'.$seo_info['301']);
            }

            if(!empty($seo_info['canonical']))
            {
                $other_header .= '<link rel="canonical" href="'. $seo_info['canonical'] .'" />';
            }
            else
            {
                $other_header .= '<link rel="canonical" href="'. hcv_url('p', $post_info['url'], $post_info['id'], FALSE) .'" />';
            }

            if(!empty($seo_info['keywords'])) $other_header .= '<meta name="keywords" content="'. $seo_info['keywords'] .'" />';

            if(ROBOTS_INDEX && ($post_info['the_status'] == 'publish'))
            {
                $other_header .= '<meta name="robots" content="'. $seo_info['index'] .','. $seo_info['follow'] .'" />';
            }
            else
            {
                $other_header .= '<meta name="robots" content="noindex,nofollow" />';
            }

            if(!empty($post_info['image']))
            {
                $other_header .= '<meta property="og:image" content="' . $post_info['image'] . '" />';
            }
            $other_header .= '<meta property="og:type" content="article" />';
            $other_header .= '<meta property="og:title" content="' . $post_info['title'] . '" />';
            $other_header .= '<meta property="og:description" content="' . strip_tags($post_info['description']) . '" />';
            $other_header .= '<meta property="og:url" content="' . hcv_url('p', $post_info['url'], $post_info['id'], FALSE) . '" />';

        }
        break;

        case 'category' :
        {
            global $category_info;

            $seo_info = json_decode($category_info['seo'], TRUE);

            if(empty($seo_info['title'])) $title = $category_info['title'];
            else $title  = $seo_info['title'];

            if(!empty($seo_info['description'])) $description = $seo_info['description'];
            else $description = $title;

            if(!empty($seo_info['301']))
            {
            	Header( "HTTP/1.1 301 Moved Permanently" );
            	header('Location:'.$seo_info['301']);
            }

            if(!empty($seo_info['canonical']))
            {
                $other_header .= '<link rel="canonical" href="'. $seo_info['canonical'] .'" />';
            }
            else
            {
                $other_header .= '<link rel="canonical" href="'. hcv_url('p', $category_info['url'], $category_info['id'], FALSE) .'" />';
            }

            if(!empty($seo_info['keywords'])) $other_header .= '<meta name="keywords" content="'. $seo_info['keywords'] .'" />';

            if(ROBOTS_INDEX && ($category_info['the_status'] == 'publish'))
            {
                $other_header .= '<meta name="robots" content="'. $seo_info['index'] .','. $seo_info['follow'] .'" />';
            }
            else
            {
                $other_header .= '<meta name="robots" content="noindex,nofollow" />';
            }

            if(!empty($category_info['image']))
            {
                $other_header .= '<meta property="og:image" content="' . $category_info['image'] . '" />';
            }
            $other_header .= '<meta property="og:type" content="article" />';
            $other_header .= '<meta property="og:title" content="' . $category_info['title'] . '" />';
            $other_header .= '<meta property="og:description" content="' . strip_tags($category_info['description']) . '" />';
            $other_header .= '<meta property="og:url" content="' . hcv_url('c', $category_info['url'], $category_info['id'], FALSE) . '" />';

        }
        break;

        case 'tag' :
        {
            global $tag_info;

            $seo_info = json_decode($tag_info['seo'], TRUE);

            if(empty($seo_info['title'])) $title = $tag_info['title'];
            else $title  = $seo_info['title'];

            if(!empty($seo_info['description'])) $description = $seo_info['description'];
            else $description = $title;

            if(!empty($seo_info['301']))
            {
            	Header( "HTTP/1.1 301 Moved Permanently" );
            	header('Location:'.$seo_info['301']);

            }

            if(!empty($seo_info['canonical']))
            {
                $other_header .= '<link rel="canonical" href="'. $seo_info['canonical'] .'" />';
            }
            else
            {
                $other_header .= '<link rel="canonical" href="'. hcv_url('p', $tag_info['url'], $tag_info['id'], FALSE) .'" />';
            }



            if(!empty($seo_info['keywords'])) $other_header .= '<meta name="keywords" content="'. $seo_info['keywords'] .'" />';

            if(ROBOTS_INDEX && ($tag_info['the_status'] == 'publish'))
            {
                $other_header .= '<meta name="robots" content="'. $seo_info['index'] .','. $seo_info['follow'] .'" />';
            }
            else
            {
                $other_header .= '<meta name="robots" content="noindex,nofollow" />';
            }

            if(!empty($tag_info['image']))
            {
                $other_header .= '<meta property="og:image" content="' . $tag_info['image'] . '" />';
            }
            $other_header .= '<meta property="og:type" content="article" />';
            $other_header .= '<meta property="og:title" content="' . $tag_info['title'] . '" />';
            $other_header .= '<meta property="og:description" content="' . strip_tags($tag_info['description']) . '" />';
            $other_header .= '<meta property="og:url" content="' . hcv_url('t', $tag_info['url'], $tag_info['id'], FALSE) . '" />';



        }
        break;

        case 'search' :
        {
             $title  = 'Tìm kiếm';

             $description = 'Tìm kiếm';

             if(!ROBOTS_INDEX)
             {
                 $other_header .= '<meta name="robots" content="noindex,nofollow" />';
             }
        }
        break;

        case '404' :
        {
             $title  = 'Không tìm thấy trang này';

             $description = 'Không tìm thấy trang này';

             $other_header .= '<meta name="robots" content="noindex,nofollow" />';
        }
        break;

     }





     ?>
     <title><?php echo $title ?></title>

	 <meta charset="utf-8" />
     <meta name="description" content="<?php echo $description ?>"/>
	 <meta property="og:locale" content="en_US" />

	 <meta property="og:site_name" content="<?php echo get_option('site_name'); ?>" />

     <link    rel="shortcut icon" href="<?php echo get_option('favicon') ?>" type="image/x-icon" />

	 <script>
		var site_url = "<?php echo SITE_URL ?>";
		var tpl_url = "<?php echo TEMPLATE_URL ?>";

		var cdn_domain = "<?php echo CDN_DOMAIN ?>";
		var cnd_tpl_url = "<?php echo CDN_DOMAIN . '/tpl/' . TEMPLATE ?>";
	 </script>


	 <script    src="<?php echo CDN_DOMAIN ?>/apps/js/jquery-1.10.2.js"></script>
     <script  defer src="<?php echo CDN_DOMAIN ?>/inc/js/form.js"></script>
      <link   rel="stylesheet" id="css-reset" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/reset.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />
             <link   rel="stylesheet"  id="css-responsive" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/vos-responsive.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />

     <?php
        if(USER_PERMISSION == 'admin')
        {
            ?>
            <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css" media="all" />

            <script  defer  src="<?php echo CDN_DOMAIN ?>/inc/js/admin.js"></script>
            <?php
        }

        $menu_style = get_option('v_main_menu_style');
        if(!empty($menu_style))
        {
            ?>
            <script  defer  src="<?php echo CDN_DOMAIN ?>/inc/menu-style/js/<?php echo $menu_style ?>.js"></script>
            <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/menu-style/css/<?php echo $menu_style ?>.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />
            <?php
        }
     ?>

     <?php
     $actived_addons = get_option('actived_addons');
    if(empty($actived_addons)) $actived_addons = array();
    else $actived_addons = json_decode($actived_addons, TRUE);

    foreach($actived_addons as $actived_addon)
    {
        ?>
        <script  defer  src="<?php echo CDN_DOMAIN ?>/addon/<?php echo $actived_addon ?>/js.js"></script>
        <link     rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/addon/<?php echo $actived_addon ?>/css.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />
        <?php
    }

     echo $other_header;
}




function display_categories_checkbox($name, $selected = array(),  $other = '')
{
			$sub_count = 0;

            if(!function_exists('display_forum_checkbox'))
            {
                function display_forum_checkbox($forum, $selected = array())
    			{
    				global $temp_post_type;

    				global $sub_count;
    				?>
    					<div class="forum">
    						<div class="forum-detail">
    							<label class="forum-label"><input name="<?php echo $name ?>[]" type="checkbox" <?php if(in_array($forum['id'], $selected)) echo ' checked'; ?>  value="<?php echo $forum['id'] ?>" /><?php echo $forum['title'] ?></label>


    						</div>

    					 <?php
    						$sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
    						if(!empty($sub_forums))
    						{
    							$sub_count++;
    							?>
    							<div class="sub-forum sub-forum-<?php echo $sub_count ?>">
    							<?php
    							foreach($sub_forums as $s_k=>$s_v)
    							{
    								display_forum_checkbox($s_v, $selected);
    							}
    							?>
    							</div>
    							<?php
    						}
    						else $sub_count=0;
    					   ?>
    					   </div>

    				<?php
    			}
            }

			$forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY title ASC' );
			$sub_count = 0;
			foreach($forums as $forum)
			{

				?>
				<div class="forum-item">
					<?php display_forum_checkbox($forum) ?>
				</div>
				<?php
			}
		?>

		<span class="clear"></span>

		<?php
}


function display_categories_option($name, $selected = 0, $other = '')
{
            $sub_count = 0;

			if(!function_exists('display_forum_checkbox'))
            {
				function display_forum($forum, $name, $selected)
				{
					global $sub_count;
					global $default_value;
					?>
					<option value="<?php echo $forum['id'] ?>" <?php check_select($name, $selected, $forum['id']) ?>><?php for($i=0;$i<$sub_count;$i++) echo '----'; echo $forum['title'] ?></option>
						  <?php

							$sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
							if(!empty($sub_forums))
							{
								$sub_count++;
								foreach($sub_forums as $s_k=>$s_v)
								{
									display_forum($s_v, $name, $selected);
									if($s_k == (count($sub_forums) - 1)) $sub_count--;
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
			}

            ?>
            <select <?php echo $other ?> name="<?php echo $name ?>">
            <option value="0" <?php check_select($name, $selected, '0') ?>>None</option>

            <?php
                $forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY stt ASC');

                foreach($forums as $forum)
                {
                    display_forum($forum, $name, $selected);
                }
            ?>


            </select>
	<?php
}

$sub_count = 0;
if(!function_exists('display_select_tag'))
{
    function display_select_tag($forum)
    {
        global $sub_count;
        global $default_value;
        global $temp_post_type;
        echo $forum['name'];

        ?>
        <option value="<?php echo $forum['id'] ?>" <?php if($forum['title'] == $forum['id']) echo ' selected '; ?>><?php for($i=0;$i<$sub_count;$i++) echo '----'; echo $forum['title'] ?></option>
              <?php

                $sub_forums = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
                if(!empty($sub_forums))
                {
                    $sub_count++;
                    foreach($sub_forums as $s_k=>$s_v)
                    {
                        display_select_tag($s_v);
                        if($s_k == (count($sub_forums) - 1)) $sub_count--;
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
}

function display_cart()
{
    global $g_user;
?>
<div id="wrap-popup-cart">
	<div id="popup-cart">
		<div id="cart-header">Giỏ hàng của bạn</div>

		<div id="cart-content">
			<div class="cart-col1 v-tx-none v-xs-none ">
        <div class="cartGroup1 cartGroup">

          <?php
          $allPrice = 0;
         $total_price = 0;

          				if(isset($_COOKIE['cart']))
          				{
          					$lists = json_decode($_COOKIE['cart'], TRUE);
          					if(empty($lists)) $have_product = FALSE;
          					else $have_product = TRUE;
          				}
          				else {
                    $have_product = FALSE;
                    $lists = array();
                  }

                    if(count($lists) > 0) {
                        foreach($lists as $k=>$v)
    					{
    						$post = get_post($k);
    						$total_price = $total_price +  $v['price'] * $v['num'];
                        }
                    }
          ?>
				<div class="cart-content-title"><span>Sản phẩm đã chọn</span>
          <span class="titlePrice">
              <?php echo num_to_price($total_price) ?> vnđ
          </span></div>
				<span class="clear"></span>
				<div id="cart-detail">
				<?php



$total_price = 0;

				if($have_product)
				{

					foreach($lists as $k=>$v)
					{

						$post = get_post($k);
						$total_price = $total_price +  $v['price'] * $v['num'];

            if(empty($post['image'])) $post['image'] =  SITE_URL . '/inc/images/noimage.png';

						if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200';
						else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=300&h=200';

						?>
						<div class="cart-item" id="cart-item-<?php echo $k ?>">
							<a href="<?php echo SITE_URL , '/' , $post['url'],'/' ?>" class="cart-product-name"><?php echo $post['title'] ?></a>
							<span class="clear"></span>
							<div class="fl cart-item-image">
								<img src="<?php echo $image ?>" />
							</div>
							<div class="fl cart-item-info">
								<p class="cart-price">Đơn giá : <span><?php echo num_to_price($v['price']) ?></span> <strong>vnđ</strong></p>
								<p class="cart-num">Số lượng : <span class="desc-num" particular="<?php echo $k ?>">-</span> <input type="number" class="cart-item-num" value="<?php echo $v['num'] ?>" /> <span class="asc-num"  particular="<?php echo $k ?>">+</span></p>
								<div class="cart-item-action">
									<p class="delete-cart-item"  particular="<?php echo $k ?>">Xóa</p>
									<p class="update-cart-item"  particular="<?php echo $k ?>">Cập nhật</p>
								</div>
							</div>
							<span class="clear"></span>
						</div>
						<?php
					}


					?>

					<?php
				}
				else
				{
					echo '<p class="empty-cart-noti">Bạn chưa có sản phẩm nào trong giỏ hàng</p>';
				}
				?>

        <?php
        $allPrice += $total_price;

        $total_price = 0;
        $lists = array();
          if(isset($_COOKIE['sb']))
          {
            $lists = json_decode($_COOKIE['sb'], TRUE);
            if(empty($lists)) $have_product = FALSE;
            else $have_product = TRUE;
          }
          else $have_product = FALSE;

          $total_price = 0;

          foreach($lists as $k=>$v)
					{
						$post = get_post($k);
						$total_price = $total_price +  $v['price'] * $v['num'];
          }

        ?>



				</div>
        </div>

        <div class="cartGroup cartGroup2">
				<div class="cart-content-title"><span>Combo đang chọn</span>
          <span class="titlePrice">
              <?php echo num_to_price($total_price) ?> vnđ
          </span>
        </div>
				<span class="clear"></span>
				<div id="cart-detail" class="listCombo">
				<?php
				$total_price = 0;





				if($have_product)
				{

					foreach($lists as $k=>$v)
					{

						$post = get_post($k);
						$total_price = $total_price +  $v['price'] * $v['num'];

            if(empty($post['image'])) $post['image'] =  SITE_URL . '/inc/images/noimage.png';

						if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=280&h=200';
						else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=280&h=200';

						?>
						<div class="cart-item" id="cart-item-<?php echo $k ?>">
							<a href="<?php echo SITE_URL , '/' , $post['url'] ?>" class="cart-product-name"><?php echo $post['title'] ?></a>
							<span class="clear"></span>
							<div class="fl cart-item-image">
								<img src="<?php echo $image ?>" />
							</div>
							<div class="fl cart-item-info">
								<p class="cart-price">Đơn giá : <span><?php echo num_to_price($v['price']) ?></span> <strong>vnđ</strong></p>
								<p class="cart-num">Số lượng : <span class="desc-num" particular="<?php echo $k ?>">-</span> <input type="number" disabled class="cart-item-num" value="<?php echo $v['num'] ?>" /> <span class="asc-num"  particular="<?php echo $k ?>">+</span></p>
								<div class="cart-item-action">
									<p class="delete-cart-item1"  particular="<?php echo $k ?>"> &nbsp;</p>
									<p class="update-cart-item1"  particular="<?php echo $k ?>">&nbsp;</p>
								</div>
							</div>
							<span class="clear"></span>
						</div>
						<?php
					}


					?>


					<?php
				}
				else
				{
					echo '<p class="empty-cart-noti">Bạn chưa có sản phẩm nào trong giỏ hàng</p>';
				}

        $allPrice += $total_price;
				?>



				</div>
        </div>
				<?php
					if($have_product)
					{
					?>

					<div id="empty-cart" class="none">Xóa toàn bộ giỏ hàng</div>
					<?php
					}

				?>

        <span class="clear"></span>
        <div id="total-price">
          Tổng : <span><?php echo num_to_price($allPrice) ?></span> vnđ

          <span class="removeCombo">Xoá Combo</span>
        </div>
			</div>


        			<div class="cart-col2 ">
        				<?php
        					if(1) //$have_product
        					{
        					?>

        				<div class="cart-content-title"><span>Đặt hàng</span></div>
                        <?php
                            if(USER_ID)
                            {
                                $user_info = $g_user;
                            }
                            else
                            {
                                $user_info = array(
                                    'display_name'      => '',
                                    'phone'             => '',
                                    'place'             => '',
                                    'email'             => ''
                                );
                            }

                        ?>
        				<form id="order-form">
        					<input type="text" id="order-name" class="text" placeholder="Họ tên → Bắt buộc" required value="<?php //if(!empty($g_user['display_name'])) echo $g_user['display_name'] ?>" />
        					<input type="text" id="order-phone"  class="text" placeholder="Điện thoại → Bắt buộc" required value="<?php //if(!empty($g_user['phone'])) echo $g_user['phone'] ?>" />
        					<input type="text" id="order-place"  class="text" placeholder="Địa chỉ → Bắt buộc" required value="<?php //if(!empty($g_user['place'])) echo $g_user['place'] ?>" />
        					<input type="email" id="order-email"  class="text" placeholder="Email" value="<?php //if(!empty($g_user['email'])) echo $g_user['email'] ?>" />
        					<textarea id="other_info" class="v-tx-none v-xs-none " placeholder="Thông tin thêm"></textarea>
        					<span class="clear"></span>
                            <div class="order-action">
        					   <input type="submit" class="submit" value="Gửi đơn hàng" id="submit-order" />
        					</div>
        				</form>


        				<?php
        					}

        				?>
        				<span class="clear"></span>
        			</div>

              <span class="clear"></span>
              <!--<div class="cartActions">-->
              <!--  <div class="cartAction">-->
              <!--    Tư vấn-->
              <!--  </div>-->
              <!--  <div class="cartAction">-->
              <!--    Báo giá-->
              <!--  </div>-->
              <!--  <div class="cartAction">-->
              <!--    Đặt lịch hẹn-->
              <!--  </div>-->
              <!--</div>-->

            <?php 
                if(isset($_COOKIE['cart']))
  				{
  				?>
  				<br/>
  				<div style="text-align: center;">
  					<a href='/thanh-toan/'  class="buy-product"  style="background: #fb6363;color: #fff;padding: 5px 25px;cursor: pointer;border-radius: 5px;font-size: 14px;">
                        <span>Đặt hàng</span>
                    </a>
                </div>              
  				<br/>
  				<?php    
  				}
  				?>
              
			<span class="clear"></span>
		</div>

		<img class="close-cart" src="<?php echo CDN_DOMAIN ?>/inc/images/close_cart.png" />
	</div>
</div>
<?php

}


function display_add_to_cart_button($product_id, $price,  $id = '', $class = '', $text = 'Đặt mua')
{
    ?>
	<div class="<?php echo $class ?> add-to-cart" <?php if(!empty($id)) echo 'id="' . $id .'"' ?> price="<?php echo $price ?>" particular="<?php echo $product_id ?>"><?php echo $text ?></div>
	<?php
}
function display_view_cart_button($id='', $class='', $text = 'Xem giỏ hàng')
{
    ?>
	<div class="<?php echo $class ?> view-cart" <?php if(!empty($id)) echo 'id="' . $id .'"' ?>><?php echo $text ?></div>
	<?php
}

function display_bread_crumb($type, $id = 1, $home = TRUE, $this=FALSE, $arrow = '›')
{
	$bread_crumbs = get_breadcrumb_items($type, $id, $home, $this);
    $count = count($bread_crumbs);
	?>
	<div class="hcv-bread-crumb">

	<?php
	foreach($bread_crumbs as $k=>$bread_crumb)
	{

		?>
		<?php if($k) : ?><span class="arrow"><?php echo $arrow; ?></span><?php endif; ?>
		<a class="bread-crumb-item <?php if($this && ($k==($count -1))) echo 'bread-crumb-last' ?>" href="<?php echo $bread_crumb['link'] ?>" title="<?php echo $bread_crumb['anchor'] ?>"><?php echo $bread_crumb['anchor'] ?></a>
		<?php
	}
	?>
	</div>
	<?php
}


function block_attribute($param)
{
    if(empty($param['block_title'])) $param['block_title'] = $param['block_id'];
	?>
	id="block-<?php echo $param['block_id'] ?>"  class="block-<?php echo $param['block_name'] ?> core-block"  <?php if(USER_PERMISSION == 'admin'): ?> block_id="<?php echo $param['block_id'] ?>" block_name="<?php echo $param['block_name'] ?>" block_title="<?php echo $param['block_title'] ?>" <?php endif; ?>
	<?php
}

function comment_form($post_id, $param = array('name_label'=>'Họ tên&nbsp;&nbsp;<span class="require">&#40; * &#41;</span>', 'content_label'=>'Nội dung&nbsp;&nbsp;<span class="require">&#40; * &#41;</span>', 'email_label'=>'Email&nbsp;&nbsp;'))
{
	global $g_user;

	$comment_user_name = '';
	$comment_user_email = '';

	if(isset($_COOKIE['comment_name'])) $comment_user_name =  $_COOKIE['comment_name'];
	if($g_user['id']) $comment_user_name =  $g_user['user_name'];

	if(isset($_COOKIE['comment_email'])) $comment_user_email =  $_COOKIE['comment_email'];
	if($g_user['id']) $comment_user_email =  $g_user['email'];

    if(isset($_COOKIE['comment_phone'])) $comment_user_phone =  $_COOKIE['comment_phone'];
	if($g_user['id']) $comment_user_phone =  $g_user['phone'];

    ?>
	<script  defer  src="<?php echo CDN_DOMAIN ?>/inc/js/comment.js"></script>
	<form class="auto-comment-form" method="POST" post_id="<?php echo $post_id ?>" action="" id="auto-comment-form-<?php echo $post_id ?>">
		<div class="comment-form-item comment-form-item-content clearfix ">
			<label for="comment-field-content"><?php echo $param['content_label'] ?></label>
			<textarea placeholder="Nội dung" class="text" id="comment-field-content" name="comment-field-content" required="required"></textarea>
		</div>

        <?php if($g_user['id']) : ?>

		<div style="display:block">
		<?php endif; ?>
			<div class="comment-form-item comment-form-item-name clearfix">
				<label for="comment-field-name"><?php echo $param['name_label'] ?></label>
				<input placeholder="Họ tên" class="text" required="required" name="comment-field-name" type="text" id="comment-field-name" value="<?php echo $comment_user_name; ?>" />
			</div>

			<div class="comment-form-item comment-form-item-email clearfix">
				<label for="comment-field-email"><?php echo $param['email_label'] ?></label>
				<input placeholder="Email" class="text"  name="comment-field-email" type="email" id="comment-field-email" value="<?php echo $comment_user_email ?>" />
			</div>
            <div class="comment-form-item comment-form-item-phone clearfix">
				<label for="comment-field-phone">Số điện thoại</label>
				<input placeholder="Số điện thoại" class="text"  name="comment-field-phone" type="text" id="comment-field-phone" value="<?php echo $comment_user_phone ?>" />
			</div>
		<?php if($g_user['id']) : ?>
		</div>
		<?php endif; ?>

		<div class="comment-form-item comment-form-item-submit clearfix">
			<input class="submit"  name="comment-field-submit" type="submit" id="comment-field-submit" value="Gửi bình luận" />
		</div>
		<span class="clear"></span>
	</form>

	<form style="display:none" class="reply-auto-comment-form" method="POST" post_id="<?php echo $post_id ?>" action="" id="reply-auto-comment-form-<?php echo $post_id ?>">
		<div class="comment-form-item comment-form-item-content clearfix">
			<label for="reply-comment-field-content"><?php echo $param['content_label'] ?></label>
			<textarea placeholder="Nội dung"  id="reply-comment-field-content" class="text" name="reply-comment-field-content" required="required"></textarea>
		</div>
        <div class="comment-form-item comment-form-item-name">
			<label for="reply-comment-field-name"><?php echo $param['name_label'] ?></label>
			<input class="text" placeholder="Họ tên" required="required" name="reply-comment-field-name" type="text" id="reply-comment-field-name" value="<?php echo $comment_user_name; ?>" />
		</div>

		<div class="comment-form-item  comment-form-item-email clearfix">
			<label for="reply-comment-field-email"><?php echo $param['email_label'] ?></label>
			<input class="text" placeholder="Email"  name="reply-comment-field-email" type="email" id="reply-comment-field-email" value="<?php echo $comment_user_email; ?>" />
		</div>
		<div class="comment-form-item comment-form-item-phone clearfix">
				<label for="comment-field-phone">Số điện thoại</label>
				<input placeholder="Số điện thoại" class="text"  name="comment-field-phone" type="text" id="comment-field-phone" value="<?php echo $comment_user_phone ?>" />
			</div>

		<div class="comment-form-item comment-form-item-submit clearfix">
			<input class="submit"  name="comment-field-submit" type="submit" id="comment-field-submit" value="Submit" />
		</div>
		<span class="clear"></span>

		<span class="close-comment-form">x</span>
	</form>

	<?php
}

$sub_count = 0;
if(!function_exists('display_comment_item'))
{
	function display_comment_item($comment, $post_id, $g_user_id, $admin = false,$param = array('depth'=>2))
	{


		global $sub_count;
		global $g_tpl_url;
		if($comment['user_id']) $comment_user = get_user($comment['user_id'], ' id, user_name, image, permission ');
		else $comment_user = array(
			'id'		=> 0,
			'image'		=> CDN_DOMAIN . '/inc/images/default-guest-avatar.png',
			'user_name' => $comment['name'],
			'permission'=> 'guest'
		);

		$real_sub = min($param['depth']-1, $sub_count);

		include PATH_ROOT . '/inc/other_file/comment-item.php';

		?>


		<span class="clear"></span>
		  <?php

			$sub_forums = models_DB::get('SELECT * FROM ' . COMMENT_TABLE . ' WHERE parent=' . $comment['id']);
			if(!empty($sub_forums))
			{
				$sub_count++;
				foreach($sub_forums as $s_k=>$s_v)
				{
					display_comment_item($s_v, $post_id, $g_user_id, $admin);
					if($s_k == (count($sub_forums) - 1)) $sub_count--;
				}
				?>

				<?php
			}
	}
}

function display_comment($post_id, $param = array('depth'=>2))
{
	global $g_user;

	?>
	<div class="core-list-comment" id="core-list-comment-<?php echo $post_id ?>">

	<?php
	$list_reply = models_DB::get('SELECT * FROM ' . COMMENT_TABLE . ' WHERE parent=0 AND post_id='.$post_id);


	if($g_user['permission'] == 'admin') $admin = TRUE; else $admin = false;

	foreach($list_reply as $k=>$v)
	{
		display_comment_item($v, $post_id, $g_user['id'], $admin, $param);
	}

	?>
	</div>
	<?php
}

function display_star_rating($param)
{
    global $g_page_info;
    if(empty($param['page_type'])) $param['page_type'] = 'post';
    ?>

    <?php
}

function display_notification($param)
{
	$content = json_decode($param['content'], TRUE);



	switch($content['type'])
	{
		case 'user_comment_post' :
		{
			$post_info = get_post($content['post_id'], 'id, url, title');
			$link  = hcv_url('p', $post_info['url'], $post_info['id'], FALSE). '#comment-'.$content['comment_id'];
			?>
			<div class="noti-item" href="<?php echo $link ?>" style="display:block">
				<div class="noti-title">
					<span class="bold"><?php echo $content['name'] ?></span> đã bình luận về bài viết <a href="<?php echo $link ?>"><?php echo $post_info['title'] ?></a>
				</div>
				<div class="noti-des">
					<?php echo $content['excerpt'] ?> ...
				</div>

				<div class="noti-readmore">
					<a href="<?php echo $link ?>">Xem chi tiết</a>
					<span class="delete-noti" noti_id="<?php echo $param['id'] ?>" title="Xóa thông báo này">Xóa</span>
				</div>

			</div>
			<?php
		}
		break;

		case 'user_order' :
		{

			$link  = SITE_URL . '/admin/?page_type=order-detail&order_id='.$content['order_id'];
			?>
			<div class="noti-item" href="<?php echo $link ?>" style="display:block">
				<div class="noti-title">
					<span class="bold"><?php echo $content['name'] ?></span> đã đặt hàng
				</div>
				 <div class="noti-des">
					  ...
				</div>

				<div class="noti-readmore">
					<a href="<?php echo $link ?>">Xem chi tiết</a>
					<span class="delete-noti" noti_id="<?php echo $param['id'] ?>" title="Xóa thông báo này">Xóa</span>
				</div>

			</div>
			<?php
		}
		break;

        case 'order' :
		{

			$link  = SITE_URL . '/admin/?page_type=list-order-detail&order_id=' . $content['order_id'];
			?>
			<div class="noti-item" href="<?php echo $link ?>" style="display:block">
				<div class="noti-title">
		          Form <span class="bold"><?php echo $content['name'] ?></span> được gửi
				</div>
				 <div class="noti-des">
					  ...
				</div>

				<div class="noti-readmore">
					<a href="<?php echo $link ?>">Xem chi tiết</a>
					<span class="delete-noti" noti_id="<?php echo $param['id'] ?>" title="Xóa thông báo này">Xóa</span>
				</div>

			</div>
			<?php
		}
		break;


	}
}

function display_meta($param)
{
    global $g_page_info;

    $return = '';
    if(empty($param['type'])) $param['type'] = $g_page_info['page_type'];
    if(empty($param['id'])) $param['id'] = $g_page_info['page_id'];
    if(empty($param['field_type'])) $param['field_type'] = 'text';
    if(empty($param['echo'])) $param['echo'] = TRUE;

    if( !empty($param['default']) )
    {

    }
    else
    {
        switch($param['type'])
        {
            case 'post' :
            {
                $info = get_post($param['id'], $param['field']);
            }
            break;

            case 'category' :
            {
                $info = get_category($param['id'], $param['field']);
            }
            break;

            case 'tag' :
            {
                $info = get_tag($param['id'], $param['field']);
            }
            break;
        }
        $param['default'] = $info[$param['field']];
    }
    if(USER_ID)
    {
        $return = '<' . $param['wrap'] . ' title="Sửa" class="core-edit-meta" type="' . $param['type'] . '" field="' . $param['field'] . '" the_id="' . $param['id'] . '"  field_type="' . $param['field_type'] . '"  >' . $param['default'] . '</' . $param['wrap'] . '>';
    }
    else $return = '<' . $param['wrap'] . '>' . $param['default'] . '</' . $param['wrap'] . '>';
    if( $param['echo'] ) echo $return;
    return $return;

}

function display_edit_option_icon($name, $type = 'text')
{
    if(!isset($_COOKIE['design'])) return;

    $a = get_option($name);


    if( $a === FALSE )
    {
        $insert_content = array(
            'name'          => pretty_string( $name, '_' ),
            'value'         => '',
            'is_default'    => 0,
            'attributes'    => json_encode( array ( 'title' => pretty_string( $name, '_' ), 'type' => $type, 'maxlenght' => 99999 ) ),
            'display'       => 0
        );

        models_DB::insert($insert_content, OPTION_TABLE);
    }
    else
    {
        $b = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE name=\'' . $name . '\'');

        $attr = json_decode($b[0]['attributes'], TRUE);

        if($attr['type'] != $type)
        {
            $insert_content = array(
                'attributes'    => json_encode( array ( 'title' => pretty_string( $name, '_' ), 'type' => $type, 'maxlenght' => 99999 ) )
            );
            models_DB::update($insert_content, OPTION_TABLE, ' WHERE name=\'' . $name . '\' ');
        }
    }
    ?>
        <span class="core-edit-option-icon" par="<?php echo $name ?>">

        </span>
    <?php
}

function display_form($param)
{

    $id = $param['id'];
    if(empty($param['submit_text'])) $param['submit_text'] = 'Gửi';
    $form_info = get_form($id);
    //h($form_info)
    if(empty($form_info)) return;
    $fields = get_forms( array('field_form'=>$id, 'order'=> ' ORDER BY field_stt ASC ', 'the_type'=>'field') );

    ?>

    <div class="wrap-v-form">
            <div class="v-form-title"><?php echo $form_info['name']; ?></div>
            <div class="v-form-description"><?php echo $form_info['other1']; ?></div>

            <div class="v-form-content clearfix">
                <?php
                    if(empty($param['form_element_name'])) $param['form_element_name'] = 'form';
                ?>
                <<?php echo $param['form_element_name'] ?> class="v-form" method="POST" par="<?php echo $id ?>">
                <input type="hidden" name="form_id" value="<?php echo $id ?>" />
                <input type="hidden" name="type" value="order" />
                <input type="hidden" name="url" value="<?php echo CURRENT_URL ?>" />
                <?php
                    foreach($fields as $field)
                    {
                        //h($field);
                        $field_attribute = json_decode($field['field_attribute'], TRUE);


                        ?>
                        <div class="v-form-item v-form-item-<?php echo $field['field_slug'] ?> v-form-item-<?php echo $field['field_type'] ?>" >
                            <div class="v-form-item-title"><?php echo $field['field_name'] ?> <span class="v-form-require"><?php if( !empty($field_attribute['require']) ) echo ' * ' ?></span></div>

                            <div class="v-form-item-content">
                                <?php
                                switch($field['field_type'])
                                {
                                    case 'text' :
                                    {
                                        ?>
                                        <input type="text" <?php if($field_attribute['require']) echo ' required ' ?> class="v-form-field-type-<?php echo $field['field_type'] ?> form-text" placeholder="<?php echo $field['field_name'] ?>" value="" name="<?php echo $field['field_slug'] ?>" />
                                        <?php
                                        break;
                                    }
                                     case 'number' :
                                    {
                                        ?>
                                        <input type="number" <?php if($field_attribute['require']) echo ' required ' ?> class="v-form-field-type-<?php echo $field['field_type'] ?> form-text" placeholder="<?php echo $field['field_name'] ?>" value="" name="<?php echo $field['field_slug'] ?>" />
                                        <?php
                                        break;
                                    }
                                    case 'textarea' :
                                    {
                                        ?>
                                        <textarea <?php if($field_attribute['require']) echo ' required ' ?>  class="v-form-field-type-<?php echo $field['field_type'] ?> form-textarea" name="<?php echo $field['field_slug'] ?>" placeholder="<?php echo $field['field_name'] ?>"></textarea>
                                        <?php
                                        break;
                                    }
                                    case 'select' :
                                    {
                                        ?>
                                        <select class="v-form-field-type-<?php echo $field['field_type'] ?>  form-select" name="<?php echo $field['field_slug'] ?>">
                                             <?php
                                                $temp_value_display = json_decode($field_attribute['value_display'], TRUE);
                                                $temp_value = json_decode($field_attribute['value'], TRUE);
                                                foreach($temp_value_display as $tem_k=>$temp_v)
                                                {
                                                    ?>
                                                    <option <?php if($field_attribute['default'] == $temp_value[$tem_k]) echo 'selected ' ?> value="<?php echo $temp_value[$tem_k] ?>"><?php echo $temp_v ?></option>
                                                    <?php
                                                }
                                             ?>
                                        </select>
                                        <?php
                                        break;
                                    }

                                    case 'checkbox' :
                                    {
                                        $temp_value_display = json_decode($field_attribute['value_display'], TRUE);
                                        $temp_value = json_decode($field_attribute['value'], TRUE);
                                        foreach($temp_value_display as $tem_k=>$temp_v)
                                        {
                                            ?>
                                            <div class="v-form-field-type-<?php echo $field['field_type'] ?>-item" >
                                            <span> <?php echo $temp_v ?></span> &nbsp;<input type="checkbox" <?php if($field_attribute['require']) echo ' required ' ?> class="v-form-field-type-<?php echo $field['field_type'] ?> form-checkbox" placeholder="<?php echo $field['field_name'] ?>" value="<?php echo $temp_value[$tem_k] ?>" name="<?php echo $field['field_slug'] ?>" />

                                            </div>
                                            <?php
                                        }

                                        break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                        <div class="v-form-item v-form-item-submit">
                            <div class="v-form-item-title"><?php echo $form_info['field_name'] ?></div>
                            <div class="v-form-item-content">
                                <input name="v-submit" class="form-submit" type="submit" value="<?php echo $param['submit_text'] ?>" />
                            </div>
                        </div>
                    </<?php echo $param['form_element_name'] ?>>
            </div>

    </div>

    <script>
    <?php
        //include_once PATH_ROOT . '/inc/js/form.js';
    ?>
    </script>
    <?php
}

function display_block_setting_default($default)
{
    if(empty($default['block_sub_title'])) $default['block_sub_title'] = '';
    ?>
    <link    rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/inc/css/font-awesome-4.5.0/css/font-awesome.min.css" />
    <div class="block-default-parameter clearfix">
        <div class="form-group fl">
            <label class="" for="name">Tiêu đề</label>
            <input id="title-parameter" class="form-control" type="text" value="<?php echo $default['title'] ?>" /><i class="show-sub-title fa fa-angle-down"></i><br />

            <div class="wrap-subtitle">
                <label class="" for="name">Miêu tả tiêu đề</label>
                <div class="inline-block wrap-tinymce-textarea">
                    <div class="tinymce-textarea-type"><i class="fa fa-code text-mode"></i><i class="fa fa-file-text-o html-mode"></i></div>
                    <textarea id="block_sub_title" class="block_sub_title form-control parameter tinymce-textarea" parameter="block_sub_title"><?php echo $default['block_sub_title'] ?></textarea>
                </div>
            </div>

        </div>

        <div class="form-group fr">
            <label class="" for="name">Link tiêu đề</label>

            <input id="title-link-parameter" class="form-control" type="text" value="<?php echo $default['title_link'] ?>" />
        </div>
    </div>
    <?php
}

function display_extension_by_position($pos)
{

    $lists = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE display_position=\'' . $pos . '\' AND is_actived=1' );

    foreach($lists as $k=>$list)
    {
        $extension_info = get_extension_by_id($list['id']); // Info của 1 hàng
        if(file_exists(PATH_ROOT . '/extensions/' . $list['name'] . '/display-' . $pos . '.php'))
        {
            include PATH_ROOT . '/extensions/' . $list['name'] . '/display-' . $pos . '.php';
        }
        else
        {
            include PATH_ROOT . '/extensions/' . $list['name'] . '/display.php';
        }

    }

}

function display_cdn_js($js)
{
    ?>
    <script><?php include PATH_ROOT . '/' . $js ?></script>
    <?php
}

function tinymce_setting()
{
    if(defined('CHECK_CONS_TINYMCE_SETTING'))
    {
        return;
    }
    define('CHECK_CONS_TINYMCE_SETTING', 1);

    ?>
    <script    lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/tinymce/js/tinymce/jquery.tinymce.min.js?v=' . FRONT_END_VERSION ?>"></script>
    <script    lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/tinymce/js/tinymce/tinymce.min.js?v=' . FRONT_END_VERSION ?>"></script>


    <script>
    tinymce.init({
        entity_encoding : "raw",
    	convert_urls: false,
        verify_html: true,
        selector: ".main-content",
        content_css : "<?php echo CDN_DOMAIN ?>/inc/css/tinymce.css?v=<?php echo FRONT_END_VERSION ?>",
        script_url: "<?php echo CDN_DOMAIN ?>/inc/js/tinymce.js?v=<?php echo FRONT_END_VERSION ?>",
        fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 24px 28px 36px",
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });



            /*
            editor.onInit.add(function(editor, evt) {
                // Load a script from a specific URL using the global script loader
                tinymce.ScriptLoader.load("<?php echo CDN_DOMAIN ?>/inc/js/tinymce.js?v=<?php echo FRONT_END_VERSION ?>",);

                // Load a script using a unique instance of the script loader
                var scriptLoader = new tinymce.dom.ScriptLoader();

                scriptLoader.load("<?php echo CDN_DOMAIN ?>/inc/js/tinymce.js?v=<?php echo FRONT_END_VERSION ?>");

            });
            */
        },



        skin:"custom",
        //extended_valid_elements : '*[*]',
        extended_valid_elements : 'style[type|media|href|rel|id],svg[id|width|height|style|version|class|xmlns|xmlns:xlink|x|y|viewBox|xml:space],image[id|width|height|style|version|class|xmlns|xmlns:xlink|x|y|viewBox|xml:space|src],polygon[points|class|id|data-src|stt|style]',
        valid_elements : '*[*]',
        valid_children : "+body[style]",
        plugins: [
            "advlist autolink lists link charmap print preview anchor textcolor ",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu wordcount hcv_upload hcv_youtube  hcv_other_post hcv_image_map hcv_form"
        ],
        menu : { // this is the complete default configuration
            ///file   : {title : 'File'  , items : 'newdocument'},
            //edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
            //insert : {title : 'Insert', items : 'link media | template hr'},
            //view   : {title : 'View'  , items : 'visualaid'},
            format : {title : 'Format', items : 'strikethrough superscript subscript | removeformat'},
            table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
            tools  : {title : 'Tools' , items : 'spellchecker'}
        },
        toolbar: "fontselect  fontsizeselect | forecolor backcolor | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link unlink | hcv_upload | hcv_youtube | hcv_other_post  | hcv_form | code fullscreen"
    });
    </script>
    <?php
    return;
    ?>
    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/inc/js/tinymce.js?v=' . FRONT_END_VERSION ?>"></script>
    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/inc/js/tinymce-block.js?v=' . FRONT_END_VERSION ?>"></script>
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN . '/inc/css/tinymce.css?v=' . FRONT_END_VERSION ?>" />
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN . '/inc/css/block.css?v=' . FRONT_END_VERSION ?>" />

    <?php
}

function display_carousel_cdn(){
    if(defined('CHECK_CONS_CAROUSEL_DISPLAY'))
    {
        return;
    }
    define('CHECK_CONS_CAROUSEL_DISPLAY', 1);

    if(0)
    {
        ?>
        <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/css/owl.carousel.css" />
        <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/css/owl.theme.css" />
        <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/css/owl.transitions.css" />
        <script   type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/js/owl.carousel.min.js"></script>
        <script   type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/js/owl.autoplay.js"></script>
        <?php
        return;
    }
    else
    {
    ?>
        <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css" />
        <link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css" />
        <!-- <script   type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script> -->
        <script   type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/SlideCarousel/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
        <?php
    }
}

function display_flex_cdn(){
    if(defined('CHECK_CONS_FLEX_DISPLAY'))
    {
        return;
    }
    define('CHECK_CONS_FLEX_DISPLAY', 1);
    ?>
    <link   rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/blocks/Slide/ListSlide/Flex/demo/css/flexslider.css" type="text/css" media="screen" />
    <!--<script     src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.4/jquery.flexslider.min.js"></script> -->
    <script     src="<?php echo CDN_DOMAIN ?>/blocks/Slide/ListSlide/Flex/demo/js/jquery.flexslider.js"></script>
    <!--<script     src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.4/jquery.flexslider.min.js"></script> -->
   
    <?php
}

function display_wowjs_cdn(){
    if(defined('CHECK_CONS_WOW_DISPLAY'))
    {
        return;
    }
    define('CHECK_CONS_WOW_DISPLAY', 1);
    ?>
    <link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/WOWJS/WOW-master/css/libs/animate.css" />
    <script   type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!-- <script   type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/WOWJS/WOW-master/dist/wow.min.js"></script> -->
    <?php
}


function display_dir_content($dir){
    global $exclude_extensions;
    global $exclude_folders;

    $list_dirs = v_scandir_width_sort($dir, 'number');
    unset($list_dirs[0], $list_dirs[1]);

    foreach($list_dirs as $k=>$list_dir)
    {
        $current_dir = $dir . '/' . $list_dir;

        if( is_file( $current_dir ) )
        {
            $path_info = pathinfo($current_dir);

            //echo $path_info['extension'];
            if(empty($path_info['extension'])) continue;
            if( in_array($path_info['extension'], $exclude_extensions) ) continue;
        }
        else
        {
            if(in_array($list_dir, $exclude_folders)) continue;
        }

        if(!is_dir($current_dir)) $image_size = @getimagesize($current_dir);
        else $image_size = 0;


        ?>
        <div class="wrap-file-item">
            <div class="clearfix file-item file-item-<?php echo '' ?> <?php if( is_file( $current_dir ) ) echo 'type-file';else echo 'type-dir' ?>">
                <a class="fl load-dir" real_dir=<?php echo $current_dir ?> dir_name="<?php echo $list_dir ?>" dir="<?php echo urlencode(  $current_dir) ?>" href="<?php echo SITE_URL ?>/admin/?page_type=editor&dir=<?php echo urlencode(  $current_dir) ?>">
                <?php
                    if(!empty($image_size))
                    {
                        $t_image_current_dir = $current_dir;
                        $t_image_current_dir = str_replace('/home/zland/web/', '', $t_image_current_dir);
                        $t_image_current_dir = str_replace('public_html/', '', $t_image_current_dir);


                        for($i=1;$i<=20;$i++)
                        {
                            $t_image_current_dir = str_replace('/home/zland' . $i . '/web/', '', $t_image_current_dir);
                        }

                        $t_image_current_dir = 'http://' . $t_image_current_dir;

                        ?>
                        <img class="image-thumb" src="<?php echo cdn_timthumb_url(str_replace(PATH_ROOT, CDN_DOMAIN, $t_image_current_dir ), 15, 15) ?>" />
                        <?php
                    }
                    else
                    {
                        if( is_file( $current_dir ) )
                        {
                            ?>
                            <i class="fa fa-file-code-o" aria-hidden="true"></i>
                            <?php
                         }
                        else
                        {
                            ?>
                            <i class="fa fa-folder-o" aria-hidden="true"></i>
                            <?php
                        }
                    }

                    ?>


                <?php echo $list_dir ?>
                </a>
                <?php
                    if( !is_file( $current_dir ) )
                    {
                        ?>
                        <div class="fr none folder-action">
                            <i class="new-dir fa fa-folder-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="new-file fa fa-file-code-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="new-upload fa fa-cloud-upload" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <i class="delete-dir fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                            <?php
                                if(is_numeric($list_dir))
                                {
                                    ?>
                                    <a href="<?php echo DEMO_URL, '/', $list_dir ?>" target="_blank">
                                        <i class="view-demo fa fa-eye"></i>
                                    </a>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="fr none folder-action">
                            <i class="delete-file fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        </div>
                        <?php
                    }
                ?>

            </div>
        </div>
        <?php
    }
}

function display_editor_file_item($current_dir,$list_dir )
{
    global $exclude_extensions;
    global $exclude_folders;
    if( is_file( $current_dir ) )
    {
        $path_info = pathinfo($current_dir);

        //echo $path_info['extension'];
        if( in_array($path_info['extension'], $exclude_extensions) ) continue;
    }
    else
    {
        if(in_array($current_dir, $exclude_folders)) continue;
    }



    ?>
    <div class="wrap-file-item">
        <div class="clearfix file-item file-item-<?php echo '' ?> <?php if( is_file( $current_dir ) ) echo 'type-file';else echo 'type-dir' ?>">
            <a class="fl" dir_name="<?php echo $list_dir ?>" dir="<?php echo urlencode(  $current_dir) ?>" href="<?php echo SITE_URL ?>/admin/?page_type=editor&dir=<?php echo urlencode(  $current_dir) ?>">
            <?php
                if( is_file( $current_dir ) )
                {
                    ?>
                    <i class="fa fa-file-code-o" aria-hidden="true"></i>
                    <?php
                 }
                else
                {
                    ?>
                    <i class="fa fa-folder-o" aria-hidden="true"></i>
                    <?php
                }  ?>


            <?php echo $list_dir ?>
            </a>
            <?php
                if( !is_file( $current_dir ) )
                {
                    ?>
                    <div class="fr none folder-action">
                        <i class="new-dir fa fa-folder-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        <i class="new-file fa fa-file-code-o" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        <i class="new-upload fa fa-cloud-upload" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                        <i class="delete-dir fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="fr none folder-action">
                        <i class="delete-file fa fa-close" dir="<?php echo urlencode(  $current_dir) ?>"></i>
                    </div>
                    <?php
                }
            ?>

        </div>
    </div>
    <?php

}

function display_log_form()
{
    if(USER_ID) return;
    ?>

    <div class="v-wrap-log-form none">
        <div class="v-log-form-opacity"></div>

        <div class="v-log-form">
            <div class="close-log-form"><i class="fa fa-close"></i></div>
            <div class="v-log-form-nav clearfix">
                <div class="v-log-form-nav-item v-log-form-nav-item-login" par="login">
                    Đăng nhập
                </div>
                <div class="v-log-form-nav-item v-log-form-nav-item-register" par="register">
                    Đăng ký
                </div>
            </div>
            <div class="v-log-form-content clearfix">

                <form class="form-login form-log"  action="" method="POST">
                    <div class="log-warning"></div>
                    <input type="hidden" value="login" name="type" />
                    <div class="form-login-fields">
                         <div class="v-input-item">
                            <label class="none">Email hoặc số Điện thoại</label>
                            <input required="" name="emai_phone" type="text" class="text" placeholder="Email hoặc số Điện thoại" value="" />
                        </div>
                        <div class="v-input-item">
                            <label class="none">Mật khẩu</label>
                            <input required="" name="password" type="password" class="text" placeholder="Mật khẩu" value="" />
                        </div>

                        <div class="v-input-item">
                            <input  name="submit" type="submit" class="submit"   value="Đăng nhập" />
                        </div>
                    </div>
                </form>
                <form class="form-register form-log" action="" method="POST">
                    <div class="log-warning"></div>
                    <input type="hidden" value="register" name="type" />
                    <div class="v-input-item">
                        <label class="none">Email</label>
                        <input required="" name="email" type="text" class="text" placeholder="Email" value="" />
                        <div  class="input-guider none">( Chúng tôi sẽ gửi mã xác nhận tài khoản tới email bạn cung cấp )</div>
                    </div>

                    <div class="v-input-item">
                        <label class="none">Mật khẩu</label>
                        <input required="" name="password" type="password" class="text" placeholder="Mật khẩu" value="" />
                    </div>

                    <div class="v-input-item">
                        <label class="none">Nhập lại mật khẩu</label>
                        <input required="" name="r_password" type="password" class="text" placeholder="Nhập lại mật khẩu" value="" />
                    </div>

                    <div class="v-input-item text">
                        <label class="none">Họ và tên</label>
                        <input required="" name="display_name" type="text" class="text" placeholder="Họ và tên" value="" />
                    </div>

                    <div class="v-input-item">
                        <label class="none">Số điện thoại</label>
                        <input required="" name="phone" type="text" class="text" placeholder="Số điện thoại" value="" />
                    </div>
                    <div class="v-input-item">
                        <label class="none">Địa chỉ</label>
                        <input required="" name="place" type="text" class="text" placeholder="Địa chỉ" value="" />
                    </div>
                     <div class="v-input-item">
                        <input name="submit" type="submit" class="submit"   value="Đăng ký" />
                    </div>
                </form>




                    <div class="social-login">
                        <div class="social-login-title">Hoặc đăng nhập bằng</div>
                        <div class="social-login-inner clearfix">
                            <a class="social-login-item social-login-item-fb" href="<?php echo BUS_URL ?>/inc/?page_type=facebook-signin&domain=<?php echo urlencode(SITE_URL) ?>">
                                <i class="fa fa-facebook"></i>
                                Facebook
                            </a>
                            <a class="social-login-item social-login-item-gg" href="<?php echo BUS_URL ?>/inc/?page_type=google-signin&domain=<?php echo urlencode(SITE_URL) ?>">
                                <i class="fa fa-google"></i>
                                Google
                            </a>
                        </div>
                    </div>


                <form class="form-forgot-password">
                    <input type="hidden" value="forgot-password" name="type" />
                    <div class="forgot-password-text"><i class="fa fa-key"></i> Quên mật khẩu</div>
                    <div class="none forgot-password-text-content">
                        <h3 class="none">Quên mật khẩu</h3>
                        <div>
                            <input  name="email_to_reset" required="" type="email" class="text" placeholder="Email" value="" />
                            <input name="submit" type="submit" class="submit"   value="Gửi" />
                        </div>
                        <div class="none forgot-password-noti"></div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <?php
}

function display_post_content($post_id){
    global $post_info;
    ?>
    <div id="post-content">
        <div id="post-content-before">
            <?php views_BlockArea::display_area('post-content-before-' . $post_info['id']); ?>
        </div>
        <span class="clear"></span>
        <div id="post-content-inner">
        <?php
            echo $post_info['content'];
        ?>
        </div>
        <span class="clear"></span>
        <div id="post-content-after">
            <?php views_BlockArea::display_area('post-content-after-' . $post_info['id']); ?>
        </div>
    </div>
    <?php
}

function cdn()
{
    ?>
    <!-- ihover-gh-pages Hover Effect -->
    <link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/ihover-gh-pages/src/ihover.min.css?v=<?php echo FRONT_END_VERSION ?>" />

    <!-- Hover Effect -->
    <link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/hover-effect/css/hover-effect.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script defer src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/hover-effect/js/hover-effect.js?v=<?php echo FRONT_END_VERSION ?>"></script>

    <!-- Pagination Style -->
    <link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/pagination-style/css/pagination-style.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script defer src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/pagination-style/js/pagination-style.js?v=<?php echo FRONT_END_VERSION ?>"></script>

    <!-- Search Form Style -->
    <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/search-form-style/css/search-form-style.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script  defer src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/search-form-style/js/search-form-style.js?v=<?php echo FRONT_END_VERSION ?>"></script>

    <!-- Box Style -->
    <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/box/css/box.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script  defer src="<?php echo CDN_DOMAIN ?>/tpl/tpl/box/js/box.js?v=<?php echo FRONT_END_VERSION ?>"></script>

    <!-- Header Style -->
    <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/header/css/header.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script  defer src="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/header/js/header.js?v=<?php echo FRONT_END_VERSION ?>"></script>

    <!-- Footer Style -->
    <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/footer/css/footer.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script  defer src="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/footer/js/footer.js?v=<?php echo FRONT_END_VERSION ?>"></script>

    <!-- Block title Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/inc/css/block-title.css?v=<?php echo FRONT_END_VERSION ?>" />

    <!-- List Style -->
    <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/list-style/css/list-style.css?v=<?php echo FRONT_END_VERSION ?>" />
    <script  defer src="<?php echo CDN_DOMAIN ?>/tpl/tpl/cdn/list-style/js/list-style.js?v=<?php echo FRONT_END_VERSION ?>"></script>

    <?php
}


function search_form()
{
    if(!defined('CHECK_CONS_SEARCH_FORM'))
    {
        ?>
        <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/search-form.css?v=<?php echo FRONT_END_VERSION ?>" />
        <script  defer src="<?php echo CDN_DOMAIN ?>/inc/js/search-form.js?v=<?php echo FRONT_END_VERSION ?>"></script>
        <?php
    }
    else define('CHECK_CONS_SEARCH_FORM', 1);
    ?>
    <div class="v-search-form clearfix">
        <form class="clearfix" action="<?php echo SITE_URL ?>/search<?php echo URL_SUFFIX ?>">
            <input value="<?php if(isset($_GET['s'])) echo $_GET['s'] ?>" type="text" name="s" class="text" placeholder="Tìm kiếm" />
            <button type="submit" class="submit">Tìm kiếm</button>
            <div class="v-search-form-suggest"></div>
        </form>
    </div>
    <?php
}

function landing_menu($param = array())
{
    if(empty($param['margin_top'])) $param['margin_top'] = 0;
    ?>
    <script>
        $("body").ready(function(){
         $("#main-menu a").click(function(e){
           e.preventDefault();

            if( screen.width <=768 ){
                 $(".v-toggle-menu").click()
            }

           var href = $(this).attr("href");

           if(href == site_url)
           {
                $("html, body").animate({scrollTop : <?php echo $param['margin_top'] ?> }, "slow");
                window.history.pushState({},"", site_url);
                return;
           }

            $("#main-menu li").removeClass("active");
            var par = $(this).parent().addClass("active").attr("par");

            var hash = $(this).attr("href");
            var arr_hash = hash.split("#");

            if(arr_hash.length == 2)
            {
                if(arr_hash[1] != '')
                {
                    $("html, body").animate({scrollTop : $("#" + arr_hash[1]).offset().top - <?php echo $param['margin_top'] ?> }, "slow");
                    //window.history.pushState({},"", site_url + "#" + arr_hash[1]);
                }
                else
                {
                    <?php
                        if(!empty($param['hash']))
                        {
                            ?>
                            location.href = href;
                            <?php
                        }
                    ?>

                }
            }
            else
            {
                <?php
                    if(!empty($param['hash']))
                    {
                        ?>

                        <?php
                    }
                ?>
                location.href = href;
            }


        });

         <?php
            if(DESIGN)
            {
                ?>
                $("body").find("div[id]").each(function(){
                    $(this).prepend("<input type='text' class='id-input' value='" + site_url + "/#" + $(this).attr("id") + "' />").addClass("has-id");
                });
                <?php
            }
        ?>
    });


    </script>
    <style>
    .header-wrap .id-input, #fb-root .id-input, #slide .id-input{
        display:none;
    }
    .id-input{
        z-index:9;
        position:relative;
    }
    </style>
    <?php
}


function body_class()
{

    global $g_page_info;
    if(empty($g_page_info['page_id'])) $g_page_info['page_id'] = 0;
    echo '  page_type-', $g_page_info['page_type'], ' page_id-', $g_page_info['page_id'], ' page-', $g_page_info['page'], ' ';
}

function domain_config()
{
    global $g_page_info;
    global $file_executive;
    //h($g_page_info)
?>
<!-------------------------------------------------------------- File thực thi chính --------------------------------------------------
<?php echo str_replace(PATH_ROOT . '/tpl/tpl/', '', $file_executive); ?>
-------------------------------------------------------------- #END File thực thi chính ----------------------------------------------->

<!-------------------------------------------------------------- Page Info ------------------------------------------------------------------
<?php

 switch($g_page_info['page_type'])
 {
    case 'home' :
    {
        ?>
    Page Type                  : Home
    Home Template              : <?php echo get_option('home_template') ?>
    Page Pagination            : <?php echo get_option('page') ?>
    <?php
        break;
    }
    case 'category' :
    {
        global $category_info;
        ?>
    Page Type                  : Category
    Category Template          : <?php echo $category_info['template'] ?>
    Page Pagination            : <?php echo $g_page_info['page'] ?>
    Category ID                : <?php echo $category_info['id'] ?>
        <?php
        break;
    }
    case 'tag' :
    {
        global $tag_info;
        ?>
    Page Type                  : Tag
    Tag Template               : <?php echo $tag_info['template'] ?>
    Page Pagination            : <?php echo $g_page_info['page'] ?>
    Tag ID                     : <?php echo $tag_info['id'] ?>
        <?php
        break;
    }
    case 'post' :
    {
        global $post_info;
        ?>
    Page Type                  : Post
    Post Template              : <?php echo $post_info['template'] ?>
    Page Pagination            : <?php echo $g_page_info['page'] ?>
    Post ID                    : <?php echo $post_info['id'] ?>
        <?php
        break;
    }

    case 'search' :
    {
        global $post_info;
        ?>
    Page Type                  : Search
    Page Pagination            : <?php echo $g_page_info['page'] ?>
    Search keyword             : <?php echo $_GET['s'] ?>
        <?php
        break;
    }
    case '404' :
    {
        global $post_info;
        ?>
    Page Type                  : 404<?php
        break;
    }
}?>

-------------------------------------------------------------- #END Page Info -------------------------------------------------------------->


<!-------------------------------------------------------------- Danh sách block khả dụng --------------------------------------------------
<?php
$blocks = get_option('actived_blocks');
$blocks = json_decode($blocks, TRUE);

foreach($blocks as $block)
{

    $myfile = fopen( PATH_ROOT . '/blocks/' . $block . '/title.txt', "r") or die("Unable to open file!");
    $block_title = fread($myfile,filesize(PATH_ROOT . '/blocks/' . $block . '/title.txt'));
    fclose($myfile);
    echo $block, ' : ', $block_title, PHP_EOL;

}
?>
-------------------------------------------------------------- #END Danh sách block khả dụng ----------------------------------------------->


<!-------------------------------------------------------------- Danh sách Extension khả dụng --------------------------------------------------
<?php
$extensions = get_option('actived_extensions');
$extensions = json_decode($extensions, TRUE);

foreach($extensions as $extension)
{

    $myfile = fopen( PATH_ROOT . '/extensions/' . $extension . '/title.txt', "r") or die("Unable to open file!");
    $extension_title = fread($myfile,filesize(PATH_ROOT . '/extensions/' . $extension . '/title.txt'));
    fclose($myfile);
    echo $extension, ' : ', $extension_title, PHP_EOL;

}
?>
-------------------------------------------------------------- #END Danh sách Extension khả dụng ----------------------------------------------->


<!-------------------------------------------------------------- Thông tin khác --------------------------------------------------
Kiểu menu di động :        <?php echo get_option('v_main_menu_style') ?>
www               :        <?php $t = get_option('core_www_option');if($t) echo 'Có';else echo 'Không'; ?>
Giao diện di động :        <?php $t = get_option('web_responsive');if($t) echo 'Có';else echo 'Không'; ?>
-------------------------------------------------------------- #END Thông tin khác ----------------------------------------------->

<!-------------------------------------------------------------- Cài đặt các block "DS bài viết" --------------------------------------------------
<?php
    for($i=1;$i<=4;$i++)
    {
        ?>
#DS bài viết <?php echo $i ?> : <?php $t = get_config('dsbv' . $i .'_box'); if(empty($t)) echo '', TEMPLATE , '/box', $i, '.tpl' ; else echo 'box/box', $i, '.tpl' ?>
<?php
    }
?>
-------------------------------------------------------------- #END Cài đặt các block "DS bài viết" ----------------------------------------------->
 <?php
}

function advanced_search($param = array())
{
    if(empty($param['id'])) $param['id'] = '';
    ?>
    <div class="wrap-advanced-search">
        <form class="advanced-search" class=" filter" method="GET" action="<?php echo SITE_URL ?>/search<?php echo URL_SUFFIX ?>">
            <input type="hidden" name="search_by" value="tag" />
            <?php views_BlockArea::display_area('filter-title-' . $param['id']) ?>
            <div class="filter-content clearfix">
                <div class="filter-fiels clearfix">
                <?php

                    $tags = models_DB::get( ' SELECT * FROM  ' . TAG_TABLE . ' WHERE parent=0 ORDER BY stt DESC ' );
                    foreach($tags as $k=>$tag)
                    {

                        ?>
                        <div id="filter-item-<?php echo $k ?>" class="filter-item   v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-6 v-col-tx-6 border-box">
                            <div class="filter-item-title">
                                <?php echo $tag['title'] ?>
                            </div>
                            <div class="filter-item-content">
                                <select name="<?php echo $tag['id'] ?>">
                                    <option value="0">Tất cả</option>
                                    <?php
                                        $sub_tags = models_DB::get( ' SELECT * FROM  ' . TAG_TABLE . ' WHERE parent=' . $tag['id'] . ' ORDER BY stt DESC ' );
                                        foreach($sub_tags as $sub_tag)
                                        {

                                            ?>
                                            <option <?php if(isset($_GET[$tag['id']]) && ($_GET[$tag['id']] == $sub_tag['id'])) echo ' selected ' ?> class="display_in-<?php echo $sub_tag['display_in'] ?>" value="<?php echo $sub_tag['id'] ?>"><?php echo $sub_tag['title'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                </div>
                <div class="filter-submit">
                    <input value="Tìm kiếm"   type="submit" />
                </div>
            </div>
        </form>
    </div>
    <?php
}

function display_html_multi( $field_name , $type = '')
{
    global $post_info;
    switch($type)
    {
        case '' :
        {

            break;
        }
        case 'title' :
        {
            $tabs = json_decode($post_info[$field_name], TRUE);
            foreach($tabs as $tab)
            {
                ?>
                <div class="nav-tabs-item" href="<?php echo pretty_string($tab['title']) ?>">
                    <?php echo $tab['title'] ?>
                </div>
                <?php
            }
            ?>
            <?php
            break;
        }
        case 'value' :
        {
            $tabs = json_decode($post_info[$field_name], TRUE);
            foreach($tabs as $tab)
            {
                ?>
                <div class="content-tabs-item content-tabs-item-<?php echo pretty_string($tab['title']) ?>">
                    <?php echo $tab['value'] ?>
                </div>
                <?php
            }
            ?>
            <?php
            break;
        }
    }
}

function display_visitor()
{
    ?>
    <div class="z-vistor-counter">
        <div class="z-visitor-counter-item total">
            <div class="z-visitor-counter-item-title">
                Tổng số truy cập :
            </div>

            <div class="z-visitor-counter-item-content">
                <?php
                    $total = models_DB::get( 'SELECT COUNT( id ) AS total FROM ' . VISITOR_TABLE );
                    echo $total[0]['total'];
                ?>
            </div>
        </div>

        <div class="z-visitor-counter-item total">
            <div class="z-visitor-counter-item-title">
                Đang online :
            </div>

            <div class="z-visitor-counter-item-content">
                <?php
                    $begin = hcv_time() - 5;
                    $end = hcv_time();
                    $t = 'SELECT COUNT( id ) AS total FROM ' . VISITOR_TABLE . ' WHERE ( time_create <  ' . $end . ' ) AND ( time_create >  ' . $begin . ' )';

                    $total = models_DB::get( $t );
                    echo $total[0]['total'] + 1;
                ?>
            </div>
        </div>
    </div>
    <?php
}



function advanced_search_by_field( $param )
{
    //h($param); die();
    if(empty($param['id'])) $param['id'] = '';
    $fields = explode(', ', $param['field']);

    $param['field'] = $fields;

    ?>
    <script>
        <?php require_once PATH_ROOT . '/inc/js/advanced-search-form.js'; ?>
    </script>
    <form class="core-filter-search" class=" filter" method="GET" action="<?php echo SITE_URL ?>/search<?php echo URL_SUFFIX ?>">
        <input type="hidden" name="search_by" value="field" />
        <input type="hidden" name="post_type" value="<?php echo $param['post_type'] ?>" />
        <div class="core-filter clearfix">
            <div class="filter-title">Tìm kiếm</div>
            <div class="filter-content clearfix">
            <?php
                foreach( $fields as $k => $other_field )
                {
                    $field_in_dbs = models_DB::get('SELECT * FROM ' . FIELD_TABLE );
                    //$field_in_dbs = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( post_type=' . $param['post_type'] . ' OR post_type = all ) ' );

                    foreach($field_in_dbs as $field_in_db)
                    {
                        $temp_post_type = json_decode( $field_in_db['attribute'], TRUE );

                        if( $temp_post_type['name'] == $other_field )
                        {
                            $default_value[$temp_post_type['name']] = '';

                            if(isset( $_GET[$temp_post_type['name']] )) $default_value[$temp_post_type['name']] = $_GET[$temp_post_type['name']];

                            $temp_post_type['require'] = 0;
                            ?>
                            <div class="filter-item filter-item-<?php echo $temp_post_type['name']  ?>">
                                <?php include PATH_ROOT . '/inc/post_type/' . $temp_post_type['field_type'] . '/post_form.php'; ?>
                            </div>
                            <?php
                        }
                    }
                }
            ?>
                <div class="filter-item filter-item-submit">
                    <input type="submit" name="submit" value="Tìm kiếm" placeholder="" />
                </div>
            </div>
        </div>
    </form>
    <?php
}

function display_upload_button($param)
{
    if( !defined('DISPLAY_UPLOAD_BUTTON_SCRIPT') )
    {
        ?>
        <script>
            $(document).ready(function(){
                $("body").on("click", ".core-upload-button", function(){
                     var par = $(this).attr("par");

                     $(".real-core-upload-button-" + par).click();

                });

                $("body").on("change", ".real-core-upload-button", function(){
                     var par = $(this).attr("par");

                     $(".real-core-upload-button-" + par).click();

                    var data = new FormData();
                    data.append('file', $(".real-core-upload-button-" + par)[]);


                    var http = new XMLHttpRequest();


                    $.ajax({
                        url:site_url + "/inc/?page_type=ajax-upload-single&dir=" + dir_upload,
                        type:"post",
                        cache       : false,
                        contentType : false,
                        processData : false,
                        xhr: function()
                                      {
                                      },
                        data:data,
                        success:function(data){

                        },
                        error:function(data, te, code){

                        }
                    });

                });
            });
        </script>
        <?php
        define('DISPLAY_UPLOAD_BUTTON_SCRIPT', TRUE);
    }
    ?>
    <span><i class="fa fa-cloud-upload core-upload-button core-upload-button-<?php echo $param['name'] ?> " par="<?php echo $param['name'] ?>"></i></span>
    <input class="none real-core-upload-button real-core-upload-button-<?php echo $param['name'] ?>" dir_upload="" name="userfile[]" type="file" par="<?php echo $param['name'] ?>" />
    <?php
}

function display_categories_of_post($post_id)
{
    $post = get_post($post_id, ' categories ');
    if(empty($post)) return;
    $cat_ids = explode(',', $post['categories']);
    if(empty($cat_ids)) return;
    ?>
    <?php
    foreach($cat_ids  as $cat_id)
    {
        $category = get_category($cat_id);
        if(empty($category)) continue;
        ?>
        <a href="<?php hcv_url('c', $category['url'], $category['id']) ?>">
            <?php echo $category['title'] ?>
        </a>
        <?php
    }
}

function display_post_tags($post_id = '')
{
    if(empty($post_id)){
        global $post_info;
        $post_id = $post_info['id'];
    }
    else
    {
        $post_info = get_post($post_id, ' tags ');
    }
    if(!empty( $post_info['tags']) )
    {
        $tags = explode(',', $post_info['tags']);
        foreach($tags as $tag)
        {
            $tag_info = get_tag($tag);
            ?>
            <a href="<?php hcv_url('t', $tag_info['url'], $tag_info['id']) ?>">
                <?php echo $tag_info['title'] ?>
            </a>
            <?php
        }
    }
}

function display_expired_noti()
{
    ?>
    <!doctype html>
    <html>
    <head>
      <title>Website hết hạn sử dụng</title>
    </head>
    <body>
        <img alt="" style="display: block;margin:auto;max-width:800px" title="" src="<?php echo CDN_DOMAIN ?>/inc/images/het-han.jpg" />
    </body>
    </html>

    <?php
    die();
}


function display_default_profile_content()
{
    ?>
    <div class="clearfix" id="main-form-content">
        <div class="fl border-box v-col-lg-3 v-col-md-3 v-col-sm-4 v-col-xs-4 v-col-tx-12">
            <div class="core-actions v-lg-mr-20 v-md-mr-20 v-sm-mr-20 v-xs-mr-15">
                <div class="core-action-title">Quản lý tin đăng</div>
                <ul>
                    <li class="core-show-active-posts">Tin đã duyệt</li>
                    <li class="core-show-pending-posts">Tin chờ duyệt</li>
                    <li class="core-show-expired-posts">Tin hết hạn</li>
                </ul>
            </div>
            <div class="core-actions v-lg-mr-20 v-md-mr-20 v-sm-mr-20 v-xs-mr-15">
                <div class="core-action-title">Tiện ích</div>
                <ul>
                    <li class="core-show-billing-history">Số dư / lịch sử giao dịch</li>
                    <li class="core-show-nap-tien ">Nạp tiền vào tài khoản</li>
                    <li class="core-show-nap-tien">Mua lượt up tin</li>
                </ul>
            </div>
            <div class="core-actions v-lg-mr-20 v-md-mr-20 v-sm-mr-20 v-xs-mr-15">
                <div class="core-action-title">Thông tin tài khoản</div>
                <ul>
                     <li class="core-show-profile">Hồ sơ cá nhân</li>
                </ul>
            </div>
        </div>
        <div class="main-form-content-inner fl border-box v-col-lg-9 v-col-md-9 v-col-sm-8 v-col-xs-8 v-col-tx-12">
			<span class="clear"></span>

			<div class="title-form-main"><div class="read-mi"><span><h1>Đăng tin</h1></span></div></div>
			<div class="core-action-detail">
			    <div class="core-new-thread-form thread-form">
				    <div style="padding:50px;text-align:center">
				        <img style="width:100px" src="{$c_fontend_template_url}/images/loading2.gif" />
				    </div>
				</div>
			</div>
        </div>
    </div>
    <?php
}
