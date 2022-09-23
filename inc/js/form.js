$(document).ready(function() {
    var ajax_href = site_url + "/inc/?page_type=ajax-form";
    $("body").on("submit", ".v-form", function(e) {
        e.preventDefault();
        var this_form = $(this).closest(".wrap-v-form");
        var form_id = $(this).attr("par");
        
        var real_form;
        this_form.find("form").each(function(){
            real_form = $(this);
        });
        
        this_form.find(".v-form-content").each(function(){
            $(this).append('<img class="form-loading" style="display:block;margin:20px auto" src="' + cdn_domain + '/inc/images/loading-submit-form.svg" />')
        });
        
        this_form.find(".v-form").each(function(){
            $(this).css("display", "none");
        });
         
        $.ajax({
            url: ajax_href,
            type: "post",
            data: real_form.serialize(),
            success: function(data) {
                 
                
                
                
                 this_form.find(".v-form-content").each(function(){
                    $(this).append(data);
                });
                 
                
                this_form.find(".v-form-item-submit").each(function() {
                    //$(this).remove();
                });
                this_form.find(" .form-loading").each(function() {
                    $(this).remove();
                });
            }
        });
        
        
    });
    $("body").on("click", ".wrap-v-form .back-form", function(e) {
        var parent = $(this).closest(".wrap-v-form");
        
        parent.find("form").each(function(){
            $(this).css("display", "block");
        });
         
        
        parent.find(".after-submit").each(function(){
            $(this).remove();
        });
    });
    
})