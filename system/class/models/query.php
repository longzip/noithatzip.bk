<?php
class models_query extends models_DB
{
    public static function query_posts($query_string)
    {
        /**
         * Query example:
         * array(
         *      'suffix'              => '2',
         *      'suffix_or'           => '2,4,5',
         *      'term_id'             => '5',
         *      'term_id_or'          => '2,3,4',      
         *      'term_id_and'         => '2,3,4',
         *      'user_id'             => 'abc',
         *      'user_id_or'          => '"abc","adf"',
         *      'status'              => 'published',
         *      'status_or'           => 'published,pendding',
         *      'suffix_not_in'       => '2,3,4',
         *      'term_id_not_in'      => '2,3',
         *      'page'                => '2',
         *      'max_post'            => '23',
         *      'orderby'             => 'post_title',
         *      'order'               => 'desc'
         *      'post_type_id'        => ''     
         * );
         */
        if(!isset($query_string['page'])) $query_string['page'] = 1;
        
        if(!isset($query_string['max_post'])) $query_string['max_post'] = 10;
        $limit = 'LIMIT ';
        
        $limit_start = $query_string['max_post'] * ( $query_string['page'] -1);
        //$limit_end   = $query_string['max_post'] * $query_string['page'];
        $limit .= $limit_start . ', ' . $query_string['max_post'];
        
    
        
        
        $where = array();
        
        if(!isset($query_string['nhu-cau'])) $nhu_cau = '';
        else
        {
            $where[] = $nhu_cau = ' nhu_cau = \'' . $query_string['nhu-cau'] . '\'';
        }
        
        if(!isset($query_string['user_id'])) $user_id = '';
        else
        {
            $where[] = $user_id = ' user_id = ' . $query_string['user_id'];
        }
         
        if(!isset($query_string['suffix'])) $suffix = '1';
        else
        {
            $where[] = $suffix = ' suffix = \'' . $query_string['suffix'] . '\'';
        }
        
        if(!isset($query_string['suffix_or'])) $suffix_or = '1';        
        else  $where[] = $suffix_or = 'suffix IN (\'' . $query_string['suffix_or'] . '\')'; 
        
        //h($query_string);
        if(!isset($query_string['term_id'])) $suffix_or = '1';  
        else
        {
            $where[] = $term_id = ' term_id = ' . $query_string['term_id'];
        }
        
        if(!isset($query_string['term_id_or'])) $suffix_or = '1';        
        else if(empty($query_string['term_id_or'])) return array(); else  $where[] = $suffix_or = 'term_id IN (' . $query_string['term_id_or'] . ')'; 
        
        if(!isset($query_string['post_type_id'])) $post_type_id = '1';
        else
        {
            $where[] = $post_type_id = ' post_type_id = ' . $query_string['post_type_id'];
        }
        
        //--------------------------------------------Chua xay dung xong----------------------------------------------------------------
        if(!isset($query_string['term_id_and'])) $post_cat_and = '1';     
        else
        {
            foreach(explode(',', $query_string['post_cat_and']) as $k => $v)
            {
                if($k == 0)  $where[] =  $post_cat_and = 'FIND_IN_SET(\'' . $v . '\', post_cat)';
                else  $where[] =  $post_cat_and .= ' AND FIND_IN_SET(\'' . $v . '\', post_cat)';
            }
        }
        
        
        if(!isset($query_string['post_status'])) $post_status = '1';        
        else   $where[] = $post_status = ' post_status = ' . $query_string['post_status'];
        
        if(!isset($query_string['post_status_or'])) $post_status_or = '1';  
        else  $where[] = $post_status_or .= 'post_status IN (' . $query_string['post_status'] . ')';
        
        if(!isset($query_string['post_id_not_in'])) $post_id_not_in = '1';
        else  $where[] =  $post_id_not_in = 'post_id NOT IN (' . $query_string['post_id_not_in'] . ')';
        
        if(!isset($query_string['post_cat_not_in'])) $post_cat_not_in = '1';
        else
        {
            foreach(explode(',', $query_string['post_cat_not_in']) as $k => $v)
            {
                if($k == 0) $where[] =  $post_cat_not_in = '!FIND_IN_SET(\'' . $v . '\', post_cat)';
                else $where[] =  $post_cat_not_in .= ' AND !FIND_IN_SET(\'' . $v . '\', post_cat)';
            }
        }
        //-----------------------------------------------------------------------------------------------------------------------------
        
        
        
        
        
        if(!isset($query_string['order'])) $order = 'DESC';
        else  $order = $query_string['order'];       
        
        
        if(!isset($query_string['orderby'])) $orderby = 'id';
        else  $orderby = $query_string['orderby'];
        
        //$temporary = 'SELECT * FROM all_post WHERE ' . ' (' . $post_id . ') ' . 'AND' . ' (' . $post_id_or . ') ' . 'AND' . ' (' . $post_url . ') ' . 'AND' . ' (' . $post_url_or . ') ' . 'AND' . ' (' . $post_cat . ') ' . 'AND' . ' (' . $post_cat_or . ') ' . 'AND' . ' (' . $post_cat_and . ') ' . 'AND' . ' (' . $post_status . ') ' . 'AND' . ' (' . $post_status_or . ') ' . 'ORDER BY ' . $orderby . ' ' .$order . ' ' .$limit;       
        if(empty($where)) $where[] = '1';
        
        
        $t = 'SELECT DISTINCT  url_suffix FROM all_post WHERE ' . implode(' AND ', $where) . ' ORDER BY ' . $orderby . ' ' . $order . ' ' . $limit ; 
        
        //$t = 'SELECT DISTINCT  url_suffix FROM all_post WHERE ' . implode(' AND ', $where) . ' ORDER BY id DESC ' . $limit ; 
        
        //$t= 'SELECT DISTINCT url_suffix FROM all_post WHERE post_type_id = 39';
        //echo $t;
        
        $exe = models_DB::get($t);
        //h($exe);
        if(!empty($exe))
        {
            $exe = array_column($exe, 'url_suffix');
            foreach($exe as $v_exe)
            {
                $vngit1[] = explode('.', $v_exe);   
            }
            //h($vngit1);
            foreach($vngit1 as $k=>$v_vngit1)
            {
                $key = $v_vngit1[0] . '.' . $v_vngit1[1];
                if(!isset($vngit2[$key])) $vngit2[$key] = $v_vngit1[2];
                else $vngit2[$key] .= ',' . $v_vngit1[2];
            }
            //h($vngit2);
            foreach($vngit2 as $k=>$v)
            {
                $post_type = explode('.', $k);
                $post_type_id = $post_type[0];
                $post_type_table = $post_type[1];
                $temporary_result[$k] = self::query_posts_by_post_type(array('post_type_id'=>$post_type_id, 'post_type_table'=>$post_type_table, 'id_or'=> $v, 'orderby'=>$orderby, 'order'=>$order));
            }
            //h($temporary_result);
            $result = array();
            
            foreach($temporary_result as $v)
            {
                $result = array_merge($result, $v);
            }
            //h($result);
            return $result;
            
        }
        return array();
    }
    
    public static function query_posts_by_post_type($post_type_id)
    {
        $result = self::get('SELECT * FROM ' . POST_TYPE_TABLE . '_' . $post_type_id);
        if(empty($result)) return array();
        else return $result;
    }
    
    public static function query_post_by_suffix($suffix)
    {
        $suffix = explode(URL_SUFFIX_SEPARATE, $suffix);
        $post_type_id = $suffix[0];
        $post_id = $suffix[1];
        $result = self::query_post_by_id($post_type_id, $post_id);
        
        if(empty($result)) return array();
        else return $result[0];
    }
    
    public static function query_post_by_id($post_type_id, $post_id)
    {
        
        $result = self::get('SELECT * FROM ' . POST_TYPE_TABLE . '_' . $post_type_id . ' WHERE id=' . $post_id);
        if(empty($result)) return array();
        else return $result[0];
    }
    
    public function query_terms($query_string)
    {
        /**
         * Query example:
         * array(
         *      'term_id'              => '2',
         *      'term_id_or'           => '2,4,5',
         *      'term_url'             => 'abc',
         *      'term_url_or'          => '"abc","xyz"',
         *      'orderby'             => 'post_title',
         *      'order'               => 'desc'         
         * );
         */
         
         
         
         if(!isset($query_string['id'])) $term_id = '1';
         else $where[] = $term_id = ' id = '. $query_string['id'];
         
         if(!isset($query_string['term_id_or'])) $term_id_or = '1';
         else
         {
             $where[] = $term_id_or = ' term_id IN (\''. $query_string['term_id_or'] .'\')';
         }
         
         if(!isset($query_string['term_url'])) $term_url = '1';
         else  $where[] = $term_url = 'term_url = \''. $query_string['term_url'] . '\'';
         
         if(!isset($query_string['term_url_or'])) $term_url_or = '1';
         else
         {
             $where[] = $term_url_or = ' term_url_or IN ('. $query_string['term_url_or'] .')';
         }
         
         foreach($query_string as $k_query_string=>$v_query_string)
         {
            if(!in_array($k_query_string, array('term_id', 'term_id_or', 'term_url', 'term_url_or')))
            {
                 if(!isset($query_string[$k_query_string])) $k_query_string = '1';
                 else
                 {
                     $where[] = ' ' . $k_query_string . ' = \'' . $v_query_string . '\'';
                 }
            }
         }
         
         if(!isset($query_string['order'])) $order = 'desc';
         else  $order = $query_string['order'];       
        
         
         if(!isset($query_string['orderby'])) $orderby = 'term_id';
         else  $orderby = $query_string['orderby'];
         
         if(empty($where)) $where[] = '1';
         $t = 'SELECT * FROM ' . TERM_TABLE .' WHERE ' .  implode(' AND ',  $where);
         //echo $t;
         $temporary = 'SELECT * FROM ' . TERM_TABLE . ' WHERE ' . ' (' . $term_id . ') ' . 'AND' . ' (' . $term_id_or . ') ' . 'AND' . ' (' . $term_url . ') ' . 'AND' . ' (' . $term_url_or . ') '  . 'ORDER BY ' . $orderby . ' ' .$order;      
        
        
               
         $exe = self::get($t);
         self::$last_result_status = self::$class_sqli->error;
         if(empty($exe)) return array();
         return $exe;
    }
    
    public static function query_term_by_id($term_id)
    {
        $result = self::get('SELECT * FROM ' . TERM_TABLE . ' WHERE id='.$term_id);
        if(empty($result)) return array();
        else return $result[0];
    }
    
    public static function row_exists($column_name, $column_value, $table_name)
    {
        $result = self::get('SELECT COUNT(*) AS counter FROM ' . $table_name . ' WHERE ' . $column_name . '=\'' . $column_value . '\'');
        //h($result);
        if($result[0]['counter']) return true;
        return false;
    }
    
    public static function check_user($user_name, $password)
    {
        $result = self::get('SELECT * FROM ' . USER_TABLE . ' WHERE user_name=\'' . $user_name .'\' AND password=\'' . $password . '\'');
        if(empty($result)) return FALSE;
        //print_r($result);
        else return $result[0];
    }
}