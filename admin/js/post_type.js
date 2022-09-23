$(document).ready(function(){
    var href = site_url +  "/admin/?page_type=handle-ajax-post-type";
    $(".draggable").draggable({revert:"invalid",helper:"clone",connectToSortable:".sortable"});
    $(".sortable").sortable({helper:"clone",
                            revert:true,
                            update:function(event, ui){
                                if(ui.item.attr("field_id") != 0)
                                {
                                    change_stt();
                                }
                                else
                                {
                                    //alert(ui.item.attr("field_id"))
                                    $.ajax({            
                                            url:href,
                                            type:"POST",
                                            data:{type:"before_add_field", post_type_id:$("#content").attr("post_type_id"), field_type:ui.item.attr("field_type")},
                                            success:function(data){
                                                //alert('a');
                                                ui.item.replaceWith(data);
                                                
                                            }
                                        })
                                }
                                
                            }
    });
    
    
    function change_stt()
    {
        var value = new Array();
        var i = 0;
        $("#content").find(".field").each(function(){
            value[i] = $(this).attr("field_id");
            i++;
        })
        $.ajax({            
                url:href,
                type:"POST",
                data:{type:"change_stt", post_type_id:$("#content").attr("post_type_id"), value:value},
                success:function(data){
                    
                    //alert(data);
                    //ui.item.replaceWith(data);
                    
                }
            })
    }
    
    
    var continue_add_field = 1;
    $("body").on("click", "#content .add", function(){
        
        if(continue_add_field == 0) return; 
        continue_add_field = 0;
        
        var field_id = $(this).attr("field_id");
        var current = $(this);
        var parent = $(this).parent().parent();
        var i = 0;
        var key = new Array();
        var value = new Array();
        parent.find(".field_attribute").each(function(){
            key[i] = $(this).attr("attribute_name");
            value[i] = $(this).val();
            i++;
        })
        
        parent.append('<span class="ajax-loading"><img src="' + site_url  + '/inc/images/fb-loading.gif" /></span>');
        
        var tab_display = $("#field-" + field_id + " .tab-display").val();
        
        key[i] = 'field_type';
        value[i] = parent.attr("field_type");
        
         
        
        $.ajax({            
            url:href,
            type:"POST",
            data:{type:"add_field", tab_display:tab_display, page_type:$("#content").attr("page_type"), post_type_id:$("#content").attr("post_type_id"), key:key, value:value},
            success:function(data){
                
                //alert($("#content").attr("post_type_id"))
                 
                if(parseInt(data) == 1)
                {
                    current.replaceWith('<span class="btn btn-info update">Update</span>');
                    
                    $("#field-" + field_id + " .cancel").replaceWith('<span class="delete  delete-field btn btn-danger">Delete</span>');
                    parent.append('<span class="noti success-noti">Success</span>');
                    $("#field-" + field_id + " input.name").attr("disabled", "");
                    change_stt();
                    
                }
                if(data == 'field-exits')
                {
                    parent.append('<span class="noti error-noti">Field name existed</span>');
                }
                if(data =='field-name-invalid')
                {
                    parent.append('<span class="noti error-noti">Field name invalid</span>');
                }
                
                $(".ajax-loading").remove();
                $(".field .noti").css("opacity", '1');
                $(".field .noti").animate({ opacity :'0'}, 5000, function(){($(".field .noti").remove())});
            },
            error:function(){
                alert("error")
            }
        }) 
        
        setTimeout(function(){continue_add_field = 1}, 3000);
    })
    
    
    $("body").on("click", "#content .update", function(){
        $(".noti").css("opacity",1);
        $(".noti").remove();
        var current = $(this);
        var parent = $(this).parent().parent();
        var i = 0;
        var field_id = parent.attr("field_id");
        var key = new Array();
        var value = new Array();
        
        var tab_display = $("#field-" + field_id + " .tab-display").val();
        
        parent.find(".field_attribute").each(function(){
            key[i] = $(this).attr("attribute_name");
            value[i] = $(this).val();
            i++;
        });
        
        parent.append('<span class="ajax-loading"><img src="' + site_url  + '/inc/images/fb-loading.gif" /></span>');
        
        
        key[i] = 'field_type';
        value[i] = parent.attr("field_type");
        
        $.ajax({            
            url:href,
            type:"POST",
            data:{type:"update_field", tab_display:tab_display, field_id:field_id, post_type_id:$("#content").attr("post_type_id"), field_type:parent.attr("field_type"), key:key, value:value},
            success:function(data){
                
               
                
                parent.append('<span class="noti success-noti">Success</span>');
                if(data == 'success')
                {
                    parent.append('<span class="noti success-noti">Success</span>');
                }
                if(data == 'error')
                {
                    parent.append('<span class="noti error-noti">Error</span>');
                }
                
                $(".ajax-loading").remove();
                $(".field .noti").css("opacity", '1');
                $(".field .noti").animate({ opacity :'0'}, 5000, function(){($(".field .noti").remove())});
            },
            error:function(){
                alert("error")
            }
        })
    })
    
     $("body").on("click", "#content .cancel", function(){
        
        var current = $(this);
        var parent = $(this).parent().parent();
         
        
        parent.remove();
        
         
    })
    
    $("body").on("click", ".delete-field", function(){
        if(confirm("ARE U SURE ?"))
        {
            var current = $(this);
            var parent = $(this).parent().parent();
            
             parent.append('<span class="ajax-loading"><img src="' + site_url  + '/inc/images/fb-loading.gif" /></span>');
       
            
            var field_id = parent.attr("field_id");
    
            $.ajax({            
                url:href,
                type:"POST",
                data:{type:"delete_field", field_id:field_id, page_type:$("#content").attr("page_type"), post_type_id:$("#content").attr("post_type_id"), field_type:parent.attr("field_type")},
                success:function(data){
                    if(data=='success') parent.remove();
                    else alert(data);
                    $(".ajax-loading").remove();
                },
                error:function(){
                    alert("error")
                }
            })
        }
    })
    
    $(".field_title").click(function(){
        
    })
    
    $("body").on("keyup", ".field_attribute.title", function(){
        var parent = $(this).parent().parent().parent();
        var val = $(this).val();
        parent.find('.field_title .title-area').each(function(){
            $(this).html(val);
        })
    });
    
    $("body").on("click", "#content .field_title", function(){
        var parent = $(this).parent();
        parent.find('.field_content').each(function(){
            $(this).slideToggle();
        })
    })
    
    $(".all .delete_post_type").click(function(){
        if(confirm("ARE U SURE"))
        {
            var current = $(this);
            var parent = $(this).parent().parent();
    
            var field_id = parent.attr("field_id");
    
            $.ajax({            
                url:href,
                type:"POST",
                data:{type:"delete_post_type", post_type_id:parent.attr("post_type_id")},
                success:function(data){
                    //alert(data)
                    if(data=='1') parent.remove();
                },
                error:function(){
                    alert("error")
                }
            })
        }
    })
})
