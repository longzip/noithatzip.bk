$("document").ready(function(){
    
    var ajax_href = site_url + '/admin/?page_type=extensions-ajax';
    
    function set_preview()
    {
        setTimeout(function(){
            $("#type").val("FixedHotline_preview");
            $.ajax({
                url:ajax_href,
                type:"post",
                data:$("#main-content form").serialize(),
                success:function(data){
                     $(".desktop-preview-inner").html(data);
                     
                     $(".hotline-fixed").css("opacity", 0);
                     setTimeout(function(){
                        $(".hotline-fixed").css("opacity", 1);
                    }, 500);
                }
            });
        }, 1000);
    }
    
    set_preview();
    
    $("body").on("click", ".position-item", function(){
        var par = $(this).attr("par");
        $(".position-item").removeClass("active");
        $(this).addClass("active");
        $(".input_position").val(par);
        
        var active = $(this).attr("active");
        $(".tlrb-content span.position-name").css("display", "none");
        $(active).css("display", "inline-block");
        set_preview();
    }); 
    
    $("span.position-item.active").click();
    
    $("body").on("click", ".tlrb-title", function(){
        $(".tlrb-content").slideToggle("none");
    }); 
    
    
    
    $("#new-post-col-1-inner input, #new-post-col-1-inner select").change(function(){
        set_preview();
    });
    
    $(".bgrins-spectrum").spectrum({  
        preferredFormat: "hex",
        showInput: true,
        showSelectionPalette: false,
        showAlpha: true,
        showPalette: true,
        palette: [["red", "rgba(0, 255, 0, .5)", "rgb(0, 0, 255)"]],
        change: function(color) {             
           
        }
    });
    
     
    $("body").on("click", ".view-popup", function(){
        var popup_name = $(this).attr("popup_name");
        
        $(".popup-" + popup_name + ", .opacity").addClass("active");
         
    }); 
    $("body").on("click", ".close-popup", function(){
        $(".popup, .opacity").removeClass("active");
    });
    $("body").on("click", ".display_style-item img", function(){
        var par = $(this).attr("par");
        $(this).addClass("active");
        $(".input_display_style").val(par);
        $(".display_style-name").text(" ( " + par + " ) ");
        $(".popup, .opacity").removeClass("active");
        set_preview();
    });
    
    
    $("body").on("submit", "form", function(e){
        e.preventDefault();
        $("#type").val("FixedHotline_submit");
        $.ajax({
            url:ajax_href,
            type:"post",
            data:$("#main-content form").serialize(),
            success:function(data){
                console.log(data);
                var data_arr = data.split('010516');
                $(".noti").remove();
                
                $("#save").append(data_arr[1]);
                
                setTimeout(function(){
                    $(".noti").css("opacity", 0);
                }, 3500);
            }
        });
    });
      
}); 