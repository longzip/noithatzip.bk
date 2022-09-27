<script> 
    var slide_item_width_<?php echo $slide_name ?> = "<?php echo $slide_item_width ?>";
	
	if($(window).width() < slide_item_width_<?php echo $slide_name ?>) slide_item_width_<?php echo $slide_name ?> = $(window).width()
	
	 
	var image_scale_<?php echo $slide_name ?> = <?php echo $slide_item_width/$slide_item_height ?>
	
	var slide_item_height_<?php echo $slide_name ?> = slide_item_width_<?php echo $slide_name ?>/image_scale_<?php echo $slide_name ?>;
	 
	 
    var slide_timer_<?php echo $slide_name ?> = "<?php echo $slide_timer ?>";
    
    var current_margin_left_<?php echo $slide_name ?> = 0;
    
    $(document).ready(function(){
        
	$(".flex-slide-item_<?php echo $slide_name ?>").css("height", slide_item_height_<?php echo $slide_name ?> + "px");
	$(".flex-slide-item_<?php echo $slide_name ?>").css("width", slide_item_width_<?php echo $slide_name ?> + "px");
	
    var slide_interval_<?php echo $slide_name ?> = setInterval(function(){
        $(".<?php echo $slide_name ?>-next").click()
    }, <?php echo $slide_timer ?>)
    
    
    $(".<?php echo $slide_name ?>-next").click(function(){
        var particular = $(this).attr("particular");
        var current_slide = $("#wrap-<?php echo $slide_name ?>-" + particular).attr("current_slide");
        var count_slide_item = $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-item").size();
        
        if(current_slide < count_slide_item)
        {
            current_slide++;
            $("#wrap-<?php echo $slide_name ?>-" + particular).attr("current_slide", current_slide);
            
            $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>").animate({"margin-left": "-" + (current_slide -1)*slide_item_width_<?php echo $slide_name ?>,}, <?php echo $slide_transition ?>, "swing");
            
            
        }
        else
        {
            current_slide = 1;
            $("#wrap-<?php echo $slide_name ?>-" + particular).attr("current_slide", current_slide);
            
            $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>").animate({"margin-left": "-" + (current_slide -1)*slide_item_width_<?php echo $slide_name ?>,}, <?php echo $slide_transition ?>, "swing")
        }
        
        $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-nav-item").removeClass("active");
        $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-nav-item-" + current_slide).addClass("active");
        
		clearInterval(slide_interval_<?php echo $slide_name ?>);
        
		slide_interval_<?php echo $slide_name ?> = setInterval(function(){
			$(".<?php echo $slide_name ?>-next").click();
		}, <?php echo $slide_timer ?>)
    
		current_margin_left_<?php echo $slide_name ?> = parseInt($(".<?php echo $slide_name ?>").css("margin-left"));
		//alert(current_margin_left_<?php echo $slide_name ?>)
	})
    
    
    $(".<?php echo $slide_name ?>-prev").click(function(){
        var particular = $(this).attr("particular");
        var count_slide_item = $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-item").size();
        var current_slide = $("#wrap-<?php echo $slide_name ?>-" + particular).attr("current_slide");
        
        if(current_slide > 1)
        {
            current_slide--;
            $("#wrap-<?php echo $slide_name ?>-" + particular).attr("current_slide", current_slide);
            
            $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>").animate({"margin-left": "-" + (current_slide - 1)*slide_item_width_<?php echo $slide_name ?>,}, <?php echo $slide_transition ?>, "swing");
            
            
        }
        else
        {
            current_slide = count_slide_item;
            $("#wrap-<?php echo $slide_name ?>-" + particular).attr("current_slide", current_slide);
            
            $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>").animate({"margin-left": "-" + (current_slide - 1)*slide_item_width_<?php echo $slide_name ?>,}, <?php echo $slide_transition ?>, "swing");
        }
        
        $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-nav-item").removeClass("active");
        $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-nav-item-" + current_slide).addClass("active");
        
		clearInterval(slide_interval_<?php echo $slide_name ?>);
        
		current_margin_left_<?php echo $slide_name ?> = parseInt($(".<?php echo $slide_name ?>").css("margin-left"));
		
		
		slide_interval_<?php echo $slide_name ?> = setInterval(function(){
			$(".<?php echo $slide_name ?>-next").click()
		}, <?php echo $slide_timer ?>)
         
    })
    
    
    $(".<?php echo $slide_name ?>-nav-item").click(function(){
        var particular = $(this).attr("particular");
        var count_slide_item = $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-item").size();
        var slide_stt = $(this).attr("slide_stt");
        var current_slide = slide_stt
        $("#wrap-<?php echo $slide_name ?>-" + particular).attr("current_slide", current_slide);
        
        $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>").animate({"margin-left": "-" + (current_slide - 1)*slide_item_width_<?php echo $slide_name ?>,}, <?php echo $slide_transition ?>, "swing");
        $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-nav-item").removeClass("active");
        $("#wrap-<?php echo $slide_name ?>-" + particular + " .<?php echo $slide_name ?>-nav-item-" + current_slide).addClass("active");
        
        clearInterval(slide_interval_<?php echo $slide_name ?>);
        
		slide_interval_<?php echo $slide_name ?> = setInterval(function(){
			$(".<?php echo $slide_name ?>-next").click()
		}, <?php echo $slide_timer ?>) 
    });
	
	function on_resize_slide()
	{
		var count_slide_item = $("#wrap-<?php echo $slide_name ?>-<?php echo $slide_name ?> .<?php echo $slide_name ?>-item").size();
		slide_item_width_<?php echo $slide_name ?> = $(".wrap-<?php echo $slide_name ?>").parent().width();
		slide_item_height_<?php echo $slide_name ?> = slide_item_width_<?php echo $slide_name ?>/image_scale_<?php echo $slide_name ?>;
		$(".<?php echo $slide_name ?>").width( slide_item_width_<?php echo $slide_name ?> * count_slide_item );
		$(".<?php echo $slide_name ?>-item").width( slide_item_width_<?php echo $slide_name ?> ).height(slide_item_height_<?php echo $slide_name ?>);
		$(".right-left-nav.next").css("right", parseInt($(".wrap-<?php echo $slide_name ?>").width() + 10 - slide_item_width_<?php echo $slide_name ?> ) + "px");
		$(".<?php echo $slide_name ?>-nav").width( slide_item_width_<?php echo $slide_name ?>  );
		
		//alert( slide_item_width_<?php echo $slide_name ?> );
	}
	
	$( window ).resize(function() {
	    on_resize_slide();
		$(".<?php echo $slide_name ?>-next").click();
	});
	on_resize_slide();
	/** 
	var mouse_pointer_x_before = 0;
	var mouse_pointer_x_after = 0;
	var slide_mouse = 0;
	
	
	$(".<?php echo $slide_name ?>").mousedown(function(e){
		//mouse_pointer_x_before = e.pageX;
		
		
		//alert(mouse_pointer_x_before);
	})
	
	var range_move = 0;
	
	$(".<?php echo $slide_name ?>").mouseup(function(e){
		
		
		alert("mouseup")
		
		if(range_move > 0)
		{
			$(".<?php echo $slide_name ?>-prev").click()
		}
		else
		{
			$(".<?php echo $slide_name ?>-next").click()
		}
		slide_mouse = 0;
		
		slide_interval_<?php echo $slide_name ?> = setInterval(function(){
			$(".<?php echo $slide_name ?>-next").click()
		}, <?php echo $slide_timer ?>)  
	})
	
	
	
	$(".<?php echo $slide_name ?>").mousedown(function(e){
		alert("mousedown")
	
		slide_mouse = 1;
		
		mouse_pointer_x_before = e.pageX;
		
		current_margin_left_<?php echo $slide_name ?> = parseInt($(".<?php echo $slide_name ?>").css("margin-left"));
		
	})
	
	
	
	$( document ).on ( "vmousemove", ".<?php echo $slide_name ?>", function(e) {
	//$(".<?php echo $slide_name ?>-item-wrap-link").mousemove(function(e){
		
		if(slide_mouse==1)
		{
			var range_move = e.pageX - mouse_pointer_x_before;
			var next_left = current_margin_left_<?php echo $slide_name ?> + range_move;
			
			var last_range = ($(" .<?php echo $slide_name ?>-item").size() - 1) * slide_item_width_<?php echo $slide_name ?>
			
			if((next_left<=0)&&(next_left>=-last_range))
			{
				$(".<?php echo $slide_name ?>").css("margin-left", next_left + "px");
			}
			
		}
		
		
		clearInterval(slide_interval_<?php echo $slide_name ?>);
        
		
		 
	})
	
	$(".<?php echo $slide_name ?>").on("swipeleft",function(){
		alert("swipeleft")
	
	   slide_interval_<?php echo $slide_name ?> = setInterval(function(){
			$(".<?php echo $slide_name ?>-next").click()
		}, <?php echo $slide_timer ?>)
	});
	
	$(".<?php echo $slide_name ?>").on("swiperight",function(){
		alert("swiperight")
	   slide_interval_<?php echo $slide_name ?> = setInterval(function(){
			$(".<?php echo $slide_name ?>-prev").click()
		}, <?php echo $slide_timer ?>)
	});  **/
})
    
</script>
