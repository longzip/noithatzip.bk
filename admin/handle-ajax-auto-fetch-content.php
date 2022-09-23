<?php
    require PATH_ROOT . '/admin/AutoFetchContentApp/simple_html_dom.php';
    
    if( isset($_POST['type']) )
    {         
         
        foreach($_POST as $k=>$v) 
        {
            if(is_array($v)) update_config($k, json_encode($v));
            else update_config($k, $v);
        }
       
    }
    function sdfhcv_file_get_content($file)
    {
         
        if(!file_exists( CLIENT_ROOT. '/temp.html' ))
         {
                $myfile = fopen( CLIENT_ROOT. '/temp.html', "w") or die("Unable to open file!");
                fclose($myfile);
         }
                  
         $ch = curl_init();
         $agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
         $ip = '103.18.6.97';

        
        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $file);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        
         
        
       // $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';   
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        
        // grab URL and pass it to the browser
        //$html = curl_multi_getcontent($ch);
        $html_content = curl_exec($ch);
          
        file_put_contents(CLIENT_ROOT. '/temp.html', $html_content);
         
        $html = file_get_html( CLIENT_ROOT. '/temp.html');
        
        return $html;
         
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
    
    
    if( isset($_POST['type']) && ( $_POST['type'] == 'get_post' ) )
    {
        
        $list_post = $_POST['src'];
         
        $exsits = models_DB::get('SELECT * FROM ' . POST_TABLE .  ' WHERE fetched_url_1=\'' . $list_post . '\' ');
        if(!empty($exsits)) 
        {
            $old_links[] = $list_post;
            
            
            
            $categories = '';
            if(!empty($_POST['categories']))
            {
                $old_categories = $exsits[0]['categories'];
                if(empty($old_categories))
                {
                    $new_cat = implode(',' , $_POST['categories']);
                }
                else
                {
                    $new_cat = $old_categories . ',' . implode(',' , $_POST['categories']);
                    $new_cat = explode(',', $new_cat);
                    $new_cat = array_unique($new_cat);
                    $new_cat = implode(',' , $new_cat);                                                        
                }
                
                $update = array('categories'=>$new_cat);
                models_DB::update($update, POST_TABLE, ' WHERE id=' . $exsits[0]['id'] );                                                
                
            }
            $post_info = $exsits[0];
            
            ?>
            <li>
                Cũ : 
                <a href="<?php echo $_POST['src'] ?>" target="_blank"><?php echo $_POST['src'] ?></a>
                =&gt;&gt;
                <a target="_blank" href="<?php hcv_url('p', $post_info['url'], $post_info['id']) ?>"><?php echo $post_info['title'] ?></a>            
            </li>
            <?php
            
            return;
        }                
        
        $html = file_get_html( $list_post );
        
        
        $insert_content = array();
        
        $insert_content['title'] = '';
        $temp = $html->find($_POST['title']);
        if(!empty($temp)) $insert_content['title'] = html_entity_decode($temp[0]->innertext());
        
        if(!empty($_POST['ori_domain'])) $insert_content['url'] = str_replace($_POST['ori_domain'] . '/', '', $list_post);
        else $insert_content['url'] = $list_post;
        
        //$insert_content['url']  = str_replace('', '.html', $insert_content['url'] );
        
        $insert_content['post_type'] = $_POST['post_type'];
        
         
        
        $insert_content['categories'] = implode(',', $_POST['categories']);
        
        $insert_content['template'] = $_POST['template'];
        
        
        
        $insert_content['view_count'] = 0;
        $insert_content['comment_count'] = 0;
        $insert_content['secure_key'] = random_string(8);
        
        
        
        
        $insert_content['seo'] = '{"title":"","description":"","keywords":"","index":"index","follow":"follow","canonical":"","301":""}';
        
        
        
        $insert_content['content'] = '';
        $temp = $html->find($_POST['content']);
        if(!empty($temp)) $insert_content['content'] = $temp[0]->outertext();
        
         $insert_content['image'] = '';
        $temp = $html->find($_POST['content'] . ' img');
        if(!empty($temp)) $insert_content['image'] = $temp[0]->src;
        
        $insert_content['image'] = $_POST['post_image'];
        $insert_content['title'] = $_POST['post_title'];
        
        /*
        $metas = $html->find($_POST['content'] . ' tr ');
         
        foreach($metas as $meta)
        {
            
            $text = $meta->plaintext;
             
            if(strpos('091117' . $text, 'Mô tả'))
            { 
                $temp = $meta->find('td');  
                if(!empty($temp)) $insert_content['content'] = $temp[1]->outertext();
            }
            
            if(strpos('091117' . $text, 'Giá'))
            { 
                $temp = $meta->find('td');  
                if(!empty($temp)) $insert_content['basic_gia'] = $temp[1]->plaintext;
            }
            
            if(strpos('091117' . $text, 'Diện tích'))
            { 
                $temp = $meta->find('td');  
                if(!empty($temp)) $insert_content['basic_dientich'] = $temp[1]->plaintext;
            }
            
            
            $insert_content['basic_khu_vuc'] = '';
            if(strpos('091117' . $text, 'Địa chỉ'))
            { 
                $temp = $meta->find('td');  
                if(!empty($temp)) $insert_content['basic_khu_vuc'] = $temp[1]->plaintext;
            }
            else
            {
                if(strpos('091117' . $text, 'Quận huyện'))
                { 
                    $temp = $meta->find('td');  
                    if(!empty($temp)) $insert_content['basic_khu_vuc'] = $temp[1]->plaintext;
                }
                
                if(strpos('091117' . $text, 'Tỉnh thành phố'))
                { 
                    $temp = $meta->find('td');  
                    if(!empty($temp)) $insert_content['basic_khu_vuc'] = $insert_content['basic_khu_vuc'] . ', ' . $temp[1]->plaintext;
                }
            }
            
            if(strpos('091117' . $text, 'Điện thoại'))
            { 
                $temp = $meta->find('td');  
                if(!empty($temp)) $insert_content['author_phone'] = $temp[1]->plaintext;
            }
            if(strpos('091117' . $text, 'Ngày'))
            { 
                $temp = $meta->find('td');  
                if(!empty($temp)) $insert_content['ngay_dang'] = $temp[1]->plaintext;
            }
            
            if(strpos('091117' . $text, 'Xem các tin do thành viên này đăng'))
            { 
                $temp = $meta->find('a');
                
                
                if(!empty($temp)) 
                {
                    $href = $temp[0]->href;
                    $html2 = file_get_html($_POST['ori_domain'] . $href);
                    $tr = $html2->find(".tab-content-center2 table table tr");
                    if(empty($tr[1]))
                    {
                        $insert_content['author_display_name'] = 'Anh Re';    
                    }
                    else
                    {
                        $td =  $tr[1] -> find('td');
                        $name = $td[1]->plaintext;
                        $insert_content['author_display_name'] = $name;    
                    }
                    
                }
                
                
            }
            
             
            
             
        }
        
        
         
        $insert_content['basic_dia_chi'] = $insert_content['basic_khu_vuc'];
        $insert_content['basic_hinh_thuc'] = $_POST['basic_hinh_thuc'];
        $insert_content['basic_loai'] = $_POST['basic_loai'];
        
        */
        
        //if(!empty($list_images[$k])) $insert_content['image'] = $list_images[$k];
        
        $insert_content['the_status'] = 'publish';
        
        $insert_content['time_create'] = hcv_time();
        
        $insert_content['time_update'] = hcv_time();
        
        $insert_content['user_id'] = USER_ID;
        
        $insert_content['fetched_url_1'] = $list_post;
        
        $insert_id = models_DB::insert($insert_content, POST_TABLE);
        $post_info = get_post($insert_id);
        
        ?>
        <li>
            Mới : 
            <a href="<?php echo $_POST['src'] ?>" target="_blank"><?php echo $_POST['src'] ?></a>
            =&gt;&gt;
            <a target="_blank" href="<?php hcv_url('p', $post_info['url'], $post_info['id']) ?>"><?php echo $post_info['title'] ?></a>            
        </li>
        <?php
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
            $list_titles = array();
            
             
            foreach($list_post_cats as $k=>$list_post_cat)
            {
                $list_posts[] = $_POST['base_url'] . $list_post_cat->href;
                $list_titles[] = $list_post_cat->plaintext;
            }
            
            echo implode('130791', $list_posts);
            echo '091117';
            echo implode('130791', $list_titles);
            echo '091117';
            echo implode('130791', $list_images);
            
            
            die();
            
            foreach($list_posts as $k=>$list_post)
            {                
                $exsits = models_DB::get('SELECT * FROM ' . POST_TABLE .  ' WHERE fetched_url_1=\'' . $list_post . '\' ');
                if(!empty($exsits)) 
                {
                    $old_links[] = $list_post;
                    
                    
                    
                    $categories = '';
                    if(!empty($_POST['categories']))
                    {
                        $old_categories = $exsits[0]['categories'];
                        if(empty($old_categories))
                        {
                            $new_cat = implode(',' , $_POST['categories']);
                        }
                        else
                        {
                            $new_cat = $old_categories . ',' . implode(',' , $_POST['categories']);
                            $new_cat = explode(',', $new_cat);
                            $new_cat = array_unique($new_cat);
                            $new_cat = implode(',' , $new_cat);                                                        
                        }
                        
                        $update = array('categories'=>$new_cat);
                        models_DB::update($update, POST_TABLE, ' WHERE id=' . $exsits[0]['id'] );                                                
                        
                    }
                    
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
                $insert_content['image'] = $_POST['image'];
                $insert_content['title'] = $_POST['title'];
                
                $insert_content['template'] = $_POST['template'];
                
                
                
                $insert_content['view_count'] = 0;
                $insert_content['comment_count'] = 0;
                
                $insert_content['secure_key'] = random_string(8);
                
                
                
                
                $insert_content['seo'] = '{"title":"","description":"","keywords":"","index":"index","follow":"follow","canonical":"","301":""}';
                
                
                
                $insert_content['content'] = '';
                $temp = $html->find($_POST['content']);
                if(!empty($temp)) $insert_content['content'] = $temp[0]->outertext();
                
                //if(!empty($list_images[$k])) $insert_content['image'] = $list_images[$k];
                
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
                        Mới : 
                        <a href="<?php echo $_POST['src'] ?>" target="_blank"><?php echo $_POST['src'] ?></a>
                        =&gt;&gt;
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