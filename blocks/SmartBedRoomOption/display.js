$(document).ready(function(){


  var slectTing = true;

  $("body").on("click", ".optionItem label", function(){
    //alert("11")
    if($(this).hasClass("checked")) {
      var parent = $(this).closest('.optionItem');

      parent.find("label").removeClass("checked").addClass("uncheck");
      parent.find('.is_default_display').val('no');

      return;
    }

    var parent = $(this).closest('.optionItem');
    var stt = parseInt(parent.attr("stt"));

    if( (stt==0) ){
      for(var i=0;i<=0;i++){
          $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
          $(".optionItem-" + i).find('.is_default_display').val('no');
      }
    }

    if( (stt>=1) && (stt<=4) ){
      for(var i=1;i<=4;i++){
          $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
          $(".optionItem-" + i).find('.is_default_display').val('no');
      }
    }





    if( (stt>=5) && (stt<=8) ){
      for(var i=5;i<=8;i++){
          $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
          $(".optionItem-" + i).find('.is_default_display').val('no');
      }
    }

    if( (stt>=9) && (stt<=10) ){
      for(var i=9;i<=10;i++){
          $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
          $(".optionItem-" + i).find('.is_default_display').val('no');
      }
    }

    if( (stt>=11) && (stt<=12) ){
      for(var i=11;i<=12;i++){
          $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
          $(".optionItem-" + i).find('.is_default_display').val('no');
      }
    }


    $(this).addClass("checked").removeClass("uncheck");
    parent.find('.is_default_display').val('yes');
  });






   $("body").on("submit", ".SmartBedRoomOptionForm", function(e){


     e.preventDefault();
    // $("#col-preview-inner").html("<img class='preview-loading' src='"+ site_url +"/inc/images/ajaxloader.gif' />");
      var col_preview = $(this).find(".col-preview-inner");
      var _this = $(this);
     $.ajax({
       url:site_url + "/inc/?page_type=smartBedRoomAjax",
       type:"post",
       data:$(this).serialize(),
       success:function(data){
         var data_arr = data.split('010516');
         _this.css("background", "url(" + data_arr[0] + ")");

        col_preview.html(data_arr[1]);
        console.log(data);
        
       }
       //error:alert("error")
     });
   });

   $("body").on("change", "input, select", function(){
    $(this).closest('.SmartBedRoomOptionForm').submit();
   });

   setTimeout(()=>{
     $(".block_area_tabs-content-item-1  .SmartBedRoomOptionForm").submit();
   }, 2000)

   $("body").on("click", ".color", function(){
     var code  = $(this).attr("code");
     $(".colorSlect").val(code).change();
     $(".color").removeClass("active");
     $(this).addClass("active");
   });

   $("body").on("click", ".openClose", function(){

     if($(this).hasClass('openState')){
       $(".openCloseInput").val('close').change();
       $(this).removeClass("openState").addClass("closeState");
     } else{
       $(".openCloseInput").val('open').change();
       $(this).removeClass("closeState").addClass("openState");
     }
   });

   $("body").on("click", ".optionItem", function(){

       $(this).closest('.SmartBedRoomOptionForm').submit();
   });

   $("body").on("change", ".selectType", function(){

       var stt = parseInt($(this).attr("stt"));
       var parent = $(this).closest('.SmartBedRoomOptionFormCol1');
       var theValue = $(this).val();
       //alert(".optionItem-" + theValue + " label")
       if(theValue == ''){
         if( stt == 1 ){
           for(var i=1;i<=4;i++){
               $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
               $(".optionItem-" + i).find('.is_default_display').val('no');
           }
         }



         if( stt == 5 ){
           for(var i=5;i<=8;i++){
               $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
               $(".optionItem-" + i).find('.is_default_display').val('no');
           }
         }

         if( stt == 9 ){
           for(var i=9;i<=10;i++){
               $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
               $(".optionItem-" + i).find('.is_default_display').val('no');
           }
         }

         if( stt == 11 ){
           for(var i=11;i<=12;i++){
               $(".optionItem-" + i + " label").removeClass("checked").addClass("uncheck");
               $(".optionItem-" + i).find('.is_default_display').val('no');
           }
         }
         $(".SmartBedRoomOptionForm").submit();
       } else {
         //alert(".optionItem-" + theValue + " label")
         parent.find(".optionItem-" + theValue + " label").click();
         //parent.find(' label').click();
       }


   });

   $("body").on("click", ".block_area_tabs-nav-item", function(){
     var the_par = $(this).attr('the_par');
     //alert(".block_area_tabs-content-item-" + the_par + ' . SmartBedRoomOptionForm')
     $(".block_area_tabs-content-item-" + the_par + ' .SmartBedRoomOptionForm').submit();

   });

   $("body").on("click", ".cart-smartBedroom .add-to-cart, .cart-smartBedroom .view-cart", function(){
     $(".block_area_tabs-content-item.active  .saveCookie").val("yes");
     $(".block_area_tabs-content-item.active .SmartBedRoomOptionForm").submit();
   });


   $(".SmartBedRoomOptionForm").submit();

});
