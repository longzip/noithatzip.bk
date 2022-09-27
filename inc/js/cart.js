$(document).ready(function(){

	 var ajax_href = site_url + "/inc/?page_type=ajax-cart";

	 function view_cart()
	 {
		$.ajax({
				url:ajax_href,
				type:"post",
				data:{
					type:"display_cart"
				},
				success:function(data2){
					$("#load-cart-image").remove();
					$("body").append(data2);
					// console.warn(data2);
				}
				//error:alert("error")
			})
	 }

	 function display_opacity()
	 {
		$("body").append("<div id='cart-opacity'></div><div id='load-cart-image'><img src='" + cdn_domain + "/inc/images/ajaxloader.gif' /></div>");

	 }

	 function close_cart()
	 {
		$("#load-cart-image, #cart-opacity, #wrap-popup-cart").remove();
		$(".block_area_tabs-content-item.active  .saveCookie").val("no");
	 }

	 $("body").keyup(function(e){

		if(e.keyCode == 27) close_cart()
	 })

     $(".add-to-cart").click(function(){
		display_opacity();

		var product_id = $(this).attr("particular");
		var price = $(this).attr("price");
		console.log(price);

		 setTimeout( ()=>{
			 $.ajax({
	            url:ajax_href,
	            type:"post",
	            data:{
	                type:"add_product_to_cart",
	                product_id:product_id,
					num:1,
					price:price
	            },
	            success:function(data){
	                // view_cart() hiện popup giỏ hàng
	               window.location.href = "/thanh-toan/";
	            }
	            //error:alert("error")
	        });
		 }, 100 );
	 });

	 $("body").on("click", "#empty-cart", function(){
		$.ajax({
				url:ajax_href,
				type:"post",
				data:{
					type:"empty_cart"
				},
				success:function(data2){
					 close_cart();
					 display_opacity();
					 view_cart();
				}
				//error:alert("error")
			})
	 });

	 $("body").on("click", ".close-cart", function(){
		 close_cart();
	 });

	 $(".view-cart").click(function(){
		display_opacity();
		setTimeout( ()=>{
			view_cart();
		}, 2000 );
	 });

	 $("body").on("click", ".asc-num", function(){
			var product_id = $(this).attr("particular");

			var current = parseInt($("#cart-item-" + product_id + " .cart-item-num").val());
			$("#cart-item-" + product_id + " .cart-item-num").val(current + 1);
	 })

	 $("body").on("click", ".desc-num", function(){
			var product_id = $(this).attr("particular");
			var current = parseInt($("#cart-item-" + product_id + " .cart-item-num").val());
			if(current > 1)
			{

				$("#cart-item-" + product_id + " .cart-item-num").val(current - 1);
			}

	 });

	  $("body").on("click", ".delete-cart-item", function(){

		var product_id = $(this).attr("particular");

		close_cart();

		display_opacity();


		 $.ajax({
            url:ajax_href,
            type:"post",
            data:{
                type:"delete_cart_item",
                product_id:product_id
            },
            success:function(data){
                // view_cart() hiện pop up
                location.reload();
            }
            //error:alert("error")
        })
	 });

	 $("body").on("click", ".update-cart-item", function(){

		var product_id = $(this).attr("particular");

		 var num = $("#cart-item-" + product_id + " .cart-item-num").val();

		close_cart();

		display_opacity();

		 $.ajax({
            url:ajax_href,
            type:"post",
            data:{
                type:"update_cart_item",
                product_id:product_id,
				num:num
            },
            success:function(data){
                // view_cart() hiện pop up
                location.reload();
            }
            //error:alert("error")
        })
	 });


	$("body").on("click", ".cartAction", function(e){
    $(".cartActions, .cart-col1").remove();
    $(".cart-col2").addClass("active")
  });

	$("body").on("submit", "#order-form", function(e){
		e.preventDefault();

		var name = $("#order-name").val();
		var place = $("#order-place").val();
		var phone = $("#order-phone").val();
		var email = $("#order-email").val();
		var other_info = $("#other_info").val();


		$.ajax({
            url:ajax_href,
            type:"post",
            data:{
                type:"order",
				name:name,
				place:place,
				phone:phone,
				email:email,
				other_info:other_info
            },
            success:function(data){
                $(".cart-col2").append(data);
				$("#submit-order").remove();
				var my_inter = setInterval(function(){
					var current_time = parseInt($("#order-desc-time").text());
					if(current_time == 0)
					{
						clearInterval(my_inter);
						close_cart();
					}
					else
					{
						$("#order-desc-time").text(current_time - 1)
					}
				},1000);
            }
            //error:alert("error")
        })
	});
	
	$("body").on("submit", "#order-form-marketing", function(e){
		e.preventDefault();

		var name = 'khách nhập thông tin dưới màu sắc';
		var place = 'khách nhập thông tin dưới màu sắc';
		var phone = $("#order-phone").val();
		var email = 'khách nhập thông tin dưới màu sắc';
		var other_info = 'khách nhập thông tin dưới màu sắc';

        var check = (phone.match(/\d/g) || []).length == 10;
        if(check){
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{
                    type:"order",
    				name:name,
    				place:place,
    				phone:phone,
    				email:email,
    				other_info:other_info
                },
                success:function(data){
                    
    				$(".show-text-marketting").removeClass('hidden');
    				var my_inter = setInterval(function(){
    					var current_time = parseInt($("#order-desc-time-tv").text());
    					if(current_time == 0)
    					{
    						$(".show-text-marketting").addClass('hidden');
    					}
    					else
    					{
    						$("#order-desc-time-tv").text(current_time - 1)
    					}
    				},1000);
                }
                //error:alert("error")
            })
        }else{
          alert('Bạn nhập sai định dạng! Hãy bắt đầu bằng số 0 và sđt có 10 số nhé!')
        }

// 		$.ajax({
//             url:ajax_href,
//             type:"post",
//             data:{
//                 type:"order",
// 				name:name,
// 				place:place,
// 				phone:phone,
// 				email:email,
// 				other_info:other_info
//             },
//             success:function(data){
                
// 				$(".show-text-marketting").removeClass('hidden');
// 				var my_inter = setInterval(function(){
// 					var current_time = parseInt($("#order-desc-time-tv").text());
// 					if(current_time == 0)
// 					{
// 						$(".show-text-marketting").addClass('hidden');
// 					}
// 					else
// 					{
// 						$("#order-desc-time-tv").text(current_time - 1)
// 					}
// 				},1000);
//             }
//             //error:alert("error")
//         })
	});
	
	$("body").on("click", "#datthanhtoan", function(e){
		e.preventDefault();

		var name = $("#hoten").val();
		var place = $("#diachi").val();
		var phone = $("#dienthoai").val();
		var email = $("#email").val();
		var phanloai = $("input[name='phuongthuc']:checked").val();;
        if(phanloai == 1){
            var other_info = 'Chuyển khoản qua ATM / ngân hàng';
        }
        if(phanloai == 2){
            var other_info = 'Giao hàng COD';
        }
        if(phanloai == 3){
            var other_info = 'Khác';
        }
        var check = (phone.match(/\d/g) || []).length == 10;
        if(check){
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{
                    type:"order",
    				name:name,
    				place:place,
    				phone:phone,
    				email:email,
    				other_info:other_info
                },
                success:function(data){
                    $.ajax({
                        url:ajax_href,
                        type:"post",
                        data:{
                            type:"add_data_khach",
            				name:name,
            				place:place,
            				phone:phone,
            				email:email,
            				other_info:other_info
                        },
                        success:function(d){
                            
                            window.location.href = "/checkout/";
                        }

                    });
                }
                //error:alert("error")
            })
        }else{
          alert('Bạn nhập sai định dạng! Hãy bắt đầu bằng số 0 và sđt có 10 số nhé!')
        }
	
	});


    $("body").on("submit", "#order-form-tv", function(e){
		e.preventDefault();

	    var name = $("#order-name-tv").val();
	    var place = $("#order-place-tv").val();
		var phone = $("#order-phone-tv").val();
		var email = $("#order-email-tv").val();
		var other_info = $("#other_info_tv").val();

		$.ajax({
            url:ajax_href,
            type:"post",
            data:{
                type:"order",
				name:name,
				place:place,
				phone:phone,
				email:email,
				other_info:other_info
            },
            success:function(data){
                $(".show-text").append('<p style="padding:10px;">ZIP đã nhận thông tin và sẽ liên hệ đến bạn trong thời gian sớm nhất.</p><p style="padding:10px;"> Mọi thông tin xin liên hệ: 0912.99.66.33<p>');

				setInterval(function(){
					var current_time_tv = parseInt($("#order-desc-time-tv").text());
				
					if(current_time_tv == 0)
					{
					    $(".show-text p").remove();
		                $("#order-name-tv").val("");
                        $("#order-place-tv").val("");
                        $("#order-phone-tv").val("");
                        $("#order-email-tv").val("");
            		    $("#other_info_tv").val("");
						
					}
					else
					{
						$("#order-desc-time-tv").text(current_time_tv - 1)
					}
				},1000);
            }
        
        })
	});

	$("body").on("click", ".removeCombo", function(e){
		$(this).text("Đang xoá");
		$.ajax({
					 url:ajax_href,
					 type:"post",
					 data:{
							 type:"removeCombo",
					 },
					 success:function(data){
							 $(".listCombo").empty();
							 $(".removeCombo").remove();
							 $(".cartGroup2 #total-price").remove();
							 $(".cartGroup2 .titlePrice").remove();
							 $("#total-price span").text( $(".cartGroup1 .titlePrice").text().replace('vnđ', '') );
					 }
					 //error:alert("error")
			 })
	});
})
