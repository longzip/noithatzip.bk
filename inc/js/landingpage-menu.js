$("body").ready(function(){
     $("div#main-menu a").click(function(e){
       e.preventDefault();
        
        if( screen.width <=768 ){
             $(".v-toggle-menu").click()
        }
       
       var href = $(this).attr("href");
       
       if(href == site_url) 
       {
            $("html, body").animate({scrollTop : 0 }, "slow");
            window.history.pushState({},"", site_url);
            return;
       }
       
        $("div#main-menu li").removeClass("active");
        var par = $(this).parent().addClass("active").attr("par");
        
        var hash = $(this).attr("href");
        var arr_hash = hash.split("#");
          
        if(arr_hash.length == 2)
        {
            if(arr_hash[1] != '')
            {
                $("html, body").animate({scrollTop : $("#" + arr_hash[1]).offset().top }, "slow");
                window.history.pushState({},"", site_url + "#" + arr_hash[1]);
            }
            else
            {
                location.href = href;
            }
        }
        else
        {
            location.href = href;
        }
        
        
    });
});