$(document).ready(function(){
    $("#v-toogle-menu").click(function(){
        if($("#main-menu").hasClass("active"))
        {
            $(".v-menu-opacity").css("display", "none");
        }
        else
        {
            $(".v-menu-opacity").css("display", "block");
        }
        $("#main-menu").toggleClass("active");
    });
    
    
    $(".v-menu-opacity").click(function(){
        
        $("#main-menu").removeClass("active");
        $(".v-menu-opacity").css("display", "none");
    });
    
    $(".menu-arrow").click(function(){
        $(this).toggleClass("active");
         var the_parent = $(this).parent();
         //$("#main-menu .sub-menu").slideUp();
         the_parent.find(".sub-menu").each(function(){
            $(this).slideToggle();
         });
  });
      
});