$(document).ready(function(){
    
	 var ajax_href = site_url + "/inc/?page_type=ecommerce";
	 
	  
	 $("body").on("click", ".log-action .login, .log-action .register, .core-login, .core-register", function(){
	       
           
           $("body").css("position","fixed");
           
	       $(".core-login").attr("par", "login");
           $(".core-register").attr("par", "register");
            
	       var par = $(this).attr("par");
           
           $(".v-wrap-log-form").addClass("active");
           $(".v-log-form-nav-item").removeClass("active");
           $(".v-log-form-nav-item-" + par).addClass("active");
            
    	   $(".form-log").removeClass("active");
           $(".form-" + par).addClass("active");
           
	 });
     
     $("body").on("click", ".close-log-form, .v-log-form-opacity", function(){
           $(".v-wrap-log-form").removeClass("active"); 
           $("body").css("position","initial");
	 });
     
     
     $("body").on("submit", ".form-login", function(e){            
           e.preventDefault();
           $.ajax({
                url:ajax_href,
                type:"post",
                data:$(".form-login").serialize(),
                success:function(data){ 
                    
                    var data_arr = data.split('halelugia');
                    if(data_arr[0] == '0')
                    {
                        $(".form-login .log-warning").html(data_arr[1]);
                        $(".error-noti").slideDown().css("display", "block");
                    }
                    else
                    {
                        $(".form-login").html(data_arr[1]).addClass("register-success");
                    }
                }
            }); 
	 });
     
     
     $("body").on("submit", ".form-register", function(e){
           e.preventDefault();
           $.ajax({
                url:ajax_href,
                type:"post",
                data:$(".form-register").serialize(),
                success:function(data){ 
                    
                    var data_arr = data.split('halelugia');
                    if(data_arr[0] == '0')
                    {
                        $(".form-register .log-warning").html(data_arr[1]);
                        $(".error-noti").slideDown().css("display", "block");
                    }
                    else
                    {
                        $(".form-register").html(data_arr[1]).addClass("register-success");
                    }
                }
            }); 
	 });
     
      $("body").on("click", ".v-log-form-nav-item", function(){
           var par = $(this).attr("par");
           $(".v-log-form-nav-item").removeClass("active");
           $(this).addClass("active");
           $(".form-log").removeClass("active");
           $(".form-" + par).addClass("active");
	 });
     
     
	 $("body").on("click", ".v-add-to-favorite", function(){
           var par = $(this).attr("par");
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"v-add-to-favorite", post_id:par},
                success:function(data){ 
                    $(".wrap-favorite-action").html(data);                  
                }
            }) 
	 });
     
     $("body").on("click", ".v-del-from-favorite", function(){
           var par = $(this).attr("par");
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"v-del-from-favorite", post_id:par},
                success:function(data){ 
                    $(".wrap-favorite-action").html(data);                    
                }
            }) 
	 });
     
     $("body").on("click", ".v-view-favorites", function(){
           
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"v-view-favorites"},
                success:function(data){ 
                    $("body").append(data);                    
                }
            }) 
	 });
     
     
     $("body").on("click", ".v-close-favorites, .v-favorites-opacity", function(){
           $(".v-wrap-favorites").remove();
	 });
     
     $("body").on("click", ".profile-password-title", function(){           
           $(".profile-password").slideToggle();
	 });
     
      
     $("body").on("submit", ".v-profile-form", function(e){
           e.preventDefault();
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:$(".v-profile-form").serialize(),
                success:function(data){ 
                    
                    var data_arr = data.split('halelugia');
                    if(data_arr[0] == '0')
                    {
                        $(".profile-form-noti").html(data_arr[1]);
                    }
                    else
                    {
                        $(".profile-form-noti").html(data_arr[1]).addClass("update-success");
                    }
                                         
                }
            }); 
	 });
     
     //Change profile info
     $("body").on("submit", "form.form-profile", function(e){
        
           e.preventDefault();
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:$("form.form-profile").serialize(),
                success:function(data){ 
                    $(".form-profile .log-warning").html(data);                
                }
            }); 
	 });
     //#END Change profile info
     
     
     
     if($(".core-new-thread-form").size() > 0)
     {
        $.ajax({
            url:ajax_href,
            type:"post",
            data:{"type":"new-thread-form"},
            success:function(data){ 
                $(".core-new-thread-form").html(data);               
            }
        }); 
     }
     
     if($(".core-edit-thread-form").size() > 0)
     {
        $.ajax({
            url:ajax_href,
            type:"post",
            data:{"type":"edit-thread-form", "post_id" : $(".core-edit-thread-form").attr("post_id") },
            success:function(data){ 
                $(".core-edit-thread-form").html(data);
                $(".core-edit-thread-form form").append("<input type='hidden' value='" + $(".core-edit-thread-form").attr("post_id") + "' name='post_id' />");
                $("#type").val("edit-thread-form");            
            }
        }); 
     }
     
     if($(".core-up-tin-form").size() > 0)
     {
        $.ajax({
            url:ajax_href,
            type:"post",
            data:{"type":"up-tin-form", "post_id" : $(".core-up-tin-form").attr("post_id") },
            success:function(data){ 
                $(".core-up-tin-form").html(data);
                 
            }
        }); 
     }
     
     $("body").on("submit", ".core-new-thread-form form", function(e){
             
            e.preventDefault();
            
            var form_data = $(".core-new-thread-form form").serialize();
            
            $(".core-new-thread-form .submit").slideUp();
            $(".core-new-thread-form .error-noti").slideUp();
             
            $(".core-new-thread-form form ").append("<img  class='loading' style='max-width:100px;display:block;margin:20px auto' src='" + cdn_domain  + "/inc/images/loading.gif' />");
            
            
            $.ajax({
                url:ajax_href,
                type:"post",
                data:form_data,
                success:function(data){
                     setTimeout(function(){
                        var data_split = data.split('010516');
                         if(data_split[0] == 'ok')
                         {
                            //$(".core-new-thread-form form .submit").html("<img  class='loading' src='" + cdn_domain  + "/inc/images/loading.gif' />");
                             $(".core-new-thread-form").html(data_split[1]); 
                             $(".core-new-thread-form .loading").remove();  
                         }
                         
                         if(data_split[0] == 'field-require')
                         {
                             $(".core-new-thread-form .error-noti").html(data_split[1]).slideDown();
                             $(".core-new-thread-form .submit").slideDown();
                             
                             
                         }
                         $(".core-new-thread-form .loading").remove();
                     }, 2000);
                }
            }); 
     });
      $("body").on("submit", ".core-edit-thread-form form", function(e){             
            e.preventDefault();
            var form_data = $(".core-edit-thread-form form").serialize();
            
            
            $(".core-edit-thread-form .submit").slideUp();
            $(".core-edit-thread-form .error-noti").slideUp();
            
            $(".core-edit-thread-form form ").append("<img class='loading' style='max-width:100px;display:block;margin:20px auto' src='" + cdn_domain  + "/inc/images/loading.gif' />");
            
            $.ajax({
                url:ajax_href,
                type:"post",
                data:form_data,
                success:function(data){
                     setTimeout(function(){
                        var data_split = data.split('010516');
                         if(data_split[0] == 'ok')
                         {
                            $(".core-edit-thread-form form .submit").html("<img   class='loading' src='" + cdn_domain  + "/inc/images/loading.gif' />");
                             $(".core-edit-thread-form").html(data_split[1]);   
                         }
                         
                         if(data_split[0] == 'field-require')
                         {
                            $(".core-edit-thread-form .submit").slideDown();
                             $(".core-edit-thread-form .error-noti").html(data_split[1]).slideDown();
                         }
                         $(".core-edit-thread-form .loading").remove();
                     }, 2000);
                     
                }
            }); 
     });
     
     
     
     //KhuVuc
     $("body").on("change" , ".tinh_thanh-select", function(){         
        var value = $(this).val();         
        var par = $(this).attr("par");
        var parent = $(this).closest(".khu_vuc-" + par);
        
        
        $.ajax({
            url:ajax_href,
            type:"post",
            data:{type:"load_quan_huyen", value:value },
            success:function(data){                 
                $(".khu_vuc-" + par + " .quan_huyen-select").html(data);
                
                var dia_chi = '';
                var dia_chi_phuong_xa = $(".khu_vuc-" + par + " .phuong_xa-select").val();
                if( (dia_chi_phuong_xa!='0') && (dia_chi_phuong_xa != '') ) dia_chi = dia_chi + dia_chi_phuong_xa + ", ";
                var dia_chi_quan_huyen = $(".khu_vuc-" + par + " .quan_huyen-select").val();
                if( (dia_chi_quan_huyen!='0') && (dia_chi_quan_huyen != '') ) dia_chi = dia_chi + dia_chi_quan_huyen + ", ";
                var dia_chi_tinh_thanh = $(".khu_vuc-" + par + " .tinh_thanh-select").val();
                if( (dia_chi_tinh_thanh!='0') && (dia_chi_tinh_thanh != '') ) dia_chi = dia_chi + dia_chi_tinh_thanh + "";
                $(".khu_vuc-" + par + " .khu_vuc_input").val(  dia_chi  );
                 
                
            }
        });
     });
     
     $("body").on("change" , ".quan_huyen-select", function(){
        var value = $(this).val();
        var par = $(this).attr("par");
        var parent = $(this).closest(".khu_vuc-" + par);
        
         
        $.ajax({
            url:ajax_href,
            type:"post",
            data:{type:"load_phuong_xa", value:value },
            success:function(data){                
                $(".khu_vuc-" + par + " .phuong_xa-select").html(data);
                
                var dia_chi = '';
                var dia_chi_phuong_xa = $(".khu_vuc-" + par + " .phuong_xa-select").val();
                if( (dia_chi_phuong_xa!='0') && (dia_chi_phuong_xa != '') ) dia_chi = dia_chi + dia_chi_phuong_xa + ", ";
                var dia_chi_quan_huyen = $(".khu_vuc-" + par + " .quan_huyen-select").val();
                if( (dia_chi_quan_huyen!='0') && (dia_chi_quan_huyen != '') ) dia_chi = dia_chi + dia_chi_quan_huyen + ", ";
                var dia_chi_tinh_thanh = $(".khu_vuc-" + par + " .tinh_thanh-select").val();
                if( (dia_chi_tinh_thanh!='0') && (dia_chi_tinh_thanh != '') ) dia_chi = dia_chi + dia_chi_tinh_thanh + "";
                $(".khu_vuc-" + par + " .khu_vuc_input").val(  dia_chi  );
                               
            }
        });
     });
     
     $("body").on("change" , ".phuong_xa-select", function(){
        var value = $(this).val();
        var par = $(this).attr("par");
        var parent = $(this).closest(".khu_vuc-" + par);
        
        
        var dia_chi = '';
        var dia_chi_phuong_xa = $(".khu_vuc-" + par + " .phuong_xa-select").val();
        if( (dia_chi_phuong_xa!='0') && (dia_chi_phuong_xa != '') ) dia_chi = dia_chi + dia_chi_phuong_xa + ", ";
        var dia_chi_quan_huyen = $(".khu_vuc-" + par + " .quan_huyen-select").val();
        if( (dia_chi_quan_huyen!='0') && (dia_chi_quan_huyen != '') ) dia_chi = dia_chi + dia_chi_quan_huyen + ", ";
        var dia_chi_tinh_thanh = $(".khu_vuc-" + par + " .tinh_thanh-select").val();
        if( (dia_chi_tinh_thanh!='0') && (dia_chi_tinh_thanh != '') ) dia_chi = dia_chi + dia_chi_tinh_thanh + "";
        $(".khu_vuc-" + par + " .khu_vuc_input").val(  dia_chi  );
        
     });
     
     //#END KhuVuc
     
     $("body").on("click", ".core-show-posts", function(){
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"core-show-posts"},
                success:function(data){ 
                    $(".core-action-detail").html(data);                  
                }
            }); 
	 });
     
     $("body").on("click", ".core-show-active-posts", function(){
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"core-show-active-posts"},
                success:function(data){ 
                    $(".core-action-detail").html(data);                  
                }
            }); 
	 });
     
     $("body").on("click", ".core-show-pending-posts", function(){
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"core-show-pending-posts"},
                success:function(data){ 
                    $(".core-action-detail").html(data);                  
                }
            }); 
	 });
     $("body").on("click", ".core-show-expired-posts", function(){
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"core-show-expired-posts"},
                success:function(data){ 
                    $(".core-action-detail").html(data);                  
                }
            }); 
	 });
    
     $("body").on("click", ".core-show-new-thread", function(){
            var new_thread = site_url + "/dang-tin/#dang-tin"; 
            window.location.href = new_thread;
            location.reload();
     });
        
     $("body").on("click", ".core-delete-post", function(){
           var par = $(this).attr("par");
           if(confirm("Xóa tin " + par))
           {
                $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{type:"core-delete-post", post_id:par},
                    success:function(data){ 
                        $(".tr-" + par).fadeOut();                  
                    }
                }); 
           }            
	 });
     
     $("body").on("click", ".core-show-profile", function(){
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"core-show-profile"},
                success:function(data){ 
                    $(".core-action-detail").html(data);                  
                }
            }) 
	 });
     
     $("body").on("click", ".core-show-nap-tien", function(){
            
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"core-show-nap-tien"},
                success:function(data){ 
                    $(".core-action-detail").html(data);                  
                    stt_tabs = 1;
                    $("body").find(".v-tabs").each(function(){
                        var _this = $(this);
                        _this.addClass("v-tabs-" + stt_tabs).attr("par", stt_tabs);
                        stt_tabs++;
                        
                        var stt_tabs2 = 1;
                        _this.find(".v-tabs-nav-item").each(function(){
                            var _this2 = $(this);
                            if(stt_tabs2 == 1) _this2.addClass("active");
                            _this2.addClass("v-tabs-nav-item-" + stt_tabs2).attr("par", stt_tabs2);
                            stt_tabs2++;
                        });
                        
                        stt_tabs2 = 1;
                        _this.find(".v-tabs-content-item").each(function(){
                            var _this2 = $(this);
                            if(stt_tabs2 == 1) _this2.addClass("active");
                            _this2.addClass("v-tabs-content-item-" + stt_tabs2).attr("par", stt_tabs2);
                            stt_tabs2++;
                        });
                    });
                }
            });
	 });
     
     $("body").on("click", ".change-password-text", function(){
        $(".change-password-text-content").slideToggle();
     });
     
     var my_hash = window.location.hash;
     
     if(my_hash != '')
     {
        my_hash = my_hash.replace( '#', '' );
        $(".core-show-" + my_hash).click();
     }  
     
     
     //Resend active email
     $("body").on("click", ".resend-email-button", function(){
            
            $(".resend-email-button").slideUp();
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"resend-email-button"},
                success:function(data){ 
                    $(".resend-email").append(data);                    
                }
            }) 
	 }); 
     //#END Resend active email
     
     // Change Gia
     $("body").on("keyup", "input.gia", function(){
           var gia = $(this).val(); 
           var _this = $(this);
           var name = $(this).attr("name");
           
           $(".field-item-" + name + "_khoang option:nth-of-type(2)").attr("selected", "selected");
           
           $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"convert-gia", gia:gia},
                success:function(data){
                    _this.val(data);                    
                }
            });
	 }); 
     // #END Change Gia
     
     
     // Reset password
     $("body").on("click", ".forgot-password-text", function(){
           $(".forgot-password-text-content, .form-login-fields").slideToggle(700);
	 });
     
     $("body").on("submit", "form.form-forgot-password", function(e){
            $(".forgot-password-text-content .submit").attr("disabled", "disabled");
            e.preventDefault();
            $.ajax({
                url:ajax_href,
                type:"post",
                data:$("form.form-forgot-password").serialize(),
                success:function(data){
                      $(".forgot-password-noti").html(data).slideDown();
                      $(".forgot-password-text-content .submit").removeAttr("disabled");
                }
            }); 
     });
     
     // #END Reset password
     
     $("body").on("submit", "form#the-cao", function(e){
            //$(".forgot-password-text-content .submit").attr("disabled", "disabled");
            e.preventDefault();
            $.ajax({
                url:ajax_href,
                type:"post",
                data:$("form#the-cao").serialize(),
                success:function(data){
                     
                      $(".nap-the-noti").html(data);
                }
            }); 
     });
     
     $("body").on("click", ".core-up-post", function(e){
            return;
            e.preventDefault();
            
            var parent = $(this).closest("tr");
            var par = $(this).attr("par");
            parent.find(".ready-action").html("<img style='float:right;max-width:30px;display:block;margin:20px 50px' src='" + cdn_domain  + "/inc/images/loading.gif' />");
            
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{"type":"up_tin", "post_id":par},
                success:function(data){
                      setTimeout(function(){
                            parent.find(".ready-action").html(data);
                      }, 1000);
                }
            }); 
     });
     
     
     $("body").on("click", ".xac-nhan-up-tin", function(e){
            e.preventDefault();
            
            var parent = $(this).closest("tr");
            var par = $(this).attr("par");
            parent.find(".ready-action").html("<img style='float:right;max-width:30px;display:block;margin:20px 50px' src='" + cdn_domain  + "/inc/images/loading.gif' />");
            
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{"type":"xac_nhan_up_tin", "post_id":par},
                success:function(data){
                      setTimeout(function(){
                            parent.find(".ready-action").html(data);
                      }, 1000);
                }
            }); 
     });
     
     function calc_uptin_total_price()
     {
         
         var gia = parseInt($(".active.core-list-vip-item").attr("gia"));
         var start_time = $("#up-tin-start_time").val();
         var end_time = $("#up-tin-end_time").val();
         $.ajax({
            url:ajax_href,
            type:"post",
            data:{"type":"cal_before_up_tin", "gia":gia, "start_time":start_time, "end_time":end_time},
            success:function(data){
                  $(".up-tin_col2-content .price").text(data);
                  $("#up-tin_total_price").val(  (data) );
            }
        }); 
     }
     setTimeout(function(){
            calc_uptin_total_price();
      }, 2000);
                      
      $("body").on("change", ".up-tin-form input", function(e){
            calc_uptin_total_price();
      });
      
      $("body").on("click", ".core-list-vip-item", function(e){
            $(".core-list-vip-item").removeClass("active");
            $(this).addClass("active");
            $("#up-tin_vip_cat_id").val( $(this).attr("cat_id") );
            
            
            
            calc_uptin_total_price();
      }); 
      
      $("body").on("submit", ".up-tin-form", function(e){
            e.preventDefault();
            
            
            var form_data = $(this).serialize();
            $(" form.up-tin-form .submit").html("<img style='float:right;max-width:30px;display:block;margin:20px 50px' src='" + cdn_domain  + "/inc/images/loading.gif' />");
            
            setTimeout(function(){
                $.ajax({
                    url:ajax_href, 
                    type:"post",
                    data:form_data,
                    success:function(data){
                        $(" form.up-tin-form .submit").html(data);
                    }
                }); 
            }, 2000);
     });
      
      
});