$("document").ready(function(){
    var myVar;
    
    $("body").on("click", "label.forum-label", function(){
        document.getElementById("loader").style.display = "block";
        myVar = setTimeout(showPage, 100);
            
    });
    
    function myFunction() {
        document.getElementById("loader").style.display = "block";
        myVar = setTimeout(showPage, 3000);
    }
    
    function showPage() {
      document.getElementById("loader").style.display = "none";
    }
    
    
    
    
    
});