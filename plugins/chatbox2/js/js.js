$(document).ready(function(){
    
    //var test = $.parseJSON('{"time":"1212323","content":"messenger content","last_id":3}');
                    
                    //alert(test.time)
                   
    
    $(".chatbox .content").animate({ scrollTop: $(".chatbox .content")[0].scrollHeight }, 10);
                                            
               
    function load_messenger()
    {
        //alert(last_id) 
        $.ajax({
                url: "ajax.php",
                type:"POST",
                data:{type:"load_messenger", last_id : last_id},
                success:function(data){
                   if(data != '0' )
                   {
                        var data_decode = $.parseJSON(data);
                        
                        
                        //alert(data_decode.content);
                        
                        var add = "<div class='chat-item'>\
                                        <span class='time'>" + data_decode.time_create + " : </span>\
                                        <span class='chat-content'>" + data_decode.content + "</span>\
                                    </div>";
                        
                        
                        
                        
                        $(".chatbox .content").append(data_decode.return_display);
                        $(".chatbox .content").animate({ scrollTop: $(".chatbox .content")[0].scrollHeight }, 1000);
                        
                        
                        last_id = data_decode.id;
                   }
                    
                    
                    //load_messenger();
                },
                error:function(data, textStatus, a)
                {
                    alert(textStatus);
                }
            })
    }
    
    var loop = setInterval(load_messenger, 1000);
    
    //load_messenger();
    
    $(".chat-form").submit(function(e){
        
        e.preventDefault();
        
        var parent = $(this).parent().parent().parent();
        
        var parent_id = parent.attr("id");
        
        var content = $("#" + parent_id + " .input").val();
        
        var time = 100;
        
        var add = "<div class='chat-item'>\
                        <span class='time'>" + time + " : </span>\
                        <span class='chat-content'>" + content + "</span>\
                    </div>";
        
        if(content != '')
        {
            $.ajax({
                url: "ajax.php",
                type:"POST",
                data:{type:"send_messenger", "content" : content, time : time},
                success:function(data){
                    $("#" + parent_id + " .input").val("");
                    
                    //$("#" + parent_id + " .content").append(data);
                },
                error:function(data, textStatus, a)
                {
                    alert("error");
                }
            })
        }
        
    });
    
    
    $(".chatbox .emoticon").on("click", "img", function(){
        
        var char_text = $(this).attr("char");
        
        var parent = $(this).parent().parent().parent().parent();
        
        var parent_id = parent.attr("id");
        
        var input_field = $("#" + parent_id + " .input");
        
        var input_field_val = input_field.val();
        
        input_field.val(input_field.val() + " " + char_text + " ");
       
       input_field.focus()
    });
    
    $(".chatbox .emoticon li").click(function(){
        
        var type_emoticon = $(this).attr("type");
        
        var parent = $(this).parent().parent().parent();
        
        var parent_id = parent.attr("id");
        
        $(".chatbox .emoticon li").removeClass("active");
        
        $(this).addClass("active");
        
        $.ajax({
                url: "ajax.php",
                type:"POST",
                data:{type:"load_emoticon", type_emoticon : type_emoticon},
                success:function(data){
                    $("#" + parent_id + " .emoticon-content").empty().append(data);
                },
                error:function(data, textStatus, a)
                {
                    alert("error");
                }
            })
        
    });
    
    $(".toggle-emoticon").click(function(){
        $(".chatbox .emoticon").slideToggle();
    })
    
    $(".close-emoticon").click(function(){
        $(".chatbox .emoticon").slideToggle();
    })
    
    
    var more_id = 1;
    $(".chatbox .content").scroll(function(){
        
        var char_text = $(this).attr("char");
        
        var parent = $(this).parent().parent();
        
        var parent_id = parent.attr("id");
        if($(this).scrollTop() <= 50)
        {
            $.ajax({
                url: "ajax.php",
                type:"POST",
                data:{type:"load_pre_messenger", first_id : first_id, more_id : more_id},
                success:function(data){
                    //alert(data);
                   if(data != '0' )
                   {
                        var data_decode = $.parseJSON(data);
                        
                                              
                        $(".chatbox .content").prepend(data_decode.return_display);
                        
                        
                        //alert("#chatbox-more-" + more_id)
                        //var current_scrolltop = 
                        
                        $(".chatbox .content").scrollTop($("#chatbox-more-" + more_id).height()+50);
                        
                        more_id++;
                        first_id = data_decode.id;
                   }
                    
                    
                    //load_messenger();
                },
                error:function(data, textStatus, a)
                {
                    alert(textStatus);
                }
            })
            
        }
        
    });
    
})