<?php
	
	
	/**
 * Create order table
 */
//$temp = 'CREATE TABLE IF NOT EXISTS ' . ORDER_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name VARCHAR(255), phone VARCHAR(255), place TEXT, email VARCHAR(255), ip_address VARCHAR(255), total_cost VARCHAR(255), PRIMARY KEY(id))';
//$global_sqli->query($temp);
	 
    if(!defined('SECURE_CHECK')) die('Invalid to include');
  
    if(!user_can('order-detail')) die();
    
	$g_page_content['title'] = 'Xem đăng ký';
 
 
    if(!isset($_GET['order_id'])) die('order_id not defined !');
    
    if(!is_numeric($_GET['order_id'])) die('order_id invalid !');
   
    $order_id = $_GET['order_id'];
    
     
    $order_info = get_form($order_id);
     
    if($order_info == FALSE) die('Not found');
    
     
    
	include 'header.php';
?>

<div id="" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
            <div class="box">
                <div id="bread-crumbs">
            		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
            		<span class="arrow">›</span>
            		
            		
            		<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=list-order&id=<?php echo $order_info['field_form'] ?>" >Danh sách đăng ký</a>
            		<span class="arrow">›</span>		
            		<span class="current-page">Xem đơn hàng</span>
            
            	</div> 
            </div>
            
        	
        	<div class="box">
            
            <h1>Xem thông tin form</h1>
            <table id="list-order-table">
                    <tr class="tr-first">
                         
                        <?php 
                           $fields  = get_forms( array('field_form'=>$order_info['field_form'], 'the_type'=>'field', 'order'=> ' ORDER BY field_stt ASC ') );
                            foreach($fields as $field)
                            {
                                ?>
                                <td class=" ">
                                    <?php echo $field['field_name'] ?>
                                </td>
                                <?php
                            }
                        ?>
                         
                    </tr>
               
        	<?php 
        	
        		$list_posts = get_forms(array('the_type'=>'order', 'field_form'=> $order_info['field_form']));
                
                $list_post = $order_info;
        		 
                $order_content = json_decode($list_post['order_content'], TRUE);
                //h($order_content);
                ?>
                <tr>
                 
                <?php
        		foreach($fields as $field)
                {
                    ?>
                    <td class=" ">
                        <?php echo $order_content[$field['field_slug']] ?>
                    </td>
                    <?php
                }
                ?>
                 
                </tr>
                <?php
        		 
        	?>
            </table>
            </div>
            <span class="clear"></span>
        </div>
    </div>
        
    