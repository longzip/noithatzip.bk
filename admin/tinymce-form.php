 <script>
        var site_url = "<?php echo SITE_URL; ?>";
        var cdn_domain = "<?php echo CDN_DOMAIN; ?>";
     </script>
    
    <script lang="javascript" src="<?php echo CDN_DOMAIN . '/apps/js/jquery-1.9.1.min.js'; ?>"></script>

<div id="tinymce-form" class="arial">
    <br />
    <label class="label">Tiêu đề</label>
    <input id="form-title" class="text" value="" />
    <span class="clear"></span><br /><br /><br /><br />
    
	<label class="label">Chọn Form</label>
	<select id="form-id" name="form_id" style="padding: 5px 10px;min-width:200px" class="text form-control parameter" >
    <?php 
        $list_forms = get_forms(array('the_type'=>'form'));
        foreach($list_forms as $list_form)
	    {
	        ?>
            <option value="<?php echo $list_form['id'] ?>"><?php echo $list_form['name'] ?></option>
            <?php  
        }
    ?>
    </select>
    <textarea id="html-content" style="display:none"  class="none"></textarea>
    
    <script>
        $(document).ready(function(){
            var href = site_url + '/admin/?page_type=handle-ajax';
           
            
            $("#form-id").change(function(){
                 var form_id = $("#form-id").val();
                $.ajax({            
						url:href,
						type:"POST",
						data:{type:"tinymce_get_form_html", form_id:form_id},
						success:function(data){
							$("#html-content").val("<p></p>" + data + "<p></p>");
						}
					}); 
            });
            
            
            $("#form-id").change();
        });
    </script>
</div>

<style>

    *{
        font-size:13px;
    }
    .arial{
        font-family:arial;
    }
    
    input.text{
        border-radius: 2px;
        border: 1px solid rgb(218, 213, 213);
        padding: 4px 10px;
        width: 300px;
    }
    label{
        display:inline-block;
        width:120px;
    }
</style>
 