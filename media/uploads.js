$(document).ready(function(){    
    /**
     * For upload attachment
     */
     
     
     var dir_upload = $("#hcv_upload_button").attr("dir_upload");
     
    $("#virtual_select_file").click(function(){
        $("#hcv_upload_button").click();
    });
    
     
	   var file_item = 1;
       
       var i = 0;
       
       var length_of_files = 0;
       
       var _this;
       
       var j = 0;
       
       function upload_item(dir_upload)
       {
            if(i==length_of_files)
            {
                $("form.uploadform").css("display", "block");
                $("#hcv_upload_button").val("");
                return false;     
            } 
            var data = new FormData();
            data.append('file', _this.files[i]);
            data.append('quality', $("#quality select").val() );
            data.append('max_width', $(".max-upload-width input").val() );
            
            var add = '<div id="upload-item-' + j + '" class="box relative" style="">\
                        <img  class="uploading active pointer" src="' + cdn_domain + '/inc/images/ajaxloader.gif"><br>\
                            <div id="wrap-progress-' + j + '" class="wrap-progress absolute"><span class="percent">0%</span><div id="progress-' + j + '"  class="progress"></div></div>\
                        </div>';
                                       
            $("#display-upload-item").append(add);
            
           
            var http = new XMLHttpRequest();
            
            
            $.ajax({
                url:site_url + "/admin/?page_type=media-ajax-upload&dir=" + dir_upload,
                type:"post",
                cache       : false,
                contentType : false,
                processData : false,
                xhr: function()
                              {
                                var xhr = new window.XMLHttpRequest();
                                 xhr.upload.addEventListener('progress', function(event) {
                                    
                                     
                                    
                                    var fileLoaded = event.loaded;
                                    var fileTotal = event.total;
                                    var fileProgress = parseInt((fileLoaded/fileTotal)*100) || 0; 
                                    
                                    $("#wrap-progress-" + j + " .percent").text(fileProgress + "%");
                                    $("#progress-" + j ).css("width", fileProgress + "%")
                                    
                                    //alert("#wrap-progress-" + i + " .percent")
                                    
                                }, false)
                                return xhr;
                              },
                data:data,
                success:function(data){
                     
                    $("#upload-item-" + j).replaceWith(data);
                    j++;
                    i++;
                    upload_item(dir_upload);
                },
                error:function(data){
                    j++;
                    i++;
                    upload_item(dir_upload)
                }
            });
            
            
        }
    
        $("#hcv_upload_button").change(function(){
            
            $("form.uploadform").css("display", "none")
            
            i = 0;
            
            
              
            
            _this = $('#hcv_upload_button')[0];
            
            length_of_files = _this.files.length;
            
            upload_item(dir_upload);
            var next_file = 1;
            
        });
     $("body").on("click", ".box img", function(){
        
        var select = $("#gallery").attr("select");
            $(this).parent().parent().toggleClass("active");
            $(this).toggleClass("active");
    });
    
    /**
     * Change Attributes for attachment
     */
    $("body").on("submit", ".box form", function(){
        var parent_stt = $(this).parent().attr("stt");   
         
             
        $.ajax({
            url:                site_url + "/admin/?page_type=media-ajax-handle",
            async:              true,
            type:               "POST",
            data:{
                type:           "update_attribute",
                attachment_url:  parent_stt,
                new_title:      $(".box[stt='" + parent_stt + "'] .title").val(),
                new_alt:        $(".box[stt='" + parent_stt + "'] .alt").val(),
				new_align:        $(".box[stt='" + parent_stt + "'] .align").val(),
				new_description:        $(".box[stt='" + parent_stt + "'] .description").val()
            },
            success:function(data){ 
				 //alert(data);
                if(data == '1')
                {
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("Save Success").css("opacity","1").animate(
                        {
                            "opacity" : 0
                        }, 2000
                    );
					
                }
                else
                {
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("Save Success").css("opacity","1");
                    $(".box[stt='" + parent_stt + "'] .noti").empty().append("<span style='color:red'>" + data + "</span>");
                }
            },
            error: function(){
                alert("error")
            }
        });
        
        return false;
    });
    
    
	
    /**
     * Delete attachment
     */
    $("body").on("click", ".box .handle.delete", function(){
        if(confirm('Xóa file này ?'))
		{
			var parent_stt = $(this).parent().attr("stt");        
			$.ajax({
				url:                site_url + "/admin/?page_type=media-ajax-handle",
				async:              true,
				type:               "POST",
				data:{
					type:           "delete_attachment",
					attachment_url: parent_stt,
					new_title:      $(".box[stt='" + parent_stt + "'] .title").val(),
					new_alt:        $(".box[stt='" + parent_stt + "'] .alt").val(),
					new_align:		$(".box[stt='" + parent_stt + "'] .align").val(),
				},
				success:function(data){
				
					 
					if(data == '1')
					{
						$(".box[stt='" + parent_stt + "']").remove();
					}
					else
					{
						$(".box[stt='" + parent_stt + "'] .noti").empty().append("Save Success").css("opacity","1");
						$(".box[stt='" + parent_stt + "'] .noti").empty().append("<span style='color:red'>" + data + "</span>");
					}
				},
				error: function(){
					alert("error")
				}
			});
			
			return false;
		}
		
    });
    
    /**
     * Load more attachment
     */
     
     function load_more()
     {
		$("#loading-image").css("display", "block");
		
		  
		
        $.ajax({
            url:            site_url + "/admin/?page_type=media-ajax-handle",
            type:           "POST",
            data:           {
                                type:       "load_more_gallery",
                                start:      $("#gallery img").size()
                            },
            success:        function(data)
                            {
								$("#loading-image").css("display", "none");
                                $("#inner-gallery .after-append").before(data);
								$("html, body").animate({scrollTop : $("#inner-gallery .after-append").offset().top}, "slow")
 
                            },
            error:          function(jqXHR, textStatus, errorThrown)
                            {
                                alert("error : " + textStatus);
                            }
        })
     }
     $(document).scroll(function(){
        if(0) //$("#end-gallery").offset().top <= $("#load-more-point").offset().top
        {
            //load_more();
        }
     });
     $("#button-load-more").click(function(){
        load_more()
     })
    
    
    $("#link_insert").change(function(){
        $("#display img").attr("src", $(this).val());
		$("#display img").attr("real_src", $(this).val());
		$("#display").css("display", "block");
    });
    
    
    
    $("body").on("click",".box .setting_icon", function(){
	
		$("form.attribute").css("display", "none");
        var parent_stt = $(this).parent().attr("stt");
        

        
        $(".box[stt='" + parent_stt + "'] .attribute").css("display", "block");
    });
    
    $("body").on("click", ".box .close_attribute_form", function(){
        $(this).parent().css("display", "none");
    });
    
    
    $("#search-attachments-form").submit(function(e){
		e.preventDefault();
		$("#search-not-found").remove();
		$("#inner-gallery .box").remove();
		$("#loading-image").css("display", "block");
	
		var input_val  = $("#search-attachments-value").val();
		$.ajax({
            url:            site_url + "/admin/?page_type=media-ajax-handle",
            type:           "POST",
            data:           {
                                type:       "search_attachments",
                                s:   input_val
                            },
            success:        function(data)
                            {
							     $("#search-not-found").remove()
								$("#loading-image").css("display", "none");
                                $("#inner-gallery .after-append").before(data)
                            },
            error:          function(jqXHR, textStatus, errorThrown)
                            {
                                alert("error : " + textStatus);
                            }
        })
	});
    
    
    $("#new-dir").click(function(){
        var dir_name = prompt("Tên thư mục : ", "viet_lien_khong_dau");
        if(dir_name == null) return;
		current_dir = $(this).attr("current_dir");
        $.ajax({
            url:            site_url + "/admin/?page_type=media-ajax-handle",
            type:           "POST",
            data:           {
                                type:       "new-dir",
                                dir_name:   dir_name,
								current_dir : current_dir
                            },
            success:        function(data)
                            {

							      if(data == 'exist') 
                                  {
                                        alert("Tên thư mục đã tồn tại");
                                         $("#new-dir").click();
                                  }
                                  else $("#inner-dir").prepend(data);
                                   
                            },
            error:          function(jqXHR, textStatus, errorThrown)
                            {
                                alert("error : " + textStatus);
                            }
        });
        
    });
    
    $("body").on("click", ".delete-in-dir", function(){
        var file_name_2 = $(this).attr("file_name_2");
        var file_name = $(this).attr("file_name");
        var parent = $(this).parent();
        
        if(confirm("Xóa : " + file_name_2 + " ?"))
        {
            $.ajax({
                url:            site_url + "/admin/?page_type=media-ajax-handle",
                type:           "POST",
                data:           {
                                    type:       "delete_file_in_dir",
                                    file_name:   file_name
                                },
                success:        function(data)
                                {
                                    parent.remove();
                                    
                                },
                error:          function(jqXHR, textStatus, errorThrown)
                                {
                                    alert("error : " + textStatus);
                                }
            });
        }
    });
    
     $("body").on("click", ".delete-dir", function(){
        
        var dir_name = $(this).attr("dir_name");
        var parent = $(this).parent();
         
        if(confirm("Tất cả dữ liệu trong thư mục sẽ bị xóa !\nXóa : " + dir_name + " ? "))
        {
            if(dir_name != "1")
			{
				$.ajax({
					url:            site_url + "/admin/?page_type=media-ajax-handle",
					type:           "POST",
					data:           {
										type:       "delete_dir",
										dir_name:   dir_name
									},
					success:        function(data)
									{
										parent.remove();
										
									},
					error:          function(jqXHR, textStatus, errorThrown)
									{
										alert("error : " + textStatus);
									}
				});
			}
			else
			{
				alert('K thể xóa thư mục này !!');
			}
        }
    });
    
    $("body").on("dblclick", ".box img", function(){
		return;
        window.open( site_url + '/admin/?page_type=edit-attachment&url=' + $(this).attr("real_src"), "_blank");
		//prompt("Đường dẫn ảnh : ", $(this).attr("real_src"));
	} );
})