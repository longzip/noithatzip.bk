$(document).ready(function(){
    
    var ajax_href = site_url + "/inc/?page_type=advanced-search-form";
    
    $( "body" ).on("focusin", ".core-filter-search .text-field", function() {
         var field = $(this).attr("name");
         var keyword = $(this).val();
         
         $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"get-all-field-value", field:field, keyword:keyword},
                success:function(data){         
                    $(".suggest-content").removeClass("active");
                    $(".filter-item-" + field + " .suggest-content").addClass("active");
                    $(".filter-item-" + field + " .suggest-content").html(data);
                }
            }); 
    });
    
    $( "body" ).on("keyup", ".core-filter-search .text-field", function() {
         var field = $(this).attr("name");
         var keyword = $(this).val();
         
         $.ajax({
                url:ajax_href,
                type:"post",
                data:{type:"get-all-field-value", field:field, keyword:keyword},
                success:function(data){         
                    $(".suggest-content").removeClass("active");
                    $(".filter-item-" + field + " .suggest-content").addClass("active");
                    $(".filter-item-" + field + " .suggest-content").html(data);
                }
            }); 
    });
    
    $( "body" ).on("click", ".suggest-item", function() {
        var field = $(this).attr("par");
         var text = $(this).text();
         $(".filter-item-" + field + " .text-field").val(text);
    });
    
    
    $( "body" ).on("focusout", ".core-filter-search .text-field", function() {
        var field = $(this).attr("name");
        var keyword = $(this).val();
        setTimeout(function(){    
             $(".filter-item-" + field + " .suggest-content").removeClass("active");
         }, 500);
         
    });

});