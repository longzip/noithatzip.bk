<?php
	//$temporary_setting_parameter,, $current_block_id
?>

<?php 
    include PATH_ROOT . '/blocks/default-title.php';
?>



<div class="block-content clearfix">
<?php   
    global $smarty;
    clear_smarty_cache();
    $smarty->assign('temporary_setting_parameter', $temporary_setting_parameter);
	$smarty->display(PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/TitleImageLinkDescription.tpl');
?>
</div>
 