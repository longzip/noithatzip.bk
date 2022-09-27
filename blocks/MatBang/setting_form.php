<?php
$default = array(
    'title'     => '',
    'content'   => '',
    'polygon_count' => '0',
    'title_link'=> ''
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;

 
//h($default)
?>

<link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/image-map.css" /> 
    
<script>
     
    var upload_button_type = 'ori';
    
     
    
    var stt = <?php  echo $default['polygon_count'] ?>;
    var stt_polygon = <?php  echo $default['polygon_count'] + 1 ?>;
    var auto_fill_content = true;
     
</script>
<script src="<?php echo CDN_DOMAIN ?>/admin/js/image-map.js"></script>   
<script lang="javascript" src="<?php echo CDN_DOMAIN . '/admin/js/media-frame-image-map.js' ?>"></script>


<script>
    $("document").ready(function(){
        $("#view-fill").click(function(e){
            $("#textarea1").toggleClass("none");
            auto_fill_content = false;
        })
    })
</script>


<form id="text_form_setting" class="block_form" block_id="0">
   <?php  display_block_setting_default($default);  ?>
 
 <div class="form-group  none" style="padding: 10px;">
        <label class="block" style="float: none;margin-bottom:10px;" for="name">polygon_count</label>
        
        <textarea id="the-polygon_count" class="form-control parameter" parameter="polygon_count"><?php echo $default['polygon_count'] ?></textarea>
    </div>
    
     <div class="form-group none" id="textarea1" style="padding: 10px;">
        <label class="block" style="float: none;margin-bottom:10px;" for="name">Nội dung</label>
        
        <textarea id="the-content" class="form-control parameter" parameter="content"><?php echo $default['content'] ?></textarea>
    </div>
<div class="fixed" id="hcv-opacity"></div>     
     
    <div class="field-content">
                <div class="field  ">
    		<div class="form-box image fl" id="form-anh_tong_quan">
    			<div class="form-field">
    				<input style="width: 70%;" class="form-control" id="anh_tong_quan"  value="" type="hidden" name="anh_tong_quan" />&nbsp;&nbsp;
    				<input type="button" value="Chọn ảnh" class="show-media-frame-image-map btn btn-info" particular="anh_tong_quan" /> 
    				<span class="anh-tong-quan">( Chọn ảnh mặt bằng tổng quan )</span>
    			</div>
                <br /><br />
                <div id="anh_tong_quan_display" style="max-width: 100%;" >
                                    </div>
    			
    		  
    		</div>
    		<div class="fr" id="button-reset">
                <span class="button" id="reset-remain">Xóa vùng chọn đang vẽ dở</span>
                <span class="button"  id="reset-all">Xóa tất cả vùng chọn</span>
            </div>
            <span class="clear"></span>
    	</div>
    	
    	<span class="clear"></span>
    </div> 
    <div class="first-guider"> ( <strong>Hướng dẫn : </strong> Chọn ảnh mặt bằng tổng quan, sau đó click vào 1 điểm bất kỳ trên ảnh tổng quan để bắt đầu thiết kế mặt bằng ) <span id="view-fill"></span></div>
    <span class="clear"></span>
    <div class="wrap-wrap border-box fl">   
        <div class="wrap-svg-map   " id="wrap-svg-map-1" >
        <?php 
            if(empty($default['content']))
            {
                ?>
                
                    <svg id="svg-map-1" width="364" height="200" style="border : 1px solid yellow" version="1.1" class="svg-map" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 364 200" style="enable-background:new 0 0 364 200;" xml:space="preserve">
                    <image id="svg-map-1-image" style="overflow:visible;" width="364" height="200" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="http://z-land.vn/dothimoi/admin/images/no-image-medium.jpg"></image>
                        
                    </svg>  
                    
                
                <?php
            }
            else echo $default['content'];
        ?>
        </div>
        
    </div>
    <div class="guider border-box fl  ">
        <ul>
            <li><strong>ctrl + Click </strong> : Kết thúc 1 vùng</li>
            <li><strong>shifl + Click </strong> vào vùng chọn : Chọn ảnh ứng với vùng chọn</li>
            <li><strong>delete + Click </strong> : Xóa vùng chọn</li>
        </ul>
        <div class="preview-image">
             
        </div>
    </div>
    <span class="clear"></span>


    
    
</form>