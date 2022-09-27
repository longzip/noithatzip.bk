<?php
    if(!defined('SECURE_CHECK')) die('Stop');
         
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Công cụ lấy media ngoài trên web';
    $g_page_content['meta_des'] = 'Công cụ lấy media ngoài trên web';
?>

<?php  
	include 'header.php'
?>
<script>
    $("document").ready(function(){
        
        var obj_list_image;
        var stt = 0;
        
        var current_link = 0;
        var count_link = 0;
        var arr_list_link;
        
        $("#fetch-form").submit(function(e){
            $("#clock").slideDown();
            setInterval(function(){
                var current_time = $("#clock .num").text();
                current_time = parseInt(current_time);
                current_time++;
                $("#clock .num").text(current_time);
                
                if(current_time == 10) $("#clock .text").text("Hà Nội k vội được đâu");
                //if(current_time == 10) $("#clock .text").text("Hà Nội k vội được đâu");
                
            }, 1000);
            
            e.preventDefault();
            $("#save").css("display", "none");
            $("#result").html("<img style='display:block;margin:10px auto' src='" + cdn_domain + "/admin/images/loading.gif' />");
            $.ajax({
                url:site_url + "/admin/?page_type=handle-ajax-get-external-media",
                type:"post",
                data:{type:"get_list_link"},
                success:function(data){
                    var data1 = data.split("091117");
                    $("#result").html(data1[1]);
                    arr_list_link = jQuery.parseJSON(data1[0]);
                    count_link =  arr_list_link.length;
                    
                    
                    
                    get_list_image_of_link();
                },
                error:function(){
                    alert("Đã xảy ra lỗi fetch-form");
                }
            });
        });
        
        
        
        var list_image;
        var count_image = 0;
        var current_image_to_fetch = 0;
        var arr_data_image;
        
        function get_list_image_of_link()
        {
            if(current_link == (count_link - 0)) 
            {
                $("#result").html("<p>Xog</p>");
                return;
            }
            
            $.ajax({
                url:site_url + "/admin/?page_type=handle-ajax-get-external-media",
                type:"post",
                data:{type:"get_list_image_of_link", link:arr_list_link[current_link]},
                success:function(data_image){
                    
                    $("#result a[href='" + arr_list_link[current_link] + "']").addClass("done");
                    
                    arr_data_image = jQuery.parseJSON(data_image);
                    
                    current_image_to_fetch = 0;
                    count_image = arr_data_image.length;
                    
                    put_image();
                    
                    
                    get_list_image_of_link();
                },
                error:function(){
                    alert("Đã xảy ra lỗi get_list_image_of_link : " + arr_list_link[current_link]);
                    
                }
            });
            
            current_link++;
        }
        
        function put_image()
        {
            if(current_image_to_fetch == (count_image - 0)) 
            {
                current_image_to_fetch = 0;
                return;
            }
            
            $.ajax({
                url:site_url + "/admin/?page_type=handle-ajax-get-external-media",
                type:"post",
                data:{type:"fetch_image", image_src:arr_data_image[current_image_to_fetch]},
                success:function(data){
                    $(".media-result").append(data);
                    put_image();
                },
                error:function(){
                    alert( "Đã xảy ra lỗi put_image : " + arr_data_image[current_image_to_fetch] );
                }
            });
            
            current_image_to_fetch++;
        }    
    });
</script>
<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
            
<style>
.item .text {
    width: 100%;
    box-sizing: border-box;
    border: 1px solid #d8d8d8;
    padding: 10px;
}

.item {
    margin: 25px 0;
    border-bottom:1px dotted silver;
    padding-bottom:25px;
}

textarea.text {
    min-height: 100px;
}

label {
    font-weight: normal;
    display:block;
    margin-bottom:5px;
}

div#result a {
    font-size: 12px;
    display: block;
    color: #d4773e;
    margin: 14px 0;
}

div#new-post-col-2-inner {
    position: relative;
}

.noti-title {
    font-size: 14px;
    font-weight: bold;
    color: #696666;
}

.list-link li {
    margin: 0;
    line-height: 18px;
    margin-left: 15px;
}

.list-link li a {
    margin: 0!important;
}

.list-link {
     
}

.list-link h2 {
    text-transform: uppercase;
    margin-bottom: 10px;
    color: #5f5959;
}

#result a.done {
    text-decoration: underline;
    color: #dad4d4;
}
</style>
 
            <form id="fetch-form" action="" method="POST">
                <input name="type" type="hidden" id="type" value="post_get_list_image" />
                <input name="src" id="src" type="hidden" value="" />
                <div id="new-post-col-1" class="fl border-box v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
                    <div id="new-post-col-1-inner">
                        <h1 class="title box">Công cụ lấy file media ngoài</h1>
                        
                        <div class="media-result flex-wrap"></div>
                    </div>
                </div>
                
                <div id="new-post-col-2" class=" fr border-box v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
                    <div id="new-post-col-2-inner" class="fixed-on-scroll">
                        <div id="save" class="box"><input type="submit" value="Lấy nội dung" name="submit" class="btn btn-success" /></div>
                        <div id="result"></div>
                        <div id="clock" class="none"><span class="text">Cứ từ từ</span> : <span class="num">0</span>s</div>
                    </div>
                </div>
                
            </form>
        </div>        
    </div>
        
    
    <span class="clear"></span>
</div>

<?php
	include 'footer.php' 
?>