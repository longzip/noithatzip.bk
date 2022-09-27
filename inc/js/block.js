$(document).ready(function(){

    

    /**

     * FUNCTIONS

     */

     $("body").find(".core-edit-option-icon").each(function(){

        $(this).parent().css("position", "relative").addClass("option-parent");

    });

	  

      $(".block-content").addClass("clearfix");

	 

     $("a").click(function(e){

        e.preventDefault();        

        //alert("Tắt chế độ DESIGN để truy cập link")

        $("body").append('<div class="design-click-link-noti">Tắt chế độ <strong>Design</strong> để truy cập link</div>');

        setTimeout(function(){

            $(".design-click-link-noti").css("opacity", "1");

        }, 100);

        

        setTimeout(function(){

            $(".design-click-link-noti").css("opacity", "0");

        }, 8800);

        

        setTimeout(function(){

            $(".design-click-link-noti").remove();

        }, 16800);

     })

     

     

     $(".block_area").append("<span class='clear'></span>");

     

     var href = 'https://noithatzip.com' + "/admin/?page_type=inc-handle-ajax";

	 

	 //document.write(href);

	 

	function open_opacity()

	{

		$("#hcv-opacity").addClass("hcv-opacity");

		$("#block-loading").css("display", "block");		

	}

	

	function close_opacity()

	{

		$("#hcv-opacity").removeClass("hcv-opacity");

		$("#block-loading").css("display", "none");		

	}

	

	function append_block_action()

	{

		$(".block_area .core-block").append('<span title="Xóa Block" class="delete_block block_action"></span>\

                        <span title="Sửa Block" class="update_block block_action"></span>\

						<div class="block-borer"></div>');

						

		$(".block_area").append('<div class="block-area-borer"></div>');

	}

	

    function open_setting_form(block_id, block_name, block_area_name)

    {

        

    }

    

    function update_area_content(update_block_area_content, area_name)

    {

		//alert(update_block_area_content);

        $.ajax({

            url:href,

            type:"post",

            data:{

                type:"update_area_content",

                update_block_area_content:update_block_area_content,

                area_name:area_name

            },

            success:function(data){               

                //alert(data)

            }

            //error:alert("error")

        })

    }

    

    function save_setting(block_id, block_name, block_area_name, item)

    {          

        var i = 0;

        var key = new Array();

        var value = new Array();

        

        $("#dialog").dialog({width: 950,close:function(){

				

				close_opacity();

				

				$("#dialog").remove();

				

				//var block_id = item.attr("block_id")

		

				if(block_id != 0)

				{

					append_block_action();

						

				}

				if(block_id == 0)

				{

					item.removeClass("core-block").css("display", "none");

					 

				}

				

				//item.removeClass("block");

				

			},buttons:[{text:"Save", click:function(){

		    $(".ui-dialog-buttonset .ui-button-text").replaceWith("<img src='" + cdn_domain + "/inc/images/loading-save-block.png' />")

			var block_title = '';

			

			if($("#dialog iframe").contents().find("#title-parameter").each(function(){

				block_title = $(this).val();

			}))

            

            var block_title_link = '';

			

			if($("#dialog iframe").contents().find("#title-link-parameter").each(function(){

				block_title_link = $(this).val();

			}))

             

            

            if($("#dialog iframe").contents().find(".array_form").length == 0)

            {

                var form_type = "form";

                $("#dialog iframe").contents().find(".parameter").each(function(){

                    key[i] = $(this).attr("parameter");

                    value[i] = $(this).val();

                    i++;

                });

            }

            else

            {

                var form_type = "array";

               $("#dialog iframe").contents().find(".array_form").each(function(){

                    var child =$("#dialog iframe").contents().find(".parameter-depth-1").length;

                    if(child == 0)

                    {

                        key[i] = $(this).attr("parameter");

                        value[i] = $(this).val();

                        i++;

                    }

                    else

                    {

                        value[i] = new Array();

                        key[i] = new Array();

                        var j = 0;

                        $(this).find(".parameter-depth-1").each(function(){

                            value[i][j] = $(this).val();

                            key[i][j] = $(this).attr("parameter");

                             j++;

                        });

                        i++;

                    }

                    

                });

            }

            /*

            })*/

            

            $.ajax({

                url:href,

                type:"post",

                data:{

                    type:"save_setting",

                    form_type:form_type,

                    block_area_name:block_area_name,

                    block_id:block_id,

                    block_name:block_name,

                    key:key,

                    value:value,

					block_title:block_title,

                    block_title_link:block_title_link

                },

                success:function(data){

                    $("#dialog").dialog("close");

                    $(".opacity").css("display","none");

                    $("#dialog").remove();

                    item.replaceWith(data);

                    //$("*[block_area_name='" + block_area_name +"']").append(data);

                    var update_block_area_content = '';

                    var j = 0;

                    

                    var temp_stt_area = 1;

                    $("body").find(".area_" + block_area_name).each(function(){

                       

                       

                        

                       if(temp_stt_area > 1) return;

                        

                       $(this).find(".core-block").each(function(){

                            if(j== 0) update_block_area_content +=  $(this).attr("block_id");

                            else update_block_area_content += "," + $(this).attr("block_id");

                            j++;

                        });

                        temp_stt_area++;

                    });

                     

					

					

                    

                    update_area_content(update_block_area_content, block_area_name);            

					append_block_action()

                }

            })

        }}]});

        

    }

    

    function save_sort(block_area_name)

    {

        var update_block_area_content = '';

        var j = 0;

        $("*[block_area_name='" + block_area_name +"']").find(".core-block").each(function(){

            if(j== 0) update_block_area_content +=  $(this).attr("block_id");

            else update_block_area_content += "," + $(this).attr("block_id");

            j++;

        });

        //alert(update_block_area_content)

        

        update_area_content(update_block_area_content, block_area_name);     

    }

    /**

     * END FUNCTIONS

     */

    

    

    $(".draggable").draggable({cursor:"move",opacity:0.4, revert:"invalid",helper:"clone", connectToSortable:".sortable"});

    

    $(".sortable").sortable({

         

        helper:"clone", 

        connectWith:".sortable",

        placeholder:"ui-state-highlight",

        scrollSpeed:500,

        revert:true,

        placeholder: "ui-state-highlight",

        forcePlaceholderSize: true, 

        items: "> div:not(.core-add-block)", 

        update:function(event, ui){

            var block_area_name = $(this).attr("block_area_name")

            var block_name = ui.item.attr("block_name");

            var block_id = ui.item.attr("block_id");

            

            

            

            if(block_id == 0)

            { 

    		

    			open_opacity()

               $.ajax({

                    url:href,

                    type:"post",

                    data:{

                        type:"load_form_setting",

                        block_name:block_name                

                    },

                    success:function(data){

                        $("body").append(data); // append #dialog

                        var item = ui.item;

                        save_setting(block_id, block_name, block_area_name,item);

                        

                        $("#dialog").dialog("open");

                        

                        $(".hcv-opacity").css("display","block");

                    }

                }); 

            }

            else

            {

                save_sort(block_area_name);    

            }

        

    }});

    

    $("body").on("click", ".update_block", function(){

        var block = $(this).parent();

        var block_id = block.attr("block_id");

        

		open_opacity();

		

        var block_name = block.attr("block_name");

        var block_area_name = $(this).parent().parent().attr("block_area_name");

        $.ajax({

            url:href,

            type:"post",

            data:{

                type:"update_setting",

                block_name:block_name,

                block_id:block_id             

            },

            success:function(data){

                $("body").append(data);  // append #dialog

                save_setting(block_id, block_name, block_area_name,block);

                //block.replaceWith(data);

                $("#dialog").dialog("open");

                open_opacity()

                //$(".opacity").css("display","block");

                

            }

        }); 

        //open_setting_form(block_id, block_name, block_area_name)

    });

    

    $("body").on("click", ".delete_block", function(){

		var block_title = $(this).parent().attr("block_title");

        var xac_nhan_text = prompt('Xóa Block :  '+ block_title + ' ?    Điền "y" xác nhận ' , "");

        if(xac_nhan_text == "y")

        {

            var block = $(this).closest(".core-block");

            var block_id = block.attr("block_id");

            //alert(block_id);

            var block_name = block.attr("block_name");

            var block_area_name = block.parent().attr("block_area_name");

            $.ajax({

                url:href,

                type:"post",

                data:{

                    type:"delete_block",

                    block_id:block_id             

                },

                success:function(data){

                    // alert(data)

                    if(parseInt(data) == 1 ){

                        block.remove();

                    } 

                    //save_setting(block_id, block_name, block_area_name);

                    //alert(data)

                    //$("#dialog").dialog("open");

                    //$(".opacity").css("display","block");

                    save_sort(block_area_name);

                    

                }

            });

        }

        return;

        if(confirm('Xóa Block : "'+ block_title +'"?'))

        {

            if(confirm('Xác nhận xóa : "'+ block_title +'"?'))

            {

                

            }

            

        }

        //open_setting_form(block_id, block_name, block_area_name)

    });

    

    

    

    /**

     * Media Frame

     */

     var current_frame;

    $("#media-frame").css("left",(screen.width-780)/2  + "px");

    $("#media-frame").css("top",(screen.height-320)/2 - 80 + "px");

    

    var frame_src = site_url + "/admin/js/index.php?multi_select=0";

    

    $("body").on("click", ".show-media-frame", function(){

        //$("#media-frame").css("display", "block").prepend("<iframe class='hcv' src='" + frame_src +"' width='780px' height='320px'></iframe>");

        $("#media-frame").css("display", "block").prepend("<iframe class='hcv' src='" + site_url + "/admin/?page_type=media-dir' width='780px' height='320px'></iframe>");

        

        

		open_opacity()

		

        //$(".opacity-frame").css("display", "block");

        current_frame = $(this).attr("particular");

    });

    

    $(".close-frame").click(function(){

        $("#media-frame").css("display", "none");

        $("#media-frame iframe").remove();

        open_opacity()

        //$(".opacity-frame").css("display", "none");

    });

    

    $(".submit-frame").click(function(){

        $("iframe.hcv").contents().find(".box.active img").each(function(){

            src = $(this).attr("src");

            

            $("#" + current_frame ).val(src);

            

            $("#" + current_frame + "_display").attr("src", src);

        });

    

        $("iframe.hcv").contents().find("#insert_by_link_form").each(function(){

            $(this).find("#link_insert").each(function(){

                src = $(this).val();

            })

            $("#" + current_frame ).val(src);

            $("#" + current_frame +"_display").attr("src", src);            

        });  

        

        $("#media-frame").css("display", "none");

        $("#media-frame iframe").remove();

        open_opacity()

        //$(".opacity-frame").css("display", "none");

    });

    

    $("body").on("change", ".select_image", function(){

        var id = $(this).attr("id")

        $("#" + id + "_display").attr("src", $(this).val());

    })

    

    append_block_action()

    

	/** $("body").find(".block_area").each(function(){

		var height = $(this).height();

		$(this).height(height-2);

		

		var width = $(this).width();

		$(this).width(width-2)

	})

	

	$("body").find(".block_area .block").each(function(){

		var height = $(this).height();

		$(this).height(height+2);

		

		var width = $(this).width();

		$(this).width(width+2)

	}) **/

	

    $( ".sortable" ).disableSelection();

    

    $("body").on("click", ".core-edit-option-icon", function(){

        var option_name = $(this).attr("par");

          

		open_opacity();

		

         

        $.ajax({

            url:href,

            type:"post",

            data:{

                type:"loading_option",

                option_name:option_name,  

            },

            success:function(data){

                 

                $("body").append(data);

                 

            }

        }); 

        //open_setting_form(block_id, block_name, block_area_name)

    });

    

    $("body").on("click", ".action-option-save", function(){

        var option_name = $(this).attr("par");

        var value = '';

        

        $("#dialog-option iframe").contents().find("#option-content").each(function(){

		      value = $(this).val();

		});

        

		open_opacity();

		

        $.ajax({

            url:href,

            type:"post",

            data:{

                type:"save_option",

                option_name:option_name,

                value:value  

            },

            success:function(data){

                location.reload();

            }

        });

    });

    

    $("body").on("click", ".action-option-close", function(){

         $("#dialog-option").remove();

         close_opacity();

    });

    

    

    $("body").find(".block_area").each(function(){

            var block_area_id = $(this).attr("block_area_id");

             

            $(this).append("<div title='Thêm Block trong khu vực này' class='core-add-block' block_area_id='" + block_area_id + "'>Thêm Block</div>") 

    });

    

    $("body").on("click", ".core-add-block", function(){

         var block_area_id = $(this).attr("block_area_id");

         open_opacity();

         $.ajax({

            url:href,

            type:"post",

            data:{

                type:"load_list_block",

                block_area_id:block_area_id

            },

            success:function(data){

                 

                $("body").append(data);

                 

            }

         });  

    });

    

    

    $("body").on("click", "iframe", function(){

          alert("sdf")

    });

     

    $("body").on("mousemove", ".core-list-block-item", function(e){

        

            

            

          var block_name = $(this).attr("block_name");

          $(".core-list-block-item, .core-list-block-item").removeClass("active");

          $(this).addClass("active");

          $(this).parent().addClass("active");

          

          $("#core-list-block-col-2").css("display", "block"); 

          

          if( e.clientX > (window.innerWidth / 2) )

          {

                $("#core-list-block-col-2").css("right", "auto").css("left", e.clientX - 400 + "px" ).css("top", e.clientY + 30 + "px" )

          } 

          else

          {

                $("#core-list-block-col-2").css("left", "auto").css("right", window.innerWidth - e.clientX - 400 + "px" ).css("top", e.clientY + 30 + "px" )

          }

           

          $(".core-list-block-description-item").removeClass("active"); 

          $(".core-list-block-description-item-" + block_name).addClass("active");

    });

    

     $("body").on("mouseout", ".core-list-block-item", function(e){

        $("#core-list-block-col-2").css("display", "none");

         

     })

    

    $("body").on("click", ".popup-frame-action-close, .opacity", function(){

           $(".popup-frame").remove();

           close_opacity();

    });

    

    $("body").on("dblclick", ".core-list-block-item", function(){

            

            //$("#list_block .core-block-text").appendTo(".block_area_3")

           

           

           var block_area_name  = $(".popup-frame-list-block-area").attr("block_area_name");

           var block_area_id  = $(".popup-frame-list-block-area").attr("block_area_id");

           

           $(".popup-frame").remove();

            

           var block_id = 0;

           var block_name = $(this).attr("block_name");

           $('<div block_name="'+block_name+'" block_id="0" class="new draggable core-block  core-block-'+block_name+' fl bold verdana '+block_name+'">'+block_name+'</div>').insertBefore(".block_area_" + block_area_id + " .core-add-block");

           var item = $(".block_area_" + block_area_id + ' .new.core-block-'+block_name);

           $.ajax({

                url:href,

                type:"post",

                data:{

                    type:"load_form_setting",

                    block_name:block_name           

                },

                success:function(data){

                    

                    $("body").append(data); // append #dialog

                    

                    save_setting(block_id, block_name, block_area_name, item);

                    

                    $("#dialog").dialog("open");

                    

                    $(".hcv-opacity").css("display","block");

                }

            });

            

    });

    

    $("body").on("click", ".core-list-block-item-select", function(){

        $(this).parent().dblclick();

    });

    

     

});