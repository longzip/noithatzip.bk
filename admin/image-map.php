<?php if(!user_can('new-user')) die('00'); ?>
<!DOCTYPE html>
<html>
<head>
    
     <title>Image Map</title>  
    
	 <meta charset="utf-8" />
     
     <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/reset.css" media="all" />
     
	<link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/vos-responsive.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/inc/css/res.css" media="all" />
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/media/media-frame.css" />
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/inc/css/admin.css" /> 
    <link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/image-map.css" /> 
    
    <script>
        var site_url = "<?php echo SITE_URL; ?>"
        var upload_button_type = 'ori';
        var stt = 0;
    </script>
    <script src="<?php echo CDN_DOMAIN ?>/inc/js/jquery-1.10.2.js"></script> 
     
      
    
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
 
    
</head>
 <body> 

<link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/image-map.css" /> 
    
<script>
     
    var upload_button_type = 'ori';
    
     
    
    var stt = 0;
    var stt_polygon = 1;
     
</script>
<script src="<?php echo CDN_DOMAIN ?>/admin/js/image-map.js"></script>   
<script lang="javascript" src="<?php echo CDN_DOMAIN . '/admin/js/media-frame-image-map.js' ?>"></script>





<form id="text_form_setting" class="block_form" block_id="0">
 
 
 <div class="form-group  none" style="padding: 10px;">
        <label class="block" style="float: none;margin-bottom:10px;" for="name">polygon_count</label>
        
        <textarea id="the-polygon_count" class="form-control parameter" parameter="polygon_count">0</textarea>
    </div>
    
     <div class="form-group none" style="padding: 10px;">
        <label class="block" style="float: none;margin-bottom:10px;" for="name">N???i dung</label>
        
        <textarea id="the-content" class="form-control parameter" parameter="content"></textarea>
    </div>
<div class="fixed" id="hcv-opacity"></div>     
     
    <div class="field-content">
                <div class="field  ">
    		<div class="form-box image fl" id="form-anh_tong_quan">
    			<div class="form-field">
    				<input style="width: 70%;" class="form-control" id="anh_tong_quan"  value="" type="hidden" name="anh_tong_quan" />&nbsp;&nbsp;
    				<input type="button" value="Ch???n ???nh" class="show-media-frame-image-map btn btn-info" particular="anh_tong_quan" /> 
    				<span class="anh-tong-quan">( Ch???n ???nh m???t b???ng t???ng quan )</span>
    			</div>
                <br /><br />
                <div id="anh_tong_quan_display" style="max-width: 100%;" >
                                    </div>
    			
    		  
    		</div>
    		<div class="fr" id="button-reset">
                <span class="button" id="reset-remain">X??a v??ng ch???n ??ang v??? d???</span>
                <span class="button"  id="reset-all">X??a t???t c??? v??ng ch???n</span>
            </div>
            <span class="clear"></span>
    	</div>
    	
    	<span class="clear"></span>
    </div> 
    <div class="first-guider"> ( <strong>H?????ng d???n : </strong> Ch???n ???nh m???t b???ng t???ng quan, sau ???? click v??o 1 ??i???m b???t k??? tr??n ???nh t???ng quan ????? b???t ?????u thi???t k??? m???t b???ng )</div>
    <span class="clear"></span>
    <div class="wrap-wrap border-box fl">   
        <div class="wrap-svg-map   " id="wrap-svg-map-1" >
        <svg id="svg-map-1" width="364" height="200" style="border : 1px solid yellow" version="1.1" class="svg-map" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 364 200" style="enable-background:new 0 0 364 200;" xml:space="preserve">
            <image id="svg-map-1-image" style="overflow:visible;" width="364" height="200" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="http://z-land.vn/dothimoi/admin/images/no-image-medium.jpg"></image>  
        </svg>
        </div>
        
    </div>
    <div class="guider border-box fl  ">
        <ul>
            <li><strong>ctrl + Click </strong> : K???t th??c 1 v??ng</li>
            <li><strong>shifl + Click </strong> v??o v??ng ch???n : Ch???n ???nh ???ng v???i v??ng ch???n</li>
            <li><strong>delete + Click </strong> : X??a v??ng ch???n</li>
        </ul>
        <div class="preview-image">
             
        </div>
    </div>
    <span class="clear"></span> 
     
</form>
    <span class="clear"></span>
     
 </body>
</html>