$(document).ready(function(){
    
    if( window.innerWidth < 991 ) $("#main-menu").addClass("main-menu-on-mobile");
    
    $("<div class='v-toggle-menu fixed-on-scroll on-mobile'><i class='fa fa-bars'></div>").insertBefore("#main-menu");
    
    $("body").on("click", ".v-toggle-menu", function(){
        $("#main-menu").slideToggle();
    });
    
});
