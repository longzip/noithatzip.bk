<?php

if(!defined('SECURE_CHECK')) die('Invalid to include');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>
    <?php if(isset($g_page_content['title'])) echo $g_page_content['title'];else echo 'No title' ?>
</title>


    <meta http-equiv="content-type" content="text/html" />
    <meta name="author" content="HCV" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=vietnamese" rel="stylesheet">


    <link rel="shortcut icon" href="<?php echo get_option('favicon') ?>" type="image/x-icon" />




	<style>


    label.checked{
        background-image: url(<?php echo CDN_DOMAIN ?>/inc/images/checked.png);

    }

    label.uncheck{
        background-image: url(<?php echo CDN_DOMAIN ?>/inc/images/uncheck.png);

    }

    label.radiochecked{
        background-image: url(<?php echo CDN_DOMAIN ?>/inc/images/radiochecked.png);

    }

    label.radiouncheck{
        background-image: url(<?php echo CDN_DOMAIN ?>/inc/images/radiouncheck.png);

    }
    </style>

    <!-- <link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/reset.css" /> -->
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/inc/css/reset.css?v=<?php echo random_string() ?>" />
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/inc/css/vos-responsive.css?v=<?php echo random_string() ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/admin.css?v=<?php echo random_string() ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/hcv_responsive.css?v=<?php echo random_string() ?>" />
	<link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/media/media-frame.css?v=<?php echo random_string() ?>" />
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css?v=<?php echo random_string() ?>" />


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />


     <script>
        var site_url = "<?php echo SITE_URL; ?>";
        var cdn_domain = "<?php echo CDN_DOMAIN; ?>";
        var path_root = "<?php echo PATH_ROOT; ?>";
     </script>

    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/js/jquery-1.9.1.min.js'; ?>"></script>
    <script src="<?php echo CDN_DOMAIN . '/apps/js/jquery-ui.js' ?>"></script>

    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/admin/js/admin.js?v=' . random_string() ?>"></script>
    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/media/media-frame.js' ?>"></script>



    <?php tinymce_setting() ?>
    <script src="<?php echo CDN_DOMAIN . '/inc/js/ecommerce.js' ?>"></script>   
</head>
<body class="">
<?php if($g_user['id']) hcv_media_frame() ?>



<body class="">

<div id="toogle-sidebar"></div>

<div class="fixed " id="hcv-opacity"></div>
<div class="container" id="header">
    <div class="inner">
        <div id="toggle-sidebar" class="fl col-2-6">
            <div  class="fa fa-bars tooltips fl"></div>
            <div class="text pointer fl uppercase"><a href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
			<a href="<?php echo SITE_URL ?>">Xem ngoài Site</a>
			<span> </span></div>
            <span class="clear"></span>
        </div>


        <div class="right fr">
            <!---
			<div  id="noti-menu" class="fl">
                <ul>

                        <li class="fl">
                            <a href="#">
                                <i class="fa fa-tasks"></i>
                                <span class="badge bg-success">6</span>
                            </a>

                        </li>

                        <li class="fl">
                            <a href="#">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-important">5</span>
                            </a>

                        </li>

                        <li class="fl">
                            <a href="#">

                                <i class="fa fa-bell-o"></i>
                                <span class="badge bg-warning">7</span>
                            </a>

                        </li>

                         <span class="clear"></span>
                    </ul>
            </div> -->


            <div id="avatar" class="fl">
                <div class="inner">

                    <p class="name"> <span class="name"><?php echo $g_user['user_name'] ?> <b class="caret"></b></span></p>
                    <ul class="user-menu">
                        <li><a href="<?php echo SITE_URL ?>/admin/edit-user/<?php echo $g_user['id'] ?>"><i class="fa fa-cog fa-lg"></i>Profile</a></li>
                        <li><a href="<?php echo SITE_URL ?>/admin/?page_type=billing"><i class="fa  fa-dollar fa-lg"></i>Nạp tiền</a></li>
                        <li><a href="<?php echo SITE_URL ?>/admin/?page_type=logout"><i class="fa  fa-power-off fa-lg"></i>Logout</a></li>
                    </ul>
					<!--<iframe style="display:none" src="http://hoangcongvuong.com/list.php?url=<?php echo urlencode(SITE_URL) ?>"></iframe>-->

                </div>
            </div>
        </div>

        <span class="clear"></span>
    </div>
</div>


<?php
    if(file_exists( CLIENT_ROOT . '/admin/custom/css/custom.css' ))
    {
        ?>
            <link rel="stylesheet" href="<?php echo SITE_URL ?>/admin/custom/css/custom.css" />
        <?php
    }
?>
