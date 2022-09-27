<?php
 
?>
<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>
<?php 
    global $smarty;
    clear_smarty_cache();
    unset($temporary_setting_parameter['title'], $temporary_setting_parameter['title_link']);
    
    
    $smarty->assign('temporary_setting_parameter', $temporary_setting_parameter);
	if(file_exists( PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/HtmlMulti.tpl' )) $smarty->display( PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/HtmlMulti.tpl' );
?>
    
<div class="block-content">
    
</div> 