<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
	$g_page_content['title'] = 'Lịch sử hoạt động'; 
	include 'header.php';
?>

<div id="" class="container">

    <?php //include 'sidebar.php'; ?>
        
    <div id="main-content" class="fl col-10-6">
    
    <div class="box">
        <div id="bread-crumbs">
		  <a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
    		<span class="arrow">›</span>
    		  
    		
    		<span class="current-page">Lịch sử hoạt động</span>
    
    	</div>
    </div>
    
    <div class="box">
    
	
	
    <h1>Lịch sử hoạt động</h1>
    
        
        
	   
	   
       
	   
	    <?php
			
			$posts_per_page = 2;
			
		      
			
			if(isset($_GET['the_type'])) $status = ' the_type = \''. $_GET['the_type'] .'\'';
            else $the_type = ' 1 ';
            
            if(isset($_GET['user_id'])) $status = ' user_id = '. $_GET['user_id'];
            else $user_id = ' 1 ';
            
            if(isset($_GET['user_id'])) $current_page = $_GET['user_id'];
            else $current_page = 1;
			 
			if(!isset($_GET['orderby']))
			{
				$orderby = ' ORDER BY id  ';
				$order = ' DESC ';
			}
			else
			{
				$orderby = ' ORDER BY ' . $_GET['orderby'];
				if(isset($_GET['order'])) $order = $_GET['orderby'];
				else $order = ' ASC ';
			}
			
            $t = 'SELECT * FROM ' . STATISTIC_TABLE . ' WHERE ' . $the_type . ' AND ' . $user_id . '   ' . $orderby . ' ' . $order . ' ' . 'LIMIT ' . $posts_per_page * ( $current_page - 1) . ', '. $posts_per_page;
			$orders = models_DB::get( $t );
			
             
			
			$total_order = models_DB::get('SELECT COUNT(id) as total_order FROM ' . ORDER_TABLE . ' WHERE ' . $the_type . ' AND ' . $user_id );
			
		 
			
			$total_order = $total_order[0]['total_order'];
			
			
            
			$current_url = get_current_url();
			
			$suffix = explode('?', $current_url);
			
			if(isset($suffix[1])) $suffix = '?' . $suffix[1];
			else $suffix = '';
			
			$base_link = SITE_URL . '/admin/';
            
            $loais = array(
                'uploads'       => 'Upload media',
                'edit-post'     => 'Sửa bài viết'
            );
            
			?>
			
			
			<table id="order-list">
				<tr class="order-item order-head"> 
					<td class="order-item-item stt  ">STT</td>
					<td class="order-item-item loai  ">Loại</td>
                    <td class="order-item-item nguoi_dung  ">Người dùng</td>
					<td class="order-item-item noi_dung_moi  ">Nội dung mới</td>
                    <td class="order-item-item noi_dung_cu  ">Nội dung cũ</td>
                    <td class="order-item-item action  ">Thao tác</td>                    
				</tr>
			
			
				<?php
				foreach($orders as $k=>$order)
                {
                    ?>
                    <tr class="tr-<?php echo $order['the_type'] ?>">
                        <td class="order-item-item stt  "><?php echo $k + 1; ?></td>
    					<td class="order-item-item loai  ">
                            <?php echo $loais[$order['the_type']] ?>
                        </td>
                        <td class="order-item-item nguoi_dung  ">
                            <?php
                                $user = get_user( $order['user_id'] );
                                echo $user['user_name'];
                            ?>
                        </td>
    					<td class="order-item-item noi_dung_moi  ">
                        <?php
                        
                        switch( $order['the_type'] )
                        {
                            case 'uploads' :
                            {
                                ?>
                                <a target="_blank" href="<?php echo $order['content'] ?>">
                                    <img src="<?php echo $order['content'] ?>" />
                                </a>
                                <?php
                                break;
                            }
                            case 'edit-post' :
                            {
                                $content = json_decode($order['content'], TRUE);
                                 
                                ?>
                                <div class="description  ">
                                    <?php echo $content['content'] ?>
                                </div>
                                <?php
                                break;
                            }
                        }
                        ?>
                        </td>
                        <td class="order-item-item noi_dung_cu  ">Nội dung cũ</td>
                        <td class="order-item-item action  ">Thao tác</td>
                    </tr>
                     
                    <?php
                }
			     ?>
				
			</table>
	   <span class="clear"></span>
	  
   <span class="clear"></span>
   <?php  
    $param = array(
            'base_url'          => $base_link,
            'current_page'      => $current_page,
            'total_post'        => $total_order,
            'posts_per_page'    => POSTS_PER_PAGE 
        ); 
   new_display_pagination($param) ?>
																																																																																																																																																																																			
	<span class="clear"></span>
        
       
       <div class="view-list-count">Đang xem từ <strong><?php echo $posts_per_page*($current_page - 1) + 1 ?></strong> đến <strong><?php if($total_order < $posts_per_page*($current_page )) echo $total_order; else echo $posts_per_page*($current_page) ?></strong> trong tổng số <strong><?php echo $total_order ?></strong> đơn hàng</div> 
       
       
    </div>
    <span class="clear"></span>
</div>