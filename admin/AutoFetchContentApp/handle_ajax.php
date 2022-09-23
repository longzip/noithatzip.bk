<?php
include dirname(dirname(dirname(__FILE__))) . '/config.php';
$obj_DB = new models_DB;

$my_secure = new secure_secure();
$my_secure->check_admin();
//h($_POST);

require dirname(dirname(__FILE__)). '/AutoFetchContentApp/simple_html_dom.php';

function fetch_content($url_to_get)
{
    //echo $url_to_get;
    global $i;
    $exist = models_DB::get('SELECT id FROM autofetchcontent WHERE url=\'' . $url_to_get . '\'');
    if(empty($exist))
    {
        $i++;
        $html = file_get_html($url_to_get);
        
        $find_title = $html->find($_POST['title'], 0);
        $title = $find_title->plaintext;
        
        $find_content = $html->find($_POST['content'], 0);
        $content = $find_content->outertext;
        
        $find_image = $find_content->find("img");
        $image = array();
        foreach($find_image as $v_find_image)
        {
            $image_src = $v_find_image->src;
            if(!in_array($image_src, $image)) $image[] = $image_src;
        }
        if(!empty($_POST['image']))
        {
            $find_image2 = $html->find($_POST['image']);
            foreach($find_image2 as $v_find_image2)
            {
                $src = $v_find_image2->src;
                if(!in_array($src, $image)) $image[] = $src;
            }
        }
        
        if(!empty($_POST['phone']))
        {
            $find_phone = $html->find($_POST['phone'], 0);
            if($find_phone != null) $phone = $find_phone->plaintext;
            else $phone = '';
        }
        else
        {
            $phone = '';
        }
        
        
        if(!empty($_POST['email']))
        {
            $find_email = $html->find($_POST['email'], 0);
            if($find_email != null) $email = $find_email->plaintext;
            else $email = '';
        }
        else
        {
            $email = '';
        }
        
        if(!empty($_POST['author']))
        {
            $find_author = $html->find($_POST['author'], 0);
            if($find_author != null) $author = $find_author->plaintext;
            else $author = 'Khách vãng lai';
        }
        else
        {
            $author = 'Khách vãng lai';
        }
        
        if(!empty($_POST['price']))
        {
            $find_price = $html->find($_POST['price'], 0);
            if($find_price != null) $price = $find_price->plaintext;
            else $price = 'Thỏa thuận';
        }
        else
        {
            $price = 'Thỏa thuận';
        }
        
        $insert_content = array(
            'title'         => $title,
            'content'       => $content,
            'place'         => 'toan-tinh',
            'phone'         => $phone,
            'email'         => $email,
            'publisher'     => $author,
            'image'         => serialize($image),
            'nhu_cau'       => $_POST['nhu_cau'],
            'view'          => rand(0,500),
            'user_id'       => 0,
            'ip_publisher'  => $_SERVER['REMOTE_ADDR'],
            'price'         => $price,
            'last_update'   => time(),
            'time'          => time(),
            'up'            => 5
        );
        $insert_content['category'] = $_POST['category'];
        $parent_category = get_another_value_column('term_parent_category', 'term', ' WHERE term_id='.$_POST['category']);
        if(!empty($parent_category)) $insert_content['category'] .= ',' . $parent_category;
            /**
             * END
             */
             
        $post_id  = insert_post($insert_content, false);
        if($post_id)
        {
            $insert_content = array('url' => $url_to_get);
            models_DB::insert($insert_content, 'autofetchcontent');
            echo $i;
            ?>
            <a href="<?php echo $url_to_get ?>">. <?php echo $title ?></a><br />
            <?php
        }
    }
    
}

if(isset($_POST['type']) && ($_POST['type']=='SingleToMulti'))
{
	if(empty($_POST['title']) || empty($_POST['content']) ) die("Không được để trống trường tiêu đề, nội dung");
    
    
    //fetch_content('http://chothai.vn/biz/showthread.php?103017-font-colorredHuong-Dan-Choi-game-AVATAR-Gia-Lap-tren-may-tinhfont&s=5f8c2769d2997b29b6d933ae2f3a1737');

    
    $i = 0;
    $url_to_get = $_POST['main_url'];
    
    $group_url[] = $url_to_get;
    $global_html = file_get_html($_POST['main_url']);
    $page = $global_html->find($_POST['group_url']);
    foreach($page as $v_page)
    {
        $group_href = $v_page->href;
        if($group_href!='javascript://') $group_url[] = $_POST['base_url'] . $group_href;
    }
    //h($group_url);
    $break = false;
    foreach($group_url as $v_group_url)
    {
        if($break) break;
        $group_html = file_get_html($v_group_url);
        $link_to_get = $group_html->find($_POST['detai_url']);
        foreach($link_to_get as $v_link_to_get)
        {
            $url = $_POST['base_url'] . $v_link_to_get->href;
            //$url1 = explode('?', $url);
            //if(count($url<=1)) $url = $url1;
            
            $exist = models_DB::get('SELECT id FROM autofetchcontent WHERE url=\'' . $url_to_get . '\'');
            if(empty($exist)) $link[] = $url;
            else
            {
                $break = true;
                break;   
            }
            
        }
    }
    h($link);
    $link = array_reverse($link);
    foreach($link as $v_link)
    {
        fetch_content($v_link);
    }
}


if(isset($_POST['type']) && ($_POST['type']=='get_content_multi_by_number'))
{
    if(empty($_POST['title']) || empty($_POST['content']) ) die("Không được để trống trường tiêu đề, nội dung");
    
    $i = 0;
    $url_to_get = $_POST['main_url'];
    
    $group_url = array();
    //$global_html = file_get_html($_POST['main_url']);
    //$page = $global_html->find($_POST['group_url']);
    for($k=$_POST['start_page'];$k<=$_POST['end_page'];$k++)
    {
        $group_url[] = $_POST['main_url'] . $k;
    }
    //h($group_url);
    $break = false;
    foreach($group_url as $v_group_url)
    {
        if($break) break;
        $group_html = file_get_html($v_group_url);
        $link_to_get = $group_html->find($_POST['detai_url']);
        foreach($link_to_get as $v_link_to_get)
        {
            $url = $_POST['base_url'] . $v_link_to_get->href;
            //$url1 = explode('?', $url);
            //if(count($url<=1)) $url = $url1;
            
            $exist = models_DB::get('SELECT id FROM autofetchcontent WHERE url=\'' . $url_to_get . '\'');
            if(empty($exist)) $link[] = $url;
            else
            {
                $break = true;
                break;   
            }
            
        }
    }
    //h($link);
    $link = array_reverse($link);
    foreach($link as $v_link)
    {
        fetch_content($v_link);
    }
}