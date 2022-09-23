$(document).ready(function(){
    var href = site_url + '/admin/?page_type=inc-handle-ajax';    
    $("body").on("click", ".core-edit-meta", function(e){
		e.preventDefault();
        var _this = $(this);
        var page_type = $(this).attr("type");
	    var the_id = $(this).attr("the_id");
        var field_type = $(this).attr("field_type");
        var field = $(this).attr("field");
		
	    $.ajax({
			url:href,
			type:"post",
			data:{type:"before-edit-meta",page_type:page_type,the_id:the_id,field_type:field_type,field:field},
			success:function(data){
				 _this.replaceWith(data);
			}
		})
	});
    
    $("body").on("click", ".core-edit-meta-save", function(e){
		e.preventDefault();
        var _this = $(this);
        var page_type = $(this).attr("page_type");
	    var the_id = $(this).attr("the_id");
        var field_type = $(this).attr("field_type");
        var field = $(this).attr("field");
        var content = $(".wrap-core-edit-meta-input.the_id-" + the_id + ".field-" + field + ".page_type-" + page_type + " .core-edit-meta-input" ).val();
		//alert(".wrap-core-edit-meta-input.the_id-" + the_id + ".field-" + field + ".page_type-" + page_type + " .core-edit-meta-input" )
	    $.ajax({
			url:href,
			type:"post",
			data:{type:"edit-meta",page_type:page_type,the_id:the_id,field_type:field_type,field:field,content:content},
			success:function(data){
				 $(".wrap-core-edit-meta-input.the_id-" + the_id + ".field-" + field + ".page_type-" + page_type).replaceWith(data);
			} 
		});
	});
    
    $("body").on("click", ".change-direction-item", function(e){
         $(".change-direction-item").removeClass("active");
         $(this).addClass("active");
		 var par = $(this).attr("par");
         $(".wp-footer").removeClass("top").removeClass("bottom").removeClass("left").removeClass("right").addClass(par);
         
         $.ajax({
			url:href,
			type:"post",
			data:{type:"change-direction", change_direction:par},
			success:function(data){
				  
			} 
		})
	});
    
    $("body").find(".core-edit-option-icon").each(function(){
        $(this).parent().addClass("relative").addClass("option-parent");
    });
    
    
});
