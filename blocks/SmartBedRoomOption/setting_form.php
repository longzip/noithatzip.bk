<?php
$default = array(
    'title' => '',
    'title_link' => '',
    '0' => array(
        'post_id' => '',
        'is_default_display' => 'yes'
    )
);


for ($i = 0; $i < 12; $i++) {
    $new_array = array(
        'post_id' => '',
        'is_default_display' => 'no'
    );
    array_push($default, $new_array);
}


$groups = array(
  array('title' => 'Giường mặc định'),
    array('title' => 'Trái'),
    array('title' => 'Phải'),
    array('title' => 'Trước 1'),
    array('title' => 'Trước 2')
);


if (isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;


?>

<script>
    $(document).ready(function () {
        var menu_item_count = $(".menu-item").size();


        $("body").on("click", ".expand", function () {
            var parent = $(this).parent().parent();
            parent.find('.inner').each(function () {
                $(this).slideToggle();
            });
        });

        $("body").on("click", ".delete", function () {
            var parent = $(this).closest('.menu-item');
            parent.remove();
        });


        $("body").on("click", ".add", function () {

            var add = '<div id="menu-item-' + menu_item_count + '" class="menu-item array_form" >\
                        <span class="clear"></span>\
                        <div class="inner"  >\
                          <div class="menu-item-item text">\
                              <input name="post_id[]" placeholder="Url" class="link none form-control parameter-depth-1" parameter="post_id" type="number" value="" />\
                          </div>\
                          <div class="menu-item-item text">\
                            <input placeholder="Tìm sản phẩm" particular="' + menu_item_count + '" class="anchor-text anchor-text form-control  "   type="text" value="" />\
                            <div class="search-result"></div>\
                          </div>\
                          <div class="menu-item-item is_default_display">\
                            <select name="is_default_display[]" class="form-control parameter-depth-1 is_default_display" parameter="is_default_display">\
                              <option value="yes" >-- Hiển thị mặc định --</option>\
                              <option    value="yes" >Có</option>\
                              <option   value="no" >Không</option>\
                            </select>\
                          </div>\
                          <span class="clear"></span>\
                          <div class="anchor-title represent pointer  "></div> <div class="fr"><div class="fl action delete pointer">Xóa</div></div>\
                          <span class="clear"></span>\
                        </div>\
                    </div>';
            $("#wrap-menu .sortable ").append(add);
            menu_item_count++;
        });


        $(".sortable").sortable();

    })
</script>

<style>


</style>
<script>
    $(document).ready(function (e) {
        $("body").on("keyup", ".anchor-text", function (e) {

            var count_search_item = 0;
            var key_code = e.keyCode;
            var parent = $(this).parent().parent().parent();
            var anchor_text = $(this).val();

            var particular = $(this).attr("particular");

            var active_item = 1;

            parent.find(".anchor-title").each(function () {
                //$(this).empty().append(anchor_text);
                $(this).removeClass("new");
            });

            switch (key_code) {

                case 13 : //enter
                {
                    count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()

                    if (count_search_item > 0) {
                        var link = $(".search-result .active .serch-result-link").text();
                        var anchor = $(".search-result .active .serch-result-title").text();

                        $("#menu-item-" + particular + " .link").val(link);
                        $("#menu-item-" + particular + " .anchor-text").val(anchor);

                        $("#menu-item-" + particular + " .anchor-title").empty().append(anchor);

                        $(".search-result").empty();
                    }
                }
                    break;

                case 40 : //xuong
                {
                    count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()

                    var active_item = $("#menu-item-" + particular + " .menu-search-item.active").attr("stt")

                    if (active_item < count_search_item) {
                        active_item++;
                        vcount_search_item = $("#menu-item-" + particular + " .menu-search-item").size()
                        $(".menu-search-item").removeClass("active")
                        $("#menu-search-item-" + active_item).addClass("active");
                    }

                    count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()

                    if (count_search_item > 0) {
                        var link = $(".search-result .active .serch-result-link").text();
                        var anchor = $(".search-result .active .serch-result-title").text();

                        $("#menu-item-" + particular + " .link").val(link);
                        $("#menu-item-" + particular + " .anchor-text").val(anchor);

                        $("#menu-item-" + particular + " .anchor-title").empty().append(anchor);

                    }

                }
                    break;

                case 38 : //len
                {
                    var active_item = $("#menu-item-" + particular + " .menu-search-item.active").attr("stt")
                    if (active_item > 1) {
                        active_item--;
                        $(".menu-search-item").removeClass("active")
                        $("#menu-search-item-" + active_item).addClass("active");
                    }

                    count_search_item = $("#menu-item-" + particular + " .menu-search-item").size()

                    if (count_search_item > 0) {
                        var link = $(".search-result .active .serch-result-link").text();
                        var anchor = $(".search-result .active .serch-result-title").text();

                        $("#menu-item-" + particular + " .link").val(link);
                        $("#menu-item-" + particular + " .anchor-text").val(anchor);

                        $("#menu-item-" + particular + " .anchor-title").empty().append(anchor);

                    }
                }
                    break;

                default : {
                    if (anchor_text.length > 0) {
                        $.ajax({
                            url: "<?php echo SITE_URL ?>/admin/?page_type=handle-ajax",
                            type: "post",
                            data: {
                                type: "load_smartbedoption_block",
                                s: anchor_text
                            },
                            success: function (data) {
                                $("#menu-item-" + particular + " .search-result").empty().append(data);

                            }
                            //error:alert("error")
                        })
                    } else {
                        $(".search-result").empty();
                    }

                }
            }
        })

        $("body").on("click", ".menu-search-item", function () {

            $(".menu-search-item").removeClass("active");
            $(this).addClass("active")

            active_item = $(this).attr("stt")

            var parent = $(this).parent().parent().parent().parent().parent();
            var parent_id = parent.attr("id")


            var link = $(".search-result .active .serch-result-link").text();
            var anchor = $(".search-result .active .serch-result-title").text();
            var post_id = $(this).attr("post_id");

            $("#" + parent_id + " .link").val(post_id).change();
            $("#" + parent_id + " .anchor-text").val(anchor);

            $("#" + parent_id + " .anchor-title").empty().append(anchor);
            parent.find(".anchor-text").val("");
            $(".search-result").empty();
        })


        $("body").on("hover", ".anchor-text", function () {
            $(".search-result").empty()
        })

        $("body").on("focusout", ".anchor-text", function () {
            setTimeout(function () {
                $(".search-result").empty();
            }, 200)
        });

        $(".list-link-item-title").click(function () {
            var parent = $(this).closest(".list-link-item");
            $(".list-link-item-content").slideUp();
            parent.find(".list-link-item-content").each(function () {
                $(this).slideToggle();
            });

            $(".list-link-item-title i").removeClass("fa-caret-up").addClass("fa-caret-down");
            $(this).find("i").each(function () {
                $(this).addClass("fa-caret-up").removeClass("fa-caret-down");
                ;
            });
        });

        $("body").on("change", "input, select", function () {
            $(this).closest('.SmartBedRoomOptionForm').submit();

        });

        $("body").on("click", ".color", function () {
            var code = $(this).attr("code");
            $(".colorSlect").val(code).change();
            $(".color").removeClass("active");
            $(this).addClass("active");
        });

        $("body").on("click", ".openClose", function () {

            if ($(this).hasClass('openState')) {
                $(".openCloseInput").val('close').change();
                $(this).removeClass("openState").addClass("closeState");
            } else {
                $(".openCloseInput").val('open').change();
                $(this).removeClass("closeState").addClass("openState");
            }
        });


        $("body").on("submit", ".SmartBedRoomOptionForm", function (e) {
            e.preventDefault();
            // $("#col-preview-inner").html("<img class='preview-loading' src='"+ site_url +"/inc/images/ajaxloader.gif' />");
            $.ajax({
                url: "<?php echo SITE_URL ?>/inc/?page_type=smartBedRoomAjax",
                type: "post",
                data: $("#menu_form_setting").serialize(),
                success: function (data) {
                    var data_arr = data.split('010516');
                    $(".SmartBedRoomOptionForm").css("background", "url(" + data_arr[0] + ")");
                    $("#col-preview-inner").html(data_arr[1]);
                }
                //error:alert("error")
            });
        });
        $(".SmartBedRoomOptionForm").submit();
    });
</script>

<form id="menu_form_setting" class="block_form " block_id="0" type="array">
    <?php display_block_setting_default($default); ?>
    <div id="wrap-menu" class="border-box clearfix SmartBedRoomOptionForm">

        <div class=" col2 ">

            <div class="colors">
                <span class="colorsTitle" style="">Màu sắc : </span>
                <div class="color color1 active" code="color1"></div>
                <div class="color color2" code="color2"></div>
                <div class="color color3" code="color3"></div>
                <select name="color" class="none colorSlect">
                    <option value="color1">Color 1</option>
                    <option value="color2">Color 2</option>
                    <option value="color3">Color 3</option>
                </select>
            </div>
            <h2 class="col-title none">Danh sách sản phẩm <span class="fr none add pointer">(+)</span></h2>
            <div class="col2-inner sortable">
                <span class="clear"></span><br/>

                <div id="begin-menu"></div>
                <?php
                unset($default['title']);
                unset($default['title_link']);
                foreach ($default as $k => $v) {

                    if ($k == 0) {
                        ?>
                        <h2 class="col-title"><?php echo $groups[0]['title'] ?></h2>
                        <?php
                    }
                    if ($k == 1) {
                        ?>
                        <br/>
                        <h2 class="col-title"><?php echo $groups[1]['title'] ?></h2>
                        <?php
                    }
                    if ($k == 5) {
                        ?>
                        <br/>
                        <h2 class="col-title"><?php echo $groups[2]['title'] ?></h2>
                        <?php
                    }
                    if ($k == 9) {
                        ?>
                        <br/>
                        <h2 class="col-title"><?php echo $groups[3]['title'] ?></h2>
                        <?php
                    }
                    if ($k == 11) {
                        ?>
                        <br/>
                        <h2 class="col-title"><?php echo $groups[4]['title'] ?></h2>
                        <?php
                    }

                    $post = get_post($v['post_id']);
                    if (empty($post['short_name'])) $ten = $post['title'];
                    else $ten = $post['short_name'];
                    ?>
                    <div stt="<?php echo $k ?>" id="menu-item-<?php echo $k ?>" class="menu-item array_form">
                        <span class="clear"></span>
                        <div class="inner">
                            <div class="menu-item-item text">
                                <input name="post_id[]" placeholder="Url"
                                       class="link none form-control parameter-depth-1" parameter="post_id"
                                       type="number" value="<?php echo $v['post_id'] ?>"/>
                            </div>
                            <div class="menu-item-item text">
                                <input placeholder="Tìm sản phẩm" particular="<?php echo $k ?>"
                                       class="anchor-text anchor-text form-control " type="text" value=""/>
                                <div class="search-result"></div>
                            </div>
                            <div class="menu-item-item is_default_display">
                                <select name="is_default_display[]"
                                        class="form-control parameter-depth-1 is_default_display"
                                        parameter="is_default_display">
                                    <option value="yes">-- Hiển thị mặc định --</option>
                                    <?php
                                      if($k==0) $v['is_default_display'] = 'yes';
                                    ?>
                                    <option <?php if ($v['is_default_display'] == 'yes') echo 'selected' ?> value="yes">
                                        Có
                                    </option>
                                    <option <?php if ($v['is_default_display'] == 'no') echo 'selected' ?> value="no">
                                        Không
                                    </option>
                                </select>
                            </div>
                            <span class="clear"></span>
                            <div class="anchor-title represent pointer  "><?php echo $ten ?></div>
                            <div class="fr">
                                <div class="fl action delete pointer">Xóa</div>
                            </div>
                            <span class="clear"></span>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-preview">
            <div id="col-preview-inner"></div>

        </div>
        <?php
        //$arr = get_defined_vars();
        //h($arr);
        ?>

        <input type="submit" name="submit" value="Submit" class="none"/>
        <input type="hidden" name="type" value="smartBedRoomOption" class="none"/>
        <input type="hidden" name="is_admin" value="yes" class="none"/>
        <input name="openClose" type="hidden" value="open" class="openCloseInput"/>
        <input type="hidden" name="block_id" value="<?php echo $_GET['block_id'] ?>" class="none"/>
        <div class="openClose openState"></div>
    </div>
</form>
