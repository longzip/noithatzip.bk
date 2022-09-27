$(document).ready(function(){
    var href = site_url +  "/admin/?page_type=handle-ajax-block-manager";
    $(".change-block-sc").click(function(){
        var par = $(this).attr("par"); 
        $(".file-change-block-sc-" + par).click();
    });
    
    $(".file-change-block-sc").change(function(){
        var par = $(this).attr("par");
         
        var _this = $(this)[0];
        
        var data = new FormData();
        data.append('file', _this.files[0]);
        
       
        var http = new XMLHttpRequest();
        
        
        $.ajax({
            url:href + "&file=" + par,
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
                                
                            }, false)
                            return xhr;
                          },
            data:data,
            success:function(data){
                 
                $(".tr-" + par + " .sc img").attr("src", data);
            },
            error:function(data, te, code){
                  alert(data + ", " + te + ", " + code);
            }
        });
    });
});
