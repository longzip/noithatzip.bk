 

<?php 
/*
setcookie('current_link', urlencode(CURRENT_URL), time() + 60 * 60 * 24 * 7, '/' );
 
if(isset($_COOKIE['current_link'])) $cookie_current_link = str_replace( ' ', '', urldecode($_COOKIE['current_link']));
else $cookie_current_link = '';

//die($cookie_current_link);
 
if( (CURRENT_URL == SITE_URL + "/admin/?page_type=media-dir") && (!empty( $cookie_current_link ) ) && ( CURRENT_URL != $cookie_current_link ) )
{
    if( (empty($_SERVER['HTTP_REFERER']) ) || ( !strpos( $_SERVER['HTTP_REFERER'] , 'media') ) )
    {
        header('Location:' . $cookie_current_link );
        die();
    }
   
}

*/
 
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Media</title>
	
    <meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="HCV" />
    <meta charset="utf-8" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN . '/inc/css/reset.css' ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN . '/admin/' . 'css/admin.css' ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN . '/media/uploads.css' ?>" />
   
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- Đây là phần hỗ trợ HTML5 và Reponsive trên IE8 -->
    <!-- Chú ý: Respond.js không hoạt động đối với dạng :// chúng ta nên dùng http:// hoặc https:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <script>
        var site_url = "<?php echo SITE_URL; ?>";
        var cdn_domain = "<?php echo CDN_DOMAIN; ?>";
     </script>
    
    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/js/jquery-1.9.1.min.js' ?>"></script>
    
     
    <!--
    <script type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/jquery.lazy-master/jquery.lazy.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.lazyload').Lazy({
                scrollDirection: 'vertical',
                effect: 'fadeIn',
                visibleOnly: true,
                onError: function(element) {
                    console.log('error loading ' + element.data('src'));
                }
            });
            
             
        });         
    </script>
    -->
    <script type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/jquery_lazyload-2.x/lazyload.min.js"></script>
    <script>
        $(document).ready(function(){
            $("img.lazyload").lazyload();
        });         
    </script>
    
    
     
     <?php display_cdn_js('media/uploads.js') ?>
      
</head>
<body>