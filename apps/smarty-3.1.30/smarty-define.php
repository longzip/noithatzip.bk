<?php

 

$smarty1 = new hcv_Smarty();
$g_functions = new functions_list();
$g_models_DB = new models_DB();
$g_views_BlockArea = new views_BlockArea();


   
$smarty1->assign('g_functions', $g_functions);
$smarty1->assign('g_models_DB', $g_models_DB);
$smarty1->assign('g_views_BlockArea', $g_views_BlockArea);

$smarty1->assign('c_cdn_template_url', CDN_TEMPLATE_URL);
$smarty1->assign('c_fontend_template_url', CDN_DOMAIN . '/tpl/tpl/' . TEMPLATE );
$smarty1->assign('c_cdn_domain', CDN_DOMAIN);
$smarty1->assign('c_site_url', SITE_URL);