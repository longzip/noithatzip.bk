$(document).ready(function(){
     
    var ajax_href = site_url + '/admin/?page_type=handle-ajax-tpl';
    
    var saved = true;
    
    function get_mode(dir){
        var mode_type = dir.split('.').pop();
        switch(mode_type){
            case 'js' : return 'javascript';
            case 'css' : return 'css';
            case 'tpl' : return 'html';
            case 'html' : return 'html';
            case 'xml' : return 'html';
            default : return 'html';
        }
    }
    
    $("body").on("keyup", "#editor", function(e){
            saved = false;
             if(e.keyCode == 27) $(".editor-nav-item.active .close-editor-nav-item").click(); 
      });
    
    var isCtrl = false;
    document.onkeyup=function(e){
        if(e.keyCode == 17) isCtrl=false;
    }
    
    document.onkeydown=function(e){
        if(e.keyCode == 17) isCtrl=true;
        if(e.keyCode == 83 && isCtrl == true) {
            var content = editor.getValue();
            //alert(content)
            current_dir = $(".editor-nav-item.active").attr("dir");
            var mini_file = $("#mini-file").val();
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"save_editor",content:content,current_dir:current_dir, mini_file:mini_file},
                success:function(data){
                     $(".noti").css("opacity", "1");
                     setTimeout(function(){
                        saved = true;  
                     }, 200);
                     
                     
                     $(".noti").addClass("floating");
                     
                     setTimeout(function(){                        
                        $(".noti").css("opacity", "0");
                        $(".noti").removeClass("floating");
                     }, 2000);
                     
                }
            });
             
            return false;
        }
    }
    
    //Auto Save
    setInterval(function(){
        if($("#auto-save-input").val() == "1")
        {
            var content = editor.getValue();
            var mini_file = $("#mini-file").val();
            current_dir = $(".editor-nav-item.active").attr("dir");
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"save_editor",content:content,current_dir:current_dir, mini_file:mini_file},
                success:function(data){
                      
                     setTimeout(function(){
                        saved = true;  
                     }, 200);
                     
                }
            });
        }
    }, 3000);
    
    var current_dir = '';
    function save_editor(){
        var content = editor.getValue();
        current_dir = $(".editor-nav-item.active").attr("dir");
        var mini_file = $("#mini-file").val();
        $.ajax({
            url:ajax_href,
            type:"post",
            data:{type:"save_editor",content:content,current_dir:current_dir,mini_file:mini_file},
            success:function(data){
                 setTimeout(function(){
                    var saved = true; 
                 }, 3000);
            }
        });
         
    }
      
    $("body").on("click", ".file-item a", function(e){
            //e.preventDefault();
      });
      
      $("body").on("click", ".file-item.type-dir a.load-dir", function(e){
            e.preventDefault();
            var href = $(this).attr("href");
            var dir = $(this).attr("dir");
            
            
            
            var parent = $(this).closest(".wrap-file-item");
            
            if( $(this).hasClass("active") )
            {
                $(this).removeClass("active");
                parent.find(".wrap-file-item").each(function(){
                    $(this).remove();
                });
                return;
            }
            else $(this).addClass("active");
            
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"get_dir_item",dir:dir,},
                success:function(data){
                     parent.append(data);
                }
            });
      });   
      
      $("body").on("click", ".file-item.type-file a", function(e){
             
            e.preventDefault();
            var dir_name = $(this).attr("dir_name");
            var parent = $(this).closest(".wrap-file-item");
            var href = $(this).attr("href");
            var dir = $(this).attr("dir");
            var real_dir = $(this).attr("real_dir");
            var mini_file = $("#mini-file").val(); 
             
            if($(".editor-nav-item[real_dir='" + real_dir + "']").size() > 0)
            {
                alert("File đã được mở");
                return;
            }
             
            if(!saved)
            {
                if(!confirm("Thay đổi của bạn chưa được lưu, Bạn có chắc chắn muốn thực hiện hành động này ?"))
                {
                    return;
                }
            }
            saved = true;
            
            $(".file-item.type-file a").removeClass("active");
            $(this).addClass("active");
            
            
            current_dir = dir;
             
            
            
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"get_file_content",dir:dir, mini_file:mini_file},
                success:function(data){
                    
                    editor.getSession().setMode("ace/mode/" + get_mode(dir));
                    
                    //Lưu vị trí con trỏ chuột cho file hiện tại
                    var current_cursor = editor.getCursorPosition();
                    $(".editor-nav-item.active").attr("row", current_cursor.row).attr("column", current_cursor.column).attr("scrollTop", document.getElementById("editor").scrollTop);
                    
                    
                    
                    //END Lưu vị trí con trỏ chuột cho file hiện tại
                    
                    $(".editor-nav-item").removeClass("active");
                    $("#editor-nav").append("<div class='editor-nav-item active' real_dir='" + real_dir + "' dir='" + dir + "'><i class='fa fa-close close-editor-nav-item'></i><span class='editor-nav-item-name' dir='" + dir + "'>" + dir_name + "</span></div>")
                     
                    
                    
                    editor.setValue(data);
                    
                    $.ajax({
                        url:ajax_href,
                        type:"post",
                        data:{type:"get_file_path_for_nav",dir:dir},
                        success:function(data){ 
                            $(".current-path").text(data);
                            
                            // Cài đặt vị trí cho con trỏ chuột khi file được mở lần đầu
                            editor.focus();
                            editor.gotoLine(0,0, true);
                            // END Cài đặt vị trí cho con trỏ chuột khi file được mở lần đầu
                            
                            
                        }
                    });
                }
            });
      });
      
      $("body").on("click", ".close-editor-nav-item", function(e){
            var parent = $(this).closest(".editor-nav-item");
            var mini_file = $("#mini-file").val();
            if(parent.hasClass("active"))
            {
                if(!saved)
                {
                    if(!confirm("Thay đổi của bạn chưa được lưu, Bạn có chắc chắn muốn thực hiện hành động này ?"))
                    {
                        return;
                    }
                }
                saved = true;
                parent.remove();
                
                var current_tab = $(".editor-nav-item:first-of-type");
                var dir = current_tab.attr("dir");
                current_tab.addClass("active");
                $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{type:"get_file_content", dir:dir, mini_file:mini_file},
                    success:function(data){ 
                        editor.setValue(data);
                        // Cài đặt vị trí cho con trỏ chuột
                        editor.focus();                     
                        editor.gotoLine( parseInt($(".editor-nav-item.active").attr("row")) + 1, parseInt($(".editor-nav-item.active").attr("column")) + 1, true);                    
                        // END Cài đặt vị trí cho con trỏ chuột
                        editor.getSession().setMode("ace/mode/" + get_mode(dir));
                        $(".file-paths .type-file a").removeClass("active");
                        $("a[dir='" + dir + "']").addClass("active");
                        
                        $.ajax({
                            url:ajax_href,
                            type:"post",
                            data:{type:"get_file_path_for_nav",dir:dir},
                            success:function(data){ 
                                $(".current-path").text(data);
                            }
                        });
                    }
                });
            }
            
            parent.remove();
      });
      
      $("body").on("click", ".editor-nav-item-name", function(e){
            if(!saved)
            {
                if(!confirm("Thay đổi của bạn chưa được lưu, Bạn có chắc chắn muốn thực hiện hành động này ?"))
                {
                    return;
                }
            }
            saved = true;
            
            //Lưu vị trí con trỏ chuột cho file hiện tại
            var current_cursor = editor.getCursorPosition();
            $(".editor-nav-item.active").attr("row", current_cursor.row);
            $(".editor-nav-item.active").attr("column", current_cursor.column);
            //END Lưu vị trí con trỏ chuột cho file hiện tại
            
            $(".editor-nav-item").removeClass("active");
            
            
            var parent = $(this).closest(".editor-nav-item");
            parent.addClass("active");
            var dir = parent.attr("dir");
            var mini_file = $("#mini-file").val();
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"get_file_content",dir:dir, mini_file:mini_file},
                success:function(data){ 
                    editor.setValue(data);
                     // Cài đặt vị trí cho con trỏ chuột
                    editor.focus();                     
                    editor.gotoLine( parseInt($(".editor-nav-item.active").attr("row")) + 1, parseInt($(".editor-nav-item.active").attr("column")) + 1, true);                    
                    // END Cài đặt vị trí cho con trỏ chuột
                    
                    
                    editor.getSession().setMode("ace/mode/" + get_mode(dir));
                    $(".file-paths .type-file a").removeClass("active");
                    $("a[dir='" + dir + "']").addClass("active");
                    
                    $.ajax({
                            url:ajax_href,
                            type:"post",
                            data:{type:"get_file_path_for_nav",dir:dir},
                            success:function(data){ 
                                $(".current-path").text(data);
                            }
                        });
                }
            });
      });
      $("body").on("mouseenter", ".editor-nav-item", function(){
            var dir = $(this).attr("dir");
            var _this = $(this);
             
             $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"get_file_path_for_nav",dir:dir},
                success:function(data){ 
                    _this.attr("title", data);
                }
            });
            
      });
      
      
      //Tạo thư mục mới
      $("body").on("click", ".new-dir", function(){
            var dir_name = prompt("Tên thư mục : ", "viet_lien_khong_dau");
            if(dir_name == null) return;
            var parent = $(this).closest(".wrap-file-item");
    		var dir = $(this).attr("dir");
             $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"new_dir",dir:dir, dir_name:dir_name},
                success:function(data){ 
                    if(data == 'exist') alert("Thư mục đã tồn tại");
                    else
                    {
                        parent.append(data);    
                    }
                    
                }
            });
            
        });
        
        //Tạo file mới
      $("body").on("click", ".new-file", function(){
            var _this = $(this);
            var dir_name = prompt("Tên file : ", "");
            if(dir_name == null) return;
            var parent = $(this).closest(".wrap-file-item");
    		var dir = $(this).attr("dir");
             $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"new_file",dir:dir, dir_name:dir_name},
                success:function(data){ 
                    if(data == 'exist'){
                        alert("File đã tồn tại");
                        return;
                    }
                    if(data == 'invalid'){
                        alert("Định dạng file không hợp lệ");  
                        return;
                    }
                    parent.append(data);
                     
                }
            });
            
        }); 
        
          //Upload File
      $("body").on("click", ".new-upload", function(){
            var parent = $(this).closest(".wrap-file-item");
            $(".wrap-file-item").removeClass("uploading");
            parent.addClass("uploading");
    		var dir = $(this).attr("dir");
            $("#hcv_upload_button").attr("dir_upload", dir);
            
        });
        
        $("body").on("click", ".delete-file", function(){
            
            var parent = $(this).closest(".wrap-file-item");
    		var dir = $(this).attr("dir");
            if(confirm("Xóa : " + parent.text()))
            {
                 $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{type:"delete_file",dir:dir},
                    success:function(data){ 
                        parent.remove();                        
                    }
                });
            }
            
        }); 
        
        $(".toogle-huong-dan").click(function(){
            $("#huong-dan").toggleClass("active");
        });
        
        $(".toogle-backup").click(function(){
            $(".view-backup-file").toggleClass("active");
        });
        $(".close-huong-dan").click(function(){
            $("#huong-dan").removeClass("active");
        });
        $(".houng-dan-item-content input").mouseenter(function(){
            $(this).select();
        });
        
        
        $(".view-backup").click(function(){
            $(".view-backup-content").html("<img src='"   + cdn_domain + "/admin/images/loading.gif' />");
            $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{type:"view_backup_file", path_name:$("#path_name").val()},
                    success:function(data){ 
                        $(".view-backup-content").html(data);                        
                    }
                });            
        });
        
        $("body").on("click", ".backup-item-name", function(){
            $(".backup-item-name").removeClass("active");
            $(this).addClass("active");
            var par = $(this).attr("par");
            
            $(".backup-item-content").slideUp();
            $(".backup-item-content-" + par).slideDown();
            
        });
        
        $(".file-paths").height( window.innerHeight - 190 );
        
        $("body").on("click", "#unminify", function(e){            
            var dir = $("#tpl .current-path").text();
            dir = path_root + '/' + dir;
            var content = editor.getValue();
             
            
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"unminify",dir:dir, content:content},
                success:function(data){ 
                     
                    if(data != '') editor.setValue(data);
                }
            }); 
        });
        
        
        
        
        
        
        
        /// Custom TPL
        $("body").on("click", ".active-custom-tpl-now", function(e){ 
            $(".not-exist-custom-noti").html('<img src="' + cdn_domain  + '/admin/images/loading.gif" />');
            $.ajax({
                url:ajax_href,
                type:"post",
                data:{"type":"active_custom_tpl","domain":site_url},
                success:function(data){ 
                    $(".not-exist-custom-noti").replaceWith(data);
                }
            });
        });
        
        $("body").on("click", ".delete-dir", function(e){
            if(confirm("Xóa ?"))
            {
                var dir_path = $(this).attr("dir");
            
                $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{"type":"delete_dir","dir_path":dir_path},
                    success:function(data){ 
                        $(".file-paths").html(data);
                    }
                });
            }
            
        });
        
        
        
        
});