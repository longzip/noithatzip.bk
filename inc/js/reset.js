//alert(window.location.href );
var t_current_url = window.location.href;
if( t_current_url.indexOf("#_=_") != -1 )
{
    window.location.href = t_current_url.replace("#_=_", "");
}


$(document).ready(function() {
    var screen_width = window.innerWidth;

    function set_body_screen_class() {
        screen_width = window.innerWidth;
        if (screen_width <= 399) {
            $("body").removeClass("screen-lg screen-md screen-sm screen-xs screen-tx").addClass("screen-tx");
        }
        if ((screen_width > 400) && (screen_width <= 767)) {
            $("body").removeClass("screen-lg screen-md screen-sm screen-xs screen-tx").addClass("screen-xs");
        }
        if ((screen_width > 768) && (screen_width <= 991)) {
            $("body").removeClass("screen-lg screen-md screen-sm screen-xs screen-tx").addClass("screen-sm");
        }
        if ((screen_width > 992) && (screen_width <= 1199)) {
            $("body").removeClass("screen-lg screen-md screen-sm screen-xs screen-tx").addClass("screen-md");
        }
        if ((screen_width > 1200)) {
            $("body").removeClass("screen-lg screen-md screen-sm screen-xs screen-tx").addClass("screen-lg");
        }
    }
    set_body_screen_class();
    $(window).resize(function() {
        set_body_screen_class();
    });
    if (window.innerWidth < 991) $("body").addClass("on-mobile").attr("id", "body-on-mobile");

    function text_image_scroll() {
        $(".block_area_tabs-content-item.active").addClass("temp_active");
        $(".block_area_tabs-content-item").addClass("active");
        setTimeout(function() {
            $(".block_area_tabs-content-item").removeClass("active");
            $(".block_area_tabs-content-item.temp_active").addClass("active");
        }, 1000);
        if (($(window).width() <= 991) && ($(window).width() >= 767)) {
            $("body").find(".block-TextImage").each(function() {
                var block_id = $(this).attr("id");
                var min_height = 9999;
                $(this).find(".v-TextImage-col").each(function() {
                    if ($(this).height() < min_height) min_height = $(this).show().height();
                });
                $("#" + block_id + " .v-TextImage-col").height(min_height);
            });
        }
    }
    text_image_scroll();
    $(window).scroll(function() {
        var body_top = $(window).scrollTop();
        if (body_top > 400) $(".go-to-top").addClass("active");
        else $(".go-to-top").removeClass("active");
    });
    $(".go-to-top").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    });
    var fos_stt = 1;
    var begin_top = new Array();
    var begin_bottom = new Array();
    setTimeout(function() {}, 1000);
    var fixed_on_scroll_first_time = 0;
    $(window).scroll(function() {
        fos_stt = 1;
        $("body").find(".fixed-on-scroll").each(function() {
            if ($(this).hasClass("has-fixed-on-scroll")) return;
            var _this = $(this);
            $(this).addClass("fixed-on-scroll-" + fos_stt).addClass("has-fixed-on-scroll");
            begin_top[fos_stt] = _this.offset().top;
            begin_bottom[fos_stt] = begin_top + _this.height();
            fos_stt++;
        });
        fos_stt = 1;
        $("body").find(".fixed-on-scroll").each(function() {
            if (!$(this).hasClass("on-mobile"))
                if ($(window).width() < 768) return;
            var body_top = $(document).scrollTop();
            var _this = $(this);
            var fixed_w = _this.width();
            _this.width(fixed_w);
            var current_fixed_top_element = _this.offset().top;
            if (body_top > begin_top[fos_stt]) {
                _this.addClass("fixed");
            } else {
                _this.removeClass("fixed");
            }
            var fixed_w = _this.width();
            _this.width(fixed_w);
            fos_stt++;
        });
        fixed_on_scroll_first_time = 1;
    });
    $("document").ready(function() {
        setTimeout(function() {
            $("body").find("svg").each(function() {
                var this_svg = $(this);
                var svg_width = this_svg.closest(".v-wrap-full").width();
                $(this).find("image").each(function() {
                    var scale = $(this).attr("width") / $(this).attr("height");
                    this_svg.height(svg_width / scale);
                    
                    var src = $(this).attr("src");
                    //this_svg.parent().append('<img class="mb-tong" src="' + src + '" />');
                });
                
                
            });
        }, 1000);
    });
    $(window).resize(function() {
        setTimeout(function() {
            $("body").find("svg").each(function() {
                var this_svg = $(this);
                var svg_width = this_svg.closest(".v-wrap-full").width();
                $(this).find("image").each(function() {
                    var scale = $(this).attr("width") / $(this).attr("height");
                    this_svg.height(svg_width / scale);
                });
            });
        }, 1000);
    });
    $(".svg-map polygon").click(function() {
        var data_src = $(this).attr("data-src");
        $(".module-matbang img").attr("src", data_src);
        $(".module-matbang-opacity, .wrap-module-matbang").addClass("active");
    });
    $(".module-matbang-close ").click(function() {
        $(".module-matbang-opacity, .wrap-module-matbang").removeClass("active");
    });
    $("body").find("iframe").each(function() {
        var _this = $(this);
        var w = _this.attr("width");
        var h = _this.attr("height");
        var undefined_src = $("body").attr("sdfdsfewrwer");
        if ((w == undefined_src) || (h == undefined_src)) return;
        var scale = w / h;
        setTimeout(function() {
            var real_w = _this.width();
            _this.height(real_w / scale);
        }, 1000);
    });
    
    //Common Handle Ajax
    setTimeout(function() {
        $.ajax({
    		url:site_url + '/inc/?page_type=handle-ajax-common',
    		type:"post",
    		data:{type:"clear_smarty_cache"},
    		success:function(data){
    			 
    		}
    	});
    }, 3000);    
    // #END Common Handle Ajax
     
    
    $("input[name='url']").val(current_url); 
    
    var expend_stt = 1;
    $("body").find(".v-expend").each(function(){
        var _this = $(this);
        _this.addClass("v-expend-" + expend_stt);
        var this_height = $(this).height();
        
       
        
        var max_height = $(this).attr("max-height");
        if(max_height == undefined) max_height = 100;
        if(this_height > max_height)
        {
            _this.css("height", max_height + "px").css("overflow","hidden");
            $('<div par="' + expend_stt + '" class="expend-button expend-button-' + expend_stt + '">Xem thêm</div>').insertAfter(".v-expend-" + expend_stt); 
        }
        _this.attr("ori-height", this_height);
        _this.attr("max-height", max_height);
        expend_stt++; 
    });
    
   $("body").on("click", ".expend-button", function(){
        $(this).toggleClass("clicked");
        var par = $(this).attr("par");
        var ori_height = $(".v-expend-" + par).attr("ori-height");
        var max_height = $(".v-expend-" + par).attr("max-height");
        
         
         
        
        if(!$(this).hasClass("clicked"))
        {
           $(".v-expend-" + par).css("height", max_height + "px");
           $(this).text("Xem thêm");
           
        }
        else
        {
            $(".v-expend-" + par).css("height", ori_height + "px");
            $(this).text("Rút gọn");
        }
        
   }); 
   
   
   $("body").on("click", ".posts-readmore-ajax", function(){
        var _this = $(this);
        _this.css({"display": "none"});
        $('<img class="loading-posts-image" src=" ' + cdn_domain + '/inc/images/ajax-posts.gif" />').insertAfter(_this);
         
        
    
        var block_content = $(this).closest(".core-block").find(".block-content");
        
        var box = $(this).attr("box");
        var current_page = $(this).attr("current_page");
        var posts_per_page = $(this).attr("posts_per_page");
        var post_type = $(this).attr("post_type");
        var order = $(this).attr("order");
        var category = $(this).attr("category");
        
        
        
        $.ajax({
    		url:site_url + '/inc/?page_type=ajax-reset',
    		type:"post",
    		data:{type:"load_more_posts", "box": box, "current_page": current_page, "posts_per_page": posts_per_page, "post_type": post_type, "order": order, "category": category},
    		success:function(data){
    			block_content.append(data); 
                _this.css({"display": "block"});
                $(".loading-posts-image").remove();
                _this.attr("current_page", parseInt(current_page) + 1);
    		}
    	});
   });
    
});