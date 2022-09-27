<?php
$default = array(
    'title'     => '',
    'title_link'    => '',
    '0'     => array(
        'html_title'         => '',
        'html_address'         => '',
        'html_phone'         => '',
        'html_value'         => ''
    )
);

if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;

?>
<?php tinymce_setting() ?>
<script>
    $(document).ready(function(){


        $("body").on("click", ".add", function(){
            var add = ' <div class="html-multi-item relative clearfix menu-item array_form">\
                            <i class="fa fa-caret-down expend-html" aria-hidden="true"></i>\
                            <label class="block title">Tiêu đề : </label>\
                            <div class="value">\
                                <input class="text form-control  parameter-depth-1"  parameter="html_title" value="" />\
                            </div>\
                            <span class="clear"></span>\
                            <label class="block title">Địa chỉ : </label>\
                            <div class="value">\
                                <input class="text form-control  parameter-depth-1"  parameter="html_address" value="" />\
                            </div>\
                            <span class="clear"></span>\
                            
                            <div class="html-content">\
                                <label class="block   title">Nội dung : </label>\
                                <div class="value">\
                                    <textarea class="text main-content form-control parameter-depth-1"  parameter="html_value"></textarea>\
                                </div>\
                            </div>\
                            \
                            <span class="remove-text-field fa fa-remove pointer absolute" the_id=""></span>\
                        </div>\
                        <span class="clear"></span>';


            $("#list-html").append(add);

            tinymce.init({
                entity_encoding : "raw",
            	convert_urls: false,
                selector: ".main-content",
                content_css : "http://cdn.weblando.vn/inc/css/tinymce.css",
                setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                })},
                skin:"custom",
                //extended_valid_elements : '*[*]',
                extended_valid_elements : 'svg[id|width|height|style|version|class|xmlns|xmlns:xlink|x|y|viewBox|xml:space],image[id|width|height|style|version|class|xmlns|xmlns:xlink|x|y|viewBox|xml:space|src],polygon[points|class|id|data-src|stt|style]',
                //valid_elements  : '*[*]',
                //valid_children : "*[*]",
                plugins: [
                    "advlist autolink lists link charmap print preview anchor textcolor ",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu wordcount hcv_upload hcv_youtube  hcv_other_post hcv_image_map hcv_form"
                ],
                menu : { // this is the complete default configuration
                    ///file   : {title : 'File'  , items : 'newdocument'},
                    //edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
                    //insert : {title : 'Insert', items : 'link media | template hr'},
                    //view   : {title : 'View'  , items : 'visualaid'},
                    format : {title : 'Format', items : 'strikethrough superscript subscript | removeformat'},
                    table  : {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
                    tools  : {title : 'Tools' , items : 'spellchecker'}
                },
                toolbar: "fontselect fontsizeselect | forecolor backcolor | undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link unlink | hcv_upload | hcv_youtube | hcv_other_post | hcv_image_map | hcv_form | code fullscreen"
            });


        });

        $("body").on("click", ".remove-text-field", function(){
            $(this).parent().remove();
        });

        $("body").on("click", ".expend-html", function(){
            $(this).toggleClass("up");
            var parent = $(this).parent();
            parent.find(".html-content").each(function(){
                $(this).slideToggle();
            });


        });





        $(".sortable").sortable();

        setInterval(function(){
            tinyMCE.triggerSave();
        }, 500);

    })
</script>

<style>


</style>


<link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/inc/css/font-awesome-4.5.0/css/font-awesome.min.css" />
<form id="menu_form_setting"  class="block_form " block_id="0" type="array">

<?php  display_block_setting_default($default);  ?>

<div id="wrap-menu" class="border-box clearfix">


    <div class=" ">
        <h2 class="col-title">Danh sách HTML <span class="fr add pointer">(+)</span></h2>
        <div class="col2-inner sortable" id="list-html">
                <span class="clear"></span><br />


                <?php
                	unset($default['title']);
                    unset($default['title_link']);
                    foreach($default as $k=>$v)
                    {
                        ?>

                        <div class="html-multi-item relative clearfix menu-item array_form">
                            <i class="fa fa-caret-down expend-html" aria-hidden="true"></i>
                            <label class="block title">Tiêu đề : </label>
                            <div class="value">
                                <input class="text form-control  parameter-depth-1"  parameter="html_title" value="<?php echo $v['html_title'] ?>" />
                            </div>
                            <span class="clear"></span>
                            <div class="html-content">
                                <label class="block   title">Nội dung : </label>
                                <div class="value">
                                    <textarea class="text main-content form-control parameter-depth-1"  parameter="html_value"><?php echo $v['html_value'] ?></textarea>
                                </div>
                            </div>

                            <span class="remove-text-field fa fa-remove pointer absolute" the_id=""></span>
                        </div>
                        <span class="clear"></span>

                        <?php
                    }
                ?>
                <div id="begin-menu"></div>
        </div>
    </div>
</div>
</form>

