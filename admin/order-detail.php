<?php


	/**
 * Create order table
 */
//$temp = 'CREATE TABLE IF NOT EXISTS ' . ORDER_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name VARCHAR(255), phone VARCHAR(255), place TEXT, email VARCHAR(255), ip_address VARCHAR(255), total_cost VARCHAR(255), PRIMARY KEY(id))';
//$global_sqli->query($temp);

    if(!defined('SECURE_CHECK')) die('Invalid to include');

    if(!user_can('order-detail')) die();

	$g_page_content['title'] = 'Xem đơn hàng';


    if(!isset($_GET['order_id'])) die('order_id not defined !');

    if(!is_numeric($_GET['order_id'])) die('order_id invalid !');

    $order_id = $_GET['order_id'];





	include 'header.php';
?>

<div id="" class="container">

	<div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
			<?php include 'sidebar.php'; ?>
	</div>


	<div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">

<div id="main-content" class="fl col-10-6">
<div id="bread-crumbs" class="box">
<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
<span class="arrow">›</span>


<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=order" >Danh sách đơn hàng</a>
<span class="arrow">›</span>

<span class="current-page">Xem đơn hàng</span>

</div>

<div class="box">

<h1>Xem đơn hàng</h1>


 <?php
$order = models_DB::get('SELECT * FROM ' . ORDER_TABLE . ' WHERE id='.$order_id);

if(empty($order)) die('Đơn hàng đã bị xóa');

$order = $order[0];

if(!empty( $order['content'] )) $lists = json_decode($order['content'], TRUE);
else $lists = array();

$allPriceTotal = 0;
?>
<div id="order-detail">


	<div class="order-detail-item code">
		<div class="label">Mã đơn hàng : </div><div class="content">#<?php echo $order['id'] ?></div>
		<span class="clear"></span>
	</div>

	<div class="order-detail-item name">
		<div class="label">Tên khách hàng : </div><div class="content"><?php echo $order['name'] ?></div>
		<span class="clear"></span>
	</div>

	<div class="order-detail-item phone">
		<div class="label">Số ĐT : </div><div class="content"><?php echo $order['phone'] ?></div>
		<span class="clear"></span>
	</div>

	<div class="order-detail-item place">
		<div class="label">Địa chỉ : </div><div class="content"><?php echo $order['place'] ?></div>
		<span class="clear"></span>
	</div>

	<div class="order-detail-item email">
		<div class="label">Email : </div><div class="content"><?php echo $order['email'] ?></div>
		<span class="clear"></span>
	</div>

	<?php
		if(!empty($order['other']))
		{
			?>
			<div class="order-detail-item email">
				<div class="label">Thông tin khác : </div><div class="content"><?php echo $order['other'] ?></div>
				<span class="clear"></span>
			</div>
			<?php
		}
	?>

	<div class="order-detail-item date">
		<div class="label">Ngày đặt hàng : </div><div class="content"><?php echo date('d/m/Y - G:i', strtotime ( '-7 hour' ,  $order['time_create'])) ?></div>
		<span class="clear"></span>
	</div>

	<div class="order-detail-item order-content">
		<div class="label"> &nbsp; </div>
		<div class="order-content-content">
      <h2 style="font-size: 18px;">Giỏ hàng</h2>
			<?php

				$total_price = 0;
				foreach($lists as $k=>$v)
				{

					$post = get_post($k);
					$total_price = $total_price +  $v['price'] * $v['num'];

					if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=280&h=200';
					else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/inc/images/noimage.png&w=280&h=200';

					?>
					<div class="cart-item" id="cart-item-<?php echo $k ?>">
						<a href="<?php echo SITE_URL , '/' , $post['url'] ?>" class="cart-product-name"><?php echo $post['title'] ?></a>
						<span class="clear"></span>
						<div class="fl cart-item-image">
							<img src="<?php echo $image ?>" />
						</div>
						<div class="fl cart-item-info">
							<p class="cart-num">Số lượng : <span class="cart-item-num"><?php echo $v['num'] ?></span></p>
							<p class="cart-price">Đơn giá : <span><?php echo num_to_price($v['price']) ?></span> <strong>vnđ</strong></p>

							<p class="cart-item-price">Thành tiền : <span><?php echo num_to_price($v['price']*$v['num']) ?></span> <strong>vnđ</strong></p>
						</div>
						<span class="clear"></span>


					</div>
					<?php
				}
        $allPriceTotal+=$total_price;
			?>
			<span class="clear"></span>
			<p class="total-price">Tổng giỏ hàng  : <span><?php echo num_to_price($total_price) ?></span> <strong>vnđ</strong></p>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>

  <div class="order-detail-item order-content">
    <div class="label"> &nbsp; </div>
		<div class="order-content-content">

      <h2 style="font-size: 18px;">Combo</h2>
    	<?php

				$total_price = 0;
        if(!empty( $order['sb'] )) $lists = json_decode($order['sb'], TRUE);
        else $lists = array();

				foreach($lists as $k=>$v)
				{

					$post = get_post($k);
					$total_price = $total_price +  $v['price'] * $v['num'];

					if(!empty($post['image'])) $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . $post['image'] . '&w=280&h=200';
          else $image = SITE_URL . '/apps/timthumb/timthumb.php?src=' . SITE_URL . '/inc/images/noimage.png&w=280&h=200';
 
					?>

					<div class="cart-item" id="cart-item-<?php echo $k ?>">
						<a href="<?php echo SITE_URL , '/' , $post['url'] ?>" class="cart-product-name"><?php echo $post['title'] ?></a>
						<span class="clear"></span>
						<div class="fl cart-item-image">
							<img src="<?php echo $image ?>" />
						</div>
						<div class="fl cart-item-info">
							<p class="cart-num">Số lượng : <span class="cart-item-num"><?php echo $v['num'] ?></span></p>
							<p class="cart-price">Đơn giá : <span><?php echo num_to_price($v['price']) ?></span> <strong>vnđ</strong></p>

							<p class="cart-item-price">Thành tiền : <span><?php echo num_to_price($v['price']*$v['num']) ?></span> <strong>vnđ</strong></p>
						</div>
						<span class="clear"></span>


					</div>
					<?php
				}
        $allPriceTotal+=$total_price;
			?>
			<span class="clear"></span>
			<p class="total-price">Tổng Combo  : <span><?php echo num_to_price($total_price) ?></span> <strong>vnđ</strong></p>
			<span class="clear"></span>
		</div>



		<span class="clear"></span>
    <hr style="margin-top:40px" />
    <p class="total-price">Tổng cộng  : <span><?php echo num_to_price($allPriceTotal) ?></span> <strong>vnđ</strong></p>
	</div>


</div>

 <div id="form-order-action">
 Thao tác :
<?php
	switch($order['the_status'])
	{
		case  'new' :
		{
			?>
			<a class="seen" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=seen">Đánh dấu đã xem</a>
			<a class="rac" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=rac">Cho vào thùng rác</a>

			<?php
		}
		break;

		case  'seen' :
		{
			?>
			<a class="new" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=new">Đánh dấu mới</a>
			<a class="rac" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=rac">Cho vào thùng rác</a>
			<?php
		}
		break;

		case  'rac' :
		{
			?>
			<a class="new" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=new">Đánh dấu mới</a>
			<a class="seen" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=seen">Đánh dấu đã xem</a>
			<a class="delete" href="<?php echo SITE_URL ?>/admin/?page_type=order&type=transform&id=<?php echo $order['id'] ?>&status=delete">Xóa đơn hàng này</a>

			<?php
		}
		break;
	}
?>
 </div>

</div>
<span class="clear"></span>
</div>
				</div>
