$(document).ready(function(){
    
    $("#select_domain").change(function(){
        switch($(this).val())
        {
            case 'rongbay' :
            {
                $("#p-title").val("h1");
                $("#p-author").val(".detail_personal a");
                $("#p-phone").val(".iconCall");
                $("#p-email").val(".detail_email a");
                $("#p-content").val("#NewsContent");
                $("#p-image").val("#show_galley_d");
                $("#url-base").val("http://rongbay.com");
                $("#group-url").val(".NaviPage a");
                $("#detail-url").val("#search_area a.float_l");
            }
            break;
            
            case 'rongbay2' :
            {
                $("#p-title").val("h1");
                $("#p-author").val(".detail_personal a");
                $("#p-phone").val(".iconCall");
                $("#p-email").val(".detail_email a");
                $("#p-content").val("#NewsContent");
                $("#p-image").val("#show_galley_d");
                $("#url-base").val("http://rongbay.com");
                $("#group-url").val(".NaviPage a");
                $("#detail-url").val("#search_area a.float_l");
            }
            break;
            
            case 'chothaivn' :
            {
                $("#p-title").val(".posttitle");
                $("#p-author").val(".username_container .memberaction font");
                //$("#p-phone").val(".iconCall");
                //$("#p-email").val(".detail_email a");
                $("#p-content").val(".postrow .content");
                //$("#p-image").val("#show_galley_d");
                $("#url-base").val("http://chothai.vn/biz/");
                $("#group-url").val("#below_threadlist .threadpagenav form a");
                $("#detail-url").val(".inner .threadtitle a");
            }
            break;
        }
    })
    $("#get_content").click(function(){
        $("#noti").html("<img src='http://chothai.info/tpl/images/loading.gif' />")
        $.ajax({
            url:site_url + "/admin/AutoFetchContentApp/handle_ajax.php",
            type:"POST",
            data:{
                type:       "SingleToMulti",
                main_url:   $("#main-url").val(),
                group_url:  $("#group-url").val(),
                detai_url:  $("#detail-url").val(),
                title:      $("#p-title").val(),
                author:     $("#p-author").val(),
                phone:      $("#p-phone").val(),
                email:      $("#p-email").val(),
                content:    $("#p-content").val(),
                image:      $("#p-image").val(),
                price:      $("#p-price").val(),
                category:   $("#select_category").val(),
                nhu_cau:    $("#select_nhu_cau").val(),
                base_url:   $("#url-base").val()
            },
            success:function(data)
            {
                $("#noti").html(data);
            }
        })
    })
    
    $("#get_content_multi_by_number").click(function(){
        $("#noti").html("<img src='http://chothai.info/tpl/images/loading.gif' />")
        $.ajax({
            url:site_url + "/admin/AutoFetchContentApp/handle_ajax.php",
            type:"POST",
            data:{
                type:       "get_content_multi_by_number",
                main_url:   $("#main-url").val(),
                start_page: $("#start-page").val(),
                end_page:   $("#end-page").val(),
                detai_url:  $("#detail-url").val(),
                title:      $("#p-title").val(),
                author:     $("#p-author").val(),
                phone:      $("#p-phone").val(),
                email:      $("#p-email").val(),
                content:    $("#p-content").val(),
                image:      $("#p-image").val(),
                price:      $("#p-price").val(),
                category:   $("#select_category").val(),
                nhu_cau:    $("#select_nhu_cau").val(),
                base_url:   $("#url-base").val()
            },
            success:function(data)
            {
                $("#noti").html(data);
            }
        })
    })
})