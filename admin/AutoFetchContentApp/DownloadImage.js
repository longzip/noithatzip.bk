$(document).ready(function(){
    var url;
    var order = 0;
    $("#download").click(function(){
        //$("#data").empty();
        
        $.post(
            "http://localhost/tool/DownloadImage/handle.php",
            {
                "action" : "post_url",
                "url" : $("#resource").val()
            },
            function(data)
            {
                $("#data").empty();
                $("#data").append(data);
                
                $("html").find("img").each(function(){
                    url = $(this).attr("src");
                    //$("#notification").append(url + '<br />');
                    order = order + 1;
                    $.post(
                        "http://localhost/tool/DownloadImage/handle.php",
                        {
                            "action" : "download",
                            "base" : $("#base").val(),
                            "image_url" : url,
                            "order" : order
                        },
                        function(data2,status)
                        {
                           
                            
                            if(status == "success")
                            {
                                $("#notification").append(data2);
                                
                            }
                            else
                            {
                                $("#notification").append(data2);
                               
                            }
                        }
                    );
                })
            }
        );
    })
})