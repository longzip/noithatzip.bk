$(document).ready(function(){
    var ajax_href = site_url + "/inc/?page_type=ajax-search-form"
    $("body").on("keyup", ".v-search-form .text", function(e){
		e.preventDefault();
        var _val = $(this).val();
        if(_val.length < 3) return; 
        var parent = $(this).closest(".v-search-form");
        
	    $.ajax({
			url:ajax_href,
			type:"post",
			data:{type:"search-form-keyup",keyword:_val},
			success:function(data){
				 parent.find(".v-search-form-suggest").each(function(){
				     $(this).html(data);
				 });
			}
		})
	});
     $("body").on("focusout", ".v-search-form .text", function(e){
        setTimeout(function(){
            $(".v-search-form-suggest").empty();
        }, 500);
     });
});