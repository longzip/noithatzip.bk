$("document").ready(function(){
    setTimeout(function(){
        
        $("body").find(".mce-menubar .mce-container-body.mce-flow-layout").each(function(){
            $(this).append("<div class='mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-last mce-btn-has-text' id='tinymce-add-block'><div class='core-add-block'></div>" +  + "</div>")
        });
        
        var iframe = $('.mce-edit-area iframe ').contents();
        iframe.find("body .mce-container-body.mce-flow-layout").each(function(){
            
        });   
        
    }, 3000);    
});