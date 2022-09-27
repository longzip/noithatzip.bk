$(document).ready(function(){ 
    
     
    var count = 0;
    var prev_position_x = 0;
    var prev_position_y = 0;
    var arr_position_x = new Array();
    var arr_position_y = new Array();
     
    
    var shift_click = false;
    var ctrl_click = false;
    var delete_click = false;
    
    var count_point_poly = 0;
    
    //var upload_button_type = 'selection';
    
    $("#wrap-svg-map-1 polygon").keydown(function(e){
        if(e.keyCode == 16) shift_click = true;
        if(e.keyCode == 46) delete_click = true;
    });
    
    
    $("#wrap-svg-map-1").keydown(function(e){
        if(e.keyCode == 17) ctrl_click = true;
    });
     
    
    $("body").keydown(function(e){
        if(e.keyCode == 16) shift_click = true;
        if(e.keyCode == 17) ctrl_click = true;
        if(e.keyCode == 46) delete_click = true;
    });
    
    
    
    $("body").keyup(function(e){
        if(e.keyCode == 16) shift_click = false;
        if(e.keyCode == 17) ctrl_click = false;
        if(e.keyCode == 46) delete_click = false;
    });
    
    $("#svg-map-1").click(function(e){        
        if(shift_click) return; 
        if(delete_click) return;
        
        var v_offset = $(this).offset();
        var mouse_left = e.pageX - v_offset.left;
        var mouse_top = e.pageY - v_offset.top;
        
        var svg = document.getElementById('svg-map-1'); //Get svg element
        var newElement = document.createElementNS("http://www.w3.org/2000/svg", 'circle'); //Create a path in SVG's namespace
        newElement.setAttribute("cx",mouse_left);
        newElement.setAttribute("cy",mouse_top);
        newElement.setAttribute("r",2);
        newElement.style.fill = "lim"; //Set stroke colour
         //Set stroke width
        svg.appendChild(newElement);
        
        if(count == 0)
        {
            
        }
        else
        {
            svg = document.getElementById('svg-map-1'); //Get svg element
            newElement = document.createElementNS("http://www.w3.org/2000/svg", 'line'); //Create a path in SVG's namespace
            newElement.setAttribute("x1",prev_position_x);
            newElement.setAttribute("y1",prev_position_y);
            newElement.setAttribute("x2",mouse_left);
            newElement.setAttribute("y2",mouse_top); 
            
            newElement.style.stroke = "red"; //Set stroke colour
            newElement.style.strokeWidth = "2px"; //Set stroke width
            svg.appendChild(newElement);
            
        }
        count++;
        prev_position_x = mouse_left;
        prev_position_y = mouse_top;
        arr_position_x[count] = mouse_left;
        arr_position_y[count] = mouse_top;
        count_point_poly++;
    });
    
    $("#svg-map-1").click(function(e){
        
        if(!ctrl_click) return;
        if(delete_click) return;
        
        if(count_point_poly <=2) {
            alert("Phải nối ít nhất 3 điểm để tạo thành 1 vùng");
            return;
        }
        var svg = document.getElementById('svg-map-1'); //Get svg element
        var newElement = document.createElementNS("http://www.w3.org/2000/svg", 'polygon'); //Create a path in SVG's namespace
        var points = '';
        for(i in arr_position_x)
        {
            points = points + arr_position_x[i] + ',' +  arr_position_y[i]+ ' ';
        }
        newElement.setAttribute("points",points);
        newElement.style.stroke = "blue"; //Set stroke colour
        newElement.style.strokeWidth = "1px"; //Set stroke width
        newElement.style.fill = "yellow";
        newElement.setAttribute("class","stt-" + stt_polygon);
        newElement.setAttribute("data-src","");
        newElement.setAttribute("id","polygon-stt-" + stt_polygon);
        svg.appendChild(newElement);
        
        newElement.setAttribute("stt",stt_polygon);
        stt_polygon++;
        
        count = 0;
        arr_position_x = new Array();
        arr_position_y = new Array();
        count_point_poly = 0;
        
        $("#svg-map-1 line").remove();
        $("#svg-map-1 circle").remove();
    });
    
    $("body").on("click", "#svg-map-1 polygon", function(){
         
        if(!shift_click) return; 
        stt = $(this).attr("stt");
        
        $(".show-media-frame-image-map").click();
        upload_button_type = 'selection';
        //$(this).attr("data-src", data_src);
    });
    
    $("body").on("click", "#svg-map-1 polygon", function(){
        if(!delete_click) return;
        $(this).remove();
    });
    
    $("body").on("click", "#svg-map-1 line", function(){
        if(!delete_click) return;
        $(this).remove();
    });
    
    $("body").on("mouseenter", "#svg-map-1 polygon", function(){
        var data_src = $(this).attr("data-src");
        if(data_src == "") $(".preview-image").html("<p>Chưa có ảnh chi tiết</p>");
        else $(".preview-image").html("<img src='" + data_src + "' />");
    });
    
    $("body").on("mouseleave", "#svg-map-1 polygon", function(){
        $(".preview-image").html("<p style='color:#03A9F4'>Trỏ chuột vào vùng chọn màu vàng để xem ảnh lớn ở đây</p>");
    });
    
    $("#reset-image-map").click(function(e){
        $("svg line").remove();
        $("textarea").html($("#wrap-svg-map-1").html());
    });
    
    $("body").on("click", "#reset-remain", function(){
        $("#svg-map-1 circle").remove();
        $("#svg-map-1 line").remove();
        count = 0;
    });
    
    $("body").on("click", "#reset-all", function(){
        $("#svg-map-1").empty();
        count = 0;
    });
    
    var stt_polygon = 1;
    $("body").find("polygon").each(function(){
        $(this).attr("class", "stt-" + stt_polygon).attr("id", "polygon-stt-" + stt_polygon).attr("stt", stt_polygon);
        stt_polygon++;
    });
     
    $("#the-polygon_count").val(stt_polygon);
    
     
});