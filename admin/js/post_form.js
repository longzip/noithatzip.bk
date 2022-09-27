$(document).ready(function(){
    var href = site_url + '/admin/handle_ajax_post_form.php';
    
    
    
	
    
	$(".text-field").keyup(function(e){        
	   return;
       var field_name = $(this).attr("name");
       
       var field_id = $(this).attr("field_id");
       
       if(field_id != 1)
       {
            var s = $(this).val()
       
           if(s.length == 0)
           {
                $("#post-form-item-" + field_id + " .suggest-content").empty()
           }
           else
           {
                $.ajax({
                    url:href,
                    type:"post",
                    data:{type:"suggest_tex_field",field_name:field_name,s:s, field_id:field_id},
                    success:function(data){
                        
                            $("#post-form-item-" + field_id + " .suggest-content").empty().append(data)
                            
                        }
                }) 
           }
       }
       
       
    });
    
    $("body").on("click", ".suggest-text-field-item", function(){
        var the_val = $(this).html();
        
        
        
         var field_id = $(this).attr("field_id");
        $("#text-field-" + field_id).val(the_val);
        $("#post-form-item-" + field_id + " .suggest-content").empty()
    })
    
     
})
