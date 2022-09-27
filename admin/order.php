<?php
	
	
	/**
 * Create order table
 */
//$temp = 'CREATE TABLE IF NOT EXISTS ' . ORDER_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name VARCHAR(255), phone VARCHAR(255), place TEXT, email VARCHAR(255), ip_address VARCHAR(255), total_cost VARCHAR(255), PRIMARY KEY(id))';
//$global_sqli->query($temp);
	 
	 
	 
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    
    if(!user_can('order')) die();
    
    
    
    if(!isset($_GET['page'])) $current_page = 1;
    else
    {
        
        $current_page = $_GET['page'];
    }
  
   if(isset($_GET['type']) && ($_GET['type']=='transform'))
   {
		if($_GET['status'] == 'delete')
		{
			models_DB::delete(ORDER_TABLE, ' WHERE id='.$_GET['id']);
		}
		else
		{
			$update = array(
				'the_status' => $_GET['status']
			);
			models_DB::update($update, ORDER_TABLE, '  WHERE id='.$_GET['id'] );
		}
		
		header('Location:' . SITE_URL . '/admin/?page_type=order');
   }
  
  
	$g_page_content['title'] = 'Danh sách đơn hàng';
 
    
	include 'header.php';
?>

<div id="" class="container">

    <?php //include 'sidebar.php'; ?>
        
    <div id="main-content" class="fl col-10-6">
    
    <div class="box">
        <div id="bread-crumbs">
		  <a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
    		<span class="arrow">›</span>
    		  
    		
    		<span class="current-page">Danh sách đơn hàng</span>
    
    	</div>
    </div>
    
    <div class="box">
    
	
	
    <h1>Danh sách đơn hàng  </h1>
    
        
        
	   
	   <div id="order">
			<div class="nav">
				<li class="fl pointer <?php if( (!isset($_GET['status'])) || (isset($_GET['status']) && ($_GET['status'] == 'new')) ) echo 'active' ?>">
					<a href="<?php echo SITE_URL ?>/admin/?page_type=order">Mới</a>
				</li>
				<li class="fl pointer <?php if(isset($_GET['status']) && ($_GET['status'] == 'all')) echo 'active' ?>">
					<a href="<?php echo SITE_URL ?>/admin/?page_type=order&status=all">Tất cả</a>
				</li>				
				<li class="fl pointer <?php if(isset($_GET['status']) && ($_GET['status'] == 'seen')) echo 'active' ?>">
					<a href="<?php echo SITE_URL ?>/admin/?page_type=order&status=seen">Đã xem</a>
				</li>
				<li class="fl pointer <?php if(isset($_GET['status']) && ($_GET['status'] == 'rac')) echo 'active' ?>">
					<a href="<?php echo SITE_URL ?>/admin/?page_type=order&status=rac">Thùng rác</a>				
				</li>
				<span class="clear"></span>
			</div>
			<div class="cart-content">
				
			</div>
	   </div>
	   
	    <?php
			
			$posts_per_page = 10;
			
			$status = ' the_status = \'new\'';
			
			if(isset($_GET['status'])) $status = ' the_status = \''. $_GET['status'] .'\'';
			
			if(isset($_GET['status']) && ($_GET['status']=='all')) $status = 1;
			
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
			
			$orders = models_DB::get('SELECT * FROM ' . ORDER_TABLE . ' WHERE ' . $status . ' ' . $orderby . ' ' . $order . ' ' . 'LIMIT ' . $posts_per_page * ( $current_page - 1) . ', '. $posts_per_page);
			
			
			
			$total_order = models_DB::get('SELECT COUNT(id) as total_order FROM ' . ORDER_TABLE . ' WHERE ' . $status );
			
			//h($total_order);
			
			$total_order = $total_order[0]['total_order'];
			
			
			$current_url = get_current_url();
			
			$suffix = explode('?', $current_url);
			
			if(isset($suffix[1])) $suffix = '?' . $suffix[1];
			else $suffix = '';
			
			$base_link = SITE_URL . '/admin/';
			?>
			
			
			<table id="order-list">
				<tr class="order-item order-head"> 
					<td class="order-item-item code fl">Mã</td>
					<td class="order-item-item date fl">Ngày đặt hàng</td>
					<td class="order-item-item name fl">Khách hàng</td>
					<td class="order-item-item phone fl">Số ĐT</td>
					<td class="order-item-item place fl">Địa chỉ</td>
					<td class="order-item-item products fl">Sản phẩm</td>
					<td class="order-item-item total_cost fl">Tổng giá trị</td>
					<td class="order-item-item action fl">Thao tác</td>
					
					 
				</tr>
			
			
				<?php
				
				$all_status = array('seen'=>'Đánh dấu đã xem','rac'=>'Cho vào thùng rác', 'new'=>'Đánh dấu mới', 'delete'=>'Xóa');
				foreach($orders as $order)
				{
					$remain_status = $all_status;
					unset($remain_status[$order['the_status']]);
					 
					?>
					<tr class="order-item" id="order-item-<?php echo $order['id'] ?>">
						<td class="order-item-item code fl">
						<a href="<?php echo SITE_URL ?>/admin/?page_type=order-detail&order_id=<?php echo $order['id'] ?>">#<?php echo $order['id'] ?></a>
							
							</td>
						<td  class="order-item-item date fl"><?php echo date('d/m/Y - G:i', strtotime ( '-7 hour' ,  $order['time_create'])) ?></td>
						<td class="order-item-item name fl"><?php echo $order['name'] ?></td>
						<td class="order-item-item phone fl"><?php echo $order['phone'] ?></td>
						<td class="order-item-item place fl"><?php echo $order['place'] ?></td>
						<td class="order-item-item products fl">
								<?php 
								$lists = json_decode($order['content'], TRUE);
								foreach($lists as $k=>$list)
								{
									$post = get_post($k, 'url, title');
									?>
									<a href="<?php hcv_url('', $post['url'], '') ?>"><?php echo $post['title'] ?> <span> (<?php echo $list['num'] ?>) </span></a>
									<?php
								}
								
								?>
						</td>
						
						<td class="order-item-item total_cost fl"><span><?php echo num_to_price($order['total_cost']) ?></span>  vnđ</td>
						<td class="order-item-item action fl">
							
							<?php 
								foreach($remain_status as $k_remain_status=>$v_remain_status)
								{
									?>
									<a class="order-action <?php echo $k_remain_status ?>" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=<?php echo $k_remain_status ?>" order_id="<?php echo $order['id'] ?>"  the_status="<?php echo $k_remain_status ?>">
										<?php echo $v_remain_status ?>
									</a>
									<?php
								}
							?>
						</td>
						 
					</tr>
					<span class="clear"></span>
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