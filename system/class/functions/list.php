<?php
class functions_list
{
    public function __construct()
    {

    }
    
    public function checktype(){
        $check = '';
        global $g_page_info;
        global $other_header;
        switch($g_page_info['page_type']){
            case 'post' :
            {
                global $post_info;
                $check = 'post';
            }
            break;
        }
        return $check;
    }

    public  function hcv_head()
    {
             global $g_page_info;

             global $other_header;

             switch($g_page_info['page_type'])
             {
                case 'home' :
                {
                     $title  = get_option('site_name');

                     $description = get_option('site_description');

                     $other_header .= '<link rel="canonical" href="'. SITE_URL .'" />';

                     if(!ROBOTS_INDEX)
                     {
                         $other_header .= '<meta name="robots" content="noindex,nofollow" />';
                         if(USER_PERMISSION != 'admin') die('Website đang cập nhật nội dung, vui lòng quay lại sau!');
                     }

                     $home_images = get_option('home_image');
                     if(!empty($home_images))
                    {
                        $other_header .= '<meta property="og:image" content="' . $home_images . '" />';
                    }

                    $site_keyword =  get_option('site_keyword');
                    if(!empty($site_keyword)) $other_header .= '<meta name="keywords" content="'. strip_tags($site_keyword) .'" />';

                    $other_header .= '<meta name="twitter:card" content="summary" />';
                    $other_header .= '<meta name="twitter:title" content="' . strip_tags($title) . '" />';
                    $other_header .= '<meta name="twitter:description" content="' . strip_tags($description)  . ' />';
                    $other_header .= '<meta name="twitter:url" content="' . SITE_URL . '" />';
                    $other_header .= '<meta name="twitter:image" content="' . $home_images . '" />';
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

                    $description_og_meta = 0;

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

                    $other_header .= '<meta name="twitter:card" content="summary" />';
                    $other_header .= '<meta name="twitter:title" content="' . $post_info['title'] . '" />';
                    $other_header .= '<meta name="twitter:description" content="' .  strip_tags($post_info['description'])  . ' />';
                    $other_header .= '<meta name="twitter:url" content="' . hcv_url('p', $post_info['url'], $post_info['id'], FALSE) . '" />';
                    $other_header .= '<meta name="twitter:image" content="' . $post_info['image'] . '" />';

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

                    $other_header .= '<meta name="twitter:card" content="summary" />';
                    $other_header .= '<meta name="twitter:title" content="' . $category_info['title'] . '" />';
                    $other_header .= '<meta name="twitter:description" content="' .  strip_tags($category_info['description'])  . ' />';
                    $other_header .= '<meta name="twitter:url" content="' . hcv_url('p', $category_info['url'], $category_info['id'], FALSE) . '" />';
                    $other_header .= '<meta name="twitter:image" content="' . $category_info['image'] . '" />';
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

                    $other_header .= '<meta name="twitter:card" content="summary" />';
                    $other_header .= '<meta name="twitter:title" content="' . $tag_info['title'] . '" />';
                    $other_header .= '<meta name="twitter:description" content="' .  strip_tags($tag_info['description'])  . ' />';
                    $other_header .= '<meta name="twitter:url" content="' . hcv_url('p', $tag_info['url'], $tag_info['id'], FALSE) . '" />';
                    $other_header .= '<meta name="twitter:image" content="' . $tag_info['image'] . '" />';
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
        	 <meta property="og:type" content="website" />
         	 <meta property="og:title" content="<?php echo $title ?>" />

        	 <meta property="og:site_name" content="<?php echo get_option('site_name'); ?>" />
             <meta name="generator" content="Thiết kế web bất động sản zland.vn" />
             <link rel="shortcut icon" href="<?php echo get_option('favicon') ?>" type="image/x-icon" />
             <meta http-equiv="content-language" content="vi" />
        	 <?php
                $view_port = get_option('v-meta-viewport');



                if( ( $view_port === FALSE ) || ( $view_port == '1' ) || empty($view_port) )
                {

                    if(empty($view_port))
                    {
                        ?>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
                        <?php
                    }
                    else
                    {
                        echo $view_port;
                    }

                }

             ?>

        	 <script>
        		var site_url = "<?php echo SITE_URL ?>";
        		var tpl_url = "<?php echo TEMPLATE_URL ?>";
                var current_url = "<?php echo CURRENT_URL ?>";

        		var cdn_domain = "<?php echo CDN_DOMAIN ?>";
        		var cnd_tpl_url = "<?php echo CDN_DOMAIN . '/tpl/' . TEMPLATE ?>";
                var template_type = "front_end";

                var screen_width = window.innerWidth;

                <?php

                    if(defined('DOMAIN_ID'))
                    {
                        ?>
                        var domain_id = "<?php echo DOMAIN_ID ?>";
                        <?php
                    }
                    else
                    {
                        ?>
                        var domain_id = 0;
                        <?php
                    }

                ?>

        	 </script>


        	 <script   src="<?php echo CDN_DOMAIN ?>/apps/js/jquery-1.10.2.js?v=<?php echo FRONT_END_VERSION ?>"></script>
             <script   src="<?php echo CDN_DOMAIN ?>/inc/js/reset.js?v=<?php echo FRONT_END_VERSION ?>"></script>
             <script   src="<?php echo CDN_DOMAIN ?>/inc/js/form.js?v=<?php echo FRONT_END_VERSION ?>"></script>

             <!-- <link rel="stylesheet" id="css-reset" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/normalize.css?v=<?php echo FRONT_END_VERSION ?>" media="all" /> -->
             <link    rel="stylesheet" id="css-reset" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/reset.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />
             <link    rel="stylesheet"  id="css-responsive" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/vos-responsive.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />

             <?php display_flex_cdn() ?>

             <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/WOWJS/WOW-master/css/libs/animate.css?v=<?php echo FRONT_END_VERSION ?>" />
             <script defer type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/WOWJS/WOW-master/dist/wow.min.js?v=<?php echo FRONT_END_VERSION ?>"></script>

             <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/apps/animate.css-master/animate.min.css?v=<?php echo FRONT_END_VERSION ?>" />

             <!-- <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/tpl/tpl/341/css/animations.css?v=115557" /> -->


             <style>
                <?php
                    $v_wrap_full_width = get_option('v-wrap-full_width');
                    if(!empty($v_wrap_full_width))
                    {
                        ?>
                        @media only screen and (min-width: 1100px){
                            .v-wrap-full{
                                width:<?php echo get_option('v-wrap-full_width') ?>px;
                            }
                        }
                        <?php
                    }
                ?>

             </style>

             <?php
                    $v_loading = get_option('v-lazy-loading-image');
                    //$v_loading = '';
                    if(!empty($v_loading))
                    {

                        ?>
                        <script defer type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/jquery_lazyload-2.x/lazyload.min.js?v=<?php echo FRONT_END_VERSION ?>"></script>
                        <script>
                            $(document).ready(function(){
                                <?php
                                $parts = explode(',', $v_loading);
                                foreach($parts as $part)
                                {
                                    ?>
                                    $("<?php echo $part ?>").find("img").each(function(){
                                        var _this = $(this);
                                        var t_src = $(this).attr("src");
                                        if(t_src == undefined) return;
                                        if(t_src == '') return;
                                        _this.attr("data-src", t_src );
                                        _this.attr("src", "<?php echo CDN_DOMAIN ?>/inc/images/loading-lazyloading.gif");
                                    })
                                    //$(" <?php echo $part ?> img ").attr("src", "<?php echo CDN_DOMAIN ?>/inc/images/loading-lazyloading.gif");
                                    $(" <?php echo $part ?> img ").lazyload();
                                    <?php
                                }
                                ?>

                            });
                        </script>
                        <?php
                    }
             ?>

             <?php
                if(USER_PERMISSION == 'admin')
                {
                    ?>
                    <link    rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />

                    <script defer src="<?php echo CDN_DOMAIN ?>/inc/js/admin.js?v=<?php echo FRONT_END_VERSION ?>"></script>
                    <?php
                }

                $menu_style = get_option('v_main_menu_style');
                if(!empty($menu_style))
                {
                    ?>
                    <script defer src="<?php echo CDN_DOMAIN ?>/inc/menu-style/js/<?php echo $menu_style ?>.js?v=<?php echo FRONT_END_VERSION ?>"></script>
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
                <script defer src="<?php echo CDN_DOMAIN ?>/addon/<?php echo $actived_addon ?>/js.js?v=<?php echo FRONT_END_VERSION ?>"></script>
                <link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/addon/<?php echo $actived_addon ?>/css.css?v=<?php echo FRONT_END_VERSION ?>" media="all" />
                <?php
            }
             //$other_header .= '<link rel="stylesheet" href="' . CDN_DOMAIN . '/inc/css/font-awesome-4.5.0/css/font-awesome.min.css" />';
             $other_header .= '<link   rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />';
             //$other_header .= '<link rel="stylesheet" href="' . CDN_DOMAIN . '/apps/WOWJS/WOW-master/css/libs/animate.css" />';
             //$other_header .= '<script type="text/javascript" src="' . CDN_DOMAIN . '/apps/WOWJS/WOW-master/dist/wow.min.js"></script>';

             echo $other_header;
    }

    public function wp_footer()
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
    		<div id="block-loading"><img src="<?php echo SITE_URL ?>/inc/images/ajaxloader.gif" alt="Block loading" /></div>
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
    				<link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css?v=<?php echo FRONT_END_VERSION ?>" />
                     <?php

    				if(isset($_COOKIE['design']))
    				{
    					?>

    					<link   rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/block.css?v=<?php echo FRONT_END_VERSION ?>" />
    					<form action="" method="post" >
    					<button type="submit" id="design-mode" name="close_design" >Quit</button>
    					</form>
    					<div id="list_block">

    					<script>
    						var site_url = "<?php echo SITE_URL ?>";
    					</script>



    					<script defer  src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-ui.js?v=<?php echo FRONT_END_VERSION ?>"></script>
    					<script defer src="<?php echo CDN_DOMAIN ?>/inc/js/block.js?v=<?php echo FRONT_END_VERSION ?>"></script>
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

    public function wp_is_mobile() {
            static $is_mobile;

            if ( isset($is_mobile) )
                 return $is_mobile;
            if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
    		$is_mobile = false;
    	        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
    	                || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
                    || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
                   || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
                   || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
                   || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
    	                || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                            $is_mobile = true;
            } else {
                    $is_mobile = false;
            }

    	    return $is_mobile;
    }

    public function display_edit_option_icon($name, $type = 'text')
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

    public function get_option($option_name)
    {
        $result = models_DB::get('SELECT value FROM ' . OPTION_TABLE . ' WHERE name=\''. $option_name . '\'');
        if(empty($result)) return FALSE;
        else return $result[0]['value'];
    }

    public function hcv_isset($variable)
    {
        if(isset($variable)) return true;
        return false;
    }
    public function floor($variable)
    {
        return floor($variable);
    }

    public function display_extension_by_position($pos)
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
               if(file_exists( PATH_ROOT . '/extensions/' . $list['name'] . '/display.php') ) include PATH_ROOT . '/extensions/' . $list['name'] . '/display.php';
            }

        }

    }

    public function num_to_price($num, $comma = '.', $unit = '')
    {
    	$array = str_split($num);
    	$array_reverse = array_reverse($array);

    	$result_array = array();

    	foreach($array_reverse as $k=>$v)
    	{
    		$result_array[] = $v;
    		if( ( ( $k + 1 ) % 3 ) == 0 ) $result_array[] = $comma;
    	}

    	$result_array = array_reverse($result_array);

    	if($result_array[0] == $comma) array_shift($result_array);

    	$result = implode('', $result_array);



    	return  $result . $unit;
    }

    public function price_to_num($price)
    {
    	$array = str_split($price);
    	$result = array();
    	foreach($array as $v)
    	{
    		if(is_numeric($v)) $result[] = $v;
    	}

    	$result = implode('', $result);

    	return  $result;
    }

    public function display_bread_crumb()
    {
        global $g_page_info;
        if(empty($g_page_info['page_id'])) $g_page_info['page_id'] = 0;

        $type = str_split ( $g_page_info['page_type']);
        $type = $type[0];
        $id = $g_page_info['page_id'];
        $home = TRUE;
        $_this = TRUE;
        $arrow = '›';

        $bread_crumbs = get_breadcrumb_items($type, $id, $home, $_this);



        $count = count($bread_crumbs);
    	?>
    	<div class="hcv-bread-crumb">

    	<?php
    	foreach($bread_crumbs as $k=>$bread_crumb)
    	{

    		?>
    		<?php if($k) : ?><span class="arrow"><?php echo $arrow; ?></span><?php endif; ?>
    		<a class="bread-crumb-item <?php if($_this && ($k==($count -1))) echo 'bread-crumb-last' ?>" href="<?php echo $bread_crumb['link'] ?>" title="<?php echo $bread_crumb['anchor'] ?>"><?php echo $bread_crumb['anchor'] ?></a>
    		<?php
    	}
    	?>
    	</div>
    	<?php
    }

    public function the_excerpt_max_charlength($excerpt, $charlength) {
    	$charlength++;
    	if ( mb_strlen( $excerpt ) > $charlength ) {

    		$subex = mb_substr( $excerpt, 0, $charlength - 5 );

    		$exwords = explode( ' ', $subex );

    		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

    		if ( $excut < 0 ) {

    			echo mb_substr( $subex, 0, $excut );

    		} else {

    			echo $subex;

    		}

    		echo '...';

    	} else {

    		echo $excerpt;

    	}

    }

    public function display_pagination( )
    {
        global $g_page_info;

        global $total_post;

        $url_suffix = '';
        if(!defined('ADMIN_PAGE')) $url_suffix = URL_SUFFIX;




        $type = str_split ( $g_page_info['page_type']);
        $type = $type[0];


        $param = array(

            'current_page'      => $g_page_info['page'],
            'total_post'        => $total_post,
            'posts_per_page'    => get_option('posts_per_page')
        );

        switch( $g_page_info['page_type'] )
        {
            case 'category' :
            {
                global $category_info;
                $param['base_url'] = remove_url_suffix(hcv_url($type, $category_info['url'], $category_info['id'], FALSE));
                break;
            }
            case 'tag' :
            {
                global $tag_info;
                $param['base_url'] = remove_url_suffix(hcv_url($type, $tag_info['url'], $tag_info['id'], FALSE));
                break;
            }
            case 'search' :
            {
                if(empty($_GET['s'])) $_GET['s'] = '';
                $param['base_url'] = remove_url_suffix( SITE_URL . '/search' . URL_SUFFIX );
                $param['suffix']   = '?s='.$_GET['s'];
                break;
            }
        }

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

    public function cdn_timthumb_url($src, $w, $h, $echo = TRUE)
    {
        $result = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h . '&q=' . TIMTHUMB_QUALITY;
        if($echo) echo $result;
        return $result;
    }

    public function timthumb_url($src, $w, $h, $echo = TRUE)
    {

        $result = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h . '&q='. TIMTHUMB_QUALITY;

        if($echo) echo $result;
        return $result;
    }

    public function h($par)
    {
        ?>
        <pre style="padding: 10px;background: rgb(231, 243, 255);border: 1px solid silver;margin: 10px;font-size: 13px;color: rgb(69, 69, 69);">
            <?php print_r($par) ?>
        </pre>
        <?php
    }

    public function block_area_tabs($id, $click_type = 'carousel')
    {
        ?>

        <div class="block_area_tabs" id="block_area_tabs-<?php echo $id ?>">
            <style>
            select.block_area_tabs-select {
                width:  100%;
                box-sizing:  border-box;
                padding: 5px 10px;
            }
            </style>
            <div class="   ">

                <div class="block_area_tabs-content ">
                    <?php
                        for($i=1;$i<=30;$i++)
                        {
                            $j = $i-1;
                            $c = get_option('block_area_tabs-nav-' . $id . '-' . $j);
                            if( ( ($c == '') || ($c == ' ') ) && ( $i > 1 ) ) break;

                            $d = get_option('block_area_tabs-nav-' . $id . '-' . $i);
                            if( ($d == '') && ( USER_PERMISSION != 'admin') ) break;

                            ?>
                            <div class="block_area_tabs-content-item <?php if($i==1) echo ' active ' ?> block_area_tabs-content-item-<?php echo $i; ?>" >
                                <div class="home-general-item-image">
                                    <?php views_BlockArea::display_area( 'block_area_tabs-' . $id . '-' . $i ) ?>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                    <div class="block_area_tabs-nav clearfix"  >
                        <div class="block_area_tabs-nav-inner mobile-scroll-horizontal">
                            <?php
                            for($i=1;$i<=30;$i++)
                            {
                                $j = $i-1;
                                $c = get_option('block_area_tabs-nav-' . $id . '-' . $j);
                                if( ( (empty($c)) || ($c == ' ') ) && ( $i > 1 ) ) break;

                                $d = get_option('block_area_tabs-nav-' . $id . '-' . $i);

                                if( (empty($d)) && ( USER_PERMISSION != 'admin') ) break;
                                ?>
                                <div class="block_area_tabs-nav-item block_area_tabs-nav-item-<?php echo $i ?> <?php if($i==1) echo ' active ' ?>" the_par="<?php echo $i; ?>">
                                    <div class="block_area_tabs-item-inner"><?php echo get_option( 'block_area_tabs-nav-' . $id . '-' . $i );display_edit_option_icon('block_area_tabs-nav-' . $id . '-' . $i, 'text') ?></div>
                                </div>
                                <?php
                            }
                        ?>
                            </div>
                    </div>
                </div>
                <?php
                    if($click_type == 'click')
                    {
                        ?>
                        <style>
                        #block_area_tabs-<?php echo $id ?> .block_area_tabs-content-item{
                            display:none
                        }
                        #block_area_tabs-<?php echo $id ?> .block_area_tabs-content-item.active{
                            display:block
                        }
                        </style>
                        <script>
                            $("document").ready(function(){
                                $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav-item").click(function(){
                                     var the_par = $(this).attr("the_par");
                                      $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-content-item").removeClass("active");
                                      $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-content-item-" + the_par).addClass("active");

                                      $(".block_area_tabs-nav-item").removeClass("active");
                                      $(this).addClass("active");

                                      $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-content-item.active").find("iframe").each(function() {
                                            var _this = $(this);
                                            var w = _this.attr("width");
                                            var h = _this.attr("height");

                                            var undefined_src = $("body").attr("sdfdsfewrwer");
                                            if ((w == undefined_src) || (h == undefined_src)) return;
                                            var scale = w / h;

                                            var real_w = _this.width();
                                            _this.height(real_w / scale);
                                            setTimeout(function() {

                                            }, 1000);
                                        });

                                });
                            });
                        </script>
                        <?php
                    }
                    if($click_type == 'carousel')
                    {

                        ?>
                        <script>
                            $("document").ready(function(){

                                $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-content").addClass("owl-carousel owl-theme");
                                $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-content").owlCarousel({
                        		    items : 1,
                                    autoPlay:true,
                                    autoPlayTimeout:1000,
                                    center:true,
                                    autoPlayHoverPause:false,
                                    nav:true,
                                    loop:true,
                        		    lazyLoad : true,
                        		    navigation : true,
                                    itemsDesktop : [1199,1],
                                    itemsDesktopSmall : [980,1],
                                    itemsTablet: [768,1],
                                    itemsTabletSmall: false,
                                    itemsMobile : [479,1],
                                    autoHeight: true,
                        		});
                                $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav-item").click(function(){

                                     var the_par = $(this).attr("the_par");

                                      $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav-item").removeClass("active");
                                      $(this).addClass("active");
                                     $('#block_area_tabs-<?php echo $id ?> .block_area_tabs-content').trigger('to.owl.carousel', the_par - 1)
                                });
                            });
                        </script>
                        <?php
                    }
                    ?>
                    <script>
                        $("document").ready(function(){
                                $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav-item").click(function(){
                                     $(window).resize();
                                });

                                //Append select
                                var total_nav_width = 0;
                                if(false) //screen_width <= 991
                                {
                                    $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav").append('<select class="block_area_tabs-select none"></select>');
                                    $("#block_area_tabs-<?php echo $id ?>").find(".block_area_tabs-nav-item").each(function(){
                                        total_nav_width = total_nav_width + $(this).outerWidth();
                                        var par = $(this).attr("the_par");
                                        var text = $(this).text();

                                        $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav .block_area_tabs-select").append('<option class="block_area_tabs-option" value="' + par + '">' + text +' </option>');
                                    });
                                    if( screen_width < total_nav_width )
                                    {
                                        $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav-inner ").css("display", "none");
                                        $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-select").css("display", "block");
                                    }
                                }

                                $("body").on("change", ".block_area_tabs-select", function(){
                                    var _val = $(this).val();
                                    $("#block_area_tabs-<?php echo $id ?> .block_area_tabs-nav-item-" + _val).click();
                                });

                                //#END Append select
                            });
                    </script>
                    <?php
                ?>
        </div>
        <?php
    }

    public function list_html_carousel($id, $carousel_param=array())
    {
        if(empty($carousel_param['items']))             $carousel_param['items']= 4;
        if(empty($carousel_param['autoPlay']))          $carousel_param['autoPlay']= 'true';
        else $carousel_param['autoPlay']= 'false';
        if(empty($carousel_param['autoPlayTimeout']))   $carousel_param['autoPlayTimeout']= 3000;

        ?>

        <div class="list_html_carousel list_html_carousel-<?php echo $id ?>" id="list_html_carousel-<?php echo $id ?>">
            <div class="list_html_carousel-wrap-title">
                <div class="list_html_carousel-title"><?php display_edit_option_icon('list_html_carousel-title-' . $id);echo get_option('list_html_carousel-title-' . $id) ?></div>
                <div class="list_html_carousel-title-des"><?php display_edit_option_icon('list_html_carousel-title-des-' . $id);echo get_option('list_html_carousel-title-des-' . $id) ?></div>
            </div>
            <div class="list_html_carousel-content ">
            <?php
                for($i=1;$i<=10;$i++)
                {

                    $j = $i-1;


                    $t_block_area = get_block_area_by_url('list_html_carousel-item-html-' . $id . '-' . $j);



                    if(empty($t_block_area) && ( $i > 1 )) break;
                    if(empty($t_block_area['content']) && ( $i > 1 ) ) break;

                    $t_block_area = get_block_area_by_url('list_html_carousel-item-html-' . $id . '-' . $i);

                    if(empty($t_block_area) && ( !DESIGN ) ) break;
                    if(empty($t_block_area['content']) && ( !DESIGN ) ) break;
                    ?>
                    <div class="list_html_carousel-tiem item border-box">
                        <div class="item-inner">
                            <?php
                                views_BlockArea::display_area( 'list_html_carousel-item-html-' . $id . '-' . $i );
                            ?>
                        </div>
                    </div>
                    <?php
                }
            ?>

            </div>

            <script>
                $("document").ready(function(){

                    $("#list_html_carousel-<?php echo $id ?> .list_html_carousel-content").addClass("owl-carousel owl-theme");


                    $("#list_html_carousel-<?php echo $id ?> .list_html_carousel-content").owlCarousel({
                        items : 3,
                	    lazyLoad : true,
                	    navigation : true,
                	    autoplay:<?php echo $carousel_param['autoPlay'] ?>,
                        autoplayTimeout:<?php echo $carousel_param['autoPlayTimeout'] ?>,
                        autoplayHoverPause:true,
                        center:true,
                        autoPlayHoverPause:false,
                        nav:true,
                        loop:true,
                        responsive:{
                            0:{
                                items:1
                            },
                            414:{
                                items:1
                            },
                            768:{
                                items:1
                            },
                            992:{
                                items:<?php echo $carousel_param['items'] ?>
                            },
                            1200:{
                                items:<?php echo $carousel_param['items'] ?>
                            }
                        },
                        navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>']


            		});
                });
            </script>
        </div>


        <?php
    }

    public function display_carousel_cdn(){
        display_carousel_cdn();

        ?>
       <?php
    }

    public function display_wowjs_cdn(){
        display_wowjs_cdn();
    }

    public function display_flex_cdn(){
        display_flex_cdn();
    }

    public function display_scroll_speed_cdn(){
        ?>
        <script   defer src="<?php echo CDN_DOMAIN ?>/apps/scroll-speed/js/js.js?v=<?php echo FRONT_END_VERSION ?>"></script>
        <?php
    }

    public function fb_sdk_js(){
        ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <?php
    }


    public function search_form(){
        search_form();
    }

    public function get_relative_posts($param = array())
    {
        global $post_info;
        if(empty($param['post_id']))
        {
            $param['post_id'] = $post_info['id'];
        }
        if(empty($param['post_type']))
        {
            $param['post_type'] = '';
        }

        if(empty($param['posts_per_page']))
        {
            $param['posts_per_page'] = 4;
        }
        else $param['posts_per_page']++;

        if(empty($param['filter_by']))
        {
            $param['filter_by'] = 'category';
        }
        if(empty($param['order']))
        {
            $param['order'] = ' ORDER BY time_update DESC ';
        }
        if(empty($param['field']))
        {
            $param['field'] = ' * ';
        }

        switch($param['filter_by'])
        {
            case 'category' :
            {
                $categories =  explode(',', $post_info['categories']);

                if(!empty($categories))
                {
                    if(!empty($post_info['main_category'])) $category = $post_info['main_category'];
                    else  $category = $categories[count($categories) - 1];

                    $param = array(
                        'field'     => $param['field'],
                        'order'     => $param['order'],
                        'limit'     => ' limit ' . $param['posts_per_page'],
            			'category'	=> $category,
                        'post_type' => $param['post_type']
                    );
                    $posts = get_posts($param);
                }
                else $posts = array();
                break;
            }
            case 'tag' :
            {
                if(!empty($post_info['tags']))
                {
                    $tags =  explode(',', $post_info['tags']);
                    if(!empty($tags))
                    {
                        $param = array(
                            'field'     => $param['field'],
                            'order'     => $param['order'],
                            'limit'     => ' limit ' . $param['posts_per_page'],
                			'tag'	   => $tags[count($tags) - 1],
                            'post_type' => $param['post_type']
                        );



                        $posts = get_posts($param);
                    }
                    else $posts = array();
                }
                else $posts = array();

                break;
            }
            case 'user' :
            {
                $user = get_user($post_info['user_id']);
                if(!empty($user))
                {
                    $param = array(
                        'field'     => $param['field'],
                        'order'     => $param['order'],
                        'limit'     => ' limit ' . $param['posts_per_page'],
            			'user'   	=> $post_info['user_id'],
                        'post_type' => $param['post_type']
                    );
                    $posts = get_posts($param);
                }
                else $posts = array();
                break;
            }

            case 'field' :
            {
                if(empty($param['field_filter'])) $posts = array();
                else
                {
                    $s = '1';

                    foreach($param['field_filter'] as $k_part=>$v_part)
                    {
                        if(empty($v_part)) $s .= ' AND 1 ';
                        else $s = $s . ' AND  '.  $k_part . ' LIKE \'%'. $v_part .'%\'';
                    }

                    if(empty($param['post_type'])) $post_type = ' 1 ';
                    else $post_type = ' post_type=' . $param['post_type'];

                    $a = 'SELECT * FROM ' . POST_TABLE . ' WHERE ' . $s . ' AND ' . $post_type . ' LIMIT ' . $param['posts_per_page'];

                    $posts = models_DB::get($a);

                }



                break;
            }
        }

        $n_posts = array();
        foreach($posts as $k=>$post)
        {
            if($post['id'] == $post_info['id'] ) continue;
            $n_posts[$k] = $post;
            $n_posts[$k]['link'] = hcv_url('p', $post['url'], $post['id'], false);
            $n_posts[$k]['thumbnail'] = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200';
            $n_posts[$k]['loop_id'] = $k;
            $v_thumb_width = get_option('v_thumb_width');
            if( empty($v_thumb_width) ) $n_posts[$k]['thumb_width'] = 300;
            else $n_posts[$k]['thumb_width'] = $v_thumb_width;

            $v_thumb_height = get_option('v_thumb_height');
            if( empty($v_thumb_height) ) $n_posts[$k]['thumb_height'] = 300;
            else $n_posts[$k]['thumb_height'] = $v_thumb_height;

            if(empty($post['image'])) $n_posts[$k]['image'] = CDN_DOMAIN . '/inc/images/noimage.png';
        }
        $posts = $n_posts;
        return $posts;
    }

    public function get_posts($param = array())
    {


    	if(!empty($param['user_id'])) $user_id = ' user_id=' . $param['user_id'] . ' ';
    	else $user_id = '1';



    	if(empty($param['category'])) $category = ' 1 ';
    	else $category = ' FIND_IN_SET(' . $param['category'] . ', categories) ';

        //if(empty($param['category'])) $category = ' 1 ';
    	//else $category = ' categories IN (' . $param['category'] . ') ';

        if(empty($param['tag'])) $tag = ' 1 ';
    	else $tag = ' FIND_IN_SET(' . $param['tag'] . ', tags) ';

        if(isset($param['s'])) $s = ' title LIKE \'%'. $param['s'] .'%\'';
        else $s = ' 1 ';

    	if(empty($param['order'])) $order = 'ORDER BY id DESC';
    	else $order = $param['order'];

    	if(empty($param['limit']))
        {
            if(!isset($param['posts_per_page'])) $posts_per_page = get_option('posts_per_page');
            else $posts_per_page = $param['posts_per_page'];

            if(!isset($param['page'])) $page = 1;
            else $page = $param['page'];

            $limit = ' LIMIT ' . (($page - 1) * $posts_per_page ) . ', ' . $posts_per_page . ' ';


        }

    	else $limit = $param['limit'];

        if(empty($param['status'])) $status = ' the_status=\'publish\' ';
    	else
        {
            if($param['status'] == 'all') $status = 1;
            else $status = ' the_status=\'' . $param['status'] . '\' ';
        }

        if(empty($param['post_type'])) $post_type = '1';
    	else $post_type = ' post_type=' . $param['post_type'];

    	if(empty($param['field'])) $field = '*';
    	else $field = $param['field'];

    	$query_string = 'SELECT ' . $field .  ' FROM ' . POST_TABLE . ' WHERE ' . $user_id . ' AND ' . $category . ' AND ' . $tag . ' AND ' . $status .  ' AND ' . $post_type . ' AND ' . $s . ' ' . $order . ' ' . $limit;



    	$result = models_DB::get($query_string);

    	return $result;
    }

    public function hcv_url($type, $slug = '', $id = '', $echo  = TRUE)
    {
        switch(ROUTER_TYPE)
        {
            case 0 :
            {
                $url = SITE_URL . '/' . $slug;

            }
            break;

            case 1 :
            {
                switch($type)
                {
                    case 'p' :
                    {
                        $url = SITE_URL . '/' . $slug . '-p' . $id ;
                    }
                    break;

                    case 'c' :
                    {
                        $url = SITE_URL . '/' . $slug . '-c' . $id ;
                    }
                    break;

                    case 't' :
                    {
                        $url = SITE_URL . '/' . $slug . '-t' . $id ;
                    }
                    break;


                    default :
                    {
                        $url = SITE_URL . '/' . $type ;
                    }
                }


            }
            break;

            case 2 :
            {

                $url = SITE_URL . '?' . $type . '=' . $id;
                if($echo) echo $url;
                return $url;
            }
            break;
        }

        if($echo) echo $url . URL_SUFFIX;
        return $url . URL_SUFFIX;
    }

    public function pretty_string($input, $separator = '-')
    {
        $ouput = mb_strtolower($input, 'UTF-8');
        $latin = array(
            "d" => array("đ"),
            "a" => array("à", "á", "ả", "ã", "ạ", "ă", "ằ", "ắ", "ẳ", "ẵ", "ặ", "â", "ầ", "ấ", "ẩ", "ẫ", "ậ"),
            "e" => array("è", "é", "ẻ", "ẽ", "ẹ", "ê", "ề", "ế", "ể", "ễ", "ệ"),
            "i" => array("ì", "í", "ỉ", "ĩ", "ị"),
            "o" => array("ò", "ó", "ỏ", "õ", "ọ", "ô", "ồ", "ố", "ổ", "ỗ", "ộ", "ơ", "ờ", "ớ", "ở", "ỡ", "ợ"),
            "u" => array("ù", "ú", "ủ", "ũ", "ụ", "ư", "ừ", "ứ", "ử", "ữ", "ự"),
            "y" => array("ỳ", "ý", "ỷ", "ỹ", "ỵ")
        );
        foreach($latin as $k_latin=>$v_latin)
        {
            foreach($v_latin as $v_v_latin)
            {
                $ouput = str_replace($v_v_latin, $k_latin, $ouput, $count);
            }


        }

        return url_title($ouput, $separator);

    }

    public function get_categories_old($param = array('field'=>'*', 'order'=>' ORDER BY stt ASC ', 'limit'=>'', 'parent'=>'0'))
    {
        if(empty($param['id'])) $id = ' 1 ';
        else $id = ' FIND_IN_SET(id, ' . $param['id'] . ') ';

        if(!isset($param['parent'])) $parent = '1';
        else $parent = ' parent = ' . $param['parent'] . ' ';

        if(empty($param['field'])) $field = ' * ';
        else $field = $param['field'];

        if(empty($param['order'])) $order = ' ORDER BY id DESC ';
        else $order = $param['order'];

        if(empty($param['limit'])) $limit = ' ';
        else $limit = $param['limit'];

        $query_string = 'SELECT ' . $field . ' FROM ' . CATEGORY_TABLE . ' WHERE ' . $id . ' AND ' . $parent . ' ' . $order . ' ' . $limit;

        //echo $query_string;

        $result = models_DB::get($query_string);
        return $result;
    }

    public function get_category($forum_id, $field = '*')
    {
    	$query_string = 'SELECT ' . $field . ' FROM ' . CATEGORY_TABLE . ' WHERE id='.$forum_id;

    	//echo $query_string;

        $result = models_DB::get($query_string);

        //h($result);

        if(empty($result)) return FALSE;
        return $result[0];
    }

    public function display_log_form()
    {
        display_log_form();
    }
    public function get_field($id)
    {
        return get_field($id);
    }
    public function get_user($id)
    {
        return get_user($id);
    }

    //Hiển thị nhanh nội dung bài viết trong trang post, trước và sau nội dung có thêm 2 block area tùy chỉnh cho từng post
    public function display_post_content($post_id)
    {
        display_post_content($post_id);
    }

    //CDN Các hiệu ứng khi hover vào phần tử
    public function cdn()
    {
        cdn();
    }

    // Hàm date smarty
    public function hcv_date($string, $time)
    {
        return date($string, $time);
    }

    // Hàm hcv_time smarty
    public function hcv_time()
    {
        return hcv_time();
    }

    public function comment_form($post_id)
    {
        comment_form($post_id);
    }

    public function display_comment($post_id)
    {
        display_comment($post_id);

    }

    public function landing_menu($param = array())
    {
        landing_menu($param);
    }

    public function body_class()
    {
        body_class();
    }
    public function domain_config()
    {
        domain_config();
    }

    public function advanced_search($param = array())
    {
        advanced_search($param);
    }

    public function hcv_setcookie( $name, $value, $expire , $path )
    {
        setcookie($name, $value, $expire , $path);
    }
    public function display_html_multi( $file_name, $type = '')
    {
        display_html_multi($file_name, $type);
    }
    public function advanced_search_by_field($param )
    {
        advanced_search_by_field($param);
    }

    public function include_php($file)
    {
        include $file;
    }

    public function num_to_text($number, $dauphay = '.')
    {
        num_to_text($number, $dauphay);
    }

    public function get_categories( $param )
    {
        return get_categories($param);
    }
    public function display_categories_of_post( $post_id )
    {
        return display_categories_of_post($post_id);
    }
    public function display_post_tags( $post_id = '' )
    {
        return display_post_tags($post_id);
    }

    public function display_star_rating($param)
    {
        display_star_rating($param);
    }

    public function display_default_profile_content()
    {
        display_default_profile_content();
    }
    
    function thanhtoan()
    {
        global $g_user;
        ?>
          <?php
            $allPrice = 0;
            $total_price = 0;
        
        		if(isset($_COOKIE['cart']))
        		{
        			$lists = json_decode($_COOKIE['cart'], TRUE);
        			if(empty($lists)) $have_product = FALSE;
        			else $have_product = TRUE;
        		}else {
              $have_product = FALSE;
              $lists = array();
            }
        
            foreach($lists as $k=>$v){
				$post = get_post($k);
				$total_price = $total_price +  $v['price'] * $v['num'];
            }
            ?>
            <div class="infocart">
                <div class="box_dh">
                    <div class="title-dh" style="margin-bottom:20px">
                        <img src="https://noithatzip.com/uploads/logo/cart_sp1.png" style="margin-right:6px" alt="">
                        <a style="font-size:14px;font-weight: bold;color:#35c853">Giỏ hàng của bạn</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:12px;" width="100%">
                            <tbody>
                                <tr style="font-weight:bold;color:#111;border-top:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;height:30px">
                                    <th align="center" style="border-left: none"></th>
                                    <th style="text-align:center;  text-transform:uppercase;">Hình ảnh</th>
                                    <th style="text-align:center; text-transform:uppercase;">Tên sản phẩm</th>
                                    <th align="center" style="text-transform:uppercase;" class="mobileandi">Đơn giá</th>
                                    <th align="center" style="text-transform:uppercase;" class="mobileandi">SL</th>
                                    <th align="center" style="text-transform:uppercase;" class="mobileandi">Thành tiền</th>   
                                </tr>      
                                <?php
                                $total_price = 0;
                                if($have_product){
                                foreach($lists as $k=>$v){
                                    $post = get_post($k);
                                    $total_price = $total_price +  $v['price'] * $v['num'];
                                    if(empty($post['image'])) $post['image'] =  SITE_URL . '/inc/images/noimage.png';
                 
                                    if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200';
                                    else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=300&h=200';
                                ?>
                                <tr class="mausole" style="background:#f5f5f5;border-bottom:1px solid #e4e4e4" id="cart-item-<?php echo $k ?>">
                                    <td  style="border-left:none;min-width: 15px !important;padding:0px" align="center">
                                        <a class="delete-cart-item"  particular="<?php echo $k ?>" style="background-color:transparent; ">
                                            <img src="https://maytrotho.vn/assets/images/icon_del.png" border="0" alt="">
                                        </a>
                                    </td>
                                    <td width="15%" style="border-left:none; text-align:center;padding:10px 0px 8px 0px">
                                        <img style="max-height: 100px;" src="<?php echo $image ?>" alt="<?php echo $post['title'] ?>"/>
                                    </td>
                                    <td width="30%" style="border-left:none; text-align:center;" class="mobileandi">
                                        <span><?php echo $post['title'] ?></span>
                                    </td>
                                    <td width="15%" align="center" class="mobileandi">
                                        <?php echo num_to_price($v['price']) ?>                                         
                                    </td>
                                    <td width="10%" align="center" class="mobileandi">
                                        <input type="number" data-id="1216" data-price="32000000" name="product1216" value="<?php echo $v['num'] ?>" class="cart-item-num" maxlength="3" size="2" style="text-align:center; border:1px solid #F0F0F0;width:40px">
                                        <p class="update-cart-item"  particular="<?php echo $k ?>">Cập nhật</p>
                                    </td>                  
    
                                    <td width="15%" align="center" class="price_tt mobileandi">
                                         <?php echo num_to_price($v['price']* $v['num']) ; ?>                                            
                                    </td> 
    
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="total-order" style="width:100%;float:left;margin-top:10px;text-align: right;">
                        <b style="color:red">Tổng tiền : <span class="last_tt"><?php echo num_to_price($total_price) ?> vnđ</span></b>
                    </div> 
                    <div class="clear"></div>
                </div>
            </div>
              

        <?php
    }
    
    function totalpr(){
        global $g_user;
        ?>
          <?php
            $totalpr = 0;
            if(trim($_SERVER['REQUEST_URI'],'/') !== 'checkout'){
        		if(isset($_COOKIE['cart']))
        		{
        			$lists = json_decode($_COOKIE['cart'], TRUE);
        			if(count($lists) > 0) {
        			   	foreach($lists as $k=>$v){
            				$totalpr += $v['num'];
                        } 
        			}
        		}else {
                    $have_product = FALSE;
                    $lists = array();
                }
                
                if($totalpr > 0){
                    ?>
                    <span class="badge badge-warning" id="lblCartCount"><?php echo $totalpr; ?></span>
                    <?php
                }
            }
            
        ?>
        <?php
    }
    
    function removecart(){
        global $g_user;
        ?>
          <?php
            
    		if(isset($_COOKIE['cart']))
    		{
    		    $lists = array();
    		    $lists = json_decode($_COOKIE['cart'], TRUE);

                setcookie('cart', '', time() + 3600 * 24 * 3, '/');
    		}
    		if(isset($_COOKIE['datakhach']))
    		{
    		    $lists = array();
    		    $lists = json_decode($_COOKIE['datakhach'], TRUE);

                setcookie('datakhach', '', time() + 3600 * 24 * 3, '/');
    		}
         
        ?>
        <?php
    }
    
    function checkout(){
        global $g_user;
        ?>
            <?php
            if(isset($_COOKIE['datakhach']))
    		{
                $totalpr = 0;
                $allPrice = 0;
                $total_price = 0;
        
        		if(isset($_COOKIE['cart']))
        		{
        			$lists = json_decode($_COOKIE['cart'], TRUE);
        			if(empty($lists)) $have_product = FALSE;
        			else $have_product = TRUE;
        		}else {
                  $have_product = FALSE;
                  $lists = array();
                }
        
                if(count($lists) > 0) {
                    foreach($lists as $k=>$v){
        				$post = get_post($k);
        				$total_price = $total_price +  $v['price'] * $v['num'];
        				$totalpr += $v['num'];
                    }
                }
            
    	    ?>
    			<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">
                  Cảm ơn quý khách đã đặt hàng tại Noithatzip.com
                </h1>
                <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                  <strong>Noithatzip.com</strong> rất vui thông báo đơn hàng #18072020104322 của quý khách đã
                      được tiếp nhận và đang trong quá trình xử lý. Nội Thất ZIP sẽ thông báo đến quý khách
                  ngay khi hàng chuẩn bị được giao.
                </p>
                <br>
                <div style="display: flex;">
                   <div class="thongtintrai v-col-sm-6"  style="width: 50%;">
                        <p>Người đặt hàng: <strong><?php echo json_decode($_COOKIE['datakhach'])[0]->name; ?></strong></p> 
                        <br>
                        <p>Số Điện Thoại: <strong><?php echo json_decode($_COOKIE['datakhach'])[0]->phone; ?></strong></p>
                   </div>
                   <div class="thongtinphai v-col-sm-6"  style="width: 50%;">
                        <p>Địa Chỉ: <strong><?php echo json_decode($_COOKIE['datakhach'])[0]->place; ?></strong></p> 
                        <br>
                        <p>Hình Thức Thanh Toán: <strong><?php echo json_decode($_COOKIE['datakhach'])[0]->other_info; ?></strong></p>
                   </div>
                </div>
                <br>
                <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>
                <div class="box_dh">
                   
                   <div class="table-responsive">
                      <table class="table table-bordered service-list" border="0" cellpadding="5px" cellspacing="1px" style="font-size:12px;" width="100%">
                         <tbody>
                            <tr style="font-weight:bold;color:#111;border-top:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;height:30px">
                              
                               <th style="text-align:center;  text-transform:uppercase;">Hình ảnh</th>
                               <th style="text-align:center; text-transform:uppercase;">Tên sản phẩm</th>
                               <th align="center" style="text-transform:uppercase;" class="mobileandi">Đơn giá</th>
                               <th align="center" style="text-transform:uppercase;" class="mobileandi">SL</th>
                               <th align="center" style="text-transform:uppercase;" class="mobileandi">Thành tiền</th>
                            </tr>
                            <?php
                                $total_price = 0;
                                if($have_product){
                                foreach($lists as $k=>$v){
                                    $post = get_post($k);
                                    $total_price = $total_price +  $v['price'] * $v['num'];
                                    if(empty($post['image'])) $post['image'] =  SITE_URL . '/inc/images/noimage.png';
                 
                                    if(!empty($post['image'])) $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200';
                                    else $image = CDN_TIMTHUMB . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/tpl/default/images/noimage.png&w=300&h=200';
                            ?>
                            <tr class="mausole" style="background:#f5f5f5;border-bottom:1px solid #e4e4e4" id="cart-item-202">
                               <td width="15%" style="border-left:none; text-align:center;padding:10px 0px 8px 0px">
                                  <img style="max-height: 100px;" src="<?php echo $image ?>" alt="<?php echo $post['title'] ?>"/>
                               </td>
                               <td width="30%" style="border-left:none; text-align:center;" class="mobileandi">
                                  <span><?php echo $post['title'] ?></span>
                               </td>
                               <td width="15%" align="center" class="mobileandi">
                                   <?php echo num_to_price($v['price']) ?>                                                 
                               </td>
                               <td width="10%" align="center" class="mobileandi">
                                  <?php echo $v['num'] ?>
                               </td>
                               <td width="15%" align="center" class="price_tt mobileandi">
                                  <?php echo num_to_price($v['price']* $v['num']) ; ?>                                           
                               </td>
                            </tr>
                            <?php }} ?>
                         </tbody>
                         
                      </table>
                   </div>
                  
                   <div class="total-order" style="width:100%;float:left;margin-top:10px;text-align: right;">
                      <b style="color:red">Tổng tiền : <span class="last_tt"><?php echo num_to_price($total_price) ?>  vnđ</span></b>
                   </div>
                   <div class="clear"></div>
                </div>
            <?php
    		}else {
                header("Location: https://noithatzip.com/");
            }
            ?>
        <?php
    }
    
    function format_string($text)
    {
    	return  "'".$text."'";
    }

    
}
