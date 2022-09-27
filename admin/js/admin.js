$(document).ready(function(){
    var href = site_url + '/admin/?page_type=handle-ajax';
    
    
    function convert_string(old)
    {
        var result = "";
        var lowercase = old.toLowerCase();
        var latin = [ ["-", "^", ",", " ", ".", "!", "@", "#", "$", "%", "&", "*", "(", ")", "=", "~", "`"], ["d", "đ"], ["a", "à", "á", "ả", "ã", "ạ", "ă", "ằ", "ắ", "ẳ", "ẵ", "ặ", "â", "ầ", "ấ", "ẩ", "ẫ", "ậ"], ["e", "è", "é", "ẻ", "ẽ", "ẹ", "ê", "ề", "ế", "ể", "ễ", "ệ"], ["i", "ì", "í", "ỉ", "ĩ", "ị"], ["o", "ò", "ó", "ỏ", "õ", "ọ", "ô", "ồ", "ố", "ổ", "ỗ", "ộ", "ơ", "ờ", "ớ", "ở", "ỡ", "ợ"], ["u", "ù", "ú", "ủ", "ũ", "ụ", "ư", "ừ", "ứ", "ử", "ữ", "ự"], ["y", "ỳ", "ý", "ỷ", "ỹ", "ỵ"]]
        var input_array = lowercase.split("");
        var last = true;
        for(x in input_array)
        {        
            last = true;
            if(input_array[x]==" ")
            {
                result+="-";
                continue;   
            }
            for(y in latin)
            {
                
                for(z in latin[y])
                {
                    if( z!=0 )
                    {
                       if(input_array[x] == latin[y][z])
                       {
                         result += latin[y][0];
                         last = false;
                       }
                    }
                }
                                
            }
            if(last == true) result += input_array[x];
            
            //$("body").prepend(input_array[x])
        }
       
        return result;
    }
    
    
	
    
    /**
     * Active current menu
     */
     //alert(location.hostname)
    
    /**
     * Auto create pretty url when write title
     */
    $("#form_content .the_title").change(function(){
        //var title = 
        $("#form_content .the_url.Publish").val(convert_string($("#form_content .the_title").val()))
        $("#form_content .the_url.Add").val(convert_string($("#form_content .the_title").val()))
    });
    

    $(".delete-post").click(function(e){
        e.preventDefault();
        if(confirm('ARE U SURE'))
        {
            var parent = $(this).parent().parent().parent();
            var post_id = $(this).attr("post_id");
             
           
           
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_post",post_id:post_id,},
                success:function(data){
                     
                    if(data == '0') alert("Delete Failed");
                    else parent.slideUp(500,function(){$(this).remove()});
                    
                    
                }
            })
        }
    })
    
    $(".delete-user").click(function(e){
        e.preventDefault();
        if(confirm('ARE U SURE'))
        {
            var parent = $(this).parent().parent().parent();
            var user_id = $(this).attr("user_id");
             
           
           
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_user",user_id:user_id,},
                success:function(data){
                    
                    if(data == '0') alert("Không thể xóa");
                    else parent.slideUp(500,function(){$(this).remove()});
                    
                    
                }
            })
        }
    })
	
	$(".delete-noti").click(function(e){
        e.preventDefault();
        if(confirm('Xóa thông báo này ?'))
        {
             
            var noti_id = $(this).attr("noti_id");
             
           
           
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_noti",noti_id:noti_id,},
                success:function(data){
                    
                    if(data == '0') alert("Delete Failed");
                    else $("#wrap-noti-item-"+noti_id).slideUp();
                    
                    
                }
            })
        }
    })
   
   
    
    
    $(".all .delete_block_area").click(function(){
        var block_area_id = $(this).parent().parent().attr("particular");
        //alert(category_id)
        if(confirm("Are U sure ? "))
        {
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_block_area",block_area_id:block_area_id},
                success:function(data){
                    if(data == '0') alert("Delete Failed");
                    else $(".all div[particular='" + block_area_id + "']").slideUp(500,function(){$(this).remove()});
                    $("#notification").empty().append(data);
                }
            })
        }
        
    });
    
    
    
    
    
    //new from 29-12-2014
    $(".delete-option").click(function(){
        
        var parent = $(this).parent();
        var option_name = $(this).attr("option_name");
        
        parent.css("background", "rgb(247, 169, 66)");
        if(confirm("Are U sure ? "))
        {
            
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_option",option_name:option_name},
                success:function(data){
                    if(data != '1') 
                    {
                        alert(data);
                    }                    
                    else parent.remove();
                }
            })
        }
        else
        {
            parent.css("background", "none");
        }
        
    });
    
    $(".delete-category").click(function(e){
        
        var parent = $(this).parent().parent();
        var category_id = $(this).attr("category_id");
        
        e.preventDefault();
        
        parent.css("background", "rgb(247, 169, 66)");
        if(confirm("Are U sure ? "))
        {
            
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_category",category_id:category_id},
                success:function(data){
                    if(data != '1') 
                    {
                        alert(data);
                    }                    
                    else parent.remove();
                }
            })
        }
        else
        {
            parent.css("background", "none");
        }
        
    });
    
    $(".delete-block-area").click(function(e){
        
        var parent = $(this).parent().parent();
        var block_area_id = $(this).attr("forum_id");
        
        e.preventDefault();
        
        parent.css("background", "rgb(247, 169, 66)");
        if(confirm("Are U sure ? "))
        {
            
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_block_area",block_area_id:block_area_id},
                success:function(data){
                    if(data != '1') 
                    {
                        alert(data);
                    }                    
                    else parent.remove();
                }
            })
        }
        else
        {
            parent.css("background", "none");
        }
        
    });
    
    
    
    $(".delete-tag").click(function(e){
        
        var parent = $(this).parent().parent();
        var category_id = $(this).attr("category_id");
        
        e.preventDefault();
        
        parent.css("background", "rgb(247, 169, 66)");
        if(confirm("Are U sure ? "))
        {
            
            $.ajax({
                url:href,
                type:"post",
                data:{type:"delete_tag",category_id:category_id},
                success:function(data){
                    if(data != '1') 
                    {
                        alert(data);
                    }                    
                    else parent.remove();
                }
            });
        }
        else
        {
            parent.css("background", "none");
        }
        
    });
    
    $(".view-failed").click(function(){
        $("#view-failed").slideToggle();
    })
    
    $(".view-success").click(function(){
        $("#view-success").slideToggle();
    })
	
	$(".toggle-filter").click(function(){
        $("#filter-field").slideToggle();
    })
	
	
	
    $(".get-block-area-code").click(function(e){
         var block_area_id = $(this).attr("forum_id");
         $(".area-code").remove();
         add = "<textarea class='area-code'>&lt;?php views_BlockArea::display_area('" + $("#area-" + block_area_id).attr("area_name") + "') ?&gt;</textarea>"
          $("#area-" + block_area_id).append(add);
    });
    
    $("#field-group span").click(function(){
        var particular = $(this).attr("particular");
        $(".field-group").css("display", "none");
        $("#" + particular).slideToggle();
        
        $("#field-group span").removeClass("active");
        $(this).addClass("active")
    })
    
	$("div#form-order-action a.delete").click(function(e){
		if(!confirm("Thao tác sẽ xóa toàn bộ dữ liệu về đơn hàng này ! \n  Vẫn tiếp tục ?")) e.preventDefault();
		
	});
	
	$("a.order-action.new").click(function(e){
		e.preventDefault();
		var order_id = $(this).attr("order_id")
		
	    $.ajax({
			url:href,
			type:"post",
			data:{type:"handle_order",the_status:"new",order_id:order_id},
			success:function(data){
				 $("#order-item-"+order_id).slideUp();
			} 
		})
	})
	
	$("a.order-action.seen").click(function(e){
		e.preventDefault();
		var order_id = $(this).attr("order_id")
		
	    $.ajax({
			url:href,
			type:"post",
			data:{type:"handle_order",the_status:"seen",order_id:order_id},
			success:function(data){
				 $("#order-item-"+order_id).slideUp();
			} 
		})
	})
	
	$("a.order-action.rac").click(function(e){
		e.preventDefault();
		var order_id = $(this).attr("order_id")
		
	    $.ajax({
			url:href,
			type:"post",
			data:{type:"handle_order",the_status:"rac",order_id:order_id},
			success:function(data){
				 $("#order-item-"+order_id).slideUp();
			} 
		})
	})
	
	$("a.order-action.delete").click(function(e){
		e.preventDefault();
		if(confirm("Xóa đơn hàng ? "))
		{
			var order_id = $(this).attr("order_id")
			
			$.ajax({
				url:href,
				type:"post",
				data:{type:"handle_order",the_status:"delete",order_id:order_id},
				success:function(data){
					 $("#order-item-"+order_id).slideUp();
				} 
			})
		}
	});
    
    $("body").on("click", "label.checked", function(){
        $(this).removeClass("checked");
        $(this).addClass("uncheck");
    })
    
    $("body").on("click", "label.uncheck", function(){
        $(this).removeClass("uncheck");
        $(this).addClass("checked");
    })
    
    $("body").on("click", "label.radio-beautiful", function(){
        var for_attr = $(this).attr("for");
        
        var name_attr = $("#" + for_attr).attr("name");
        
        
        $("label[name_particular='" + name_attr + "']").removeClass("radiochecked").addClass("radiouncheck");
        
        $(this).removeClass("radiouncheck").addClass("radiochecked");
    });
    
      
    function change_fixed()
	{
		var x = y - $(window).scrollTop();
		if( x<0 ) 
		{
			
            
            $("body").find(".fixed-on-scroll").each(function(){
                var _this = $(this);
                if( ($(window).height() - 100) <= $(this).height() ) 
                {
                     $(this).removeClass("fixed");
                     return;
                }
                var parent_width = $(this).width();
                _this.css("width", parent_width + "px"); 
                 
            });
            $(".fixed-on-scroll").addClass("fixed");
			$(".fixed-on-scroll").css({"bottom" : "auto", "top" : "38px"});
		}
		else {$(".fixed-on-scroll").removeClass("fixed");};
		 
		var footer_top = $("#wrap-footer").offset().top;
		var footer_top_height = $("#wrap-footer").height();
		//var remove_fixed = footer_top - $(window).scrollTop();
		var fixed_element_top = $(".fixed-on-scroll").offset().top;
		var fixed_element_height = $(".fixed-on-scroll").height();
		//alert($(".fixed-on-scroll").height());
		if( fixed_element_top +  fixed_element_height >= footer_top )
		{
		   
			$(".fixed-on-scroll").css({"top" : "auto", "bottom" : footer_top_height + "px"});
		}
	}
    
    if($(".fixed-on-scroll").size()!=0)
    {
        var y = $(".fixed-on-scroll").offset().top;
		
		change_fixed();
		
        $(window).scroll(function(){
            change_fixed();
        });
        
        
    };
    
    setTimeout(function(){
        //$("#sidebar .inner").height($("body").height());
    },1000);
    
    $("#toogle-sidebar").dblclick(function(){
        $("#sidebar .none").removeClass("none");
    });
    
    $(".active-module-now").click(function(){
        var extension_name = $(this).attr("extension_name");

        $.ajax({
                url:href,
                type:"post",
                data:{type:"calc_to_active_extension",extension_name:extension_name},
                success:function(data){
                    $(".noti-active-extension").slideUp(600);
                     $(".calc_to_active_extension").html(data).slideDown(600);
                }
            })
    });
    
    $("body").on("click",".xn-mua-module", function(){
        $(this).remove();
        var extension_name = $(this).attr("extension_name");

        $.ajax({
                url:href,
                type:"post",
                data:{type:"xn-mua-module",extension_name:extension_name},
                success:function(data){
                     
                     $(".xn-mua-module-noti").html(data).slideDown(600);
                }
            })
    });
    
    $("body").on("click", ".check-all", function(){
        var child = $(this).attr("child");
		if( $(this).hasClass("fa-square-o") )
		{
			$(".check-" + child ).removeClass("fa-square-o").addClass("fa-check-square-o");
			$(".input-check-" + child).prop('checked', true);
		}
		else
		{
			$(".check-" + child ).addClass("fa-square-o").removeClass("fa-check-square-o");
			$(".input-check-" + child).prop('checked', false);
		}
		 
		
    });
    
    $("body").on("click", "i.check", function(){
		var par = $(this).attr("par");
		if( $(this).hasClass("fa-square-o") )
		{
			$(this).removeClass("fa-square-o").addClass("fa-check-square-o");
		}
		else
		{
			$(this).addClass("fa-square-o").removeClass("fa-check-square-o");
		}
		 
		$("#input-check-" + par).click();
    });
    
    $("body").on("click", "#submit-action-all", function(){
		if(confirm(" Bạn có chắc chắn muốn thực hiện hành động này ? "))
		{
			if($("#action-all select").val() == "del" )
			{
				$("#list-post").find(".input-check-hd").each(function(){
					if( $(this).is(':checked') )
					{
						var id = $(this).attr("par");
						//alert(id);
						var parent = $(this).parent().parent();
						$.ajax({            
							url:href,
							type:"POST",
							data:{type:"delete_post", post_id:id},
							success:function(data){
								//alert(data)
								parent.fadeOut();
							}
						}); 
						parent.click();
						//parent.fadeOut();
					}
					
				});
			}
		}
    });
    
     $(".view-advanced").click(function(){
            $(".advanced").slideToggle();    
        });
    
});
