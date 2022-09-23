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

    $("body").on("click", ".show-media-frame", function(){
        var dir = $(this).attr("dir");
        if(dir == undefined) dir = '';

         var to_append_body = '\
                             <div id="dialog-option" class="popup-frame">\
                        	     <iframe src="' + site_url + '/admin/?page_type=media-dir&dir=' + dir + '" ></iframe>\
                                <div class="action-option popup-frame-action">\
                                    <span class="action-option-save submit-frame popup-frame-action-save">Lưu lại</span>\
                                    <span class="action-option-close close-frame popup-frame-action-close">Đóng</span>\
                                </div>\
                            </div>';
         $("#hcv-opacity").addClass("hcv-opacity");
         $("body").append(to_append_body);
        //$("#media-frame").css("display", "block").prepend("<iframe style='border:none' src='" + site_url + "/media/tpl/dir.php' width='" + media_width + "px' height='" + media_height + "px'></iframe>");
        //$(".opacity-frame").css("display", "block");
        current_frame = $(this).attr("particular");
    });

    $("body").on("click", ".close-frame", function(){
        /*
        $("#media-frame").css("display", "none");
        $("#media-frame iframe").remove();
        $(".opacity-frame").css("display", "none");
        */
        $("#dialog-option").remove();
        $("#hcv-opacity").removeClass("hcv-opacity");
    });

    $("body").on("click", ".submit-frame", function(){

        $("#dialog-option iframe").contents().find(".box.active > div").each(function(){
            real_src = $(this).attr("real_src");
            src = $(this).attr("real_src");
        });

        $("#dialog-option iframe").contents().find("#insert_by_link_form").each(function(){
            $(this).find("#link_insert").each(function(){
                src = $(this).val();
            });
        });



        $.ajax({
            url:site_url + "/admin/?page_type=handle-ajax",
            type:"post",
            data:{type:"get_media_display", file_name:src},
            success:function(data){
                 $("#" + current_frame ).val(src);
                 $("#" + current_frame + "_display").html(data);

                 $("#dialog-option").css("display", "none");
                $("#dialog-option iframe").remove();
                $(".opacity-frame").css("display", "none");
            }
        });

        $("#dialog-option").remove();
        $("#hcv-opacity").removeClass("hcv-opacity");

    });


    /**
     * Active current menu
     */
     //alert(location.hostname)

    /**
     * Auto create pretty url when write title
     */

})
