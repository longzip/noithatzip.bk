$(document).ready(function(){
    
	 var ajax_href = site_url + "/inc/?page_type=ajax_comment";
	 
	 var valid_comment = 1;
	 
	 var parent = 0;
	 
	 var real_sub = 0;
	 
	 $("body").on("submit", ".auto-comment-form", function(e){
		e.preventDefault(); 
		
		var the_parent = $(this).parent()
		
		real_sub = the_parent.attr('real_sub')
		
		if(valid_comment == 1)
		{
			valid_comment = 0;
			$.ajax({
				url:ajax_href,
				type:"post",
				data:{
					type:"add_comment",
					name:$("#comment-field-name").val(),
					email:$("#comment-field-email").val(),
					content:$("#comment-field-content").val(),
					parent:0,
					post_id:$(".auto-comment-form").attr("post_id"),
					real_sub:parseInt(real_sub)
				},
				success:function(data){             

					$("#comment-field-content").val('');
					
					$(".core-list-comment").prepend(data);
					
					var my_timeout = setTimeout(function(){
						valid_comment = 1;
					},3000);
				}
				//error:alert("error")
		   })
		}
		else
		{
			alert('Bạn gửi bình luận quá nhanh')
		}
		
	 });
	 
	 $("body").on("submit", ".reply-auto-comment-form", function(e){
		e.preventDefault(); 
		
		var the_parent = $(this).parent()
		
		real_sub = the_parent.attr('real_sub')
		
		$.ajax({
			url:ajax_href,
			type:"post",
			data:{
				type:"add_comment",
				name:$("#reply-comment-field-name").val(),
				email:$("#reply-comment-field-email").val(),
				content:$("#reply-comment-field-content").val(),
				parent:parent,
				post_id:$(".reply-auto-comment-form").attr("post_id"),
				real_sub:parseInt(real_sub) + 1			
			},
			success:function(data){    
				$("#reply-comment-field-content").val('');
				the_parent.after(data);
				$(".reply-auto-comment-form").slideUp()
			}
			//error:alert("error")
	   })
		 
		
	 });
	 
	 $("body").on("click", ".core-reply", function(e){	 
		var stt = $(this).attr("post_stt");
		
		parent = stt;
		
		$(".reply-auto-comment-form" ).appendTo( "#comment-" + stt ).slideDown();
	 })
	 
	 
	 
	 $("body").on("click", ".close-comment-form", function(e){	
		parent = 0;
		$(this).parent().slideUp();
	 })
	  
	 $("body").on("click", ".core-delete-comment", function(e){	
		
		if(confirm("Xóa bình luận ?"))
		{
			var  comment_id = $(this).attr("post_stt");
			$.ajax({
				url:ajax_href,
				type:"post",
				data:{
					type:"delete_comment", 
					comment_id:comment_id
				},
				success:function(data){    
					$("#comment-" + comment_id).remove()
				}
			})
		}
		
	 })
})