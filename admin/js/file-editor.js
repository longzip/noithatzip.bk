$(document).ready(function(){
    
	 var ajax_href = site_url + "/admin/handle_ajax_file_editor.php";
	 
	  
      
     $("body").on("dblclick", ".load-folder-content", function(){
        
     var dir_path = $(this).attr("dir_path");
        
          
         
		
	 $.ajax({
        url:ajax_href,
        type:"post",
        data:{
            type:"load_folder_content",
            dir_path:dir_path
              
        },
        success:function(data){               
             $(".tpl-content").empty().append(data);
              
             
              $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{
                        type:"load_bread_crumb",
                        dir_path:dir_path
                          
                    },
                    success:function(data2){               
                         $("#bread-crumb .content").empty().append(data2);
                         
                          
                          
                    }
                    //error:function({alert("error")})
                });
                
                $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{
                        type:"change_url",
                        dir_path:dir_path
                          
                    },
                    success:function(data3){               
                         
                         window.history.pushState("html","pageTitle", data3);
                    }
                    //error:function({alert("error")})
                });
             
             
            
        }
        //error:alert("error")
    })
    
        
           
    
});
	 
     
     /** $("body").on("contextmenu", ".load-folder-content", function(e){
            if(e.button == 2)
            {
                e.preventDefault();
                
                $("#dir-action").css("display", "block");
                $("#dir-action").css("top", e.clientY + "px");
                $("#dir-action").css("left", e.clientX + "px");
            }
     })
    **/
   
   $("#save-file-content").click(function(){
    var dir_path = $(this).attr("dir_path");
    
        var content = $("#file-content-textarea").val()
        $.ajax({
                    url:ajax_href,
                    type:"post",
                    data:{
                        type:"save_file",
                        dir_path:dir_path,
                        content:content
                    },
                    success:function(data){               
                         if(data != 'success')
                         {
                            alert(data); 
                         }  
                         else alert(data)          
                    }
                    //error:function({alert("error")})
                });
   })
	  
	  
	 
})