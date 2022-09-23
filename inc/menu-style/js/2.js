$(document).ready(function(){
     $("#v-toggle-menu").click(function(){
         
         if($("#main-menu").hasClass("active"))
         {
            $(".v-menu-opacity").css("display", "none");
         }
         else
         {
            $(".v-menu-opacity").css("display", "block");
         }
         $("#main-menu").toggleClass("active");
         $(this).toggleClass("active");
             
      });
      
       
    $(".v-menu-opacity").click(function(){        
        $("#main-menu").removeClass("active");
        $("#v-toggle-menu").removeClass("active");
        $(".v-menu-opacity").css("display", "none");
    });
    
    $(".menu-arrow").click(function(){
        $(this).toggleClass("active");
            var the_parent = $(this).parent();
            the_parent.find(".sub-menu").each(function(){
            $(this).slideToggle();
        });
    });

});