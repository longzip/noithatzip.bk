<?php

    

    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('categories')) die('');
    
    if(isset($_POST['submit']))
    { 
       
       
        
    }
	$g_page_content['title'] = 'Danh sách chuyên mục';
    
    function display_category($category)
    {
        global $sub_count;
        ?>
            <div class="category">
            
                <div class="category-detail border-left-hover">
                    <a class="category-title" href="<?php if(user_can('edit-category')) echo SITE_URL, '/admin/?page_type=edit-category&category_id=', $category['id']; else echo '#' ?>"><?php echo $category['title'] ?></a>
                    <div class="action">
                        <?php hcv_link(hcv_url('c', $category['url'], $category['id'], FALSE), 'Xem');//echo SITE_URL, '/admin/edit-category/', $category['id'] ?>
                    
                        <?php 
                            if(user_can('edit-category'))
                            {
                        ?>
						<a class="edit" href="<?php echo SITE_URL, '/admin/?page_type=edit-category&category_id=', $category['id'] ?>">Sửa</a>
                        <?php 
                            }
                        ?>
                        <?php 
                            if(user_can('delete-category'))
                            {
                        ?>
                        <a class="delete-category delete" category_id="<?php echo $category['id'] ?>" href="<?php echo SITE_URL, '/admin/delete-category/?id=' . $category['id'] ?>">Xóa</a>
                        <?php 
                            }
                        ?>
                        </div>
                    <span class="stt">
                    <?php 
                         
                        
                        $param = array('field'=>' COUNT(id) AS total_post', 'category'=>$category['id']);
                        
                        $posts_count = get_posts($param);
                         
                        echo $posts_count[0]['total_post'] 
                    ?>
                    </span>
                </div>
            
             <?php 
                $sub_categorys = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $category['id'] . ' ORDER BY stt ASC');
                
                 
                
                if(!empty($sub_categorys))
                {
                    $sub_count++;
                    ?>
                    <div class="sub-category sub-category-<?php echo $sub_count ?>">
                    <?php
                    foreach($sub_categorys as $s_k=>$s_v)
                    {
                        display_category($s_v);
                    }
                    ?>
                    </div>
                    <?php
                }
                
               ?>
               </div>
               <?php 
            ?>
        
        <?php
    }
?>

<?php
	include 'header.php';
?>

<div id="content" class="container">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content"  >
            <div class="box">
            <?php 
            
            $categorys = models_DB::get('SELECT COUNT(id) AS total_cat FROM ' . CATEGORY_TABLE); 
            
            ?>
            <h1 class="h1-title">Danh sách chuyên mục ( <?php echo $categorys[0]['total_cat'] ?> )
            
                <div class="fr inline-block posts-action">
                     <a title="Thêm mới" class="posts-new-post  " href="<?php echo SITE_URL . '/admin/?page_type=new-category' ?>"><i class="fa fa-plus"></i></a>
                </div>
            </h1>
            <?php show_form_success() ?>
            </div>
            
            <div class="box" id="category">
                <?php 
                    $categorys = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY title ASC');
                    
                    
                    $sub_count = 0;
                    foreach($categorys as $category)
                    {
                        
                        ?>
                        <div class="category-item">
                            <?php display_category($category) ?>
                        </div>
                        <?php
                    }
                ?>
            </div>
           
           
        </div>
    </div>
     
        
    
    <span class="clear"></span>
</div>