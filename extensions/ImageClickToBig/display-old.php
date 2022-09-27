<style>
.module-ImageClickToBig-close {
    position: absolute;
    width: 40px;
    height: 40px;
    background: #b60742;
    top: 0;
    color:#fff;
    font-size:40px;
    right: 0;
    z-index: 2;
    background-size: 100%;
    cursor: pointer;
    line-height:40px;
    text-align:center;
}

.wrap-module-ImageClickToBig{
     -webkit-box-align: center;
    -webkit-box-orient: vertical;
    -webkit-box-pack: center;
    display: -webkit-box;
    left: 0;
    overflow: auto;
    perspective: 1px;
    position: fixed;
    top: 0;
    transition: 200ms opacity;
}

.module.module-ImageClickToBig { 
    text-align: center;
    height: 100%;
    position: relative;
    z-index:1000;
       display: table-cell;
}

.module-ImageClickToBig-close:hover{
    background:#ef6392;
}

.ImageClickToBig-nav {
    position: fixed;
    top: 50%;
    z-index: 1001;
    background: rgba(255, 255, 255, 0.84);
    width: 35px;
    height: 50px;
    text-align: center;
    line-height: 50px;
    font-size: 32px;
    color: #b60742;
    cursor: pointer;
    top: calc( 50% - 25px );
    /* opacity: 0.9; */
}

.ImageClickToBig-nav.ImageClickToBig-next {
    right: 0;
    border-radius: 3px 0 0 3px;
}

.ImageClickToBig-nav:hover {
    background: #fff;
}

.ImageClickToBig-nav.ImageClickToBig-prev {
    left: 0;
    border-radius: 0 3px 3px 0;
}
</style>
<?php

if(empty($extension_info)) $list_option = array();

$list_option = json_decode($extension_info['attributes'], TRUE);
 
$list_selector = '';
 
if(in_array('custom', $list_option))
{
    $list_selector = $list_selector .  $list_option['custom-selector'] . ' img ';
}
 

//unset($list_option['custom-selector']);
$list_option = array_diff($list_option, array('custom'));
 
?>
<script>    
    var stt = 1;
    $("document").ready(function(){
        $("<?php echo $list_option['custom-selector'] ?>").addClass("ImageClickToBig-item");
        
    });
</script>
<?php

$lists = explode( ',', $list_option['custom-selector']);
foreach($lists as $list)
{
    ?>
    <script>
        $("document").ready(function(){
            
            var stt2 = 1;
            
            $("body").find("<?php echo $list ?>").each(function(){
                 
                 var this_1 = $(this);
                  
                 this_1.addClass("ImageClickToBig-wrap-" + stt).attr("stt", stt);
                 
                 stt2 = 1;
                 $(this).find("img").each(function(){
                    var _this = $(this);
                    _this.attr("stt", stt2).addClass("img-" + stt2);
                    stt2++;
                });
                stt++;
            });
            
             
            
             
            
            $("<?php echo $list ?> img").click(function(){
                
                var window_h = $(window).height();
                var window_w = $(window).width();
                
                
                
                $(this).addClass("clicked");
                var parent = $(this).parent();
                      
                if(parent.prop("tagName") == "A") return;
                ImageClickToBig_stt = $(this).attr("stt");
                ImageClickToBig_current_stt = ImageClickToBig_stt;
            
                var undefined_str = $("body").attr("hcv");
                var src = $(this).attr("src");
                var ori_src = $(this).attr("ori_src");
                
                 
                
                if( ori_src != undefined_str ){                         
                    src = ori_src;
                } 
                 
                
                var add_ = '<div class="wrap-module wrap-module-ImageClickToBig" style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 1000;text-align: center;">\
                                    <div class="module module-ImageClickToBig" style="">\
                                        <div style="text-align:center;width:100%;height: 100%;">\
                                            <img id="ImageClickToBig-main" src="' + src + '">\
                                            <div class="ImageClickToBig-nav ImageClickToBig-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>\
                                            <div class="ImageClickToBig-nav ImageClickToBig-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>\
                                            <div class="module-ImageClickToBig-close">×</div>\
                                        </div>\
                                    </div>\
                                <div class="module-ImageClickToBig-opacity" style="position: fixed;width: 100%;height: 100%;top: 0;left: 0;z-index: 999;background: #000;opacity: 0.7;"></div>\
                            </div>';
                             
                $("body").append(add_);
                
                $(".wrap-module-ImageClickToBig img").css("max-height", window_h - 20 + "px");
            });
        });
    </script>
    <?php
}

foreach($list_option as $k=>$v)
{
    if(empty($list_selector)) $list_selector = $v . ' img ';
    else $list_selector = $list_selector .  ' , ' . $v . ' img ';
} 
   ?>
    <style>
        <?php echo $list_selector ?>  {
            cursor:pointer;
        }
    </style>
    <script>
        $("document").ready(function(){
            var ImageClickToBig_stt = 1;
            var ImageClickToBig_count_image = $("<?php echo $list_selector ?>").size();
            var ImageClickToBig_current_stt = 1;
            
            $("body").find("<?php echo $list_selector ?>").each(function(){
                //$(this).addClass("ImageClickToBig-img ImageClickToBig-img-" + ImageClickToBig_stt).attr("stt", ImageClickToBig_stt);
                //ImageClickToBig_stt ++ ;
            });
             $("<?php echo $list_selector ?>").click(function(){
                     
             });
             
             $("body").on("click", ".module-ImageClickToBig-close", function(){
                    $(".wrap-module-ImageClickToBig").remove();
                    $(".ImageClickToBig-item img").removeClass("clicked");
             });
             
             $("body").on("click", ".ImageClickToBig-nav.ImageClickToBig-prev", function(){
                    
                    var current_ = $(".ImageClickToBig-item .clicked").attr("stt");                    
                    var current_wrap = $(".ImageClickToBig-item .clicked").closest(".ImageClickToBig-item").attr("stt");
                     
                    
                    var parent = $(this).closest(".ImageClickToBig-item");
                    var count_image = $(".ImageClickToBig-wrap-" + current_wrap + " img").size();
                     
                    if(current_ == 1){
                        current_ = count_image;
                    }
                    else current_--;
                     
                    var ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("ori_src");
                    var undefined_str = $("body").attr("hcv");
                    if(ImageClickToBig_current_src == undefined_str ) ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("src");
                    
                    $("#ImageClickToBig-main").attr("src", ImageClickToBig_current_src);                    
                    
                    $(".ImageClickToBig-item img").removeClass("clicked");
                    $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).addClass("clicked");
             });
             
             $("body").on("click", ".ImageClickToBig-nav.ImageClickToBig-next", function(){
                    var current_ = $(".ImageClickToBig-item .clicked").attr("stt");                    
                    var current_wrap = $(".ImageClickToBig-item .clicked").closest(".ImageClickToBig-item").attr("stt");
                     
                    
                    var parent = $(this).closest(".ImageClickToBig-item");
                    var count_image = $(".ImageClickToBig-wrap-" + current_wrap + " img").size();
                    
                    
                    
                    if(current_ == (count_image - 0)){
                        current_ = 1;
                    }
                    else current_++;
                    
                     
                     
                    var ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("ori_src");
                    var undefined_str = $("body").attr("hcv");
                    if(ImageClickToBig_current_src == undefined_str ) ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("src");
                    
                    $("#ImageClickToBig-main").attr("src", ImageClickToBig_current_src);                    
                    
                    $(".ImageClickToBig-item img").removeClass("clicked");
                    $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).addClass("clicked");
                    
             });
             
                         
             $("body").keyup(".wrap-module-ImageClickToBig", function(e){
                    
                    switch(e.keyCode)
                    {
                        case 27 :
                        {
                             
                            $(".wrap-module-ImageClickToBig").remove();
                            break;
                        }
                        case 37 :
                        {
                            var current_ = $(".ImageClickToBig-item .clicked").attr("stt");                    
                            var current_wrap = $(".ImageClickToBig-item .clicked").closest(".ImageClickToBig-item").attr("stt");
                             
                            
                            var parent = $(this).closest(".ImageClickToBig-item");
                            var count_image = $(".ImageClickToBig-wrap-" + current_wrap + " img").size();
                             
                            if(current_ == 1){
                                current_ = count_image;
                            }
                            else current_--;
                             
                            var ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("ori_src");
                            var undefined_str = $("body").attr("hcv");
                            if(ImageClickToBig_current_src == undefined_str ) ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("src");
                            
                            $("#ImageClickToBig-main").attr("src", ImageClickToBig_current_src);                    
                            
                            $(".ImageClickToBig-item img").removeClass("clicked");
                            $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).addClass("clicked");
                            break;
                        }
                        case 39 :
                        {
                            var current_ = $(".ImageClickToBig-item .clicked").attr("stt");                    
                            var current_wrap = $(".ImageClickToBig-item .clicked").closest(".ImageClickToBig-item").attr("stt");
                             
                            
                            var parent = $(this).closest(".ImageClickToBig-item");
                            var count_image = $(".ImageClickToBig-wrap-" + current_wrap + " img").size();
                            
                            
                            
                            if(current_ == (count_image - 0)){
                                current_ = 1;
                            }
                            else current_++;
                            
                             
                             
                            var ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("ori_src");
                            var undefined_str = $("body").attr("hcv");
                            if(ImageClickToBig_current_src == undefined_str ) ImageClickToBig_current_src = $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).attr("src");
                            
                            $("#ImageClickToBig-main").attr("src", ImageClickToBig_current_src);                    
                            
                            $(".ImageClickToBig-item img").removeClass("clicked");
                            $(".ImageClickToBig-wrap-" + current_wrap + " .img-" + current_).addClass("clicked");
                            break;
                        }
                    }
             });
              
        });
    </script>
    
    
    
<?php 
    h($list_option);
?>    