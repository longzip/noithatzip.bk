<?php

    if(!user_can('post-type')) die();
  
  
	$g_page_content['title'] = 'All Form';
?>

<?php
	include 'header.php';
?>
<script src="<?php echo CDN_DOMAIN . '/admin/js/form.js' ?>"></script>
<div id="" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="">
            <div class="box">
                 <div id="bread-crumbs">
            		<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
            		<span class="arrow">›</span>
                    
                    <a class="link"  href="<?php echo SITE_URL . '/admin/?page_type=form'; ?>" class="home-icon block fl">
        					Danh sách Form    			 
        			</a>
            	</div>
             </div>
         
            <div class="box">
            
            <h1 class="h1-title">List Order</h1>
            
            
               <div class="box">
        	
            
        	   
        	   <span class="clear"></span>
               <table id="list-order-table">
                    <tr class="tr-first">
                        <td class="stt">STT</td>
                        <td class="date">Thời gian</td>
                        
                        <?php 
                           $fields  = get_forms( array('field_form'=>$_GET['id'], 'the_type'=>'field', 'order'=> ' ORDER BY field_stt ASC ') );
                            foreach($fields as $field)
                            {
                                ?>
                                <td class=" ">
                                    <?php echo $field['field_name'] ?>
                                </td>
                                <?php
                            }
                        ?>
                         <td class="action">Thao tác</td>
                    </tr>
               
        	<?php 
        	
        		$list_posts = get_forms(array('the_type'=>'order', 'field_form'=> $_GET['id']));
        
        		foreach($list_posts as $k=>$list_post)
        		{
        		  //h($list_post);
                    $order_content = json_decode($list_post['order_content'], TRUE);
                    //h($order_content);
                    ?>
                    <tr>
                    <td class="stt"><?php echo $k+1 ?></td>
                    <td class="date"><?php echo date( 'H:i:s - d/m/Y' ,$list_post['time_create']) ?></td>
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
                    <td class="action">
                        <a target="_blank" href="<?php echo SITE_URL . '/admin/?page_type=list-order-detail&order_id=' . $list_post['id']; ?>" class="view none" >Xem</a>
                        <a target="_blank" stt="<?php echo $k+1 ?>" par="<?php echo $list_post['id'] ?>" class="del" href="#" >Xóa</a>
                    </td>
                    </tr>
                    <?php
        		}
        	?>
            </table>
           <span class="clear"></span>
           																																																																																																																																																																																			
        	<span class="clear"></span>
               </div>
            </div>
            <span class="clear"></span>
        </div>
    </div>
        
    