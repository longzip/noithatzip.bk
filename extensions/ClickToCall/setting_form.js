$(document).ready(function(){
    $(".wrap-add .add").click(function(){
        var add = $(".new-thread-item").html();
        
        $(".new-thread-item.new").removeClass("new");
        $("#list-post-item").prepend("<div class='new-thread-item box new'>" + add + "</div>");
        $(".new-thread-item.new textarea").empty();
    });
    
    $("body").on("click", ".delete-position", function(){
            $(this).closest(".new-thread-item").remove();
    });
});