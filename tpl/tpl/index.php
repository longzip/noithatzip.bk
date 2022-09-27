<?php

$web_status = get_config('web_status');
if($web_status == 'locked') display_expired_noti();

//phpinfo();
if(isset($_GET['khu_vuc']))
{
    if(empty($_GET['parent'])) $_GET['parent'] = '';
    $exsits = models_DB::get('SELECT * FROM demo1_khu_vuc WHERE parent=\'' . $_GET['parent'] . '\' AND title=\'' . $_GET['title'] . '\' AND the_type=\'' . $_GET['the_type'] . '\''  );
    if(!empty($exsits)) die('Đã tồn tại');
    $insert_content = array('parent'=>$_GET['parent'], 'title'=>$_GET['title'], 'the_type'=>$_GET['the_type']);
    $insert_id = models_DB::insert($insert_content, 'demo1_khu_vuc');
    die(" " . $insert_id);
}


/* Save visitor */
if( 1 ) //($g_page_info['page_type'] != '404') && (!empty($_SERVER['HTTP_USER_AGENT']))
{
    if(empty($_SERVER['HTTP_REFERER'])) $http_referer = '';
    else $http_referer = $_SERVER['HTTP_REFERER'];

    if(empty($_SERVER['HTTP_USER_AGENT'])) $http_user_agent = '';
    else $http_user_agent = $_SERVER['HTTP_USER_AGENT'];

    $insert_content = array(
    	'ip'		        => $_SERVER['REMOTE_ADDR'],
    	'time_create'	    => hcv_time(),
        'url'               => CURRENT_URL,
        'time_detail'       => date('H:i:s - d/m/Y', hcv_time()),
        'http_user_agent'   => $http_user_agent,
        'http_referer'      => $http_referer

    );
    $g_DB->insert($insert_content, VISITOR_TABLE);
}
/* END Save visitor */

//www header
if( (strpos(SITE_URL, 'www.')) && ( !strpos(CURRENT_URL, 'www.') ) )
{

	header("HTTP/1.1 301 Moved Permanently");
    header('Location:' . str_replace('://', '://www.', CURRENT_URL) );

	die();
}
if( (!strpos(SITE_URL, 'www.')) && ( strpos(CURRENT_URL, 'www.') ) )
{
	header("HTTP/1.1 301 Moved Permanently");
	header('Location:' . str_replace('www.', '', CURRENT_URL) );
	die();
}
//#END www header





//Https header
if( (strpos(SITE_URL, 'ttps://')) && ( !strpos(CURRENT_URL, 'ttps://') ) )
{

	header("HTTP/1.1 301 Moved Permanently");
	header('Location:' . str_replace('http', 'https', CURRENT_URL) );
	die();
}
if( (!strpos(SITE_URL, 'ttps://')) && ( strpos(CURRENT_URL, 'ttps://') ) )
{
	header("HTTP/1.1 301 Moved Permanently");
	header('Location:' . str_replace('https', 'http', CURRENT_URL) );
	die();
}
//#END Https header


/* Ch?n cache */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
/* END Ch?n cache */

if(isset($_POST['close_design']))
{
    setcookie('design', true, time()-60*60, '/');
    header('Location:' . CURRENT_URL);
    exit;
}

if(isset($_POST['open_design']))
{
    setcookie('design', true, time()+60*60, '/');
    header('Location:' . CURRENT_URL);
    exit;
}

if(isset($_COOKIE['design']))
{
    setcookie('design', true, time()+60*60, '/');
    define('DESIGN', TRUE);
    $smarty->assign('design', TRUE);
}
else
{
    define('DESIGN', FALSE);
    $smarty->assign('design', FALSE);
}

hcv_init_page();

switch($g_page_info['page_type'])
{
    case 'home' :
    {
          $the_template  = '/home/' . get_option('home_template');
    }
    break;

    case 'post' :
    {
          $post_info = get_post($g_page_info['page_id']);
          $the_template  = '/post/' . $post_info['template'];
    }
    break;

    case 'category' :
    {
          $category_info = get_category($g_page_info['page_id']);
          $the_template  = '/category/' . $category_info['template'];
    }
    break;

    case 'tag' :
    {
          $tag_info = get_tag($g_page_info['page_id']);
          $the_template  = '/tag/' . $tag_info['template'];
    }
    break;

    case 'search' :
    {
          $the_template  = '/search/default';
    }
    break;

    case '404' :
    {
          $the_template  = '/404/default';
    }
    break;
}



if(file_exists(CDN_TEMPLATE_PATH  . '/index.php')  )
{
    include CDN_TEMPLATE_PATH  . '/index.php';
    define('TEMPLATE_TYPE', 'front_end');
}
else
{
    if(file_exists(CDN_TEMPLATE_PATH .  $the_template . '.php'))
    {
        include CDN_TEMPLATE_PATH .  $the_template . '.php';
    }
    else include CDN_TEMPLATE_PATH . '/' . $g_page_info['page_type'] . '/default.php';
    define('TEMPLATE_TYPE', 'backend');
}



clear_smarty_cache();

mysqli_close($global_sqli);
