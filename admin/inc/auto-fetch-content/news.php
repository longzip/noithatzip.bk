<?php
	if(isset($_POST['submit']))
    {
         $a = '';
         
         $insert_content['post_type'] = 2;
        
         $hcv_html = file_get_html($_POST['link']);
         
         $links = $hcv_html->find('.link');
         
         
         
         foreach($links as $k=>$link)
         {
             
             $url = $link->plaintext;
             $temp_html = file_get_html($url);
             
             
            
             $f_title = $temp_html->find($_POST['f_title'], 0);
             if(!empty($f_title)) $insert_content['title'] = $f_title->plaintext; else $insert_content['title'] = 'No title';
             
             $insert_content['url'] = str_replace('http://vinakaraoke.vn/', '', $url);
             
             $insert_content['template'] = 'news';
             
            
             
             $temp = $temp_html->find($_POST['f_content'] . ' img', 0);
             if(!empty($temp)) $insert_content['image'] = $temp->src;
             
             $temp = $temp_html->find($_POST['f_content'], 0);
             if(!empty($temp)) $insert_content['content'] = $temp->outertext;
              
             $temp = $temp_html->find("#hcv-post-categoy", 0);
             if(!empty($temp)) $insert_content['categories'] = $temp->plaintext;
             else $insert_content['categories'] = '';
             
             $temp = $temp_html->find('#hcv-post-tag', 0);
             if(!empty($temp)) $insert_content['tags'] = $temp->plaintext;
             
             $temp = $temp_html->find($_POST['f_category'], 0);
             if(!empty($temp)) $insert_content['categories'] = $temp->plaintext;
              
             
             $f_seo_des = $temp_html->find('meta[name="description"]', 0);
             if(!empty($f_seo_des)) $seo['description'] = $f_seo_des->content; else $seo['description'] = '';
             
             $f_seo_des = $temp_html->find('meta[name="keywords"]', 0);
             if(!empty($f_seo_des)) $seo['keywords'] = $f_seo_des->content; else $seo['keywords'] = '';
             
             
             $f_seo_title = $temp_html->find('title', 0);
             if(!empty($f_seo_title)) $seo['title'] = $f_seo_title->plaintext; else $seo['title'] = $insert_content['title'];
              
             
             $seo['index'] = 'index';
             
             $seo['follow'] = 'follow';
             
             $seo['301'] = '';
             
             $seo['canonical'] = '';
             
              
              
             $insert_content['seo'] = json_encode($seo);
             
             $insert_id = models_DB::insert($insert_content, POST_TABLE);
            
             //h($_POST);
             //h($insert_content);
            
             if($insert_id) $a .= '<a style="display:block" href="'. SITE_URL . '/' . $insert_content['url'] . '-p' . $insert_id . '">' . $insert_content['title'].  '</a>';
            
             //if($k==2) die();
             //die();
         }
         
          
         
          
         
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
    <input type="text" value="h1 span" name="f_title" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Nội dung</label>
    <input type="text" name="f_content" value="#hcv-content" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Chuyên mục</label>
    <input type="text" name="f_category" value="#hcv_category" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    
    
    <br /><br /><br />
    
    
    
    
    <input type="submit" id="submit" value="Ok" name="submit" />
</form>