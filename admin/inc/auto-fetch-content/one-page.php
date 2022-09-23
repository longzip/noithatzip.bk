<?php
	if(isset($_POST['submit']))
    {
         $a = '';
         
         $insert_content['post_type'] = 1;
        
         $hcv_html = file_get_html($_POST['link']);
         
         $links = $hcv_html->find('.link');
         
         $links = array_reverse($links);
         
         foreach($links as $k=>$link)
         {
             
             $url = $link->plaintext;
             
             $insert_content['url'] = str_replace('http://muapatin.com/', '', $url);
             
             //$insert_content['url'] .= '/';
             
             $exist = models_DB::get('SELECT id FROM '. POST_TABLE . ' WHERE url=\''. $insert_content['url'] .'\'');
             
             if(!empty($exist)) continue;
             
             $temp_html = file_get_html($url);
             
              
            
             $f_title = $temp_html->find('h1', 0);
             if(!empty($f_title)) $insert_content['title'] = $f_title->plaintext; else $insert_content['title'] = 'No title';
             
             
            
             
                           
             $temp = $temp_html->find('#product-para .hang_san_xuat .value', 0);
             if(!empty($temp))
             {
                 $insert_content['hang_san_xuat'] = $temp->plaintext;
             }
             
              $temp = $temp_html->find('#product-para .code .value', 0);
             if(!empty($temp)) 
             {
                $insert_content['product_code'] = $temp->plaintext;
                 
             }
             
             $temp = $temp_html->find('#product-para .bao_hanh .value', 0);
             if(!empty($temp)) 
             {
                $insert_content['bao_hanh'] = $temp->plaintext;
                 
             }
             
             $temp = $temp_html->find('#product-para .gia .value', 0);
             if(!empty($temp))
             {
                $insert_content['gia'] = $temp->plaintext;
                 $insert_content['gia'] = price_to_num($insert_content['gia']);
             } 
             
             $temp = $temp_html->find('#product-para .gia_km .value',0);
             if(!empty($temp)) 
             {
                
                $insert_content['gia_km'] = $temp->plaintext;
                $insert_content['gia_km'] = price_to_num($insert_content['gia_km']);
             }
             
             $temp = $temp_html->find('#product-images img', 0);
             if(!empty($temp)) $insert_content['image'] = $temp->src;
             
             $temp = $temp_html->find('#hcv-post-content', 0);
             if(!empty($temp)) $insert_content['content'] = $temp->outertext;
             
              
             
             $temp = $temp_html->find('#hcv-description', 0);
             if(!empty($temp)) $insert_content['description'] = $temp->plaintext;
             
             $temp = $temp_html->find('#hcv-template', 0);
             if(!empty($temp)) $insert_content['template'] = $temp->plaintext;
             
             $temp = $temp_html->find('#hcv-post-categoy', 0);
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
             
             $insert_content['time_create'] = hcv_time();
             $insert_content['time_update'] = hcv_time();
             $insert_content['view_count'] = 0;
             $insert_content['comment_count'] = 0;
             $insert_content['user_id'] = 1;
             
             
             
             
             $insert_id = models_DB::insert($insert_content, POST_TABLE);
            
             
            
             if($insert_id) $a .= '<a style="display:block" href="'. SITE_URL . '/' . $insert_content['url'] . '-p' . $insert_id . '">' . $insert_content['title'].  '</a>';
            
             
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
    <input type="text" value="h2.sp-titles" name="f_title" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Miêu tả</label>
    <input type="text" name="f_des" value=".term-description" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    
    
    <br /><br /><br />
    
    
    
    
    <input type="submit" id="submit" value="Ok" name="submit" />
</form>