$(document).ready(function(){ 
	
    //tabs
    
    var i = 1;
    var j = 1;
    $("body").find(".v-tabs").each(function(){
        $(this).addClass("v-tabs-" + i).attr("par", i);
        i++;
    });
    
    
    $("body").find(".v-tabs").each(function(){
        j = 1;
        var par = $(this).attr("par");
        
        i = 1;
        $("body").find(".v-tabs-" + par + " .v-tabs-nav-item").each(function(){
            if(j==1) $(this).addClass("active");
            $(this).attr("par", j);
            j++;
        });
        
        i = 1;
        $("body").find(".v-tabs-" + par + " .v-tabs-content-item").each(function(){
            if(i==1) $(this).addClass("active");
            $(this).addClass("v-tabs-content-item-" + i);
            i++; 
        });
    });
    
    
    
    
    
    
    
    $(".v-tabs-nav-item").click(function(){
        var parent_par = $(this).closest(".v-tabs").attr("par");
        var par = $(this).attr("par");
        
         
        
        $( ".v-tabs-" + parent_par + " .v-tabs-nav-item").removeClass("active");
        $(this).addClass("active");
        
        
        $(".v-tabs-" + parent_par + " .v-tabs-content-item").css("display", "none");
        $(".v-tabs-" + parent_par + " .v-tabs-content-item-" + par).css("display", "block");
        
        setTimeout(function(){
            $(".v-tabs-" + parent_par +  " .v-tabs-content-item").removeClass("active");
            $(".v-tabs-" + parent_par +  " .v-tabs-content-item-" + par).addClass("active");
            ///$(".v-tabs-content-item  .home-general-item-image").removeClass("active");
            //$(".v-tabs-content-item-" + par + " .home-general-item-image").addClass("active");
        }, 10);
    })
    
    //end tabs
    
})