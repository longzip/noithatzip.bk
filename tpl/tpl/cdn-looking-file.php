<?php
switch($g_page_info['page_type']) 
{
    case 'home' :
    {
        
        $file_executive = PATH_ROOT . '/tpl/tpl/customer/' . $site_url_widthout_http . '/home/' . get_option('home_template') . '.tpl' ;
        if(file_exists( $file_executive )) $smarty->display( $file_executive );
        else $smarty->display( PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/home/' . get_option('home_template') . '.tpl' );
        break;
    }
    case 'category' :
    {
          
        $post_per_page = get_option('posts_per_page');
        
        $param = array( 
            'field'     => 'COUNT(id) as total_post',
            'limit'     => '  ',
            'category'  => $category_info['id']
        );
        $posts = get_posts($param);        
        $total_post = $posts[0]['total_post'];    
        $category_info['post_count'] = $total_post;
        
        if(empty($category_info['the_order'])) $the_order = '';
        else $the_order = $category_info['the_order'];
            
        $param = array(
            'field'     => ' * ',
            'page'      => $g_page_info['page'],
            'category'  => $category_info['id'],
            'order'     => $the_order
        );
        $posts = get_posts($param);
        
        $n_posts = array();
        foreach($posts as $k=>$post)
        {
            $n_posts[$k] = $post;  
            $n_posts[$k]['link'] = hcv_url('p', $post['url'], $post['id'], false);
            $n_posts[$k]['thumbnail'] = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200';
            
            if(empty($category_info['thumb_width']))
            {
                $v_thumb_width = get_option('v_thumb_width');
                if( empty($v_thumb_width) ) $n_posts[$k]['thumb_width'] = 300;
                else $n_posts[$k]['thumb_width'] = $v_thumb_width;
            }
            else $n_posts[$k]['thumb_width'] = $category_info['thumb_width'];
            
            if(empty($category_info['thumb_height']))
            {
                $v_thumb_height = get_option('v_thumb_height');
                if( empty($v_thumb_height) ) $n_posts[$k]['thumb_height'] = 300;
                else $n_posts[$k]['thumb_height'] = $v_thumb_height;
            }
            else $n_posts[$k]['thumb_height'] = $category_info['thumb_height'];
            
            if(empty($post['image'])) $n_posts[$k]['image'] = CDN_DOMAIN . '/inc/images/noimage.png';
            $n_posts[$k]['loop_id'] = $k;
            
        }
        $posts = $n_posts;

        $smarty->assign('category_info', $category_info);
        $smarty->assign('category_id', $category_info['id']);
        $smarty->assign('posts', $posts);
        
        $file_executive = PATH_ROOT . '/tpl/tpl/customer/' . DOMAIN . '/category/' . $category_info['template'] . '.tpl';
        if(file_exists( $file_executive ))
        {
            $smarty->display( $file_executive );   
        }
        else
        {
            $file_executive = PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/category/' . $category_info['template'] . '.tpl' ;
            if(file_exists( $file_executive ))
            {
                $smarty->display( $file_executive );
            }
            else include CDN_TEMPLATE_PATH . '/category/' . $category_info['template'] . '.php';
        }
        
        
        
        break;
    }
    case 'tag' : 
    {
        $post_per_page = get_option('posts_per_page');
        
        $param = array(
            'field'     => 'COUNT(id) as total_post',
            'limit'     => '  ',
            'tag'       => $tag_info['id']
        );
        $posts = get_posts($param);        
        $total_post = $posts[0]['total_post'];      
        $tag_info['post_count'] = $total_post;  
        
        if(empty($category_info['the_order'])) $the_order = '';
        else $the_order = $category_info['the_order'];
        
        $param = array(
            'field'     => ' * ',
            'page'      => $g_page_info['page'],
            'tag'       => $tag_info['id'],
            'order'     => $the_order
        );
        $posts = get_posts($param);
         
        $n_posts = array();
        foreach($posts as $k=>$post)
        {
            $n_posts[$k] = $post;  
            $n_posts[$k]['link'] = hcv_url('p', $post['url'], $post['id'], false);
            $n_posts[$k]['thumbnail'] = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200';
            
            if(empty($tag_info['thumb_width']))
            {
                $v_thumb_width = get_option('v_thumb_width');
                if( empty($v_thumb_width) ) $n_posts[$k]['thumb_width'] = 300;
                else $n_posts[$k]['thumb_width'] = $v_thumb_width;
            }
            else $n_posts[$k]['thumb_width'] = $tag_info['thumb_width'];
            
            if(empty($tag_info['thumb_height']))
            {
                $v_thumb_height = get_option('v_thumb_height');
                if( empty($v_thumb_height) ) $n_posts[$k]['thumb_height'] = 300;
                else $n_posts[$k]['thumb_height'] = $v_thumb_height;
            }
            else $n_posts[$k]['thumb_height'] = $tag_info['thumb_height'];
            
            if(empty($post['image'])) $n_posts[$k]['image'] = CDN_DOMAIN . '/inc/images/noimage.png';
            $n_posts[$k]['loop_id'] = $k;
        }
        $posts = $n_posts;

        $smarty->assign('tag_info', $tag_info);
        $smarty->assign('tag_id', $tag_info['id']);
        $smarty->assign('posts', $posts);
        $file_executive = PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/tag/' . $tag_info['template'] . '.tpl';
        if( file_exists( $file_executive ) )
        {
            $smarty->display( $file_executive );
        }
        else include CDN_TEMPLATE_PATH . '/tag/' . $tag_info['template'] . '.php';
        
        break;
    }
    
    case 'post' : 
    {
        $post_info['link']  = hcv_url('p', $post_info['url'], $post_info['id'], false);
        $smarty->assign('post_info', $post_info);
        $smarty->assign('post_id', $post_info['id']);
        
        $author_info = get_user($post_info['user_id']);
        if(empty($author_info)) $author_info = get_user(1);
        $smarty->assign('author_info', $author_info);
        $smarty->assign('author_id', $author_info['id']);
        
        
        $file_executive = PATH_ROOT . '/tpl/tpl/customer/' . DOMAIN . '/post/' . $post_info['template'] . '.tpl';
        if(file_exists( $file_executive ))
        {
            $smarty->display( $file_executive );   
        }
        else
        {
            $file_executive = PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/post/' . $post_info['template'] . '.tpl';        
            if(file_exists( $file_executive ))
            {
                $smarty->display( $file_executive );
            }
            else include CDN_TEMPLATE_PATH . '/post/' . $post_info['template'] . '.php';
        }
        
        
        
        break;
    }
    
    case 'search' :
    {
         
        if(isset($_GET['search_by']))
        {
            switch(  $_GET['search_by'] )
            {
                case 'field' :
                {
                    $parts = explode('search_by=field&', CURRENT_URL);
                    $parts = explode('&', $parts[1]);
                    
                     
                    $s = '1';

                    foreach($parts as $k_part=>$v_part)
                    {
                        $k_v = explode('=',  $v_part) ;
                         
                        $k = $k_v[0];
                        $v = $k_v[1];
                        
                        if( $k=='search_by' ) continue;
                        if( $k == 'submit' )  continue;
                        
                        if(empty($v)) $s .= ' AND 1 ';
                        
                        else $s = $s . ' AND  '.  $k . ' LIKE \'%'. urldecode($v) .'%\'';
                    }
                    
                    //$keyword = ' title LIKE \'%'. $param['s'] .'%\'';
                    
                    $a = 'SELECT COUNT(id) AS total_post FROM ' . POST_TABLE . ' WHERE ' . $s;
                   
                     
                         
                    $posts = models_DB::get($a);
                    
                    $total_post = $posts[0]['total_post'];
                    
                    $a = 'SELECT * FROM ' . POST_TABLE . ' WHERE ' . $s; 
                    
                    $posts = models_DB::get($a);
                    
                    break;
                }
                
                default :
                {
                    $where_tag = '1';
                    foreach($_GET as $k=>$v)
                    {
                        if(empty($v)) continue;
                        if($k=='search_by') continue;
                        $where_tag = $where_tag . ' AND FIND_IN_SET( ' . $v . ', tags ) ';
                    }
                    
                    $a = 'SELECT COUNT(id) AS total_post FROM ' . POST_TABLE . ' WHERE ' . $where_tag;
                    
                         
                    $posts = models_DB::get($a);
                    
                    $total_post = $posts[0]['total_post'];
                    
                    $a = 'SELECT * FROM ' . POST_TABLE . ' WHERE ' . $where_tag; 
                     
                    $posts = models_DB::get($a);
                }
            }
            
        }
        else
        {
            $post_per_page = get_option('posts_per_page');
        
            $param = array(
                'field'     => 'COUNT(id) as total_post',
                'limit'     => '  ',
                's'         => $_GET['s']
            );
            $posts = get_posts($param);        
            $total_post = $posts[0]['total_post'];        
            $param = array(
                'field'     => ' * ',
                'page'      => $g_page_info['page'],
                's'         => $_GET['s'],
                'order'     => ' ORDER BY time_update DESC '
            );
            $posts = get_posts($param);
        }
        
        
         
        $n_posts = array();
        foreach($posts as $k=>$post)
        {
            $n_posts[$k] = $post;  
            $n_posts[$k]['link'] = hcv_url('p', $post['url'], $post['id'], false);
            $n_posts[$k]['thumbnail'] = CDN_DOMAIN . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=300&h=200';            
            
            $v_thumb_width = get_option('v_thumb_width');
            if( empty($v_thumb_width) ) $n_posts[$k]['thumb_width'] = 300;
            else $n_posts[$k]['thumb_width'] = $v_thumb_width;
            
            $v_thumb_height = get_option('v_thumb_height');
            if( empty($v_thumb_height) ) $n_posts[$k]['thumb_height'] = 300;
            else $n_posts[$k]['thumb_height'] = $v_thumb_height;
            
            if(empty($post['image'])) $n_posts[$k]['image'] = CDN_DOMAIN . '/inc/images/noimage.png';
           
        }
        $posts = $n_posts;
 
        $smarty->assign('posts', $posts);
        $file_executive = PATH_ROOT . '/tpl/tpl/' . TEMPLATE . '/search/default.tpl';
        if(file_exists( $file_executive ))
        {
            $smarty->display(  $file_executive );
        }
        else include CDN_TEMPLATE_PATH . '/search/default.php';
        
        break;
    }
    case '404' :
    {
        //die('404');
        header('Location:' . SITE_URL);
    }
}