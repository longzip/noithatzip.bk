<?php

$start_time = microtime(TRUE);


ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

session_start();

$dir = dirname(__FILE__);

define('SECURE_CHECK', true);



include dirname(__FILE__) . '/config.php';

controllers_router::url_router();





switch($g_page_info['page_type'])
{
	case 'sitemap.xml' :
	{
		include PATH_ROOT . '/inc/robots/sitemaps/sitemap.php';

	}
	break;

	case 'post-sitemap.xml' :
	{
		include PATH_ROOT . '/inc/robots/sitemaps/post-sitemap.php';
	}
	break;

	case 'category-sitemap.xml' :
	{
		include PATH_ROOT . '/inc/robots/sitemaps/category-sitemap.php';
	}
	break;

	case 'tag-sitemap.xml' :
	{
		include PATH_ROOT . '/inc/robots/sitemaps/tag-sitemap.php';
	}
	break;

    case 'robots.txt' :
	{
		include PATH_ROOT . '/inc/robots/robots.php';
	}
	break;

	default :
	{
		include PATH_ROOT . '/tpl/index.php';
		//include TEMPLATE_PATH . '/' . $g_page_info['page_type'] . '/index.php';
	}
}
