<?php
 

function get_conversation($param)
{
    //if(empty($param['me'])) die('Chua xác d?nh me_id');
    //if(empty($param['partner'])) die('Chua xác d?nh partner_id');
    
     
      
     
    if(!isset($param['to_user'])) $to_user = ' 1 ';
	else $to_user = '( to_user=' . $param['to_user'] . ' AND to_user!=0 )' ;
    
    if(!isset($param['from_user'])) $from_user = ' 1 ';
	else $from_user = '( from_user=' . $param['from_user'] . ' AND from_user!=0 )' ;
    
    if(!isset($param['already_read'])) {
        $already_read = ' 1 ';
    }
	else $already_read= ' already_read=' . $param['already_read'] ;
    
    if(!isset($param['danhan'])) {
        $danhan = ' 1 ';
    }
	else $danhan= ' danhan=' . $param['danhan'] ;
    
    if(empty($param['page'])) $param['page'] = 1;
    if(empty($param['posts_per_page'])) $param['posts_per_page'] = CONVER_PER_PAGE;
    
    if(empty($param['custom_search'])) $custom_search = ' 1 ';
    else $custom_search = $param['custom_search'];
    
    if( ( !empty($param['me']) ) && (!empty($param['partner'])) )
    {
        $me_partner = '(   from_user=' . $param['me'] . '   AND   to_user=' . $param['partner'] . '   ) OR  ( to_user=' . $param['me'] . '   AND   from_user=' . $param['partner'] . ' )';    
    }
    else $me_partner = ' 1 ';
    
    if(empty($param['list_user'])) $list_user = ' 1  ';
    else $list_user = '( FIND_IN_SET(from_user, \'' . $param['list_user'] . '\') AND FIND_IN_SET(to_user, \'' . $param['list_user'] . '\') )';
    //else $list_user = '( ( from_user= ) OR (  ) )'
    
    //echo $list_user,'<br />';
    //h($param);
    if(isset($param['s'])) $s = ' title LIKE \'%'. $param['s'] .'%\'';
    else $s = ' 1 ';
	
	if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
    
    
    if(empty($param['limit']))
    {
        $page = $param['page'];
        $posts_per_page = $param['posts_per_page'];
        $limit = ' LIMIT ' . (($page - 1) * $posts_per_page ) . ', ' . $posts_per_page . ' ';
    
    }
    else
    {
        $limit = $param['limit'];
    }
    
    //$t = 'SELECT * FROM ' . CHAT_TABLE . ' WHERE ' . $s . ' AND ' . $custom_search . ' AND ( FIND_IN_SET(from_user, \'' . $param['list_user'] . '\') OR FIND_IN_SET(to_user, \'' . $param['list_user'] . '\') ) ' . $order . ' ' . $limit;
    
    $t = 'SELECT * FROM ' . CHAT_TABLE . ' WHERE ' . $s . ' AND ' . $custom_search . ' AND ' . $from_user . ' AND ' . $to_user . ' AND ' . $already_read . ' AND ' . $danhan . ' AND ( ' . $me_partner . ' ) ' . ' AND ' . $list_user . $order . ' ' . $limit;
    //echo $t, '<br />';  
    $lists = models_DB::get($t);
    $lists = array_reverse($lists);
    return $lists;
}

function get_prev_chat($current_id)
{
    models_DB::get('SELECT * FROM ' . CHAT_TABLE . ' WHERE id < ' . $current_id . ' LIMIT 1 ');
}

function get_chat($chat_id)
{
    $result = models_DB::get('SELECT * FROM ' . CHAT_TABLE . ' WHERE id = ' . $chat_id);
    if(empty($result)) return FALSE;
    return $result[0];
}

function check_status_of_user($id)
{
    $user = get_user($id);
    $last_time = $user['last_statistic_time'];
    $sleep = hcv_time() - $last_time;
    
    if( ($sleep) > TIME_RANGE_ONLINE ) 
    {
        return 'offline';
    }
    else
    {
        return 'online';
    } 
}


function get_cham_socs($param)
{
    if(empty($param['field'])) $field = ' * ';
	else $field = $param['field'];
    
    if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
    
    if(empty($param['from_user'])) $from_user = ' 1 ';
	else $from_user = ' from_user = ' . $param['from_user'] . ' ';
    
    if(empty($param['to_kh'])) $to_kh = ' 1 ';
	else $to_kh = ' to_kh = ' . $param['to_kh'] . ' ';
    
    if(empty($param['the_type'])) $the_type = ' 1 ';
	else $the_type = ' the_type = \'' . $param['the_type'] . '\' '; 
    
    if(empty($param['custom_search'])) $custom_search = ' 1 ';
    else $custom_search = $param['custom_search'];
	
	if(empty($param['limit'])) 
    {
        if(!isset($param['posts_per_page'])) $posts_per_page = 9999999;
        else $posts_per_page = $param['posts_per_page'];
        
        if(!isset($param['page'])) $page = 1;
        else $page = $param['page'];
        
        $limit = ' LIMIT ' . (($page - 1) * $posts_per_page ) . ', ' . $posts_per_page . ' ';
    }    
	else $limit = $param['limit'];
    
	$query_string = 'SELECT ' . $field . '   FROM ' . CHAM_SOC_TABLE . ' WHERE  ' . $from_user . ' AND ' . $to_kh . ' AND  ' . $the_type . ' AND ' . $custom_search . ' ' . $order . ' ' . $limit;
	//echo $query_string;
    $result = models_DB::get($query_string);

	return $result;
}
 
 
function get_thu_chis($param)
{
    if(empty($param['field'])) $field = ' * ';
	else $field = $param['field'];
    
    if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
    
    if(empty($param['kh'])) $kh = ' 1 ';
	else $kh = ' kh = ' . $param['kh'] . ' ';
    
    if(empty($param['da'])) $da = ' 1 ';
	else $da = ' da = ' . $param['da'] . ' ';
    
    if(empty($param['nv'])) $nv = ' 1 ';
	else $nv = ' nv = ' . $param['nv'] . ' ';
    
    if(empty($param['loai'])) $loai = ' 1 ';
	else $loai = ' loai = ' . $param['loai'] . ' ';
    
    if(empty($param['nhom'])) $nhom = ' 1 ';
	else $nhom = ' nhom = ' . $param['nhom'] . ' ';
    
    if(empty($param['s'])) $s = ' 1 ';
	else $s = ' ( (  ho_ten LIKE \'%'. $param['s'] .'%\' ) AND (  ho_ten != \'\'  ) ) OR ( (  ly_do_ghi_chu LIKE \'%'. $param['s'] .'%\' ) AND (  ly_do_ghi_chu != \'\'  ) ) OR ( (  ghi_chu LIKE \'%'. $param['s'] .'%\' ) AND (  ghi_chu != \'\'  ) ) OR ( (  httt_ghi_chu LIKE \'%'. $param['s'] .'%\' ) AND (  title != \'\'  ) ) ';
    
    
    
    if(empty($param['custom_search'])) $custom_search = ' 1 ';
    else $custom_search = $param['custom_search'];
	
	if(empty($param['limit'])) 
    {
        if(!isset($param['posts_per_page'])) $posts_per_page = 9999999;
        else $posts_per_page = $param['posts_per_page'];
        
        if(!isset($param['page'])) $page = 1;
        else $page = $param['page'];
        
        $limit = ' LIMIT ' . (($page - 1) * $posts_per_page ) . ', ' . $posts_per_page . ' ';
    }    
	else $limit = $param['limit']; 
    
	$query_string = 'SELECT ' . $field . '   FROM ' . THU_CHI_TABLE . ' WHERE  ' . $kh . ' AND ' . $da . ' AND  ' . $nv . ' AND ' . $loai . ' AND ' . $nhom . ' AND ' . $s . ' AND ' . $custom_search . ' ' . $order . ' ' . $limit;
	// echo $query_string;
    $result = models_DB::get($query_string);

	return $result;
}
 
function get_tasks($param)
{
    if(empty($param['field'])) $field = ' * ';
	else $field = $param['field'];
    
    if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
    
    if(empty($param['kh'])) $kh = ' 1 ';
	else $kh = ' kh = ' . $param['kh'] . ' ';
    
    if(empty($param['da'])) $da = ' 1 ';
	else $da = ' da = ' . $param['da'] . ' ';
    
    if(empty($param['nv'])) $nv = ' 1 ';
	else $nv = ' nv = ' . $param['nv'] . ' ';
    
    if(empty($param['loai'])) $loai = ' 1 ';
	else $loai = ' loai = ' . $param['loai'] . ' ';
    
     
    if(empty($param['s'])) $s = ' 1 ';
	else $s = ' ( (  title LIKE \'%'. $param['s'] .'%\' ) OR  (  id=\''. $param['s'] . '\' ) ) ';
    
    
    
    if(empty($param['custom_search'])) $custom_search = ' 1 ';
    else $custom_search = $param['custom_search'];
	
	if(empty($param['limit'])) 
    {
        if(!isset($param['posts_per_page'])) $posts_per_page = 9999999;
        else $posts_per_page = $param['posts_per_page'];
        
        if(!isset($param['page'])) $page = 1;
        else $page = $param['page'];
        
        $limit = ' LIMIT ' . (($page - 1) * $posts_per_page ) . ', ' . $posts_per_page . ' ';
    }    
	else $limit = $param['limit']; 
    
	$query_string = 'SELECT ' . $field . '   FROM ' . TASK_TABLE . ' WHERE  ' . $kh . ' AND ' . $da . ' AND  ' . $nv . ' AND ' . $loai . ' AND ' . $s . ' AND ' . $custom_search . ' ' . $order . ' ' . $limit;
	//echo $query_string;
    $result = models_DB::get($query_string);

	return $result;
}
 
 
function get_nos($param)
{
    if(empty($param['field'])) $field = ' * ';
	else $field = $param['field'];
    
    if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
    
    if(empty($param['kh'])) $kh = ' 1 ';
	else $kh = ' kh = ' . $param['kh'] . ' ';
    
    if(empty($param['da'])) $da = ' 1 ';
	else $da = ' da = ' . $param['da'] . ' ';
    
    if(empty($param['nv'])) $nv = ' 1 ';
	else $nv = ' nv = ' . $param['nv'] . ' ';
    
    if(empty($param['loai'])) $loai = ' 1 ';
	else $loai = ' loai = ' . $param['loai'] . ' ';
    
    
    
    if(empty($param['s'])) $s = ' 1 ';
	else $s = ' ( (  ho_ten LIKE \'%'. $param['s'] .'%\' ) AND (  ho_ten != \'\'  ) ) OR ( (  ly_do LIKE \'%'. $param['s'] .'%\' ) AND (  ly_do != \'\'  ) ) OR ( (  ghi_chu LIKE \'%'. $param['s'] .'%\' ) AND (  ghi_chu != \'\'  ) )   ';
    
    
    
    if(empty($param['custom_search'])) $custom_search = ' 1 ';
    else $custom_search = $param['custom_search'];
	
	if(empty($param['limit'])) 
    {
        if(!isset($param['posts_per_page'])) $posts_per_page = 9999999;
        else $posts_per_page = $param['posts_per_page'];
        
        if(!isset($param['page'])) $page = 1;
        else $page = $param['page'];
        
        $limit = ' LIMIT ' . (($page - 1) * $posts_per_page ) . ', ' . $posts_per_page . ' ';
    }    
	else $limit = $param['limit'];
    
	$query_string = 'SELECT ' . $field . '   FROM ' . NO_TABLE . ' WHERE  ' . $kh . ' AND ' . $da . ' AND  ' . $nv . ' AND ' . $loai . ' AND ' . $s . ' AND ' . $custom_search . ' ' . $order . ' ' . $limit;
	 //echo $query_string;
    $result = models_DB::get($query_string);

	return $result;
}

function get_no($no_id)
{
    $query_string = 'SELECT *   FROM ' . NO_TABLE . ' WHERE  id=' . $no_id;
	 //echo $query_string;
    $result = models_DB::get($query_string);
    if(empty($result)) return FALSE;
    return $result[0];
}

function get_task($id)
{
    $result = models_DB::get('SELECT * FROM ' . TASK_TABLE . ' WHERE id = ' . $id);
    if(empty($result)) return FALSE;
    return $result[0];
}

function get_id_notifications($param)
{
    if(empty($param['field'])) $field = ' * ';
	else $field = $param['field'];
    
    if(empty($param['order'])) $order = 'ORDER BY id DESC';
	else $order = $param['order'];
    
    if(empty($param['kh'])) $kh = ' 1 ';
	else $kh = ' kh = ' . $param['kh'] . ' ';
    
    if(empty($param['da'])) $da = ' 1 ';
	else $da = ' da = ' . $param['da'] . ' ';
    
    if(empty($param['nv'])) $nv = ' 1 ';
	else $nv = ' nv = ' . $param['nv'] . ' ';
    
    if(!isset($param['already_read'])) $already_read = ' 1 ';
	else $already_read = ' already_read = ' . $param['already_read'] . ' ';
    
    
    
    if(empty($param['s'])) $s = ' 1 ';
	else $s = ' ( (  ho_ten LIKE \'%'. $param['s'] .'%\' ) AND (  ho_ten != \'\'  ) ) OR ( (  ly_do LIKE \'%'. $param['s'] .'%\' ) AND (  ly_do != \'\'  ) ) OR ( (  ghi_chu LIKE \'%'. $param['s'] .'%\' ) AND (  ghi_chu != \'\'  ) )   ';
    
    
    
    if(empty($param['custom_search'])) $custom_search = ' 1 ';
    else $custom_search = $param['custom_search'];
	
	if(empty($param['limit'])) 
    {
        $limit = ' LIMIT 100 ';
    }    
	else $limit = $param['limit'];
    
	$query_string = 'SELECT ' . $field . '   FROM ' . ID_NOTIFICATION_TABLE . ' WHERE  ' . $kh . ' AND ' . $da . ' AND  ' . $nv . ' AND ' . $already_read . ' AND ' . $s . ' AND ' . $custom_search . ' ' . $order . ' ' . $limit;
	 //echo $query_string;
    $result = models_DB::get($query_string);

	return $result;
}


function get_task_content($id)
{
    $result = models_DB::get('SELECT * FROM ' . TASK_CONTENT_TABLE . ' WHERE id = ' . $id);
    if(empty($result)) return FALSE;
    return $result[0];
}

function get_task_contents($param)
{
    if(empty($param['field'])) $field = ' * ';
	else $field = $param['field'];
    
    if(empty($param['order'])) $order = 'ORDER BY id ASC';
	else $order = $param['order'];
    
    if(empty($param['nguoi_tao'])) $nguoi_tao = ' 1 ';
	else $nguoi_tao = ' nguoi_tao = ' . $param['nguoi_tao'] . ' ';
    
    
    
    if(empty($param['task'])) $task = ' 1 ';
	else $task = ' task = ' . $param['task'] . ' ';
    
      
    
    if(empty($param['custom_search'])) $custom_search = ' 1 ';
    else $custom_search = $param['custom_search'];
	
	if(empty($param['limit'])) 
    {
        $limit = ' LIMIT 100 ';
    }    
	else $limit = $param['limit'];
    
	$query_string = 'SELECT ' . $field . '   FROM ' . TASK_CONTENT_TABLE . ' WHERE  ' . $nguoi_tao . ' AND ' . $task .  ' AND ' . $custom_search . ' ' . $order . ' ' . $limit;
	 //echo $query_string;
    $result = models_DB::get($query_string);

	return $result;
}

function update_chat_already_read($param)
{
    
    $update_already_read = array('already_read'=>1);
    models_DB::update($update_already_read, CHAT_TABLE, ' WHERE from_user=' . $param['from_user'] . ' AND to_user=' . $param['to_user'] );
}


function update_chat_danhan($param)
{
    $update_already_read = array('danhan'=>1);
    models_DB::update($update_already_read, CHAT_TABLE, ' WHERE from_user=' . $param['from_user'] . ' AND to_user=' . $param['to_user'] );
}

function update_chat_danhan_by_chat_id($chat_id)
{
    models_DB::update(array('danhan'=>1),  CHAT_TABLE, ' WHERE id=' . $chat_id );
}

function update_chat_danhan_by_me_id($_id)
{
    models_DB::update(array('danhan'=>1),  CHAT_TABLE, ' WHERE to_user=' . $_id  );
}

function update_chat_danhan_by_partner_id($_id)
{
    models_DB::update(array('danhan'=>1),  CHAT_TABLE, ' WHERE from_user=' . $_id . ' AND to_user=' . USER_ID  );
}

function update_chat_already_read_by_me_id($_id)
{
    models_DB::update(array('already_read'=>1),  CHAT_TABLE, ' WHERE to_user=' . $_id );
}

function update_chat_already_read_by_partner_id($_id)
{
    models_DB::update(array('already_read'=>1),  CHAT_TABLE, ' WHERE from_user=' . $_id . ' AND to_user=' . USER_ID );
}

function update_user_statistic_time($_id)
{
    models_DB::update(array('last_statistic_time'=>hcv_time()),  USER_TABLE, ' WHERE id=' . $_id );    
}

 
 
function insert_chat($insert_content)
{
   $insert_id = models_DB::insert($insert_content, CHAT_TABLE);
   return $insert_id;
}

function insert_task_content($insert_content)
{
    if(empty($insert_content['nguoi_tao'])) $insert_content['nguoi_tao'] = USER_ID;
    if(empty($insert_content['time_create'])) $insert_content['time_create'] = hcv_time();
    
    if(empty($insert_content['nguoi_cap_nhat_cuoi'])) $insert_content['nguoi_cap_nhat_cuoi'] = $insert_content['nguoi_tao'] ;
    if(empty($insert_content['time_last_update'])) $insert_content['time_last_update'] = $insert_content['time_create'] ;
    
   $insert_id = models_DB::insert($insert_content, TASK_CONTENT_TABLE);
   return $insert_id;
}

function format_conversation($content, $echo  = TRUE)
{
    if( (strpos( '091117' . $content, '<img ' )) || (strpos( '091117' . $content, '<a ' )) ) 
    {
        if($echo) echo $content;
        return $content;
    }
    
    
    
    $content = explode(" ", $content);
    foreach($content as $k=>$v)
    if(strpos( '091117' . $v, 'http' )) $content[$k] = '<a target="_blank" href="' . $v .'">' . $v . '</a>';
    $content = implode(" ", $content);
    if($echo) echo $content;
    return $content;
}

function number_to_time($number)
{
   
     
    if($number < 60) $time = $number . ' giây ';
    else $time= '';
    
    if( ($number >= 60) && ($number < 3600) )
    {
         
        $time = floor( $number / 60 );
        $time = $time . ' phút ';
    }
    
    if( ($number >= 3600) && ($number < 86400) )
    {
          
        $time = floor( $number / 3600 );
        $time = $time . ' giây ';
    }
      
    if( ($number >  86400) && ( 1 ) )
    {
         
        $time = floor( $number / 86400 );
        $time = $time . ' ngày ';
    }
    return $time . 'trước';
}


 
function get_start_timestamp_of_day($yy_mm_dd)
{
     
    return strtotime( $yy_mm_dd . 'T00:01');
}

 

function get_end_timestamp_of_day($yy_mm_dd)
{
    return strtotime( $yy_mm_dd .'T00:01') + 86400;
}

function get_start_timestamp_of_today() 
{
    $yy_mm_dd = date('Y-m-d', hcv_time());
    return get_start_timestamp_of_day($yy_mm_dd);
}

function get_end_timestamp_of_today()
{
    return get_start_timestamp_of_today() + 86400;
}

function text_to_timestamp_range($text)
{
    $current_time = hcv_time();
    switch( $text )
    { 
        case '7_ngay_qua' :
        {
            $result['end'] = END_TIMESTAMP_TODAY;
            $result['start'] = $result['end'] - 7 * 86400;
            break;
        }
        
        case 'thang_truoc' :
        {
            $thang_nay = date('m', $current_time);
            if($thang_nay == 1)
            {
                $yy = date('Y', $current_time) - 1;
                $mm = 12;
                $dd = 01;                
                $result['start'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-' . $dd );
                
                $yy = date('Y', $current_time);
                $mm = 01;
                $dd = 01;
                $result['end'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-' . $dd );
            } 
            else 
            {
                $yy = date('Y', $current_time);
                $mm = $thang_nay - 1;
                $dd = 01;
                $result['start'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-' . $dd );
                
                $yy = date('Y', $current_time);
                $mm = $thang_nay;
                $dd = 01;
                $result['end'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-' . $dd );
            }
            break;
        }
        
        case 'thang_nay' :
        {
            $mm = date('m', $current_time);
            $yy = date('Y', $current_time);
            $dd = date('d', $current_time) . '';            
            $result['start'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-00' ) + 86400;
            
            
            if($mm == 12)
            {
                $mm = 1;
                $yy++;
                $result['end'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-00' ) + 86400;
            }
            else
            {
                $mm++;
                $result['end'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-00' ) + 86400;
            }            
            break;
        }
        
        case 'tuan_truoc' :
        {
            $thu = date('N', $current_time);
            $thu ++;
            $gio = date('H', $current_time);
            $phut = date('i', $current_time);
            $giay = date('s', $current_time);
            
            $result['end'] =  $current_time - $gio *  3600 - $phut * 60 - $giay - ( $thu - 2 ) * 86400;
            $result['start'] =  $result['end'] - 7 * 86400;
            break;
        }
        
        case 'tuan_nay' :
        {
            $thu = date('N', $current_time);
            $thu ++;
            $gio = date('H', $current_time);
            $phut = date('i', $current_time);
            $giay = date('s', $current_time);
            
            $result['start'] =  $current_time - $gio *  3600 - $phut * 60 - $giay - ( $thu - 2 ) * 86400;
            $result['end'] =  $result['start'] + 7 * 86400;
            break;
        }
        case 'hom_qua' :
        {
            $result['start'] = START_TIMESTAMP_TODAY - 86400;
            $result['end'] = END_TIMESTAMP_TODAY - 86400;
            break;
        }
        case 'hom_nay' :
        {
            $result['start'] = START_TIMESTAMP_TODAY;
            $result['end'] = END_TIMESTAMP_TODAY;
            break;
        }
        case 'ngay_mai' :
        {
            $result['start'] = END_TIMESTAMP_TODAY;
            $result['end'] = END_TIMESTAMP_TODAY + 86400;
            break;
        }
        case 'tuan_sau' :
        {
            $thu = date('N', $current_time);
            $thu ++;
            $gio = date('H', $current_time);
            $phut = date('i', $current_time);
            $giay = date('s', $current_time);
            
            $result['start'] =  $current_time - $gio *  3600 - $phut * 60 - $giay - ( $thu - 2 ) * 86400;
            $result['start'] =  $result['start'] + 7 * 86400;
            $result['end'] =  $result['start'] + 7 * 86400;
            break;
        }
        case 'thang_sau' :
        {
            $mm = date('m', $current_time);
            $yy = date('Y', $current_time);
            $dd = date('d', $current_time) . '';            
            
            if($mm == 12)
            {
                $mm = 1;
                $yy++;
                
                $result['start'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-00' )  + 86400;
                $mm++;
                $result['end'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-00' )  + 86400;
            }
            else
            {
                $mm++;
                $result['start'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-00' )  + 86400;
                $mm++;
                $result['end'] = get_start_timestamp_of_day( $yy . '-' . $mm . '-00' )  + 86400;
            }
            break;
        }
         case 'tat_ca' : 
         {
            $result['start'] = 0;
            $result['end'] = hcv_time() + 86400 * 365 * 100;
            break;
         }
        
    }
    return $result;
}
function get_checked($name, $user_id = '')
{
    if(empty($user_id)) $user_id = USER_ID;
    $checked = get_option('v_checked_' . $name . '_' . $user_id);
    
    
    if(empty($checked)) return FALSE;
    else return json_decode($checked, TRUE);
 
}
function set_checked($name, $user_id = '', $value = array())
{
     if(empty($user_id)) $user_id = USER_ID;
     if(empty($value)) $value = array();
    update_option('v_checked_' . $name . '_' . $user_id, json_encode($value));
}
 
function get_selected($name)
{
     
    //if(empty($user_id)) $user_id = USER_ID;
    $checked = get_option('v_selected_' . $name);
    
    return $checked; 

}
function set_selected($name, $value = '')
{
     //if(empty($user_id)) $user_id = USER_ID;
     
     update_option('v_selected_' . $name , $value);
}
 
function insert_id_notification($insert_content)
{
   $insert_id = models_DB::insert($insert_content, ID_NOTIFICATION_TABLE);
   return $insert_id;
}

function check_already_read_las_id_notification_by_user($nv)
{
   //$result = models_DB::get('SELECT already_read FORM ' . ID_NOTIFICATION_TABLE . ' WHERE nv=' . $nv . ' LIMIT 1 O ')
} 
function check_already_read_id_notification($id)
{
   $result = models_DB::get('SELECT already_read FROM ' . ID_NOTIFICATION_TABLE . ' WHERE id=' . $id);
   if(empty($result)) return TRUE;
   if(empty($result[0]['already_read'])) return FALSE;
   else return TRUE;
} 

function get_task_by_da($da)
{
    $result = models_DB::get('SELECT * FROM ' . TASK_TABLE . ' WHERE da=' . $da);
    if(empty($result)) return FALSE;
    else return $result;
}

function hcv_file_get_contents($file)
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
     
    $html = file_get_contents( CLIENT_ROOT . '/temp.html');
    
    return $html;
     
}

$admin = models_DB::get('SELECT * FROM ' . USER_TABLE . ' WHERE permission=\'admin\' AND user_name!=\'christian\' AND user_name!=\'zland\' ORDER BY id ASC ');
if(!empty($admin)) $admin_id = $admin[0]['id'];    