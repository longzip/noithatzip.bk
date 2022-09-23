$(document).ready(function(){    
    /**
     * For upload attachment
     */
     
     $(".new-slide-button").click(function(){
        $("#hcv_upload_button").val("");
        $("#hcv_upload_button").click();
     })
     
     var dir_upload = '';
     var field_name = '';
     
    $("body").on("click", ".upload-button", function(){

        var parent = $(this).closest(".new-thread-item-MultiImage");
         
		var dir = $(this).attr("dir");
        field_name = $(this).attr("field_name");
        dir_upload = '';
        parent.find(".real-upload-button").each(function(){
            $(this).attr("dir_upload", dir);
            $(this).click();
        });
        
    });
    
      
	   var file_item = 1;
       
       var i = 0;
       
       var length_of_files = 0;
       
       var _this;
       
       var j = 0;
       
       function upload_item(dir_upload , parent = '')
       {
            if(i==length_of_files)
            {
                 $(".sortable").sortable({helper:"clone", revert:true});
                 return false;     
            } 
            
            var data = new FormData();
            data.append('file', _this.files[i]);
            
           
            var http = new XMLHttpRequest();
            
            
            $.ajax({
                url:site_url + "/admin/?page_type=slide-ajax-upload",
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
                    parent.find("#slide-list").each(function()
                    {
                        $(this).append(data);
                        
                        tinymce.init({
                            entity_encoding : "raw",
                        	convert_urls: false,
                            verify_html: true,
                            selector: ".main-content",
                            content_css : cdn_domain + "/inc/css/tinymce.css",
                            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 18px 24px 28px 36px",
                            setup: function (editor) {
                            editor.on('change', function () {
                                tinymce.triggerSave();
                            })},
                            skin:"custom",
                            plugins: [
                                "textcolor ",
                                "searchreplace visualblocks code fullscreen"
                                //"insertdatetime media table contextmenu wordcount hcv_upload hcv_youtube  hcv_other_post hcv_image_map hcv_form"
                            ],
                            menu : {
                                //table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
                                tools  : {title : 'Tools' , items : 'spellchecker'}
                            },
                            toolbar: "fontsizeselect   forecolor  "
                        });
                    });
                    
                    j++;
                    i++;
                    upload_item(dir_upload, parent);
                },
                error:function(data, te, code){                     
                    j++;
                    i++;
                    upload_item(dir_upload, parent)
                }
            });
        }
    
        $(".real-upload-button").change(function(){
            var parent = $(this).closest(".slide-form");
             
            i = 0;
            
            parent.find(".real-upload-button").each(function()
            {
                 _this = $(this)[0];
            });
            
            
            length_of_files = _this.files.length;
            
            upload_item(dir_upload, parent);
            var next_file = 1;
            
        });
})