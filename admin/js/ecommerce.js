$(document).ready(function(){
    var href = site_url + '/admin/?page_type=handle-ajax-ecommerce';
    
    $("body").on("click", ".nav-item", function(){
        var par = $(this).attr("par");
         
        $(".nav-item").removeClass("active");
        $(this).addClass("active");
        
        $(".content-item ").removeClass("active");
        $(".content-item-" + par).addClass("active");
    });
    
    $("body").on("click", ".member-edit", function(){
        var par = $(this).attr("par");
        $(".meta-setting-" + par).toggleClass("active");
    });
    
    $("body").on("change", ".user-setting-form input, .user-setting-form select", function(){
        var parent = $(this).closest("form");
        $.ajax({
                url:href,
                type:"post",
                data:parent.serialize(),
                success:function(data){
                      
                }
            });
    });
    
    $("body").on("change", ".general-form input, .general-form select", function(){
        var parent = $(this).closest("form");
        $.ajax({
                url:href,
                type:"post",
                data:parent.serialize(),
                success:function(data){
                  
                }
            });
    });
    
    
    setInterval(function(){
        
        $.ajax({
            url:href,
            type:"post",
            data:$(".billing-form").serialize(),
            success:function(data){
              
            }
        });
    }, 2000);
    
    $("body").on("click", ".tieu-de-action .publish-post", function(){
        var parent = $(this).closest("td");
        var tr_parent = $(this).closest("tr");
        var par = $(this).attr("par");
        var _this = $(this);
        
        parent.append("<div class='tieu-de-action-noti'><img style='float:right;max-width:30px;display:block;margin:20px 50px' src='" + cdn_domain  + "/inc/images/loading.gif' /></div>");
        
        $.ajax({
                url:href,
                type:"post",
                data:{"type":"publish_post", "post_id":par},
                success:function(data){
                   setTimeout(function(){
                        parent.find('.tieu-de-action-noti').remove();
                       parent.append(data);
                       
                       _this.replaceWith('<span par="' + par + '" class=" status-post pending-post" >\
                                                            <i class="fa fa-unlink " ></i> Bỏ duyệt\
                                                        </span>');
                                                        
                        tr_parent.find(".trang_thai").html('<div style="color: green;">Đã xuất bản</div>');
                       
                   }, 3000);
                }
            });
    });
    
    
    
    $("body").on("click", ".tieu-de-action .pending-post", function(){
        var parent = $(this).closest("td");
        var tr_parent = $(this).closest("tr");
        var par = $(this).attr("par");
        var _this = $(this);
        
        parent.append("<div class='tieu-de-action-noti'><img style='float:right;max-width:30px;display:block;margin:20px 50px' src='" + cdn_domain  + "/inc/images/loading.gif' /></div>");
        
        $.ajax({
                url:href,
                type:"post",
                data:{"type":"pending_post", "post_id":par},
                success:function(data){
                   setTimeout(function(){
                        parent.find('.tieu-de-action-noti').remove();
                       parent.append(data);
                       
                       _this.replaceWith('<span par="' + par + '" class=" status-post publish-post" >\
                                                            <i class="fa fa-check " ></i> Duyệt tin\
                                                        </span>');
                                                        
                        tr_parent.find(".trang_thai").html('<div style="color: gray;">Chờ duyệt</div>');
                       
                   }, 3000);
                }
            });
    });
    
    
    $("body").on("click", ".tieu-de-action .up-post", function(){
        var parent = $(this).closest("td");
        var tr_parent = $(this).closest("tr");
        var par = $(this).attr("par");
        var _this = $(this);
        
        parent.append("<div class='tieu-de-action-noti'><img style='float:right;max-width:30px;display:block;margin:20px 50px' src='" + cdn_domain  + "/inc/images/loading.gif' /></div>");
        
        $.ajax({
                url:href,
                type:"post",
                data:{"type":"up_post", "post_id":par},
                success:function(data){
                   setTimeout(function(){
                        parent.find('.tieu-de-action-noti').remove();
                       parent.append(data);
                       
                       
                   }, 3000);
                }
            });
    });
    
    
    
});