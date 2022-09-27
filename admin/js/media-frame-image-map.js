$(document).ready(function(){
    function get_file_extension(file_name){
        if( file_name == '' ) return false;
        var file_part = file_name.split('.');
        if( file_part.length < 1 ) return false;
        return file_part[ file_part.length - 1];
    }
    
    function get_file_type(file_name){
        switch(get_file_extension(file_name))
        {
            case 'jpg' :
            {
                return 'image';
                break;
            }
            case 'jpeg' :
            {
                return 'image';
                break;
            }
            case 'gif' :
            {
                return 'image';
                break;
            }
            case 'png' :
            {
                return 'image';
                break;
            }
            case 'mp3' :
            {
                return 'mp3';
                break;
            }
            case 'mp4' :
            {
                return 'mp4';
                break;
            }
            case 'flv' :
            {
                return 'flv';
                break;
            }
        }
    }

     /**
     * Media Frame
     */
     var current_frame;
     
     var media_width  = screen.width-100;
     var media_height  = screen.height - 200;
     //alert(media_height);
     
    $("#media-frame").css("left",(screen.width-media_width)/2  + "px");
    $("#media-frame").css("top",(screen.height-media_height)/2 - 100 + "px");
    
    $("body").on("click", ".show-media-frame-image-map", function(){
         var to_append_body = '\
                             <div id="dialog-option" class="popup-frame">\
                        	     <iframe src="' + site_url + '/admin/?page_type=media-dir"></iframe>\
                                <div class="action-option popup-frame-action">\
                                    <span class="action-option-save submit-frame popup-frame-action-save">Lưu lại</span>\
                                    <span class="action-option-close close-frame popup-frame-action-close">Đóng</span>\
                                </div>\
                            </div>';
         $("#hcv-opacity").addClass("hcv-opacity");
         $("body").append(to_append_body);
        current_frame = $(this).attr("particular");
    });
    
    $("body").on("click", ".close-frame", function(){
        $("#dialog-option").remove();
        $("#hcv-opacity").removeClass("hcv-opacity");
    });
    
    $("body").on("click", ".submit-frame", function(){   
        var src = '';
        var description  = '';
        $("#dialog-option iframe").contents().find(".box.active > div").each(function(){
            real_src = $(this).attr("real_src");
            src = $(this).attr("real_src");
            $(this).parent().find("textarea.description").each(function(){
                description = $(this).val();
            });
            
             
                    
        });
    
        $("#dialog-option iframe").contents().find("#insert_by_link_form").each(function(){
            $(this).find("#link_insert").each(function(){
                src = $(this).val();
            });            
        }); 
          
        if( upload_button_type == 'ori' )
        {
            $.ajax({            
                url:site_url + "/admin/?page_type=handle-ajax",
                type:"POST",
                data:{type:"get_image_size", src:src},
                success:function(data){
                    var data_arr = data.split('-');
                    
                    if(data_arr[0] > 1100)
                    {
                        var data_arr_scale = parseFloat(data_arr[0]) / 1100;
                        data_arr[0] = 1100;
                        data_arr[1] = parseFloat(data_arr[1]) / data_arr_scale;
                    }
                     
                    
                    var newElement1 = document.getElementById("svg-map-1-image"); //Create a path in SVG's namespace
                    newElement1.setAttribute("width",data_arr[0]);
                    newElement1.setAttribute("height",data_arr[1]);
                    newElement1.setAttribute("xlink:href",src);
                    newElement1.setAttribute("src",src);
                    
                    
                    newElement1 = document.getElementById("svg-map-1"); //Create a path in SVG's namespace
                    newElement1.setAttribute("viewBox","0 0 " + data_arr[0] + " " + data_arr[1]);
                    newElement1.setAttribute("width",data_arr[0]);
                    newElement1.setAttribute("height",data_arr[1]);
                    
                },
                error:function(){
                    alert("error")
                }
            });
            
            
        }
        if( upload_button_type == 'selection' )
        {
              
            var newElement1 = document.getElementById("polygon-stt-" + stt); //Create a path in SVG's namespace
            newElement1.setAttribute("data-src",src);
            newElement1.setAttribute("description",description);
            upload_button_type = 'ori';
        }
        
        
         
        $("#dialog-option").remove();
        $("#hcv-opacity").removeClass("hcv-opacity");
        
    });
    
    
    
    setInterval(function(){
         if(!auto_fill_content) return;
            
            var add = "";
            add = add + " ";
            add = add + add + $("#wrap-svg-map-1").html();
            add = add + "&nbsp; ";
            add = add + "";
            
             
            $("#the-content").val( add );
            //$("#the-polygon_count").val( stt );
              
                    
    }, 500);
    
    /**
     * Active current menu
     */
     //alert(location.hostname)
    
    /**
     * Auto create pretty url when write title
     */
	 
})