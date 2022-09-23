<?php
$default = array(
    'title'             => '',
	array(
		'style'			=> 'Flex',
		'timer'			=> 4000,
		'transition'	=> 300,
		'width'			=> 860,
		'height'		=> 350,
        'slides_per_screen' => 1
	),	
	array(
		'image' 		=> '',
		'link'			=> '',
		'title'			=> '',
        'title_link'			=> '',
		'caption'		=> ''
	),
    'block_sub_title'   => ''
    
);


if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;

?>
<?php //tinymce_setting() ?>
 <script src="//cdn.ckeditor.com/4.7.3/basic/ckeditor.js"></script>
 
 <script    lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/tinymce/js/tinymce/jquery.tinymce.min.js?v=' . FRONT_END_VERSION ?>"></script>
    <script    lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/tinymce/js/tinymce/tinymce.min.js?v=' . FRONT_END_VERSION ?>"></script>
    
<script>
	//CKEDITOR.replace( 'content' );
</script>
    <script>
    tinymce.init({
        entity_encoding : "raw",
    	convert_urls: false,
        verify_html: true,
        selector: ".main-content",
        content_css : cdn_domain + "/inc/css/tinymce.css",
        fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 24px 28px 36px",
        setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        })},
        skin:"custom",
        plugins: [
            "textcolor ",
            "searchreplace visualblocks code fullscreen"
            //"insertdatetime media table contextmenu wordcount hcv_upload hcv_youtube  hcv_other_post hcv_image_map hcv_form"
        ],
        menu : {
            //table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
            tools  : {title : 'Tools' , items : 'spellchecker'}
        },
        toolbar: "fontsizeselect   forecolor code "
    });
    </script>


        
<script defer lang="javascript" src="<?php echo CDN_DOMAIN . '/blocks/Slide/setting_form.js?v=', random_string() ?>"></script> 

<script>
    $(document).ready(function(){
		var stt=100;
		 
		$("body").on("click", ".slide-option-item-title", function(){ 
			var particular = $(this).attr("particular");
			
			var src = $(".image-field[particular='" + particular + "']").val();			
			$("#slide-" + particular + " .slide-option-item-content").slideToggle();
			$("#slide-" + particular + " .slide-option-item-title img").attr("src", src);			 
		});
		
		$("body").on("change", ".image-field", function(){   
			var particular = $(this).attr("particular");
			var src=$(this).val();
			$("#slide-" + particular + " .slide-option-item-title img").attr("src", src);
		});
		
		$("body").on("keyup", ".title-field", function(){ 
			 
			var particular = $(this).attr("particular");
			var the_text=$(this).val();
			$("#slide-" + particular + " .slide-option-item-title span").text(the_text);
			
		})
		$("body").on("click", ".remove-slide", function(){
			if(confirm("Xóa ?"))
            {
                $(this).closest(".list-slide-item").remove();
            }
		});
        
        $("body").on("click", ".setting-slide", function(){
            
			var parent = $(this).closest(".list-slide-item");
            $(".slide-option-option-des").addClass("none");
            parent.find(".slide-option-option-des").each(function(){
                $(this).removeClass("none");
            });
		});
	       
        $("body").on("click", ".close-slide-des", function(){
			$(this).parent().addClass("none");
		});
           
		
        $(".sortable").sortable({
            update: function( event, ui ) {
                tinymce.init({
                    entity_encoding : "raw",
                	convert_urls: false,
                    verify_html: true,
                    selector: ".main-content",
                    content_css : cdn_domain + "/inc/css/tinymce.css",
                    setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();
                    })},
                    skin:"custom",
                    plugins: [
                        "textcolor ",
                        "searchreplace visualblocks code fullscreen"
                        //"insertdatetime media table contextmenu wordcount hcv_upload hcv_youtube  hcv_other_post hcv_image_map hcv_form"
                    ],
                    menu : {
                        //table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
                        tools  : {title : 'Tools' , items : 'spellchecker'}
                    },
                    toolbar: "fontsizeselect   forecolor  "
                });
            }
        });
       
        $(".view-advanced").click(function(){
            //$(".advanced").slideToggle();    
        });
        
        setInterval(function(){
            //tinyMCE.triggerSave();
        }, 500);
    });
</script>
 


<form id="menu_form_setting"  class="block_form clearfix slide-form" block_id="0" type="array">

<span class="clear"></span>
<?php
	?>
    
    <?php  display_block_setting_default($default);  ?>
    
    <div class="slide-col slide-col-1 fl border-box">
        <h2 class="h2-title" style="margin-top:0">Cài đặt tổng quan</h2>
        <div class="slide-option-item array_form">
    		<span class="clear"></span>
    		<div class="slide-option-option">
    			<label>Kiểu slide</label>
    			<select class="parameter-depth-1" parameter="style">
    				<?php 
    					$temp_list_style = scandir(dirname(__FILE__) . '/ListSlide');
    					foreach($temp_list_style as $item_list_style)
    					{
    						if(($item_list_style != '..')&&($item_list_style != '.') )
    						{
    						?>
    						<option <?php if($item_list_style == $default[0]['style']) echo ' selected ' ?>  value="<?php echo $item_list_style ?>"><?php echo $item_list_style ?></option>
    						<?php
    						}
    					}
    				?> 
    			</select>
    		</div>
            <span class="clear"></span>
            <div class="clearfix wrap-slide-option">
                <div class="slide-option-option">
        			<label>Chiều rộng</label>
        			<input  class="form-control number parameter-depth-1" parameter="width" type="number" value="<?php echo $default[0]['width'] ?>" />
        		</div>
                <div class="slide-option-option">
        			<label>Chiều cao</label>
        			<input  class="form-control number parameter-depth-1" parameter="height" type="number" value="<?php echo $default[0]['height'] ?>" />
        		</div>
            </div>
            
    		<span class="clear"></span>
    		
    		<div class="clearfix wrap-slide-option">
                <div class="slide-option-option">
        			<label>Thời gian tự động chuyển slide (ms)</label>
        			<input  class="form-control parameter-depth-1" parameter="timer" type="number" value="<?php echo $default[0]['timer'] ?>" />		
        		</div>
        		 
        		<div class="slide-option-option">
        			<label>Thời gian dịch chuyển 1 slide (ms)</label>
        			<input  class="form-control parameter-depth-1" parameter="transition" type="number" value="<?php echo $default[0]['transition'] ?>" />		
        		</div>
            </div>
            
    		<span class="clear"></span>
    		
    		
    		<span class="clear"></span>
    		
    		
    		 <span class="clear"></span>
    		 <div class="view-advanced">Nâng cao</div>
             <div class="advanced none clearfix">
                <div class="slide-option-option">
        			<label>Số slide hiển thị trên 1 màn hình</label>
        			<input  class="form-control parameter-depth-1" parameter="slides_per_screen" type="number" value="<?php echo $default[0]['slides_per_screen'] ?>" />		
        		</div>
                <div class="slide-option-option">
        			<label>Tự động cắt ảnh</label>
        			<select class="parameter-depth-1" parameter="cut_image">
                        <option <?php if($default[0]['cut_image'] == '1') echo ' selected ' ?> value="1">Có</option>
                        <option <?php if($default[0]['cut_image'] == '0') echo ' selected ' ?> value="0">Không</option>
                    </select>		
        		</div>
             </div>
    	</div>
    </div>
    
	
	
	 <div class="slide-col slide-col-1 fl border-box">
        <h2 class="h2-title">Danh sách Slide</h2>
        
         <br />
         <span  class="upload-button new-slide-button fa fa-plus pointer absolute"  ></span>
         <br />
         <input class="none real-upload-button" multiple="multiple" id="hcv_upload_button"  type="file" />
        
        <div id="slide-list" class="sortable clearfix flex-wrap">
		
	<?php
	
	unset($default['title']);
    unset($default['title_link']);
	
     
    $image_multi_count = 0;
    foreach($default as $k=>$v)
	{ 
	    if(empty($v['image'])) continue;
		if($k)
		{
            ?>
    		
             <div class="list-slide-item flex-item slide-option-item array_form" id="slide-<?php echo $k ?>">
    			<div class="slide-option-item-title" particular="<?php echo $k ?>">
        			<img class="title-image" src="<?php echo $v['image'] ?>" />        			 
    			</div>
    			 <span class="clear"></span>
    			<div class="slide-option-item-content">
    				<div class="slide-option-option image">    					 
    					<input type="hidden" particular="<?php echo $k ?>"  class="parameter-depth-1 image-field" id="select_image_<?php echo $k ?>" parameter="image"  value="<?php echo $v['image'] ?>" />                         				
    				</div>
                    
                    <div class="slide-option-option-des none">
                        <span class="clear"></span>
        				<div class="slide-option-option">
        					<label>Liên kết</label>
        					<input  class="form-control parameter-depth-1" parameter="link" type="text"  value="<?php echo $v['link'] ?>" />        				
        				</div>
        				<span class="clear"></span>
        				<div class="slide-option-option">
        					<label>Tiêu đề</label>
        					<input particular="<?php echo $k ?>" class="form-control title-field parameter-depth-1" parameter="title" type="text" value="<?php echo $v['title'] ?>" />
        				</div>
        				<span class="clear"></span>
        				<div class="slide-option-option clearfix">
        					<label>Miêu tả</label>
        					<textarea  class="main-content form-control parameter-depth-1" parameter="caption"><?php echo $v['caption'] ?></textarea>        				
        				</div>
        				
        				<span class="close-slide-des"><i class="fa fa-close"></i></span>
                    </div>
    				
    			 </div>
    			 <span class="clear"></span>
    			 <span class="remove-slide"><i class="fa fa-close"></i></span>
                 <span class="setting-slide"><i class="fa fa-gear"></i></span>
    		</div>
            <?php
    		}
            $image_multi_count++;
        }
    ?>
    			</div>
     </div>
	 
	 
	
	
	
 
</form>