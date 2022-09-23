$(document).ready(function() {
    if (window.innerWidth < 991) $("#main-menu").addClass("main-menu-on-mobile");
    var menu_par = 1;
    $("#main-menu").find("li").each(function() {
        $(this).attr("par", menu_par).addClass("menu-item-" + menu_par);
        menu_par++
    });
    menu_par = 1;
    $("#main-menu").find(".menu-arrow").each(function() {
        $(this).attr("par", menu_par).addClass("menu-arrow-" + menu_par);
        menu_par++
    });
    menu_par = 1;
    $("#main-menu").find(".sub-menu").each(function() {
        var _this = $(this);
        $(this).attr("par", menu_par).addClass("sub-menu-" + menu_par);
        menu_par++
        var parent_item = $(this).closest('li');
        var parent_item_par = parent_item.attr("par");
        var parent_item_text = $(".menu-item-" + parent_item_par + " > a:first-of-type").text();
        if (window.innerWidth < 991) _this.prepend('<li class="back-to-parent">' + parent_item_text + '</li>');
    });
    $("body").append('<div class="v-toggle-menu"><i class="fa fa-bars" aria-hidden="true"></i></div>');
    $("body").append('<div class="none v-toggle-menu-opactiy"></div>');
    $("body").on("click", ".v-toggle-menu", function() {
         
        if ($(".v-toggle-menu").hasClass("active")) {
            $(".v-menu-opacity").css("display", "none");
            $("#main-menu, .v-toggle-menu-opactiy").removeClass("active");
            $(".sub-menu").removeClass("active");
             
        } else {
            $(".v-menu-opacity").css("display", "block");
            $("#main-menu, .v-toggle-menu-opactiy").addClass("active");
            $(".sub-menu").removeClass("active");
        }
        $(this).toggleClass("active");
        $("body").toggleClass("while-toggle");
    });
    $("body").on("click", ".v-toggle-menu-opactiy", function() {        
        $("#main-menu, .v-toggle-menu-opactiy, .v-toggle-menu").removeClass("active");
    });
    
    $("body").on("click", ".menu-arrow", function() {
        var par = $(this).attr("par");
        $("#main-menu").removeClass("active");
        $(".sub-menu").removeClass("active");
        $(".sub-menu-" + par).addClass("active");
    });
    $("#main-menu").on("click", ".back-to-parent", function() {
        var parent_item = $(this).parent().parent().parent();
        if (parent_item.hasClass("sub-menu")) {
            $("#main-menu").removeClass("active");
            $(".sub-menu").removeClass("active");
            $(parent_item).addClass("active");
        } else {
            $("#main-menu").addClass("active");
            $(".sub-menu").removeClass("active");
        }
    });
});