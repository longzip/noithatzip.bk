$(document).ready(function(){
  var href  = site_url + "/tpl/tpl/150/showRoomAjax.php";


  $.ajax({
     url:href,
     type:"post",
     data:{type:"filter", 'khu_vuc':""},
     success:function(data){
        var data_arr = data.split('010516');
         $(".showRoomCol1").html(data_arr[0]);
         $(".listShowRoom").html(data_arr[1]);
     }
 });

   $(".field-content select").change(function(){
     setTimeout(()=>{
       $.ajax({
          url:href,
          type:"post",
          data:{type:"filter", 'khu_vuc':$(".khu_vuc_input").val()},
          success:function(data){
             var data_arr = data.split('010516');
              $(".showRoomCol1").html(data_arr[0]);
              $(".listShowRoom").html(data_arr[1]);
          }
      });
    }, 1000);
   });

   $("body").on("click", ".showRoomItem", function(){
      $(".showRoomItem").removeClass("active");
      $(this).addClass("active");
      post_id = $(this).attr("post_id");
      $.ajax({
         url:href,
         type:"post",
         data:{type:"viewShowRoom", 'post_id':post_id},
         success:function(data){
             $(".showRoomCol1").html(data);
         }
     });
   });



});
