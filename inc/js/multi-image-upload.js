$(document).ready(function(){
    /**
     * For upload attachment
     */


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
                url:site_url + "/inc/?page_type=ajax-upload&dir=" + dir_upload + "&field_name=" + field_name,
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
                  console.log(data);
                    parent.find(".list-image").each(function()
                    {
                        $(this).append(data);
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
            var parent = $(this).closest(".new-thread-item-MultiImage");

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
