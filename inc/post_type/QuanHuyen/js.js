$(document).ready(function(){
            
            function option_update(field_id)
            {
                var i = 0;
                
                var value_array = new Array();
                
                $("#field-" + field_id).find("input.value").each(function(){
                    value_array[i] = $(this).val();
                    i++;
                });
                $("#value-" + field_id).val(JSON.stringify(value_array));
                
                var i = 0;
                
                var value_display_array = new Array();
                
                $("#field-" + field_id).find("input.value_display").each(function(){
                    value_display_array[i] = $(this).val();
                    i++;
                });
                $("#value_display-" + field_id).val(JSON.stringify(value_display_array));
            }
            
            $("body").on("keyup", ".option_change", function(){
                
                var field_id = $(this).attr("field_id");
                
                
                option_update(field_id)
                
            
            });
            
            $(".new-select-option").click(function(){
                var field_id = $(this).attr("field_id");
                var add = '<div class="relative list-option-item" field_id="' + field_id + '">\
                        <i class="fa fa-wheelchair fl">&nbsp;&nbsp;</i>\
                        <label class="fl" style="width: 257px;">Value : <input value="" class="value option_change" field_id="' + field_id + '" /></label>\
                        <label class="fl"  style="width: 257px;">Display : <input value="" class="value_display option_change" field_id="' + field_id + '"  /></label>\
                        <span class="clear"></span>\
                        <i class="fa fa-remove absolute pointer remove-option"  field_id="'+ field_id +'"></i>\
                    </div>';
                    
                $("#field-" + field_id + " .inner").append(add);
                //alert("#field-" + field_id + " .inner");   
            });
            
            
            $(".option-sortable").sortable({helper:"clone",
                            revert:true,
                            update:function(event, ui){
                                 var  field_id = ui.item.attr("field_id")
                                 option_update(field_id) 
                            }
                        });
                        
                        
            $("body").on("click", ".remove-option", function(){
                var field_id = $(this).attr("field_id");
                
                 
                
                $(this).parent().remove();
                 option_update(field_id);
            });
                                                
        })