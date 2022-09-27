<?php
$default = array(
    'title'             => '',
    'content'           => '',
    'title_link'        => '',
    'color'             => '',
    'background-color'  => '',
    'background-image'  => '',
    'block_sub_title'   => ''
    
);



if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;

//h($default);

?>

<?php tinymce_setting() ?>
 <script type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/jscolor-2.0.4/jscolor.js"></script>

<form id="text_form_setting" class="block_form" block_id="0">
  
    <?php  display_block_setting_default($default);  ?>
    
    <div class="form-group clearfix">
        <label class="block" style="float: none;margin-bottom: 10px;" for="name">Nội dung</label>        
        <div class="fr" >
            <textarea class="form-control parameter main-content" parameter="content"><?php echo $default['content'] ?></textarea>
        </div>
    </div>
    
    
    
    <div class="view-advanced">Nâng cao</div>
    <div class="advanced none">
        <?php include PATH_ROOT . '/blocks/advanced-setting-form.php' ?>
    </div>
    
    
    
    
</form>

 
	
	
