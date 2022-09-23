
<?php

if(empty($extension_info)) $list_option = array();

$list_option = json_decode($extension_info['attributes'], TRUE);


 
$list_selector = $list_option;
$list_selector = array_diff($list_selector, array('custom'));
unset($list_selector['style']);
$list_selector = implode(',', $list_selector);
$list_selector_arr = explode(',', $list_selector);
 
 
 

 
$list_option = array_diff($list_option, array('custom'));
 
  
if(empty($list_option['style'])) $list_option['style'] = 'picEyes'; 
switch($list_option['style'])
{
    case 'picEyes' :
    {
        ?>
        <script type="text/javascript" src="<?php echo CDN_DOMAIN ?>/extensions/ImageClickToBig/Plugins/picEyes/jquery.picEyes.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo CDN_DOMAIN ?>/extensions/ImageClickToBig/Plugins/picEyes/css.css" />
        <script>
            $(document).ready(function(){
                <?php 
                    foreach($list_selector_arr as $v)
                    {
                        if($v == '') continue;
                        if($v == ' ') continue;
                        if($v == '  ') continue;
                        if($v == '   ') continue;
                        ?>
                        $("<?php echo $v ?> img").hover(function(){
                            var this_src = $(this).attr("ori_src");
                            //$(this).attr("src", this_src);
                        })
                        $("<?php echo $v ?> img").parent().addClass("ImgClickToBig");
                        <?php
                    }
                ?>
                
                $('.ImgClickToBig').picEyes();
            });
        </script>
        <?php
        break;
    }
 
    
}
?>    