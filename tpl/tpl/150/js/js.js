$("document").ready(function(){
    
    $("#mausac1 img").addClass("active");
    $(".smart-bedroom .block_area_tabs-nav-item.block_area_tabs-nav-item-1 .block_area_tabs-item-inner").html('<img src="http://demo.zmax.vn/5/uploads/smartbedroom/icon/1-mobile.png">');
    $(".smart-bedroom .block_area_tabs-nav-item.block_area_tabs-nav-item-2 .block_area_tabs-item-inner").html('<img src="http://demo.zmax.vn/5/uploads/smartbedroom/icon/2-mobile.png">');
    $(".smart-bedroom .block_area_tabs-nav-item.block_area_tabs-nav-item-3 .block_area_tabs-item-inner").html('<img src="http://demo.zmax.vn/5/uploads/smartbedroom/icon/3-mobile.png">');
    $(".smart-bedroom .block_area_tabs-nav-item.block_area_tabs-nav-item-4 .block_area_tabs-item-inner").html('<img src="http://demo.zmax.vn/5/uploads/smartbedroom/icon/4-mobile.png">');
    $(".v-form-fixed-2").removeClass("active");
    if (window.innerWidth >= 991) {
        $(".v-TextImage-col.v-TextImage-col-left").addClass("wow bounceInRight");
        $(".v-TextImage-col.v-TextImage-col-right").addClass("wow bounceInLeft");
        $(".box7").attr("data-wow-duration", "2.7s").attr("data-wow-delay", "0.2s");
        $(".full-category-inner").addClass("wow bounceInDown").attr("data-wow-duration", "2.2s").attr("data-wow-delay", "0.2s");
    }

    if(window.innerWidth < 768){
        $("#privacy .v-TextImage-col.v-TextImage-col-left").removeClass("v-col-sm-12");
        $("#privacy .v-TextImage-col.v-TextImage-col-left").removeClass("v-col-xs-12");
        $("#privacy .v-TextImage-col.v-TextImage-col-left").removeClass("v-col-tx-12"); 
        $("#privacy .v-TextImage-col.v-TextImage-col-left").addClass("v-col-tx-4"); 
        $("#privacy .v-TextImage-col.v-TextImage-col-left").addClass("v-col-sm-4"); 
        $("#privacy .v-TextImage-col.v-TextImage-col-left").addClass("v-col-xs-4"); 
        $("#privacy .v-TextImage-col.v-TextImage-col-right").removeClass("v-col-xs-12");
        $("#privacy .v-TextImage-col.v-TextImage-col-right").removeClass("v-col-tx-12");
        $("#privacy .v-TextImage-col.v-TextImage-col-right").addClass("v-col-xs-8");
        $("#privacy .v-TextImage-col.v-TextImage-col-right").addClass("v-col-tx-8");
    }
    
    var ori_height = 550;
    var des_height = 0;
     setTimeout(function(){
         des_height = $(".expend-des").height();
         if(des_height >= ori_height)
         {
            $(".expend-des").css("height", ori_height + "px" );
            var append = '<span class="clear"></span>';
            append += '<span class="expend-button">Xem thêm</span>';
            append += '<span class="clear"></span>';
            $(".expend-des-bottom").append(append);
            des_height += 10;
         }
     }, 1000);
     
     $("body").on("click", ".expend-button", function(){
           $(".expend-des").css("height", des_height + "px");
           $(".expend-button").addClass("expend").text("Rút gọn");
     });
     
     $("body").on("click", ".expend-button.expend", function(){
           $(".expend-des").css("height", ori_height + "px" );
           $(".expend-button").removeClass("expend").text("Xem thêm");
     });
     
     $('#fillter-product select').change(function() {
        $(".filter-item-submit input").click();
         
    });
    
    setTimeout(()=>{
        $(".gallery-wrap").removeClass("active");
        $(".gallery-wrap").removeClass("opacityWrap");
        $(".gallery-1").addClass("active");
    }, 1000)
    
    
     $("body").on("click", ".color-sp-text li", function(){
           var colorKey = $(this).attr("key");
           $(".gallery-wrap").removeClass("active");
           $(".gallery-" + colorKey).addClass("active");
           $(".color-sp-text img").removeClass("active");
           $("#mausac"+colorKey + " img").addClass("active");
            
    });
     
    $("#block_area_tabs-show-room-he-thong .block_area_tabs-nav-item").click(function(){
        $(window).resize();
    });

    //Append select
    var total_nav_width = 0;
    // if(false) //screen_width <= 991
    // {
        $("#block_area_tabs-show-room-he-thong .block_area_tabs-nav").append('<select class="block_area_tabs-select none"></select>');
        $("#block_area_tabs-show-room-he-thong").find(".block_area_tabs-nav-item").each(function(){
            total_nav_width = total_nav_width + $(this).outerWidth();
            var par = $(this).attr("the_par");
            var text = $(this).text();

            $("#block_area_tabs-show-room-he-thong .block_area_tabs-nav .block_area_tabs-select").append('<option class="block_area_tabs-option" value="' + par + '">' + text +' </option>');
        });
        // if( screen_width < total_nav_width )
        // {
            $("#block_area_tabs-show-room-he-thong .block_area_tabs-nav-inner ").css("display", "none");
            $("#block_area_tabs-show-room-he-thong .block_area_tabs-select").css("display", "block");
        // }
    // }
    
   
    
    $("body").on("change", ".block_area_tabs-select", function(){
        var _val = $(this).val();
        $("#block_area_tabs-show-room-he-thong .block_area_tabs-nav-item-" + _val).click();
    });
    
    // $(".more-detail .block-html-content").click(function(){
    //     (".v-form-fixed-2").addClass("active"); 
    // });
    $("body").on("click", ".more-detail .block-html-content p", function(){
            $(".v-form-fixed-2").addClass("active"); 
            
    });
    
    $("body").on("click", ".view-cart", function(){
            $(".cartGroup2 input").prop('disabled', true);
            
    });
    
    $(".other-image img").click(function(){
            $(".other-image img").removeClass("active");
            $(this).addClass("active")
            var large_src = $(this).attr("large_src");
            var ori_src = $(this).attr("ori_src")
            $("#main-image").attr("src", large_src).attr("ori_src", ori_src);
            current_slide = $(this).parent().attr("slide_stt");
            $(".v-thumb-image").attr("slide_stt", current_slide);
      });
    //   $('iframe').load( function() {
    //     $('iframe').contents().find("head")
    //       .append($("<style type='text/css'>  ._2p3a{width:100%!important;}  </style>"));
    // });
    
    $(".optionItem").each(function(index) {
        console.log($(this).children().html());
      if($(this).children().first().html().length === 0){
        console.log($(this).children().first());
         $(this).children().first().hide();
    }
    
    });
    // if($(".forum-label").is(':empty')){
    //     console.log(this);
    //      $(this).hide();
    // }
    
});