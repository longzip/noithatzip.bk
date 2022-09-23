$(document).ready(function(){    
    /**
     * For upload attachment
     */
     
     
     var dir_upload = $("#hcv_upload_button").attr("dir_upload");
     
    $("body").on("click", ".new-upload", function(){
        //var parent = $(this).closest(".wrap-file-item");        
		var dir = $(this).attr("dir");
        dir_upload = dir;
        $("#hcv_upload_button").attr("dir_upload", dir);
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
                 $("form.uploadform").css("display", "block")
                return false;     
            } 
            
            var data = new FormData();
            data.append('file', _this.files[i]);
            
           
            var http = new XMLHttpRequest();
            
            
            $.ajax({
                url:site_url + "/admin/?page_type=editor-ajax-upload&dir=" + dir_upload,
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
                                    
                                     
                                    //alert("#wrap-progress-" + i + " .percent")
                                    
                                }, false)
                                return xhr;

                              },
                data:data,
                success:function(data){  
                     
                    $(".uploading").append(data);
                    j++;
                    i++;
                    upload_item(dir_upload);
                },
                error:function(data, te, code){
                     
                    j++;
                    i++;
                    upload_item(dir_upload)
                }
            });
            
            
        }
    
        $("#hcv_upload_button").change(function(){
            
            $("form.uploadform").css("display", "none");            
            i = 0;
            _this = $('#hcv_upload_button')[0];
            
            length_of_files = _this.files.length;
            
            upload_item(dir_upload);
            var next_file = 1;
            
        });
})