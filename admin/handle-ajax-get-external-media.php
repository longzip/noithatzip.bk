<?php


 


    require PATH_ROOT . '/admin/AutoFetchContentApp/simple_html_dom.php';
    
   
      
    if( !isset($_POST['type']) )
    {
        die();  
    }
    
    
    if($_POST['type']=='get_list_link')
    {
        $list_links = array();
        $list_links[] = SITE_URL;
        
        $posts = models_DB::get('SELECT * FROM ' . POST_TABLE . ' LIMIT 99999 ');
         
        foreach($posts as $post)
        {
            $list_links[] = hcv_url('p', $post['url'], $post['id'], FALSE);
        }
        
        $cats = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' LIMIT 99999 ');
        foreach($cats as $cat)
        {
            $list_links[] = hcv_url('c', $cat['url'], $cat['id'], FALSE);
        }
        
        $tags = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' LIMIT 99999 ');
        foreach($tags as $tag)
        {
            $list_links[] = hcv_url('t', $tag['url'], $tag['id'], FALSE);
        }
        
        
        echo json_encode($list_links);
        echo '091117';
        ?>
        <div class="list-link">
            <h2>Danh sách link :</h2>
            <ul>
            <?php
                foreach($list_links as $list_link)
                {
                    ?>
                    <li>
                        <a target="_blank" href="<?php echo $list_link ?>"><?php echo $list_link ?></a>
                    </li>
                    <?php
                }
            ?>
            </ul>
        </div>
        <?php
        die();
    }
    
    if($_POST['type']=='get_list_image_of_link')
    {
        $html = hcv_file_get_content($_POST['link']);
        $images = $html->find("img");
        
        $arr_images = array();
        
        foreach($images as $image)
        {
            $src = $image->src;
            if( strpos($src, DOMAIN) )
            {
                continue;
            }
            
            if( strpos($src, "timthumb.php") )
            {
                $src_part = explode('?src=', $src);
                $src = $src[1];
                
                $src_part = explode('&', $src);
                $src = $src[0];
            }
            $arr_images[] = $src;
        }
        
        echo json_encode($arr_images);
    }
    
    if($_POST['type']=='fetch_image')
    {
        $html = hcv_file_get_content($_POST['image_src']);
        
        if(!file_exists( CLIENT_ROOT . '/uploads/auto' )) mkdir( CLIENT_ROOT . '/uploads/auto' );
        
        $path_info = pathinfo($_POST['image_src']);
        $ex = explode('?', $path_info['extension']);
        $ex = $ex[0];
        
        $file_name = '/uploads/auto/' . pretty_string($path_info['filename']) . '-' . date('H', hcv_time()) . '-' . date('d', hcv_time()) . '-' . date('m', hcv_time()) . '.' . $ex;
        
        
        hcv_file_put_contents( CLIENT_ROOT . $file_name, $_POST['image_src']);
        
        ?>
        <div class="media-item flex-item" style="width: 33.33%; padding: 10px;">
            <a target="_blank" href="<?php echo SITE_URL . $file_name ?>">
                <img src="<?php echo SITE_URL . $file_name ?>" />
            </a>
        </div>
        <?php
    }
    
    
    
    
    function zzzzzzzhcv_file_put_contents($target, $source)
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
         
    }
      
    if( isset($_POST['type']) && ( $_POST['type'] == 'category' ) )
    {
        
        $new_links = array();
        $old_links = array();
        
        $html = hcv_file_get_content($_POST['source_link']); 
         
        $list_post_cats = $html->find($_POST['post_link']);
        $list_post_images = $html->find($_POST['image']);
        
          
        if(!empty($list_post_images))
        {
            $list_images = array();
            foreach($list_post_images as $list_post_image)
            {
                $list_images[] = $list_post_image->src;
            }
        }
        if(!empty($list_post_cats))
        {
            $list_posts = array();
            
             
            foreach($list_post_cats as $list_post_cat)
            {
                $list_posts[] = $_POST['base_url'] . $list_post_cat->href;
            }
            foreach($list_posts as $k=>$list_post)
            { 
                $exsits = models_DB::get('SELECT * FROM ' . POST_TABLE .  ' WHERE fetched_url_1=\'' . $list_post . '\' ');
                if(!empty($exsits)) 
                {
                    $old_links[] = $list_post;
                    continue;
                }                
                
                $html = file_get_html( $list_post );
                $insert_content = array();
                
                $insert_content['title'] = '';
                $temp = $html->find($_POST['title']);
                if(!empty($temp)) $insert_content['title'] = html_entity_decode($temp[0]->innertext());
                
                if(!empty($_POST['ori_domain'])) $insert_content['url'] = str_replace($_POST['ori_domain'] . '/', '', $list_post);
                else $insert_content['url'] = $list_post;
                
                $insert_content['post_type'] = $_POST['post_type'];
                
                $categories = '';
                if(!empty($_POST['categories']))
                {
                    foreach($_POST['categories'] as $k=>$category)
                    {
                        if($k) $categories =  ',' . $categories;                        
                    }
                }
                
                $insert_content['categories'] = $_POST['categories'];
                
                $insert_content['template'] = $_POST['template'];
                
                
                
                $insert_content['view_count'] = 0;
                $insert_content['comment_count'] = 0;
                
                $insert_content['secure_key'] = random_string(8);
                
                
                
                
                $insert_content['seo'] = '{"title":"","description":"","keywords":"","index":"index","follow":"follow","canonical":"","301":""}';
                
                
                
                $insert_content['content'] = '';
                $temp = $html->find($_POST['content']);
                if(!empty($temp)) $insert_content['content'] = $temp[0]->outertext();
                
                if(!empty($list_images[$k])) $insert_content['image'] = $list_images[$k];
                
                $insert_content['the_status'] = 'publish';
                
                $insert_content['time_create'] = hcv_time();
                
                $insert_content['time_update'] = hcv_time();
                
                $insert_content['user_id'] = USER_ID;
                
                $insert_content['fetched_url_1'] = $list_post;
                
                $insert_id = models_DB::insert($insert_content, POST_TABLE);
                
                $new_links[] = $insert_id;                
                
            }
            
            ?>
            <div class="old-links">
                <div class="noti-title">Link đã tồn tại : </div>
                <?php 
                    foreach($old_links as $old_link)
                    {
                        ?>
                        <a href="<?php echo $old_link ?>" target="_blank"><?php echo $old_link ?></a>
                        <?php
                    }
                ?>
            </div>
            <hr /><br />
            <div class="new-links">
                <div class="noti-title">Link mới : </div>
                <?php 
                    foreach($new_links as $new_link)
                    {
                        $post = get_post($new_link);
                        ?>
                        <a href="<?php hcv_url('p', $post['url'], $post['id']) ?>" target="_blank"><?php echo $post['title'] ?></a>
                        <?php
                    }
                ?>
            </div>
            <?php 
        }
        die();
    }
    if( isset($_POST['type']) && ( $_POST['type'] == 'post_get_list_image' ) )
    { 
        
        $list_post = $_POST['source_link'];
        $html = hcv_file_get_content($_POST['source_link']);
        
        
         $list_htmls = array(
            'content'   => '#tong_quan .single-content',
            'nd_vi_tri'   => '#vi_tri .single-content',
            'mat_bang'   => '#mat_bang .single-content',
            'tien_ich'   => '#tien_ich .single-content',
            'thiet_ke'   => '#thiet_ke .single-content',
            'ban_hang'   => '#ban_hang .single-content',
            'bang_gia'   => '#bang_gia .single-content'
        );
        
        $list_images = array();  
        foreach($list_htmls as $list_html)
        {
            $temp = $html->find($list_html);
            
                  
            if(!empty($temp))
            {
    
                $the_content = $temp[0];
                $temp = $the_content->find('img');
                foreach($temp as $t_image)
                {
                    $list_images[] = $_POST['base_url'] . $t_image->src;
                }
            }
        }
        
        
        echo json_encode($list_images);
        die();
    }
    if( isset($_POST['type']) && ( $_POST['type'] == 'post_image' ) )
    {
        if(!file_exists( CLIENT_ROOT . '/uploads/auto' )) mkdir( CLIENT_ROOT . '/uploads/auto' );
        $path_info = pathinfo($_POST['src']); 
         
        hcv_file_put_contents( CLIENT_ROOT . '/uploads/auto/' . $path_info['basename'], $_POST['src']);
        echo CLIENT_ROOT . '/uploads/auto/' . $path_info['basename'];
    }
    
    if( isset($_POST['type']) && ( $_POST['type'] == 'post' ) )
    {
    
        $exsits = models_DB::get('SELECT * FROM ' . POST_TABLE .  ' WHERE fetched_url_1=\'' . $_POST['source_link'] . '\' ');
        if(!empty($exsits)) 
        {
            ?>
            Bài viết đã tồn tại : <a target="_blank" href="<?php hcv_url('p', $exsits[0]['url'], $exsits[0]['id']) ?>"><?php echo $exsits[0]['title'] ?></a>
            <?php
            die();
        }
        
        $list_post = $_POST['source_link'];
        
        $html = hcv_file_get_content($_POST['source_link']);
        
        $insert_content = array();
                
        $insert_content['title'] = '';
        $temp = $html->find($_POST['title']);
        if(!empty($temp)) $insert_content['title'] = html_entity_decode($temp[0]->innertext());
        $insert_content['title'] = str_replace('  ', '', $insert_content['title']);
        
        
        if(!empty($_POST['ori_domain'])) $insert_content['url'] = str_replace($_POST['ori_domain'] . '/', '', $list_post);
        else $insert_content['url'] = $list_post;
        
        $insert_content['post_type'] = $_POST['post_type'];
        
        $categories = '';
        if(!empty($_POST['categories']))
        {
            foreach($_POST['categories'] as $k=>$category)
            {
                if($k) $categories = $categories .  ',' . $category;   
                else   $categories =  $category;                  
            }
        }
        
        $insert_content['categories'] = $categories;
        
        $insert_content['template'] = $_POST['template'];
        
        
        
        $insert_content['view_count'] = 0;
        $insert_content['comment_count'] = 0;
        
        $insert_content['secure_key'] = random_string(8);
        
        
        $seo['title'] = '';
        $temp = $html->find('title');
        if(!empty($temp)) $seo['title'] = html_entity_decode($temp[0]->innertext());
        
        $seo['description'] = '';
        $temp = $html->find('meta[name="description"]');
        if(!empty($temp)) $seo['description'] = html_entity_decode($temp[0]->innertext());
        
        
        $insert_content['seo'] = array(
            'title'         => $seo['title'],
            'description'   => $seo['description'],
            'keywords'      => '',
            'index'         => 'index',
            'follow'        => 'follow',
            'canonical'     => '',
            '301'           => ''
        );
        $insert_content['seo'] = json_encode($insert_content['seo']);
        
        
        
        $list_htmls = array(
            'content'   => '#tong_quan .single-content',
            'nd_vi_tri'   => '#vi_tri .single-content',
            'mat_bang'   => '#mat_bang .single-content',
            'tien_ich'   => '#tien_ich .single-content',
            'thiet_ke'   => '#thiet_ke .single-content',
            'ban_hang'   => '#ban_hang .single-content',
            'bang_gia'   => '#bang_gia .single-content'
        );
        
        foreach($list_htmls as $k=>$list_html)
        {
            $insert_content[$k] = '';
            $temp = $html->find($list_html);
            
            if(!empty($temp))
            {
                $the_content = $temp[0];
                $temp = $the_content->find('img');
                foreach($temp as $t_image)
                {
                    $t = $t_image->src;
                     if( strpos( $t , 'ttp') )
                     {
                        if(!strpos( $t , DOMAIN )) continue;
                     }
                     $old_image_url = $_POST['base_url'] . $t_image->src;
                      
                    
                    $image_url = explode('/', $old_image_url);
                    $image_url = $image_url[count($image_url) - 1];
                    
                    
                    $path_info = pathinfo($old_image_url); 
                    
                    //$t_image->src = '111';   
                     
                    $t_image->src = SITE_URL . '/uploads/auto/' . $path_info['basename'];
                    
                }
                
                 
                $temp2 = $the_content->find('a');
                foreach($temp2 as $t_image)
                {
                    $t_image->href="#";
                }
                
                  
                $insert_content[$k] = $the_content->outertext();
            } 
            
            
            
        }
        
        
        
        
        
        
        $insert_content['the_status'] = 'publish';
        
        $insert_content['time_create'] = hcv_time();
        
        $insert_content['time_update'] = hcv_time();
        
        $insert_content['user_id'] = USER_ID;
        
        $insert_content['fetched_url_1'] = $list_post;
        
        $insert_id = models_DB::insert($insert_content, POST_TABLE);
        
        $post = get_post($insert_id);
        ?>
        <a target="_blank" href="<?php hcv_url('p', $post['url'], $insert_id) ?>"><?php echo $post['title'] ?></a>
        <?php
        die();
    }