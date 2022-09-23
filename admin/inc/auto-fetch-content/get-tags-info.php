<?php
    $exist = models_DB::get('SELECT * FROM '. TAG_TABLE);
    
    /** foreach($exist as $k=>$v)
    {
        $update = array(
        'url'       => 'tag/' . $v['url']
        );
        
        models_DB::update($update, TAG_TABLE, ' WHERE id=' . $v['id']);
    } **/
             

	if(isset($_POST['submit']))
    {
         $a = '';
         
          
        
         $hcv_html = file_get_html($_POST['link']);
         
         $links = $hcv_html->find('.link');
         
         //$links = array_reverse($links);
         
         foreach($links as $k=>$link)
         {
             
             $url = $link->find('.tag-link', 0)->plaintext;
             
             $insert_content['url'] = str_replace('http://vinakaraoke.vn/', '', $url);
             
             $insert_content['time_create'] = hcv_time();
             $insert_content['time_update'] = hcv_time();
             
             $exist = models_DB::get('SELECT id FROM '. TAG_TABLE . ' WHERE url=\''. $insert_content['url'] .'\'');
             
             if(!empty($exist)) continue;
             
             $insert_content['id'] = $link->find('.tag-id', 0)->plaintext;
             $temp_html = file_get_html($url);
             
              
            
             $f_title = $temp_html->find($_POST['f_title'], 0);
             if(!empty($f_title)) $insert_content['title'] = $f_title->plaintext; else $insert_content['title'] = 'No title';
             
             
             
              
             
                        
              
              
             
             $f_seo_des = $temp_html->find('meta[name="description"]', 0);
             if(!empty($f_seo_des)) $insert_content['seo_description'] = $f_seo_des->content; else $insert_content['seo_description'] = '';
             
             $f_seo_des = $temp_html->find('meta[name="keywords"]', 0);
             if(!empty($f_seo_des)) $insert_content['seo_keywords'] = $f_seo_des->content; else $insert_content['seo_keywords'] = '';
             
             
             $f_seo_title = $temp_html->find('title', 0);
             if(!empty($f_seo_title)) $insert_content['seo_title'] = $f_seo_title->plaintext; else $insert_content['seo_title'] = $insert_content['title'];
              
             //h($insert_content);
              
             
              
              
              
             
             $insert_id = models_DB::insert($insert_content, TAG_TABLE);
            
              
            
             if($insert_id) $a .= '<a style="display:block" href="'. SITE_URL . '/' . $insert_content['url'] . '-p' . $insert_id . '">' . $insert_content['title'].  '</a>';
            
             
         }
         
          
         
          
         
         //$insert_id = models_DB::insert($insert_content, CATEGORY_TABLE);
        
         $a = '';
         
        
         //if($insert_id) $a = '<a href="'. SITE_URL . '/' . $insert_content['url'] . '-c' . $insert_id . '">' . $insert_content['title'].  '</a>';
    
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
    <input type="text" value="h1" name="f_title" class="text" />
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