<?php if(!user_can('new-user')) die('00'); ?>
<!DOCTYPE html>
<html>
<head>
    
     <title>Image Map</title>  
    
	 <meta charset="utf-8" />
     <meta name="description" content="Z-Land thương hiệu thiết kế website bất động sản đẹp, chuyên nghiệp, với khẩu hiệu "Số 1 về hỗ trợ" mang đến hiệu quả, và sự hài lòng nhất cho khách hàng"/>
     
     <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/inc/css/css/reset.css" media="all" />
    
	<link rel="stylesheet" type="text/css" href="css/css.css" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/inc/css/vos-responsive.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/inc/css/css/res.css" media="all" />
   
    <script src="<?php echo SITE_URL ?>/inc/css/js/jquery-1.10.2.js"></script>
    <script src="<?php echo SITE_URL ?>/inc/js/vos-responsive.js"></script>
    <script src="js/js.js"></script>   
     
      
    
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
 
    
</head>
 <body>
    <button id="reset-image-map">Reset</button>
    
    <span class="clear"></span>
    
    <div class="wrap-svg-map" id="wrap-svg-map-1">
        <svg class="svg-map" id="svg-map-1" height="300" width="300" style="border : 1px solid yellow">
                
        </svg>
    </div>
    
    <textarea style="box-sizing:border-box;width: 100%;height:400px;border:1px solid red;padding:5px 10px"></textarea>
    
 </body>
</html>