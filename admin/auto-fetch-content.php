<?php
    if(!defined('SECURE_CHECK')) die('Stop');
         
    $other_header = '<meta name="robots" content="noindex,nofollow" />';
    $g_page_content['title'] = 'Công cụ bóc tin tự động';
    $g_page_content['meta_des'] = 'Công cụ bóc tin tự động';
?>

<?php  
	include 'header.php'
?>
<script>
    $("document").ready(function(){
        var count_image = 0;
        var obj_list_image;
        var stt = 0;
        var count_link = 0;
        var current_link_stt = 0;
        var list_link;
        var images;
        var titles;
        
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
                url:site_url + "/admin/?page_type=handle-ajax-auto-fetch-content",
                type:"post",
                data:$("#fetch-form").serialize(),
                success:function(data){
                     
                     var data_arr = data.split('091117');
                     
                     list_link = data_arr[0].split('130791');
                     titles = data_arr[1].split('130791');
                     images = data_arr[2].split('130791');
                     count_link = list_link.length;
                     
                     
                     
                     $(".count span").text(list_link.length);
                     get_post();
                        
                },
                error:function(){
                    alert("Đã xảy ra lỗi fetch-form");
                }
            });
        });
        
        function get_post()
        {
            $("#src").val(list_link[current_link_stt]);
            $("#title").val(titles[current_link_stt]);
            $("#image").val(images[current_link_stt]);
            
            
            $("#type").val("get_post");
            $.ajax({
                url:site_url + "/admin/?page_type=handle-ajax-auto-fetch-content",
                type:"post",
                data:$("#fetch-form").serialize(),
                success:function(data){
                    $("#result").append(data);
                    
                    
                    current_link_stt++;
                    $(".current span").text(current_link_stt);                    
                    if(current_link_stt == count_link)
                    {
                        $("#clock").slideUp();
                        alert("success");
                        return;
                        
                                                                        
                    } 
                    get_post();
                },
                error:function(){
                    alert("Đã xảy ra lỗi");
                }
            });
        }
        
        function put_image()
        {
            if(stt == (count_image - 0)) 
            {
                $("#type").val("post");
                $.ajax({
                    url:site_url + "/admin/?page_type=handle-ajax-auto-fetch-content",
                    type:"post",
                    data:$("#fetch-form").serialize(),
                    success:function(data){
                        $("#result").html(data);
                        //$("#save").css("display", "block");
                        $("#clock").slideUp();
                        alert("success");
                        
                    },
                    error:function(){
                        alert("Đã xảy ra lỗi");
                    }
                });
                return;   
            }
            $("#type").val("post_image");
            
            $("#src").val(obj_list_image[stt]);
             
            
            stt++;
            
            $("#save").css("display", "none");
            $("#result").html("<img style='display:block;margin:10px auto' src='" + cdn_domain + "/admin/images/loading.gif' />");
            
            $.ajax({
                url:site_url + "/admin/?page_type=handle-ajax-auto-fetch-content",
                type:"post",
                data:$("#fetch-form").serialize(),
                success:function(data){
                    put_image();
                      
                     
                },
                error:function(){
                    alert("Đã xảy ra lỗi put_image");
                }
            });
            
            
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

div#result  {
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
</style>
            <form id="fetch-form" action="" method="POST">
                <input name="type" type="hidden" id="type" value="category" />
                <input name="src" id="src" type="hidden" value="" />
                <input name="post_title" id="title" type="hidden" value="" />
                <input name="post_image" id="image" type="hidden" value="" />
                <div id="new-post-col-1" class="fl border-box v-col-lg-6 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
                    <div id="new-post-col-1-inner">
                        <div class=" ">
                            <h1 class="title box">Công cụ bóc tin tự động</h1>
                            
                            <div class="item" style="background: #d0d0d0;box-sizing: border-box;padding: 10px;">
                                <label>Link lấy nội dung</label>
                                <input name="source_link" placeholder="Link chuyên mục" value="<?php $temp = get_config('source_link'); if(!empty($temp)) echo $temp; ?>" class="text" />
                            </div>
                            
                            <div class="item">
                                <label>Domain gốc</label>
                                <input name="ori_domain" placeholder="Domain gốc" value="<?php $temp = get_config('ori_domain'); if(!empty($temp)) echo $temp;   ?>" class="text" />
                            </div>
                            <div class="item">
                                <label>Base URL</label>
                                <input name="base_url" placeholder="Base URL" value="<?php $temp = get_config('base_url'); if(!empty($temp)) echo $temp;   ?>" class="text" />
                            </div>
                             
                            <div class="item">
                                <label>Nhận diện link bài viết</label>
                                <input name="post_link" placeholder="Nhận diện link bài viết" value="<?php  $temp = get_config('post_link'); if(!empty($temp)) echo $temp;  ?>" class="text" />
                            </div>
                            
                            <div class="item">
                                <label>Nhận diện ảnh đại diện</label>
                                <input name="image" placeholder="Nhận diện ảnh đại diện" value="<?php $temp = get_config('image'); if(!empty($temp)) echo $temp;   ?>" class="text" />
                            </div>
                            
                            <div class="item">
                                <label>Nhận diện tiêu đề</label>
                                <input name="title" placeholder="Nhận diện tiêu đề" value="<?php $temp = get_config('title'); if(!empty($temp)) echo $temp;   ?>" class="text" />
                            </div>
                            
                            <div class="item">
                                <label>Nhận diện nội dung</label>
                                <input name="content" placeholder="Nhận diện nội dung" value="<?php $temp = get_config('content'); if(!empty($temp)) echo $temp;  ?>" class="text" />
                            </div>        
                            
                            <div class="item">
                                <label>Chuyên mục</label>
                                <div style="font-size: 13px;">
                                    <?php 
                                        $categories = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ');
                                        $temp = get_config('categories'); 
                                        $selected = json_decode($temp, TRUE);
                                        
                                        if(empty($selected)) $selected = array();
                                        
                                        foreach($categories as $category)
                                        {
                                            $chid_cats = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $category['id']);
                                            ?>
                                            <div>
                                                <input <?php if(in_array($category['id'], $selected)) echo ' checked ' ?> name="categories[]" type="checkbox" value="<?php echo $category['id'] ?>"/> <?php echo $category['title'] ?>
                                            </div>
                                            <?php
                                            foreach($chid_cats as $chid_cat)
                                            {
                                                ?>
                                                <div style="margin-left: 50px;">
                                                    <input <?php if(in_array($chid_cat['id'], $selected)) echo ' checked ' ?> name="categories[]" type="checkbox" value="<?php echo $chid_cat['id'] ?>"/> <?php echo $chid_cat['title'] ?>
                                                 </div>
                                                <?php
                                            }
                                            ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="item">
                                <label>Template</label>
                                <select name="template">
                                <?php 
                                    $templates = scandir(PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/post/');
                                    unset($templates[0], $templates[1]);
                                    $temp = get_config('template'); 
                                    foreach($templates as $template)
                                    {
                                        ?>
                                        <option <?php if($temp == str_replace('.tpl', '', $template)  ) echo ' selected ' ?> value="<?php echo str_replace('.tpl', '', $template) ?>"><?php echo str_replace('.tpl', '', $template) ?></option>
                                        <?php
                                    }
                                ?>
                                </select>
                                 
                            </div>
                            <div class="item">
                                <select name="basic_hinh_thuc">
                                    <?php 
                                        $temp = get_config('basic_hinh_thuc');
                                    ?>
                                     <option value="0">-- Hình thức --</option>
                                            <option <?php if( $temp == 'Cần bán' ) echo 'selected'; ?>  value="Cần bán">Cần bán</option>
                                            <option <?php if( $temp == 'Cần mua' ) echo 'selected'; ?>  value="Cần mua">Cần mua</option>
                                            <option  <?php if( $temp == 'Cần thuê' ) echo 'selected'; ?>  value="Cần thuê">Cần thuê</option>
                                            <option  <?php if( $temp == 'Cho thuê' ) echo 'selected'; ?>  value="Cho thuê">Cho thuê</option>
                                            <option  <?php if( $temp == 'BĐS khác' ) echo 'selected'; ?>  value="BĐS khác">BĐS khác</option>
                                            
                                </select>
                            </div>
                            
                            <div class="item">
                                <select name="basic_loai">
                                <?php 
                                        $temp = get_config('basic_loai');
                                    ?>
                                 <option value="0">-- Loại --</option>
                                        <option  <?php if( $temp == 'Nhà riêng' ) echo 'selected'; ?> value="Nhà riêng">Nhà riêng</option>
                                        <option <?php if( $temp == 'Đất thổ cư' ) echo 'selected'; ?> value="Đất thổ cư">Đất thổ cư</option>
                                        <option  <?php if( $temp == 'Đất trang trại' ) echo 'selected'; ?>value="Đất trang trại">Đất trang trại</option>
                                        <option  <?php if( $temp == 'Nhà kho - xưởng' ) echo 'selected'; ?> value="Nhà kho - xưởng">Nhà kho - xưởng</option>
                                        <option  <?php if( $temp == 'Nhà mặt tiền' ) echo 'selected'; ?> value="Nhà mặt tiền">Nhà mặt tiền</option>
                                        <option  <?php if( $temp == 'Nhà trong ngõ' ) echo 'selected'; ?> value="Nhà trong ngõ">Nhà trong ngõ</option>
                                        <option  <?php if( $temp == 'Văn phòng' ) echo 'selected'; ?> value="Văn phòng">Văn phòng</option>
                                        <option  <?php if( $temp == 'Nhà 5 tầng' ) echo 'selected'; ?> value="Nhà 5 tầng">Nhà 5 tầng</option>
                                        <option  <?php if( $temp == 'Đất dự án - chia lô' ) echo 'selected'; ?> value="Đất dự án - chia lô">Đất dự án - chia lô</option>
                                        <option  <?php if( $temp == 'Nhà cấp 4 - Tập thể' ) echo 'selected'; ?> value="Nhà cấp 4 - Tập thể">Nhà cấp 4 - Tập thể</option>
                                        <option  <?php if( $temp == 'Chung cư - Căn hộ' ) echo 'selected'; ?> value="Chung cư - Căn hộ">Chung cư - Căn hộ</option>
                                        <option   <?php if( $temp == 'Biệt thự - Nhà chia lô' ) echo 'selected'; ?> value="Biệt thự - Nhà chia lô">Biệt thự - Nhà chia lô</option>
                                        <option   <?php if( $temp == 'Phòng trọ' ) echo 'selected'; ?> value="Phòng trọ">Phòng trọ</option>
                                        <option  <?php if( $temp == 'Thiết kế kiến trúc' ) echo 'selected'; ?> value="Thiết kế kiến trúc">Thiết kế kiến trúc</option>
                                        <option  <?php if( $temp == 'Nhà hàng - khách sạn' ) echo 'selected'; ?> value="Nhà hàng - khách sạn">Nhà hàng - khách sạn</option>
                                        <option  <?php if( $temp == 'Dự án đô thị' ) echo 'selected'; ?> value="Dự án đô thị">Dự án đô thị</option>
                                        <option  <?php if( $temp == 'Công ty' ) echo 'selected'; ?> value="Công ty">Công ty</option>
                                        <option  <?php if( $temp == 'Doanh Nghiệp' ) echo 'selected'; ?> value="Doanh Nghiệp">Doanh Nghiệp</option>
                            </select>
                            </div>
                            
                            <div class="item">
                                <label>Post Type</label>
                                 <select name="post_type">
                                <?php 
                                    $post_types = get_post_types();
                                    $temp = get_config('post_type');
                                    foreach($post_types as $post_type)
                                    {
                                        ?>
                                        <option <?php if($temp == $post_type['id'] ) echo ' selected ' ?> value="<?php echo $post_type['id'] ?>"><?php echo $post_type['name'] ?></option>
                                        <?php
                                    } 
                                ?>
                                </select>
                                 
                            </div>                     
                              
                        </div>
                    </div>
                </div>
                
                <div id="new-post-col-2" class=" fr border-box v-col-lg-6 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
                    <div id="new-post-col-2-inner" class="fixed-on-scroll">
                        <div id="save" class="box"><input type="submit" value="Lấy nội dung" name="submit" class="btn btn-success" /></div>
                        <div class="count">Tổng : <span>0</span></div>
                        <div class="current">Đã xong : <span>0</span></div>                        
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
     


	include 'footer.php' ;
    die();
    $categories = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' LIMIT 8999');
    foreach($categories as $category)
    {
        $update = array(
            'url'   =>  str_replace('//', '/' , $category['url'])
        );
        models_DB::update($update, CATEGORY_TABLE, ' WHERE id=' . $category['id']);
    }
?>