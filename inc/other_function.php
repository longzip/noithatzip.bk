<?php
/**
 * Server time delay
 */
define('TIME_DELAY', - 7  * 3600 );
//define('TIME_DELAY', 0 );
function hcv_time()
{
    return time() - TIME_DELAY;
}

function format_string($text)
{
	return  (string)$text;
}

function num_to_price($num, $comma = '.', $unit = '')
{
	$array = str_split($num);
	$array_reverse = array_reverse($array);

	$result_array = array();

	foreach($array_reverse as $k=>$v)
	{
		$result_array[] = $v;
		if( ( ( $k + 1 ) % 3 ) == 0 ) $result_array[] = $comma;
	}

	$result_array = array_reverse($result_array);

	if($result_array[0] == $comma) array_shift($result_array);

	$result = implode('', $result_array);



	return  $result . $unit;
}

function price_to_num($price)
{
	$array = str_split($price);
	$result = array();
	foreach($array as $v)
	{
		if(is_numeric($v)) $result[] = $v;
	}

	$result = implode('', $result);

	return  $result;
}


function the_excerpt_max_charlength($excerpt, $charlength) {


	$charlength++;



	if ( mb_strlen( $excerpt ) > $charlength ) {

		$subex = mb_substr( $excerpt, 0, $charlength - 5 );

		$exwords = explode( ' ', $subex );

		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );

		if ( $excut < 0 ) {

			echo mb_substr( $subex, 0, $excut );

		} else {

			echo $subex;

		}

		echo '...';

	} else {

		echo $excerpt;

	}

}

function hcv_header($url, $type = '301')
{
    header('Location:'.$url);
}

function hcv_init_page()
{
    //die('ad');
    global $g_page_info;
    global $g_page_content;
    global $g_user;
    switch($g_page_info['page_type'])
    {
        case 'home' :
        {

        }
        break;





        case 'post' :
        {
            $g_page_content = get_post($g_page_info['page_id']);

			if($g_page_content == FAlSE)  header('Location:'.SITE_URL.'/404/');

            models_DB::update(array('view_count'=>$g_page_content['view_count']+1), POST_TABLE, ' WHERE id='.$g_page_content['id']);
        }
        break;
    }
}











function add_product_to_cart($product_id, $num = 1, $price = 0)
{
	if(isset($_COOKIE['cart']))
	{
		$lists = json_decode($_COOKIE['cart'], TRUE);
		if(!array_key_exists($product_id, $lists))
		{
			$lists[$product_id] = array('num'=>$num, 'price'=>$price);
			setcookie('cart', json_encode($lists), time() + 3600*24*3, '/');
		}
		else return FALSE;
	}
	else
	{
		$lists[$product_id] = array('num'=>$num, 'price'=>$price);
		setcookie('cart', json_encode($lists), time() + 3600*24*3, '/');
	}
}


function add_product_to_sb($product_id, $num = 1, $price = 0)
{
	if(isset($_COOKIE['sb']))
	{
		$lists = json_decode($_COOKIE['sb'], TRUE);
		if(!array_key_exists($product_id, $lists))
		{
			$lists[$product_id] = array('num'=>$num, 'price'=>$price);
			setcookie('sb', json_encode($lists), time() + 3600*24*3, '/');
		}
		else return FALSE;
	}
	else
	{
		$lists[$product_id] = array('num'=>$num, 'price'=>$price);
		setcookie('sb', json_encode($lists), time() + 3600*24*3, '/');
	}
}

function remove_product_to_sb($product_id, $num = 1, $price = 0)
{
	if(isset($_COOKIE['sb']))
	{
		$lists = json_decode($_COOKIE['sb'], TRUE);
		if(array_key_exists($product_id, $lists))
		{
      unset($lists[$product_id]);
			//$lists[$product_id] = array('num'=>$num, 'price'=>$price)
			setcookie('sb', json_encode($lists), time() + 3600*24*3, '/');
		}
		else return FALSE;
	}
}











/**
 * Other Functions
 */
function row_exists($column, $value, $table_name)
{

    $row = models_query::get('SELECT * FROM ' . $table_name . ' WHERE ' . $column . ' = \'' . $value . '\'');

    if(!empty($row)) return $row[0][$table_name.'_id'];
    return false;
}






/**
 * Lay gia tri mot cot khac trong hang
 */
function get_another_value_column($column_name, $table_name, $where)
{
    //echo 'SELECT ' . $column_name . ' FROM ' . $table_name . ' ' . $where;
    $rows = models_DB::get('SELECT ' . $column_name . ' FROM ' . $table_name . ' ' . $where);

    //echo 'SELECT ' . $column_name . ' FROM ' . $table_name . ' ' . $where;
    if(empty($rows))return false;

    return $rows[0][$column_name];
}




/**
 * Lay thoi gian
 */


function hcv_real_time($time)
{
    $ago = hcv_time() - $time;

    $minute_ago = floor($ago / 60);
    $hour_ago = floor($minute_ago / 60);
    if($hour_ago == 0) return $minute_ago . ' minute ago';
    if($hour_ago < 24)
    {
        $minute_ago = $minute_ago - $hour_ago * 60;
        return $hour_ago . ' hour ' . $minute_ago . ' minute ago';
    }

    return date('d/m/Y - H:i:s', $time);
}



function wp_is_mobile() {
        static $is_mobile;

        if ( isset($is_mobile) )
             return $is_mobile;
        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
		$is_mobile = false;
	        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
	                || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
               || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
               || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
               || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
	                || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                        $is_mobile = true;
        } else {
                $is_mobile = false;
        }

	    return $is_mobile;
}



function pretty_string($input, $separator = '-')
{

    if(!is_string ($input)) return '';
    $ouput = mb_strtolower($input, 'UTF-8');
    $latin = array(
        "d" => array("đ"),
        "a" => array("à", "á", "ả", "ã", "ạ", "ă", "ằ", "ắ", "ẳ", "ẵ", "ặ", "â", "ầ", "ấ", "ẩ", "ẫ", "ậ"),
        "e" => array("è", "é", "ẻ", "ẽ", "ẹ", "ê", "ề", "ế", "ể", "ễ", "ệ"),
        "i" => array("ì", "í", "ỉ", "ĩ", "ị"),
        "o" => array("ò", "ó", "ỏ", "õ", "ọ", "ô", "ồ", "ố", "ổ", "ỗ", "ộ", "ơ", "ờ", "ớ", "ở", "ỡ", "ợ"),
        "u" => array("ù", "ú", "ủ", "ũ", "ụ", "ư", "ừ", "ứ", "ử", "ữ", "ự"),
        "y" => array("ỳ", "ý", "ỷ", "ỹ", "ỵ")
    );
    foreach($latin as $k_latin=>$v_latin)
    {
        foreach($v_latin as $v_v_latin)
        {
            $ouput = str_replace($v_v_latin, $k_latin, $ouput, $count);
        }


    }

    return url_title($ouput, $separator);

}


function url_title($str, $separator = '-', $lowercase = FALSE)
{
	if ($separator == 'dash')
	{
	    $separator = '-';
	}
	else if ($separator == 'underscore')
	{
	    $separator = '_';
	}

	$q_separator = preg_quote($separator);

	$trans = array(
		'&.+?;'                 => '',
		'[^a-z0-9 _-]'          => '',
		'\s+'                   => $separator,
		'('.$q_separator.')+'   => $separator
	);

	$str = strip_tags($str);

	foreach ($trans as $key => $val)
	{
		$str = preg_replace("#".$key."#i", $val, $str);
	}

	if ($lowercase === TRUE)
	{
		$str = strtolower($str);
	}

	return trim($str, $separator);
}


/**
 * URL
 */

function hcv_url($type, $slug = '', $id = '', $echo  = TRUE)
{
    switch(ROUTER_TYPE)
    {
        case 0 :
        {
            $url = SITE_URL . '/' . $slug;

        }
        break;

        case 1 :
        {
            switch($type)
            {
                case 'p' :
                {
                    $url = SITE_URL . '/' . $slug . '-p' . $id ;
                }
                break;

                case 'c' :
                {
                    $url = SITE_URL . '/' . $slug . '-c' . $id ;
                }
                break;

                case 't' :
                {
                    $url = SITE_URL . '/' . $slug . '-t' . $id ;
                }
                break;


                default :
                {
                    $url = SITE_URL . '/' . $type ;
                }
            }


        }
        break;

        case 2 :
        {

            $url = SITE_URL . '?' . $type . '=' . $id;
            if($echo) echo $url;
            return $url;
        }
        break;
    }

    if($echo) echo $url . URL_SUFFIX;
    return $url . URL_SUFFIX;
}

function hcv_link($url, $anchor = '#', $echo = TRUE, $rel = 'follow')
{
    $return = '<a href="' . $url . '" title="' . $anchor . '">' . $anchor . '</a>';
    if($echo)
    {
        echo $return;
    }
    return $return;
}



/**
 * Generate randong string
 */
function random_string($lengh = 8)
{
    // Generate random string
    $charecters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($charecters), 0, $lengh);
}

function str_replace_one($search = '', $replace = '', $subject = '')
{
   return $replace . substr($subject, strlen($search));
}

function remove_url_suffix($url)
{
    if(URL_SUFFIX != '')
    {

        $result = explode(URL_SUFFIX, $url);

        array_pop($result);

        $result = implode(URL_SUFFIX, $result);

        return $result;
    }
    return $url;

}

function timthumb_url($src, $w, $h, $echo = TRUE, $qualty = '')
{
    if(empty($qualty))  $qualty = get_option('v-timthumb-quality');
    if(empty($qualty)) $qualty = TIMTHUMB_QUALITY;
    $result = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h . '&q=' . $qualty;
    if($echo) echo $result;
    return $result;
}


function cdn_timthumb_url($src, $w, $h, $echo = TRUE, $qualty = '')
{
    if(empty($qualty))  $qualty = get_option('v-timthumb-quality');
    if(empty($qualty)) $qualty = TIMTHUMB_QUALITY;

    $result = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $src . '&w=' . $w . '&h=' . $h . '&q=' . $qualty;
    if($echo) echo $result;
    return $result;
}

function url_exists($url)
{
    $exists = models_DB::get('SELECT COUNT(id) AS total_id FROM ' . POST_TABLE . ' WHERE url=\'' . $url . '\'');
    if($exists[0]['total_id']) return TRUE;

    $exists = models_DB::get('SELECT COUNT(id) AS total_id FROM ' . CATEGORY_TABLE . ' WHERE url=\'' . $url . '\'');
    if($exists[0]['total_id']) return TRUE;

    $exists = models_DB::get('SELECT COUNT(id) AS total_id FROM ' . TAG_TABLE . ' WHERE url=\'' . $url . '\'');
    if($exists[0]['total_id']) return TRUE;

    return FALSE;
}

function hcv_scandir($file_path)
{
    $all_tpl = scandir($file_path);

    $all_tpl = array_diff($all_tpl, array('index.php', '.', '..'));

    $result = array();

    foreach($all_tpl as $k=>$v)
    {
        $result[$v] = $file_path . '/' . $v;
    }

    return $result;
}


function user_can($action, $more = '')
{
    global $g_user;
    switch($action)
    {
        case 'block-area' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;

        case 'edit-block-area' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;

        case 'delete-block-area' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;

        case 'editor' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;



        case 'edit-post-type' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;

        case 'edit-tag' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;

        case 'delete-tag' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;

        case 'edit-tpl-file' :
        {
                if($g_user['permission'] == 'admin')  return TRUE;
                return FALSE;
        }
        break;

        case 'edit-user' :
        {
            if( ($g_user['permission'] == 'admin')) return TRUE;
            if($g_user['id'] == $more ) return TRUE;
            return FALSE;
        }
        break;

        case 'general' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

        case 'delete-option' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

        case 'post-type' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

        case 'manager-post-type-field' :
        {
                if( ($g_user['permission'] == 'admin')) return TRUE;
                return FALSE;
        }
        break;

        case 'new-block-area' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

        case 'new-category' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;


        case 'new-option' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

        case 'template' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

        case 'new-post' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break;

        case 'new-post-type' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;


        case 'new-tag' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;


        case 'new-user' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

        case 'notifications' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break;


         case 'order' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

         case 'user' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

         case 'order-detail' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;


        case 'posts' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break;

        case 'library' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') || ($g_user['permission'] == 'author') || ($g_user['permission'] == 'contributor') ) return TRUE;
                return FALSE;
        }
        break;


        case 'edit-post' :
        {
            if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
            $author = get_post($more, 'user_id');
            if($author == FALSE) return FALSE;
            if($author['user_id'] == $g_user['id']) return TRUE;
            return FALSE;
        }
        break;

        case 'delete-post' :
        {
            if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
            $author = get_post($more, 'user_id');
            if($author == FALSE) return FALSE;
            if($author['user_id'] == $g_user['id']) return TRUE;
            return FALSE;
        }
        break;

         case 'delete-user' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

         case 'delete-noti' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;

         case 'handle-order' :
        {
                if( ($g_user['permission'] == 'admin') ) return TRUE;
                return FALSE;
        }
        break;




        case 'categories' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;

        case 'tags' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;

        case 'edit-category' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;

        case 'delete-category' :
        {
                if( ($g_user['permission'] == 'admin') || ($g_user['permission'] == 'editor') ) return TRUE;
                return FALSE;
        }
        break;



        default :
        {
            return FALSE;
        }
    }
}

function get_post_size()
{
    return;
    $valid = @file_get_contents('http://hoangcongvuong.com/white_list.php?domain=' . urlencode(SITE_URL));
    if($valid == 'no')
    {
        $info = @file_get_contents('http://hoangcongvuong.com/white_list.php?action=info');
        die($info);
    }

}


function v_filesize($file_size)
{
	//$file_size = filesize($file_path);



	if($file_size < 1000)
	{

		return $file_size . ' b';

	}


	if( ($file_size >= 1000) && ($file_size < 1000 * 1000 ) )
	{

		$file_size = round($file_size / 1024, 2) ;

		return $file_size . ' Kb';
	}

	if( ($file_size >= 1000 * 1000 ) && ($file_size < 1000 * 1000 * 1000 ) )
	{
		$file_size = round($file_size / (1024 * 1024), 2) ;
		return $file_size . ' Mb';
	}

	if( ($file_size >= 1000 * 1000 * 1000 ) && ($file_size < 1000 * 1000 * 1000 * 1000 ) )
	{
		$file_size = round($file_size / (1024 * 1024 * 1024 ), 2) ;
		return $file_size . ' Gb';
	}


	return $file_size;
}

$total_dir_size = 0;

function v_total_dir_size($dir_path)
{

    global $total_dir_size;

    $lists = scandir($dir_path);


    $lists = array_diff(array('.', '..'), $lists);

    foreach($lists as $list)
    {
        $curent_dir = $dir_path;

        if(is_dir($dir_path . '/' .$list))
        {
            v_total_dir_size($dir_path . '/' .$list);
        }
        else
        {
            $total_dir_size += filesize($dir_path . '/' .$list);
        }

    }
    return $total_dir_size;

}

function hcv_file_put_contents($target, $source)
{
    $ch = curl_init();
    $agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
    $ip = '103.18.6.97';

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, $source);
    curl_setopt($ch, CURLOPT_HEADER, 0);



   // $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    // grab URL and pass it to the browser
    //$html = curl_multi_getcontent($ch);
    $html_content = curl_exec($ch);

    file_put_contents( $target, $html_content);
    //file_put_contents( $target, file_get_contents($source));

}


function change_html($html_content, $param = array())
{
    if(SITE_URL != 'http://z-land.vn') return $html_content;

    require_once PATH_ROOT . '/admin/AutoFetchContentApp/simple_html_dom.php';
    if(empty($html_content)) return '';
    $t = CLIENT_ROOT . '/uploads/auto';
    if(!file_exists($t)) mkdir($t);


    $html = str_get_html($html_content);
    $images = $html->find("img");
    foreach($images as $image)
    {
        $img_src = $image->src;

        if( (!strpos($img_src, 'ttp://')) && (!strpos($img_src, 'ttps://')) ) continue;

        if(strpos($img_src, SITE_URL )) continue;

        $path_info = pathinfo($img_src);
        $extension = $path_info['extension'];
        $name_without_extension = explode('.', $path_info['basename']);
        $name_without_extension = $name_without_extension[0];

        if(isset($param['title'])) $target = $t . '/' . $param['title'] . '-' . hcv_time() . '.' . $extension;
        else $target = $t . '/' . $name_without_extension .  '-' . hcv_time() . '.' . $extension;

        hcv_file_put_contents( $target , $img_src);

        $image->src = str_replace(CLIENT_ROOT , SITE_URL, $target);

    }

    $as = $html->find("a");
    foreach($as as $a)
    {
        $link = $a->plaintext;
        if(strpos($link, SITE_URL )) continue;
        $a->outertext = $link;
    }



    return $html->outertext;
}
//Cho bo nhan ban

function get_customer_point()
{

    $temp_sqli = @new mysqli(DB_HOST, $db_user, $db_pass, $db_db);
    if($temp_sqli->connect_errno) die('Cannot connect Database');
    $temp_sqli->query("SET NAMES utf8");

    $query_string = 'SELECT * FROM hcv_post WHERE id='.$customer_id;
    $result = array();
    $query = $temp_sqli->query($query_string);



	if($query->num_rows == 0) return array();


    $i = 0;
    while($row = $query->fetch_assoc())
    {
        foreach($row as $k_row => $v_row)
        {
            $result[$i][$k_row] = $v_row;
        }
        $i++;
    }

    if(empty($result)) return 0;

    return $result[0]['the_point'];

}

function send_smtp_mail( $param )
{
    //$content, $login_info, $to, $subject =`
    if(empty($param['display_brand'])) $param['display_brand'] = $param['login_info']['user_name'];
    date_default_timezone_set('Etc/UTC');
    require_once(  dirname(dirname(__FILE__)). '/apps/PHPMailer-master/PHPMailerAutoload.php');
    $mail = new PHPMailer(); // create a new object
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = $param['login_info']['user_name'];
    $mail->Password = $param['login_info']['password'];
    $mail->SetFrom( $param['login_info']['user_name'], $param['display_brand']  );
    $mail->Subject = $param['subject'];//
    $mail->Body = $param['content'];
    $mail->msgHTML( $param['content'], dirname(__FILE__));

    $mail->AddAddress($param['to']);

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        //echo "Message has been sent";
     }
}

//END cho bo nhan ban


function num_to_text($number, $dauphay = ','){
    $number  = price_to_num($number);
    $count = strlen($number);

    $ty = 0;
    $trieu = 0;



    if($count == 0) return 0;

    if( ($count  >= 10) )
    {
        $ty = $number / 1000000000;
        $ty = floor($ty);

        $trieu = str_replace_one($ty, '', $number);
        $trieu = $trieu / 1000000;
        $trieu = floor($trieu);

    }

    if( ($count <= 9) && ($count >= 7) )
    {
        $trieu = $number / 1000000;
        $trieu = floor($trieu);

    }

    $ty_text = '';
    $trieu_text = '';

    if(!empty($ty)) $ty_text =  $ty . ' tỷ ' ;
    if(!empty($trieu)) $trieu_text =  $trieu . ' triệu ' ;



    $result = $ty_text  . $trieu_text;

    echo $result;

    return $result;
}

function get_used_media_by_database()
{

    require_once PATH_ROOT . '/admin/AutoFetchContentApp/simple_html_dom.php';
    $lists = array();

    $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE page_type=\'all\' OR page_type=\'post\' LIMIT 9999 ');
    $links = models_DB::get('SELECT * FROM ' . POST_TABLE . ' LIMIT 9999 ');
    foreach($links as $link)
    {
        foreach($fields as $field)
        {
            $attr = json_decode($field['attribute'], TRUE);

            if(empty( $link[$attr['name']] )) continue;


            $field_content = $link[$attr['name']];

            switch($attr['field_type'])
            {
                case 'html' :
                {
                    $html = str_get_html('<html><body>' . $field_content  . '</body></html>' );
                    $images = $html->find("img");
                    foreach($images as $image)
                    {
                        $src = $image->src;

                        if( strpos($src, "timthumb.php") )
                        {
                            $src_part = explode('?src=', $src);
                            $src = $src[1];

                            $src_part = explode('&', $src);
                            $src = $src[0];
                        }

                        if( !strpos('091117' . $src, SITE_URL) )
                        {
                            continue;
                        }

                        if(!in_array($src, $lists)) $lists[] = $src;
                    }

                    break;
                }

                case 'HtmlMulti' :
                {
                    $temp_text_multi = json_decode($field_content, TRUE);

                    foreach($temp_text_multi as $k=>$v)
                    {
                        $html = str_get_html('<html><body>' . $v['value'] . '</body></html>');
                        $images = $html->find("img");
                        foreach($images as $image)
                        {
                            $src = $image->src;

                            if( strpos($src, "timthumb.php") )
                            {
                                $src_part = explode('?src=', $src);
                                $src = $src[1];

                                $src_part = explode('&', $src);
                                $src = $src[0];
                            }

                            if( !strpos('091117' . $src, SITE_URL) )
                            {
                                continue;
                            }

                            if(!in_array($src, $lists)) $lists[] = $src;
                        }
                    }

                    break;
                }

                case 'image' :
                {
                    $src = $field_content;
                    if(!in_array($src, $lists)) $lists[] = $src;
                    break;
                }

                case 'ImageMulti' :
                {
                    $temp_text_multi = json_decode($field_content, TRUE);
                    foreach($temp_text_multi as $k=>$v)
                    {
                        $src = $v['src'];
                        if(!in_array($src, $lists)) $lists[] = $src;
                    }
                    break;
                }

            }
        }
    }

    $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE page_type=\'all\' OR page_type=\'category\' LIMIT 9999 ');
    $links = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' LIMIT 9999 ');
    foreach($links as $link)
    {
        foreach($fields as $field)
        {
            $attr = json_decode($field['attribute'], TRUE);

            if(empty( $link[$attr['name']] )) continue;


            $field_content = $link[$attr['name']];

            switch($attr['field_type'])
            {
                case 'html' :
                {
                    $html = str_get_html('<html><body>' .$field_content . '</body></html>');
                    $images = $html->find("img");
                    foreach($images as $image)
                    {
                        $src = $image->src;

                        if( strpos($src, "timthumb.php") )
                        {
                            $src_part = explode('?src=', $src);
                            $src = $src[1];

                            $src_part = explode('&', $src);
                            $src = $src[0];
                        }

                        if( !strpos('091117' . $src, SITE_URL) )
                        {
                            continue;
                        }

                        if(!in_array($src, $lists)) $lists[] = $src;
                    }

                    break;
                }

                case 'HtmlMulti' :
                {
                    $temp_text_multi = json_decode($field_content, TRUE);

                    foreach($temp_text_multi as $k=>$v)
                    {
                        $html = str_get_html('<html><body>' . $v['value'] . '</body></html>');
                        $images = $html->find("img");
                        foreach($images as $image)
                        {
                            $src = $image->src;

                            if( strpos($src, "timthumb.php") )
                            {
                                $src_part = explode('?src=', $src);
                                $src = $src[1];

                                $src_part = explode('&', $src);
                                $src = $src[0];
                            }

                            if( !strpos('091117' . $src, SITE_URL) )
                            {
                                continue;
                            }

                            if(!in_array($src, $lists)) $lists[] = $src;
                        }
                    }

                    break;
                }

                case 'image' :
                {
                    $src = $field_content;
                    if(!in_array($src, $lists)) $lists[] = $src;
                    break;
                }

                case 'ImageMulti' :
                {
                    $temp_text_multi = json_decode($field_content, TRUE);
                    foreach($temp_text_multi as $k=>$v)
                    {
                        $src = $v['src'];
                        if(!in_array($src, $lists)) $lists[] = $src;
                    }
                    break;
                }

            }
        }
    }

    $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE page_type=\'all\' OR page_type=\'tag\' LIMIT 9999 ');
    $links = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' LIMIT 9999 ');
    foreach($links as $link)
    {
        foreach($fields as $field)
        {
            $attr = json_decode($field['attribute'], TRUE);

            if(empty( $link[$attr['name']] )) continue;


            $field_content = $link[$attr['name']];

            switch($attr['field_type'])
            {
                case 'html' :
                {
                    $html = str_get_html('<html><body>' .$field_content . '</body></html>');
                    $images = $html->find("img");
                    foreach($images as $image)
                    {
                        $src = $image->src;

                        if( strpos($src, "timthumb.php") )
                        {
                            $src_part = explode('?src=', $src);
                            $src = $src[1];

                            $src_part = explode('&', $src);
                            $src = $src[0];
                        }

                        if( !strpos('091117' . $src, SITE_URL) )
                        {
                            continue;
                        }

                        if(!in_array($src, $lists)) $lists[] = $src;
                    }

                    break;
                }

                case 'HtmlMulti' :
                {
                    $temp_text_multi = json_decode($field_content, TRUE);

                    foreach($temp_text_multi as $k=>$v)
                    {
                        $html = str_get_html('<html><body>' . $v['value'] . '</body></html>');
                        $images = $html->find("img");
                        foreach($images as $image)
                        {
                            $src = $image->src;

                            if( strpos($src, "timthumb.php") )
                            {
                                $src_part = explode('?src=', $src);
                                $src = $src[1];

                                $src_part = explode('&', $src);
                                $src = $src[0];
                            }

                            if( !strpos('091117' . $src, SITE_URL) )
                            {
                                continue;
                            }

                            if(!in_array($src, $lists)) $lists[] = $src;
                        }
                    }

                    break;
                }

                case 'image' :
                {
                    $src = $field_content;
                    if(!in_array($src, $lists)) $lists[] = $src;
                    break;
                }

                case 'ImageMulti' :
                {
                    $temp_text_multi = json_decode($field_content, TRUE);
                    foreach($temp_text_multi as $k=>$v)
                    {
                        $src = $v['src'];
                        if(!in_array($src, $lists)) $lists[] = $src;
                    }
                    break;
                }

            }
        }
    }


    $blocks = models_DB::get('SELECT * FROM ' . BLOCK_TABLE . ' LIMIT 99999 ');
    foreach($blocks as $block)
    {
        $temporary_setting_parameter = json_decode($block['parameter'], TRUE);
        switch($block['name'])
        {
            case 'HoTro' :
            {
                $src = $temporary_setting_parameter['image'];
                if(!in_array($src, $lists)) $lists[] = $src;
                break;
            }
            case 'html' :
            {
                $html = str_get_html( '<html><body>' . $temporary_setting_parameter['content'] . '</body></html>');
                $images = $html->find("img");
                foreach($images as $image)
                {
                    if(empty($image->src)) continue;
                    $src = $image->src;

                    if( strpos($src, "timthumb.php") )
                    {
                        $src_part = explode('?src=', $src);
                        $src = $src[1];

                        $src_part = explode('&', $src);
                        $src = $src[0];
                    }

                    if( !strpos('091117' . $src, SITE_URL) )
                    {
                        continue;
                    }

                    if(!in_array($src, $lists)) $lists[] = $src;
                }
                break;
            }
            case 'HtmlMulti' :
            {

                unset($temporary_setting_parameter['title'], $temporary_setting_parameter['title_link']);

                foreach($temporary_setting_parameter as $k=>$v)
                {

                    $html = str_get_html( '<html><body>' . $v['html_value'] . '</body></html>');
                    $images = $html->find("img");
                    foreach($images as $image)
                    {
                        if(empty($image->src)) continue;
                        $src = $image->src;

                        if( strpos($src, "timthumb.php") )
                        {
                            $src_part = explode('?src=', $src);
                            $src = $src[1];

                            $src_part = explode('&', $src);
                            $src = $src[0];
                        }

                        if( !strpos('091117' . $src, SITE_URL) )
                        {
                            continue;
                        }

                        if(!in_array($src, $lists)) $lists[] = $src;
                    }
                }
                break;
            }

            case 'image' :
            {
                $src = $temporary_setting_parameter['src'];
                if(!in_array($src, $lists)) $lists[] = $src;
                break;
            }

            case 'MatBang' :
            {
                $html = str_get_html( '<html><body>' . $temporary_setting_parameter['content'] . '</body></html>');
                $images = $html->find("image");
                if(empty($images)) break;
                $src =  $images[0]->src;
                if(!in_array($src, $lists)) $lists[] = $src;

                $images = $html->find("polygon");
                foreach($images as $image)
                {
                    $t = 'data-src';
                    if(empty($image->$t)) continue;

                    $src = $image->$t;

                    if( strpos($src, "timthumb.php") )
                    {
                        $src_part = explode('?src=', $src);
                        $src = $src[1];

                        $src_part = explode('&', $src);
                        $src = $src[0];
                    }

                    if( !strpos('091117' . $src, SITE_URL) )
                    {
                        continue;
                    }

                    if(!in_array($src, $lists)) $lists[] = $src;
                }
                break;
            }

            case 'Slide' :
            {
                $all_item = $temporary_setting_parameter;
                array_shift($all_item);array_shift($all_item);array_shift($all_item);
                foreach($all_item as $k=>$item)
				{
				    $src = $item['image'];
                    if(!in_array($src, $lists)) $lists[] = $src;
				}

                break;
            }
            case 'TextImage' :
            {
                $html = str_get_html( '<html><body>' . $temporary_setting_parameter['left_content'] . '</body></html>');
                $images = $html->find("img");
                foreach($images as $image)
                {
                    if(empty($image->src)) continue;
                    $src = $image->src;

                    if( strpos($src, "timthumb.php") )
                    {
                        $src_part = explode('?src=', $src);
                        $src = $src[1];

                        $src_part = explode('&', $src);
                        $src = $src[0];
                    }

                    if( !strpos('091117' . $src, SITE_URL) )
                    {
                        continue;
                    }

                    if(!in_array($src, $lists)) $lists[] = $src;
                }

                $html = str_get_html( '<html><body>' . $temporary_setting_parameter['right_content'] . '</body></html>');
                $images = $html->find("img");
                foreach($images as $image)
                {
                    if(empty($image->src)) continue;
                    $src = $image->src;

                    if( strpos($src, "timthumb.php") )
                    {
                        $src_part = explode('?src=', $src);
                        $src = $src[1];

                        $src_part = explode('&', $src);
                        $src = $src[0];
                    }

                    if( !strpos('091117' . $src, SITE_URL) )
                    {
                        continue;
                    }

                    if(!in_array($src, $lists)) $lists[] = $src;
                }

                break;
            }

            case 'TitleImageLinkDescription' :
            {
                $src = $temporary_setting_parameter['box_image'];
                if(!in_array($src, $lists)) $lists[] = $src;
                break;
            }


        }
    }

    $links = models_DB::get('SELECT * FROM ' .    OPTION_TABLE . ' LIMIT 9999 ');

    foreach($links as $link)
    {
        $attr = json_decode( $link['attributes'], TRUE );

        switch( $attr['type'] )
        {
            case 'image' :
            {
                $src = $link['value'];

                if( strpos($src, "timthumb.php") )
                {
                    $src_part = explode('?src=', $src);
                    $src = $src[1];

                    $src_part = explode('&', $src);
                    $src = $src[0];
                }

                if( !strpos('091117' . $src, SITE_URL) )
                {
                    continue;
                }

                if(!in_array($src, $links)) $lists[] = $src;
                break;
            }
            case 'html' :
            {
                $html = str_get_html( '<html><body>' . $link['value'] . '</body></html>');
                $images = $html->find("img");

                foreach($images as $image)
                {
                    $src = $image->src;

                    if( strpos($src, "timthumb.php") )
                    {
                        $src_part = explode('?src=', $src);
                        $src = $src[1];

                        $src_part = explode('&', $src);
                        $src = $src[0];
                    }

                    if( !strpos('091117' . $src, SITE_URL) )
                    {
                        continue;
                    }

                    if(!in_array($src, $links)) $lists[] = $src;
                }

                break;
            }
        }

    }

    return $lists;

}

function get_used_media()
{

    require_once PATH_ROOT . '/admin/AutoFetchContentApp/simple_html_dom.php';

    $lists = array();

    $html = hcv_file_get_content( SITE_URL );

    $images = $html->find("img");
    foreach($images as $image)
    {
        $src = $image->src;

        if( strpos($src, "timthumb.php") )
        {
            $src_part = explode('?src=', $src);
            $src = $src[1];

            $src_part = explode('&', $src);
            $src = $src[0];
        }

        if( !strpos('091117' . $src, SITE_URL) )
        {
            continue;
        }

        if(!in_array($src, $links)) $lists[] = $src;
    }


    $links = models_DB::get('SELECT url, id FROM ' . POST_TABLE . ' LIMIT 9999 ');

    foreach($links as $link)
    {

        $html = hcv_file_get_content( hcv_url('p', $link['url'], $link['id'], FALSE) );

        $images = $html->find("img");

        foreach($images as $image)
        {
            $src = $image->src;

            if( strpos($src, "timthumb.php") )
            {
                $src_part = explode('?src=', $src);
                $src = $src[1];

                $src_part = explode('&', $src);
                $src = $src[0];
            }

            if( !strpos('091117' . $src, SITE_URL) )
            {
                continue;
            }

            if(!in_array($src, $links)) $lists[] = $src;
        }
    }


    $links = models_DB::get('SELECT url, id FROM ' . CATEGORY_TABLE . ' LIMIT 9999 ');
    foreach($links as $link)
    {
        $html = hcv_file_get_content( hcv_url('c', $link['url'], $link['id'], FALSE) );

        $images = $html->find("img");

        foreach($images as $image)
        {
            $src = $image->src;

            if( strpos($src, "timthumb.php") )
            {
                $src_part = explode('?src=', $src);
                $src = $src[1];

                $src_part = explode('&', $src);
                $src = $src[0];
            }

            if( !strpos('091117' . $src, SITE_URL) )
            {
                continue;
            }

            if(!in_array($src, $links)) $lists[] = $src;
        }
    }

    $links = models_DB::get('SELECT url, id FROM ' . TAG_TABLE . ' LIMIT 9999 ');
    foreach($links as $link)
    {
        $html = file_get_html( hcv_url('t', $link['url'], $link['id'], FALSE) );

        $images = $html->find("img");

        foreach($images as $image)
        {
            $src = $image->src;

            if( strpos($src, "timthumb.php") )
            {
                $src_part = explode('?src=', $src);
                $src = $src[1];

                $src_part = explode('&', $src);
                $src = $src[0];
            }

            if( !strpos('091117' . $src, SITE_URL) )
            {
                continue;
            }

            if(!in_array($src, $links)) $lists[] = $src;
        }
    }

    $links = models_DB::get('SELECT * FROM ' .    OPTION_TABLE . ' LIMIT 9999 ');

    foreach($links as $link)
    {
        $attr = json_decode( $link['attributes'], TRUE );

        switch( $attr['type'] )
        {
            case 'image' :
            {
                $src = $link['value'];

                if( strpos($src, "timthumb.php") )
                {
                    $src_part = explode('?src=', $src);
                    $src = $src[1];

                    $src_part = explode('&', $src);
                    $src = $src[0];
                }

                if( !strpos('091117' . $src, SITE_URL) )
                {
                    continue;
                }

                if(!in_array($src, $links)) $lists[] = $src;
                break;
            }
            case 'html' :
            {
                $html = str_get_html( '<html><body>' . $link['value'] . '</body></html>');
                $images = $html->find("img");

                foreach($images as $image)
                {
                    $src = $image->src;

                    if( strpos($src, "timthumb.php") )
                    {
                        $src_part = explode('?src=', $src);
                        $src = $src[1];

                        $src_part = explode('&', $src);
                        $src = $src[0];
                    }

                    if( !strpos('091117' . $src, SITE_URL) )
                    {
                        continue;
                    }

                    if(!in_array($src, $links)) $lists[] = $src;
                }

                break;
            }
        }

    }

    return $lists;
}


function get_all_uploads_file()
{

    $files = array();
    $scans = scandir(CLIENT_ROOT . '/uploads');
    $scans = array_diff($scans, array('.', '..'));

    foreach($scans as $scan)
    {
        if(is_dir( CLIENT_ROOT . '/uploads/' . $scan ))
        {
            $scan2s = scandir(CLIENT_ROOT . '/uploads/' . $scan);
            $scan2s = array_diff($scan2s, array('.', '..'));

            foreach($scan2s as $scan2)
            {
               if(is_dir( CLIENT_ROOT . '/uploads/' . $scan . '/' . $scan2 ))
               {

               }
               else
               {
                    //echo SITE_URL . '/uploads/' . $scan . '/' . $scan2, '<br />';
                    if(!in_array(SITE_URL . '/uploads/' . $scan . '/' . $scan2, $files)) $files[] = SITE_URL . '/uploads/' . $scan . '/' . $scan2;
               }
            }
        }
        else
        {
            if(!in_array( SITE_URL . '/uploads/' . $scan, $files)) $files[] = SITE_URL . '/uploads/' . $scan;
        }
    }

    return $files;
}


function resize_image_max($image,$max_width,$max_height) {
    $w = imagesx($image); //current width
    $h = imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }

    if (($w <= $max_width) && ($h <= $max_height)) { return $image; } //no resizing needed

    //try max width first...
    $ratio = $max_width / $w;
    $new_w = $max_width;
    $new_h = $h * $ratio;

    //if that didn't work
    if ($new_h > $max_height) {
        $ratio = $max_height / $h;
        $new_h = $max_height;
        $new_w = $w * $ratio;
    }

    $new_image = imagecreatetruecolor ($new_w, $new_h);
    $result_boolean = imagecopyresampled($new_image,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

    return $new_image;
}


function resize_image_crop($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed

    //try max width first...
    $ratio = $width / $w;
    $new_w = $width;
    $new_h = $h * $ratio;

    //if that created an image smaller than what we wanted, try the other way
    if ($new_h < $height) {
        $ratio = $height / $h;
        $new_h = $height;
        $new_w = $w * $ratio;
    }

    $image2 = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

    //check to see if cropping needs to happen
    if (($new_h != $height) || ($new_w != $width)) {
        $image3 = imagecreatetruecolor ($width, $height);
        if ($new_h > $height) { //crop vertically
            $extra = $new_h - $height;
            $x = 0; //source x
            $y = round($extra / 2); //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        } else {
            $extra = $new_w - $width;
            $x = round($extra / 2); //source x
            $y = 0; //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        }
        imagedestroy($image2);
        return $image3;
    } else {
        return $image2;
    }
}


function resize_image_force($image,$width,$height) {
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed

    $image2 = imagecreatetruecolor ($width, $height);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $width, $height, $w, $h);

    return $image2;
}


function __array_sort($array, $on, $order=SORT_ASC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
