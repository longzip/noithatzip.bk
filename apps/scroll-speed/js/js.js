$(document).ready(function(e){
    return;
    var lastScrollTop = $(window).scrollTop();
    /*
    $('body').on({
        'mousewheel': function(e) {
             
            if (e.target.id == 'el') return;
            
            var current_scroll_top = $(window).scrollTop();
            var scroll_step = 100;
            var scroll_speed = 500; 
            
            //alert(lastScrollTop);
            //alert(current_scroll_top); 
            
            
            
            
           if (current_scroll_top > lastScrollTop){
               if(lastScrollTop == current_scroll_top) return;
               $("html, body").animate({scrollTop : current_scroll_top + scroll_step}, scroll_speed);
           } else {
              
              if(lastScrollTop == 0) return;
              
              $("html, body").animate({scrollTop : current_scroll_top - scroll_step}, scroll_speed);
           }
           lastScrollTop = current_scroll_top;
           
           e.preventDefault();
            e.stopPropagation();
        }
    });  
    */
    
    $(window).scroll(function(e){
        e.preventDefault();
        e.stopPropagation();
    })  
    //
});