<?php
	if(isset($_POST['submit']))
    {
        
        
       
         
         
        
         $link = file_get_html($_POST['link']);
         
         
         $f_id = $link->find($_POST['f_id'], 0);
         if(!empty($f_id)) $insert_content['id'] = $f_id->plaintext;
        
         //else $insert_content['id'] = $_POST['cat_id'];
         
         $f_title = $link->find($_POST['f_title'], 0);
         $insert_content['title'] = $f_title->plaintext;
         
         $insert_content['url'] = str_replace('http://vinakaraoke.vn/', '', $_POST['link']);
         
         $f_des = $link->find($_POST['f_des'], 0);
          if(!empty($f_des)) $insert_content['description'] = $f_des->outertext;
         
         $f_seo_des = $link->find('meta[name="description"]', 0);
         if(!empty($f_seo_des)) $insert_content['seo_description'] = $f_seo_des->content;
         
         $f_seo_des = $link->find('meta[name="keywords"]', 0);
         if(!empty($f_seo_des)) $insert_content['seo_keywords'] = $f_seo_des->content;
         
         $insert_content['time_create'] = hcv_time();
         $insert_content['time_update'] = hcv_time();
         
         $insert_content['view_count'] = 1;
         
         $insert_content['template'] = 'default';
         
         $f_seo_title = $link->find('title', 0);
         $insert_content['seo_title'] = $f_seo_title->plaintext;
          
         $insert_content['parent'] = 0;
         
         $insert_id = models_DB::insert($insert_content, CATEGORY_TABLE);
        
         $a = '';
        
         
         
         
         if($insert_id) $a = '<a href="'. SITE_URL . '/' . $insert_content['url'] . '-c' . $insert_id . '">' . $insert_content['title'].  '</a>';
    
?>

<div id="statistic" style="background: silver;padding:10px;margin:20px 0">
    <p class="title-font">Thống kê kết quả :</p>
     <?php echo $a; ?>
</div>


<?php 
}
?>
<form action="" method="POST">
     
     <div class="fetch-item">
    <label class="title-font">Link</label>
    <input type="text" value="" required="" name="link" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
     
    
    <p class="title-font">Cấu trúc trang nguồn</p>
     
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Tiêu đề</label>
    <input type="text" value="h2.page-title" name="f_title" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Miêu tả</label>
    <input type="text" name="f_des" value=".term-description" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">ID chuyên mục</label>
    <input type="text" value="#hcv_category_id" name="f_id" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <br /><br /><br />
    
    
    <p class="title-font">Tham số trang đích</p>
     <div class="new-thread-item box">
		<label class="block">ID chuyên mục</label>
	   <input type="number"  class="text" name="cat_id" />
		
		<span class="clear"></span>
	</div> 
    
    <input type="submit" id="submit" value="Ok" name="submit" />
</form>